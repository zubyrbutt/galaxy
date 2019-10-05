<?php

namespace App\Http\Controllers;

use App\InventoryCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use App\Inventory;
use App\InventorySpecification;
use App\InventoryItemSno;
use App\InventoryQuantity;
use App\User;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::where('status','Active')->get();
        $categories = InventoryCategory::where('status','Active')->get();
        return view('inventories.index')->with('inventories',$inventories)
                                        ->with('categories',$categories);
    }

   

    public function fetch(){

        $data = Inventory::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('category_id',function($data){
            return $data->inventoryCategory->category_name;
        })
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
            return "&emsp;<a class='btn btn-success edit_diff_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a class='btn btn-info'
                                     href='".url('inventory/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a class='btn btn-success edit_diff_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a class='btn btn-info'
                                     href='".url('inventory/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
        ->rawColumns(['category_id','created_at', 'status','options'])
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
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required',
        );

        $data = [
            'title' => trim($request->get('title')),
            'category_id' => trim($request->get('category_id')),
            'price' => trim($request->get('price')),
            'description' => trim($request->get('description')),
            'status' => trim($request->get('status')),
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
            
            $data = Inventory::findOrFail($request->edit_id);
            $data->title = $request->title;
            $data->user_id = $user_id;
            $data->category_id = $request->category_id;
            $data->price = $request->price;
            $data->description = $request->description;
            $data->status     = $request->status;
            $data->save(); 
            $success = 'Inventory has been updated.';
            return response()->json($success);
            }else{
            $quantity = $request->quantity;
            $data = New Inventory;
            $data->user_id = $user_id;
            $data->title = $request->title;
            $data->category_id = $request->category_id;
            $data->price = $request->price;
            $data->description = $request->description;
            $data->consumable = $request->consumable;
            $data->quantity = $quantity;
            $data->status     = $request->status;
            $data->save();

            if($data){

               foreach ($request->attribute_name as $key => $value) {
                    $attribute_name = $request['attribute_name'][$key];
                    $attribute_value = $request['attribute_value'][$key];
                    $specification = new InventorySpecification;
                    $specification->inventory_id = $data['id'];
                    $specification->attribute_name = $attribute_name;
                    $specification->attribute_value = $attribute_value;
                    $specification->user_id = $user_id;
                    $specification->status = 'Active';
                    $specification->save();
               }
                    for ($i=0; $i <= $quantity ; $i++) { 
                       $serial_no = $data['title'].strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4)); 
                        $itemSno = new InventoryItemSno;
                        $itemSno->inventory_id = $data['id'];
                        $itemSno->serial_no = $serial_no;
                        $itemSno->user_id = $user_id;
                        $itemSno->status = 'Active';
                        $itemSno->save();

                     } 
                    
                $quantity = new InventoryQuantity;
                $quantity->inventory_id = $data['id'];
                $quantity->quantity_type = 'Quantity IN';
                $quantity->quantity = $data['quantity'];
                $quantity->created_by = $user_id;
                $quantity->status = 'Active';
                $quantity->save();
            } 
            $success = 'Inventory has been created.';
            return response()->json($success);
           }
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['inventories'] = Inventory::findOrFail($id);
        $data['users']       = User::where('status',1)->get(); 
        return view('inventories.show')->with('data',$data);
    }



    public function specificationFetch(Request $request)
    {

       $data = InventorySpecification::where('inventory_id',$request->id)->orderBy('id','desc')->get();
       return DataTables::of($data)
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
            return "&emsp;<a class='btn btn-success edit'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     ";
        })
        ->rawColumns(['status','options'])
        ->make(true);
    }

    public function InventorySNOFetch(Request $request)
    {

       $data = InventoryItemSno::where('inventory_id',$request->id)->orderBy('id','desc')->get();
       return DataTables::of($data)
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
            return "&emsp;<a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
        ->rawColumns(['status','options'])
        ->make(true);
    }

   public function InventoryQtyFetch(Request $request)
    {

       $data = InventoryQuantity::where('inventory_id',$request->id)->orderBy('id','desc')->get();
       return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
       ->addColumn('user_id',function($data){
            return $data->issuseFor->fname.' '.$data->issuseFor->lname;
        })
        ->addColumn('created_by',function($data){
            return $data->createdby->fname.' '.$data->createdby->lname;
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
        ->rawColumns(['user_id','created_by','status','created_at'])
        ->make(true);
    }
   public function spStore(Request $request)
    {
       $rules = array(
        'attribute_name' => 'required',
        'attribute_value' => 'required',
       );

      $data = [
            'attribute_name' => trim($request->get('attribute_name')),
            'attribute_value' => $request->get('attribute_value'),
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
            
        $data = InventorySpecification::findOrFail($request->edit_id);
        $data->user_id = $user;
        $data->inventory_id = $request->inventory_id;
        $data->attribute_name     = $request->attribute_name;
        $data->attribute_value     = $request->attribute_value;
        $data->status        = $request->status;
        $success = 'Specification has been updated.';
        $data->save();
        }else{
        $data = New InventorySpecification;
        $data->user_id = $user;
        $data->inventory_id = $request->inventory_id;
        $data->attribute_name     = $request->attribute_name;
        $data->attribute_value     = $request->attribute_value;
        $data->status        = $request->status;
        $data->save();
        $success = 'Specification has been created.';
        }
        
        return response()->json($success);
       
    }
    
    }

    

    public function issuseStore(Request $request)
    {

       $rules = array(
        'user_id' => 'required',
        'quantity' => 'required',
        'description' => 'required',
       );

      $data = [
            'user_id' => trim($request->get('user_id')),
            'quantity' => trim($request->get('quantity')),
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
          
        $data = InventoryQuantity::findOrFail($request->edit_id);
        $data->user_id = $request->user_id;
        $data->inventory_id = $request->inventory_id;
        $data->quantity_type     = 'Quantity Out';
        $data->quantity     = $request->quantity;
        $data->description     = $request->description;
        $data->created_by = $user_id;
        $data->status        = 'Active';
        $data->save();
        $response['success'] = 'Successfully Issuse.';
        
        }else{
        $data = New InventoryQuantity;
        $data->user_id = $request->user_id;
        $data->inventory_id = $request->inventory_id;
        $data->quantity_type     = 'Quantity Out';
        $data->quantity     = $request->quantity;
        $data->description     = $request->description;
        $data->created_by = $user;
        $data->status        = 'Active';
        $data->save();
        $response['success'] = 'Successfully Issuse.';
        }
        if($data){
            $inventory = Inventory::findOrFail($request->inventory_id);
            if($inventory->consumable=='Yes'){
             $quantity =  $inventory->quantity - $data['quantity'];
             $inventory->quantity = $quantity;
             $inventory->save();
            }
        }
         $response['quantity'] =   $inventory['quantity'];    

        return response()->json($response);
       
    }
    
    }

    public function plusStore(Request $request)
    {

       $rules = array(
        'quantity' => 'required',
        'description' => 'required',
       );

      $data = [
            'quantity' => trim($request->get('quantity')),
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
          
        $data = InventoryQuantity::findOrFail($request->edit_id);
        $data->inventory_id = $request->inventory_id;
        $data->quantity_type     = 'Quantity IN';
        $data->quantity     = $request->quantity;
        $data->description     = $request->description;
        $data->created_by = $user_id;
        $data->status        = 'Active';
        $data->save();
        $response['success'] = 'Successfully Issuse.';
        
        }else{
        $data = New InventoryQuantity;
        $data->inventory_id = $request->inventory_id;
        $data->quantity_type     = 'Quantity IN';
        $data->quantity     = $request->quantity;
        $data->description     = $request->description;
        $data->created_by = $user;
        $data->status        = 'Active';
        $data->save();
        $response['success'] = 'Successfully Issuse.';
        }
        if($data){
             $inventory = Inventory::findOrFail($request->inventory_id);
             $quantity =  $inventory->quantity + $data['quantity'];
             $inventory->quantity = $quantity;
             $inventory->save();
        }
         $response['quantity'] =   $inventory['quantity'];    

        return response()->json($response);
       
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
      $inventories = Inventory::findOrFail($request->id);
      return response()->json($inventories);

    }


    public function spEdit(Request $request)
    {
      $data = InventorySpecification::findOrFail($request->id);
      return response()->json($data);

    }

    public function inventoryActive(Request $request)
    {
      $data = Inventory::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function inventoryDisable(Request $request)
    {
      $data = Inventory::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

    public function inventorySNOActive(Request $request)
    {
      $data = InventoryItemSno::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function inventorySNODisable(Request $request)
    {
      $data = InventoryItemSno::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

    public function inventoryReport()
    {
        return view('inventories.report');
    }


    public function InventoryReportfetch(){

        $value = session()->get('filter'); 
         if($value['dateTo']!=""|| $value['dateFrom']!="") {
          
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

         $data =  DB::table('rpt_inventory')->where('quantity_type','Quantity Out')->where(function ($query) use ($dateFrom, $dateTo) {
                   
                    if (!empty($dateFrom)) {
                        $query->whereBetween('created_at', [$dateFrom, $dateTo]);
                    }
                })
               
                ->get();
         $value = session()->forget('filter'); 
  
        }else
        {
            $data = DB::table('rpt_inventory')->where('quantity_type','Quantity Out')->get();
        } 
        
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at;
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
        

        ->rawColumns(['created_at','status'])
        ->make(true);
    }

   
}
