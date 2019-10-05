<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\YccSupportNotification;
use App\Notifications\YccSupportUnsatifiedNotification;
use App\User;
use App\YccSupport;
use App\Preference;
use App\YccSupportAttachments;
use App\YccSupportMessage;
use App\YccSupportMessageAttachment;
use App\YccSupportStatus;
use Auth;
use DataTables;
use Session;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;
use File;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;
use Ddeboer\Imap\Server;
use App\YccSupportFeedback;

class YccSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('iscustomer', 0)->where('status', 1)->get();
        return view('yccsupport.index',compact('users'));
    }


    public function fetch(Request $request)
    {
        
       
        if ($request->filterdata) {
            // echo "<pre>";
            // print_r($request->filterdata);
            // exit;
            $fromdate = $request->filterdata[0]['value'];
            $todate = $request->filterdata[1]['value'];
            $status = $request->filterdata[2]['value'];
            $assigned_to = $request->filterdata[3]['value'];
            $assgined_by = $request->filterdata[4]['value'];
            $rating = $request->filterdata[5]['value'];
            $from = $request->filterdata[6]['value'];
            $from_email = $request->filterdata[7]['value'];
            $data = YccSupport::where('is_deleted', 0)
                ->whereHas('feedback',function ($query) use ($fromdate, $todate, $status,$assigned_to,$assgined_by,$from,$from_email,$rating) {
                    if (!empty($fromdate)) {
                        $query->whereDate('created_at', '>=', $fromdate);
                    }
                    if (!empty($todate)) {
                        $query->whereDate('created_at', '<=', $todate);
                    }
                    if (!empty($status)) {
                        $query->orWhere('status', $status);
                    }
                    if (!empty($assigned_to)) {
                        $query->orWhere('assignedto', $assigned_to);
                    }
                    if (!empty($assgined_by)) {
                        $query->orWhere('assignedby', $assgined_by);
                    }
                    
                    if (!empty($from)) {
                        $query->orWhere('from','like','%' . $from .'%');
                    }
                    if (!empty($from_email)) {
                        $query->orWhere('email','like','%' . $from_email .'%' );
                    }
                    
                    if (!empty($rating)) {
                        $query->where('rating', $rating);
                    }
                        
                })
                /*->whereHas('assigns', function ($query) use($assigned_to) {
                    $query->where('assignedto', '=', $assigned_to);
                })*/
                ->get();
        } else {

            if(Auth::user()->can('view-all-yccsupporttickets')){
                $data = YccSupport::where('is_deleted', 0)
                                ->orderBy('id','DESC')->get();
            }else{
                $user_id=auth()->user()->id;
                $data = YccSupport::where('is_deleted', 0)
                            ->whereHas('assigns', function ($query) use($user_id) {
                                $query->where('assignedto', '=', $user_id);
                            })
                            ->orderBy('id','DESC')->get();
            }
        }

        return DataTables::of($data)
            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d-M-Y');
            })
            ->addColumn('feedback', function ($data) {
                if ($data->feedback->rating == 'satisfied') {
                    return '<span class="label label-success">Satisfied</span>';
                } else if ($data->feedback->rating == 'not_satisfied') {
                    return '<span class="label label-warning">Not Satisfied</span>';
                } else if($data->feedback->rating == 'poor_service') {
                    return '<span class="label  label-danger">Poor Service</span>';
                }
                
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'progress') {
                    return '<span class="label label-success">Progress</span>';
                } else if ($data->status == 'closed_request') {
                    return '<span class="label label-danger">Close Request</span>';
                } else {
                    return '<span class="label  label-primary">' . $data->status . '</span>';
                }
            })
            ->addColumn('options', function ($data) {
                $options="&emsp;";
                if(Auth::user()->can('yccsupport-edit')){
                    $options.= "<a class='btn btn-success edit_model' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                }
                if(Auth::user()->can('yccsupport-edit')){
                    $options.=" <a data-toggle='tooltip' data-placement='bottom' title='Delete' class='btn btn-danger delete' data-original-title='Disable' href='#' data-id='" . $data->id . "'><i class='fa fa-trash'></i></a>";
                }
                if(Auth::user()->can('yccsupport-edit')){
                    $options.=" <a data-toggle='tooltip' data-placement='bottom' title='Detail' class='btn btn-primary' data-original-title='Detail' href='" . url('/yccsupport/detail/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
                }
                return $options;

            })
            ->rawColumns(['created_at', 'status', 'options','feedback'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'from' => 'required',
            'subject' => 'required',
            'body' => 'required',
            'source' => 'required'
        );

        $data = [
            'from' => trim($request->get('from')),
            'subject' => trim($request->get('subject')),
            'body' => trim($request->get('body')),
            'source' => trim($request->get('source')),
        ];
        $supportfrom=$request->source;
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            if (isset($request->edit_id) && ($request->edit_id != "")) {

                $data = YccSupport::findOrFail($request->edit_id);
                $data->from = $request->from;
                $data->email = $request->email;
                $data->subject = $request->subject;
                $data->body = $request->body;
                $data->createdby = auth()->user()->id;
                $data->supportfrom = $supportfrom;
                $data->save();
                if ($request->hasfile('attachments')) {
                    foreach ($request->attachments as $value) {
                        $extension = $value->getClientOriginalExtension();

                        $file = $value;
                        $filename = time() . $file->getClientOriginalName();
                        Storage::disk('local')->put('/public/ycc_support/' . $filename, File::get($value));
                        $attachments = New YccSupportAttachments;

                        if($extension=='png' || $extension=='jpg' || $extension=='jpeg'){
                            $attachments->type = 1;
                        }else if($extension=='mp3'){
                            $attachments->type = 2;
                        }else{
                            $attachments->type = 3;
                        }
                        $attachments->ycc_supports_id = $data->id;
                        $attachments->attachment = $filename;
                        $attachments->save();
                    }
                }
                $success = 'Record has been updated.';
                return response()->json($success);
            } else {

                $data = New YccSupport;
                $data->from = $request->from;
                $data->email = $request->email;
                $data->subject = $request->subject;
                $data->status = 'new';
                $data->body = $request->body;
                $data->createdby = auth()->user()->id;
                $data->save();
                if ($request->hasfile('attachments')) {
                    foreach ($request->attachments as $value) {
                        $extension = $value->getClientOriginalExtension();

                        $file = $value;
                        $filename = time() . $file->getClientOriginalName();
                        Storage::disk('local')->put('/public/ycc_support/' . $filename, File::get($value));
                        $attachments = New YccSupportAttachments;
                        if($extension=='png' || $extension=='jpg' || $extension=='jpeg'){
                            $attachments->type = 1;
                        }else if($extension=='mp3'){
                            $attachments->type = 2;
                        }else{
                            $attachments->type = 3;
                        }
                        $attachments->ycc_supports_id = $data->id;
                        $attachments->attachment = $filename;
                        $attachments->save();

                    }
                }


                //Create Ticket For First Time

                $emaildata = array([
                            'yccsupport_from' => $request->from,
                            'yccsupport_id'   =>   $data->id,
                            'yccsupport_subject'=>$request->subject,
                            'status'=>'progress',
                        ]);
                
                $view = view('yccsupport.mail',compact('emaildata'))->render();
                
                $emailtemplate = (string) $view;
                //Prepare Email Template Ends

                $mail = new PHPMailer(true);

                try {

                    $mail->isSMTP();
                    $mail->Host       = env('YCC_SUPPORT_SMTP_HOST');
                    $mail->SMTPAuth   = true;
                    $mail->Username   = env('YCC_SUPPORT_SMTP_EMAIL');
                    $mail->Password   = env('YCC_SUPPORT_SMTP_PASS');
                    // $mail->SMTPSecure = false;
                    $mail->Port       = env('YCC_SUPPORT_SMTP_PORT');
                    $mail->setFrom(env('YCC_SUPPORT_SMTP_EMAIL'), 'Ycc Support');
                    $mail->addAddress($request->email);
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = "[Ticket#".$data->id."] ".$request->subject;
                    $mail->Body    = $emailtemplate;

                    $mail->send();
                    // echo 'Message has been sent';
                } catch (Exception $e) {
                    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $success = 'Record has been created.';
                return response()->json($success);
            }
        }

    }


    public function edit(Request $request)
    {
        $data = YccSupport::findOrFail($request->id);
        return response()->json($data);

    }


    public function changestatus(Request $request)
    {
        $rules = array(
            'staff_name' => 'required',
            'assigned_message' => 'required',
        );

        $data = [
            'staff_name' => trim($request->get('staff_name')),
            'assigned_message' => trim($request->get('assigned_message')),
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = YccSupport::findOrFail($request->yccsupport_id);
        $data->status = 'assigned';
        $data->assignedby = auth()->user()->id;
        $data->assignedto = $request->staff_name;
        $data->save();

        //Update Status Table
        $data = new YccSupportStatus;
        $data->yccsupport_id = $request->yccsupport_id;
        $data->assignedby = auth()->user()->id;
        $data->assignedto = $request->staff_name;
        $data->description = $request->assigned_message;
        $data->save();

        $creator=auth()->user()->fname.' '.auth()->user()->lname;
        $url=url('/yccsupport/detail/'.$request->yccsupport_id);
        $users = User::where('id',$request->staff_name)->get();
        $when = Carbon::now()->addSecond();
        $information = collect(['title' => 'New Ycc Support Ticket # '. $request->yccsupport_id .' Assigned','body'=>'A Ticket # '. $request->yccsupport_id .' has been assigned to you by '.$creator,'redirectURL'=>$url]);
        Notification::send($users, (new \App\Notifications\YccSupportNotification($information))->delay($when));

        $data = New YccSupportMessage;
        $data->yccsupport_id = $request->yccsupport_id;
        $data->message = $request->assigned_message;
        $data->status = 'assigned';
        $data->user_id = auth()->user()->id;
        $data->assinged_to = $request->staff_name;
        $data->save();

        $message = 'Successfully Assigned.';
        return response()->json($message);
    }


    public function Disable(Request $request)
    {
        $data = YccSupport::findOrFail($request->id);
        $data->status = 'Disable';
        $data->save();
        $message = 'Successfully Disable.';
        return response()->json($message);

    }

    public function delete(Request $request)
    {
        $data = YccSupport::findOrFail($request->id);
        $data->is_deleted = 1;
        $data->save();
        $message = 'Successfully Delete.';
        return response()->json($message);

    }

    public function detail($id,Request $request)
    {
        
        $messages = YccSupportMessage::with('assets')
            ->where('yccsupport_id',$id)
            ->orderBy('ycc_support_messages.id', 'DESC')
            ->paginate(10);

        // dd($messages->toArray());    
        if ($request->ajax()) {
            $view = view('yccsupport.presult',compact('messages'))->render();
            return response()->json(['html'=>$view]);
        }
        $data = YccSupport::with('attachments')->where('id', $id)->first();
        $feedback = YccSupportFeedback::where('support_id', $id)->first();
        $statuses = YccSupportStatus::where('yccsupport_id', $id)->get();
        $users = User::where('iscustomer', 0)->where('status', 1)->orderBy('fname', 'ASC')->get();
        return view('yccsupport.detail', compact('data','messages','users','feedback','statuses'));
    }


    public function yccsupportaddmessage(Request $request){

        // dd($request->all());
        $data = New YccSupportMessage;
        if($request->internalorexternal){
            $emaildata = array([
                            'yccsupport_from'=>$request->yccsupport_from,
                            'yccsupport_message'=>$request->message,
                            'yccsupport_id'=>$request->yccsupport_id,
                            'yccsupport_subject'=>$request->yccsupport_subject,
                            'status'=>$request->status,
                        ]);
            if($request->status=='closed_request'){
                $view = view('yccsupport.closed',compact('emaildata'))->render();
            }else{
                $view = view('yccsupport.supportmessage',compact('emaildata'))->render();
            }
            $emailtemplate = (string) $view;
            
            $data->external = 1;

            $mail = new PHPMailer(true);

            try {

                $mail->isSMTP();
                $mail->Host       = env('YCC_SUPPORT_SMTP_HOST');
                $mail->SMTPAuth   = true;
                $mail->Username   = env('YCC_SUPPORT_SMTP_EMAIL');
                $mail->Password   = env('YCC_SUPPORT_SMTP_PASS');
                // $mail->SMTPSecure = false;
                $mail->Port       = env('YCC_SUPPORT_SMTP_PORT');
                $mail->setFrom(env('YCC_SUPPORT_SMTP_EMAIL'), 'Ycc Support');
                $mail->addAddress($request->yccsupport_email);
                if ($request->hasfile('attachments')) {
                    foreach ($request->attachments as $value) {
                        $mail->addAttachment($value->path(),$value->getClientOriginalName());
                    }
                }
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = "[Ticket#".$request->yccsupport_id."] ".$request->yccsupport_subject;
                $mail->Body    = $emailtemplate;

                $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        $data->yccsupport_id = $request->yccsupport_id;
        $data->message = $request->message;
        $data->status = $request->status;
        $data->user_id = auth()->user()->id;
        $data->save();

        $data1 = YccSupport::findOrFail($request->yccsupport_id);
        $data1->status = $request->status;
        $data1->save();

        if ($request->hasfile('attachments')) {
            foreach ($request->attachments as $value) {
                $file = $value;
                $filename = time() . $file->getClientOriginalName();
                Storage::disk('local')->put('/public/ycc_support/' . $filename, File::get($value));
                $attachments = New YccSupportMessageAttachment;

                $attachments->message_id = $data->id;
                $attachments->attachment = $filename;
                $attachments->orginalfilename = $file->getClientOriginalName();
                $attachments->save();
            }
        }
        $success = 'Message has been Sent.';
        return response()->json($success);
    }


    // Fetch New Support

    public function getleads(Request $request)
    {
        // $hostname = "imap.gmail.com";
        $hostname = env('YCC_SUPPORT_HOST');
        $port = env('YCC_SUPPORT_PORT');
        // $port = 993;
        // $flags = "/imap/ssl/";
        $flags="/imap/ssl/novalidate-cert";

        //$server = new Server('mail.yourcloudcampus.com');
        $server = new Server($hostname, $port, $flags);

        $connection = $server->authenticate(env('YCC_SUPPORT_EMAIL'), env('YCC_SUPPORT_PASS'));
        

        $i = 0;
        $mailbox = $connection->getMailbox('INBOX');
        $messages = $mailbox->getMessages();
       
        foreach ($messages as $message) {
            // echo $message->getSubject();
            // echo "<br>";

            if(!$message->isSeen()){
                if (strpos($message->getSubject(), '[Ticket#') !== false) {
                    
                    $newsubject = explode(']', $message->getSubject());
                    $newsubject = explode('#', $newsubject[0]);
                    
                    if(!empty($newsubject[1])){

                        $data = New YccSupportMessage;
                        $data->yccsupport_id = $newsubject[1];
                        $data->message = $message->getBodyText();
                        $data->status = '';
                        // $data->user_id = auth()->user()->id;
                        $data->save();
                    }

                }else{
                    // echo $message->getSubject();
                    // echo "<br>";
                    $data = New YccSupport;
                    $data->from = $message->getFrom()->getName();
                    $data->email = $message->getFrom()->getAddress();
                    $data->subject = $message->getSubject();
                    $data->status = 'new';
                    $data->supportfrom = 'Email';
                    $data->body = $message->getBodyHtml();
                    // $data->createdby = auth()->user()->id;
                    $data->save();

                    //Create Ticket for the first time for customer
                    $emaildata = array([
                            'yccsupport_from'=>$message->getFrom()->getName(),
                            'yccsupport_id'=>$data->id,
                            'yccsupport_subject'=>$message->getSubject(),
                            'status'=>'progress',
                                ]);
                    
                    $view = view('yccsupport.mail',compact('emaildata'))->render();
                    
                    $emailtemplate = (string) $view;

                    $mail = new PHPMailer(true);

                    try {

                        $mail->isSMTP();
                        $mail->Host       = env('YCC_SUPPORT_SMTP_HOST');
                        $mail->SMTPAuth   = true;
                        $mail->Username   = env('YCC_SUPPORT_SMTP_EMAIL');
                        $mail->Password   = env('YCC_SUPPORT_SMTP_PASS');
                        // $mail->SMTPSecure = false;
                        $mail->Port       = env('YCC_SUPPORT_SMTP_PORT');
                        $mail->setFrom(env('YCC_SUPPORT_SMTP_EMAIL'), 'Ycc Support');

                        $mail->addAddress($message->getFrom()->getAddress());
                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = "[Ticket#".$data->id."] ".$message->getSubject();
                        $mail->Body    = $emailtemplate;

                        $mail->send();
                        // echo 'Message has been sent';
                    } catch (Exception $e) {
                        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }


                }
                $message->markAsSeen();
                $message->delete();
                // $archivemailbox = $connection->getMailbox('INBOX.Archive');
                // $message->move($archivemailbox);
                $i++;
            }
        }
        $connection->expunge();
        
        $message = '';
        /* Get leads from VR Cloud Campus ends */
        if ($i > 0) {
            $message = $i . " new ticket(s) has been received.";
            return redirect()->route('yccsupport.index');
        } else {
            $message = "No new ticket(s) found.";
            return redirect()->route('yccsupport.index');
        }
        exit;

    }

    public function closeticket($support_id){
        $data = YccSupport::findOrFail($support_id);
        if($data->status=='closed'){

            // $assignedids = YccSupportStatus::groupBy('assignedto')->where('yccsupport_id',41)->pluck('assignedto');
            // $ppwdn = Preference::where('option','yccsupportunsatifiednotification')->first();
            // $ppwd_user_ids = explode(',',$ppwdn->value);
            // $users = array_merge($assignedids->toArray(),$ppwd_user_ids)
          return view('yccsupport.closedfeedback');

        }else{
            return view('yccsupport.closeticket',compact('support_id'));
        }
    }
    public function thanyou(){

        return view('yccsupport.thankyou');
    }

    public function yccsubmitfeedback(Request $request){
        $feedback = new YccSupportFeedback;
        $feedback->support_id = $request->support_id;
        $feedback->rating = $request->rating;
        $feedback->feedback = $request->feedback;
        $feedback->save();

        $data = YccSupport::findOrFail($request->support_id);
        $data->status = 'closed';
        $data->save();

        $data = New YccSupportMessage;
        $data->external = 1;
        $data->yccsupport_id = $request->support_id;
        $data->message = $request->feedback;
        $data->status = 'closed';
        $data->save();

        if($request->rating=='not_satisfied'){
            $url=url('/yccsupport/detail/'.$request->support_id);
            $assignedids = YccSupportStatus::groupBy('assignedto')->where('yccsupport_id',$request->support_id)->pluck('assignedto');
            $ppwdn = Preference::where('option','yccsupportunsatifiednotification')->first();
            $ppwd_user_ids = explode(',',$ppwdn->value);
            $users_ids = array_merge($assignedids->toArray(),$ppwd_user_ids);

            $users = User::whereIn('id',$users_ids)->get();
            $when = Carbon::now()->addSecond();
            $information = collect(['title' => 'Ycc Support Ticket # '. $request->support_id .' has been marked as Unsatisfied','body'=>'Ycc Support Ticket # '. $request->support_id .' has been marked as Unsatisfied by Customer Please review it.','redirectURL'=>$url]);
            Notification::send($users, (new \App\Notifications\YccSupportUnsatifiedNotification($information))->delay($when));
        }
        
        Session::flash('success','Thanks For Your Feedback');
        return redirect()->route('yccsupport_thankyou');
    }


    public function ycccloseticket(Request $request){
        $emaildata = array([
            'yccsupport_from'=>$request->yccsupport_from,
            'yccsupport_id'=>$request->yccsupport_id,
            'yccsupport_subject'=>$request->yccsupport_subject,
            'status'=>'closed_request',
        ]);
       
        $view = view('yccsupport.closed',compact('emaildata'))->render();
        
        $emailtemplate = (string) $view;

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = env('YCC_SUPPORT_SMTP_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('YCC_SUPPORT_SMTP_EMAIL');
            $mail->Password   = env('YCC_SUPPORT_SMTP_PASS');
            // $mail->SMTPSecure = false;
            $mail->Port       = env('YCC_SUPPORT_SMTP_PORT');
            $mail->setFrom(env('YCC_SUPPORT_SMTP_EMAIL'), 'Ycc Support');
            $mail->addAddress($request->yccsupport_email);
            if ($request->hasfile('attachments')) {
                foreach ($request->attachments as $value) {
                    $mail->addAttachment($value->path(),$value->getClientOriginalName());
                }
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = "[Ticket#".$request->yccsupport_id."] ".$request->yccsupport_subject;
            $mail->Body    = $emailtemplate;

            $mail->send();
         echo 'Message has been sent';
        } catch (Exception $e) {
            var_dump($e);
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $data = New YccSupportMessage;
        $data->external = 1;
        $data->yccsupport_id = $request->yccsupport_id;
        $data->message = 'Closed Request Message Has been sent to customer';
        $data->status = 'closed_request';
        $data->user_id = auth()->user()->id;
        $data->save();
        exit;
        Session::flash('success','Closed Request has been forwarded.');
        return redirect()->back();

    }

}
