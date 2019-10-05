<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Validator;
use App\User;
use App\Role;
use App\Extension;
use App\Studentdetail;
use App\Schedule;
use App\Invoice;
use App\Invoicedetail;
use App\Parentdetail;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$country = config('constants.country');
		$currency = config('constants.currency');	
/* 		$invoices = Invoice::with('createdby')->selectRaw('invoices.*, invoicedetails.*, 
		invoices.parent_name as p_name, invoicedetails.student_name as student_name,invoices.id as i_id ,
		SUM(invoicedetails.payment) as total_amount,SUM(invoicedetails.payment_local) as total_amount_local')
		->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')
		->where('invoices.paid_status','=','0')
		->groupBy('invoicedetails.invoice_id')
		->get(); */
		//echo $invoices[1]->p_name;
		//dd($invoices);
		$parent_country = \App\Parentdetail::all();
		$invoicedetails_students = \App\Invoicedetail::all();
		//
		$invoices = array();
		$parents=\App\User::where('iscustomer',2)->get();	
		$students=\App\User::where('iscustomer',3)->get();
		
			if($request->get('parentID') || $request->get('studentID') || $request->get('paid_status') || ($request->get('dateFrom') && $request->get('dateTo'))){
				$parentID = $request->get('parentID');
				$studentID = $request->get('studentID');
				$dateFrom = $request->get('dateFrom');
				$dateTo = $request->get('dateTo');	
				$paid_status = $request->get('paid_status');	
				$invoices = Invoice::with('createdby')->selectRaw('invoices.*, invoicedetails.*, 
				invoices.parent_name as p_name, invoicedetails.student_name as student_name,invoices.id as i_id ,
				SUM(invoicedetails.payment) as total_amount,SUM(invoicedetails.payment_local) as total_amount_local')
				->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')
				->where('invoices.paid_status','=',$paid_status)
				->when($parentID, function ($query) use ($parentID) {
									return $query->where('invoices.parent_id', $parentID);
								})	
				->when($studentID, function ($query) use ($studentID) {
									return $query->where('invoicedetails.studentID', $studentID);
								})
				->when($dateFrom, function ($query) use ($dateFrom) {
									return $query->where('invoices.invoice_date','>=', $dateFrom);
								})
				->when($dateTo, function ($query) use ($dateTo) {
									return $query->where('invoices.invoice_date','<=', $dateTo);
								})
							
				->groupBy('invoicedetails.invoice_id')
				->get();	
			}
			else{
				$invoices = array(); //empty array
			}
			
		return view('invoice.invoicelist',compact('invoices','parent_country','country','invoicedetails_students','currency',
		'parents','students'));		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*     public function edit($id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	
    public function invoicedetail_list($id)
    {
        //
		$invoice_id = $id;
		$currency = config('constants.currency');
		$course_list = \App\Courses::all();
		$invoicedetails = \App\Invoicedetail::where('invoice_id',$id)->with('parent_name')->with('teachername')->with('studentname')->get();
		$invoice = Invoice::where('invoice_id',$invoice_id)->first();
		$parentID = $invoice->parent_id;
		//Parent email
		$user = User::find($parentID)->first();
		$parent_email = $user->email;
		return view('invoice.invoicedetail_list',compact('invoicedetails','invoice','currency','course_list','invoice_id','parent_email'));		
    }

	//makeinvoicepayment	create
	public function makeinvoicepayment($invoiceid)
    {
        //
		$paymentMode=config('constants.paymentMode');
		$bankNameList=config('constants.bankNameList');
		$currency=config('constants.currency');  
		//
		$plan = config('constants.plan');
		$pakTime = config('constants.time');
		$stdStatus = config('constants.stdStatus');
		$country = config('constants.country');		
		//$show_schedule = \App\Schedule::with('teachername')->with('studentname')->with('coursename')->with('parent_name')->with('agentname')->with('parentdetail_relation')->find($id);
		//$students_list = \App\User::where('role_id',6)->where('id',$show_schedule->studentID)->get();
		
		//Student names from INVOICEDETAIL
		$url_arry=array();
		$student_invoice_name = \App\Invoicedetail::where('invoice_id',$invoiceid)->with('studentname')->get();
		foreach($student_invoice_name as $stu_inv_name){
					$fName 		= $stu_inv_name->studentname['fname'];
					$lName 		= $stu_inv_name->studentname['lname'];
					$url_arry[] = ucfirst($fName).' '.$lName;	
		}
		$chil_names = implode(' , ',$url_arry);
		//
		//total sum of the payment_local
		$invoicedetail_sum = \App\Invoicedetail::where('invoice_id',$invoiceid)->sum('payment_local');
		//
		$data = [
			'student_names' => $chil_names,
			'invoiceid' => $invoiceid,
			'invoicedetail_sum' => $invoicedetail_sum,
			//'country' => $country[$show_schedule->studentname->parent_name->parentdetail_relation['countryID']],
		];
		$teachers_list=\App\User::where('role_id',30)->get();
		$employees_list=\App\User::whereIn('role_id',[30,31])->get();
		
		//Code to preview invoice format while making payment
		$currency = config('constants.currency');
		$course_list = \App\Courses::all();
		$invoicedetails = \App\Invoicedetail::where('invoice_id',$invoiceid)->with('parent_name')->with('teachername')->with('studentname')->get();
		$invoice = Invoice::where('invoice_id',$invoiceid)->first();
		$parentID = $invoice->parent_id;
		//Parent email
		$user = User::find($parentID)->first();
		$parent_email = $user->email;		
		//
		
		return view('invoice.makeinvoicepayment',compact('id','data','paymentMode','bankNameList','currency','teachers_list','employees_list','invoicedetail_sum','invoicedetails','invoice','course_list','parent_email'));
    }
	
	//updateinvoicepayment		update
    public function updateinvoicepayment(Request $request)
    {
        //		
		$systemdate = systemDate();
		$signupChk = 0;
		$this->validate(request(), [
            'invoiceid' => 'required',
            
            'transactionID' => 'required',
            'method_id' => 'required|not_in:0',
            'currency_id' => 'required|not_in:0',
			
            'amountDefaultNew' => 'required',
            'amountOriginalNew' => 'required',
            'totalReceivedNew' => 'required',	
            'amountUsdSimpleNew' => 'required',
			
            'sender_name' => 'required',
            'email' => 'required',
/*             'agent_comm' => 'required',
            'teacher_comm' => 'required', */
            'comments' => 'required',
			'bank_payment_image' => 'nullable|mimes:jpeg,jpg,bmp,png|max:200',
        ]);
        if($request->hasfile('bank_payment_image'))
         {
            $file = $request->file('bank_payment_image');
            $slip_image=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/slips', $slip_image);
         }else{
            $slip_image="";
         }		
	
		
		//invoice table + transaction data [but all data will be saved in invoices table]
		$invoiceid = $request->get('invoiceid');
		//Checking if schedules are trial,so making them REGULAR/SIGNUP
		$schedule_ids = \App\Invoicedetail::where('invoice_id',$invoiceid)->with('studentname')->get();
		foreach($schedule_ids as $schedule_id){
					$update_std_status = \App\Schedule::find($schedule_id->schedule_id);
					$update_std_status->std_status;
					if($update_std_status->std_status==1){
						$update_std_status->std_status=2;
						$date=date_create($request->get('date'));
						$format = date_format($date,"Y-m-d");		
						$update_std_status->updated_at = strtotime($format);
						$update_std_status->save();
						//Text statement
						$std_status_updated_statement = 'with Trial to Regular';
						//signupChk
						$signupChk=1;
					}
					else{
						$std_status_updated_statement = '';
					}
		}	
		
		
		//dd($schedule_ids);
		
		$invoice= \App\Invoice::where('invoice_id',$invoiceid)->first();
		$date=date_create($request->get('date'));
		$format = date_format($date,"Y-m-d");			
		$invoice->paid_status = 1;
		
		$invoice->pay_method = $request->get('method_id');
		$invoice->payment_received = $request->get('amountUsdSimpleNew');
		$invoice->payment_received_local = $request->get('totalReceivedNew');

		$invoice->invoice_paid_date = strtotime($format);	
		$invoice->updated_at = strtotime($format);	
		$invoice->dateReceived = strtotime($format);
		//$invoice->dateMonth = $request->get('invoice_paid_date');
		//make a loop here of the schedules,so that their paydate must be updated according to the invoice months
		foreach($schedule_ids as $schedule_id){
					$update_sch_paydate = \App\Schedule::find($schedule_id->schedule_id);
					//Schedule
					$date = $update_sch_paydate->paydate;echo "<br>";				
					//Invoicedetail values
					$add_months = $schedule_id->months;
					$add_days = $schedule_id->days;
					//
					$paydate_updated = date('Y-m-d', strtotime($date . "+".$add_months." months") );
					//Updating schedule paydate
					$update_sch_paydate->paydate = $paydate_updated;
					$date = date_create($request->get('date'));
					$format = date_format($date,"Y-m-d");		
					$update_sch_paydate->updated_at = strtotime($format);
					$update_sch_paydate->save();
		}			
		
		$invoice->receive_code = $request->get('transactionID');
		$invoice->method_array = $request->get('method_id');
		$invoice->currency_array = $request->get('currency_id');
		if($signupChk==1){
			$invoice->signupChk = 1;
		}
		$invoice->comments = $request->get('comments');
		
		$invoice->sender_name = $request->get('sender_name');
		//$invoice->email = $request->get('email');
		//$invoice->agentId = $agentId;
		$invoice->agent_comm = $request->get('agent_comm');
		$invoice->teacher_comm = $request->get('teacher_comm');
		$invoice->cardSave_ccv_code = $request->get('cardSave_ccv_code');
		$invoice->VirtualTerminal_name = $request->get('VirtualTerminal_name');
		$invoice->VirtualTerminal_number = $request->get('VirtualTerminal_number');
		$invoice->slipImage = $slip_image;
		$invoice->bankNameId = $request->get('bankNameId');	
		//Amounts
		//Org Currency
		$invoice->amountDefaultNew = $request->get('amountDefaultNew');
		$invoice->amountOriginalNew = $request->get('amountOriginalNew');
		$invoice->feeDeductNew = $request->get('feeDeductNew');
		$invoice->totalReceivedNew = $request->get('totalReceivedNew');
		$invoice->discountNew = $request->get('discountNew');
		$invoice->additionalFee = $request->get('additionalFee');
		//USD Currency
		$invoice->amountDefaultNew_Usd = $request->get('amountDefaultNew_Usd');
		$invoice->amountOriginalNew_Usd = $request->get('amountOriginalNew_Usd');
		$invoice->feeDeductNew_Usd = $request->get('feeDeductNew_Usd');
		$invoice->totalReceivedNew_Usd = $request->get('amountUsdSimpleNew');
		$invoice->discountNew_Usd = $request->get('discountNew_Usd');
		$invoice->additionalFee_Usd = $request->get('additionalFee_Usd');
		$date=date_create($request->get('date'));
		$format = date_format($date,"Y-m-d");		
		$invoice->updated_at = strtotime($format);
		$invoice->save();
		return redirect('invoice/')->with('success', 'Invoice Paid successfully '.$std_status_updated_statement);
	}
	
	
	
	
//Add reminder 		//start	
    public function invoice_reminder(Request $request)
    {
        //
		//$this->authorize('edit-parents');
        $data = Invoice::findOrFail($request->id);
		//dd($data);exit;
        return response()->json($data);
		
    }	
    public function reminder_update(Request $request)
    {
        //
		//$this->authorize('edit-parents');
		//dd($request);
        $invoice_reminder = \App\Invoice::findOrFail($request->get('id'));
        $rules=[
			
            'invoice_id' => 'required',
            'comments_reminder' => 'required',
            'date_reminder' => 'required',
			
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
	
		$invoice_reminder->comments_reminder=$request->get('comments_reminder');
        $invoice_reminder->date_reminder=$request->get('date_reminder');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $invoice_reminder->updated_at = strtotime($format);
		$invoice_reminder->save();
			
        return response()->json(['success'=>'Invoice Reminder updated successfully .']);
	
    }	
//Add reminder 		//end

//invoice_deadconfirmation		//start
    public function invoice_deadconfirmation($parent_id)
    {
        //
		$plan = config('constants.plan');		
		$dead_reason = config('constants.dead_reason');
		$currency = config('constants.currency');
		$course_list = \App\Courses::all();
		$parent_id;

        $parents = User::findOrFail($parent_id);
		$student_details=\App\User::with('role')->with('createdby_self')->where('iscustomer',3)
		->where('parent_id',$parent_id)->get();

		//using select in place of selectRaw fixes the bug
		$invoice_deadconfirmation = Schedule::with('teachername')
		->select('schedules.*' , 'users.*' , 'schedules.id as sch_id')
		->join('users', 'users.id', '=', 'schedules.studentID')
		->where('users.parent_id',$parent_id)
		->where('schedules.status','1')->where('schedules.status_dead','0')->whereIn('schedules.std_status',[1, 2])		
		->get();	
        return view('invoice.invoice_deadconfirmation',compact('invoice_deadconfirmation','plan','dead_reason',
		'parents','student_details','currency','course_list'));	
    }	
//invoice_deadconfirmation		//end

//invoice_dead		//start
    public function invoice_dead(Request $request)
    {
        //
		$this->validate(request(), [
            'parentID' => 'required',
            'schedule_id_list' => 'required',
			'dead_reason' => 'required|not_in:0',			
        ]);		
		$parentID = $request->get('parentID');
		$schedule_id_list = $request->get('schedule_id_list');	
		foreach($schedule_id_list as $key => $schedule_id){
			$schedule=\App\Schedule::findOrFail($schedule_id);
			if($schedule->status==1){
				$schedule->dead_reason=$request->dead_reason;
				$schedule->status_dead=1;
				$date=now();
				$format = date_format($date,"Y-m-d H:i:s");
				$schedule->dead_date = strtotime($format);
				$schedule->dead_by = auth()->user()->id;
				$schedule->modified_by = auth()->user()->id;
				$schedule->updated_at = strtotime($format);
				$schedule->save();	
			}
		}
		return redirect()->action(
					'ScheduleController@deadconfirmation_list'
				)->with('success', 'Schedule Moved to DC List.');
    }
//invoice_dead		//end

}

