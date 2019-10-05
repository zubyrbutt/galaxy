<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UserChecklist;
use App\UserDocument;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userdocument.index');
    }

   

    public function fetch(Request $request){

        $data = UserDocument::where('is_deleted',0)->orderBy('id','desc')->get();
    	
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('d-M-Y');
        })
        ->addColumn('status',function($data){
          if($data->status=='Active') {
            return '<span class="label label-success">Active</span>';
          }else if($data->status=='Disable'){
            return '<span class="label label-danger">Disable</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })

        ->addColumn('options',function($data){
            
            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Delete' class='btn btn-danger delete' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-trash'></i></a>
                                     ";
                               
        })
        ->rawColumns(['created_at', 'status','options'])
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
            'points' => 'required',
            'status' => 'required',
        );

        $data = [
            'points' => trim($request->get('points')),
            'status' => $request->status,
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {
        $user_id = Auth::user()->id;
		
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $data = UserDocument::findOrFail($request->edit_id);
            $data->points = $request->points;
            $data->status     = $request->status;
            $data->save(); 
            $success = 'Document has been updated.';
            return response()->json($success);
            }else{

            $data = New UserDocument;
            $data->points = $request->points;
            $data->status     = $request->status;
            $data->save();
            $success = 'Document has been created.';
            return response()->json($success);
           }
        }
    
    }

    
    public function edit(Request $request)
    {
      $data = UserDocument::findOrFail($request->id);
      return response()->json($data);

    }


    public function paypalActive(Request $request)
    {
      $data = UserDocument::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function paypalDisable(Request $request)
    {
      $data = UserDocument::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

    public function delete(Request $request)
    {
      $data = UserDocument::findOrFail($request->id);
      $data->is_deleted = 1;
      $data->save();
      $message = 'Successfully Delete.';
      return response()->json($message);

    }




    public function adduserchecklists(Request $request){
    	// dd($request->all());
    	$user_id = $request->user_id;
    	$checklists = $request->checklist;

    	foreach ($checklists as $key => $value) {
 			
     			$check = UserChecklist::where('user_id',$user_id)->where('document_id',$key)->count();
     			if($check<=0){

    	 	   		$user_docs = new UserChecklist;

    	    		$user_docs->user_id = $user_id;
    	    		$user_docs->document_id = $key;
    	    		$user_docs->status = $value;

    	    		$user_docs->save();
     			}else{

     				$user_docs = UserChecklist::where('user_id',$user_id)
     											->where('document_id',$key)
     											->update(
     												['user_id' => $user_id,
     												'document_id'=> $key,
     												'status'=>$value]);

     			}

    	}
    }

   
}
