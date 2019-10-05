<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Carbon;
use Illuminate\Support\Facades\Hash;
use App\Complaint;
use App\Http\Controllers\Controller;
use App\User;
use App\Comment;
use App\Department;
use DataTables;
use App\Notifications\ComplaintNotification;
use Notification;



class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['complaint'] = Complaint::all();
        $data['department'] = Department::where('status','1')->get();
        return view('complaints.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function fetch(){
        $userId = Auth::user()->id;

        $value = session()->get('filter'); 
         if($value['dateTo']!=""|| $value['dateFrom']!="" || $value['department_id']!="" || $value['status']!="") {
          
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

        if(!empty($value['department_id'])){
            $department_id = $value['department_id'];
        }else{
            $department_id = '';
        }

        if(!empty($value['status'])){
            $status = $value['status'];
        }else{
            $status = '';
        }

         $data =  Complaint::where('user_id',$userId)->where('is_delete','!=','1')->where(function ($query) use ($dateFrom, $dateTo, $status, $department_id) {
                   
                   
                    if (!empty($dateFrom)) {
                        $query->whereDate('created_at', '>=', $dateFrom);

                    }

                    if (!empty($dateTo)) {
                        $query->whereDate('created_at', '<=', $dateTo);

                    }

                    

                    if (!empty($status)) {
                        $query->where('status', $status);
                    }

                     if (!empty($department_id)) {
                        $query->where('department_id', $department_id);
                    }

                   
                })
                ->get();
         $value = session()->forget('filter'); 
  
        }else
        {
        $data = Complaint::where('user_id',$userId)->where('is_delete','!=','1')->orderBy('id','desc');
        }
        return DataTables::of($data)
        ->addColumn('user_id',function($data){
            return $data->user->fname;
        })
        ->addColumn('department_id',function($data){
            return $data->department->deptname;
        })
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Pending') {
            return '<span class="label label-info">Pending</span>';
          }else if($data->status=='Closed'){
            return '<span class="label label-success">Closed</span>';
          }else if($data->status=='Forwarded'){
            return '<span class="label label-warning">Forwarded</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
        
        ->addColumn('options',function($data){
          if(count($data->comments)>0){
            return "&emsp;<a class='btn btn-info'
                                     href='".url('complaint/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     ";
          }else{

            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a class='btn btn-info'
                                     href='".url('complaint/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     <a class='btn btn-danger disable'
                                     href='#' data-id='".$data->id."'><i class='fa fa-trash'></i></a>";
          }
            
        })
      ->rawColumns(['user_id','department_id','created_at', 'status','options'])
      ->make(true);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = array(
        'department_id' => 'required',
        'title' => 'required',
        'description' => 'required',
       );

      $data = [
            'department_id' => trim($request->get('department_id')),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            ];

        
        
    $validator = Validator::make($data,$rules);
     
    if($validator->fails())
    {

      return  response()->json(['errors'=>$validator->errors()]);
    }
    else 
    {
      $user = Auth::user()->id;
        
        if(isset($request->edit_id) && ($request->edit_id !="") )
        {
        $data = Complaint::findOrFail($request->edit_id);
        if(count($data->comments)>0){
          $success = 'Sorry not updated.';
          return response()->json($success);
        }else{
        $data->user_id = $user;
        $data->department_id     = $request->department_id;
        $data->title     = $request->title;
        $data->description     = $request->description;
        $data->status        = 'Active';
        $data->save(); 
        $success = 'Complaint has been updated.';
        return response()->json($success);
        }
        
        }else{

        $data = New Complaint;
        $data->user_id = $user;
        $data->department_id     = $request->department_id;
        $data->title     = $request->title;
        $data->description     = $request->description;
        $data->status        = 'Active';
        $data->save();
        $success = 'Complaint has been created.';
          $url=url('/departcomplaint/show/'.$data->id);
          $creator=auth()->user()->fname.' '.auth()->user()->lname;
          //Send Notification
          //Need to enabled with conditions currently sending to all users in the DB
          if($request->department_id==7){
            $users=\App\User::with('role')->where('iscustomer',0)->where('department_id', $request->department_id)->where('status',1)->get();
            $letter = collect(['title' => 'New Complaint Generated','body'=>'A new complaint has been created by '.$creator.' and assigned to your deparment, please review it.','redirectURL'=>$url]);  
            //$when = Carbon::now()->addSecond();
            Notification::send($users, new ComplaintNotification($letter)); 
          }
          
        return response()->json($success);
       }
    }
    
    }


    /*
    * comment store for 
    * complaint
    *
    */

    public function commentStore(Request $request)
    {
       $rules = array(
        //'department_id' => 'required',
        'comment' => 'required',
        'status' => 'required',
       );

      $data = [
            'department_id' => trim($request->get('department_id')),
            'comment' => $request->get('comment'),
            'status' => $request->get('status'),
            ];

        
        
    $validator = Validator::make($data,$rules);
     
    if($validator->fails())
    {

      return  response()->json(['errors'=>$validator->errors()]);
    }
    else 
    {
        $user = Auth::user()->id;
        $data = New Comment;
        $data->user_id = $user;
        $data->department_id     = $request->department_id;
        $data->complaint_id     = $request->complaint_id;
        $data->comment     = $request->comment;
        $data->status        = $request->status;
        $data->save();
        $success = 'Success.';
        
        //complaint status update
        if($data){ 
        $complaint = Complaint::findOrFail($data->complaint_id);
        $complaint->status        = $data->status;
        $complaint->save();
        }
        return response()->json($success);
       
    }
    
    }


    // comment fetch
    public function commentFetch(Request $request)
    {

       //$data = Complaint::orderBy('id','desc')->get();
       $data = Comment::where('complaint_id',$request->id)->orderBy('id','desc');
        return DataTables::of($data)
        ->addColumn('user_id',function($data){
            return $data->user->fname.' '.$data->user->lname;
        })
        
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Pending') {
            return '<span class="label label-info">Pending</span>';
          }else if($data->status=='Closed'){
            return '<span class="label label-success">Closed</span>';
          }else if($data->status=='Forwarded'){
            return '<span class="label label-warning">Forwarded</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
        
        ->rawColumns(['user_id','created_at', 'status'])
        ->make(true);
        
       // return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
      $userId = Auth::user()->id;
      $data['complaint'] = Complaint::where('is_delete','!=','1')->where('id',$id)->where('user_id',$userId)->first();
      if($data['complaint']){
      $comment = Comment::where('complaint_id',$id)->orderBy('id','desc')->paginate(10);
      $data['department'] = Department::where('status','1')->get();
      if ($request->ajax()) {
          $view = view('complaints.presult',compact('comment'))->render();
            return response()->json(['html'=>$view]);
           // return view('complaints.presult')->with('comment',$comment);
        }
        return view('complaints.show')->with('data',$data)
                                      ->with('comment',$comment);
      }else{
        return redirect()->back();
      }
    }

    public function comment(Request $request)
    {
        $data = Complaint::findOrFail($request->id);
        //dd($trulies->report->description);
        return response()->json($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    // dd($request->all());  
      $data = Complaint::findOrFail($request->id);
      return response()->json($data);

    }

    public function disable(Request $request)
    {
      $data = Complaint::findOrFail($request->id);
      if(count($data->comments)>0){
      
      $message = 'Sorry.';
      return response()->json($message);
      }else{

      $data->is_delete = '1';
      $data->save();
      $message = 'Successfully Delete.';
      return response()->json($message);
      }

    }



    public function department_index()
    {
        $data['complaint'] = Complaint::all();
        $data['department'] = Department::where('status','1')->get();
        return view('complaints.depart_index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function department_fetch(){
        
        $departmentId = Auth::user()->department_id;

        $value = session()->get('filter'); 
         if($value['dateTo']!=""|| $value['dateFrom']!="" || $value['status']!="") {
          
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

        

        if(!empty($value['status'])){
            $status = $value['status'];
        }else{
            $status = '';
        }

         $data =  Complaint::where('department_id',$departmentId)->where('is_delete','!=','1')->where(function ($query) use ($dateFrom, $dateTo, $status) {
                   
                    if (!empty($dateFrom)) {
                        $query->whereDate('created_at', '>=', $dateFrom);

                    }

                    if (!empty($dateTo)) {
                        $query->whereDate('created_at', '<=', $dateTo);

                    }

                    if (!empty($status)) {
                        $query->where('status', $status);
                    }
                })
                ->get();
         $value = session()->forget('filter'); 
  
        }else{
        
        $data = Complaint::where('department_id',$departmentId)->where('is_delete','!=','1')->orderBy('id','desc');
        }
        return DataTables::of($data)
        ->addColumn('user_id',function($data){
            return $data->user->fname;
        })
        ->addColumn('department_id',function($data){
            return $data->department->deptname;
        })
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Pending') {
            return '<span class="label label-info">Pending</span>';
          }else if($data->status=='Closed'){
            return '<span class="label label-success">Closed</span>';
          }else if($data->status=='Forwarded'){
            return '<span class="label label-warning">Forwarded</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
        
        ->addColumn('options',function($data){
          if(count($data->comments)>0){
            return "&emsp;<a class='btn btn-info'
                                     href='".url('departcomplaint/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     ";
          }else{

            return "&emsp;<a class='btn btn-info'
                                     href='".url('departcomplaint/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     <a class='btn btn-danger disable'
                                     href='#' data-id='".$data->id."'><i class='fa fa-trash'></i></a>";
          }
            
        })
      ->rawColumns(['user_id','department_id','created_at', 'status','options'])
      ->make(true);
    
    }

    public function department_show(Request $request,$id)
    {
      $departmentId = Auth::user()->department_id;
      $data['complaint'] = Complaint::where('is_delete','!=','1')->where('id',$id)->where('department_id',$departmentId)->first();
      if($data['complaint']){
      $comment = Comment::where('complaint_id',$id)->orderBy('id','desc')->paginate(10);
      $data['department'] = Department::where('status','1')->get();
        if ($request->ajax()) {
          $view = view('complaints.presult',compact('comment'))->render();
            return response()->json(['html'=>$view]);
           // return view('complaints.presult')->with('comment',$comment);
        } 
        return view('complaints.depart_show')->with('data',$data)
                                             ->with('comment',$comment);
      }else{
        return redirect()->back();
      }
    }



    public function all_index()
    {
        $data['complaint'] = Complaint::all();
        $data['department'] = Department::where('status','1')->get();
        return view('complaints.all_index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function all_fetch(){

        $value = session()->get('filter'); 
         if($value['dateTo']!=""|| $value['dateFrom']!="" || $value['department_id']!="" || $value['status']!="") {
          
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

        if(!empty($value['department_id'])){
            $department_id = $value['department_id'];
        }else{
            $department_id = '';
        }

        if(!empty($value['status'])){
            $status = $value['status'];
        }else{
            $status = '';
        }

         $data =  Complaint::where('is_delete','!=','1')->where(function ($query) use ($dateFrom, $dateTo, $status, $department_id) {
                   
                     if (!empty($dateFrom)) {
                        $query->whereDate('created_at', '>=', $dateFrom);

                    }

                    if (!empty($dateTo)) {
                        $query->whereDate('created_at', '<=', $dateTo);

                    }

                    if (!empty($status)) {
                        $query->where('status', $status);
                    }

                     if (!empty($department_id)) {
                        $query->where('department_id', $department_id);
                    }

                   
                })
                ->get();
         $value = session()->forget('filter'); 
  
        }else
        {
        $data = Complaint::where('is_delete','!=','1')->orderBy('id','desc');
        }
        return DataTables::of($data)
        ->addColumn('user_id',function($data){
            return $data->user->fname;
        })
        ->addColumn('department_id',function($data){
            return $data->department->deptname;
        })
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Pending') {
            return '<span class="label label-info">Pending</span>';
          }else if($data->status=='Closed'){
            return '<span class="label label-success">Closed</span>';
          }else if($data->status=='Forwarded'){
            return '<span class="label label-warning">Forwarded</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })
        
        ->addColumn('options',function($data){
          if(count($data->comments)>0){
            return "&emsp;<a class='btn btn-info'
                                     href='".url('allcomplaint/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     ";
          }else{

            return "&emsp;<a class='btn btn-info'
                                     href='".url('allcomplaint/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     <a class='btn btn-danger disable'
                                     href='#' data-id='".$data->id."'><i class='fa fa-trash'></i></a>";
          }
            
        })
      ->rawColumns(['user_id','department_id','created_at', 'status','options'])
      ->make(true);
    
    }


    public function all_show(Request $request, $id)
    {

      $data['complaint'] = Complaint::where('is_delete','!=','1')->where('id',$id)->first();
      //dd($data['complaint']);
      if($data['complaint']){
      $data['comment'] = Comment::where('complaint_id',$id)->get();
      $comment = Comment::where('complaint_id',$id)->orderBy('id','desc')->paginate(10);
      $data['department'] = Department::where('status','1')->get();
        //dd($comment);
        if ($request->ajax()) {
          $view = view('complaints.presult',compact('comment'))->render();
            return response()->json(['html'=>$view]);
           // return view('complaints.presult')->with('comment',$comment);
        }
        return view('complaints.all_show')->with('data',$data)
                                          ->with('comment',$comment);
      }else{
        return redirect()->back();
      }
    }

   

}
