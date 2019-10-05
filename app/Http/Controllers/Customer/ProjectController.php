<?php

namespace app\Http\Controllers\Customer;

use App\Project;
use App\Projectassets;
use DB;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\ProjectNotification;
use Notification;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $projects = \App\Project::where('user_id',$id)->with('customer')->with('createdby')->get();
		return view('customer-front.projects.projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*public function create($customerid=null, $leadid=null)
    {
        
        if($customerid){
            $customers=\App\User::where('iscustomer',1)->where('id',$customerid)->get();
            $leads=\App\Lead::with('user')->with('createdby')->where('user_id',$customerid)->get();
        }else{
            $customers=\App\User::where('iscustomer',1)->get();
        }
        if($leadid){
            $leads=\App\Lead::with('user')->with('createdby')->where('id',$leadid)->get();
        }
        if(empty($customerid) && empty($leadid)){
            return redirect('projects/')->with('failed', 'Customer or Lead information is missing .');
        }
        $data['user'] = User::where('iscustomer',0)->get();
        return view('projects.create',compact('customers','leads', 'customerid', 'leadid','data'));
    }
    */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $this->validate(request(), [
            'user_id' => 'required|numeric',
            'projectName' => 'required',
            'projectDescription' => 'required',
            'startDate' => 'required|date',
        ]);
		//Project Creation 
        $project= new \App\Project;
        $project->user_id=$request->get('user_id');
        $project->lead_id=$request->get('lead_id');
        $project->staff_id=$request->get('staff_id');
        $project->created_by=auth()->user()->id;
        $project->projectName=$request->get('projectName');
        $project->projectDescription=$request->get('projectDescription');
		$project->projectType=$request->get('projectType');
        $project->startDate=$request->get('startDate');
        $project->endDate=$request->get('endDate');
        $project->isSMM=($request->get('isSMM'))? 1: 0;
        $project->isiOS=($request->get('isiOS'))? 1: 0;
        $project->isAndroid=($request->get('isAndroid'))? 1: 0;
        $project->isWeb=($request->get('isWeb'))? 1: 0;
        $project->isCustom=($request->get('isCustom'))? 1: 0;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $project->created_at = strtotime($format);
        $project->updated_at = strtotime($format);
		$project->save();
		//Getting last inserted user id to be used in LEADS
		$projectid = $project->id;
        $id = $projectid;
        $url=url('/projects/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Send Notification
        $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->get();
        $letter = collect(['title' => 'New Project','body'=>'A new project has been created by '.$creator.', please review it.','redirectURL'=>$url]);
        Notification::send($users, new ProjectNotification($letter));
        return redirect('projects')->with('success', 'Project has been created successfully.');
*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    protected $posts_per_page = 10;
    public function show($id, Request $request)
    {
       // echo "string";exit();
        //
        
        $projectDetail = \App\Project::with('customer')->with('createdby')->with('lead')->where('id',$id)->first();
        $assets = \App\Projectasset::with('user')->where('project_id',$id)->get();
        $projectlinks = \App\Projectlink::with('createdby')->where('project_id',$id)->get();
        $messages = \App\Projectmessage::with('assets')->where('project_id',$id)->orderBy('projectmessages.id', 'DESC')->paginate($this->posts_per_page);
        //Ajax Load more request
        if($request->ajax()) {
            return [
                'messages' => view('projects.ajaxmessages')->with(compact('messages','projectDetail'))->render(),
                'next_page' => $messages->nextPageUrl()
            ];
        }
		return view('customer-front.projects.show', compact('projectDetail','assets','messages','projectlinks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* $customers=\App\User::where('iscustomer',1)->get();
        $leads=\App\Lead::with('user')->with('createdby')->get();
        $project = \App\Project::with('customer')->with('createdby')->where('id',$id)->first();
		return view('projects.edit', compact('project','customers','leads'));
    */}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      /*  $this->validate(request(), [
            'user_id' => 'required|numeric',
            'projectName' => 'required',
            'projectDescription' => 'required',
            'startDate' => 'required|date',
        ]);
		//Customer Creation 
        $project=  \App\Project::find($id);
        $project->user_id=$request->get('user_id');
        $project->lead_id=$request->get('lead_id');
        $project->modified_by=auth()->user()->id;
        $project->projectName=$request->get('projectName');
        $project->projectDescription=$request->get('projectDescription');
		$project->projectType=$request->get('projectType');
        $project->startDate=$request->get('startDate');
        $project->endDate=$request->get('endDate');
        $project->isSMM=($request->get('isSMM'))? 1: 0;
        $project->isiOS=($request->get('isiOS'))? 1: 0;
        $project->isAndroid=($request->get('isAndroid'))? 1: 0;
        $project->isWeb=($request->get('isWeb'))? 1: 0;
        $project->isCustom=($request->get('isCustom'))? 1: 0;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $project->updated_at = strtotime($format);
		$project->save();
		$projectid = $project->id;
        return redirect('projects/'.$projectid.'/edit')->with('success', 'Project has been updated successfully.');
    */}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       /* try{
            $project = \App\Project::find($id);
            $project->delete();
            return redirect()->action(
                'ProjectController@index' 
            )->with('success', 'Project has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'ProjectController@index' 
            )->with('failed', 'Unable to delete, this PROJECT has linked record(s) in system.');
        }
*/
    }

    //Additional Functions
    public function projectasset(Request $request)
    {
       /* $rules=[
            'note' => 'required',
            'projectAsset' => 'required',
            'project_id' => 'required',          
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        if($request->hasfile('projectAsset'))
        {
           $file = $request->file('projectAsset');
            $attachment=$file->getClientOriginalName();
           Storage::disk('local')->put('/public/projects_assets/'.$request->get('project_id').'/'.$attachment, File::get($file));          
        }else{
           $attachment="";
        }
		
        $asset= new \App\Projectasset;
        $asset->project_id=$request->get('project_id');
        $asset->note=$request->get('note');
        $asset->user_id=auth()->user()->id;
        $asset->attachment=$attachment;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $asset->created_at = strtotime($format);
        $asset->updated_at = strtotime($format);
		$asset->save();
		$assetid = $asset->id;
        return response()->json(['success'=>'Document uploaded successfully.']);
*/
    }


    public function projectmessage(Request $request)
    {
        //echo "string";exit();
        $rules=[
            'message' => 'required',
            'project_id' => 'required',          
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
      
        if(auth()->user()->iscustomer==1){
            $user_type=1;
        }else{
            $user_type=0;
        }
        $message= new \App\Projectmessage;
        $message->project_id=$request->get('project_id');
        $message->message=$request->get('message');
        $message->user_type=$user_type;
        $message->message_type=1;      
        $message->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $message->created_at = strtotime($format);
        $message->updated_at = strtotime($format);
		$message->save();
        $messageid = $message->id;
        
        if($request->hasFile('MessageAssets')){
            
            $files = $request->file('MessageAssets');
            
            foreach($files as $key => $value) {
                
                
                $filename = time(). $key .$value->getClientOriginalName();
                $orginalfilename=$value->getClientOriginalName();
                //Storage::disk('local')->put('/public/message_assets/'.$request->get('project_id').'/'.$filename, File::get($filename));
                if(Storage::disk('local')->put('/public/projects_assets/'.$request->get('project_id').'/messages/'.$filename, File::get($value))){
                    //Saving File in DB
                    $asset= new \App\Projectmessageasset;
                    $asset->message_id=$messageid;
                    $asset->attachment=$filename;
                    $asset->orginalfilename=$orginalfilename;     
                    $asset->user_id=auth()->user()->id;
                    $date=date_create($request->get('date'));
                    $format = date_format($date,"Y-m-d H:i:s");
                    $asset->created_at = strtotime($format);
                    $asset->updated_at = strtotime($format);
                    $asset->save();
                }
            }
        }
        
        return response()->json(['success'=>'Message sent successfully.']);

    }
}
