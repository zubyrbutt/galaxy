<?php

namespace App\Http\Controllers;

use App\Salarysheet;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Datatables;

use \App\User;
use \App\Department;
use \App\Staffdetail;
use \App\Attendance;
use \App\Attendancesheet;
use \App\Hrlead;
use \App\Preference;
use \App\Holiday;
use Carbon;
use DateTime;

class SalarysheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->get('srchmonth')){
            $srchmonth=$request->get('srchmonth');
            $searchedMonth=$srchmonth."-01";
        }else{
            $firstday = new DateTime('first day of this month');
            $srchmonth=date("Y-m");
            $searchedMonth=$firstday->format('Y-m-d');
        }
        

        //Get Active Staff begins
        $deparment_id=array();
        if($request->get('deparment_id')){
            $deparment_id=explode(",", $request->get('deparment_id'));
            $employees=User::where('iscustomer',0)
                    ->where('status',1)
                    ->whereIn('department_id', $deparment_id)
                    /*->withCount(['deductions' => function ($query) use($searchedMonth)  {
                        $query->select(DB::raw('sum(amount)'))->where('status','Approved')->where('dated', $searchedMonth);
                    }])
                    ->withCount(['additions' => function ($query) use($searchedMonth) {
                        $query->select(DB::raw('sum(amount)'))->where('status','Approved')->where('dated', $searchedMonth);
                    }])
                    ->whereHas('staffdetails', function ($query) {
                        $query->where('showinsalary', '=', 1);
                    })*/
                    ->get();
            
            $salarydata=Salarysheet::where('dated',$searchedMonth)
                        ->whereHas('user', function ($query) use($deparment_id) {
                            $query->whereIn('department_id', $deparment_id);
                        });
                        
        }else{
            $salarydata=Salarysheet::where('dated',$searchedMonth);
            
        }
        if($request->get('status')){
            $status=$request->get('status');
            if($status=='Paid' || $status=='hold'){
                $salarydata=$salarydata->where('status',$status)->get();
            }else{
                $salarydata=$salarydata->whereIn('status',['Unpaid','Partial Payment'])->get();
            }
            
        }else{
            $status="";
            $salarydata=$salarydata->get();
        }

        //Get Active Staff ends
        
        //Get Deparments begins
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        //Get Deparments ends

        return view('staffpayroll.salarysheets',compact('salarydata','departments','deparment_id','srchmonth','status'));
        
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        foreach($request->get('paysalary') as $key => $id){
            $salaryid[]=$key;
        }
        if($request->get('forMonth')){
            $srchmonth=$request->get('forMonth');
            $searchedMonth=date("Y-m-d", strtotime($srchmonth."-01"));
        }else{
            $firstday = new DateTime('first day of this month');
            $srchmonth=date("Y-m");
            $searchedMonth=$firstday->format('Y-m-d');
        }
        $forMonth=$searchedMonth;

        if($request->get('holdsalaries')==1){
            $salarydata=Salarysheet::where('dated',$searchedMonth)
                                ->whereIn('id', $salaryid)
                                ->get();
            $status='hold';
            return view('staffpayroll.salarystatus',compact('salarydata','forMonth','status'));
        }elseif($request->get('unholdsalaries')==1){
            $salarydata=Salarysheet::where('dated',$searchedMonth)
                                ->whereIn('id', $salaryid)
                                ->get();
            $status='unhold';
            return view('staffpayroll.salarystatus',compact('salarydata','forMonth','status'));
        }else{        
            $salarydata=Salarysheet::where('dated',$searchedMonth)
                                ->whereIn('id', $salaryid)
                                ->where('status','!=', 'hold')
                                ->get();
            $banks=\App\Bank::where('status', 'Active')->get();
            return view('staffpayroll.paysalaries',compact('salarydata','forMonth','banks'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      
        //$this->authorize('create-department');
        $rules=[
            'forMonth' => 'required',
        ];
        $errormessage=['required'=>"Month is not selected."];

        if(empty($request->get('amountpay')) or empty($request->get('paymentmethod'))){
            return response()->json(['errors'=>'Validation error, submitted data is empty or not complete.']);
        }
        $users=array();
        foreach($request->get('salarysheet_id') as $user => $val){
            $users[]=$user;
        }
        
        $amountpay=$request->get('amountpay');
        $salarysheet_ids=$request->get('salarysheet_id');
        $paymentmethods=$request->get('paymentmethod');
        $bankid=$request->get('bankid');
        $chequenos=$request->get('chequeno');
        $remainings=$request->get('remaining');
        $dated=$request->get('forMonth');
        DB::beginTransaction();
        try{
            foreach($users as $user){
                if(!empty($bankid[$user])){
                    $bank_id=$bankid[$user];
                }else{
                    $bank_id=NULL;
                }
                if(!empty($chequenos[$user])){
                    $chequeno=$chequenos[$user];
                }else{
                    $chequeno=NULL;
                }
                if(!empty($salarysheet_ids[$user])){
                    $salarysheet_id=$salarysheet_ids[$user];
                }else{
                    $salarysheet_id=NULL;
                }
                if(!empty($amountpay[$user])){
                   $amountpaid=$amountpay[$user];
                }else{
                    $amountpaid=0;
                }
                if($amountpay[$user]==$remainings[$user]){
                    $paystatus="Paid";
                }else{
                    $paystatus='Partial Payment';
                }
                if(!empty($paymentmethods[$user])){
                    $paymentmethod=$paymentmethods[$user];
                }else{
                    $paymentmethod="cash";
                }
                $description=$paystatus." for the month of ". date("M-Y", strtotime($request->get('forMonth')));
                $date=date_create($request->get('date'));
                $format = date_format($date,"Y-m-d H:i:s");
                if($amountpaid > 0){
                    //Insert in Salary partial payment begins
                    $partialpay= new \App\Salarypartialpay;
                    $partialpay->dated=$dated;
                    $partialpay->description=$description;      
                    $partialpay->amountpaid=$amountpaid;
                    $partialpay->paymentmethod=$paymentmethod;
                    $partialpay->bank_id=$bank_id;
                    $partialpay->chequeno=$chequeno;
                    $partialpay->salarysheet_id=$salarysheet_id;
                    $partialpay->status="1";
                    $partialpay->user_id=$user;
                    $partialpay->created_by=auth()->user()->id;
                    $partialpay->modified_by=auth()->user()->id;
                    $partialpay->created_at = strtotime($format);
                    $partialpay->updated_at = strtotime($format);
                    $partialpay->save();
                    //Insert in Salary partial payment ends

                    //Updating the Main Salary sheet for that specific record of user begins 
                    $salary= SalarySheet::find($salarysheet_id);
                    $salary->status=$paystatus;
                    $salary->amountpaid=$salary->amountpaid+$amountpaid;
                    $salary->modified_by=auth()->user()->id;
                    $salary->updated_at=strtotime($format);
                    $salary->save();
                    //Updating the Main Salary sheet for that specific record of user ends
                }else{
                    //Updating the Main Salary sheet for that specific record of user begins 
                    $salary= SalarySheet::find($salarysheet_id);
                    $salary->status='Paid';
                    $salary->amountpaid=$salary->amountpaid+$amountpaid;
                    $salary->modified_by=auth()->user()->id;
                    $salary->updated_at=strtotime($format);
                    $salary->save();
                    //Updating the Main Salary sheet for that specific record of user ends
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();  
            return response()->json(['errors'=>'Unable to process your request this time, please again later. REASON: '.$e->getMessage()]);

        }

        return response()->json(['success'=>'Salary paid successfully to selected employees.']);
        

    }

    //Hold - Unhold Salaries
    public function status(Request $request)
    {
        //$this->authorize('create-department');
        $rules=[
            'forMonth' => 'required',
        ];
        $errormessage=['required'=>"Month is not selected."];

        if(empty($request->get('reason')) or empty($request->get('status'))){
            return response()->json(['errors'=>'Validation error, submitted data is empty or not complete.']);
        }
        $users=array();
        foreach($request->get('salarysheet_id') as $user => $val){
            $users[]=$user;
        }
        
        $statuses=$request->get('status');
        $salarysheet_ids=$request->get('salarysheet_id');
        $reasons=$request->get('reason');
        $dated=$request->get('forMonth');
        DB::beginTransaction();
        try{
            foreach($users as $user){
                if(!empty($statuses[$user])){
                    $status=$statuses[$user];
                }else{
                    $status=NULL;
                }
                if(!empty($reasons[$user])){
                    $reason=$reasons[$user];
                }else{
                    $reason=NULL;
                }
                if(!empty($salarysheet_ids[$user])){
                    $salarysheet_id=$salarysheet_ids[$user];
                }else{
                    $salarysheet_id=NULL;
                }
                
                $date=date_create($request->get('date'));
                $format = date_format($date,"Y-m-d H:i:s");
                    
                //Insert in Salary partial payment begins
                $salarystatus= new \App\Salarystatus;
                $salarystatus->dated=$dated;
                $salarystatus->reason=$reason;      
                $salarystatus->status=$status;
                $salarystatus->salarysheet_id=$salarysheet_id;
                $salarystatus->status="1";
                $salarystatus->user_id=$user;
                $salarystatus->created_by=auth()->user()->id;
                $salarystatus->modified_by=auth()->user()->id;
                $salarystatus->created_at = strtotime($format);
                $salarystatus->updated_at = strtotime($format);
                $salarystatus->save();
                //Insert in Salary partial payment ends

                //Updating the Main Salary sheet for that specific record of user begins 
                $salary= SalarySheet::find($salarysheet_id);
                $salary->status=$status;
                $salary->modified_by=auth()->user()->id;
                $salary->updated_at=strtotime($format);
                $salary->save();
                //Updating the Main Salary sheet for that specific record of user ends
                
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();  
            return response()->json(['errors'=>'Unable to process your request this time, please again later. REASON: '.$e->getMessage()]);

        }

        return response()->json(['success'=>'Status has been successfully updated for selected employees.']);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salarysheet  $salarysheet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        $payments = \App\Salarypartialpay::where('user_id', $request->get('user_id'))
                    ->where('salarysheet_id',$request->get('salarysheet_id'))
                    ->get();
        $user = \App\User::where('id', $request->get('user_id'))->first();
        $forMonth=$request->get('forMonth');
        if($request->ajax()) {
            return  view('staffpayroll.userpayments')->with(compact('payments','user','forMonth'));
            
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salarysheet  $salarysheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Salarysheet $salarysheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salarysheet  $salarysheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salarysheet $salarysheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salarysheet  $salarysheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salarysheet $salarysheet)
    {
        //
    }
}
 