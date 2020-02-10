<?php
namespace App\Http\Controllers;

use App\Lead;
use App\Notifications\AppointmentNotification;
use App\Notifications\LeadNotification;
use App\Notifications\ProjectNotification;
use App\Notifications\ProposalLeadNotification;
use App\Notifications\RecordingNotification;
use App\Proposal;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Datatable;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Notification;
use Validator;
use Yajra\Datatables\Datatables;


class LeadController extends Controller
{
    
    /* Server side Datatable testing begins */
    public function indexmain()
    {
        return view('leads.leadsmain');
    }

    public function anyData()
    {
        return Datatables::of(\App\Lead::with('user')->with('createdby'))->make(true);
    }
    /* Server side Datatable testing ends */
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        $query = \App\Lead::with('user')->with('createdby')->with('assignedTo');
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);         
        if(isset($permissions_arr['show-all-leads'])==true){
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        }else{
            $query=$query->where('created_by',auth()->user()->id)->orwhere('assignedto',auth()->user()->id);
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->get();
        }
        return view('leads.leads', compact('leads','agents'));
    }

    public function search(Request $request)
    {
        $query = \App\Lead::with('user')->with('createdby')->with('assignedTo');
        if($this->authorize('search-leads')){
            if($request->get('agentid')){
                if($request->get('agentid')=='all'){
                    $query = $query->whereBetween('created_at', [date($request->get('dateFrom')), date($request->get('dateTo'))]);
                }else{
                    $query = $query->where('created_by',$request->get('agentid'))->whereBetween('created_at', [date($request->get('dateFrom')), date($request->get('dateTo'))]);
                }
            }

            if($request->get('status')){
                if($request->get('status')!='all')
                {
                    $query = $query->where('status',$request->get('status'));
                }
            }
        }
        
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);         
        if(isset($permissions_arr['show-all-leads'])==true){
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        }else{
            //$query=$query->where('created_by',auth()->user()->id);
            $query=$query->where('created_by',auth()->user()->id)->orwhere('assignedto',auth()->user()->id);
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->get();
        }

        return view('leads.leads', compact('leads','agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);         
        if(isset($permissions_arr['show-all-leads'])==true){
            $agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        }else{
            $agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->get();
        }

        $course_list = \App\Courses::all();
        //$plan array from constants.php        
        $plan = config('constants.plan');
        $students_list = \App\User::where('iscustomer',3)->get();
        $agents_list = \App\User::where('role_id',31)->get();

        $students_list = \App\User::where('iscustomer',3)->get();
        $users=\App\User::where('iscustomer',1)->get();

        $data['user'] = User::where('iscustomer',0)->where('status',1)->get();
        $customers=\App\User::where('iscustomer',1)->get();
        
        return view('leads.create',compact('agents','users','students_list','plan','course_list','agents_list','customers','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all()
       if($request->customer_id){
             $customer_id = $request->customer_id;
             $studentID = $request->customer_id;
         }else{
            $this->validate(request(), [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users',
                'phonenumber' => 'required',
                // 'businessName' => 'required',
                // 'businessAddress' => 'required',
                // 'businessNature' => 'required',
                // 'description' => 'required' 
            ]);
            //Customer Creation 
            $user= new \App\User;
            $user->fname=$request->get('fname');
            $user->lname=$request->get('lname');
            $user->email=$request->get('email');
            $user->phonenumber=$request->get('phonenumber');
            $user->mobilenumber=$request->get('mobilenumber');
            $user->whatsapp=$request->get('whatsapp');
            $user->status = 1;      
            $user->password=Hash::make(str_random(6));
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->created_at = strtotime($format);
            $user->updated_at = strtotime($format);
            $user->iscustomer = 1;
            
            $user->save();

            //Getting last inserted user id to be used in LEADS
            $customer_id = $user->id;
         }

        $attributes = array();

        foreach ($request->get('attributes') as $index => $attribute) {
           $attributes[] = ['name' => $attribute, 'value' => $request->get('attribute_value')[$index]];
        }

			
        //Lead Insertion
        $date=date_create($request->get('leaddate'));
        $leaddate = date_format($date,"Y-m-d");
		$lead= new \App\Lead;
        $lead->ccountry=$request->get('ccountry');
        $lead->profession=$request->get('profession');
        $lead->leaddate=$leaddate;
        $lead->cityinterest=$request->get('cityinterest');
        $lead->residential=($request->get('residential')) ? 1: 0;
        $lead->commercial=($request->get('commercial')) ? 1: 0;
        $lead->cash=($request->get('cash')) ? 1: 0;
        $lead->installment=($request->get('installment')) ? 1: 0;
        $lead->investmenthistory=$request->get('investmenthistory');
        $lead->investmentpurpose=$request->get('investmentpurpose');
        $lead->comments=$request->get('comments');
        $lead->source=$request->get('source');
        $lead->user_id=$customer_id;
        $lead->assignedto=$request->agentid;
        $lead->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->attributes = serialize($attributes);
        $lead->save();
        $lead_id = $lead->id;



        $url=url('/leads/'.$lead_id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Send Notification
        $users=\App\User::with('role')->where('iscustomer',0)->where('id', $request->get('agentid'))->where('status',1)->get();
        $letter = collect(['title' => 'New Lead Created','body'=>'A new lead has been created by '.$creator.' and assigned to you, please review it.','redirectURL'=>$url]);
        //Need to enabled with conditions currently sending to all users in the DB
        //Notification::send($users, new LeadNotification($letter));
        return redirect('leads/'.$lead_id)->with('success', 'Lead has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lead_detail = \App\Lead::with('user')->with(['assignedto','createdby','closed_by_project','closed_by_class'])->where('id',$id)->first();
        //dd($lead_detail->toArray());
        $recordings = \App\Recording::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        //$appointments = \App\Appointment::with('users')->where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        $appointments = \App\Appointment::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        $docs = \App\LeadAsset::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
		//Proposal
        $proposals = \App\Proposal::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        //Conversation
        $conversations = \App\Conversation::where('lead_id',$id)->orderBy('id', 'DESC')->get();

        $notes = \App\Leadstatus::with('createdby')->where('lead_id',$id)->orderBy('id', 'DESC')->get();

        // return $lead_detail;
        if($lead_detail){
            return view('leads.show', compact('recordings','appointments','docs','proposals','conversations','lead_detail','notes'));
        }else{
            return view('404');
        }
	
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);         
        if(isset($permissions_arr['show-all-leads'])==true){
            $agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        }else{
            $agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->get();
        }
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$id)->first();

		return view('leads.edit', compact('lead','agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lead= \App\Lead::find($id);
        $this->authorize('edit-lead', $lead);
        
      
        $attributes = array();
        foreach ($request->get('attributes') as $index => $attribute) {
           $attributes[] = ['name' => $attribute, 'value' => $request->get('attribute_value')[$index]];
        }
        
        //Lead Update
        $date=date_create($request->get('leaddate'));
        $leaddate = date_format($date,"Y-m-d");
        $lead->ccountry=$request->get('ccountry');
        $lead->profession=$request->get('profession');
        $lead->leaddate=$leaddate;
        $lead->cityinterest=$request->get('cityinterest');
        $lead->residential=($request->get('residential')) ? 1: 0;
        $lead->commercial=($request->get('commercial')) ? 1: 0;
        $lead->cash=($request->get('cash')) ? 1: 0;
        $lead->installment=($request->get('installment')) ? 1: 0;
        $lead->investmenthistory=$request->get('investmenthistory');
        $lead->investmentpurpose=$request->get('investmentpurpose');
        $lead->comments=$request->get('comments');
        $lead->source=$request->get('source');
       // $lead->user_id=$customer_id;
        //$lead->assignedto=$request->agentid;
        //$lead->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
       // $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->attributes = serialize($attributes);
        $lead->save();
       
         
        return redirect('leads/'.$id)->with('success', 'Lead has been updated successfully.');
        
    }
    //For Training
    public function fortraining($id)
    {
        $lead= \App\Lead::find($id);
        $lead->istraininglead=1;
        $lead->save();
        return redirect('leads/'.$id)->with('success', 'Lead has been marked as training material successfully.');
    }
    //Remove From Training
    public function removefromtraining($id)
    {
        $lead= \App\Lead::find($id);
        $lead->istraininglead=0;
        $lead->save();
        return redirect('leads/'.$id)->with('success', 'Lead has been removed from training material successfully.');
    }

    //Approve Lead
    public function approve($id)
    {
        $lead= \App\Lead::find($id);
        $lead->approvestatus=1;
        $lead->approvedby=auth()->user()->id;
        $lead->save();
        return redirect('leads/'.$id)->with('success', 'Lead has been approved successfully.');
    }

     //Reject Lead
     public function reject($id)
     {
         $lead= \App\Lead::find($id);
         $lead->approvestatus=2;
         $lead->approvedby=auth()->user()->id;
         $lead->save();
         return redirect('leads/'.$id)->with('success', 'Lead has been rejected successfully.');
     }

    //For Deactivate
    public function deactivate($id)
    {
        $lead= \App\Lead::find($id);
        $lead->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $lead->updated_at = strtotime($format);
        $lead->save();
        return redirect('leads/'.$id)->with('success', 'Lead status has been deactivated.');
    }

    //For Active
    public function active($id)
    {
        $lead=\App\Lead::find($id);         
        $lead->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $lead->updated_at = strtotime($format);
        $lead->save();
        return redirect('leads/'.$id)->with('success', 'Lead status has been active.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $lead = \App\Lead::find($id);
            $lead->delete();
            return redirect()->action(
                'LeadController@index' 
            )->with('success', 'Lead has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'LeadController@index' 
            )->with('failed', 'Unable to delete, this LEAD has linked record(s) in system.');
        }

    }

    //Recordings
    public function createrecording($lead_id){     
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('recordings.create',compact('lead','lead_id'));
    }

    public function storerecording(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'lead_id' => 'required',
            //'recording_file' => ['mimes:mpga,wav']
        ]);
        if($request->hasfile('recording_file'))
         {
            $file = $request->file('recording_file');
            $recordingfile=time().$file->getClientOriginalName();
            //$file->move(public_path().'/leads_assets/recordings/', $recordingfile);
            Storage::disk('local')->put('/public/leads_assets/recordings/'.$recordingfile, File::get($file));
         }else{
            $recordingfile="";
         }
		//Recording Uploading
		$recording= new \App\Recording;
        $recording->title=$request->get('title');
        $recording->link=$request->get('link');
        $recording->note=$request->get('note');
        $recording->recording_file=$recordingfile;
        $recording->lead_id=$request->get('lead_id');
        $recording->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $recording->created_at = strtotime($format);
        $recording->updated_at = strtotime($format);
        $recording->save();
        $id = $request->get('lead_id');
        $url=url('/leads/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Nofication
        $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->get();
        $message = collect(['title' => 'New recording has been uploaded','body'=>'A new recording has been uploaded by '.$creator.' on lead no.'.$id.', please review it.','redirectURL'=>$url]);
        //Need to enabled with conditions currently sending to all users in the DB
        //Notification::send($users, new RecordingNotification($message));

        return redirect('leads/'.$id)->with('success', 'Recording has been uploaded Successfully.');
    }

    //Assets, Docs etc
    public function createdocs($lead_id){     
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('leadassets.create',compact('lead','lead_id'));
    }

    public function storedocs(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'lead_id' => 'required',
            'docfile' => ['mimes:jpeg,png,pdf']
        ]);
        if($request->hasfile('docfile'))
         {
            $file = $request->file('docfile');
            $docfile=time().$file->getClientOriginalName();
            Storage::disk('local')->put('/public/leads_assets/docfiles/'.$docfile, File::get($file));          
            //$file->move(public_path().'/leads_assets/docfiles/', $docfile);
         }else{
            $docfile="";
         }
		//Recording Uploading
		$leadasset= new \App\LeadAsset;
        $leadasset->title=$request->get('title');
        $leadasset->note=$request->get('note');
        $leadasset->docfile=$docfile;
        $leadasset->lead_id=$request->get('lead_id');
        $leadasset->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $leadasset->created_at = strtotime($format);
        $leadasset->updated_at = strtotime($format);
        $leadasset->save();
        $id = $request->get('lead_id');
        return redirect('leads/'.$id)->with('success', 'Document has been uploaded Successfully.');
    }

    //Appointments
    public function createappointments($lead_id){     
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        $agents = \App\User::where('isGoOnAppoints',1)->get();
        return view('appointments.create',compact('lead','lead_id','agents'));
    }

    public function storeappointments(Request $request){
        // return $request->all();
        $this->validate(request(), [
            'appointtime' => 'required',
            'agentids' => 'required',
            'appointdate' => 'required',
        ]);
        //Recording Uploading
        $appdate=date_create($request->get('appointdate')." ".$request->get('appointtime'));
        $appformat = date_format($appdate,"Y-m-d H:i:s");

		$appointment= new \App\Appointment;
        $appointment->appointtime=$appformat;
        $appointment->note=$request->get('note');
        $appointment->lead_id=$request->get('lead_id');
        $appointment->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $appointment->created_at = strtotime($format);
        $appointment->updated_at = strtotime($format);
        $appointment->save();
        $appointment->users()->sync($request->get('agentids'));
        $id = $request->get('lead_id');

        //Insert Lead status
        $lead= new \App\Leadstatus;
        $lead->lead_id=$request->get('lead_id');
        $lead->status=6;
        $lead->note="Appointment/Meeting has been scheduled on ".$appformat;
        $lead->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead= \App\Lead::find($request->get('lead_id'));
        $lead->status=6;
        $lead->save();




        $url=url('/leads/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Nofication
        $users=\App\User::where('iscustomer',0)->where('status',1)->whereIn('id', $request->get('agentids'))->get();
        $message = collect(['title' => 'New appointment has been scheduled','body'=>'A new appointment has been schedule by '.$creator.', please review it.','redirectURL'=>$url]);
        //Need to enabled with conditions currently sending to all users in the DB
        //Notification::send($users, new AppointmentNotification($message));


        return redirect('leads/'.$id)->with('success', 'Appointment has been schedule successfully.');
    }
    
	
	//Proposal
    public function createproposal($lead_id){     
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('proposal.create',compact('lead','lead_id'));
    }
	
	//For Proposal file upload
    public function uploadproposal($lead_id,$pro_id){    
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('proposal.upload',compact('lead','lead_id','pro_id'));
    }
	
    public function updateproposal(Request $request, $pro_id)
    {
        $this->authorize('upload-proposal');
        
        $this->validate(request(), [
			'docfile' => ['mimes:jpeg,png,pdf'] 
        ]);
		if($request->hasfile('docfile'))
         {
            $file = $request->file('docfile');
            $docfile=time().$file->getClientOriginalName();
            //$file->move(public_path().'/leads_assets/proposal/', $docfile);
            Storage::disk('local')->put('/public/leads_assets/proposal/'.$docfile, File::get($file));
         }else{
            $docfile="";
         } 		
		

		$proposal= \App\Proposal::find($pro_id);
		$proposal->docfile=$docfile;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $proposal->uploaded_at = $format;
		$proposal->save();
        $id = $request->get('lead_id');
        $url=url('/leads/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Nofication
        $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->get();
        $message = collect(['title' => 'Proposal Uploaded','body'=>'A proposal has been uploaded by '.$creator.', please review it.','redirectURL'=>$url]);
        //Need to enabled with conditions currently sending to all users in the DB
        //Notification::send($users, new ProposalLeadNotification($message));
        return redirect('leads/'.$id)->with('success', 'Proposal Uploaded Successfully.');
        
    }	

    public function storeproposal(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'lead_id' => 'required'
            //'docfile' => ['mimes:jpeg,png,pdf']
        ]);
		$proposal= new \App\Proposal;
        $proposal->title=$request->get('title');
        $proposal->note=$request->get('note');
        //$proposal->docfile=$docfile;
        $proposal->lead_id=$request->get('lead_id');
        $proposal->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $proposal->created_at = strtotime($format);
        $proposal->updated_at = strtotime($format);
        $proposal->save();
        $id = $request->get('lead_id');
        $url=url('/leads/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Nofication
        $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->get();
        $message = collect(['title' => 'New proposal has been requested','body'=>'A new proposal has been requested by '.$creator.', please review it.','redirectURL'=>$url]);
        //Need to enabled with conditions currently sending to all users in the DB
        //Notification::send($users, new ProposalLeadNotification($message));
        return redirect('leads/'.$id)->with('success', 'Proposal has been Added Successfully.');
    }
	
	//For EDIT and UPDATE proposal fields excluding image
	public function edit_proposal($id,$lead_id)
    {
        //
		$edit_proposal = \App\Proposal::find($id);
		return view('proposal.edit',compact('edit_proposal','lead_id'));
	}	
	
    public function upproposal(Request $request, $id)
    {
        $this->authorize('edit-proposal');
        $this->validate(request(), [
            'title' => 'required' 
        ]);

		$proposal= \App\Proposal::find($id);
        $proposal->title=$request->get('title');
        $proposal->note=$request->get('note');
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $proposal->updated_at = strtotime($format);
		$proposal->save();
		$id = $request->get('lead_id');
        return redirect('leads/'.$id)->with('success', 'Proposal has been Updated Successfully.');
        
    }	
    /************************** CONVERSATION 	-	START************************/
	//Conversation - Separate widget
    public function store_conversation(Request $request)
    {
		$this->validate(request(), [
            'message' => 'required' 
        ]);

		$conversation= new \App\Conversation;
        $conversation->message=$request->get('message');
        $conversation->lead_id=$request->get('lead_id');
        $conversation->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $conversation->created_at = strtotime($format);
        $conversation->updated_at = strtotime($format);		
		$conversation->save();
		$id = $request->get('lead_id');
        return redirect('leads/'.$id)->with('success', 'Conversation Added Successfully.');
        
    }
	
	//Appointment Note to show under Conversation
    public function create_appnote($lead_id,$app_id){     
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('appointments.note',compact('lead','lead_id','app_id'));
    }

    public function store_appnote(Request $request){
        $this->validate(request(), [
            'note' => 'required',
        ]);
		$conversation= new \App\Conversation;
        $conversation->message=$request->get('note');
        //$proposal->docfile=$docfile;
        $conversation->lead_id=$request->get('lead_id');
		$conversation->appointment_id=$request->get('app_id');
        $conversation->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $conversation->created_at = strtotime($format);
        $conversation->updated_at = strtotime($format);
        $conversation->save();
        $id = $request->get('lead_id');
        return redirect('leads/'.$id)->with('success', 'Appointment Note for Conversation Added Successfully.');
    }	
	/************************** CONVERSATION 	-	END************************/

   
   public function close_lead($customerid,$lead_id){

        if($customerid){
            $customers=\App\User::where('iscustomer',1)->where('id',$customerid)->get();
            $leads=\App\Lead::with('user')->with('createdby')->where('user_id',$customerid)->get();
        }else{
            $customers=\App\User::where('iscustomer',1)->get();
        }
        if($lead_id){
            $leads=\App\Lead::with('user')->with('createdby')->where('id',$lead_id)->get();
        }

        $course_list = \App\Courses::all();
        //$plan array from constants.php        
        $plan = config('constants.plan');
        $students_list = \App\User::where('iscustomer',3)->get();
        $agents_list = \App\User::where('role_id',31)->get();

        $data['user'] = User::where('iscustomer',0)->where('status',1)->get();

        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('leads.lead-close',compact('lead','lead_id','customers','leads','customerid','data','course_list','plan','students_list','agents_list'));

   }

 
   public function close_by_class(Request $request){
        
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
            'agentId' => 'required',

        
            //'recording_file' => ['mimes:mpga,wav']
        ]);

        //Recording Uploading
        // $recording= new \App\Recording;
        // $recording->title=$request->get('title');
        // $recording->link=$request->get('link');
        // $recording->note=$request->get('note');
        // $recording->recording_file=$recordingfile;
        // $recording->lead_id=$request->get('lead_id');
        // $recording->created_by=auth()->user()->id;
        // $date=date_create($request->get('date'));
        // $format = date_format($date,"Y-m-d");
        // $recording->created_at = strtotime($format);
        // $recording->updated_at = strtotime($format);
        // $recording->save();

        $id = $request->get('lead_id');
        $url=url('/leads/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Nofication
        $lead = Lead::where('id',$request->get('lead_id'))->first();
        $lead->closed = 1;
        $lead->save();

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
        // if($check_student>0){
        //     return redirect('schedule/')->with('failed', 'Same student with same startTime and with same classtype cannot be rescheduled to any teacher');
        // }
        
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

        return redirect('leads/'.$request->lead_id)->with('success', 'Lead has been closed Successfully.');
 
   }


   // Nisar Work =================================
   // Lead Status
   public function postleadstatus(Request $request){

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'leadid' => 'required',
            'status' => 'required',
            'notes' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return ['errors'=>'validation error.'];
        }
        //Lead Insertion
        $lead= new \App\Leadstatus;
        $lead->lead_id=$request->get('leadid');
        $lead->status=$request->get('status');
        $lead->note=$request->get('notes');
        $lead->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead= \App\Lead::find($request->get('leadid'));
        $lead->status=$request->get('status');
        $lead->save();
        if (isset($request->show_page) && $request->show_page !='') {
        return redirect()->back()->with('success', 'Lead has been updated successfully.');
        }
        else
        {
        return ['success'=>'Status updated.'];
         }
    }
    // Lead Status

    public function time_zones(Request $request)
    {
      
            // US And Canada Time ZONE
                $_LIST['zone1'] = array('Select Time ','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30');
                $_LIST['zone2']=array('Select Time ','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30');
                $_LIST['zone3']=array('Select Time ','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30');
                $_LIST['zone4']=array('Select Time ','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30');

                // UK Zone
                $_LIST['zone5']=array('Select Time ','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30');

                // Australia Zone
                $_LIST['zone6']=array('Select Time ','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30');
                $_LIST['zone7']=array('Select Time ','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30');

               return $_LIST['zone'.$request->zone];
            
    }

    public function convertToPak(Request $request)
    {   
        $zone = $request->zone;
        if($zone == 1){
            $timezone = 'America/Los_Angeles';
        }elseif($zone == 2){
            $timezone = 'America/Denver';
        }elseif($zone == 3){
            $timezone = 'America/Chicago';
        }elseif($zone == 4){
            $timezone = 'America/New_York';
        }elseif($zone == 5){
            $timezone = 'Europe/London';
        }elseif($zone == 6){
            $timezone = 'America/Los_Angeles';
        }elseif($zone == 7){
            $timezone = 'Australia/Sydney';
        }

        $converted = Carbon::createFromFormat('H:i', $request->time,$timezone);

        return $converted->setTimeZone('Asia/Karachi')->format('H:i');
        
    }



    public function attributes_get()
    {
        
    }

    public function attributes_post()
    {
        
    }

    public function attributes_show()
    {
        
    }
   // Nisar Work =================================
}
