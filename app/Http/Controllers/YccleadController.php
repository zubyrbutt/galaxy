<?php

namespace App\Http\Controllers;
use App\Ycclead;
use DB;
use Auth;
use Validator;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\LeadNotification;
use Notification;
use App\User;
use App\Proposal;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Datatable;
use Yajra\Datatables\Datatables;
use Ddeboer\Imap\Server;
use Illuminate\Support\Facades\Mail;
use Session;

class YccleadController extends Controller
{
     
     /* Server side Datatable testing begins */
     public function indexmain()
     {

         return view('leads.leadsmain');
     }
 
     public function anyData()
     {
        
        return DataTables::of(Ycclead::all()->where('status','!=','9'))->make(true);
     }
     /* Server side Datatable testing ends */

     
      public function fetch(Request $request)
    {
        //echo "string";exit();
        $columns = array( 
                            0 =>'id', 
                            1 =>'name',
                            2=> 'email',
                            3=> 'contactno',
                            4=> 'country',
                            5=> 'subject',
                            6=> 'message',
                            7=> 'status',
                            8=> 'created_at',
                            9=> 'refcode',
                            10=> 'id',
                            
    
                        );
  
       
        
         $totalData = Ycclead::where('status','!=','9')->count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        //dd($start);
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $value = session()->get('filter');
        //dd($value);

        if(empty($request->input('search.value')))
        {            
            
          if($value['name']!="" || $value['contactno']!="" || $value['subject']!="" || $value['country']!="" || $value['refcode']!="" || $value['status']!="" || $value['dateTo']!=""|| $value['dateFrom']!="") {
        if(!empty($value['name'])){
            $name = $value['name'];
        }else{
            $name = '';
        } 
        if(!empty($value['contactno'])){
            $contactno = $value['contactno'];
        }else{
            $contactno = '';
        }
        if(!empty($value['subject'])){
            $subject = $value['subject'];
        }else{
            $subject = '';
        }
        if(!empty($value['country'])){
            $country = $value['country'];
        }else{
            $country = '';
        }
        if(!empty($value['refcode'])){
            $refcode = $value['refcode'];
        }else{
            $refcode = '';
        }
        
        if(!empty($value['dateTo'])){
            $dateTo = $value['dateTo'];
        }else{
            $dateTo = '';
        }  
        if(!empty($value['dateFrom'])){
            $dateFrom = $value['dateFrom'];
        }else{
            $dateFrom = '';
        }
         $status = $value['status']; 
         
        /*$name = $value['name'];   
        $contactno = $value['contactno'];
        $subject = $value['subject'];
        $country = $value['country'];
        $refcode = $value['refcode'];
        $status = $value['status'];
        */
        //$created_at = $value['created_at'];
           //dd($name);
          $Ycclead =  Ycclead::where('status','!=','9')->where(function ($query) use ($name, $contactno, $subject, $country, $refcode, $status, $dateFrom, $dateTo) {
                    // echo 'success';exit();
                //dd($dateFrom.'-----'.$dateTo);
                    if (!empty($name)) {

                        $query->where('name','LIKE', '%' . $name . '%');
                        $query->orwhere('message','LIKE', '%' . $name . '%');

                    }
                    if (!empty($contactno)) {

                        $query->where('contactno', 'LIKE', '%' . $contactno . '%');

                    } 

                    if (!empty($country)) {
                        
                        $query->where('country',  '=',$country);
                    }
                    if (!empty($subject)) {


                        $query->where('subject','=',$subject);
                    }
                    if (!empty($refcode)) {
                        
                        $query->where('refcode', '=',$refcode);
                    }
                    if ($status =='0' || $status =='1' || $status =='2' || $status =='3' || $status =='4' || $status =='5' || $status =='6' || $status =='7' || $status =='8' || $status =='9' ||$status =='10' || $status =='11') {
                       //dd($status);
                        $query->where('status',$status);
                    }

                    if (!empty($dateFrom)) {
                         $query->whereBetween('created_at', [$dateFrom, $dateTo]);
                    }

                })
                ->with('lastleadstatus')
                ->offset($start)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get();
            //dd($Ycclead);
           $totalFiltered =   Ycclead::where('status','!=','9')->where(function ($query) use ($name, $contactno, $subject, $country, $refcode, $status, $dateFrom, $dateTo) {
                    // echo 'success';exit();
                    if (!empty($name)) {
                        $query->where('name', 'LIKE', '%' . $name . '%');

                    } elseif (!empty($contactno)) {
                        $query->where('contactno', 'LIKE', '%' . $contactno . '%');

                    } elseif (empty($country)) {

                        $query->where('country',  '%' . $country . '%');
                    }
                    elseif (empty($subject)) {

                        $query->where('subject',  '%' . $subject . '%');
                    }
                    elseif (empty($refcode)) {

                        $query->where('refcode',  '%' . $refcode . '%');
                    }
                    elseif (empty($status)) {

                        $query->where('status',  '%' . $status . '%');
                    }
                    elseif (empty($created_at)) {

                       $query->whereBetween('created_at', [$dateTo, $dateFrom]);
                    }

                })->count();

                $value = session()->forget('filter'); 
  
              }else

            {
                $Ycclead = Ycclead::where('status','!=','9')
                        ->with('lastleadstatus')
                        ->offset($start)->limit($limit)
                         ->orderBy('id','desc')
                         ->get();
            }
        
        }
        else {
            $search = $request->input('search.value'); 
                
               

            $Ycclead = Ycclead::where('status','!=','9')->where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('email', 'LIKE', '%' . $search . '%')
                              ->orwhere('contactno', 'LIKE', '%' . $search . '%')
                              ->orwhere('country', 'LIKE', '%' . $search . '%')
                              ->orwhere('subject', 'LIKE', '%' . $search . '%')
                              ->orwhere('message', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->orwhere('created_at', 'LIKE', '%' . $search . '%')
                              ->orwhere('refcode', 'LIKE', '%' . $search . '%')
                              ->with('lastleadstatus')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy('id', 'desc')
                              ->get();


            $totalFiltered = Ycclead::where('status','!=','9')->where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('email', 'LIKE', '%' . $search . '%')
                              ->orwhere('contactno', 'LIKE', '%' . $search . '%')
                              ->orwhere('country', 'LIKE', '%' . $search . '%')
                              ->orwhere('subject', 'LIKE', '%' . $search . '%')
                              ->orwhere('message', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->orwhere('created_at', 'LIKE', '%' . $search . '%')
                              ->orwhere('refcode', 'LIKE', '%' . $search . '%')
                              ->count();                  
           
        }
        //dd(count($Ycclead));
        //echo print_r($Ycclead);exit;

        
        //$name = DB::table('users')->where('name', 'John')->select("id");
        $data = array();

        //dd($Ycclead->toArray());
        if(!empty($Ycclead))
        {
            $ycc_id = [];
            foreach ($Ycclead as $row)
            {
              // print_r($user->permissions);exit;
                $detail =  url('yccleads',$row->id);
                 
                $ycc_id[] =  $row->id;
                $id   = $row->id;
                $email   = $row->email;
               
                $nestedData['id']  = $row->id;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['contactno'] = $row->contactno;
                $nestedData['country'] = $row->country;
                $nestedData['subject'] = $row->subject;
                $nestedData['message'] = $row->message;
                
            if($row->status==0)
            {
              $nestedData['status'] = '<span class="label label-info">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  New &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
            }
            elseif($row->status==1)
            {
              $nestedData['status'] = '<span class="label label-warning">&nbsp&nbsp&nbsp Inprocess &nbsp&nbsp&nbsp</span>';
            }
            elseif($row->status==2)
            {
            $nestedData['status'] = '<span class="label label-success">&nbsp&nbsp&nbsp&nbsp&nbsp Closed &nbsp&nbsp&nbsp&nbsp&nbsp</span>';
            }
            elseif($row->status==3)
            {
            $nestedData['status'] = '<span class="label label-danger">&nbsp&nbsp&nbsp&nbsp Rejected &nbsp&nbsp&nbsp&nbsp</span>';
            }
            elseif($row->status==4)
            {
            $nestedData['status'] = '<span class="label label-danger">Not Interested</span>';
            }
            elseif($row->status==5)
            {
            $nestedData['status'] = '<span class="label label-primary">&nbsp&nbsp Call back &nbsp&nbsp</span>';
            }
            elseif($row->status==6)
            {
            $nestedData['status'] = '<span class="label label-primary">Trial Committed</span>';
            }
            elseif($row->status==7)
            {
            $nestedData['status'] = '<span class="label label-primary">Trial Delivered</span>';
            }
            elseif($row->status==8)
            {
            $nestedData['status'] = '<span class="label label-primary">Invoice Sent</span>';
            }
            elseif($row->status==9)
            {
            $nestedData['status'] = '<span class="label label-danger">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Spam &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
            }
            elseif($row->status==10)
            {
            $nestedData['status'] = '<span class="label label-primary"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp NSNC &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
            }
            elseif($row->status==11)
            {
            $nestedData['status'] = '<span class="label label-primary"> &nbsp&nbsp Duplicate &nbsp&nbsp</span>';
            }
            else
            {
            $nestedData['status'] = '<span class="label label-info">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp New &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
            }


            $nestedData['created_at'] = $row->created_at->format('m/d/Y');
            $nestedData['refcode'] = $row->refcode;
            if($row->lastleadstatus!==null){
                /*if($row->lastleadstatus->status==0)
                {
                $nestedData['laststatus'] = '<span class="label label-info">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  New &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==1)
                {
                $nestedData['laststatus'] = '<span class="label label-warning">&nbsp&nbsp&nbsp Inprocess &nbsp&nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==2)
                {
                $nestedData['laststatus'] = '<span class="label label-success">&nbsp&nbsp&nbsp&nbsp&nbsp Closed &nbsp&nbsp&nbsp&nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==3)
                {
                $nestedData['laststatus'] = '<span class="label label-danger">&nbsp&nbsp&nbsp&nbsp Rejected &nbsp&nbsp&nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==4)
                {
                $nestedData['laststatus'] = '<span class="label label-danger">Not Interested</span>';
                }
                elseif($row->lastleadstatus->status==5)
                {
                $nestedData['laststatus'] = '<span class="label label-primary">&nbsp&nbsp Call back &nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==6)
                {
                $nestedData['laststatus'] = '<span class="label label-primary">Trial Committed</span>';
                }
                elseif($row->lastleadstatus->status==7)
                {
                $nestedData['laststatus'] = '<span class="label label-primary">Trial Delivered</span>';
                }
                elseif($row->lastleadstatus->status==8)
                {
                $nestedData['laststatus'] = '<span class="label label-primary">Invoice Sent</span>';
                }
                elseif($row->lastleadstatus->status==9)
                {
                $nestedData['laststatus'] = '<span class="label label-danger">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Spam &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==10)
                {
                $nestedData['laststatus'] = '<span class="label label-primary"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp NSNC &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
                }
                elseif($row->lastleadstatus->status==11)
                {
                $nestedData['laststatus'] = '<span class="label label-primary"> &nbsp&nbsp Duplicate &nbsp&nbsp</span>';
                }
                else
                {
                $nestedData['laststatus'] = '<span class="label label-info">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp New &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
                }*/

                //$nestedData['laststatus'] = $row->lastleadstatus->status;
                $nestedData['lastdesc'] = $row->lastleadstatus->note;
                $nestedData['lastUpdateAt'] = $row->lastleadstatus->created_at->format('m/d/Y');
                $nestedData['UpdatedBy'] = $row->lastleadstatus->createdby->fname .' '. $row->lastleadstatus->createdby->lname;
            }else{
                //$nestedData['laststatus'] = "NA";
                $nestedData['lastdesc'] = "NA";
                $nestedData['lastUpdateAt'] = "NA";
                $nestedData['UpdatedBy'] = "NA";
            }

                
            /*$nestedData['options'] = "<a class='edit-modal' data-id='{$id}'><i class='fa fa-bolt'></i></a> <a href='{$detail}' class='' style='margin-left:5px'><i class='fa fa-eye'></i></a><a class='email-modal' data-id='{$email}' data-toggle='modal' data-target='#mail' style='margin-left:5px'><i class='fa fa-mail-forward'></i></a>";
             */   
                 $nestedData['options'] = "<button class='btn btn-primary edit-modal' data-id='{$id}'><i class='fa fa-bolt'></i></button> <a href='{$detail}' class='btn btn-info'><i class='fa fa-eye'></i></a><button class='btn btn-warning email-modal' data-id='{$email}' data-toggle='modal' data-target='#mail'><i class='fa fa-mail-forward'></i></button>";
               
            //$nestedData['options'] = "&emsp;<a class='btn btn-primary'
                                   //  href='{$detail}' ><i class='fa fa-eye'></i></a>";                         
                $data[] = $nestedData;

            }

            //dd($ycc_id);
        }

        $dataStatus['Total_leads']     = Ycclead::whereIn('id',$ycc_id)->count();        
        $dataStatus['New']             = Ycclead::where('status',0)->whereIn('id',$ycc_id)->count();
        $dataStatus['Inprocess']       = Ycclead::where('status',1)->whereIn('id',$ycc_id)->count();
        $dataStatus['Closed']          = Ycclead::where('status',2)->whereIn('id',$ycc_id)->count();
        $dataStatus['Rejected']        = Ycclead::where('status',3)->whereIn('id',$ycc_id)->count();
        $dataStatus['NotInterested']   = Ycclead::where('status',4)->whereIn('id',$ycc_id)->count();
        $dataStatus['Callback']        = Ycclead::where('status',5)->whereIn('id',$ycc_id)->count();
        $dataStatus['TrialCommitted']  = Ycclead::where('status',6)->whereIn('id',$ycc_id)->count();
        $dataStatus['TrialDelivered']  = Ycclead::where('status',7)->whereIn('id',$ycc_id)->count();
        $dataStatus['InvoiceSent']     = Ycclead::where('status',8)->whereIn('id',$ycc_id)->count();
        $dataStatus['Spam']            = Ycclead::where('status',9)->whereIn('id',$ycc_id)->count();
        $dataStatus['NSNC']            = Ycclead::where('status',10)->whereIn('id',$ycc_id)->count();
        $dataStatus['Duplicate']       = Ycclead::where('status',11)->whereIn('id',$ycc_id)->count();
              
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data,
                    "dataStatus"      => $dataStatus
                    );
          return response()->json($json_data);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{   
    $data['name']            = DB::select("SELECT DISTINCT name FROM yccleads where status !=
                                '9' AND name !='' Group By name");
    $data['contactno']       = DB::select("SELECT DISTINCT contactno FROM yccleads 
                               where status != '9' AND contactno !='' Group By contactno");
    $data['country']         = DB::select("SELECT DISTINCT country FROM yccleads where 
                                status != '9' AND country !='' Group By country");
    $data['subject']         = DB::select("SELECT DISTINCT subject FROM yccleads where 
                               status != '9'  AND subject !='' Group By subject");
    $data['refcode']         = DB::select("SELECT DISTINCT refcode FROM yccleads where
                               status != '9' AND refcode !='' Group By refcode");
    $data['status']          = DB::select("SELECT DISTINCT status FROM yccleads where
                               status != '9' AND status !='' Group By status");
    $data['created_at']      = DB::select("SELECT DISTINCT created_at FROM yccleads
                               where status != '9 'AND created_at !='' Group By created_at");
    $data['emails']          = DB::select("SELECT DISTINCT id,title FROM emails");

    $data['Total_leads']     = Ycclead::all()->count();
    $data['New']             = Ycclead::where('status',0)->count();
    $data['Inprocess']       = Ycclead::where('status',1)->count();
    $data['NotInterested']   = Ycclead::where('status',4)->count();
    $data['Callback']        = Ycclead::where('status',5)->count();
    $data['TrialCommitted']  = Ycclead::where('status',6)->count();
    $data['TrialDelivered']  = Ycclead::where('status',7)->count();

    //dd($data['new']);
    return view('yccleads.yccleadsmain')->with('data',$data);
}

    public function search(Request $request)
    {
        exit;
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
        return view('yccleads.create');
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
            'name' => 'required',
            'email' => 'required|email',
            'contactno' => 'required',
            'country' => 'required'
        ]);
		//Lead Insertion
		$lead= new \App\Ycclead;
        $lead->name=$request->get('name');
        $lead->email=$request->get('email');
        $lead->contactno=$request->get('contactno');
        $lead->country=$request->get('country');
        $lead->subject=$request->get('subject');
        $lead->message=$request->get('message');
        $lead->source=$request->get('source');
        $lead->refcode=$request->get('refcode');
        $lead->status=0;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();
        $id = $lead->id;
        $url=url('/yccleads/'.$id);
        //Send Notification
        //$users=\App\User::with('role')->where('iscustomer',0)->where('id', $request->get('agentid'))->where('status',1)->get();
        //$letter = collect(['title' => 'New Lead Created','body'=>'A new YCC Lead has been received','redirectURL'=>$url]);
        //Notification::send($users, new LeadNotification($letter));
        
        return redirect('yccleads/')->with('success', 'A new YCC Lead has been created successfully.');
    }
    
    public function addycclead(Request $request)
    {
       exit;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:yccleads',
            'contactno' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data, 401);
        }
		//Lead Insertion
		$lead= new \App\Ycclead;
        $lead->name=$request->get('name');
        $lead->email=$request->get('email');
        $lead->contactno=$request->get('contactno');
        $lead->country=$request->get('country');
        $lead->subject=$request->get('subject');
        $lead->message=$request->get('message');
        $lead->refcode=$request->get('refcode');
        $lead->campaign=$request->get('campaign');
        $lead->source=$request->get('source');
        $lead->status=0;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();
        $id = $lead->id;
        $url=url('/yccleads/'.$id);
        //Send Notification
        $users=\App\User::with('role')->where('iscustomer',0)->where('id', $request->get('agentid'))->where('status',1)->get();
        $letter = collect(['title' => 'New Lead Created','body'=>'A new YCC Lead has been received','redirectURL'=>$url]);
        Notification::send($users, new LeadNotification($letter));
        $response_data=[
            'success' => 1,
            'message' => 'lead created.',
        ];
        return response()->json($response_data, 200);
    }

  public function getleads(Request $request){
        /* Get leads from Your Cloud Campus begin */
        //$server = new Server('mail.nsol.sg');
        // $connection is instance of \Ddeboer\Imap\Connection
        //$connection = $server->authenticate('getlead@nsol.sg', '%h#nNU(1=yB6');
        $hostname="mail.yourcloudcampus.com";
        $port=993;
        $flags="/imap/ssl/novalidate-cert";

        //$server = new Server('mail.yourcloudcampus.com');
        $server = new Server($hostname,$port,$flags);
        $connection = $server->authenticate('leads@yourcloudcampus.com', '1Le{%{7Io@sZ');
            /*$server = new Server(
                "mail.nsol.sg", 
                993,     
                '/imap/ssl/novalidate-cert'
            );*/
            //$server = new Server('mail.nsol.sg');
            // $connection is instance of \Ddeboer\Imap\Connection
           // $connection = $server->authenticate('getlead@nsol.sg', '%h#nNU(1=yB6');
        /*$mailboxes = $connection->getMailboxes();
        

        foreach ($mailboxes as $mailbox) {
            // Skip container-only mailboxes
            // @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
            if ($mailbox->getAttributes() & \LATT_NOSELECT) {
                continue;
            }

            // $mailbox is instance of \Ddeboer\Imap\Mailbox
            printf('Mailbox "%s" has %s messages', $mailbox->getName(), $mailbox->count());
        }*/
        $i=0;
        $mailbox = $connection->getMailbox('INBOX');
        $messages = $mailbox->getMessages();
        foreach($messages as $message){
            $data= explode("##########", $message->getBodyText());
            if(!empty($data[1]))
            {
                $input=explode("###",strip_tags($data[1]));                
                //Apply Insert in DB begins
                //Lead Insertion
                $lead= new \App\Ycclead;
                $lead->name=(isset($input[0])) ? substr(strip_tags(trim($input[0])),0,50) : "";
                $lead->email=(isset($input[1])) ? substr(strip_tags(trim($input[1])),0,100) : "";
                $lead->contactno=(isset($input[2])) ? substr(strip_tags(trim($input[2])),0,20) : "";
                $lead->subject=(isset($input[3])) ? strip_tags(trim($input[3])) : "";
                $lead->country=(isset($input[4])) ? strip_tags(trim($input[4])) : "";
                $lead->message=(isset($input[5]))  ? strip_tags(trim($input[5])) : "";
                $lead->refcode=(isset($input[6])) ? strip_tags(trim($input[6])) : "";
                $lead->campaign="NA";
                $lead->source='Web Form';
                $lead->status=0;
                $date=date_create($request->get('date'));
                $format = date_format($date, "Y-m-d H:i:s");
                $lead->created_at = strtotime($format);
                $lead->updated_at = strtotime($format);
                $lead->save();
                $message->markAsSeen();
                //$message->delete();
                //Apply Insert in DB ends
                $archivemailbox = $connection->getMailbox('INBOX.Archive');
                $message->move($archivemailbox);    
                $i++;
            }
            

        }
        $connection->expunge();
        /* Get leads from Your Cloud Campus end */

        /* Get leads from VR Cloud Campus begin */
        $vrhostname="mail.vrcloudcampus.com";
        $vrport=993;
        $vrflags="/imap/ssl/novalidate-cert";
        $vrserver = new Server($vrhostname,$vrport,$vrflags);
        $vrconnection = $vrserver->authenticate('leads@vrcloudcampus.com', 'levrcc@@21');
        
        $vrmailbox = $vrconnection->getMailbox('INBOX');
        $vrmessages = $vrmailbox->getMessages();
        foreach($vrmessages as $message){           
            //print_r($message->getBodyText());
            $data= explode("##########", $message->getBodyText());
            
            if(!empty($data[1]))
            {
                $input=explode("###",strip_tags($data[1]));                
                //Apply Insert in DB begins
                //Lead Insertion
                $lead= new \App\Ycclead;
                $lead->name=(isset($input[0])) ? substr(strip_tags(trim($input[0])),0,50) : "";
                $lead->email=(isset($input[1])) ? substr(strip_tags(trim($input[1])),0,100) : "";
                $lead->contactno=(isset($input[2])) ? substr(strip_tags(trim($input[2])),0,20) : "";
                $lead->subject=(isset($input[3])) ? strip_tags(trim($input[3])) : "";
                $lead->country=(isset($input[4])) ? strip_tags(trim($input[4])) : "";
                $lead->message=(isset($input[5]))  ? strip_tags(trim($input[5])) : "";
                $lead->refcode=(isset($input[6])) ? strip_tags(trim($input[6])) : "";
                $lead->campaign="NA";
                $lead->source='VR Web Form';
                $lead->status=0;
                $date=date_create($request->get('date'));
                $format = date_format($date, "Y-m-d H:i:s");
                $lead->created_at = strtotime($format);
                $lead->updated_at = strtotime($format);
                $lead->save();
                $message->markAsSeen();
                //$message->delete();
                //Apply Insert in DB ends
                $archivemailbox = $vrconnection->getMailbox('INBOX.Archive');
                $message->move($archivemailbox);    
                $i++;
            }
            

        }
        $vrconnection->expunge();

        /* Get leads from VR Cloud Campus ends */
        if($i > 0){
            $message=$i." new lead(s) has been received.";
            return redirect('yccleads/')->with('success', $message);
        }else{
            $message="No new lead(s) found.";
            return redirect('yccleads/')->with('failed', $message);
        }       

    }
    public function postleadstatus(Request $request){

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'yccleadid' => 'required',
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
		$lead= new \App\Yccleadstatus;
        $lead->ycclead_id=$request->get('yccleadid');
        $lead->status=$request->get('status');
        $lead->note=$request->get('notes');
        $lead->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date, "Y-m-d H:i:s");
        $lead->created_at = strtotime($format);
        $lead->updated_at = strtotime($format);
        $lead->save();

        //Update status of Main lead
        $lead= \App\Ycclead::find($request->get('yccleadid'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lead_detail = \App\Ycclead::find($id);
        $notes = \App\Yccleadstatus::with('createdby')->where('ycclead_id',$id)->orderBy('id', 'DESC')->get();
        if($lead_detail){
            return view('yccleads.show', compact('lead_detail','notes'));
        }else{
            return view('404');
        }

		
    }

    public function nextPrevious($id, $value)
    {
        //

        if($value=='Next') {
            $lead_details = \App\Ycclead::where('id', '>', $id)->min('id');
            $lead_detail = \App\Ycclead::find($lead_details);
        $notes = \App\Yccleadstatus::with('createdby')->where('ycclead_id',$lead_details)->orderBy('id', 'DESC')->get();
        }elseif($value=='Previous'){

        $lead_details = \App\Ycclead::where('id', '<', $id)->max('id');
        $lead_detail = \App\Ycclead::find($lead_details);
        
        $notes = \App\Yccleadstatus::with('createdby')->where('ycclead_id',$lead_details)->orderBy('id', 'DESC')->get();
        }
        



        if($lead_detail){
            return view('yccleads.show', compact('lead_detail','notes'));
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
            'businessName' => 'required',
            'businessAddress' => 'required',
			'businessNature' => 'required',
			'description' => 'required' 
        ]);
        
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
        Notification::send($users, new RecordingNotification($message));

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
        Notification::send($users, new AppointmentNotification($message));


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
        Notification::send($users, new ProposalLeadNotification($message));
        return redirect('leads/'.$id)->with('success', 'Proposal Uploaded Successfully.');
        
    }	

   
   ////// noman functions //////
    public function getEmail(Request $request){

       $id = $request->id;
       $emails = DB::select("SELECT id,title,subject,body FROM emails WHERE id = '$id'");
       //dd($emails);
        if ($emails) {
            
            $data = $emails;
        }else{

            $data = 'Data not found';
        }
       return response()->json($data);
  
    }
	

    public function postEmail(Request $request){
     
     $data = $request->all();
     //$user = Auth::user();

     $senderAddress = 'nsol';
     //dd(config('addresses.'.$senderAddress));

     $config = 'addresses.'.$senderAddress;

    if (filter_var($data['email_id'], FILTER_VALIDATE_EMAIL)) {
    

        Mail::send('emails.email', [
          'data' => $data,
          ], function($message) use ($data, $config){
              
          $message->to($data['email_id']);
          $message->subject($data['subject']);
          $message->from(config($config));
          });

          return redirect()->back()->with('success', 'Email Send Successfully.');

        } else {
            return redirect()->back()->with('success', 'Email address is invalid.');
        }    
      
  
    }



    public function getYccLeadData(Request $request){
       
       $id = $request->id;
       
       $Ycclead = Ycclead::findOrFail($id);
       //dd($emails);
        if ($Ycclead) {
            
            $data = $Ycclead;
        }else{

            $data = 'Data not found';
        }
       return response()->json($data);
  
    }

    public function getYccLeadFilterData(Request $request){
       
       $data = $request->all();
       //dd($data);
       $data = session()->put('filter',$data);
       $value = session()->get('filter');
       //dd($value);
        if ($data) {
            
            $data = $data;
        }else{

            $data = 'Data not found';
        }
       return response()->json($data);
  
    }

    

}



