<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\InventoryCategory;
use App\Paypalwithdrawal;
use App\Preference;
use App\User;
use Auth;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\DB;
use Validator;

class PaypalwithdrwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $totalamount=0;
    public $totalcompleted=0;
    public $totalpending=0;
    public function index()
    {
        return view('paypalwithdrwal.index');
    }

   

    public function fetch(Request $request){
        $authUser = auth()->user()->id;
    	if($request->filterdata){
    		$fromdate = $request->filterdata[0]['value'];
        $todate = $request->filterdata[1]['value'];
    		$status = $request->filterdata[2]['value'];
    		$data = Paypalwithdrawal::where('is_deleted',0)
    								->where(function($query) use ($fromdate,$todate,$status){
                      if(!empty($fromdate)){
                        $query->where('withdraw_date','>=',$fromdate);
                      }
                      if(!empty($todate)){
                        $query->where('withdraw_date','<=',$todate);
                      }
                      if($status !=="none"){
                        $query->where('status',$status);
                      }
                    })->get();
    	}else{
        	$data = Paypalwithdrawal::where('is_deleted',0)
          ->whereMonth('withdraw_date',date("m"))
          ->orderBy('id','asc')
          ->get();
    	}
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Pending') {
            $this->totalpending = $this->totalpending + $data->amount;
            return '<span class="label label-danger">Pending</span>';
          }else if($data->status=='Completed'){
            $this->totalcompleted = $this->totalcompleted + $data->amount;
            return '<span class="label label-success">Completed</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
        ->addColumn('options',function($data){
            $action = '<span style="float: right;">';
            if(Auth::user()->can('paypalwithdrwal-edit')){
                $action .= "<a style='margin:0 10px;' class='btn btn-success edit_model' href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>";
            }
            if($data->status=='Completed'){
                if(Auth::user()->can('paypalwithdrwal-disable')){

                    $action .= "<a style='margin:0 10px;' data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>";
                }
            }else if ($data->status=='Pending'){
                if(Auth::user()->can('paypalwithdrwal-active')){
                    $action .="<a style='margin:0 10px;' data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>";
                }
            }
            if(Auth::user()->can('paypalwithdrwal-delete')){
                $action .= "<a style='margin:0 10px;' data-toggle='tooltip' data-placement='bottom' title='Delete' class='btn btn-danger delete' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-trash'></i></a>";
            }
            $action .= '</span>';
            return $action;

        })
      ->addColumn('totalamount',function($data){
            $this->totalamount = $this->totalamount+$data->amount;
            return $this->totalamount;
      })  
     	->addColumn('withdraw_date',function($data){
     		return date("d-M-Y", strtotime($data->withdraw_date));
     	})
      ->rawColumns(['created_at', 'status','options','withdraw_date','totalamount'])
      ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'amount' => 'required',
            'withdraw_date' => 'required',
        );

        $data = [
            'amount' => trim($request->get('amount')),
            'withdraw_date' => $request->withdraw_date,
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else{
            $user_id = Auth::user()->id;
            $withdraw_date = date("Y-m-d", strtotime($request->withdraw_date));
         
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
                $data = Paypalwithdrawal::findOrFail($request->edit_id);
                $data->amount = $request->amount;
                $data->modifiedBy     = $user_id;
                $data->withdraw_date = $withdraw_date;
                $data->save();
                $success = 'WithDrwal has been updated.';
                return response()->json($success);
            }else{
                $creator=auth()->user()->fname.' '.auth()->user()->lname;
                $ppwdn = Preference::where('option','paypalwithdrawalnotification')->first();
                $ppwd_user_ids = explode(',',$ppwdn->value);
                $users = User::whereIn('id',$ppwd_user_ids)->get();
                $when = Carbon::now()->addSecond();
                $information = collect(['title' => 'New Withdrawal','body'=>'A new Withdrawal of '.$request->amount.' has been made by '.$creator,'redirectURL'=>'#']);
                Notification::send($users, (new \App\Notifications\PaypalWithdrawal($information))->delay($when));
                $data = New Paypalwithdrawal;
                $data->amount = $request->amount;
                $data->createdBy     = $user_id;
                $data->withdraw_date = $withdraw_date;
                $data->status     = 'Pending';
                $data->save();
                $success = 'WithDrwal has been created.';
                return response()->json($success);
           }
       }
    
    }

    
    public function edit(Request $request)
    {
      $data = Paypalwithdrawal::findOrFail($request->id);
      return response()->json($data);

    }


    public function paypalActive(Request $request)
    {
      $data = Paypalwithdrawal::findOrFail($request->id);
      $data->status = 'Completed';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function paypalDisable(Request $request)
    {
      $data = Paypalwithdrawal::findOrFail($request->id);
      $data->status = 'Pending';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);
    }

    public function delete(Request $request)
    {
      $data = Paypalwithdrawal::findOrFail($request->id);
      $data->is_deleted = 1;
      $data->save();
      $message = 'Successfully Delete.';
      return response()->json($message);

    }

}
