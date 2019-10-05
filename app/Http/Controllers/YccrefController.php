<?php

namespace App\Http\Controllers;

use App\Yccref;
use DB;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Datatable;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use Session;


use RingCentral\Laravel\Facade\RingCentral;


class YccrefController extends Controller
{

      /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {   
        $users=User::where('iscustomer',0)->where('status', 1)->orderBy('fname', 'ASC')->get();
        return view('yccrefs.index',compact('users'));
    }

   public function fetch(Request $request)
   {
       
    $user=auth()->user();
    $shift=$user->staffdetails->shift;
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'user_id',
            3=> 'created_at',
            4=> 'last_modified_by',
            5=> 'updated_at',
            6=> 'id',
            
        );

        $totalData = Yccref::where('shift', $shift)->count();   
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        if(!empty($request->input('order.0.column'))){
            $order = $columns[$request->input('order.0.column')];
        }
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            

        $data = Yccref::with('lastrefstatus')->where('shift', $shift)->offset($start)->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }else{
        $search = $request->input('search.value'); 

        $data = Yccref::where('id', 'LIKE', '%' . $search . '%')
                ->orwhere('name', 'LIKE', '%' . $search . '%')
                ->orwhere('status', 'LIKE', '%' . $search . '%')
                ->where('shift', $shift)
                ->with('lastrefstatus')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();


        $totalFiltered = Yccref::where('id', 'LIKE', '%' . $search . '%')
                ->orwhere('name', 'LIKE', '%' . $search . '%')
                ->orwhere('status', 'LIKE', '%' . $search . '%')
                ->where('shift', $shift)
                ->count();                  

        }


        $dataArray = array();
        if(!empty($data))
        {
        foreach ($data as $row)
        {

            /*{ "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "contactno" },
            { "data": "country" },
            { "data": "subject" },
            { "data": "message" },
            { "data": "status" },
            { "data": "created_at" },
            { "data": "refcode" },
            { "data": "lastdesc" },
            { "data": "UpdatedBy" },
            { "data": "lastUpdateAt" },*/

        $id = $row->id;               
        $nestedData['id']  = $row->id;
        $nestedData['user_id'] = $row->createdby->fname .' '.$row->createdby->lname;
        $nestedData['name'] = $row->name;
        $nestedData['email'] = $row->email;
        $nestedData['contactno'] = $row->contactno;
        $nestedData['country'] = $row->country;
        $nestedData['subject'] = $row->subject;
        $nestedData['message'] = $row->message;
        $nestedData['status'] = $row->status;
        $nestedData['user_id'] = $row->user->fname.' '.$row->user->lname;
        if(!empty($row->lastrefstatus)){
            $nestedData['lastdesc'] = $row->lastrefstatus->note;
            $nestedData['lastUpdateAt'] = $row->lastrefstatus->created_at->format('d-M-Y');
            $nestedData['UpdatedBy'] = $row->lastrefstatus->createdby->fname .' '. $row->lastrefstatus->createdby->lname;
        }else{
            $nestedData['lastdesc'] = "NA";
            $nestedData['lastUpdateAt'] = "-";
            $nestedData['UpdatedBy'] = "-";
        }

        $nestedData['created_at'] = $row->created_at->format('d-M-Y');
        $statusaction="";
        $edit="";
        $delete="";
        $show="";
        $token=csrf_token();
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
        if(Auth::user()->can('status-yccref')){
            $statusaction="<a class='btn btn-primary newstatus' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-bolt'></i></a> ";
            }
        if(Auth::user()->can('edit-yccref')){
            $edit="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
        }
        if(Auth::user()->can('show-yccref')){
            $show="<a class='btn btn-primary showdetails' href='/yccref/{$id}' target='_blank'><i class='fa fa-eye'></i></a> ";
        }
        if(Auth::user()->can('delete-yccref')){
        $delete=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
        <form id=\"form$id\" action=\"{{action('YccrefController@destroy', $id)}}\" method=\"post\" role='form'>
        <input name=\"_token\" type=\"hidden\" value=\"$token\">
        <input name=\"id\" type=\"hidden\" value=\"$id\">
        <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
        </form>";
        }
        $nestedData['options'] = $show.$edit.$statusaction.$delete;                             

        $dataArray[] = $nestedData;

        }
        }

        $json_data = array(
        "draw"            => intval($request->input('draw')),  
        "recordsTotal"    => intval($totalData),  
        "recordsFiltered" => intval($totalFiltered), 
        "data"            => $dataArray   
        );
        return response()->json($json_data);    
   }
 


   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       exit;
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       
        $this->authorize('create-yccref');
        $rules=[
           'name' => 'required',
           'contactno' => 'required|unique:yccrefs',
        ];
        $errormessage=['name.required' =>'Name is required.','contactno.required'=>"Contact No is required.", 'contactno.unique'=>"Contact No is already exists."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $user=auth()->user();
        $shift=$user->staffdetails->shift;
        $yccref= new \App\Yccref;
        $yccref->name=$request->get('name');
        $yccref->email=$request->get('email');
        $yccref->contactno=$request->get('contactno');
        $yccref->country=$request->get('country');
        $yccref->subject=$request->get('subject');
        $yccref->message=$request->get('message');
        $yccref->shift=$shift;
        $yccref->source=$request->get('source');
        $yccref->status=0;
        $yccref->user_id=$request->get('user_id');
        $yccref->created_by=auth()->user()->id;
        $yccref->modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $yccref->created_at = strtotime($format);
        $yccref->updated_at = strtotime($format);
		$yccref->save();

        return response()->json(['success'=>'Reference created successfully.']);

   }
   
   

 
   public function postleadstatus(Request $request){

       //dd($request->all());
       $validator = Validator::make($request->all(), [
           'yccrefid' => 'required',
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
       $lead= new \App\Yccrefstatus;
       $lead->yccref_id=$request->get('yccrefid');
       $lead->status=$request->get('status');
       $lead->note=$request->get('notes');
       $lead->user_id=auth()->user()->id;
       $date=date_create($request->get('date'));
       $format = date_format($date, "Y-m-d H:i:s");
       $lead->created_at = strtotime($format);
       $lead->updated_at = strtotime($format);
       $lead->save();

       //Update status of Main lead
       $lead= \App\Yccref::find($request->get('yccrefid'));
       $lead->status=$request->get('status');
       $lead->save();
       if (isset($request->show_page) && $request->show_page !='') {
        return redirect()->back()->with('success', 'Reference has been updated successfully.');
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
       
       $user=auth()->user();
       $shift=$user->staffdetails->shift;
       $lead_detail = \App\Yccref::where('id', $id )->where('shift',$shift)->first();
       $notes = \App\Yccrefstatus::with('createdby')->where('yccref_id',$id)->orderBy('id', 'DESC')->get();
       if($lead_detail){
           return view('yccrefs.show', compact('lead_detail','notes'));
       }else{
           return view('404');
       }

       
   }

   
  
    public function edit(Request $request)
    {
        $this->authorize('edit-yccref');
        $data = Yccref::findOrFail($request->id);
        return response()->json($data);
    }

   
   public function update(Request $request)
   {
        
        $this->authorize('edit-yccref');
        $yccref = \App\Yccref::findOrFail($request->get('id'));   
        $rules=[
            'name' => 'required',
            'contactno' => 'required|unique:yccrefs,contactno,'.$yccref->id,
         ];
         $errormessage=['name.required' =>'Name is required.','contactno.required'=>"Contact No is required.", 'contactno.unique'=>"Contact No is already exists."];
         $validator = Validator::make($request->all(), $rules,$errormessage);
         if ($validator->fails()) {
             //pass validator errors as errors object for ajax response
             return response()->json(['errors'=>$validator->errors()]);
         }
 
                  
         $yccref->name=$request->get('name');
         $yccref->email=$request->get('email');
         $yccref->contactno=$request->get('contactno');
         $yccref->country=$request->get('country');
         $yccref->subject=$request->get('subject');
         $yccref->message=$request->get('message');
         $yccref->source=$request->get('source');
         $yccref->status=0;
         $yccref->user_id=$request->get('user_id');
         $yccref->modified_by=auth()->user()->id;
         $date=date_create($request->get('date'));
         $format = date_format($date,"Y-m-d H:i:s");
         $yccref->updated_at = strtotime($format);
         $yccref->save();
 
         return response()->json(['success'=>'Reference updated successfully.']);


    
      
       
   }
   


   public function destroy($id)
   {
       try{
           $lead = \App\Yccref::find($id);
           $lead->delete();
           return redirect()->action(
               'YccrefController@index' 
           )->with('success', 'Reference has been deleted.');
       } catch(\Illuminate\Database\QueryException $ex){ 
           return redirect()->action(
               'YccrefController@index' 
           )->with('failed', 'Unable to delete, this Reference has linked record(s) in system.');
       }

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


}
