<?php
use App\User;
use App\TeacherTiming;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherTimingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$time=array('Select [label] ','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');
		$teacher_timings = \App\TeacherTiming::with('teachername')->get();
		return view('teacher_timing.list',compact('teacher_timings','time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$teachers_list=\App\User::where('role_id',30)->get();			
		return view('teacher_timing.create',compact('teachers_list'));			
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
		//dd($request->all());exit;
		$this->validate(request(), [
            'teacherID' => 'required',
            'startTime' => 'required',
			'endTime' => 'required'
        ]);
		
		$TeacherTiming= new \App\TeacherTiming;
		$TeacherTiming->sun=($request->get('sun')) ? 1: 0;
		$TeacherTiming->mon=($request->get('mon')) ? 1: 0;
		$TeacherTiming->tue=($request->get('tue')) ? 1: 0;
		$TeacherTiming->wed=($request->get('wed')) ? 1: 0;
		$TeacherTiming->thu=($request->get('thu')) ? 1: 0;
		$TeacherTiming->fri=($request->get('fri')) ? 1: 0;
		$TeacherTiming->sat=($request->get('sat')) ? 1: 0;		
        $TeacherTiming->teacher_id=$request->get('teacherID');
		$TeacherTiming->startTime=$request->get('startTime');
		$TeacherTiming->endTime=$request->get('endTime');
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $TeacherTiming->created_at = strtotime($format);
        $TeacherTiming->updated_at = strtotime($format);
        $TeacherTiming->save();
		return redirect('teacher_timing/')->with('success', 'Timings added successfully.');
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
		$edit_timing = \App\TeacherTiming::find($id);
		$time=array('Select [label] ','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');		
		$teachers_list=\App\User::where('role_id',30)->get();
		return view('teacher_timing.edit',compact('id','time','teachers_list','edit_timing'));
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
		//dd($request->all());exit;
		$this->validate(request(), [
            'teacherID' => 'required',
            'startTime' => 'required',
			'endTime' => 'required'
        ]);
		
		$TeacherTiming= \App\TeacherTiming::find($id);
		$TeacherTiming->sun=($request->get('sun')) ? 1: 0;
		$TeacherTiming->mon=($request->get('mon')) ? 1: 0;
		$TeacherTiming->tue=($request->get('tue')) ? 1: 0;
		$TeacherTiming->wed=($request->get('wed')) ? 1: 0;
		$TeacherTiming->thu=($request->get('thu')) ? 1: 0;
		$TeacherTiming->fri=($request->get('fri')) ? 1: 0;
		$TeacherTiming->sat=($request->get('sat')) ? 1: 0;
        $TeacherTiming->teacher_id=$request->get('teacherID');
		$TeacherTiming->startTime=$request->get('startTime');
		$TeacherTiming->endTime=$request->get('endTime');
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $TeacherTiming->created_at = strtotime($format);
        $TeacherTiming->updated_at = strtotime($format);
        $TeacherTiming->save();
		return redirect('teacher_timing/')->with('success', 'Timings updated successfully.');		
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
		$TeacherTiming = \App\TeacherTiming::find($id);
		$TeacherTiming->delete();
		return redirect()->action(
			'TeacherTimingController@index' 
		)->with('success', 'Teacher Timings has been deleted.');		
    }
}
