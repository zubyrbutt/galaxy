<?php

namespace App\Http\Controllers;
use App\Hrlead;
use App\Hrleadstatus;
use Illuminate\Http\Request;
use Response;
use DB;
use Validator;
use App\User;
use App\Department;
use Auth;
use File;
use Excel;
use Carbon\Carbon;
class HrleadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        return view('hrlead.index', compact('departments'));
    }

    public function fetch(Request $request)
    {
        $columns = array( 
                            'id', 
                            'name',
                            'email',
                            'mobile',
                            'deparment_id',
                            'user_id',
                            'created_at',
                            'id',
                            
                        );

         $totalData = Hrlead::count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        // /columns[4][search][value]
        if(!empty($request->input('columns.4.search.value')) ){
            $search = $request->input('search.value'); 
            $data = Hrlead::where('department_id', $request->input('columns.4.search.value'))
                            ->where(function($q) use ($search) {
                                $q->where('name', 'LIKE', '%' . $search . '%')
                                ->orwhere('email', 'LIKE', '%' . $search . '%')
                                ->orwhere('mobile', 'LIKE', '%' . $search . '%');
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order, $dir)
                            ->get();

            $totalFiltered = Hrlead::where('department_id', $request->input('columns.4.search.value'))
                                    ->where(function($q) use ($search) {
                                        $q->where('name', 'LIKE', '%' . $search . '%')
                                        ->orwhere('email', 'LIKE', '%' . $search . '%')
                                        ->orwhere('mobile', 'LIKE', '%' . $search . '%');
                                    })
                                ->count();   
        }elseif(empty($request->input('search.value'))){            
            
                $data = Hrlead::offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();

        }else{
            $search = $request->input('search.value'); 

            $data = Hrlead::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('email', 'LIKE', '%' . $search . '%')
                              ->orwhere('mobile', 'LIKE', '%' . $search . '%')
                              ->orwhere('department_id', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();



            $totalFiltered = Hrlead::where('id', 'LIKE', '%' . $search . '%')
                                ->orwhere('name', 'LIKE', '%' . $search . '%')
                                ->orwhere('email', 'LIKE', '%' . $search . '%')
                                ->orwhere('mobile', 'LIKE', '%' . $search . '%')
                                ->orwhere('department_id', 'LIKE', '%' . $search . '%')
                                ->orwhere('status', 'LIKE', '%' . $search . '%')
                                ->count();                  
           
        }


        $dataArray = array();
        if(!empty($data))
        {
            foreach ($data as $row)
            {
                
                $id = $row->id;               
                $nestedData['id']  = $row->id;
                $nestedData['user_id'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile;
                $nestedData['department_id'] = $row->department->deptname;
                $nestedData['created_at'] = $row->created_at->format('d-M-Y');
                $statusaction="";
                $editdept="";
                $deletedept="";
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">New</span>';
                  
                }else{
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Rejected</span>';
                }
                switch($row->status){
						case(0):
                            $nestedData['status']='<button class="btn btn-danger btn-sm">Rejected</button></td>';
							break;
						case(1):
                            $nestedData['status']='<button class="btn btn-info btn-sm">New</button></td>';
							break;
						case(2):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Not Picking Call</button></td>';
							break;
						case(3):
                            $nestedData['status']='<button class="btn btn-warning btn-sm">Incorrect Information</button></td>';
							break;
						case(4):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Call Made</button></td>';
							break;
						case(5):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Interview Scheduled</button></td>';
                            break;
                        case(6):
                            $nestedData['status']='<button class="btn btn-warning btn-sm">Not Appeared</button>';
                            break;
                        case(7):
                            $nestedData['status']='<button class="btn btn-info btn-sm">Rescheduled</button>';
                            break;
                        case(8):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Appeared</button>';
                            break;
                        case(9):
                            $nestedData['status']='<button class="btn btn-info btn-sm">Second Interview</button>';
                            break;
                        case(10):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Short listed</button>';
                            break;
                        case(11):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Selected</button>';
                            break;
                        case(12):
                            $nestedData['status']='<button class="btn btn-danger btn-sm">Not Joined</button>';
                            break;
                        case(13):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Joined</button>';
                            break;
						default:
                        $nestedData['status']='<button class="btn btn-danger btn-sm">Unknown</button>';
                }
                    
                if(Auth::user()->can('edit-hrleads')){
                    $editlead="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('show-hrleads')){
                    $showlead="<a class='btn btn-primary showlead' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-eye'></i></a> ";
                }
                if(Auth::user()->can('delete-hrleads')){
                    $deletelead=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('UserController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                $nestedData['options'] = $showlead.$editlead.$deletelead;                             
                
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

    //Manage Interviewees begins
    public function interviewees()
    {
        
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        return view('hrlead.interviewees', compact('departments'));
    }

    public function fetchinterviewees(Request $request)
    {
        $columns = array( 
                            'id', 
                            'name',
                            'email',
                            'mobile',
                            'deparment_id',
                            'user_id',
                            'created_at',
                            'id',
                            
                        );
        if(!empty($request->input('columns.6.search.value'))){
            $daterange=explode(',',$request->input('columns.6.search.value'));
            $from = date($daterange[0]);
            $to = date($daterange[1]);
            
        }else{
            $from = date('Y-m-d');
            $to = date('Y-m-d');
        }

        $from = $from." 00:00:00";
        $to = $to." 23:59:59";

        /*echo $from;
        echo "<br>";
        echo $to;
        echo "<br>";*/
        $totalData = Hrlead::where('status', '>' ,'4')
                            ->whereBetween('interviewdate', [$from, $to])
                            ->count();   
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        // /columns[4][search][value]
        
        if(!empty($request->input('columns.4.search.value')) ){
            $search = $request->input('search.value'); 
            $data = Hrlead::where('department_id', $request->input('columns.4.search.value'))
                            ->where('status', '>' ,'4')
                            ->whereBetween('interviewdate', [$from, $to])
                            ->where(function($q) use ($search) {
                                $q->where('name', 'LIKE', '%' . $search . '%')
                                ->orwhere('email', 'LIKE', '%' . $search . '%')
                                ->orwhere('mobile', 'LIKE', '%' . $search . '%');
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order, $dir)
                            ->get();

            $totalFiltered = Hrlead::where('department_id', $request->input('columns.4.search.value'))
                                    ->where('status', '>' ,'4')
                                    ->whereBetween('interviewdate', [$from, $to])
                                    ->where(function($q) use ($search) {
                                        $q->where('name', 'LIKE', '%' . $search . '%')
                                        ->orwhere('email', 'LIKE', '%' . $search . '%')
                                        ->orwhere('mobile', 'LIKE', '%' . $search . '%');
                                    })
                                ->count();   
        }elseif(empty($request->input('search.value'))){            
            
                $data = Hrlead::where('status', '>' ,'4')
                         ->whereBetween('interviewdate', [$from, $to])
                         ->offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();

        }else{
            $search = $request->input('search.value'); 

            $data = Hrlead::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('email', 'LIKE', '%' . $search . '%')
                              ->orwhere('mobile', 'LIKE', '%' . $search . '%')
                              ->orwhere('department_id', 'LIKE', '%' . $search . '%')
                              ->where('status', '>' ,'4')
                              ->whereBetween('interviewdate', [$from, $to])
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();



            $totalFiltered = Hrlead::where('id', 'LIKE', '%' . $search . '%')
                                ->orwhere('name', 'LIKE', '%' . $search . '%')
                                ->orwhere('email', 'LIKE', '%' . $search . '%')
                                ->orwhere('mobile', 'LIKE', '%' . $search . '%')
                                ->orwhere('department_id', 'LIKE', '%' . $search . '%')
                                ->orwhere('status', 'LIKE', '%' . $search . '%')
                                ->where('status', '>' ,'4')
                                ->whereBetween('interviewdate', [$from, $to])
                                ->count();                  
           
        }

        
        $dataArray = array();
        if(!empty($data))
        {
            foreach ($data as $row)
            {
                
                $id = $row->id;               
                $nestedData['id']  = $row->id;
                $nestedData['user_id'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile;
                $nestedData['department_id'] = $row->department->deptname;
                $nestedData['created_at'] = $row->interviewdate->format('d-M-Y H:i:s');
                $statusaction="";
                $editdept="";
                $deletedept="";
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">New</span>';
                  
                }else{
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Rejected</span>';
                }
                switch($row->status){
						case(0):
                            $nestedData['status']='<button class="btn btn-danger btn-sm">Rejected</button>';
							break;
						case(1):
                            $nestedData['status']='<button class="btn btn-info btn-sm">New</button>';
							break;
						case(2):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Not Picking Call</button>';
							break;
						case(3):
                            $nestedData['status']='<button class="btn btn-warning btn-sm">Incorrect Information</button>';
							break;
						case(4):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Call Made</button>';
							break;
						case(5):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Interview Scheduled</button>';
                            break;
                        case(6):
                            $nestedData['status']='<button class="btn btn-warning btn-sm">Not Appeared</button>';
                            break;
                        case(7):
                            $nestedData['status']='<button class="btn btn-info btn-sm">Rescheduled</button>';
                            break;
                        case(8):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Appeared</button>';
                            break;
                        case(9):
                            $nestedData['status']='<button class="btn btn-info btn-sm">Second Interview</button>';
                            break;
                        case(10):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Short listed</button>';
                            break;
                        case(11):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Selected</button>';
                            break;
                        case(12):
                            $nestedData['status']='<button class="btn btn-danger btn-sm">Not Joined</button>';
                            break;
                        case(13):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Joined</button>';
                            break;
						default:
                        $nestedData['status']='<button class="btn btn-danger btn-sm">Unknown</button>';
                }
                    
                if(Auth::user()->can('edit-hrleads')){
                    $editlead="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('show-hrleads')){
                    $showlead="<a class='btn btn-primary showlead' href='javascript:void(0)' data-id='{$id}' data-status='1'><i class='fa fa-eye'></i></a> ";
                }
                $nestedData['options'] = $showlead.$editlead;                             
                
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

    //Manage Interviewees ends


    //Manage Interviews Begins
    public function interviews()
    {
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        return view('hrlead.interviews', compact('departments'));
    }
    public function fetchinterviews(Request $request)
    {
        $columns = array( 
                            'id', 
                            'name',
                            'email',
                            'mobile',
                            'deparment_id',
                            'user_id',
                            'created_at',
                            'id',
                            
                        );
        if(!empty($request->input('columns.6.search.value'))){
            $daterange=explode(',',$request->input('columns.6.search.value'));
            $from = date($daterange[0]);
            $to = date($daterange[1]);
            
        }else{
            $start = new Carbon('first day of this month');
            $end = new Carbon('last day of this month');            
            $from = date('Y-m-d');
            $to = date('Y-m-d');
            $from=$start->format('Y-m-d');
            $to=$end->format('Y-m-d');
        }
        $from = $from." 00:00:00";
        $to = $to." 23:59:59";
        $totalData = Hrlead::where('status', '>=','8')
                            ->whereBetween('interviewdate', [$from, $to])
                            ->count();   
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        // /columns[4][search][value]
        
        if(!empty($request->input('columns.4.search.value')) ){
            $search = $request->input('search.value'); 
            $data = Hrlead::where('department_id', $request->input('columns.4.search.value'))
                            ->where('status', '>=','8')
                            ->whereBetween('interviewdate', [$from, $to])
                            ->where(function($q) use ($search) {
                                $q->where('name', 'LIKE', '%' . $search . '%')
                                ->orwhere('email', 'LIKE', '%' . $search . '%')
                                ->orwhere('mobile', 'LIKE', '%' . $search . '%');
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order, $dir)
                            ->get();

            $totalFiltered = Hrlead::where('department_id', $request->input('columns.4.search.value'))
                                    ->where('status', '>=','8')
                                    ->whereBetween('interviewdate', [$from, $to])
                                    ->where(function($q) use ($search) {
                                        $q->where('name', 'LIKE', '%' . $search . '%')
                                        ->orwhere('email', 'LIKE', '%' . $search . '%')
                                        ->orwhere('mobile', 'LIKE', '%' . $search . '%');
                                    })
                                ->count();   
        }elseif(empty($request->input('search.value'))){            
            
                $data = Hrlead::where('status', '>=','8')
                         ->whereBetween('interviewdate', [$from, $to])
                         ->offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();

        }else{
            $search = $request->input('search.value'); 

            $data = Hrlead::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('email', 'LIKE', '%' . $search . '%')
                              ->orwhere('mobile', 'LIKE', '%' . $search . '%')
                              ->orwhere('department_id', 'LIKE', '%' . $search . '%')
                              ->where('status', '>=','8')
                              ->whereBetween('interviewdate', [$from, $to])
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();



            $totalFiltered = Hrlead::where('id', 'LIKE', '%' . $search . '%')
                                ->orwhere('name', 'LIKE', '%' . $search . '%')
                                ->orwhere('email', 'LIKE', '%' . $search . '%')
                                ->orwhere('mobile', 'LIKE', '%' . $search . '%')
                                ->orwhere('department_id', 'LIKE', '%' . $search . '%')
                                ->orwhere('status', 'LIKE', '%' . $search . '%')
                                ->where('status', '>=','8')
                                ->whereBetween('interviewdate', [$from, $to])
                                ->count();                  
           
        }


        $dataArray = array();
        if(!empty($data))
        {
            foreach ($data as $row)
            {
                
                $id = $row->id;               
                $nestedData['id']  = $row->id;
                $nestedData['user_id'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile;
                $nestedData['department_id'] = $row->department->deptname;
                $nestedData['created_at'] = $row->interviewdate->format('d-M-Y H:i:s');
                $statusaction="";
                $editdept="";
                $deletedept="";
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">New</span>';
                  
                }else{
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Rejected</span>';
                }
                switch($row->status){
						case(0):
                            $nestedData['status']='<button class="btn btn-danger btn-sm">Rejected</button>';
							break;
						case(1):
                            $nestedData['status']='<button class="btn btn-info btn-sm">New</button>';
							break;
						case(2):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Not Picking Call</button>';
							break;
						case(3):
                            $nestedData['status']='<button class="btn btn-warning btn-sm">Incorrect Information</button>';
							break;
						case(4):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Call Made</button>';
							break;
						case(5):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Interview Scheduled</button>';
                            break;
                        case(6):
                            $nestedData['status']='<button class="btn btn-warning btn-sm">Not Appeared</button>';
                            break;
                        case(7):
                            $nestedData['status']='<button class="btn btn-info btn-sm">Rescheduled</button>';
                            break;
                        case(8):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Appeared</button>';
                            break;
                        case(9):
                            $nestedData['status']='<button class="btn btn-info btn-sm">Second Interview</button>';
                            break;
                        case(10):
                            $nestedData['status']='<button class="btn btn-primary btn-sm">Short listed</button>';
                            break;
                        case(11):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Selected</button>';
                            break;
                        case(12):
                            $nestedData['status']='<button class="btn btn-danger btn-sm">Not Joined</button>';
                            break;
                        case(13):
                            $nestedData['status']='<button class="btn btn-success btn-sm">Joined</button>';
                            break;
						default:
                        $nestedData['status']='<button class="btn btn-danger btn-sm">Unknown</button>';
                }
                    
                if(Auth::user()->can('edit-hrleads')){
                    $editlead="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('show-hrleads')){
                    $showlead="<a class='btn btn-primary showlead' href='javascript:void(0)' data-id='{$id}' data-status='2'><i class='fa fa-eye'></i></a> ";
                }
                $nestedData['options'] = $showlead.$editlead;                             
                
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

    //Manage Interview Ends

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
        $this->authorize('create-hrleads');
        $rules=[
            'name' => 'required',
            'email' => 'nullable|email|unique:hrleads', 
            'mobile' => 'nullable|unique:hrleads',
            'department_id' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $hrlead= new \App\Hrlead;
        $hrlead->name=$request->get('name');
        $hrlead->email=$request->get('email');
        $hrlead->mobile=$request->get('mobile');
        $hrlead->department_id=$request->get('department_id');
        $hrlead->status=1;      
        $hrlead->user_id=auth()->user()->id;
        $hrlead->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $hrlead->created_at = strtotime($format);
        $hrlead->updated_at = strtotime($format);
		$hrlead->save();

        return response()->json(['success'=>'New lead created successfully.']);
    }

    public function upload(Request $request)
    {
        //$this->authorize('upload-hrleads');
        //return response()->json(['success'=>'New leads uploaded successfully.']);
        //Excel::import(new leadfile, 'test.xlsx');
        $rules=[
            "leadfile" => 'required|mimes:csv,xls,xlsx,txt',
            'department_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        $countimport=0;
        $countignore=0;
        if($request->hasFile('leadfile')){
            Excel::load($request->file('leadfile')->getRealPath() , function ($reader) use ($request, &$countimport, &$countignore) {
                foreach ($reader->toArray() as $key => $row) {

                    $data['name'] = $row['name'];
                    $data['email'] = $row['email'];
                    $data['mobile'] = $row['mobile'];
                    $data['department_id'] =$request->get('department_id');
                    $data['status'] = 1;
                    $data['user_id'] = auth()->user()->id;
                    $data['last_modified_by'] = auth()->user()->id;                    
                    $date=date_create($request->get('date'));
                    $format = date_format($date,"Y-m-d H:i:s");
                    $data['created_at'] = $format;
                    $data['updated_at'] = $format;

                    if(!empty($data)) {
                        
                        if($hrlead = Hrlead::where('email',$data['email'])->exists()){
                            $countignore++;
                        }else{
                            $hrlead= new \App\Hrlead;
                            $hrlead->name=$row['name'];
                            $hrlead->email=$row['email'];
                            $hrlead->mobile=$row['mobile'];
                            $hrlead->department_id=$request->get('department_id');
                            $hrlead->status=1;      
                            $hrlead->user_id=auth()->user()->id;
                            $hrlead->last_modified_by=auth()->user()->id;
                            $date=date_create($request->get('date'));
                            $format = date_format($date,"Y-m-d H:i:s");
                            $hrlead->created_at = strtotime($format);
                            $hrlead->updated_at = strtotime($format);
                            $hrlead->save();
                            $countimport++;
                        }
                    }
                }
            });
        }
        if($countimport > 0){
            if($countignore > 0){
                return response()->json(['success'=>$countimport. ' new lead(s) uploaded successfully and '.$countignore.' lead(s) ignored.']);        
            }else{
                return response()->json(['success'=>$countimport. ' new lead(s) uploaded successfully']);
            }
        }else{
            return response()->json(['success'=>'No new leads to upload/import.']);        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hrlead  $hrlead
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->authorize('show-hrleads');
        if(!empty($request->showstatus)){
            $showstatus=$request->showstatus;
        }else{
            $showstatus=0;
        }
        $hrleads = Hrlead::findOrFail($request->id);
        $hrleadstatus = Hrleadstatus::where('hrlead_id',$request->id)->get();
        if($request->ajax()) {
            return  view('hrlead.showajax')->with(compact('showstatus','hrleads','hrleadstatus'));
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hrlead  $hrlead
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {     
        $this->authorize('edit-hrleads');
        $data = Hrlead::findOrFail($request->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hrlead  $hrlead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('edit-hrleads');
        $hrlead = \App\Hrlead::findOrFail($request->get('id'));
        $rules=[
            'name' => 'required',
            'email' => 'nullable|email|unique:hrleads,email,'.$hrlead->id,
            'mobile' => 'nullable|unique:hrleads,mobile,'.$hrlead->id,
            'department_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $hrlead->name=$request->get('name');
        $hrlead->email=$request->get('email');
        $hrlead->mobile=$request->get('mobile');
        $hrlead->department_id=$request->get('department_id');
        $hrlead->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $hrlead->updated_at = strtotime($format);
		$hrlead->save();

        return response()->json(['success'=>'Lead has been updated successfully.']);
    }

    public function status(Request $request)
    {
        
        $this->authorize('status-hrleads');
        $rules=[
            'status' => 'required',
            'remarks' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        $hrleadstatus = new \App\Hrleadstatus;
        $hrleadstatus->status=$request->get('status');
        $hrleadstatus->remarks=$request->get('remarks');
        $hrleadstatus->recordinglink=$request->get('recordinglink');
        $hrleadstatus->hrlead_id=$request->get('hrlead_id');
        if(!empty($request->get('interviewdate'))){
            $date=date_create($request->get('interviewdate'));
            $format = date_format($date,"Y-m-d H:i:s");
            $hrleadstatus->interviewdate=strtotime($format);
        }
        $hrleadstatus->user_id=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $hrleadstatus->updated_at = strtotime($format);
        $hrleadstatus->save();
        $sendsms=false;
        //Updating HRLead Status begins
        if(!empty($request->get('interviewdate') && $request->get('status')==5)){
            $hrlead = \App\Hrlead::findOrFail($request->get('hrlead_id'));
            $date=date_create($request->get('interviewdate'));
            $format = date_format($date,"Y-m-d H:i:s");
            $hrlead->interviewdate=$format;
            $hrlead->postapplied=$request->get('postapplied');
            $hrlead->status=$request->get('status');
            $hrlead->last_modified_by=auth()->user()->id;
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d H:i:s");
            $hrlead->updated_at = strtotime($format);
            $hrlead->save();
            if(!empty($hrlead->mobile)){
                //Sending SMS to Application/lead begins
                    $smstemplate="";
                    $ufoneid="";
                    $ufonemasking="";
                    $ufonepassword="";
                    $ufoneapiurl="";
                    //Get SMS API preferences begins
                    $preferences= \App\Preference::whereIn('option',['interviewmessage','ufoneid', 'ufonemasking', 'ufonepassword','ufoneapiurl'])->get();
                    foreach($preferences as $preference){
                        if($preference->option=='interviewmessage'){
                            $smstemplate=$preference->value;
                        }
                        if($preference->option=='ufoneid'){
                            $ufoneid=$preference->value;
                        }
                        if($preference->option=='ufonemasking'){
                            $ufonemasking=$preference->value;
                        }
                        if($preference->option=='ufonepassword'){
                            $ufonepassword=$preference->value;
                        }
                        if($preference->option=='ufoneapiurl'){
                            $ufoneapiurl=$preference->value;
                        }
                        
                    }
                    //Get SMS API preferences ends
                    $interviewdate=date('l, M d, Y \a\t h:i A' ,strtotime($request->get('interviewdate')));//Monday, Jan 1, 2019 at 3:00 PM
                    $deptname=$hrlead->postapplied;
                    
                    $find = array("[NAME]", "[POSTAPPLIED]", "[INTERVIEWDATA]");
                    $replace   = array($hrlead->name, $deptname , $interviewdate);
                    $message = str_replace($find, $replace, $smstemplate);
                    
                    $api_call  = "";
                    $api_call .= "?id=".$ufoneid;
                    $api_call .= "&message=".urlencode(trim($message));
                    $api_call .= "&shortcode=".$ufonemasking;
                    $api_call .= "&lang=english";
                    $api_call .= "&password=".$ufonepassword;
                    if (substr($hrlead->mobile, 0, 1) == '0' || substr($hrlead->mobile, 0, 2) == '00') {
                        $mobilenumber=ltrim($hrlead->mobile,0);
                    }else{
                        $mobilenumber=$hrlead->mobile;
                    }
                    $api_call .= "&mobilenum=92".$mobilenumber;               
                    $ch = curl_init($ufoneapiurl.$api_call);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);

                    
                    // from documentation
                    // 0 = Text message successfully sent
                    // 1 = Text message could not sent successfully
                    $xml = new \SimpleXMLElement($response);
                    if ($xml->response_id=="0") {
                        $sendsms=true; 
                    } else {
                        $sendsms=false;
                    }               
                //Sending SMS to Application/lead ends
            }
            //Sending Email to Application/lead begins
            if (!empty($hrlead->email) && filter_var($hrlead->email, FILTER_VALIDATE_EMAIL)) {
                
                $data['subject']="Your Interview has been scheduled.";
                $data['header_subject']="Interview Scheduled";
                $data['email_id']=$hrlead->email;
                $find = array("[NAME]", "[POSTAPPLIED]", "[INTERVIEWDATA]",'\n','Ph #','Address: ');
                $replace   = array("<b>".$hrlead->name."</b>", "<b>".$deptname."</b>" , "<b>".$interviewdate."</b>",'<br>','<b>Contact:</b><br>Ph #','<br><br><b>Address:</b> ');
                $message = str_replace($find, $replace, $smstemplate);
                $data['body']=$message;
                //return view('emails.interview',compact('data'));
                //exit;
                \Mail::send('emails.interview', [
                    'data' => $data,
                    ], function($m) use ($data){

                    $m->from('zebfortunes@gmail.com', 'ZebFourtunes');
                    $m->to($data['email_id']);
                    $m->subject($data['subject']);
                    });
    
            }  
            //Sending Email to Application/lead ends
        }else{
            $hrlead = \App\Hrlead::findOrFail($request->get('hrlead_id'));
            $hrlead->status=$request->get('status');
            $hrlead->last_modified_by=auth()->user()->id;
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d H:i:s");
            $hrlead->updated_at = strtotime($format);
            $hrlead->save(); 
        }
        //Updating HRLead Status ends
        if($sendsms===true){
            return response()->json(['success'=>'Status has been updated successfully with SMS.']);
        }else{
            return response()->json(['success'=>'Status has been updated successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hrlead  $hrlead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-hrleads');
        try{
            $id=$id;
            $hrlead = \App\Hrlead::findOrFail($id);
            $hrlead->delete();
            return response()->json(['success'=>'Lead deleted successfully.']);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['errors'=>'Unable to delete, this lead has linked record(s) in system.']);
        }
    }
}
