<?php

namespace App\Http\Controllers;
use Mail;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use PDF;
use Illuminate\Support\Facades\Storage;
use File;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$parent_details=\App\User::with('role')->with('parentdetail_relation')->where('iscustomer',2)->get();
		//$roles = Role::where('status', 1)->get();
		//
		$country_list = config('constants.country');
		//dd($parent_details);
		return view('parents.index',compact('parent_details','country_list'));
    }
	
	
	public function fetch(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'fname',
							2 =>'lname',
                            3=> 'email',
                            4=> 'phonenumber',						
                            6=> 'status',
							7=> 'countryID',
							8=> 'ext_id',
                            9=> 'id',
                            
                        );
$country_list = config('constants.country');
         $totalData = User::where('iscustomer',2)->count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            
                $data = User::offset($start)->limit($limit)
						->where('iscustomer',2)
                         ->orderBy($order, $dir)
                         ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = User::where('id', 'LIKE', '%' . $search . '%')
								->where('iscustomer',2)
                              ->orwhere('fname', 'LIKE', '%' . $search . '%')
							  ->orwhere('lname', 'LIKE', '%' . $search . '%')
							  ->orwhere('email', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
							  ->orwhere('phonenumber', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();


            $totalFiltered = User::where('id', 'LIKE', '%' . $search . '%')
							  ->where('iscustomer',2)
                              ->orwhere('fname', 'LIKE', '%' . $search . '%')
							  ->orwhere('lname', 'LIKE', '%' . $search . '%')
							  ->orwhere('email', 'LIKE', '%' . $search . '%')							  
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
							  ->orwhere('phonenumber', 'LIKE', '%' . $search . '%')							  
                              ->count();               
           
        }


        $dataArray = array();
        if(!empty($data))
        {
            foreach ($data as $row)
            {
                $id = $row->id;               
                $nestedData['id']  = $row->id;
                $nestedData['fullname'] = $row->fname." ".$row->lname;
                $nestedData['email'] = $row->email;
                $nestedData['phonenumber'] = $row->phonenumber;
                $nestedData['status'] = $row->status;			
				if($country_list!=''){
					foreach($country_list as $key => $country){
						if($row->parentdetail_relation['countryID']==$key){
							$nestedData['countryID']=$country;
						}
					}
				}				
				$nestedData['ext_id'] = $row->parentdetail_relation['ext_id'];
                $statusaction="";
                $editdept="";
                $deletedept="";
				$showdept="";
				$invoice="";
				
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">Active</span>';
                  if(Auth::user()->can('status-parents')){
                    $statusaction="<a class='btn btn-danger status' href='#' data-id='{$id}' data-action='2' title='Change status'><i class='fa fa-times'></i></a>";
                  }
                }else if($row->status=='2'){
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Deactive</span>';
                  if(Auth::user()->can('status-parents')){
                    $statusaction="<a class='btn btn-warning status' href='#' data-id='{$id}' data-action='1' title='Change status'><i class='fa fa-check'></i></a>";
                  }
                }
                if(Auth::user()->can('show-parents')){
                    $showdept="<a class='btn btn-primary showparent' href='javascript:void(0)' data-id='{$id}' data-status='2' title='Details'><i class='fa fa-eye'></i></a> ";
                }				
                if(Auth::user()->can('edit-parents')){
                    $editdept="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}' title='Edit'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('delete-parents')){
                    $deletedept=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('UserController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }

                if(Auth::user()->can('createinvoice')){
                    //$invoice="<a class='btn btn-success showparentInvoice' href='javascript:void(0)' data-id='{$id}' data-status='2' title='Details'><i class='fa fa-newspaper-o'></i></a> ";					
					$invoice="<a class='btn btn-success' href=".url('parents/createinvoice/'.$id)."   title='Create Invoice'><i class='fa fa-newspaper-o'></i></a> ";
                
					
                }
				
                $nestedData['options'] = $showdept.$editdept.$statusaction.$deletedept.$invoice;                             
                
                $dataArray[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $dataArray   
                    );
          return response()->json($json_data);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //OLD code without SERVERSIDE DATATABLES
/* 		$roles = \App\Role::all();
		$extensions_list = \App\Extension::with('showusername')->where('status',2)->get();
        return view('parents.create',compact('roles','extensions_list')); */		
		exit;
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
		//NOTE: For Parent, iscutomer=3, role_id=4
        $this->authorize('create-parents');
        $rules=[
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phonenumber' => 'required',
			//'extension_id' => 'required',
			'countryID' => 'required',
			
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

		
/////////////////////////////////   Curl for AUTO GENERATION EXT IDs - Dialer 360		//start
	//Removing dashes from phone numbers
	$phone = preg_replace('/\D+/', '', $request->get('phonenumber'));
	$phone = ltrim($phone, '0');
	if($phone!=''){
		$numberstr=$phone;
	}
	//country for dialer 360
	$country_list = config('constants.country');
	if($country_list!=''){
		foreach($country_list as $key => $country){
			if($request->get('countryID')==$key){
				$country_name=$country;
			}
		}
	}
	//
	$fname = $request->get('fname');
	$lname = $request->get('lname');
	$parentname = $fname."".$lname;
	
$url = "http://fortunes.dialer360.com/adminpanel/api.php?source=test&user=fortunes&pass=OS1jNBtty4&function=add_lead&phone_number=13108070217&phone_code=1&list_id=22334455&first_name=&last_name=".$parentname."&address1=&city=".$country_name."&state=IL&comments=".$numberstr."";
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL,$url); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    // Set the API parameters for this transaction
    //curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
    // Request response from PayPal
    $response = curl_exec( $ch );
    //print_r($response);
	$str = $response;
	$output = explode(":",$str);
	//If success , then insert into campus_voice_ext table
		if($output[0]=='SUCCESS'){
			//$ext_id = $request->get('extension_id');
			$output_ext = explode("|",$output[1]);
			$parent= new \App\User;
			$parent->fname=$request->get('fname');
			$parent->lname=$request->get('lname');
			$parent->email=$request->get('email');
			//$parent->role_id=4;
			$parent->password=Hash::make($request->get('password'));
			$parent->phonenumber=$request->get('phonenumber');
			$parent->iscustomer=2;
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$parent->created_at = strtotime($format);
			$parent->updated_at = strtotime($format);
			$parent->createdby = auth()->user()->id;
			//$parent->ext_id=$request->get('extension_id');
			$parent->save();
			$last_parent_id = $parent->id;
			//Updating EXT ID status
			//$update_ext_status = \DB::table('extensions') ->where('id', $ext_id)->update( [ 'status' => 1 ]);
			//Insert country in Parentdetail
			$parent_details = new \App\Parentdetail;
			$parent_details->countryID = $request->get('countryID');
			$parent_details->ext_id = $output_ext[2];
			$parent_details->created_at = strtotime($format);
			$parent_details->updated_at = strtotime($format);
			$parent_details->user_id = $last_parent_id;
			$parent_details->save();
			//$last_parent_id = 97;
			return response()->json(['success'=>'New Parent created successfully.','parent_id'=>$last_parent_id,'output_dialer'=>$output[0]]);
		}
		else{
			return response()->json(['error'=>'Parent cannot be created - Api Hit UnSuccessful.','output_dialer'=>$output[0]]);
		}
    }
	
	
	public function studentformparent_index()
    {
        //return view('parents.studentformparent');
    }
	
    public function studentformparent($last_parent_id)
    {
        //
		$last_parent_id;
		$parent_name=\App\User::find($last_parent_id);
		//Students under current parent
		$student_details=\App\User::with('role')->where('iscustomer',3)->where('parent_id',$last_parent_id)->get();
		return view('parents.studentformparent',compact('last_parent_id','parent_name','student_details'));
    }	 
    public function studentparent_store(Request $request)
    {
        //
        $this->authorize('create-studentparent');
        $rules=[
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
			'gender' => 'required',
			'dob' => 'required',
			'parent_id' => 'required',
			
        ];
		$errormessage=['required'=>"All fields required.", 'unique'=>"Username must be unique."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $studentparent_store= new \App\User;
        $studentparent_store->fname=$request->get('fname');
        $studentparent_store->lname=$request->get('lname');
        $studentparent_store->email=$request->get('email');
        //$studentparent_store->password=$request->get('password');
        $studentparent_store->password=Hash::make($request->get('password'));
        //$studentparent_store->role_id=6;
		$studentparent_store->iscustomer=3;
		$studentparent_store->parent_id=$request->get('parent_id');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $studentparent_store->created_at = strtotime($format);
        $studentparent_store->updated_at = strtotime($format);
		$studentparent_store->createdby = auth()->user()->id;
        $studentparent_store->save();
		//Getting last inserted user id to be used in Studentdetail
		$last_student_id = $studentparent_store->id;
		
        $studentdetail= new \App\Studentdetail;
        $studentdetail->user_id=$last_student_id;
        $studentdetail->gender=$request->get('gender');
		$dob = date_create($request->get('dob'));
        $dob = date_format($dob,"Y-m-d");
		$studentdetail->dob=$dob;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $studentdetail->created_at = strtotime($format);
        $studentdetail->updated_at = strtotime($format);
		$studentdetail->save();			
		
        return response()->json(['success'=>'New Student created against Parent successfully.']);		
    }	

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $this->authorize('show-parents');
        /* if(!empty($request->showstatus)){
            $showstatus=$request->showstatus;
        }else{
            $showstatus=0;
        } */
        $parents = User::findOrFail($request->id);
		$student_details=\App\User::with('role')->with('createdby_self')->with('student_paydate')->where('iscustomer',3)->where('parent_id',$request->id)->get();
		//dd($student_details);
        //$hrleadstatus = Hrleadstatus::where('hrlead_id',$request->id)->get();
		$addressbooks = \App\Addressbook::with('createdby')->where('user_id',$request->id)->where('type',1)->get();
		$addressbooksphone = \App\Addressbook::with('createdby')->where('user_id',$request->id)->where('type',2)->get();
		
        if($request->ajax()) {
            return  view('parents.showajax')->with(compact('parents','student_details','addressbooks','addressbooksphone'));
            
        }		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
/* 		$parent_edit = \App\User::find($id);
		$roles = \App\Role::all();
		$extensions = \App\Extension::where('status',2)->get();
		return view('parents.edit',compact('id','parent_edit','roles','extensions'));
		 */
		$this->authorize('edit-parents');
        $data = User::with('parentdetail_relation')->findOrFail($request->id);
		//dd($data);exit;
        return response()->json($data);
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$this->authorize('edit-parents');
        $parent = \App\User::findOrFail($request->get('id'));
        $rules=[
			
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email,'.$parent->id,
            'phonenumber' => 'required',
			'extension_id' => 'required',
			'countryID' => 'required',			
			
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
	
		$ext_id = $request->get('extension_id');
        $parent->fname=$request->get('fname');
        $parent->lname=$request->get('lname');
        $parent->email=$request->get('email');
        $parent->phonenumber=$request->get('phonenumber');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $parent->updated_at = strtotime($format);
		$parent->updatedby = auth()->user()->id;
		//$parent->ext_id=$request->get('extension_id');
        $parent->save();
		//update parentdetails table
		$parent_details = \App\Parentdetail::where('user_id', '=', $request->get('id'))->firstOrFail();        		
		$parent_details->countryID = $request->get('countryID');
        $parent_details->ext_id=$request->get('extension_id');
		$parent_details->updated_at = strtotime($format);
		$parent_details->save();			
        return response()->json(['success'=>'Parent updated successfully CNTRLER.']);
        //return response()->json(['success'=>'Lead updated successfully.']);
		
		
    }

    //For Deactivate
    public function deactivate(Request $request)
    {
        $this->authorize('status-parents');
        $id=$request->get('id');
        $parents=\App\User::findOrFail($id);         
        $parents->status=2;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $parents->updated_at = strtotime($format);
		$parents->save();
        return response()->json(['success'=>'Parents updated successfully.']);
    }
    //For Active
    public function active(Request $request)
    {
        $this->authorize('status-parents');
        $id=$request->get('id');
        $parents=\App\User::findOrFail($id);         
        $parents->status=1;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $parents->updated_at = strtotime($format);
		$parents->save();
        return response()->json(['success'=>'Parents updated successfully.']);
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

//createinvoice		//start
    public function createinvoice(Request $request)
    {
        //
        $parents = User::findOrFail($request->id);
		$student_details=\App\User::with('role')->with('createdby_self')->where('iscustomer',3)
		->where('parent_id',$request->id)->get();
		$parent_id = $request->id;
		$course_list = \App\Courses::all();

		$schedules = DB::table('users')
            ->join('schedules', 'users.id', '=', 'schedules.studentID')
            ->select('users.*', 'schedules.*', 'users.fname as fname', 'users.lname as lname','schedules.id as sch_id' )
			->where('users.parent_id',$request->id)
			->where('schedules.status','1')->where('schedules.status_dead','0')->whereIn('schedules.std_status',[1, 2])
			->get();
//Stackoverflow answer, 
//1) find students via parent_id in users table
//2) We will get an array instance of students with id of students, which we will find against studentID in schedules table
/* $schedules = User::with(["schedules" => function ($query) {
$query->whereStatusAndStatusDead(1, 0)
	 ->whereIn('std_status', [1, 2]);
}])
->byParent($request->id)
->get(); */
			
		
		$currency = config('constants.currency');		
		return  view('invoice.list')->with(compact('parents','student_details','schedules','currency','course_list'));
    }
//createinvoice		//end
	
//invoicepreview		//start
    public function invoicepreview(Request $request)
    {
        //
		$this->validate(request(), [
            'parentID' => 'required',
            'child_list' => 'required'
        ]);		
		$parentID = $request->get('parentID');
		$childs = $request->get('child_list');		

		$months = $request->get('months');
		$days = $request->get('days');		
		
		$parents = User::findOrFail($parentID);
		$parents_email = $parents->email;
		$student_details=\App\User::with('role')->with('createdby_self')->where('iscustomer',3)
		->where('parent_id',$parentID)->get();

		//Variables defined
		$month_ary = array();
		$day_ary = array();
		$amount_to_send_sum_ary = array();
		$amount_to_send_local_curreny_sum_ary = array();
		$currency_grand_total = 0;
		$grand_total = 0;
		
	 	foreach($childs as $key => $child_id){
			$amount_to_send						=		0;
			$amount_to_send_local_curreny		=		0;
			//echo "values:";echo $child_id;echo "<br>";
			//Making arrays of MONTHS and DAYS of the invoice	//start
			$months = $request->get('months_'.$child_id);
			$days = $request->get('days_'.$child_id);
			$months_ary[$child_id] = (int)$months;
			$days_ary[$child_id] = (int)$days;
			//Making arrays of MONTHS and DAYS of the invoice	//end
			
			$amount_to_send_sum = $request->get('send_amount_'.$child_id);
			$amount_to_send_local_curreny_sum = $request->get('send_local_amount_'.$child_id);
			
			$amount_to_send_sum_ary[$child_id] = $request->get('send_amount_'.$child_id);
			$amount_to_send_local_curreny_sum_ary[$child_id] = $request->get('send_local_amount_'.$child_id);
			
			$amount_to_send_local_curreny_monthly_fee[$child_id] = $request->get('local_orignal_'.$child_id);			
			
			$grand_total += (round($amount_to_send_sum));
			$currency_grand_total += (round($amount_to_send_local_curreny_sum));
		}
		
		$course_list = \App\Courses::all();
		$schedules = DB::table('users')
            ->join('schedules', 'users.id', '=', 'schedules.studentID')
			//->join('transactions', 'transactions.studentID', '=', 'schedules.studentID')
            ->select('users.*', 'schedules.*' , 'users.fname as fname', 'users.lname as lname','schedules.id as sch_id',
			'users.id as studentIDPARENT')
			->where('users.parent_id',$parentID)
			->where('schedules.status','1')->where('schedules.status_dead','0')
			->whereIn('schedules.std_status',[1, 2])
			->whereIn('schedules.id',$childs)
			//->whereIn('transactions.schedule_id',$childs)
			//->orderBy('transactions.dateMonth', 'desc')
			->get();

		$currency = config('constants.currency');		
        return  view('invoice.invoice_preview')->with(compact('parents','schedules','currency','course_list',
		'childs','amount_to_send','amount_to_send_local_curreny',
		'months_ary','days_ary','parents_email',
		'amount_to_send_sum_ary','amount_to_send_local_curreny_sum_ary','amount_to_send_local_curreny_monthly_fee',
		'grand_total','currency_grand_total'));
    }
//invoicepreview		//end	

//saveinvoice		//start
    public function saveinvoice(Request $request)
    {
        //
		$this->validate(request(), [
            'parentID' => 'required',
            'child_list' => 'required',
			'schedule_id_list' => 'required',
			'invoice_id' => 'required',
			
        ]);		
		
		$parentID = $request->get('parentID');
		$schedule_ids = $request->get('schedule_id_list');
		//Will use this later, to check that all currencies are equal under 1 parent 
		$curr_ary_val = $request->get('curr_ary_val');

		//echo "INV ID:";
		$invoice_id = $request->get('invoice_id');
		$invoice_email = $request->get('invoice_email');
		
		$parents = User::findOrFail($parentID);
		$parentname = $parents->fname." ".$parents->lname;

		//Variables defined
		$month_ary = array();
		$day_ary = array();
		$amount_to_send_sum_ary = array();
		$amount_to_send_local_curreny_sum_ary = array();
		$currency_grand_total = 0;
		$grand_total = 0;
		
		//invoice table
		$invoice= new \App\Invoice;
		$invoice->invoice_id = $invoice_id;
		$invoice->parent_id = $parentID;
		$invoice->parent_name = $parentname;
		$duedate = date_create($request->get('duedate'));
		$duedate = date_format($duedate,"Y-m-d");
		$invoice->due_date = strtotime($duedate);
		$invoice->paid_status = 0;
		$date = date_create($request->get('date'));
		$format = date_format($date,"Y-m-d");
		$invoice->invoice_date = strtotime($format);
		$invoice->invoice_email = $request->get('invoice_email');
		$invoice->created_by = auth()->user()->id;
		$invoice->created_at = strtotime($format);
		$invoice->updated_at = strtotime($format);
		$invoice->save();
		
		//using schedule_id for schedule id's, I can also use child_list BUT NOT USING THAT
	 	foreach($schedule_ids as $key => $schedule_id){
			$amount_to_send						=		0;
			$amount_to_send_local_curreny		=		0;
			//Getting values from schedules table
			$schedule_val = Schedule::with('studentname')->findOrFail($schedule_id);
			$schedule_ary[$schedule_id] = $schedule_val;
			
			//echo "values:";
			$schedule_id;
			//Making arrays of MONTHS and DAYS of the invoice	//start
			$months = $request->get('months_'.$schedule_id);
			$days = $request->get('days_'.$schedule_id);
			$months_ary[$schedule_id] = (int)$months;
			$days_ary[$schedule_id] = (int)$days;
			//Making arrays of MONTHS and DAYS of the invoice	//end
			
			//Arrays for sum of the GRAND TOTAL and CURR GRAND TOTAL
			$amount_to_send_sum = $request->get('send_amount_'.$schedule_id);
			$amount_to_send_local_curreny_sum = $request->get('send_local_amount_'.$schedule_id);
			
			//Arrays to be sent as parameter to the MAILING METHOD/CLASS
			$amount_to_send_sum_ary[$schedule_id] = $request->get('send_amount_'.$schedule_id);
			$amount_to_send_local_curreny_sum_ary[$schedule_id] = $request->get('send_local_amount_'.$schedule_id);			
			
			$amount_to_send_local_curreny_monthly_fee[$schedule_id] = $request->get('send_local_amount_monthly'.$schedule_id);			
			
			$curr_ary = $request->get('curr_ary'.$schedule_id);
			$schedule_id;
			$schedule_val->studentID;
			$student_name = \App\User::find($schedule_val->studentID);
			
			$stu_name = $student_name->fname." ".$student_name->lname;
			
			$grand_total += (round($amount_to_send_sum));
			$currency_grand_total += (round($amount_to_send_local_curreny_sum));
			
			$agentId = $request->get('agentId'.$schedule_id);			
			
			
			//invoicedetail table
			$invoicedetail= new \App\Invoicedetail;
			$invoicedetail->invoice_id = $invoice_id;
			$invoicedetail->parent_id = $parentID;
			$invoicedetail->teacherID = $schedule_val->teacherID;
			$invoicedetail->studentID = $schedule_val->studentID;
			$invoicedetail->student_name = $stu_name;
			$duedate = date_create($schedule_val->paydate);
			$duedate = date_format($duedate,"Y-m-d");
			$invoicedetail->due_date = strtotime($duedate);
			
			$invoicedetail->monthly_fee = $amount_to_send_local_curreny_monthly_fee[$schedule_id];
			$invoicedetail->months = (int)$months;
			$invoicedetail->days = (int)$days;
			
			$invoicedetail->payment = $amount_to_send_sum;
			$invoicedetail->payment_local = $amount_to_send_local_curreny_sum;
			$invoicedetail->invoice_date = strtotime($format);
			$invoicedetail->currency = $curr_ary;
			$invoicedetail->schedule_id = $schedule_id;
			$invoicedetail->agentId = $agentId;
			
			
			$invoicedetail->created_at = strtotime($format);
			$invoicedetail->updated_at = strtotime($format);
			$invoicedetail->save();
			
		}
		$currency = config('constants.currency');
		$course_list = \App\Courses::all();		
		      $data = array('invoice_id'=>$invoice_id,'parents'=>$parents,'schedules'=>$schedule_ary,'schedule_ids'=>$schedule_ids,
			  'currency'=>$currency,'course_list'=>$course_list,
			  'months_ary'=>$months_ary,'days_ary'=>$days_ary,
			  'amount_to_send_local_curreny_sum_ary'=>$amount_to_send_local_curreny_sum_ary,
			  'currency_grand_total'=>$currency_grand_total);
			  Mail::send('invoice.invoice_to_be_sent', $data, function($message) use ($invoice_email, $parentname) 
			  {
				  $message->to($invoice_email, $parentname)->subject
				  ('Paypal Invoice');
				  $message->from('info@nsol.sg','NSOL');
			  });
		//echo "HTML Email Sent. Check your inbox.";
		return redirect('invoice/')->with('success', 'Invoice Generated Successfully.');

    }
//saveinvoice		//end	

//create invoice detail		//start
    public function create_invoice_detail_without_login(Request $request)
    {
        //
		$env_notify_url = config('app.ycc_ipn');
 		$this->validate(request(), [
			'invoice_id' => 'required',
			
        ]);
		
		$invoice_id = $request->get('invoice_id');
		
		//Eloquent query for sum of INVOICES from [invoicedetails] table
		$invoices_amount_sum = DB::table('invoices')
            ->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')
			
            ->select('invoices.*', 'invoicedetails.*' )
			->where('invoices.invoice_id',$invoice_id)
			->groupBy('invoicedetails.invoice_id')
			->sum('invoicedetails.payment_local');
		if($invoices_amount_sum==0){
			//return redirect('parents/')->with('success', 'Invoice Inserted Successful.');
			echo "Invoice ID : ERROR";
		}
		else{
			//get all invoices against the invoice_id
			$invoice_details = Invoicedetail::where('invoice_id',$invoice_id)->get();
			
			$invoice = Invoice::where('invoice_id',$invoice_id)->first();
			
			$parentID = $invoice->parent_id;
			//get parent name
			$parents = User::findOrFail($parentID);
			$parentname = $parents->fname." ".$parents->lname;

			//Variables defined
			$month_ary = array();
			$day_ary = array();
			$amount_to_send_sum_ary = array();
			$amount_to_send_local_curreny_sum_ary = array();
			$currency_grand_total = 0;
			$grand_total = 0;
			//subject/course
			$course_ary = array();
			
			//using invoice_details from [invoicedetails] table
			foreach($invoice_details as $invoice_detail){
				//Making arrays of MONTHS and DAYS of the invoice	//start
				$months = $invoice_detail->months;
				$days = $invoice_detail->days;
				$months_ary[$invoice_detail->id] = (int)$months;
				$days_ary[$invoice_detail->id] = (int)$days;
				//Making arrays of MONTHS and DAYS of the invoice	//end
				
				//Arrays for sum of the GRAND TOTAL and CURR GRAND TOTAL
				$amount_to_send_sum = $invoice_detail->payment;
				$amount_to_send_local_curreny_sum = $invoice_detail->payment_local;
				
				//Arrays to be sent as parameter to the MAILING METHOD/CLASS
				$amount_to_send_sum_ary[$invoice_detail->id] = $invoice_detail->payment;
				$amount_to_send_local_curreny_sum_ary[$invoice_detail->id] = $invoice_detail->payment_local;
				
				
				
				$curr_ary = $invoice_detail->currency;
				$student_name = \App\User::find($invoice_detail->studentID);
				
				$stu_name = $student_name->fname." ".$student_name->lname;
				
				$grand_total += (round($amount_to_send_sum));
				$currency_grand_total += (round($amount_to_send_local_curreny_sum));
				
				//subject name from schedule
				$subject = \App\Schedule::find($invoice_detail->schedule_id);
				$course_ary[$invoice_detail->id] = $subject->courseID;
				//dd($subject);

			}

			$course_list = \App\Courses::all();
			$currency = config('constants.currency');	
				  /* $data = array('invoice_details' => $invoice_details , 'invoice' => $invoice , 
				  'parents' => $parents,
				  'currency' => $currency,
				  'months_ary' => $months_ary,'days_ary' => $days_ary,
				  'amount_to_send_local_curreny_sum_ary' => $amount_to_send_local_curreny_sum_ary,
				  'currency_grand_total' => $currency_grand_total); */
			return view('invoice.create_invoice_detail',compact('invoice_details','invoice',
			'parents','currency','months_ary','days_ary',
			'amount_to_send_local_curreny_sum_ary','currency_grand_total',
			'course_list','course_ary','env_notify_url'));
		}
    }
//create invoice detail			//end	

	
	
	//destroy parentstudent
/* 	public function destroy_studentparent($id)
    {
        //
		$student_delete = \App\User::find($id);
		$student_delete->delete();
		return redirect()->action(
			'ParentController@index' 
		)->with('success', 'Student deleted.');
    } */
	
	
//createinvoicestu		//start
    public function createinvoicestu(Request $request)
    {
        //
		$student_id = \App\Schedule::find($request->id);
		
		$student_id->studentID;
		
		$parent = User::findOrFail($student_id->studentID);
		$parent->parent_id;
		//exit;
		
        $parents = User::findOrFail($parent->parent_id);
		$student_details=\App\User::with('role')->with('createdby_self')->where('iscustomer',3)
		->where('parent_id',$parent->parent_id)->get();
		$parent_id = $parent->parent_id;
		$course_list = \App\Courses::all();
		
		$schedules = DB::table('users')
            ->join('schedules', 'users.id', '=', 'schedules.studentID')
            ->select('users.*', 'schedules.*', 'users.fname as fname', 'users.lname as lname','schedules.id as sch_id' )
			->where('users.parent_id',$parent_id)
			->where('schedules.status','1')->where('schedules.status_dead','0')->whereIn('schedules.std_status',[1, 2])
			->get();
		$currency = config('constants.currency');		
		return  view('invoice.list')->with(compact('parents','student_details','schedules','currency','course_list'));
    }
//createinvoicestu		//end	


//print_invoice		//start
    public function print_invoice(Request $request)
    {
        //
 		$this->validate(request(), [
			'invoice_id' => 'required',
			
        ]);
		
		$invoice_id = $request->get('invoice_id');
		
		//Eloquent query for sum of INVOICES from [invoicedetails] table
		$invoices_amount_sum = DB::table('invoices')
            ->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')	
            ->select('invoices.*', 'invoicedetails.*' )
			->where('invoices.invoice_id',$invoice_id)
			->groupBy('invoicedetails.invoice_id')
			->sum('invoicedetails.payment_local');
		if($invoices_amount_sum==0){
			//return redirect('parents/')->with('success', 'Invoice Inserted Successful.');
			echo "Invoice ID : ERROR";
		}
		else{
			//get all invoices against the invoice_id
			$invoice_details = Invoicedetail::where('invoice_id',$invoice_id)->get();
			
			$invoice = Invoice::where('invoice_id',$invoice_id)->first();
			
			$parentID = $invoice->parent_id;
			//get parent name
			$parents = User::findOrFail($parentID);
			$parentname = $parents->fname." ".$parents->lname;

			//Variables defined
			$month_ary = array();
			$day_ary = array();
			$amount_to_send_sum_ary = array();
			$amount_to_send_local_curreny_sum_ary = array();
			$currency_grand_total = 0;
			$grand_total = 0;
			//subject/course
			$course_ary = array();
			

			//using invoice_details from [invoicedetails] table
			foreach($invoice_details as $invoice_detail){
				//Making arrays of MONTHS and DAYS of the invoice	//start
				$months = $invoice_detail->months;
				$days = $invoice_detail->days;
				$months_ary[$invoice_detail->id] = (int)$months;
				$days_ary[$invoice_detail->id] = (int)$days;
				//Making arrays of MONTHS and DAYS of the invoice	//end
				
				//Arrays for sum of the GRAND TOTAL and CURR GRAND TOTAL
				$amount_to_send_sum = $invoice_detail->payment;
				$amount_to_send_local_curreny_sum = $invoice_detail->payment_local;
				
				//Arrays to be sent as parameter to the MAILING METHOD/CLASS
				$amount_to_send_sum_ary[$invoice_detail->id] = $invoice_detail->payment;
				$amount_to_send_local_curreny_sum_ary[$invoice_detail->id] = $invoice_detail->payment_local;
				
				
				
				$curr_ary = $invoice_detail->currency;
				$student_name = \App\User::find($invoice_detail->studentID);
				
				$stu_name = $student_name->fname." ".$student_name->lname;
				
				$grand_total += (round($amount_to_send_sum));
				$currency_grand_total += (round($amount_to_send_local_curreny_sum));
				
				//subject name from schedule
				$subject = \App\Schedule::find($invoice_detail->schedule_id);
				$course_ary[$invoice_detail->id] = $subject->courseID;
				//dd($subject);				

			}

			$course_list = \App\Courses::all();
			$currency = config('constants.currency');	
			return view('invoice.print_invoice',compact('invoice_details','invoice',
			'parents','currency','months_ary','days_ary',
			'amount_to_send_local_curreny_sum_ary','currency_grand_total',
			'course_list','course_ary'));
		}
    }
//print_invoice			//end	


//download pdf		//start
    public function downloadpdf(Request $request)
    {
        //
		$this->validate(request(), [
			'invoice_id' => 'required',	
        ]);		

		$invoice_id = $request->get('invoice_id');
		
		//Eloquent query for sum of INVOICES from [invoicedetails] table
		$invoices_amount_sum = DB::table('invoices')
            ->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')			
            ->select('invoices.*', 'invoicedetails.*' )
			->where('invoices.invoice_id',$invoice_id)
			->groupBy('invoicedetails.invoice_id')
			->sum('invoicedetails.payment_local');
		if($invoices_amount_sum==0){
			//return redirect('parents/')->with('success', 'Invoice Inserted Successful.');
			echo "Invoice ID : ERROR";
		}
		else{
			//get all invoices against the invoice_id
			$invoice_details = Invoicedetail::where('invoice_id',$invoice_id)->get();
			
			$invoice = Invoice::where('invoice_id',$invoice_id)->first();
			
			$parentID = $invoice->parent_id;
			//get parent name
			$parents = User::findOrFail($parentID);
			$parentname = $parents->fname." ".$parents->lname;

			//Variables defined
			$month_ary = array();
			$day_ary = array();
			$amount_to_send_sum_ary = array();
			$amount_to_send_local_curreny_sum_ary = array();
			$currency_grand_total = 0;
			$grand_total = 0;
			//subject/course
			$course_ary = array();
			

			//using invoice_details from [invoicedetails] table
			foreach($invoice_details as $invoice_detail){
				//Making arrays of MONTHS and DAYS of the invoice	//start
				$months = $invoice_detail->months;
				$days = $invoice_detail->days;
				$months_ary[$invoice_detail->id] = (int)$months;
				$days_ary[$invoice_detail->id] = (int)$days;
				//Making arrays of MONTHS and DAYS of the invoice	//end
				
				//Arrays for sum of the GRAND TOTAL and CURR GRAND TOTAL
				$amount_to_send_sum = $invoice_detail->payment;
				$amount_to_send_local_curreny_sum = $invoice_detail->payment_local;
				
				//Arrays to be sent as parameter to the MAILING METHOD/CLASS
				$amount_to_send_sum_ary[$invoice_detail->id] = $invoice_detail->payment;
				$amount_to_send_local_curreny_sum_ary[$invoice_detail->id] = $invoice_detail->payment_local;
				
				
				
				$curr_ary = $invoice_detail->currency;
				$student_name = \App\User::find($invoice_detail->studentID);
				
				$stu_name = $student_name->fname." ".$student_name->lname;
				
				$grand_total += (round($amount_to_send_sum));
				$currency_grand_total += (round($amount_to_send_local_curreny_sum));
				
				//subject name from schedule
				$subject = \App\Schedule::find($invoice_detail->schedule_id);
				$course_ary[$invoice_detail->id] = $subject->courseID;
				//dd($subject);				

			}

			$course_list = \App\Courses::all();
			$currency = config('constants.currency');	
		      $data = array('invoice_details'=>$invoice_details,'invoice'=>$invoice,
			  'parents'=>$parents,'currency'=>$currency,'course_list'=>$course_list,'course_ary'=>$course_ary,
			  'months_ary'=>$months_ary,'days_ary'=>$days_ary,
			  'amount_to_send_local_curreny_sum_ary'=>$amount_to_send_local_curreny_sum_ary,
			  'currency_grand_total'=>$currency_grand_total);			
			
		  //PDF download
          $pdf = PDF::loadView('invoice.print_invoice', $data);
          return $pdf->download('invoicePDF.pdf');			
		}

    }
//download pdf		//end	
	
	
//createinvoice_fivedays		//start
    public function createinvoice_fivedays()
    {
        //
		//Get all parents
		set_time_limit(0);
		$parents = User::where('iscustomer',2)->get();
		//->whereIn('id',[6732,6820])
		//parents loop so that parent_id must be passed to users table to find students and  
		//then their schedules
		foreach($parents as $key=>$parent){
			$parent_id = $parent->id;
			$parentname = $parent->fname." ".$parent->lname;
			$todays_date = date('d');
			$next_fivedays_date=date('d', strtotime("+5 days"));
			
			
			//if arrears invoice found, update isdiscard=1 and make whole new invoice			//start
			//Eloquent query for sum of INVOICES from [invoicedetails] table in case of UNPAID INVOICES
			$first_date = date('Y-m-01');
			$last_date = date('Y-m-t');
			$invoices_arrears = DB::table('invoices')
				->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')	
				->select('invoices.*', 'invoicedetails.*')
				->where('invoices.parent_id',$parent_id)
				->where('invoices.paid_status','=','0')
				->where('invoices.arrears','=','1')
				//->whereBetween('invoices.invoice_date', [$first_date, $last_date])
				->groupBy('invoicedetails.invoice_id')
				->get();
				$invoices_arrears;
				
			if($invoices_arrears->count()){
				//echo "Arrears invoice found";
				//Commenting for now, uncomment later
 				$invoices_arrears_update = DB::table('invoices')
				->join('invoicedetails', 'invoices.invoice_id', '=', 'invoicedetails.invoice_id')	
				->select('invoices.*', 'invoicedetails.*')
				->where('invoices.parent_id',$parent_id)
				->where('invoices.paid_status','=','0')
				//->whereBetween('invoices.invoice_date', [$first_date, $last_date])
				->groupBy('invoicedetails.invoice_id')
				->update(['paid_status' => "2"]);
				if($invoices_arrears_update){
					//echo "arrears invoice update";
				}  
			}
				//if arrears invoice found, make whloe invoice here
				if($invoices_arrears->count()){
					$schedules = DB::table('users')
					->join('schedules', 'users.id', '=', 'schedules.studentID')
					->select('users.*', 'schedules.*', 'users.fname as fname', 'users.lname as lname','schedules.id as sch_id' )
					->where('users.parent_id',$parent_id)
					//->whereDay('paydate','=',$next_fivedays_date)
					->where('schedules.status','1')->where('schedules.status_dead','0')->whereIn('schedules.std_status',[1, 2])
					->get();
				}
				//else, if arrears not found, make fivedays invoice here
				else{
					$schedules = DB::table('users')
					->join('schedules', 'users.id', '=', 'schedules.studentID')
					->select('users.*', 'schedules.*', 'users.fname as fname', 'users.lname as lname','schedules.id as sch_id' )
					->where('users.parent_id',$parent_id)
					->whereDay('paydate','=',$next_fivedays_date)
					->where('schedules.status','1')->where('schedules.status_dead','0')->whereIn('schedules.std_status',[1, 2])
					->get();						
				}
					//count all schedules
					$schedules_count = DB::table('users')
					->join('schedules', 'users.id', '=', 'schedules.studentID')
					->select('users.*', 'schedules.*', 'users.fname as fname', 'users.lname as lname','schedules.id as sch_id' )
					->where('users.parent_id',$parent_id)
					->where('schedules.status','1')->where('schedules.status_dead','0')->whereIn('schedules.std_status',[1, 2])
					->count();
			//if arrears invoice found, update isdiscard=1 and make whole new invoice			//end

			//if schedule found then insert data in invoices and invoicedetails
			if ($schedules->count()) {
			//extra variables required
			$invoice_id = date('YmdHis').$parent_id;
			$parent_cronjob = User::findOrFail($parent_id);
			
			//Variables defined
			$month_ary = array();
			$day_ary = array();
			$amount_to_send_sum_ary = array();
			$amount_to_send_local_curreny_sum_ary = array();
			$currency_grand_total = 0;
			$grand_total = 0;
			//counts
			$sch_fivedays_cnt = $schedules->count();
			$sch_all_cnt = $schedules_count;
			if($sch_fivedays_cnt!=$sch_all_cnt){
				$arrears = 1;
			}
			else {
				$arrears = NULL;
			}
			//invoice table
			$invoice= new \App\Invoice;
			$invoice->invoice_id = $invoice_id;
			$invoice->parent_id = $parent_id;
			$invoice->parent_name = $parentname;
			/* $duedate = date_create($request->get('duedate'));
			$duedate = date_format($duedate,"Y-m-d"); 
			$invoice->due_date = strtotime($duedate); */
			$invoice->paid_status = 0;
			/* $date = date_create($request->get('date'));
			$format = date_format($date,"Y-m-d"); */
			$invoice->invoice_date = date('Y-m-d');
			$invoice->invoice_email = $parent->email;
			$invoice->created_by = 0;
			$invoice->created_at = date('Y-m-d');
			$invoice->updated_at = date('Y-m-d');
			$invoice->arrears = $arrears;
			$invoice->save();	
			
				//using schedule_id for schedule id's,
				foreach($schedules as $key => $schedule_id){
					$amount_to_send						=		0;
					$amount_to_send_local_curreny		=		0;
					//Getting values from schedules table
					$schedule_val = Schedule::with('studentname')->findOrFail($schedule_id->id);
					$schedule_ary[$schedule_id->id] = $schedule_val;
					
					//echo "values:";
					$schedule_id;
					//Making arrays of MONTHS and DAYS of the invoice	//start
					$months = 1;
					$days = 0;
					$months_ary[$schedule_id->id] = (int)$months;
					$days_ary[$schedule_id->id] = (int)$days;
					//Making arrays of MONTHS and DAYS of the invoice	//end
					
					//Arrays for sum of the GRAND TOTAL and CURR GRAND TOTAL
					$amount_to_send_sum = $schedule_id->dues_usd;
					$amount_to_send_local_curreny_sum = $schedule_id->dues_original;
					
					//Arrays to be sent as parameter to the MAILING METHOD/CLASS
					$amount_to_send_sum_ary[$schedule_id->id] = $schedule_id->dues_usd;
					$amount_to_send_local_curreny_sum_ary[$schedule_id->id] = $schedule_id->dues_original;
					
					$amount_to_send_local_curreny_monthly_fee[$schedule_id->id] = $schedule_id->dues_original;
					
					$curr_ary = $schedule_id->currency_array;
					$schedule_id;
					$schedule_val->studentID;
					$student_name = \App\User::find($schedule_val->studentID);
					
					$stu_name = $student_name->fname." ".$student_name->lname;
					
					$grand_total += (round($amount_to_send_sum));
					$currency_grand_total += (round($amount_to_send_local_curreny_sum));
					
					//invoicedetail table
					$invoicedetail= new \App\Invoicedetail;
					$invoicedetail->invoice_id = $invoice_id;
					$invoicedetail->parent_id = $parent_id;
					$invoicedetail->teacherID = $schedule_val->teacherID;
					$invoicedetail->studentID = $schedule_val->studentID;
					$invoicedetail->student_name = $stu_name;
					$duedate = date_create($schedule_val->paydate);
					$duedate = date_format($duedate,"Y-m-d");
					$invoicedetail->due_date = strtotime($duedate);
					
					$invoicedetail->monthly_fee = $amount_to_send_local_curreny_monthly_fee[$schedule_id->id];
					$invoicedetail->months = (int)$months;
					$invoicedetail->days = (int)$days;
					
					$invoicedetail->payment = $amount_to_send_sum;
					$invoicedetail->payment_local = $amount_to_send_local_curreny_sum;
					$invoicedetail->invoice_date = date('Y-m-d');
					$invoicedetail->currency = $curr_ary;
					$invoicedetail->schedule_id = $schedule_id->id;
					
					$invoicedetail->created_at = date('Y-m-d');
					$invoicedetail->updated_at = date('Y-m-d');
					$invoicedetail->save();
					
				}

 		$currency = config('constants.currency');
		$course_list = \App\Courses::all();		
		      $data = array('invoice_id'=>$invoice_id,'parents'=>$parent_cronjob,'schedules'=>$schedule_ary,
			  'currency'=>$currency,'course_list'=>$course_list,
			  'months_ary'=>$months_ary,'days_ary'=>$days_ary,
			  'amount_to_send_local_curreny_sum_ary'=>$amount_to_send_local_curreny_monthly_fee,
			  'currency_grand_total'=>$currency_grand_total);
/* 			  Mail::send('invoice.invoice_to_be_sent', $data, function($message) {
			  $message->to('junaid9898@yahoo.com', 'CronJob Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
			  $message->from('xyz@gmail.com','CronJob Laravel test environment');
			  });
				if(env('MAIL_HOST', false) == 'smtp.mailtrap.io'){
						sleep(3); //use usleep(500000) for half a second or less
					} */			  
			  unset($data);
			  unset($schedule_ary);	
			}

		}
		//echo "HTML Email Sent. Check your inbox.";
		return redirect('invoice/')->with('success', 'CronJob Invoice Generated Successfully.');				
    }
//createinvoice_fivedays		//end	

	function paymentipnlistenerTEST(Request $request){
		echo "test123";
		$destinationPath=public_path();
						$txt2 = "TRANSID:";
				//File::put($destinationPath.'/newfile2.txt', $txt2);	
				Storage::disk('public')->put('ipntest/newfile2.txt', $txt2);
	}

	public function paymentipnlistener(Request $request){
/* 		$obj = New PayPal_IPN();
		$obj->ipn_response($_REQUEST); */
		$ipn = new PaypalIPNListener();
		$ipn->use_sandbox = true;
		$destinationPath=public_path();
		

		$verified = $ipn->processIpn();

		$report = $ipn->getTextReport();

		//Log::info("-----new payment-----");

		//Log::info($report);
		//$destinationPath=public_path();
		$txt20 = $report;
		//File::put($destinationPath.'/newfile20.txt', $txt20);		
		Storage::disk('public')->put('ipn/newfile20.txt', $txt20);

		if ($verified) {
			if ($_POST['address_status'] == 'confirmed') {
				// Check outh POST variable and insert your logic here
				//Log::info("payment verified and inserted to db");
				//$destinationPath=public_path();
				$txt2 = "TRANSID:".$_POST['txn_id'];
				//File::put($destinationPath.'/newfile2.txt', $txt2);		
				Storage::disk('public')->put('ipn/newfile2.txt', $txt2);
				
				
		//invoice table + transaction data [but all data will be saved in invoices table]
		$invoiceid = $_POST['invoice'];
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
				
				

				$invoice_update = \App\Invoice::where('invoice_id','=',$_POST['invoice'])->first();
				//$invoice_update->parent_name = $_POST['first_name'];
				$invoice_update->paid_status = 1;
				$invoice_update->pay_method = 'Paypal';
				$invoice_update->agentId = '123';
				$invoice_update->sender_name = $_POST['first_name']." ".$_POST['last_name'];
				
				$invoice_update->receive_code = $_POST['txn_id'];
				//Local to USD currency conversion
				if($_POST['mc_currency']=='GBP'){
					$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
					$currency_value = $getCurrencyValue_query->one_gbp_to_usd;	
					$currency_array = 1;
				}
				if($_POST['mc_currency']=='USD'){
					$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
					$currency_value = $getCurrencyValue_query->one_usd_to_usd;
					$currency_array = 2;
				}
				if($_POST['mc_currency']=='CAD'){
					$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
					$currency_value = $getCurrencyValue_query->one_cad_to_usd;	
					$currency_array = 3;
				}
				if($_POST['mc_currency']=='AUD'){
					$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
					$currency_value = $getCurrencyValue_query->one_aud_to_usd;	
					$currency_array = 4;
				}	
				if($_POST['mc_currency']=='NZD'){
					$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
					$currency_value = $getCurrencyValue_query->one_nzd_to_usd;
					$currency_array = 5;
				}
				if($_POST['mc_currency']=='SGD'){
					$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
					$currency_value = $getCurrencyValue_query->one_sgd_to_usd;
					$currency_array = 6;
				}				
				//
				$payment_received_local = $_POST['mc_gross'] - $_POST['mc_fee'];
				
				$amountDefaultNew_Usd = $_POST['mc_gross'] * $currency_value;
				$feeDeductNew_Usd = $_POST['mc_fee'] * $currency_value;
				$totalReceivedNew_Usd = $payment_received_local * $currency_value;
				
				$invoice_update->payment_received = $totalReceivedNew_Usd;
				$invoice_update->payment_received_local = $payment_received_local;
				$invoice_update->dateReceived = $_POST['payment_date'];
				$invoice_update->invoice_paid_date = date("Y-m-d");
				$invoice_update->method_array = '1';//payment method : paypal
				$invoice_update->currency_array = $currency_array;
				
				//Org Currency		
				$invoice_update->amountDefaultNew = $_POST['mc_gross'];
				$invoice_update->feeDeductNew = $_POST['mc_fee'];
				$invoice_update->totalReceivedNew = $payment_received_local;
				//USD Currency
				$invoice_update->amountDefaultNew_Usd = $amountDefaultNew_Usd;
				$invoice_update->feeDeductNew_Usd = $feeDeductNew_Usd;
				$invoice_update->totalReceivedNew_Usd = $totalReceivedNew_Usd;
				
				$schedule_ids = \App\Invoicedetail::where('invoice_id',$_POST['invoice'])->with('studentname')->get();
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
				
				
				$format = date("Y-m-d");
				$invoice_update->updated_at = strtotime($format);
				$invoice_update->comments = 'PAYPAL PAYMENT';
				$invoice_update->save();					
				
			}
		} else {
				$destinationPath=public_path();
				$txtwrong = "Some thing went wrong in the payment !";
				//File::put($destinationPath.'/newfilewrong.txt', $txtwrong);	
				Storage::disk('public')->put('ipn/newfilewrong.txt', $txtwrong);
				//Log::info("Some thing went wrong in the payment !");
		}		
	}

	
}




class PaypalIPNListener
{
    /**
     *  If true, the recommended cURL PHP library is used to send the post back
     *  to PayPal. If flase then fsockopen() is used. Default true.
     *
     * @var boolean
     */
    public $use_curl = true;
    /**
     *  If true, explicitly sets cURL to use SSL version 3. Use this if cURL
     *  is compiled with GnuTLS SSL.
     *
     * @var boolean
     */
    public $force_ssl_v3 = false;
    /**
     *  If true, cURL will use the CURLOPT_FOLLOWLOCATION to follow any
     *  "Location: ..." headers in the response.
     *
     * @var boolean
     */
    public $follow_location = false;
    /**
     *  If true, an SSL secure connection (port 443) is used for the post back
     *  as recommended by PayPal. If false, a standard HTTP (port 80) connection
     *  is used. Default true.
     *
     * @var boolean
     */
    public $use_ssl = true;
    /**
     *  If true, the paypal sandbox URI www.sandbox.paypal.com is used for the
     *  post back. If false, the live URI www.paypal.com is used. Default false.
     *
     * @var boolean
     */
    public $use_sandbox = true;
    /**
     *  The amount of time, in seconds, to wait for the PayPal server to respond
     *  before timing out. Default 30 seconds.
     *
     * @var int
     */
    public $timeout = 30;
    private $post_data = array();
    private $post_uri = '';
    private $response_status = '';
    private $response = '';
    const PAYPAL_HOST = 'www.paypal.com';
    const SANDBOX_HOST = 'www.sandbox.paypal.com';
    /**
     *  Post Back Using cURL
     *
     *  Sends the post back to PayPal using the cURL library. Called by
     *  the processIpn() method if the use_curl property is true. Throws an
     *  exception if the post fails. Populates the response, response_status,
     *  and post_uri properties on success.
     *
     * @param  string $encoded_data The post data as a URL encoded string
     * @throws Exception
     */
    protected function curlPost($encoded_data)
    {
        if ($this->use_ssl) {
            $uri = 'https://' . $this->getPaypalHost() . '/cgi-bin/webscr';
        } else {
            $uri = 'http://' . $this->getPaypalHost() . '/cgi-bin/webscr';
        }
        $this->post_uri = $uri;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $this->follow_location);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        $this->response = curl_exec($ch);
        $this->response_status = (string)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($this->response === false || $this->response_status == '0') {
            $errno = curl_errno($ch);
            $errstr = curl_error($ch);
            throw new Exception("cURL error: [$errno] $errstr");
        }
    }
    /**
     *  Post Back Using fsockopen()
     *
     *  Sends the post back to PayPal using the fsockopen() function. Called by
     *  the processIpn() method if the use_curl property is false. Throws an
     *  exception if the post fails. Populates the response, response_status,
     *  and post_uri properties on success.
     *
     * @param  string $encoded_data The post data as a URL encoded string
     * @throws Exception
     */
    protected function fsockPost($encoded_data)
    {
        if ($this->use_ssl) {
            $uri = 'ssl://' . $this->getPaypalHost();
            $port = '443';
            $this->post_uri = $uri . '/cgi-bin/webscr';
        } else {
            $uri = $this->getPaypalHost(); // no "http://" in call to fsockopen()
            $port = '80';
            $this->post_uri = 'http://' . $uri . '/cgi-bin/webscr';
        }
        $fp = fsockopen($uri, $port, $errno, $errstr, $this->timeout);
        if (!$fp) {
            // fsockopen error
            throw new Exception("fsockopen error: [$errno] $errstr");
        }
        $header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
        $header .= "Host: " . $this->getPaypalHost() . "\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($encoded_data) . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        fwrite($fp, $header . $encoded_data . "\r\n\r\n");
        while (!feof($fp)) {
            if (empty($this->response)) {
                // extract HTTP status from first line
                $this->response .= $status = fgets($fp, 1024);
                $this->response_status = trim(substr($status, 9, 4));
            } else {
                $this->response .= fgets($fp, 1024);
            }
        }
        fclose($fp);
    }
    private function getPaypalHost()
    {
        if ($this->use_sandbox) return self::SANDBOX_HOST;
        else return self::PAYPAL_HOST;
    }
    /**
     *  Get POST URI
     *
     *  Returns the URI that was used to send the post back to PayPal. This can
     *  be useful for troubleshooting connection problems. The default URI
     *  would be "ssl://www.sandbox.paypal.com:443/cgi-bin/webscr"
     *
     * @return string
     */
    public function getPostUri()
    {
        return $this->post_uri;
    }
    /**
     *  Get Response
     *
     *  Returns the entire response from PayPal as a string including all the
     *  HTTP headers.
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
    /**
     *  Get Response Status
     *
     *  Returns the HTTP response status code from PayPal. This should be "200"
     *  if the post back was successful.
     *
     * @return string
     */
    public function getResponseStatus()
    {
        return $this->response_status;
    }
    /**
     *  Get Text Report
     *
     *  Returns a report of the IPN transaction in plain text format. This is
     *  useful in emails to order processors and system administrators. Override
     *  this method in your own class to customize the report.
     *
     * @return string
     */
    public function getTextReport()
    {
        $r = '';
        // date and POST url
        for ($i = 0; $i < 80; $i++) {
            $r .= '-';
        }
        $r .= "\n[" . date('m/d/Y g:i A') . '] - ' . $this->getPostUri();
        $r .= $this->use_curl ? " (curl)\n" : $r .= " (fsockopen)\n";
        // HTTP Response
        for ($i = 0; $i < 80; $i++) {
            $r .= '-';
        }
        $r .= "\n{$this->getResponse()}\n";
        // POST vars
        for ($i = 0; $i < 80; $i++) {
            $r .= '-';
        }
        $r .= "\n";
        foreach ($this->post_data as $key => $value) {
            $r .= str_pad($key, 25) . "$value\n";
        }
        $r .= "\n\n";
        return $r;
    }
    /**
     *  Process IPN
     *
     *  Handles the IPN post back to PayPal and parsing the response. Call this
     *  method from your IPN listener script. Returns true if the response came
     *  back as "VERIFIED", false if the response came back "INVALID", and
     *  throws an exception if there is an error.
     *
     * @param array
     * @return bool
     * @throws Exception
     */
    public function processIpn($post_data = null)
    {
		$destinationPath=public_path();		
		
        $encoded_data = 'cmd=_notify-validate';
        if ($post_data === null) {
            // use raw POST data
            if (!empty($_POST)) {
                $this->post_data = $_POST;
                $encoded_data .= '&' . file_get_contents('php://input');
            } else {
				$txt6 = "No POST data found.";
				//File::put($destinationPath.'/newfile6.txt', $txt6);	
				Storage::disk('public')->put('ipn/newfile6.txt', $txt6);
                throw new \Exception("No POST data found.");				
            }
        } else {
            // use provided data array
            $this->post_data = $post_data;
            foreach ($this->post_data as $key => $value) {
                $encoded_data .= "&$key=" . urlencode($value);
            }
			$txt8 = $encoded_data;
			//File::put($destinationPath.'/newfile8.txt', $txt8);	
			Storage::disk('public')->put('ipn/newfile8.txt', $txt8);
        }
        if ($this->use_curl) $this->curlPost($encoded_data);
        else $this->fsockPost($encoded_data);
        if (strpos($this->response_status, '200') === false) {
			$txt13 = $this->response_status;
			//File::put($destinationPath.'/newfile13.txt', $txt13);
			Storage::disk('public')->put('ipn/newfile13.txt', $txt13);
            throw new \Exception("Invalid response status: " . $this->response_status);
        }
        if (strpos($this->response, "VERIFIED") !== false) {
			$txt10 = $this->response;
			//File::put($destinationPath.'/newfile10.txt', $txt10);	
			Storage::disk('public')->put('ipn/newfile10.txt', $txt10);
            return true;
        } elseif (strpos($this->response, "INVALID") !== false) {
			$txt11 = $this->response;
			//File::put($destinationPath.'/newfile11.txt', $txt11);
			Storage::disk('public')->put('ipn/newfile11.txt', $txt11);
            return false;
        } else {
			$txt12 = $this->response;
			//File::put($destinationPath.'/newfile12.txt', $txt12);
			Storage::disk('public')->put('ipn/newfile12.txt', $txt12);
            throw new \Exception("Unexpected response from PayPal.");
        }
    }
    /**
     *  Require Post Method
     *
     *  Throws an exception and sets a HTTP 405 response header if the request
     *  method was not POST.
     * @throws Exception
     */
    public function requirePostMethod()
    {
        // require POST requests
        if ($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD'] !== 'POST') {
			$txt14 = $this->response_status;
			//File::put($destinationPath.'/newfile14.txt', $txt14);
			Storage::disk('public')->put('ipn/newfile14.txt', $txt14);
            header('Allow: POST', true, 405);
            throw new \Exception("Invalid HTTP request method.");
        }
    }
}
