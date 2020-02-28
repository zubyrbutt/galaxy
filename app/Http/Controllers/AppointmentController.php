<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CallBack;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lead_id=null)
    {
        if($lead_id){
            $appointments = Appointment::with('lead')->with('createdby')->where('lead_id',$lead_id)->get();


        }else{
            $appointments = Appointment::with('lead')->with('createdby')->get();


        }
		return view('appointments.appointments', compact('appointments'));
    }

    public function allappointments()
    {
        //$agents=\App\User::where('iscustomer',0)->where('status',1)->whereIn('role_id', [1, 2, 3 , 4, 5])->get();
        $query = \App\Lead::with('user')->first();

        //$query = \App\Lead::with('user')->with('createdby')->with('assignedTo');
        $appointments = \App\Appointment::whereDate('appointtime', date('Y-m-d'))->orderBy('id', 'DESC')->limit(10)->get();
        $permissions_arr=json_decode(auth()->user()->role->permissions,true);
        if(isset($permissions_arr['show-all-leads'])==true){
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->get();
        }else{
            $query=$query->where('created_by',auth()->user()->id)->orwhere('assignedto',auth()->user()->id);
            $leads = $query->get();
            $agents=\App\User::where('iscustomer',0)->where('status',1)->where('id', auth()->user()->id)->get();
        }
        return view('appointments.allappointments', compact('leads','agents', 'appointments'));
    }

    public function callback_note($lead_id,$app_id){

        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();

        return view('appointments.note',compact('lead','lead_id','app_id'));
    }


    public function appointmentfilter(Request $request)
    {

        //dd($request->get('agentid'));
        // $callbacks = \App\CallBack::with('users')->with('createdby')->with('assignedTo');
        $callbacks = \App\Appointment::with('appointmentUser_id');
        $user_id = $request->get('agentid');
        if($this->authorize('search-leads')){
            if($request->get('agentid')){
                if($request->get('agentid')== 'all'){
                    $callbacks = $callbacks->whereBetween('appointtime', [date($request->get('dateFrom'))." 00:00:00", date($request->get('dateTo'))." 23:59:59"]);

                }else{
                    //$query = $query->whereBetween('appointtime', [date($request->get('dateFrom')), date($request->get('dateTo'))]);
                    //$callbacks = $callbacks->where('created_by',$request->get('agentid'))->whereBetween('appointtime', [date($request->get('dateFrom'))." 00:00:00", date($request->get('dateTo'))." 23:59:59"]);
                    $callbacks = \App\Appointment::with('appointmentUser_id')
                        ->whereBetween('appointtime', [date($request->get('dateFrom'))." 00:00:00", date($request->get('dateTo'))." 23:59:59"])
                        ->whereHas('appointmentUser_id', function ($query) use($user_id)  {
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
        return view('appointments.search', compact('leads','agents', 'callbacks'));
    }

    //Appointment Note to show under Conversation
    public function create_appointment_note($lead_id,$app_id){
        $lead = \App\Lead::with('user')->with('createdby')->where('id',$lead_id)->first();
        return view('appointments.appointment_note',compact('lead','lead_id','app_id'));
    }

    public function store_appointment_note(Request $request){

        $this->validate(request(), [
            'note' => 'required',
            'lead_id' => 'required',
            'app_id' => 'required',

        ]);

        $appdate=date_create($request->get('appointdate')." ".$request->get('appointtime'));

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

        //Insert Lead status
        $lead= new \App\Leadstatus;
        $lead->lead_id=$request->get('lead_id');
        $lead->status=7;

        $lead->note="Interested in Webinar has been Done .. ";

        $lead->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead= \App\Lead::find($request->get('lead_id'));
        $lead->status=7;
        $lead->save();


        return redirect('allappointments')->with('success', 'Note for Conversation Added Successfully.');

    }

}
