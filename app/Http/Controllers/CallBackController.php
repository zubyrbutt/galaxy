<?php

namespace App\Http\Controllers;

use App\CallBack;
use Illuminate\Http\Request;


class CallBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $lead_id
     * @return \Illuminate\Http\Response
     */
    public function index($lead_id)
    {
        if($lead_id){
            $callbacks = CallBack::with('lead')->with('createdby')->where('lead_id',$lead_id)->get();
        }else{
            $callbacks = CallBack::with('lead')->with('createdby')->get();
        }
        return view('callBack.callback', compact('callbacks'));
    }


    public function callbacksearch(Request $request)
    {

        //dd($request->get('agentid'));
        // $callbacks = \App\CallBack::with('users')->with('createdby')->with('assignedTo');
        $callbacks = \App\CallBack::with('callbackuser_id');
        $user_id = $request->get('agentid');
        if($this->authorize('search-leads')){
            if($request->get('agentid')){
                if($request->get('agentid')== 'all'){
                    $callbacks = $callbacks->whereBetween('appointtime', [date($request->get('dateFrom'))." 00:00:00", date($request->get('dateTo'))." 23:59:59"]);

                }else{
                    //$query = $query->whereBetween('appointtime', [date($request->get('dateFrom')), date($request->get('dateTo'))]);
                    //$callbacks = $callbacks->where('created_by',$request->get('agentid'))->whereBetween('appointtime', [date($request->get('dateFrom'))." 00:00:00", date($request->get('dateTo'))." 23:59:59"]);
                    $callbacks = \App\CallBack::with('callbackuser_id')
                        ->whereBetween('appointtime', [date($request->get('dateFrom'))." 00:00:00", date($request->get('dateTo'))." 23:59:59"])
                        ->whereHas('callbackuser_id', function ($query) use($user_id)  {
                            $query->where('user_id',$user_id);
                        });
                }
            }
        }
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);
        if(isset($permissions_arr['show-all-leads'])==true){
            $callbacks = $callbacks->get();
            $agents=\App\User::where('iscustomer',0)->get();
        }else{
            //$query=$query->where('created_by',auth()->user()->id);
            //$callbacks=$callbacks->where('created_by',auth()->user()->id)->orwhere('assignedto',auth()->user()->id);
            $callbacks = $callbacks->get();
            //$agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->where('role_id', 31)->get();
        }
//dd($callbacks);
        return view('callBack.search', compact('leads','agents', 'callbacks'));
    }

    public function createcallback($lead_id){
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        $agents = \App\User::where('iscustomer',0)->get();
        //$agents = \App\User::all();
        return view('callBack.create',compact('lead','lead_id','agents'));
    }

    public function storecallback(Request $request){

        $this->validate(request(), [
            'appointtime' => 'required',
            'agentids' => 'required',
            'appointdate' => 'required',
        ]);


        //Recording Uploading
        $appdate=date_create($request->get('appointdate')." ".$request->get('appointtime'));
        $appformat = date_format($appdate,"Y-m-d H:i:s");

        $callback= new \App\CallBack;
        $callback->appointtime=$appformat;
        $callback->note=$request->get('note');
        $callback->lead_id=$request->get('lead_id');
        $callback->created_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $callback->created_at = strtotime($format);
        $callback->updated_at = strtotime($format);
        $callback->save();
        $callback->users()->sync($request->get('agentids'));

        $id = $request->get('lead_id');

        //Insert Lead status
        $lead= new \App\Leadstatus;
        $lead->lead_id=$request->get('lead_id');
        $lead->status=5;
        $lead->note="Call back has been scheduled on ".$appformat;
        $lead->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead= \App\Lead::find($request->get('lead_id'));
        $lead->status=5;
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

    public function callback_note($lead_id,$app_id){

        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();

        return view('callBack.note',compact('lead','lead_id','app_id'));
    }



   public function create_callback_note($lead_id,$app_id){

        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();

        return view('callBack.callback_note',compact('lead','lead_id','app_id'));
    }

    public function store_callback(Request $request)
    {

        //dd($request->url());
        $this->validate(request(), [
            'note' => 'required',
            'lead_id' => 'required',
            'app_id' => 'required',
        ]);

        $conversation = new \App\Conversation;
        $conversation->message = $request->get('note');
        //$proposal->docfile=$docfile;
        $conversation->lead_id = $request->get('lead_id');
        $conversation->call_back_id = $request->get('app_id');
        $conversation->created_by = auth()->user()->id;
        $date = date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $conversation->created_at = strtotime($format);
        $conversation->updated_at = strtotime($format);
        $conversation->save();
        $id = $request->get('lead_id');

        //Insert Lead status
        $lead = new \App\Leadstatus;
        $lead->lead_id = $request->get('lead_id');
        $lead->status = 5;

        $lead->note = "Call Back ..  ";

        $lead->user_id = auth()->user()->id;
        $date = date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead = \App\Lead::find($request->get('lead_id'));
        $lead->status = 5;
        $lead->save();

        return redirect('callbackfilter')->with('success', 'Appointment Note for Conversation Added Successfully.');
    }


        public function store_callback_note(Request $request){
            //dd($request->url());
        $this->validate(request(), [
            'note' => 'required',
            'lead_id' => 'required',
            'app_id' => 'required',
        ]);

        $conversation= new \App\Conversation;
        $conversation->message=$request->get('note');
        $conversation->lead_id=$request->get('lead_id');
        $conversation->call_back_id=$request->get('app_id');
        $conversation->created_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $conversation->created_at = strtotime($format);
        $conversation->updated_at = strtotime($format);
        $conversation->save();
        $id = $request->get('lead_id');

        //Insert Lead status
        $lead= new \App\Leadstatus;
        $lead->lead_id=$request->get('lead_id');
        $lead->status=5;

        $lead->note="Call Back ..  ";

        $lead->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead= \App\Lead::find($request->get('lead_id'));
        $lead->status=5;
        $lead->save();

    return redirect('leads/'.$id)->with('success', 'Appointment Note for Conversation Added Successfully.');

    }
    public function todaycallbacks()
    {
        //$agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        $query = \App\Lead::with('user')->first();

        //$query = \App\Lead::with('user')->with('createdby')->with('assignedTo');
        $callbacks = \App\CallBack::whereDate('appointtime', date('Y-m-d'))->orderBy('id', 'DESC')->limit(10)->get();
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);
        if(isset($permissions_arr['show-all-leads'])==true){
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->get();
        }else{
            $query=$query->where('created_by',auth()->user()->id)->orwhere('assignedto',auth()->user()->id);
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->get();
        }
        return view('callBack.search', compact('leads','agents', 'callbacks'));
    }
}
