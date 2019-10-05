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
use Carbon\Carbon;

class TodayMassageTaskController extends Controller
{
     
  protected $posts_per_page = 100;

  public function index(Request $request)
  { 

  if (isset($request->dateFrom) && $request->dateFrom!='') {
    //dd($request->all());
      $messages = \App\Projectmessage::with('assets')->whereDate('created_at', '>=', $request->dateFrom)->whereDate('created_at', '<=', $request->dateTo)->orderBy('projectmessages.id', 'DESC')->paginate($this->posts_per_page);
    //dd($messages);
    $tasks = ProjectTask::whereDate('created_at', '>=', $request->dateFrom)->whereDate('created_at', '<=', $request->dateTo)->get();


    if($request->ajax()) {

      //dd($messages);
            return [
                'messages' => view('projects.ajaxmessages')->with(compact('messages','tasks'))->render(),
                'next_page' => $messages->nextPageUrl()
            ];
        }
    //dd($data);
      return view('mytask.todayMassageTask', compact('tasks','messages'));

    }
    else
    {  
    
    $messages = \App\Projectmessage::with('assets')->whereDate('created_at', Carbon::today())->orderBy('user_id', 'DESC')->paginate($this->posts_per_page);
    $tasks = ProjectTask::whereDate('created_at', Carbon::today())->get();
    if($request->ajax()) {
            return [
                'messages' => view('projects.ajaxmessages')->with(compact('messages','tasks'))->render(),
                'next_page' => $messages->nextPageUrl()
            ];
        }
      return view('mytask.todayMassageTask', compact('tasks','messages'));
    }

  }


  //protected $posts_per_page = 500;
  public function fetch(Request $request)
  {
      //
    //$data['projectDetail'] = \App\Project::with('customer')->with('createdby')->with('lead')->where('id',$id)->first(); 
    $messages = \App\Projectmessage::with('assets')->whereDate('created_at', Carbon::today())->orderBy('user_id', 'DESC')->paginate($this->posts_per_page);
     //dd($messages[1]->message);
     $messagesArray = [];
    foreach ($messages as  $value) {
        //dd($value->message);
        $assetsArray = [];
        foreach ($value->assets as $asset) {
          
            $assetsArray[] = [
                             'attachment' =>$asset->attachment,
                             'orginalfilename' => $asset->orginalfilename
                           ];
        }

       $messagesArray[] = [

                           'date'=>$value->created_at->format('d-M-Y'),
                           'time'=>$value->created_at->format('H:i'),
                           'fname'=>$value->user->fname,
                           'fname'=>$value->user->fname,
                           'lname'=>$value->user->lname,
                           'message'=>$value->message,
                           'asset'=>$assetsArray
                        ];
      
    }

    $data['messages'] = $messagesArray;
    //dd($data['messages']);
      //Ajax Load more request
     /* if($request->ajax()) {
          return [
              'messages' => view('projects.ajaxmessages')->with(compact('messages','projectDetail'))->render(),
              'next_page' => $messages->nextPageUrl()
          ];
      }
     */
      return response()->json($data);
    // return view('mytask.todayMassageTask', compact('data'));
  }
 
     
/*public function fetch(Request $request)
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
*/


}



