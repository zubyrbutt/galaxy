<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Controllers\Controller;
use App\InventoryCategory;
use App\Paypalwithdrawal;
use App\Preference;
use App\StaffRequired;
use App\StaffRequiredStatus;
use App\User;
use Auth;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Validator;
use Notification;

class StaffRequiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $department = Department::all();
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        return view('staffrequired.index')->with('departments', $departments);
    }


    public function fetch(Request $request)
    {
        if($request->filterdata){
            $fromdate = $request->filterdata[0]['value'];
            $todate = $request->filterdata[1]['value'];
            $department = $request->filterdata[2]['value'];
            $status = $request->filterdata[3]['value'];

            $data = StaffRequired::with('department')->with('user')->where('is_deleted',0)
                ->where(function($query) use ($fromdate,$todate,$department,$status){
                    if(!empty($fromdate)){
                        $query->whereDate('required_date','>=',$fromdate);
                    }
                    if(!empty($todate)){
                        $query->whereDate('required_date','<=',$todate);
                    }
                    if(!empty($department)){
                        $query->where('department_id',$department);
                    }
                    if(!empty($status)){
                        $query->where('status',$status);
                    }
                })->get();
        }else {
            $data = StaffRequired::with('department')->with('user')->where('is_deleted', 0)->orderBy('status', 'desc');
        }

        return DataTables::eloquent($data)
            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d-M-Y');
            })
            ->addColumn('salary_range', function ($data) {
                return $data->salary_from . ' - ' . $data->salary_to;
            })
            ->addColumn('department', function (StaffRequired $staff) {
                return $staff->department->deptname;
            })
            ->addColumn('requestedby', function ($data) {
                return $data->user->fname . ' ' . $data->user->lname;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'Pending') {
                    return '<span class="label label-warning">Pending</span>';
                } else if ($data->status == 'Rejected') {
                    return '<span class="label label-danger">Rejected</span>';
                }else if ($data->status == 'Completed') {
                    return '<span class="label label-success">Completed</span>';
                }else if ($data->status == 'Fullfilled') {
                    return '<span class="label label-info">Fullfilled</span>';
                } else {
                    return '<span class="label  label-primary">' . $data->status . '</span>';
                }
            })
            ->addColumn('options', function ($data) {
                    return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                                     <a  class='btn btn-success MarkAscompleted' data-toggle='modal' data-target='#changeStatusToCompleted' data-id='" . $data->id . "' onclick='markAsCompleted($data->id)'><i class='fa fa-check'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Mark as Pending' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='" . $data->id . "'><i class='fa fa-close'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Delete' class='btn btn-danger delete' data-original-title='Disable' href='#' data-id='" . $data->id . "'><i class='fa fa-trash'></i></a>
                                     <a id='viewdetail' data-loading-text=\"<i class='fa fa-circle-o-notch fa-spin'></i>\" class='btn btn-primary' href='#' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";

            })
            ->addColumn('required_date', function ($data) {
                return date("d-M-Y", strtotime($data->required_date));
            })
            ->rawColumns(['status', 'options'])
            ->toJson();

//            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'salary_from' => 'required',
            'salary_to' => 'required',
            'position' => 'required',
            'number_of_staff' => 'required',
            'department_id' => 'required',
            'required_date' => 'required',
            'job_desc' => 'required',
        );

        $data = [
            'position' => trim($request->get('position')),
            'salary_from' => trim($request->get('salary_from')),
            'salary_to' => trim($request->get('salary_to')),
            'number_of_staff' => trim($request->get('number_of_staff')),
            'department_id' => trim($request->get('department_id')),
            'required_date' => trim($request->get('required_date')),
            'job_desc' => trim($request->get('job_desc')),
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user_id = Auth::user()->id;
            $required_date = date("Y-m-d", strtotime($request->required_date));
            if (isset($request->edit_id) && ($request->edit_id != "")) {
                $data = StaffRequired::findOrFail($request->edit_id);
                if ($data->requestedby == $user_id || auth()->user()->role_id === 1) {

                    $creator=auth()->user()->fname.' '.auth()->user()->lname;
                    $ppwdn = Preference::where('option','requiredstaffnotification')->first();
                    $ppwd_user_ids = explode(',',$ppwdn->value);
                    $users = User::whereIn('id',$ppwd_user_ids)->get();
                    $when = Carbon::now()->addSecond();
                    $information = collect(['title' => 'Required New Staff','body'=>'Required New Staff  Requirenements Changed By '.$creator,'redirectURL'=>'#']);
                    Notification::send($users, (new \App\Notifications\PaypalWithdrawal($information))->delay($when));

                    $data->requestedby = $user_id;
                    $data->salary_from = $request->salary_from;
                    $data->salary_to = $request->salary_to;
                    $data->required_date = $required_date;
                    $data->position = $request->position;
                    $data->number_of_staff = $request->number_of_staff;
                    $data->department_id = $request->department_id;
                    $data->job_desc = $request->job_desc;
                    $data->save();
                    $success = 'Requirenment Updated Successfully.';
                    return response()->json($success);
                } else {
                    $success = 'You are not allowed to Edit This.';
                    return response()->json($success);
                }

            } else {
                $creator=auth()->user()->fname.' '.auth()->user()->lname;
                $ppwdn = Preference::where('option','requiredstaffnotification')->first();
                $ppwd_user_ids = explode(',',$ppwdn->value);
                $users = User::whereIn('id',$ppwd_user_ids)->get();
                $when = Carbon::now()->addSecond();
                $information = collect(['title' => 'Required New Staff ','body'=>'A new Staff Required for Position '.$request->position.'Requested By '.$creator,'redirectURL'=>'#']);
                Notification::send($users, (new \App\Notifications\PaypalWithdrawal($information))->delay($when));

                $data = New StaffRequired;
                $data->requestedby = $user_id;
                $data->salary_from = $request->salary_from;
                $data->salary_to = $request->salary_to;
                $data->required_date = $required_date;
                $data->position = $request->position;
                $data->number_of_staff = $request->number_of_staff;
                $data->department_id = $request->department_id;
                $data->job_desc = $request->job_desc;
                $data->status = 'Pending';
                $data->save();
                $success = 'Requirenment has been Posted.';
                return response()->json($success);
            }
        }
    }


    public function edit(Request $request)
    {
        $data = StaffRequired::findOrFail($request->id);
        return response()->json($data);
    }


    public function paypalActive(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = StaffRequired::findOrFail($request->complete_sr_id);
        if ($data->requestedby == $user_id || auth()->user()->role_id === 1) {
            if(isset($request->markascompleted)){
                $data->status = 'Completed';
                $status = new StaffRequiredStatus;
                $status->staffrequired_id = $request->complete_sr_id;
                $status->updatedBy = $user_id;
                $status->status = 'Completed';
                $status->description = $request->remarks;
                $status->save();
                $message = 'Successfully Completed.';
            }else{
                $status = new StaffRequiredStatus;
                $status->staffrequired_id = $request->complete_sr_id;
                $status->updatedBy = $user_id;
                $status->status = 'Fullfilled';
                $status->description = $request->remarks;
                $status->save();
                $message = 'Successfully Fullfilled.';
            }
            $data->employeejoined += $request->staff_joined;
            $data->save();


            return response()->json($message);
        } else {
            $message = 'You are not allowed.';
            return response()->json($message);
        }
    }


    public function paypalDisable(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = StaffRequired::findOrFail($request->id);
        if ($data->requestedby == $user_id || auth()->user()->role_id === 1) {
            $data->status = 'Pending';
            $data->save();
            $message = 'Status Changed to Pending.';

            $status = new StaffRequiredStatus;
            $status->staffrequired_id = $request->id;
            $status->updatedBy = $user_id;
            $status->status = 'Pending';
            $status->description = 'Requirenment Pending ';
            $status->save();

            return response()->json($message);
        } else {
            $message = 'You are not allowed.';
            return response()->json($message);
        }
    }

    public function delete(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = StaffRequired::findOrFail($request->id);
        if ($data->requestedby == $user_id || auth()->user()->role_id === 1) {
            $data->is_deleted = 1;
            $data->save();
            $message = 'Successfully Delete.';
            return response()->json($message);
        } else {
            $message = 'You are not allowed.';
            return response()->json($message);
        }
    }

    public function viewdetail(Request $request)
    {
        $data['post_details'] = StaffRequired::with('user')->with('department')->findOrFail($request->id);
        $data['status_details'] = StaffRequiredStatus::with('updatedby')->where('staffrequired_id',$request->id)->get();
        return response()->json($data);
    }

    public function changestatus(Request $request)
    {
        $rules = array(
            'staffrequired_id' => 'required',
            'status' => 'required',
            'remarks' => 'required',
        );

        $data = [
            'staffrequired_id' => trim($request->get('staffrequired_id')),
            'status' => trim($request->get('status')),
            'remarks' => trim($request->get('remarks')),
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $mainstatus = StaffRequired::findOrFail($request->staffrequired_id);
            if($mainstatus->status=='Completed'){
                exit;
            }
            if($request->status == 'Fullfilled'){
                $mainstatus->employeesent += $request->employeesent;
            }
            $mainstatus->status = $request->status;
            $mainstatus->save();

            $user_id = Auth::user()->id;
            $status = new StaffRequiredStatus;
            $status->staffrequired_id = $request->staffrequired_id;
            $status->updatedBy = $user_id;
            $status->status = $request->status;
            $status->description = $request->remarks;
            $status->save();

            $creator = auth()->user()->fname.' '.auth()->user()->lname;
            $ppwdn = Preference::where('option','requiredstaffnotification')->first();
            $ppwd_user_ids = explode(',',$ppwdn->value);
            $users = User::whereIn('id',$ppwd_user_ids)->get();
            $when = Carbon::now()->addSecond();
            $information = collect(['title' => 'Required New Staff ','body'=>'Required New Staff For Position '.$request->rePosition.' Status Changed to '.$request->status.' By '.$creator,'redirectURL'=>'#']);
            Notification::send($users, (new \App\Notifications\PaypalWithdrawal($information))->delay($when));

            //$data = StaffRequiredStatus::where('staffrequired_id',$request->staffrequired_id)->get();
            return response()->json($status);
        }
    }


}
