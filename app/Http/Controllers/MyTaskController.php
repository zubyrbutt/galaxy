<?php

namespace App\Http\Controllers;
use App\Ycclead;
use DB;
use Auth;
use Validator;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\LeadNotification;
use Notification;
use App\User;
use App\Proposal;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Datatable;
use Yajra\Datatables\Datatables;
use Ddeboer\Imap\Server;
use Illuminate\Support\Facades\Mail;
use Session;
use App\ProjectTask;

class MyTaskController extends Controller
{
     
   
public function index()
{   
    $data['name']            = DB::select("SELECT DISTINCT name FROM yccleads where status !=
                                '9' AND name !='' Group By name");
    $data['contactno']       = DB::select("SELECT DISTINCT contactno FROM yccleads 
                               where status != '9' AND contactno !='' Group By contactno");
    $data['country']         = DB::select("SELECT DISTINCT country FROM yccleads where 
                                status != '9' AND country !='' Group By country");
    $data['subject']         = DB::select("SELECT DISTINCT subject FROM yccleads where 
                               status != '9'  AND subject !='' Group By subject");
    $data['refcode']         = DB::select("SELECT DISTINCT refcode FROM yccleads where
                               status != '9' AND refcode !='' Group By refcode");
    $data['status']          = DB::select("SELECT DISTINCT status FROM yccleads where
                               status != '9' AND status !='' Group By status");
    $data['created_at']      = DB::select("SELECT DISTINCT created_at FROM yccleads
                               where status != '9 'AND created_at !='' Group By created_at");
    $data['emails']          = DB::select("SELECT DISTINCT id,title FROM emails");

    $data['Total_leads']     = Ycclead::all()->count();
    $data['New']             = Ycclead::where('status',0)->count();
    $data['Inprocess']       = Ycclead::where('status',1)->count();
    $data['NotInterested']   = Ycclead::where('status',4)->count();
    $data['Callback']        = Ycclead::where('status',5)->count();
    $data['TrialCommitted']  = Ycclead::where('status',6)->count();
    $data['TrialDelivered']  = Ycclead::where('status',7)->count();

    //dd($data['new']);
    return view('mytask.mytask')->with('data',$data);
}


     
public function fetch(Request $request)
  {
        //echo "string";exit();
        $columns = array( 
                            0 =>'id', 
                            1 =>'title',
                            2=> 'projectName',
                            3=> 'startDate',
                            4=> 'endDate',
                            5=> 'status',
                            6=> 'createdby',
                            7=> 'created_at',
                            8=> 'id',
                           
                            
    
                        );
  
        $id = Auth::user()->id;
        // $role = Sentinel::findRoleBySlug('administrator');
         $totalData = ProjectTask::where('user_id',$id)->count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        //dd($start);
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $value = session()->get('filter');
        //dd($value);

        if(empty($request->input('search.value')))
        {
        
            $ProjectTask = ProjectTask::where('user_id',$id)->offset($start)->limit($limit)
                     ->orderBy('id','desc')
                     ->get();
            
        
        }
        else {
            $search = $request->input('search.value'); 
                
               

        $ProjectTask = ProjectTask::where('user_id',$id)->where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('title', 'LIKE', '%' . $search . '%')
                              ->orwhere('projectName', 'LIKE', '%' . $search . '%')
                              ->orwhere('startDate', 'LIKE', '%' . $search . '%')
                              ->orwhere('endDate', 'LIKE', '%' . $search . '%')
                              ->orwhere('createdby', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->orwhere('created_at', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy('id', 'desc')
                              ->get();


            $totalFiltered = ProjectTask::where('user_id',$id)->where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('title', 'LIKE', '%' . $search . '%')
                              ->orwhere('projectName', 'LIKE', '%' . $search . '%')
                              ->orwhere('startDate', 'LIKE', '%' . $search . '%')
                              ->orwhere('endDate', 'LIKE', '%' . $search . '%')
                              ->orwhere('createdby', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->orwhere('created_at', 'LIKE', '%' . $search . '%')
                              ->count();                  
           
        }
        //dd(count($Ycclead));
        //echo print_r($Ycclead);exit;


        $data = array();
        if(!empty($ProjectTask))
        {
            
            foreach ($ProjectTask as $row)
            {
              // print_r($user->permissions);exit;
                $detail =  url('/tasks/detail',$row->id);
                $edit =  url('/tasks/edit',$row->id);
                 
               
                $id   = $row->id;
                $email   = $row->email;
               
                $nestedData['id']  = $row->id;
                $nestedData['title'] = $row->title;
                $nestedData['projectName'] = $row->projectName;
                $nestedData['startDate'] = $row->startDate->format('m/d/Y');
                $nestedData['endDate'] = $row->endDate->format('m/d/Y');
                
            if($row->status==2)
            {
              $nestedData['status'] = '<span class="label label-success">&nbsp Closed &nbsp</span>';
            }
            elseif($row->status==1)
            {
              $nestedData['status'] = '<span class="label label-warning"> Inprogress </span>';
            }
            elseif($row->status==0)
            {
            $nestedData['status'] = '<span class="label label-danger">&nbsp Open &nbsp</span>';
            }
           
            else
            {
            $nestedData['status'] = '<span class="label label-danger">&nbsp Open &nbsp</span>';
            }

            $nestedData['createdby'] = $row->createdby->lname;
            $nestedData['created_at'] = $row->created_at->format('m/d/Y');

                
                
         
            /*$nestedData['options'] = "<a class='edit-modal' data-id='{$id}'><i class='fa fa-bolt'></i></a> <a href='{$detail}' class='' style='margin-left:5px'><i class='fa fa-eye'></i></a><a class='email-modal' data-id='{$email}' data-toggle='modal' data-target='#mail' style='margin-left:5px'><i class='fa fa-mail-forward'></i></a>";
             */

             
                     /* @if ($task->status === 0)
                        <a href="{!! url('/tasks/edit/'.$task['id'].''); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>      
                      @endif

                    */
                 if ($row->status === 0) {  
                     $nestedData['options'] = "<a href='{$detail}' class='btn btn-primary' title='View Detail'><i class='fa fa-eye'></i> </a><a href='{$edit}'  class='btn btn-success' title='Edit' style='margin-left:5px'><i class='fa fa-edit'></i> </a>";
                   }else{
                    $nestedData['options'] = "<a href='{$detail}' class='btn btn-primary' title='View Detail'><i class='fa fa-eye'></i> </a>";

                   }                  
                $data[] = $nestedData;

            }

            //dd($ycc_id);
        }

          
              
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data
                    );
          return response()->json($json_data);   
    
  }



}



