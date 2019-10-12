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
use DB;
use Datatable;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
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
        return view('leads.create',compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

 
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

        $attributes = array();

        foreach ($request->get('attributes') as $index => $attribute) {
           $attributes[] = ['name' => $attribute, 'value' => $request->get('attribute_value')[$index]];
        }

		//Customer Creation 
        $user= new \App\User;
        $user->fname=$request->get('fname');
        $user->lname=$request->get('lname');
        $user->email=$request->get('email');
        $user->phonenumber=$request->get('phonenumber');
        $user->status = 1;		
		$user->password=Hash::make(str_random(6));
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $user->created_at = strtotime($format);
        $user->updated_at = strtotime($format);
		$user->iscustomer = 1;
        
		$user->save();
		//Getting last inserted user id to be used in LEADS
		$last_user_id = $user->id;
		
		//Lead Insertion
		$lead= new \App\Lead;
        $lead->businessName=$request->get('businessName');
        $lead->businessNature=$request->get('businessNature');
        $lead->businessAddress=$request->get('businessAddress');
        $lead->description=$request->get('description');
        $lead->company_pro=($request->get('company_pro')) ? 1: 0;
        $lead->testimonials=($request->get('testimonials')) ? 1: 0;
        $lead->solser=($request->get('solser')) ? 1: 0;
        $lead->fblink=$request->get('fblink');
        $lead->fblike=$request->get('fblike');
        $lead->twlink=$request->get('twlink');
        $lead->twfollwer=$request->get('twfollwer');
        $lead->inlink=$request->get('inlink');
        $lead->incfollower=$request->get('incfollower');
        $lead->lilink=$request->get('lilink');
        $lead->livisitor=$request->get('livisitor');
        $lead->weblink=$request->get('weblink');
        $lead->assignedto=$request->get('agentid');
        $lead->source=$request->get('source');
        $lead->user_id=$last_user_id;
        $lead->created_by=auth()->user()->id;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->attributes = serialize($attributes);
        $lead->save();
        $id = $lead->id;
        $url=url('/leads/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Send Notification
        $users=\App\User::with('role')->where('iscustomer',0)->where('id', $request->get('agentid'))->where('status',1)->get();
        $letter = collect(['title' => 'New Lead Created','body'=>'A new lead has been created by '.$creator.' and assigned to you, please review it.','redirectURL'=>$url]);
        //Need to enabled with conditions currently sending to all users in the DB
        //Notification::send($users, new LeadNotification($letter));
        return redirect('leads/'.$id)->with('success', 'Lead has been created Successfully.');
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
        $lead_detail = \App\Lead::with('user')->with('assignedto')->with('createdby')->where('id',$id)->first();
        //dd($lead_detail->toArray());
        $recordings = \App\Recording::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        //$appointments = \App\Appointment::with('users')->where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        $appointments = \App\Appointment::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        $docs = \App\LeadAsset::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
		//Proposal
        $proposals = \App\Proposal::where('lead_id',$id)->orderBy('id', 'DESC')->limit(5)->get();
        //Conversation
        $conversations = \App\Conversation::where('lead_id',$id)->orderBy('id', 'DESC')->get();

        if($lead_detail){
            return view('leads.show', compact('recordings','appointments','docs','proposals','conversations','lead_detail'));
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
        
        $this->validate(request(), [
   //          'businessName' => 'required',
   //          'businessAddress' => 'required',
			// 'businessNature' => 'required',
			// 'description' => 'required' 
        ]);

       
        $attributes = array();
        foreach ($request->get('attributes') as $index => $attribute) {
           $attributes[] = ['name' => $attribute, 'value' => $request->get('attribute_value')[$index]];
        }
        
        $lead->businessName=$request->get('businessName');
        $lead->businessAddress=$request->get('businessAddress');
        $lead->businessNature=$request->get('businessNature');
        $lead->description=$request->get('description');
        $lead->company_pro=($request->get('company_pro')) ? 1: 0;
        $lead->testimonials=($request->get('testimonials')) ? 1: 0;
        $lead->solser=($request->get('solser')) ? 1: 0;
        $lead->fblink=$request->get('fblink');
        $lead->fblike=$request->get('fblike');
        $lead->twlink=$request->get('twlink');
        $lead->twfollwer=$request->get('twfollwer');
        $lead->inlink=$request->get('inlink');
        $lead->incfollower=$request->get('incfollower');
        $lead->lilink=$request->get('lilink');
        $lead->livisitor=$request->get('livisitor');
        $lead->weblink=$request->get('weblink');
        $lead->assignedto=$request->get('agentid');
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $lead->created_at = strtotime($format);
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
        $this->validate(request(), [
            'appointtime' => 'required',
            'agentids' => 'required'
        ]);
        //Recording Uploading
        $appdate=date_create($request->get('appointtime'));
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

        $data['user'] = User::where('iscustomer',0)->where('status',1)->get();

        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('leads.lead-close',compact('lead','lead_id','customers','leads','customerid','data'));

   }

   public function close_lead_store(Request $request){
        
        $request->session()->flash('lead_close_form', true);
        $this->validate(request(), [
            'user_id' => 'required|numeric',
            'projectName' => 'required',
            'projectDescription' => 'required',
            'projectType' => 'required',
            'amount' => 'required',
            'startDate' => 'required|date',

            'title' => 'required',
            'lead_id' => 'required',
            //'recording_file' => ['mimes:mpga,wav']
        ]);

        $staff_id =  $request->get('staff_id');
        //$staffId = implode(",",$staff_id);

        $project= new \App\Project;
        $project->user_id=$request->get('user_id');
        $project->lead_id=$request->get('lead_id');
        //$project->staff_id=$staffId;
        $project->created_by=auth()->user()->id;
        $project->projectName=$request->get('projectName');
        $project->projectDescription=$request->get('projectDescription');
        $project->projectType=$request->get('projectType');
        $project->startDate=$request->get('startDate');
        $project->endDate=$request->get('endDate');
        $project->amount=$request->get('amount');
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
        //Project Creation 
        

        //$role = Role::find(1);  
 
       if($project){

        if($staff_id && count($staff_id) > 0){
            $project->users()->attach($staff_id);
        }
        

        }

        //Getting last inserted user id to be used in LEADS
        $projectid = $project->id;
        $id = $projectid;
        $url=url('/projects/'.$id);
        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        //Send Notification

        if($staff_id && count($staff_id) > 0){
            $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->whereIn('id', $staff_id)->get();
            $letter = collect(['title' => 'New Project','body'=>'A new project has been created by '.$creator.', please review it.','redirectURL'=>$url]);
            Notification::send($users, new ProjectNotification($letter));
        }
        


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
        $lead = Lead::where('id',$request->get('lead_id'))->first();
        $lead->closed = 1;
        $lead->save();
        $users=\App\User::with('role')->where('iscustomer',0)->where('status',1)->get();
        $message = collect(['title' => 'New recording has been uploaded','body'=>'A new recording has been uploaded by '.$creator.' on lead no.'.$id.', please review it.','redirectURL'=>$url]);

        return redirect('leads/'.$request->lead_id)->with('success', 'Lead has been closed Successfully.');
 
   }
}