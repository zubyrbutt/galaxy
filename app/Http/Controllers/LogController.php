<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\Activitylog as ActLogProp; 
class LogController extends Controller
{
    public function index()
    {
        return view('activitylog.index');
    }


    public function fetch(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'description',
                            2=> 'subject_id',
                            3=> 'subject_type',
                            4=> 'causer_id',
                            5=> 'causer_type',
                            6=> 'properties',
                            6=> 'created_at',
                            
                        );
        if(!empty($request->input('columns.6.search.value'))){
            $daterange=explode(',',$request->input('columns.6.search.value'));
            $from = date($daterange[0]);
            $to = date($daterange[1]);
            
        }else{
            $from = date('Y-m-01');
            $to = date('Y-m-t');
        }

        $from = $from." 00:00:00";
        $to = $to." 23:59:59";
        $totalData = Activity::where('description', 'LIKE', 'updated')
                                ->whereBetween('created_at', [$from, $to])
                                ->whereNotNull('causer_id')
                                ->count();   
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        

            
        if(empty($request->input('search.value')))
        {            
            
                $data = Activity::where('description', 'LIKE', 'updated')
                                ->whereBetween('created_at', [$from, $to])
                                ->whereNotNull('causer_id')
                                ->offset($start)->limit($limit)
                                ->orderBy($order, $dir)
                                ->orderBy('created_at', 'DESC')
                                ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = Activity::where('subject_type', 'LIKE', '%' . $search . '%')
                                ->where('description', 'LIKE', 'updated')
                                ->whereBetween('created_at', [$from, $to])
                                ->whereNotNull('causer_id')
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->orderBy('created_at', 'DESC')
                                ->get();


            $totalFiltered = Activity::where('subject_type', 'LIKE', '%' . $search . '%')
                                        ->where('description', 'LIKE', 'updated')
                                        ->whereBetween('created_at', [$from, $to])
                                        ->whereNotNull('causer_id')
                                        ->count();
           
        }

        //dd($data->toArray());
        $dataArray = array();
        if(!empty($data))
        {
            foreach ($data as $row)
            {
                
                if(!empty($row->properties['attributes']) && !empty($row->properties['old'])) {
                    $changelog=new ActLogProp($row->properties);
                }else{
                    //echo "no";
                    $changelog="NA";
                }
                if($row->causer_id){
                    $causer= $row->causer->fname.' '.$row->causer->lname;
                }else{
                    $causer=$row->causer_id;
                }

                $id = $row->id;               
                $nestedData['id']  = $row->id;
                $nestedData['description'] = $row->description;
                $nestedData['subject_id'] = $row->subject_id;
                $nestedData['subject_type'] = $row->subject_type;
                $nestedData['causer_id'] = $causer;
                $nestedData['properties'] = $changelog;
                $nestedData['created_at'] = $row->created_at->format('d-M-Y');
                $token=csrf_token();
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

}
