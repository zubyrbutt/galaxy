<?php

namespace App\Http\Controllers;

use App\ProjectTask;
use App\Project;
use DB;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\ProjectTaskNotification;
use Notification;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id=null)
    {
        
        if(!empty($project_id)){
            $tasks = ProjectTask::with('project')->with('createdby')->where('project_id',$project_id)->orderBy('id', 'DESC')->get();
            $project = \App\Project::with('createdby')->where('id',$project_id)->first();

        }else{
            return redirect('dashboard')->with('failed', 'Unknow Request or parameters');    
        }
        
        if($project){
        return view('tasks.tasks', compact('tasks','project'));
        }else{
            return view('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
		
		if($project_id){
            $project=\App\Project::find($project_id);
			$users=\App\User::with('role')->where('iscustomer',0)->get();
		}
		return view('tasks.create', compact('project','users','project_id'));
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
            'assigned_to' => 'required|numeric',
            'taskTitle' => 'required',
            'taskDescription' => 'required',
			'startDate' => 'required|date',
			'endDate' => 'required|date|after_or_equal:startDate',
        ]);
        
		//Task Creation 
        $projectTask= new \App\ProjectTask;
		$projectTask->project_id=$request->get('project_id');
        $projectTask->user_id=$request->get('assigned_to');
		$projectTask->created_by=auth()->user()->id;
        $projectTask->title=$request->get('taskTitle');
        $projectTask->description=$request->get('taskDescription');
		$startDate=date_create($request->get('startDate'));
        $startDate = date_format($startDate,"Y-m-d H:i:s");
		$endDate=date_create($request->get('endDate'));
        $endDate = date_format($endDate,"Y-m-d H:i:s");
		$projectTask->startDate=$startDate;
        $projectTask->endDate=$endDate;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $projectTask->created_at = strtotime($format);
        $projectTask->updated_at = strtotime($format);
		//dd($projectTask);
		$projectTask->save();
		$project_id = $request->get('project_id');
		$url=url('/tasks/'.$project_id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Send Notification
        if($request->get('assigned_to')!=auth()->user()->id){
            $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->where('id',$request->get('assigned_to'))->get();
            $letter = collect(['title' => 'New Task Assigned to you','body'=>'A new task has been assigned to you by '.$creator.', please review it.','redirectURL'=>$url]);
            Notification::send($users, new ProjectTaskNotification($letter));
        }
		return redirect('tasks/'.$project_id)->with('success', 'Task has been created successfully.');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id){
            $projectTask = \App\ProjectTask::with('project')->with('createdby')->with('user')->where('id',$id)->first();
            return view('tasks.show', compact('projectTask'));
        }else{
            return view('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$users=\App\User::with('role')->where('iscustomer',0)->get();
		$projectTask = \App\ProjectTask::with('project')->with('createdby')->where('id',$id)->first();
		return view('tasks.edit', compact('projectTask','users'));
		
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(), [
            'assigned_to' => 'required|numeric',
            'taskTitle' => 'required',
            'taskDescription' => 'required',
			'startDate' => 'required|date',
			'endDate' => 'required|date|after_or_equal:startDate',
        ]);
		//Task Updation
        $projectTask= \App\ProjectTask::find($id);
        if($projectTask->status==0){
            $projectTask->user_id=$request->get('assigned_to');
            $projectTask->title=$request->get('taskTitle');
            $projectTask->description=$request->get('taskDescription');
            $startDate=date_create($request->get('startDate'));
            $startDate = date_format($startDate,"Y-m-d H:i:s");
            $endDate=date_create($request->get('endDate'));
            $endDate = date_format($endDate,"Y-m-d H:i:s");
            $projectTask->startDate=$startDate;
            $projectTask->endDate=$endDate;
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $projectTask->updated_at = strtotime($format);
            $projectTask->save();
            $project_id = $request->get('project_id');
            return redirect('tasks/'.$project_id)->with('success', 'Task updated successfully.');
        }else{
            return redirect('tasks/detail/'.$id)->with('failed', 'Unable to update this task, this task is already started/ended.');
        }
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectTask  $projectTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTask $projectTask)
    {
        return false;
    }

    public function start($id)
    {
        $projectTask=\App\ProjectTask::find($id);         
        if($projectTask->user_id==auth()->user()->id && $projectTask->status==0 ){
            $projectTask->status=1;
            $projectTask->startOn = date_create(now());
            $projectTask->save();
            return redirect('tasks/detail/'.$id)->with('success', 'Task started successfully.');
        }else{
            return redirect('tasks/detail/'.$id)->with('failed', 'Unable to start this task, it seems this task is not belongs you or already started/closed.');
        }
    }

    public function end($id)
    {
        $projectTask=\App\ProjectTask::find($id);         
        if($projectTask->user_id==auth()->user()->id && $projectTask->status==1){
            $projectTask->status=2;
            $projectTask->endOn =  date_create(now());
            $projectTask->save();
            return redirect('tasks/detail/'.$id)->with('success', 'Task ended successfully.');
        }else{
            return redirect('tasks/detail/'.$id)->with('failed', 'Unable to end this task, it seems this task is not belongs you or already ended/not started.');
        }
    }

    public function reopen($id)
    {
        return false;
    }
}
