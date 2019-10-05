<?php

namespace App\Http\Controllers;

use App\InventoryCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;

class InventoryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = InventoryCategory::where('status','Active')->get();
        return view('inventoryCategories.index')->with('categories',$categories);
    }

   

    public function fetch(){

        $data = InventoryCategory::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Disable') {
            return '<span class="label label-danger">Disable</span>';
          }else if($data->status=='Active'){
            return '<span class="label label-success">Active</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })

        ->addColumn('options',function($data){
            if($data->status=='Active'){
            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
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
            'category_name' => 'required',
        );

        $data = [
            'category_name' => trim($request->get('category_name')),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {
        $user_id = Auth::user()->id;

          /* $data =   InventoryCategory::updateOrCreate(
                      ['id' => $request->edit_id],
                       [
                     'category_name' => $request->category_name,
                     'user_id' => $request->user_id,
                     'status' => $request->status,  
                      ]
                      
                    );
            $success = 'Data Saved!';
            return response()->json($success);
            */
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $data = InventoryCategory::findOrFail($request->edit_id);
            $data->category_name = $request->category_name;
            $data->status     = $request->status;
            $data->save(); 
            $success = 'Category has been updated.';
            return response()->json($success);
            }else{

            $data = New InventoryCategory;
            $data->category_name = $request->category_name;
            $data->user_id     = $user_id;
            $data->status        = 'Active';
            $data->save();
            $success = 'Category has been created.';
            return response()->json($success);
           }
        }
    
    }

    
    public function edit(Request $request)
    {
      $categories = InventoryCategory::findOrFail($request->id);
      return response()->json($categories);

    }


    public function categoryActive(Request $request)
    {
      $data = InventoryCategory::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function categoryDisable(Request $request)
    {
      $data = InventoryCategory::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

   
}
