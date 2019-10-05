<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Validator;
use App\User;
use App\Role;
use App\Extension;
use App\Studentdetail;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$student_details = \App\User::where('iscustomer',3)->get();
		$parents = \App\User::where('iscustomer',2)->get();
		
		$roles = Role::where('status', 1)->get();
		//$extensions_list_available = \App\Extension::with('showusername')->where('status',2)->get();
		//$extensions_list_all = \App\Extension::with('showusername')->get();

		
		return view('student.index',compact('student_details','roles','extensions_list_available','extensions_list_all','parents'));
    }

	public function fetch(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'fname',
							2 =>'lname',
                            3=> 'email',
							4=> 'parent',
                            5=> 'phonenumber',					
                            6=> 'status',
                            7=> 'id',
                            
                        );

         $totalData = User::where('iscustomer',3)->count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            
                $data = User::offset($start)->limit($limit)
						->where('iscustomer','=','3')
                         ->orderBy($order, $dir)
                         ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = User::where('id', 'LIKE', '%' . $search . '%')
								->where('iscustomer','=','3')
                              ->orwhere('fname', 'LIKE', '%' . $search . '%')
							  ->orwhere('lname', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();


            $totalFiltered = User::where('id', 'LIKE', '%' . $search . '%')
							  ->where('iscustomer','=','3')
                              ->orwhere('fname', 'LIKE', '%' . $search . '%')
							  ->orwhere('lname', 'LIKE', '%' . $search . '%')							  
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
                $nestedData['fullname'] = $row->fname." ".$row->lname;
                $nestedData['email'] = $row->email;
				$nestedData['parent'] = "<b>".$row->parent_name['fname']." ".$row->parent_name['lname']."</b>";
                $nestedData['phonenumber'] = $row->parent_name['phonenumber'];
                $nestedData['status'] = $row->status;
                $statusaction="";
                $editdept="";
                $deletedept="";
				$showdept="";
				
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">Active</span>';
                  if(Auth::user()->can('status-student')){
                    $statusaction="<a class='btn btn-warning status' href='#' data-id='{$id}' data-action='2' title='Change status'><i class='fa fa-times'></i></a>";
                  }
                }else if($row->status=='2'){
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Deactive</span>';
                  if(Auth::user()->can('status-student')){
                    $statusaction="<a class='btn btn-success status' href='#' data-id='{$id}' data-action='1' title='Change status'><i class='fa fa-check'></i></a>";
                  }
                }
                if(Auth::user()->can('show-student')){
                    $showdept="<a class='btn btn-primary showstudent' href='javascript:void(0)' data-id='{$id}' data-status='2' title='Details'><i class='fa fa-eye'></i></a> ";
                }				
                if(Auth::user()->can('edit-student')){
                    $editdept="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}' title='Edit'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('delete-student')){
                    $deletedept=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}' title='Delete'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('StudentController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
				
				if(Auth::user()->can('edit-student')){
                    $resetpasswordstudent="<a class='btn btn-info resetpassword' href='javascript:void(0)' data-id='{$id}' title='Resetpassword'><i class='fa fa-key'></i></a> ";
                }
				
				
				
                $nestedData['options'] = $showdept.$editdept.$statusaction.$deletedept.$resetpasswordstudent;                             
                
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
        //
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
        //
        $this->authorize('create-student');
        $rules=[
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
			'parent_id' => 'required|not_in:0',			
			'gender' => 'required',
			'dob' => 'required',
			
        ];
		$errormessage=['required'=>"All fields required.", 'unique'=>"Username must be unique."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $student= new \App\User;
        $student->fname=$request->get('fname');
        $student->lname=$request->get('lname');
        $student->email=$request->get('email');
        $student->password=Hash::make($request->get('password'));
		$student->parent_id=$request->get('parent_id');		
		//$student->role_id=6;
        $student->iscustomer=3;
		$date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $student->created_at = strtotime($format);
        $student->updated_at = strtotime($format);
		$student->createdby = auth()->user()->id;
        $student->save();
		//Getting last inserted user id to be used in Studentdetail
		$last_student_id = $student->id;
		
        $studentdetail= new \App\Studentdetail;
        $studentdetail->user_id=$last_student_id;
        $studentdetail->gender=$request->get('gender');
		$dob = date_create($request->get('dob'));
        $dob=date_format($dob,"Y-m-d");
		$studentdetail->dob=$dob;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $studentdetail->created_at = strtotime($format);
        $studentdetail->updated_at = strtotime($format);
		$studentdetail->save();		
		
        return response()->json(['success'=>'New Student created successfully.']);		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $this->authorize('show-student');
        /* if(!empty($request->showstatus)){
            $showstatus=$request->showstatus;
        }else{
            $showstatus=0;
        } */
        $student = User::findOrFail($request->id);
		$student_details = \App\User::with('role')->with('createdby_self')->where('iscustomer',3)->where('id',$request->id)->get();
		//Following not working as I have used relation in USER MODEL
		//$student_g_d = \App\Studentdetail::where('user_id',$request->id)->get();
		//dd($student_gen_dob);exit;
        if($request->ajax()) {
            return  view('student.showajax')->with(compact('student','student_details'));
        }				
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
		$this->authorize('edit-student');
        $data = User::with('student_gender_dob')->findOrFail($request->id);
		//dd($data);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		if($request->get('resetpassword')){
            $this->authorize('edit-student');
            //Reset Password
            $user=\App\User::findOrFail($request->get('id')); 
			        $rules=[	
            'password' => 'required|confirmed|min:6'
			];
			$validator = Validator::make($request->all(), $rules);
			if ($validator->fails()) {
				//pass validator errors as errors object for ajax response
				return response()->json(['errors'=>$validator->errors()]);
			}			

            
            $user->password=Hash::make($request->get('password'));
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            $user->save();
            
            return response()->json(['success'=>'Password updated successfully.']);
        }
		
		
		else{
		$this->authorize('edit-student');
        $student = \App\User::findOrFail($request->get('id'));
		//$student = \App\Studentdetail::findOrFail($request->get('id'));
		$student_detail = \App\Studentdetail::where('user_id', '=', $request->get('id'))->first();
        $rules=[	
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
			'parent_id' => 'required|not_in:0',			
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }
		
		//users table update
		$parent_id = $request->get('parent_id');
        $student->fname=$request->get('fname');
        $student->lname=$request->get('lname');
        $student->email=$request->get('email');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $student->updated_at = strtotime($format);
		$student->updatedby = auth()->user()->id;
		$student->parent_id=$request->get('parent_id');
        $student->save();
		//studentdetails table update
        $student_detail->gender=$request->get('gender');
		$dob = date_create($request->get('dob'));
        $dob=date_format($dob,"Y-m-d");
		$student_detail->dob=$dob;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $student_detail->updated_at = strtotime($format);
		$student_detail->save();			
        return response()->json(['success'=>'Student updated successfully.']);	
		}		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete-student');
        try{
            $id=$id;
            $student = \App\User::findOrFail($id);
            $student->delete();
			$student_detail = \App\Studentdetail::where('user_id', '=', $id)->firstOrFail();
            $student_detail->delete();
            return response()->json(['success'=>'Student deleted successfully.']);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['success'=>'Unable to delete, this Student has linked record(s) in system.']);
        }		
    }
	
    //For Deactivate
    public function deactivate(Request $request)
    {
        $this->authorize('status-student');
        $id=$request->get('id');
        $student=\App\User::findOrFail($id);         
        $student->status=2;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $student->updated_at = strtotime($format);
		$student->save();
        return response()->json(['success'=>'Student Deactivated successfully.']);
    }
    //For Active
    public function active(Request $request)
    {
        $this->authorize('status-student');
        $id=$request->get('id');
        $student=\App\User::findOrFail($id);         
        $student->status=1;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $student->updated_at = strtotime($format);
		$student->save();
        return response()->json(['success'=>'Student Activated successfully.']);
    }	
	
}
