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
use App\Department;
use App\InventoryItemSno;
use App\ITStationItem;
use App\ITStation;
use App\User;
use App\Floor;
use App\Room;

class ITStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['inventories'] = Inventory::where('status','Active')->where('category_id','1')->get();
        $data['department'] = Department::where('status','1')->get();
        $data['users']       = User::where('status',1)->get(); 
        $data['floor']       = Floor::where('status','Active')->get(); 
        $data['room']       = Room::where('status','Active')->get(); 

        return view('itstations.index')->with('data',$data);
    }

   

    public function fetch(){

        $data = ITStation::orderBy('id','desc')->get();
        return DataTables::of($data)
      
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('floor_id',function($data){
            return $data->floor->floor_no;
        })
        ->addColumn('room_id',function($data){
            return $data->room->room_no;
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
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                 <a class='btn btn-info'
                                     href='".url('itstation/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a class='btn btn-success edit_diff_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                 <a class='btn btn-info'
                                     href='".url('itstation/show',$data->id)."'><i class='fa fa-eye'></i></a>
                                     "; 
            }                         
        })
        ->rawColumns(['created_at', 'floor_id','room_id','status','options'])
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
        //dd($request->all());
        $rules = array(
            'station_number' => 'required',
            'description' => 'required',
        );

        $data = [
            'station_number' => trim($request->get('station_number')),
            'description' => trim($request->get('description')),
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
            
            $data = ITStation::findOrFail($request->edit_id);
            $data->user_id = $user_id;
            $data->station_number = $request->station_number;
            $data->floor_id = $request->floor_id;
            $data->room_id = $request->room_id;
            $data->description = $request->description;
            $data->save(); 
            $success = 'ITStation has been updated.';
            return response()->json($success);
            }else{

            $data = New ITStation;
            $data->user_id = $user_id;
            $data->station_number = $request->station_number;
            $data->floor_id = $request->floor_id;
            $data->room_id = $request->room_id;
            $data->description = $request->description;
            $data->status     = $request->status;
            $data->save();

            if($data){

               foreach ($request->inventory_id as $key => $value) {
                    $inventory_id = $request['inventory_id'][$key];
                    $inventory_sno_id = $request['inventory_sno_id'][$key];
                    $ITStationItem = new ITStationItem;
                    $ITStationItem->station_id = $data['id'];
                    $ITStationItem->inventory_id = $inventory_id;
                    $ITStationItem->inventory_sno_id = $inventory_sno_id;
                    $ITStationItem->user_id = $user_id;
                    $ITStationItem->status = 'Active';//$request->attribute_value;
                    $ITStationItem->save();
               }
            } 

            $success = 'ITStation has been created.';
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
          $data['itstation'] = ITStation::findOrFail($id);
          $data['inventories'] = Inventory::where('status','Active')->where('category_id','1')->get();
          return view('itstations.show')->with('data',$data);
    }



    public function ITStationInventory(Request $request)
    {

       $data = ITStationItem::where('station_id',$request->id)->orderBy('id','desc')->get();
       return DataTables::of($data)
       ->addColumn('inventory_id',function($data){
            $inventoryRoute = route('inventory.show',$data->inventory_id);
            return "&emsp;<a  href='".$inventoryRoute."'>".$data->inventories->title."</a>";
        })
       ->addColumn('inventory_sno_id',function($data){
            return $data->inventorySNO->serial_no;
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
            return "&emsp;<a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
        ->rawColumns(['inventory_id','inventory_sno_id','created_at','status','options'])
        ->make(true);
    }



   public function InventoryStore(Request $request)
    {
       $rules = array(
        'inventory_id' => 'required',
        'inventory_sno_id' => 'required',
       );

      $data = [
            'inventory_id' => trim($request->get('inventory_id')),
            'inventory_sno_id' => $request->get('inventory_sno_id'),
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
            
        $ITStationItem = ITStationItem::findOrFail($request->edit_id);
        $ITStationItem->station_id = $request->station_id;
        $ITStationItem->inventory_id = $request->inventory_id;
        $ITStationItem->inventory_sno_id = $request->inventory_sno_id;
        $ITStationItem->user_id = $user;
        $ITStationItem->status = 'Active';
        $ITStationItem->save();
        $success = 'Data Saved.';
        $data->save();
        }else{
        $ITStationItem = new ITStationItem;
        $ITStationItem->station_id = $request->station_id;
        $ITStationItem->inventory_id = $request->inventory_id;
        $ITStationItem->inventory_sno_id = $request->inventory_sno_id;
        $ITStationItem->user_id = $user;
        $ITStationItem->status = 'Active';
        $ITStationItem->save();
        $success = 'Data Saved.';
        }
        
        return response()->json($success);
       
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
      $data = ITStation::findOrFail($request->id);
      return response()->json($data);

    }


    public function itemSNOFetchByInventory(Request $request)
    {
      $ITStationItem  = ITStationItem::select('inventory_sno_id')->where('status','Active')->get();
      $data = InventoryItemSno::where('inventory_id',$request->inventory_id)
                                ->whereNotIn('id', $ITStationItem->toArray())->get();
      return response()->json($data);

    }

    public function roomFetchByFloor(Request $request)
    {
      $data = Room::where('floor_id',$request->floor_id)->get();
      return response()->json($data);

    }
  
    public function spEdit(Request $request)
    {
      $data = InventorySpecification::findOrFail($request->id);
      return response()->json($data);

    }


    public function itstationActive(Request $request)
    {
      $data = ITStation::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function itstationDisable(Request $request)
    {
      $data = ITStation::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }
    

    public function InventoryActive(Request $request)
    {
      $inventories = ITStationItem::findOrFail($request->id);
      $inventories->status = 'Active';
      $inventories->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function InventoryDisable(Request $request)
    {
      $inventories = ITStationItem::findOrFail($request->id);
      $inventories->status = 'Disable';
      $inventories->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

  
}
