<?php
use App\User;
use App\TeacherCourse;
use App\Courses;
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use DB;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		//$teacher_courses=\App\TeacherCourse::all();
		
		//$teacher_courses = \App\TeacherCourse::with('teachername');
		$teacher_courses = \App\TeacherCourse::with('teachername')->get();
		return view('teacher_course.list',compact('teacher_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		//$course_list=array('Select Course','MS Office','Graphics Designinig','Web Designing','Web Development-PHP','AutoCad','Bundle','Design and Development','Basic Networking','English','CCNA','Quran Pak','Web Development-.Net','Physics','Chemistry','Biology','Math-Minor','Urdu','French','C++','ACCA','Accounts','Economics','Science','Calculus','Statistics','Math-Major','Assignments','QURAN WITH TAJWEED','HIFZ QURAN','TRANSLATION OF QURAN','ISLAMIC EDUACTION','SMM');
		$course_list = \DB::table('courses')->pluck('courses', 'id');
		$teachers_list=\App\User::where('role_id',30)->get();
		return view('teacher_course.create',compact('course_list','teachers_list'));
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
		$this->validate(request(), [
            'teacherID' => 'required',
            'courseID' => 'required'
        ]);
		
		$course_post = $request->get('courseID');
		foreach($course_post as $course){
			//checking duplication
			$output = \DB::select('SELECT * FROM teacher_courses 
			WHERE teacher_id='.$request->get('teacherID').' AND course_id='.$course.'');
			if($output){
				return redirect('teacher_course/')->with('success', 'Courses Duplication Not Added.');			
			}
			else{
			$TeacherCourse= new \App\TeacherCourse;
			$TeacherCourse->teacher_id=$request->get('teacherID');
			$TeacherCourse->course_id=$course;
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$TeacherCourse->created_at = strtotime($format);
			$TeacherCourse->updated_at = strtotime($format);
			$TeacherCourse->save();
			//dd($request->all());
			}
		}
		return redirect('teacher_course/')->with('success', 'Courses added successfully.');
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
		return view('teacher_course.show',compact('id'));
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
		$edit_course = \App\TeacherCourse::find($id);
		$course_list = \App\Courses::all();
		$teachers_list=\App\User::where('role_id',30)->get();
		return view('teacher_course.edit',compact('id','edit_course','course_list','teachers_list'));

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
		$this->validate(request(), [
            'teacherID' => 'required',
            'courseID' => 'required'
        ]);
		
		$course_post = $request->get('courseID');
		
		$TeacherCourse=\App\TeacherCourse::find($id); 
        $TeacherCourse->teacher_id=$request->get('teacherID');
        $TeacherCourse->course_id=$course_post;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $TeacherCourse->updated_at = strtotime($format);
        $TeacherCourse->save();
		//dd($request->all());

		return redirect('teacher_course/')->with('success', 'Courses updated successfully.');
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
		$teachercourse = \App\TeacherCourse::find($id);
		$teachercourse->delete();
		return redirect()->action(
			'TeacherCourseController@index' 
		)->with('success', 'Teacher Course has been deleted.');
    }
}
