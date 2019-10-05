<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Validator;
use App\User;
use App\Role;
use App\Schedule;
use App\StudentAttendance;

use App\Dua;
use App\Prayer;
use App\Syllabuslesson;
use App\Surah;
use App\Preference;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Mail;
use Illuminate\Support\Facades\Storage;
use File;
use Image;

class DailyScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
		$systemdate = systemDate();
		$daily_schedules = array();
		//Auto filter of Current day**********************
		$ccms_week_day = date('l', strtotime( $systemdate));//echo "<br>"; // Calculationg CCMS week day
		$result = getPlan($ccms_week_day);
		$ccms_week_day_number = date('w', strtotime( $systemdate));//echo "<br>"; // Calculationg CCMS week day number
		//************************************************		
		$plan = config('constants.plan');
		$classdays = config('constants.days');
		if(Auth()->user()->role_id==30){
			$classDate = $systemdate;
			$daily_schedules = \App\Schedule::where('status','1')->where('status_dead','0')
			->where('teacherID',auth()->user()->id)
			->whereIn('std_status',[1, 2, 5])
			->with('teachername')->with('studentname')->with('coursename')
			->whereRaw("classType IN ($result)")
			->get();
			foreach($daily_schedules as $daily_schedule)
			{
				$invalid[$daily_schedule->id]=getClassStatus($daily_schedule->id,$classDate);
				$daily_schedule->id;
			}
		}	
		if(Auth()->user()->role_id==1){
			
			if($request->get('teacherID') && $request->get('classDate')){
				$teacherID = $request->get('teacherID');
				$classDate = $request->get('classDate');
				$days = $request->get('days')[0];
				//Calculating the index keys from helper function
				$result = getPlan($days);
				$daily_schedules = \App\Schedule::where('status','1')->where('status_dead','0')
				->where('teacherID',$teacherID)
				->whereIn('std_status',[1, 2, 5])
				->with('teachername')->with('studentname')->with('coursename')
				->whereRaw("classType IN ($result)")
				//->where('startDate','<=',$classDate)
				//->where('endDate','>=',$classDate)
				->get();
				foreach($daily_schedules as $daily_schedule)
				{
					$invalid[$daily_schedule->id]=getClassStatus($daily_schedule->id,$classDate);
					$daily_schedule->id;
				}
				//print_r($invalid);
			}
			else{
				$daily_schedules = \App\Schedule::where('status','2')->get();//status=2 is nothing
			}
			//dd($classdays);
		}
		$teachers_list = \App\User::where('role_id',30)->where('status',1)->get();
		return view('daily_schedule.list',compact('daily_schedules','teachers_list','plan','classdays','invalid'));
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
    public function edit($id)
    {
        //
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
//startClassFunction	
    public function startClassFunction($id)
    {
        //
		$systemdate = systemDate();
		$id = $id;
		if (isset($id)) { 
		$_invalid=getClassStatus($id,$systemdate);
			if($_invalid=='2'){
				$_eid=startClass($id);//.$id
				return redirect('/daily_schedule')->with('success', 'Class started Successfully.');
			}
			else{
				return redirect('/daily_schedule')->with('failed', 'Class already Started');
			}
		} 
		
    }

//endClass
    public function endClass($id)
    {
        //
		$systemdate = systemDate();
		$id = $id;
		$verses = config('constants.verse');
		$duas = \App\Dua::all();
		$prayers = \App\Prayer::all();
		$syllabus = \App\Syllabuslesson::all();
		//exit;
		$surahs = \App\Surah::all();
		
		//Quran subjects array values
		$quran_subjects = array(11,28,29,30,31);
		$systemdate = systemDate();
		$_id=getClassId($id,$systemdate);
		$student_attendance = \App\StudentAttendance::find($_id);
		/////////////////////////////
		//get grade from schedule
		$schedule = \App\Schedule::find($id);
		$sch_garde = $schedule->grade;
		//
		$course_list = config('constants.course_list');
			if(in_array($student_attendance->courseID,$quran_subjects))
			{
				$subject_is_quran=1;
			}
			else
			{
				$subject_is_quran=0;
			}
			
		if (isset($id)) { 
			return view('daily_schedule.endClass',compact('id','duas','prayers','syllabus','surahs','verses','subject_is_quran','sch_garde'));
		} 
		
    }

//endClassFunction
    public function endClassFunction(Request $request, $id)
    {	
	$systemdate = systemDate();
	$_id=getClassId($id,$systemdate);
		$id = $request->id;
		    $this->validate(request(), [
            'status' => 'required|in:0,1',
			'lecture_file' => 'mimes:jpeg,png|max:200', 
        ],
		[
			//custom messages
			'status.required' => '(Select Status)',

		]
		);		
        if($request->hasfile('lecture_file'))
         {
/*             $file = $request->file('lecture_file');
            $lecture_file=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/lectures', $lecture_file); */
			//Move Image to Storage Folder
			$name = $request->lecture_file;
			$cover = $request->file('lecture_file');
			$lecture_file  = date('YmdHis').$name->getClientOriginalName();			
			Storage::disk('public')->put("/img/lectures/".$lecture_file,  File::get($cover));
         }else{
			$lecture_file='';
		 }
		//Updating values
		$student_attendance = \App\StudentAttendance::with('studentname')->with('teachername')->find($_id);

		$plan = config('constants.plan');
		$class_status = config('constants.class_status');
		$student_attendance->status = $request->get('status');
		  $timenow = time();
		  $newtime = $timenow;		
		$student_attendance->endTime = date('H:i:s' , $newtime);
		$student_attendance->comments = $request->get('comments');
		$student_attendance->grade = $request->get('grade');
		$student_attendance->lessonDetails = $request->get('lessonDetails');
		$student_attendance->lecture_image_filepath = $lecture_file;
		$student_attendance->dua = $request->get('dua');
		$student_attendance->prayer = $request->get('prayer');	
		$student_attendance->kalima = $request->get('kalima');
		$student_attendance->lesson = $request->get('lesson');
		$student_attendance->surah = $request->get('surah');
		$student_attendance->verseFrom = $request->get('verseFrom');
		$student_attendance->verseTo = $request->get('verseTo');
		$student_attendance->record_link = $request->get('record_link');
		$student_attendance->updated_by = auth()->user()->id;
        $student_attendance->save();

		$preferences= \App\Preference::whereIn('option',['studentlecture'])->get();
            foreach($preferences as $preference){
                if($preference->option=='studentlecture'){
                    $studentlecture=$preference->value;
                }
            }		
		if($studentlecture){
		//Class start/end email send
		$student_parent = \App\User::where('iscustomer',3)->with('parent_name')->find($student_attendance->studentID);
		$status = getData(nl2br($request->get('status')),$class_status);
		$classType = getData(nl2br($student_attendance['classType']),$plan);
		$studentName = $student_attendance->studentname['fname']." ".$student_attendance->studentname['lname'];
		$teacherName = $student_attendance->teachername['fname']." ".$student_attendance->teachername['lname'];
		$lessonDetails = $request->get('lessonDetails');
		$parent_name = $student_parent->parent_name['fname']." ".$student_parent->parent_name['lname'];
		
		$data = array('systemdate'=>$systemdate,'status'=>$status,'classType'=>$classType,
		'studentName'=>$studentName,'teacherName'=>$teacherName,'lessonDetails'=>$request->get('lessonDetails'),
		'parents'=>$parent_name);
		Mail::send('daily_schedule.class_startend_template', $data, function($message) {
		$message->to('junaid9898@yahoo.com', 'Lecture details')->subject
		('Laravel HTML Testing Mail');
		$message->from('xyz@gmail.com','Lecture details test environment');
		});		
		//Class start/end email send
		}
		return redirect('daily_schedule/')->with('success', 'Class Ended successfully.');
	}
	
    public function classDetails(Request $request)
    {
        //
		$systemdate = systemDate();
		$role_id = '';
		$student_attendances = array();
		//Auto filter of Current day**********************
		$ccms_week_day = date('l', strtotime( $systemdate));//echo "<br>"; // Calculationg CCMS week day
		$result = getPlan($ccms_week_day);
		//$ccms_week_day_number = date('w', strtotime( $systemdate));//echo "<br>"; // Calculationg CCMS week day number
		//************************************************		
		$plan = config('constants.plan');
		$classdays = config('constants.days');
		$present_absent = config('constants.class_status');		
		if(Auth()->user()->role_id==30){
				$role_id = Auth()->user()->role_id;
				$teacherID = auth()->user()->id;
				$studentID = $request->get('studentID');
				$dateFrom = $request->get('dateFrom');
				$dateTo = $request->get('dateTo');
				$search_submit = $request->get('search-submit');
			if($search_submit==1){
			$student_attendances = \App\StudentAttendance::with('stu_attendance')->with('getdua')
			->whereHas('teachername', function ($query) use($teacherID,$studentID,$search_submit) {
							})				
			->when($teacherID, function ($query) use ($teacherID) {
								return $query->where('teacherID', auth()->user()->id);
							})	
			->when($studentID, function ($query) use ($studentID) {
								return $query->where('studentID', $studentID);
							})
			->when($dateFrom, function ($query) use ($dateFrom) {
								return $query->where('date','>=', $dateFrom);
							})
			->when($dateTo, function ($query) use ($dateTo) {
								return $query->where('date','<=', $dateTo);
							})								
            ->get();
			}
			else{
				$student_attendances = \App\StudentAttendance::where('status','2')->get();//status=2 is nothing
			}
			
		} 
		if(Auth()->user()->role_id==1){
			//echo "CD:";exit;
			$role_id = Auth()->user()->role_id;
			if($request->get('teacherID') || $request->get('studentID') || ($request->get('dateFrom') && $request->get('dateTo'))){
				$teacherID = $request->get('teacherID');
				$studentID = $request->get('studentID');
				$dateFrom = $request->get('dateFrom');
				$dateTo = $request->get('dateTo');	
				$class_status = $request->get('class_status');	
				//Calculating the index keys from helper function		
//Custom query, I will keep it				
/* 		$student_attendances = DB::table('users')
            ->join('student_attendances', 'users.id', '=', 'student_attendances.teacherID')
            ->select('users.*', 'student_attendances.*', 'users.fname as fname', 'users.lname as lname','student_attendances.schedule_id as sch_id' )		
->when($teacherID, function ($query) use ($teacherID) {
                    return $query->where('users.id', $teacherID);
                })				
->when($studentID, function ($query) use ($studentID) {
                    return $query->where('student_attendances.studentID', $studentID);
                })
			->get();	 */		
			$student_attendances = \App\StudentAttendance::with('stu_attendance')->with('getdua')
			->whereHas('teachername', function ($query) use($teacherID,$studentID) {
							})
			->when($teacherID, function ($query) use ($teacherID) {
								return $query->where('teacherID', $teacherID);
							})	
			->when($studentID, function ($query) use ($studentID) {
								return $query->where('studentID', $studentID);
							})
			->when($dateFrom, function ($query) use ($dateFrom) {
								return $query->where('date','>=', $dateFrom);
							})
			->when($dateTo, function ($query) use ($dateTo) {
								return $query->where('date','<=', $dateTo);
							})
//
			->when($class_status != '-1', function ($query) use ($class_status) {
								return $query->where('status','=', $class_status);
							})							
            ->get();	
				$student_attendances;
			}
			else{
				$student_attendances = \App\Schedule::where('status','2')->get();//status=2 is nothing
			}
		}
		$teachers_list = \App\User::where('role_id',30)->where('status',1)->get();
		$students_list = \App\User::where('iscustomer',3)->where('status',1)->get();
		return view('daily_schedule.class_details',compact('student_attendances','teachers_list','students_list','plan','classdays','invalid','role_id','present_absent'));
    }

//startClass_manual_absent_teacher	[//Manual absent from daily schedule]
    public function startClass_manual_absent_teacher($id)
    {
        //
		$systemdate = systemDate();
		$id = $id;
		if (isset($id)) { 
		$_invalid=getClassStatus($id,$systemdate);
			if($_invalid=='2'){
			  $_row=getSchedule($id);  
			  $timenow = time();
			  $newtime = $timenow;
			  //$operator_name = \App\User::find(auth()->user()->id);
			  //$operator_name = $operator_name->fname." ".$operator_name->lname;
			  $student_attendance = new \App\StudentAttendance;
			  $student_attendance->studentID = $_row[0]->studentID;
			  $student_attendance->teacherID = $_row[0]->teacherID;
			  $student_attendance->courseID = $_row[0]->courseID;
			  $student_attendance->classType = $_row[0]->classType;
			  $student_attendance->std_status = $_row[0]->std_status;
			  $student_attendance->startTime = $_row[0]->startTime;
			  $student_attendance->classStartTime = date('H:i:s' , $newtime);
			  $student_attendance->date = $systemdate;
			  $student_attendance->status = 0;
			  $student_attendance->comments = 'Marked absent';
			  $student_attendance->endTime = date('H:i:s' , $newtime);
			  $student_attendance->created_by = auth()->user()->id;  
			  $student_attendance->schedule_id = $id;
			  $student_attendance->save();			
				return redirect('/daily_schedule')->with('success', 'Class marked absent Successfully.');
			}
			else{
				return redirect('/daily_schedule')->with('failed', 'Class already Started');
			}
		} 
		
    }
	
}
