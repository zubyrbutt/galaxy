<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Validator;
use App\User;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('holiday.index');
    }

    public function fetch(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'dated',
                            2=> 'description',
                            4=> 'created_by',
                            5=> 'created_at',
                            6=> 'modified_by',
                            7=> 'updated_at',
                            8=> 'id',
                            
                        );

         $totalData = Holiday::count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            
                $data = Holiday::offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = Holiday::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('deptname', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();


            $totalFiltered = Holiday::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('deptname', 'LIKE', '%' . $search . '%')
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
                $nestedData['created_by'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['dated'] = $row->dated->format('d-M-Y');
                $nestedData['description'] = $row->description;
                $nestedData['isworking'] = ($row->isworking==1) ? "Yes" : "No" ;
                $nestedData['modified_by'] = $row->modifiedby->fname .' '.$row->modifiedby->lname;
                $nestedData['updated_at'] = $row->updated_at->format('d-M-Y');
                $nestedData['created_at'] = $row->created_at->format('d-M-Y');
                $statusaction="";
                $editdept="";
                $deletedept="";
                $token=csrf_token();
                if(Auth::user()->can('status-holiday')){
                    $statusaction="<a class='btn btn-danger status' href='#' data-id='{$id}' data-action='0'><i class='fa fa-times'></i></a>";
                }
                
                if(Auth::user()->can('edit-holiday')){
                    $editdept="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('delete-holiday')){
                    $deletedept=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('HolidayController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                $nestedData['options'] = $editdept.$statusaction.$deletedept;                             
                
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->authorize('create-holiday');
        $rules=[
            'dated' => 'required|unique:holidays',
            'description' => 'required',
        ];
        $errormessage=['dated.required'=>"Holiday date is required.", 'dated.unique'=>"Holiday date must be unquie."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $holiday= new \App\Holiday;
        $holiday->dated=$request->get('dated');
        $holiday->description=$request->get('description');
        $holiday->isworking=$request->get('isworking');
        $holiday->created_by=auth()->user()->id;
        $holiday->modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $holiday->created_at = strtotime($format);
        $holiday->updated_at = strtotime($format);
		$holiday->save();

        return response()->json(['success'=>'Holiday created successfully.']);
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Holiday
     */
    public function show(Holiday $holiday)
    {
        exit; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->authorize('edit-holiday');
        $data = Holiday::findOrFail($request->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('edit-holiday');
        $holiday = \App\Holiday::findOrFail($request->get('id'));
        $rules=[
            'dated' => 'required|unique:holidays,dated,'.$holiday->id,
            'description' => 'required',
        ];
        $errormessage=['dated.required'=>"Holiday date is required.", 'dated.unique'=>"Holiday date must be unquie."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            
            return response()->json(['errors'=>$validator->errors()]);
        }
        $holiday->dated=$request->get('dated');
        $holiday->description=$request->get('description');
        $holiday->isworking=$request->get('isworking');
        $holiday->modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $holiday->updated_at = strtotime($format);
		$holiday->save();
        return response()->json(['success'=>'Holiday updated successfully.']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-holiday');
        try{
            $holiday = \App\Holiday::findOrFail($id);
            $holiday->delete();
            return response()->json(['success'=>'Holiday deleted successfully.']);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['success'=>'Unable to delete, this Holiday has linked record(s) in system.']);
        }
    }
}
