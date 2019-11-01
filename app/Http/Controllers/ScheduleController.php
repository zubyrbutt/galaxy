<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use DataTables;
use Auth;
use Validator;
use App\User;
use App\Role;
use App\Extension;
use App\Studentdetail;
use App\Schedule;
use App\TeacherTiming;
use App\TeacherCourse;
use App\Currency;
use App\Transaction;
use App\Paypalverification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    	//$plan array from constants.php		
		$plan = config('constants.plan');
		$schedules = \App\Schedule::where('status','1')->where('status_dead','0')->whereIn('std_status',[1, 2, 5])->with('teachername')->with('studentname')->with('coursename')->get();
		return view('schedule.list',compact('schedules','plan'));
    }
	
public function fetch(Request $request)
  {
		$schedules = \App\Schedule::where('status','1')->where('status_dead','0')->whereIn('std_status',[1, 2, 5])->with('teachername')->with('studentname')->with('coursename')->get();
		
        return DataTables::of($schedules)
        ->addColumn('id',function($schedules){
            return $schedules->id;
        })				
		
        ->addColumn('studentname',function($schedules){
            return $schedules->studentname->fname.' '.$schedules->studentname->lname;
        })
        ->addColumn('teachername',function($schedules){
            return $schedules->teachername->fname.' '.$schedules->teachername->lname;
        })
        ->addColumn('coursename',function($schedules){
            return $schedules->coursename->courses;
        })
        ->addColumn('startTime',function($schedules){
            return $schedules->startTime;
        })
        ->addColumn('endTime',function($schedules){
            return $schedules->endTime;
        })	
        ->addColumn('classType',function($schedules){
			$plan = config('constants.plan');
			$classType = $plan[$schedules->classType];
			return $classType;
        })			
        ->addColumn('status',function($schedules){
            if($schedules->std_status==2)
            {
              return '<span class="label label-success">&nbsp Regular &nbsp</span>';
            }
            elseif($schedules->std_status==1)
            {
              return '<span class="label label-warning"> Trial </span>';
            }
            elseif($schedules->std_status==5)
            {
            return '<span class="label label-primary">&nbsp MakeOver &nbsp</span>';
            }  		  
         
        })	
        ->addColumn('paydate',function($schedules){
            return $schedules->paydate;
        })		
        ->addColumn('options',function($schedules){
            $action = '<span class="action_btn">';

                $action .= "<a href='".url('/schedule/'.$schedules->id)."' class='btn btn-primary' title='View Detail'><i class='fa fa-eye'></i> </a>"; 
                $action .= "<a href='".url('/schedule/'.$schedules->id.'/edit')."'  class='btn btn-success' title='Edit' style='margin-left:5px'><i class='fa fa-edit'></i> </a>";
				$action .="<a href='".url('/schedule/'.$schedules->id.'/editfee')."' class='btn btn-success' title='Edit Fee' style='margin-left:5px'><i class='fa fa-dollar'></i> </a>";
				$action .="<a href='".url('/schedule/deadconfirmation/'.$schedules->id)."' class='btn btn-warning' title='DC' style='margin-left:5px'><i class='fa fa-times'></i> </a>";
					if($schedules->std_status == 1){
						$action .="<a href='".url('/schedule/createMakeRegular/'.$schedules->id)."'  class='btn btn-info' title='Make Regular' style='margin-left:5px'><i class='fa fa-gear'></i> </a>";
					}
					elseif($schedules->std_status == 2){
						$action .="<a href='#'  class='btn btn-success' title='Regular' style='margin-left:5px'><i class='fa fa-calendar'></i> </a>";
					}				
				$action .="<a href='".url('parents/createinvoicestu/'.$schedules->id)."' class='btn btn-danger' title='Invoice' style='margin-left:5px'><i class='fa fa-newspaper-o'></i> </a>	";				

            $action .= '</span>';
            return $action; 
                                
        })
        ->rawColumns(['options','schedules','studentname','teachername','coursename','startTime','endTime','classType','plan','status'])
        ->make(true);
  }	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$course_list = \App\Courses::all();
		//$plan array from constants.php		
		$plan = config('constants.plan');
		$students_list = \App\User::where('iscustomer',3)->get();
		$agents_list = \App\User::where('role_id',31)->get();
		//Helper function commented
		//$fullusername = getUserFullName(auth()->user()->id);
		return view('schedule.create',compact('course_list','plan','students_list','agents_list'));		
    }

	public function showAvailableTeacher(Request $request)
	{
		//$option="<select id='teacherID' name='teacherID'><option value=''>Select Teacher</option>";

		if($request->ajax()){
    		//$time array from constants.php 
			$time = config('constants.time');
			//Getting values from ajax call
			$classType = $_POST['classType'];
			$slotDuration = $_POST['slotDuration'];
			$course = $_POST['course'];
			$pakTime = $_POST['pakTime'];
			$type = $_POST['type'];
			//Helper functions
			$_classType = getClassTypeSchedule($classType);
			$_condition = getCondition($classType);
			
			//Getting values from both teacher_courses and teacher_timings table on teacher_id
			$teacherIDs = \App\TeacherCourse::with('teachername')
			->whereHas('teacher_time', function ($query) use($course,$_condition) {
            $query->where('course_id', '=', $course);
			$query->whereRaw($_condition);
                })
            ->get();	
			

			$user_names_ary = array();
			//Loop, It is used to get the startTime and endTime
			foreach($teacherIDs as $key => $teacherID){
				$pakTime=array_keys($time,$_POST['pakTime']);
				$available=array();
				
				$startTime = $teacherID->teacher_time->startTime;
				$endTime = $teacherID->teacher_time->endTime;
				$_teacherId = $teacherID->teacher_id;
				//Loop, It is used to make available array on startTime/endTime
				foreach($time as $index => $timess ){
					
					if ($startTime > $endTime) {

						if ($startTime> $index && $endTime< $index && $index >0  ) {
							$available[$timess] = 0;

						} else if ($index > 0) {
							
							if($timess=='22:30' || $timess=='23:00' || $timess=='23:30')
							{
		 					 $_sql = \App\Schedule::where('std_status','!=',3)->where('std_status','!=',4)->where('std_status','!=',7)
							 ->whereRaw("(startTime<='".$timess."' and ( endTime>'".$timess."' or endTime='00:00'))")
							 ->whereRaw($_classType)
							 ->where('teacherID','=',$_teacherId)
							 ->count();
							 
							 }
							else{
		 					  $_sql = \App\Schedule::where('std_status','!=',3)->where('std_status','!=',4)->where('std_status','!=',7)
							 ->whereRaw("(startTime<='".$timess."' and endTime>'".$timess."')")
							 ->whereRaw($_classType)
							 ->where('teacherID','=',$_teacherId)
							 ->count();
							}
							if ($_sql<1) {
								$available[$timess]=1;
							} else {
								// $available[$timess]=0;
								// if Group then it should be 1
								if($type == 'group'){
									$available[$timess]=1;
								}else{
									$available[$timess]=0;
								}
								
							}
							
			
						}
					} else {
						if ($startTime<= $index && $endTime> $index && $index >0  ) {
		 					$_sql = \App\Schedule::where('std_status','!=',3)->where('std_status','!=',4)->where('std_status','!=',7)
							 ->whereRaw("(startTime<='".$timess."' and endTime>'".$timess."')")
							 ->whereRaw($_classType)
							 ->where('teacherID','=',$_teacherId)
							 ->count();

							if ($_sql<1) {
								$available[$timess]=1;
							} else {
								// $available[$timess]=0;
								// if Group then it should be 1
								if($type == 'group'){
									$available[$timess]=1;
								}else{
									$available[$timess]=0;
								}
							}
						} else if ($index >0) {
							// $available[$timess]=0;
							$available[$timess]=0;
						}
						
					}
				}				
				/*print_r($available);*/
				//exit;
			
				// $available[$time[$pakTime[0]]];
				//Checking, which time was selected from dropdown and was that 1 in available array
				if ($available[$time[$pakTime[0]]]) {
					$user_sql = \App\User::where('id',$_teacherId)->where('role_id',30)->where('status',1)->get();			
					$user_sql_cnt = count($user_sql);
					if ($user_sql_cnt>0) {
						foreach($user_sql as $key => $user_names){

							$user_names_ary[] = array("id" => $user_names->id , "fname" => $user_names->fname , "lname" => $user_names->lname);
						} 
					} 
				}
				
            }
			//print_r($user_names_ary);exit;
			$data = view('schedule.showAvailableTeachers',compact('teacherIDs','time','available','pakTime','user_names_ary'))->render();
    		return response()->json(['options'=>$data]);

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
        //
/* 	$checkSchedule = checkSchedule($request,$scheduleEdit);
	if($checkSchedule){ */
		$systemdate = systemDate();
		//Calling constant arrays from constants.php
		$time = config('constants.time');
		$courseDuration=config('constants.courseDuration');
		
		$this->validate(request(), [
            'studentID' => 'required',
            'pakTime' => 'required',
            'startDate' => 'required',
            'slotDuration' => 'required',
            'courseID' => 'required',
            'classType' => 'required',
            'teacherID' => 'required',
			'agentId' => 'required'
        ]);

		$Schedule= new \App\Schedule;
		//Making values
		$studentID = $request->get('studentID');		
		$paktime = $time[$request->get('pakTime')];		
		$startDate = $request->get('startDate');
		$slotDuration = $request->get('slotDuration');
		$courseID = $request->get('courseID');
		$classType = $request->get('classType');
		$teacherID = $request->get('teacherID');
		$agentId = $request->get('agentId');
		
		$endTime = makeTime($paktime,$slotDuration);
		$endDate = date('Y-m-d',strtotime($courseDuration[$courseID]." months"));
		
		//Following is to check that same student, same time and same class type MUST NOT be rescheduled
		//with same OR diff teacher
		$check_student = \App\Schedule::where("studentID",$studentID)
		->where("startTime",'<=',$paktime)
		->where("endTime",'>',$paktime)
		->whereRaw("std_status!=3 and std_status!=4")
		->whereRaw(getClassTypeSchedule($classType))
		->count()
		;
		//and status_dead!=1
		if($check_student>0){
			return redirect('schedule/')->with('failed', 'Same student with same startTime and with same classtype cannot be rescheduled to any teacher');
		}
		
		//Inserting values
		$Schedule->startTime=$paktime;
		$Schedule->endTime=$endTime;
		$systemdate;
		$startDate = date_create($request->get('startDate'));
        $startDate = date_format($startDate,"Y-m-d");
		$Schedule->startDate = strtotime($startDate);
		$Schedule->endDate = $endDate;
        $Schedule->teacherID = $teacherID;
        $Schedule->studentID = $studentID;
        $Schedule->courseID = $courseID;
        $Schedule->agentId = $agentId;
        $Schedule->dateBooked = $systemdate;
        $Schedule->classType = $classType;
        $Schedule->status = 0;
        $Schedule->std_status = 1;
        $Schedule->created_by = auth()->user()->id;
        $Schedule->modified_by = auth()->user()->id;

		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $Schedule->created_at = strtotime($format);
        $Schedule->updated_at = strtotime($format);
        $Schedule->comments = $request->get('comments');		
        $Schedule->save();
		return redirect('schedule/trialconfirmation')->with('success', 'Schedule added successfully.');
/* 	}
	else{
		return redirect('schedule/create')->with('failed', 'Schedule Error.');
	} */
		
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
		$course_list = \App\Courses::all();
		$plan = config('constants.plan');
		$pakTime = config('constants.time');
		$stdStatus = config('constants.stdStatus');
		$country = config('constants.country');	
		$currency = config('constants.currency');
		$show_schedule = \App\Schedule::with('teachername')->with('studentname')->with('coursename')->with('agentname')->with('parentdetail_relation')->find($id);
		$students_list = \App\User::where('iscustomer',3)->where('id',$show_schedule->studentID)->get();
		//
		$data = [
			'classType' => $plan[$show_schedule->classType],
			'std_status' => $stdStatus[$show_schedule->std_status],
			// 'country' => $country[$show_schedule->studentname->parent_name->parentdetail_relation['countryID']],
			// 'currency' => $currency[$show_schedule->currency_array],
		];
		//dd($data);
		return view('schedule.show',compact('id','show_schedule','data'));		
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$course_list = \App\Courses::all();
		$plan = config('constants.plan');
		$pakTime = config('constants.time');
		$edit_schedule = \App\Schedule::with('teachername')->with('studentname')->find($id);
		$students_list = \App\User::where('iscustomer',3)->where('id',$edit_schedule->studentID)->get();
		$agents = \App\User::where('role_id',31)->get();
		//dd($edit_schedule);
		$startTime = $edit_schedule->startTime;
		$endTime = $edit_schedule->endTime;
		$slot = makeSlot($startTime,$endTime);
		return view('schedule.edit',compact('id','edit_schedule','students_list','agents','pakTime','course_list','plan','slot'));
    }

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
		$systemdate = systemDate();
		//echo $request;echo "<br>";
		//echo $request->get('prevteacherID');
		//exit;
		if($request->get('teacherID')=='' || $request->get('teacherID')==0){
			$teacherID = $request->get('prevteacherID');
		}
		else{
			$teacherID = $request->get('teacherID');
		}
		//
		$scheduleEdit = $id;		
		$checkSchedule = checkSchedule($request,$scheduleEdit);
		
		
		//Calling constant arrays from constants.php
		$time = config('constants.time');
		$courseDuration = config('constants.courseDuration');
		
		$this->validate(request(), [
            'studentID' => 'required',
            'pakTime' => 'required|not_in:0',
            'startDate' => 'required',
            'slotDuration' => 'required',
            'courseID' => 'required',
            'classType' => 'required',
        ]);

		$Schedule = \App\Schedule::find($id);
		//Making values
		echo $studentID = $request->get('studentID');echo "<br>";
		echo $paktime = $time[$request->get('pakTime')];echo "<br>";	
		echo $startDate = $request->get('startDate');echo "<br>";
		echo $slotDuration = $request->get('slotDuration');echo "<br>";
		echo $courseID = $request->get('courseID');echo "<br>";
		echo $classType = $request->get('classType');echo "<br>";
		echo $teacherID = $teacherID;echo "<br>";
		echo $agentId = $request->get('agentId');echo "<br>";		
		
		
		echo $endTime = makeTime($paktime,$slotDuration);
		//Following is to check that same student, same time and same class type MUST NOT be rescheduled
		//with same OR diff teacher
		$check_student = \App\Schedule::where("studentID",$studentID)
		->where("startTime",'<=',$paktime)
		->where("endTime",'>',$paktime)
		->whereRaw("std_status!=3 and std_status!=4")
		->where("id",'!=',$id)
		->whereRaw(getClassTypeSchedule($classType))
		->count()
		;
		if($check_student>0){
			return redirect('schedule/')->with('failed', 'Same student with same startTime and with same classtype cannot be rescheduled to any teacher.');
		}
		
		
		//Updating values
		$Schedule->startTime = $paktime;
		$Schedule->endTime = $endTime;
		$systemdate;
		$startDate = date_create($request->get('startDate'));
        $startDate = date_format($startDate,"Y-m-d");
		$Schedule->startDate = strtotime($startDate);
		$endDate = date_create($request->get('endDate'));
        $endDate = date_format($endDate,"Y-m-d");
		$Schedule->endDate = strtotime($endDate);
        $Schedule->teacherID = $teacherID;
        $Schedule->studentID = $studentID;
        $Schedule->courseID = $courseID;
        $Schedule->agentId = $agentId;
//        $Schedule->dateBooked = $systemdate;
        $Schedule->classType = $classType;
//        $Schedule->status = 1;
//        $Schedule->std_status = 1;
//        $Schedule->created_by = auth()->user()->id;
        $Schedule->modified_by = auth()->user()->id;

		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
//        $Schedule->created_at = strtotime($format);
        $Schedule->updated_at = strtotime($format);
        $Schedule->comments = $request->get('comments');
        $Schedule->save();
		return redirect('schedule/')->with('success', 'Schedule Edited successfully.');		
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

//TRIAL CONFIRMATION
    public function trialconfirmation()
    {
        //
		$plan = config('constants.plan');
		$trialconfirmation_data = \App\Schedule::where('status','0')->with('agentname')->with('teachername')->with('studentname')->with('coursename')->get();
		return view('schedule.trialconfirmation',compact('trialconfirmation_data','plan'));
    }

    //For confirm trial	
    public function confirmtrial($id)
    {
		//$this->authorize('status-parents');
        $schedule=\App\Schedule::findOrFail($id);     
        $schedule->status=1;
		$date=now();
        $format = date_format($date,"Y-m-d H:i:s");
		$schedule->modified_by = auth()->user()->id;		
        $schedule->updated_at = strtotime($format);
		$schedule->trial_confirm_by = auth()->user()->id;
		$schedule->save();
        return redirect()->action(
            'ScheduleController@index'
        )->with('success', 'Schedule Status Confirmed.');
    }	

//DEAD CONFIRMATION
    public function deadconfirmation($id)
    {
        //
		//echo $id;exit;
		$dead_reason = config('constants.dead_reason');
        $schedule=\App\Schedule::findOrFail($id);
		return view('schedule.deadconfirmation',compact('schedule','id','dead_reason'));
    }

    //confirm dead	
    public function confirmdead(Request $request, $id)
    {
		//
		    $this->validate(request(), [
            'comments_dead' => 'required',
			'dead_reason' => 'required',
			'record_link_dead' => 'required',
        ]);		
		$id = $request->id;

		//$this->authorize('status-parents');
        $schedule=\App\Schedule::findOrFail($id);
		if($schedule->status==1){
			$schedule->comments_dead=$request->comments_dead;
			$schedule->dead_reason=$request->dead_reason;
			$schedule->record_link_dead=$request->record_link_dead;
			$schedule->status_dead=1;
			$date=now();
			$format = date_format($date,"Y-m-d H:i:s");
			$schedule->dead_date = strtotime($format);
			$schedule->dead_by = auth()->user()->id;
			$schedule->modified_by = auth()->user()->id;
			$schedule->updated_at = strtotime($format);
			$schedule->save();
			return redirect()->action(
				'ScheduleController@index'
			)->with('success', 'Schedule Moved to DC List.');
		}else{
			return redirect()->action(
				'ScheduleController@index'
			)->with('failed', 'Schedule not confirmed yet.');			
		}
		
    }
	
	//Dead confirmation list
    public function deadconfirmation_list()
    {
        //
		$plan = config('constants.plan');		
		$dead_reason = config('constants.dead_reason');
        $deadconfirmation_list = \App\Schedule::where('status','1')->where('status_dead','1')->whereIn('std_status',[1,2,5])->with('agentname')->with('teachername')->with('studentname')->with('coursename')->get();
		return view('schedule.deadconfirmation_list',compact('deadconfirmation_list','plan','dead_reason'));	
    }	
	
    //confirmdead list
    public function confirmdead_list($id)
    {
		//$this->authorize('status-parents');
        $schedule=\App\Schedule::findOrFail($id);
		$schedule->std_status_old=$schedule->std_status;	
        $schedule->std_status=3;
		$date=now();
		$format = date_format($date,"Y-m-d H:i:s");
		$schedule->confirm_dead_date = strtotime($format);
		$schedule->confirm_dead_by = auth()->user()->id;	
		$schedule->modified_by = auth()->user()->id;			
		$schedule->updated_at = strtotime($format);
		$schedule->save();
        return redirect()->action(
            'ScheduleController@deadconfirmation_list'
        )->with('success', 'Schedule DC Successful.');
    }

    //back to Schedule from DEAD LIST
    public function toScheduleFromDeadList($id)
    {
		//$this->authorize('status-parents');
        $schedule=\App\Schedule::findOrFail($id);
		$schedule->status_dead=0;
		$date=now();
		$format = date_format($date,"Y-m-d H:i:s");
		$schedule->modified_by = auth()->user()->id;			
		$schedule->updated_at = strtotime($format);
		$schedule->save();
        return redirect()->action(
            'ScheduleController@index'
        )->with('success', 'Schedule has been moved Back to Manage Schedule.');
    }	

	//Make Regular		create
	public function createMakeRegular($id)
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
		$show_schedule = \App\Schedule::with('teachername')->with('studentname')->with('coursename')->with('parent_name')->with('agentname')->with('parentdetail_relation')->find($id);
		$students_list = \App\User::where('iscustomer',3)->where('id',$show_schedule->studentID)->get();
		//End date
		$systemdate = systemDate();
		$end_date_readonly = date('Y-m-d', strtotime(nl2br($systemdate). ' + 1000 days'));
		//
		$data = [
			'classType' => $plan[$show_schedule->classType],
			'std_status' => $stdStatus[$show_schedule->std_status],
			'studentID' => $show_schedule->studentID,
			'teacherID' => $show_schedule->teacherID,
			'agentId' => $show_schedule->agentId,
			//'country' => $country[$show_schedule->studentname->parent_name->parentdetail_relation['countryID']],
			
		];
		$teachers_list=\App\User::where('role_id',30)->get();
		$employees_list=\App\User::whereIn('role_id',[30,31])->get();
		return view('schedule.createMakeRegular',compact('id','show_schedule','data','paymentMode','bankNameList','currency','end_date_readonly','teachers_list','employees_list'));
    }

	//Make Regular		store
    public function storeMakeRegular(Request $request)
    {
        //	
		$schedule_id = $request->get('schedule_id');
		$teacherID = $request->get('teacherID');
		$studentID = $request->get('studentID');
		$agentId = $request->get('agentId');

		
		
		$systemdate = systemDate();
		$this->validate(request(), [
            'studentID' => 'required',
            'teacherID' => 'required',
			'schedule_id' => 'required',
			
            'signInDate' => 'required',
            'dateReceived' => 'required',
            'paydate' => 'required',
            'transactionID' => 'required',
            'method_id' => 'required|not_in:0',
            'currency_id' => 'required|not_in:0',
			
            'amountDefaultNew' => 'required',
            'amountOriginalNew' => 'required',
            'totalReceivedNew' => 'required',	
            'amountUsdSimpleNew' => 'required',
			
            'sender_name' => 'required',
            'email' => 'required',
            'agent_comm' => 'required',
            'teacher_comm' => 'required',
            'comments' => 'required',
            'record_link' => 'required', 
			'bank_payment_image' => 'nullable|mimes:jpeg,jpg,bmp,png|max:200',
        ],
		[
			//custom messages
			'transactionID.required' => 'The transaction must not be Empty',
			'method_new.required' => 'Select Method',
			'currency_id.required' => 'Select Currency',
			'amountDefaultNew.required' => 'Actual Slot rate must not be Empty/Zero',
			'amountOriginalNew.required' => 'Invoiced Amount must not be Empty/Zero',
			'totalReceivedNew.required' => 'Net Received must not be Empty/Zero',
			'amountUsdSimpleNew.required' => 'Amount USD must not be Empty/Zero',
			//'bank_payment_image.size' => 'File Size Limit:500',
		]);
		
        if($request->hasfile('bank_payment_image'))
         {
            $file = $request->file('bank_payment_image');
            $slip_image=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/slips', $slip_image);
         }else{
            $slip_image="";
         }		
		//echo $slip_image;exit;
		//dd($request);
		
		//Paypal TranId verfication		//START
		$tran_id = $_POST['transactionID'];
		//639028736N876545V
		$response = get_transaction_details($tran_id);
		$ACK = $response['ACK'];
		if($ACK == 'Success'){
		$PAYMENTSTATUS = $response['PAYMENTSTATUS'];
		$RECEIVEREMAIL = $response['RECEIVEREMAIL'];
		$EMAIL = $response['EMAIL'];
		$SHIPTOCOUNTRYNAME = $response['SHIPTOCOUNTRYNAME'];
		$TIMESTAMP = $response['TIMESTAMP'];
		$FIRSTNAME = $response['FIRSTNAME'];
		$LASTNAME = $response['LASTNAME'];
		$TRANSACTIONID = $response['TRANSACTIONID'];
		$ORDERTIME = $response['ORDERTIME'];
		$AMT = $response['AMT'];
		$FEEAMT = $response['FEEAMT'];
		$CURRENCYCODE = $response['CURRENCYCODE'];
		$L_TAXAMT0 = $response['L_TAXAMT0'];
		$L_CURRENCYCODE0 = $response['L_CURRENCYCODE0'];
		$L_AMT0 = $response['L_AMT0'];
		//Paypal TranId verfication		//END	
		}
		else{
			$PAYMENTSTATUS='';
		}

		//dd($response);		
		if($PAYMENTSTATUS=='Completed' && $request->get('method_id')==1){
			$transaction= new \App\Transaction;
			//Making values
			$signInDate = date_create($request->get('signInDate'));
			$signInDate = date_format($signInDate,"Y-m-d");
			//$transaction->signInDate = strtotime($signInDate);
			
			$dateReceived = date_create($request->get('dateReceived'));
			$dateReceived = date_format($dateReceived,"Y-m-d");
			$transaction->date = strtotime($dateReceived);

			$paydate = date_create($request->get('paydate'));
			$paydate = date_format($paydate,"Y-m-d");
			$transaction->dateMonth = strtotime($paydate);
		
			$transaction->transactionID = $request->get('transactionID');
			$transaction->studentID = $request->get('studentID');
			$transaction->teacherID = $request->get('teacherID');
			$transaction->schedule_id = $request->get('schedule_id');
			$transaction->method_array = $request->get('method_id');
			$transaction->currency_array = $request->get('currency_id');
			$transaction->comments = $request->get('comments');
			$transaction->created_by = auth()->user()->id;
			$transaction->sender_name = $request->get('sender_name');
			$transaction->email = $request->get('email');
			$transaction->agentId = $agentId;
			$transaction->signupChk = 1;
			$transaction->accounts_chk = $request->get('accounts_chk');
			$transaction->agent_comm = $request->get('agent_comm');
			$transaction->teacher_comm = $request->get('teacher_comm');
			$transaction->cardSave_ccv_code = $request->get('cardSave_ccv_code');
			$transaction->VirtualTerminal_name = $request->get('VirtualTerminal_name');
			$transaction->VirtualTerminal_number = $request->get('VirtualTerminal_number');
			$transaction->slipImage = $slip_image;
			$transaction->bankNameId = $request->get('bankNameId');	
			//Amounts
			//Org Currency
			$transaction->amountDefaultNew = $request->get('amountDefaultNew');
			$transaction->amountOriginalNew = $request->get('amountOriginalNew');
			$transaction->feeDeductNew = $request->get('feeDeductNew');
			$transaction->totalReceivedNew = $request->get('totalReceivedNew');
			$transaction->discountNew = $request->get('discountNew');
			$transaction->additionalFee = $request->get('additionalFee');
			//USD Currency
			$transaction->amountDefaultNew_Usd = $request->get('amountDefaultNew_Usd');
			$transaction->amountOriginalNew_Usd = $request->get('amountOriginalNew_Usd');
			$transaction->feeDeductNew_Usd = $request->get('feeDeductNew_Usd');
			$transaction->totalReceivedNew_Usd = $request->get('amountUsdSimpleNew');
			$transaction->discountNew_Usd = $request->get('discountNew_Usd');
			$transaction->additionalFee_Usd = $request->get('additionalFee_Usd');
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");		
			$transaction->created_at = strtotime($format);
			$transaction->updated_at = strtotime($format);
			$transaction->save();
			//getting last inserted TRAN ID from transaction table to be stored in paypalverification
			$last_transaction_id = $transaction->id;			
			
			//Updating values in SCHEDULE
			$Schedule = \App\Schedule::find($request->get('schedule_id'));
			//if($Schedule->std_status!='2'){
				$courseStart = date_create($request->get('courseStart'));
				$courseStart = date_format($courseStart,"Y-m-d");
				$courseEnd = date_create($request->get('courseEnd'));
				$courseEnd = date_format($courseEnd,"Y-m-d");
				$Schedule->dues_original = $request->get('amountDefaultNew');
				$Schedule->dues_usd = $request->get('amountDefaultNew_Usd');		
				$Schedule->currency_array = $request->get('currency_id');
				$Schedule->duedate = strtotime($signInDate);
				$Schedule->paydate = strtotime($paydate);
				$Schedule->std_status_old = $Schedule->std_status;
				$Schedule->std_status = 2;
				$Schedule->startDate = strtotime($courseStart);		
				$Schedule->endDate = strtotime($courseEnd);
				$Schedule->grade = $request->get('grade');
				$Schedule->syllabus = $request->get('syllabus');
				$Schedule->record_link_signup = $request->get('record_link_signup');		
				$Schedule->modified_by = auth()->user()->id;
				$Schedule->save();
			//}
				//PAYPAL VERIFICATION		start
				$row_count_paypal = \App\Paypalverification::where("transactionID",$request->get('transactionID'))
				->count();
				
				if($row_count_paypal>=1){
					//DO Nothing
				}
				else{
					$paypalverification= new \App\Paypalverification;
					$paypalverification->receiverEmail = $RECEIVEREMAIL;				
					$paypalverification->email = $EMAIL;
					$paypalverification->shipToCountryName = $SHIPTOCOUNTRYNAME;
			$TIMESTAMP = date_create($TIMESTAMP);
			$TIMESTAMP = date_format($TIMESTAMP,"Y-m-d H:i:s");					
					$paypalverification->paymentDone = strtotime($TIMESTAMP);
					$paypalverification->customerName = $FIRSTNAME." ".$LASTNAME;
					$paypalverification->transactionID = $TRANSACTIONID;
			$ORDERTIME = date_create($ORDERTIME);
			$ORDERTIME = date_format($ORDERTIME,"Y-m-d");					
					$paypalverification->invoiceDate = strtotime($ORDERTIME);
					$paypalverification->amount = $AMT;
					$paypalverification->feeamount = $FEEAMT;
					$paypalverification->currencyCode = $CURRENCYCODE;
					$paypalverification->paymentStatus = $PAYMENTSTATUS;
					$paypalverification->L_TAXAMT0 = $L_TAXAMT0;
					$paypalverification->L_CURRENCYCODE0 = $L_CURRENCYCODE0;
					$paypalverification->L_AMT0 = $L_AMT0;
					$paypalverification->tran_id = $last_transaction_id;
					$date=date_create($request->get('date'));
					$format = date_format($date,"Y-m-d");		
					$paypalverification->created_at = strtotime($format);
					$paypalverification->updated_at = strtotime($format);	
					$paypalverification->save();					
					
				}
				//PAYPAL VERIFICATION		end			
			return redirect('schedule/')->with('success', 'Schedule successfully MADE REGULAR.');
		}
		else{
			if(($PAYMENTSTATUS=='' || $PAYMENTSTATUS!='Completed') && $request->get('method_id')!=1) {
				$transaction= new \App\Transaction;
				//Making values
				$signInDate = date_create($request->get('signInDate'));
				$signInDate = date_format($signInDate,"Y-m-d");
				//$transaction->signInDate = strtotime($signInDate);
				
				$dateReceived = date_create($request->get('dateReceived'));
				$dateReceived = date_format($dateReceived,"Y-m-d");
				$transaction->date = strtotime($dateReceived);

				$paydate = date_create($request->get('paydate'));
				$paydate = date_format($paydate,"Y-m-d");
				$transaction->dateMonth = strtotime($paydate);

				$transaction->transactionID = $request->get('transactionID');				
				$transaction->studentID = $request->get('studentID');
				$transaction->teacherID = $request->get('teacherID');
				$transaction->schedule_id = $request->get('schedule_id');
				$transaction->method_array = $request->get('method_id');
				$transaction->currency_array = $request->get('currency_id');
				$transaction->comments = $request->get('comments');
				$transaction->created_by = auth()->user()->id;
				$transaction->sender_name = $request->get('sender_name');
				$transaction->email = $request->get('email');
				$transaction->agentId = $agentId;
				$transaction->signupChk = 1;
				$transaction->accounts_chk = $request->get('accounts_chk');
				$transaction->agent_comm = $request->get('agent_comm');
				$transaction->teacher_comm = $request->get('teacher_comm');
				$transaction->cardSave_ccv_code = $request->get('cardSave_ccv_code');
				$transaction->VirtualTerminal_name = $request->get('VirtualTerminal_name');
				$transaction->VirtualTerminal_number = $request->get('VirtualTerminal_number');
				$transaction->slipImage = $slip_image ;
				$transaction->bankNameId = $request->get('bankNameId');	
				//Amounts
				//Org Currency
				$transaction->amountDefaultNew = $request->get('amountDefaultNew');
				$transaction->amountOriginalNew = $request->get('amountOriginalNew');
				$transaction->feeDeductNew = $request->get('feeDeductNew');
				$transaction->totalReceivedNew = $request->get('totalReceivedNew');
				$transaction->discountNew = $request->get('discountNew');
				$transaction->additionalFee = $request->get('additionalFee');
				//USD Currency
				$transaction->amountDefaultNew_Usd = $request->get('amountDefaultNew_Usd');
				$transaction->amountOriginalNew_Usd = $request->get('amountOriginalNew_Usd');
				$transaction->feeDeductNew_Usd = $request->get('feeDeductNew_Usd');
				$transaction->totalReceivedNew_Usd = $request->get('amountUsdSimpleNew');
				$transaction->discountNew_Usd = $request->get('discountNew_Usd');
				$transaction->additionalFee_Usd = $request->get('additionalFee_Usd');
				$date=date_create($request->get('date'));
				$format = date_format($date,"Y-m-d");		
				$transaction->created_at = strtotime($format);
				$transaction->updated_at = strtotime($format);
				$transaction->save();		
				
				//Updating values in SCHEDULE
				$Schedule = \App\Schedule::find($request->get('schedule_id'));
				$courseStart = date_create($request->get('courseStart'));
				$courseStart = date_format($courseStart,"Y-m-d");
				$courseEnd = date_create($request->get('courseEnd'));
				$courseEnd = date_format($courseEnd,"Y-m-d");
				$Schedule->dues_original = $request->get('amountDefaultNew');
				$Schedule->dues_usd = $request->get('amountDefaultNew_Usd');		
				$Schedule->currency_array = $request->get('currency_id');
				$Schedule->duedate = strtotime($signInDate);
				$Schedule->paydate = strtotime($paydate);
				$Schedule->std_status_old = $Schedule->std_status;
				$Schedule->std_status = 2;
				$Schedule->startDate = strtotime($courseStart);		
				$Schedule->endDate = strtotime($courseEnd);
				$Schedule->grade = $request->get('grade');
				$Schedule->syllabus = $request->get('syllabus');
				$Schedule->record_link_signup = $request->get('record_link_signup');		
				$Schedule->modified_by = auth()->user()->id;
				$Schedule->save();
				return redirect('schedule/')->with('success', 'Schedule successfully MADE REGULAR.');				
			}
			else{
				return redirect('schedule/createMakeRegular/'.$schedule_id)->with('failed', 'Paypal Verfication Error');	
			}
		}
    }	
	
	public function getCurrencyValueFromDB(Request $request)
	{
		if($request->ajax()){
			$currency_id=intval($request->get('currency_id'));
			if($currency_id==1){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_gbp_to_usd;
				//dd($getCurrencyValue_query);
			}
			if($currency_id==2){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_usd_to_usd;
			}
			if($currency_id==3){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_cad_to_usd;
			}
			if($currency_id==4){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_aud_to_usd;
			}
			if($currency_id==5){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_nzd_to_usd;
			}
			if($currency_id==6){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_sgd_to_usd;
			}
			if($currency_id==7){
				$getCurrencyValue_query = DB::table('currencies')->find(DB::table('currencies')->max('id'));
				$currency_value = $getCurrencyValue_query->one_pkr_to_usd;
			}		
			$data = view('schedule.getCurrencyValueFromDB',compact('currency_value'))->render();
    		return response()->json(['responseText'=>$data]);

    	}

	}

	//Edit fee
    public function editfee($id)
    {
        //
		$edit_schedule = \App\Schedule::with('teachername')->with('studentname')->find($id);
		//dd($edit_schedule);
		$currency = config('constants.currency');
		return view('schedule.editfee',compact('id','edit_schedule','currency'));
    }

	//Update fee
    public function updatefee(Request $request, $id)
    {
        //
		$systemdate = systemDate();
		$scheduleEdit = $id;		
		
		$this->validate(request(), [
            'dues_original' => 'required',
            'dues_usd' => 'required',
            'currency_id' => 'required|not_in:0',
			'duedate' => 'required',
			'paydate' => 'required',
        ]);

		//dd($request);
		
		$Schedule = \App\Schedule::find($id);
		//Making values
		echo $dues_original = $request->get('dues_original');echo "<br>";
		echo $dues_usd = $request->get('dues_usd');echo "<br>";		
		echo $currency_id = $request->get('currency_id');echo "<br>";		

		$duedate = date_create($request->get('duedate'));
		$duedate = date_format($duedate,"Y-m-d");
		
		$paydate = date_create($request->get('paydate'));
		$paydate = date_format($paydate,"Y-m-d");

		
        $Schedule->modified_by = auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $Schedule->updated_at = strtotime($format);
        $Schedule->dues_original = $dues_original;
        $Schedule->dues_usd = $dues_usd;
        $Schedule->currency_array = $currency_id;
		$Schedule->duedate = strtotime($duedate);
		$Schedule->paydate = strtotime($paydate);
        $Schedule->save();
		return redirect('schedule/')->with('success', 'Schedule Fee Updated successfully.');		
    }	
	
	
}
