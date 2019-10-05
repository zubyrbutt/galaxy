<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\QualilyAssuranceAttachments;
use App\QualityAssurance;
use App\User;
use App\UserChecklist;
use App\UserDocument;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use File;

class QualityAssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('iscustomer', 0)->where('status', 1)->orderBy('fname', 'ASC')->get();
        return view('qa.index', compact('users'));
    }


    public function fetch(Request $request)
    {

        if ($request->filterdata) {
            $fromdate = $request->filterdata[0]['value'];
            $todate = $request->filterdata[1]['value'];
            $user = $request->filterdata[2]['value'];
            $data = QualityAssurance::where('is_deleted', 0)
                ->where(function ($query) use ($fromdate, $todate, $user) {
                    if (!empty($fromdate)) {
                        $query->whereDate('qa_date', '>=', $fromdate);
                    }
                    if (!empty($todate)) {
                        $query->whereDate('qa_date', '<=', $todate);
                    }
                    if (!empty($user)) {
                        $query->where('user_id', $user);
                    }
                })->get();
//            print_r($data->toArray());
        } else {
            $data = QualityAssurance::where('is_deleted', 0)->get();
        }
        return DataTables::of($data)
            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d-M-Y');
            })
            ->addColumn('created_by', function ($data) {
                return $data->created_by->fname . ' ' . $data->created_by->lname;
            })
            ->addColumn('user_name', function ($data) {
                return $data->user->fname . ' ' . $data->user->lname;
            })
            ->addColumn('report_date', function ($data) {
                $report_date = date('d-M-Y', strtotime($data->qa_date));
                return $report_date;
            })
            ->addColumn('ratingbar', function ($data) {
                $rating = $data->userratings * 20;
                return '<div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:'.$rating.'%"></div>
                        </div>';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'Active') {
                    return '<span class="label label-success">Active</span>';
                } else if ($data->status == 'Disable') {
                    return '<span class="label label-danger">Disable</span>';
                } else {
                    return '<span class="label  label-primary">' . $data->status . '</span>';
                }
            })
            ->addColumn('options', function ($data) {

                return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Delete' class='btn btn-danger delete' data-original-title='Disable' href='#' data-id='" . $data->id . "'><i class='fa fa-trash'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Detail' class='btn btn-primary' data-original-title='Detail' href='" . url('/qualityassurance/detail/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                                     ";

            })
            ->rawColumns(['created_at', 'status', 'options', 'created_by', 'user_name', 'report_date','ratingbar'])
            ->make(true);

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
            'description' => 'required',
            'title' => 'required',
            'user_id' => 'required',
            'qa_date' => 'required',
        );

        $data = [
            'description' => trim($request->get('description')),
            'title' => trim($request->get('title')),
            'user_id' => trim($request->get('user_id')),
            'qa_date' => trim($request->get('qa_date')),
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user_id = Auth::user()->id;

            if (isset($request->edit_id) && ($request->edit_id != "")) {

                $data = QualityAssurance::findOrFail($request->edit_id);
                $data->title = $request->title;
                $data->description = $request->description;
                $data->user_id = $request->user_id;
                $data->userratings = $request->userratings;
                $data->asset_link = $request->asset_link;
                $data->qa_date = $request->qa_date;
                $data->createdby = $user_id;
                $data->save();
                if ($request->hasfile('attachments')) {
                    foreach ($request->attachments as $value) {
                        $extension = $value->getClientOriginalExtension();

                        $file = $value;
                        $filename = time() . $file->getClientOriginalName();
                        Storage::disk('local')->put('/public/staff/' . $filename, File::get($value));
                        $attachments = New QualilyAssuranceAttachments;

                        if($extension=='png' || $extension=='jpg' || $extension=='jpeg'){
                            $attachments->type = 1;
                        }else if($extension=='mp3'){
                            $attachments->type = 2;
                        }else{
                            $attachments->type = 3;
                        }
                        $attachments->qa_id = $data->id;
                        $attachments->attachment = $filename;
                        $attachments->save();
                    }
                }
                $success = 'Record has been updated.';
                return response()->json($success);
            } else {

                $data = New QualityAssurance;
                $data->title = $request->title;
                $data->description = $request->description;
                $data->user_id = $request->user_id;
                $data->userratings = $request->userratings;
                $data->asset_link = $request->asset_link;
                $data->qa_date = $request->qa_date;
                $data->createdby = $user_id;
                $data->save();
                if ($request->hasfile('attachments')) {
                    foreach ($request->attachments as $value) {
                        $file = $value;
                        $filename = time() . $file->getClientOriginalName();
                        Storage::disk('local')->put('/public/staff/' . $filename, File::get($value));
                        $attachments = New QualilyAssuranceAttachments;
                        $attachments->qa_id = $data->id;
                        $attachments->attachment = $filename;
                        $attachments->save();

                    }
                }
                $success = 'Record has been created.';
                return response()->json($success);
            }
        }

    }


    public function edit(Request $request)
    {
        $data = QualityAssurance::findOrFail($request->id);
        return response()->json($data);

    }


    public function Active(Request $request)
    {
        $data = QualityAssurance::findOrFail($request->id);
        $data->status = 'Active';
        $data->save();
        $message = 'Successfully Active.';
        return response()->json($message);

    }


    public function Disable(Request $request)
    {
        $data = QualityAssurance::findOrFail($request->id);
        $data->status = 'Disable';
        $data->save();
        $message = 'Successfully Disable.';
        return response()->json($message);

    }

    public function delete(Request $request)
    {
        $data = QualityAssurance::findOrFail($request->id);
        $data->is_deleted = 1;
        $data->save();
        $message = 'Successfully Delete.';
        return response()->json($message);

    }

    public function detail($id)
    {
        $qa_data = QualityAssurance::with('qa_attachments')->where('id', $id)->first();
        return view('qa.detail', compact('qa_data'));
    }


}
