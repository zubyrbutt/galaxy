<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Leave;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use \App\User;
use \App\Preference;
use \App\Holiday;
use \App\Department;
use Carbon;
use DateTime;
use DatePeriod;
use DateInterval;


class LeaveController extends Controller
{
    
    public function index()
    {
        $employees = User::where('iscustomer', 0)->where('status', 1)->orderBy('fname', 'ASC')->get();
        return view('leaves.index',compact('employees'));
    }

    public function fetch(Request $request)
    {
     
        $columns = array( 
            'id', 
            'dated',
            'description',
            'leavetype',
            'status',
            'ispaid',
            'isgroup',
            'user_id',
            'created_by',
            'modified_by',
            'created_at',
            'updated_at',
            'id',
            
        );

         $totalData = Leave::count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            
                $data = Leave::offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = Leave::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('dated', 'LIKE', '%' . $search . '%')
                              ->orwhere('leavetype', 'LIKE', '%' . $search . '%')
                              ->orwhere('description', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();


            $totalFiltered = Leave::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('dated', 'LIKE', '%' . $search . '%')
                              ->orwhere('leavetype', 'LIKE', '%' . $search . '%')
                              ->orwhere('description', 'LIKE', '%' . $search . '%')
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
                $nestedData['user_id'] = $row->applicant->fname.' '.$row->applicant->lname;
                if($row->ispaid==1)
                {
                    $nestedData['ispaid'] = "Yes";
                }else{
                    $nestedData['ispaid'] = "No";
                }

                $nestedData['leavetype'] = $row->leavetype;
                $nestedData['description'] = $row->description;
                $nestedData['dated'] = $row->dated->format('d-M-Y');
                $nestedData['created_by'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['modified_by'] = $row->modifiedby->fname .' '.$row->modifiedby->lname;
                $nestedData['updated_at'] = $row->updated_at->format('d-M-Y');
                $nestedData['created_at'] = $row->created_at->format('d-M-Y');
                $editdept="";
                $deletedept="";
                $token=csrf_token();
                if($row->status=='Approved') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">Approved</span>';
                }else if($row->status=='Rejected'){
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Rejected</span>';
                  
                }
                if(Auth::user()->can('edit-leave')){
                    $editdept="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('delete-leave')){
                    $deletedept=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('LeaveController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                $nestedData['options'] = $editdept.$deletedept;                             
                
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

   
    public function create()
    {
        exit;
        //
    }
    //Store leave for API begins
    public function storeleaveapi(Request $request){
		//dd($request->all());
		//exit;
        $rules=[
            'empid' => 'required',
            'dated' => 'required',
            'description' => 'required',
            'leavetype' => 'required',
            'ispaid' => 'required',
            'status' => 'required',
        ];
        $errormessage=[
            'empid.required'=>"Employee info is required.",
            'dated.required'=>"Leave date is required.",
            'description.required'=>"Description is required.",
            'leavetype.required'=>"Leave type is required.",
            'ispaid.required'=>"Paid or unpaid status is required.",
            'status.required'=>"Leave status field is required.",
         ];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        $leavetype="";
        $NoOfDays="";
        $paid=0;
        $empid=$request->get('empid');
        $userdata=\App\Staffdetail::where('ccmsid', $empid)->first();
        
                        
        if(!empty($userdata)){
            $user_id=$userdata->user_id;

            if($request->get('leavetype')!=null ){
                switch ($request->get('leavetype')){
                case 'Sick':
                    $leavetype="SL";
                    break;
                case 'Casual':
                    $leavetype="CL";
                    break;
                case 'Other':
                    $leavetype="OL";
                    break;
                }
            }else{
                $leave="SL";
            }
            
            $NoOfDays=$request->get('NoOfDays');
            $paid=$request->get('ispaid');
            //$fromDate=$request->get('fromDate');
            //$toDate=$request->get('toDate');
            if($NoOfDays == 1){
                //Store in Leave Table Begins
                $leave= new \App\Leave;
                $dated=date_create($request->get('fromDate'));
                $dtformat = date_format($dated,"Y-m-d");
                $leave->dated = strtotime($dtformat);
                $leave->description=$request->get('description'); 
                $leave->leavetype=$leavetype;
                $leave->status="Approved";     
                $leave->ispaid=$paid;
                $leave->isgroup=0;        
                $leave->user_id=$user_id;
                $leave->created_by=1;
                $leave->modified_by=1;
                $date=date_create($request->get('dated'));
                $format = date_format($date,"Y-m-d H:i:s");
                $leave->created_at = strtotime($format);
                $leave->updated_at = strtotime($format);
                $leave->save();
                //Store in Leave Table Ends

                //Store in Att Table Begins

                

                //Store in Att Table Ends

            }else{
                //echo $empid."<br>";
                //echo "<hr>".$empleave->fromDate."<br>";
                //echo $empleave->toDate."<br>";
                $begin=new DateTime(date('Y-m-d', strtotime($request->get('fromDate'))));
                $end=new DateTime(date('Y-m-d', strtotime($request->get('toDate'))));      
                $end = $end->modify( '+1 day' );             
                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval ,$end);
                foreach($daterange as $dt){
                    //echo "dated= ".$dt->format('Y-m-d')."<br>";
                    //Store in Leave Table Begins
                    $leave= new \App\Leave;
                    $dated=date_create($dt->format('Y-m-d'));
                    $dtformat = date_format($dated,"Y-m-d");
                    $leave->dated = strtotime($dtformat);
                    $leave->description=$request->get('description'); 
                    $leave->leavetype=$leavetype;
                    $leave->status="Approved";     
                    $leave->ispaid=$paid;
                    $leave->isgroup=0;        
                    $leave->user_id=$user_id;
                    //$leave->user_id=1;
                    $leave->created_by=1;
                    $leave->modified_by=1;
                    $date=date_create($request->get('dated'));
                    $format = date_format($date,"Y-m-d H:i:s");
                    $leave->created_at = strtotime($format);
                    $leave->updated_at = strtotime($format);
                    $leave->save();
                    //Store in Leave Table Ends




                }
                //echo "<hr>";
            }
        }
        return response()->json(['success'=>'Created successfully.']);
        
    }   
    //Store leave for API ends

    public function store(Request $request)
    {
        
        $this->authorize('create-leave');
        $rules=[
            'user_id' => 'required',
            'dated' => 'required',
            'description' => 'required',
            'leavetype' => 'required',
            'ispaid' => 'required',
            'status' => 'required',
        ];
        $errormessage=[
            'user_id.required'=>"Employee is required.",
            'dated.required'=>"Leave date is required.",
            'description.required'=>"Description is required.",
            'leavetype.required'=>"Leave type is required.",
            'ispaid.required'=>"Paid leave status is required.",
            'status.required'=>"Leave status field is required.",
         ];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $leave= new \App\Leave;
        $leave->dated=$request->get('dated');
        $leave->description=$request->get('description'); 
        $leave->leavetype=$request->get('leavetype');
        $leave->status=$request->get('status');     
        $leave->ispaid=$request->get('ispaid');
        $leave->isgroup=0;        
        $leave->user_id=$request->get('user_id');
        $leave->created_by=auth()->user()->id;
        $leave->modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $leave->created_at = strtotime($format);
        $leave->updated_at = strtotime($format);
		$leave->save();

        return response()->json(['success'=>'Created successfully.']);
        
    }
    
    
    public function show(Department $department)
    {
        exit; 
    }

    public function edit(Request $request)
    {
        $this->authorize('edit-leave');
        $data = Leave::findOrFail($request->id);
        return response()->json($data);
    }

  
    public function update(Request $request)
    {
        $this->authorize('edit-leave');
        $leave = \App\Leave::findOrFail($request->get('id'));
        $rules=[
            'user_id' => 'required',
            'dated' => 'required',
            'description' => 'required',
            'leavetype' => 'required',
            'ispaid' => 'required',
            'status' => 'required',
        ];
        $errormessage=[
            'user_id.required'=>"Employee is required.",
            'dated.required'=>"Leave date is required.",
            'description.required'=>"Description is required.",
            'leavetype.required'=>"Leave type is required.",
            'ispaid.required'=>"Paid leave status is required.",
            'status.required'=>"Leave status field is required.",
         ];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
        $leave->dated=$request->get('dated');
        $leave->description=$request->get('description'); 
        $leave->leavetype=$request->get('leavetype');
        $leave->status=$request->get('status');     
        $leave->ispaid=$request->get('ispaid');
        $leave->isgroup=0;        
        $leave->user_id=$request->get('user_id');
        $leave->created_by=auth()->user()->id;
        $leave->modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $leave->created_at = strtotime($format);
        $leave->updated_at = strtotime($format);
		$leave->save();
        return response()->json(['success'=>'Updated successfully.']);
    }
    

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-leave');
        try{
            $id=$id;
            $department = \App\Leave::findOrFail($id);
            $department->delete();
            return response()->json(['success'=>'Deleted successfully.']);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['success'=>'Unable to delete, this leave has linked record(s) in system.']);
        }
    }
}
