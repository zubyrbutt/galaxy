<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Calendar;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('dashboard');
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        
        /* Sales, Project, Calendar and Lead Stats Begins */
        $leads = \App\Lead::with('user')->with('createdby')->orderBy('id', 'DESC')->limit(5)->get();
        $appointments = \App\Appointment::with('lead')->with('createdby')->orderBy('id', 'DESC')->limit(5)->get();
        $recentappointments = \App\Appointment::with('lead')->with('createdby')->whereBetween('appointtime', array(date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')))->orderBy('appointtime', 'ASC')->limit(5)->get(); 
        $recordings = \App\Recording::with('lead')->with('createdby')->orderBy('id', 'DESC')->limit(5)->get();
        $proposals = \App\Proposal::with('lead')->with('createdby')->whereNull('docfile')->orderBy('id', 'DESC')->limit(10)->get();
        $myappointments = auth()->user()->appointments()->withPivot('user_id')->orderby('id','DESC')->get(); 
        //Get Counts
        $statistics_count=array();
        //Project Counts
        $statistics_count['projects']=\App\Project::count();
        $statistics_count['leads']=\App\Lead::count();
        $statistics_count['recordings']=\App\Recording::count();
        $statistics_count['appointments']=\App\Appointment::count();

        $date1 = date('Y-m-d', strtotime('-10 days'));
        $date2 = date('Y-m-d');
        $period = new DatePeriod(new DateTime($date1), new DateInterval('P1D'), new DateTime($date2));
        foreach ($period as $date) {
            $dates[] = $date->format("Y-m-d");
        }
        //For Leads
        foreach($dates as $date){
            $leadcount = DB::table('leads')
             ->select('created_at',DB::raw("DATE_FORMAT(created_at, '%d-%b') as createdat"), DB::raw('count(*) as leads'))           
             ->whereDate('created_at',$date)
             ->groupBy('created_at')
             ->first();            
            if(!empty($leadcount)){
                    $linecharts['createdat'][]=$leadcount->createdat;
                    $linecharts['leads'][]=$leadcount->leads;
               
            }else {
                $date = strtotime($date);
                $dated=date('d-M', $date);
                $linecharts['createdat'][]=$dated;
                $linecharts['leads'][]=0;
            }
        }
        
        $chartcreatedat=json_encode($linecharts['createdat']);
        $chartleads=json_encode($linecharts['leads']);
        //For Appointments
        foreach($dates as $date){
            $appointmentcount = DB::table('appointments')
             ->select('created_at',DB::raw("DATE_FORMAT(created_at, '%d-%b') as createdat"), DB::raw('count(*) as appointments'))           
             ->whereDate('created_at',$date)
             ->groupBy('created_at')
             ->first();            
            if(!empty($appointmentcount)){
                    $appointmentcharts['createdat'][]=$appointmentcount->createdat;
                    $appointmentcharts['appointments'][]=$appointmentcount->appointments;
               
            }else {
                $date = strtotime($date);
                $dated=date('d-M', $date);
                $appointmentcharts['createdat'][]=$dated;
                $appointmentcharts['appointments'][]=0;
            }
        }
        
        $chartcreatedat=json_encode($linecharts['createdat']);
        $chartleads=json_encode($linecharts['leads']);

        $appointmentchartcreatedat=json_encode($appointmentcharts['createdat']);
        $chartleadsappointments=json_encode($appointmentcharts['appointments']);
        $calendar=[];
        if(auth()->user()->can('show-dashboard-calendar')){
            //Appointment Calendar Begins
            $events = [];
            //$apppointmentdata = \App\Appointment::with('lead')->with('createdby')->whereDate('appointtime', '>', Carbon::now())->get(); 
            $apppointmentdata = \App\Appointment::with('lead')->with('createdby')->whereDate('appointtime', '>', Carbon::now())->get(); 
            //dd($apppointmentdata->toArray());
            if($apppointmentdata->count()) {
                foreach ($apppointmentdata as $key => $value) {
                    $events[] = Calendar::event(
                        $value->note,
                        false,
                        new \DateTime($value->appointtime),
                        new \DateTime($value->appointtime.' +2 hours'),
                        $value->id,
                        // Add color and link on event
                        [
                            'color' => '#f05050',
                            'url' => url('/leads/'.$value->lead->id ),
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($events);
            //Appointment Calendar Ends
        }
        /* Sales, Project, Calendar and Lead Stats ends */
        /* HR Stats Begins */
            $hrstats=array();
            $hrstats['activestaff']= 0;
            $hrstats['joined']=0;
            $hrstats['left']=0;
            $hrstats['requests']=0;
            $hrstats['totalrequests']=0;
            $hrstats['completedrequest']=0;
            $hrstats['inprocessdrequest']=0;
            $hrstats['pendingrequest']=0;
            if(auth()->user()->can('stats-hr')){
                $currentMonth = date('m');
                $currentYear = date('Y');
                $hrstats['activestaff']= \App\User::where('iscustomer', 0)->where('status', 1)->count();
                $joined =  DB::table("staffdetails")
                            ->whereRaw('MONTH(joiningdate) = ? and YEAR(joiningdate) = ?',[$currentMonth, $currentYear])
                            ->count();
                $hrstats['joined']=$joined;

                $left =  DB::table("staffdetails")
                            ->whereRaw('MONTH(endingdate) = ? and YEAR(endingdate) = ?',[$currentMonth, $currentYear])
                            ->count();

                $hrstats['left']=$left;

                $hrstats['totalrequests']=DB::table("staff_requireds")
                                            ->whereRaw('MONTH(created_at) = ? and YEAR(created_at) = ? AND is_deleted=0',[$currentMonth, $currentYear])
                                            ->count();
                $reqstatus=['Completed', 'Fullfilled'];
                $hrstats['completedrequest']=DB::table("staff_requireds")
                                            ->whereRaw('MONTH(created_at) = ? and YEAR(created_at) = ? AND status in (?,?) AND is_deleted=0',[$currentMonth, $currentYear, $reqstatus])
                                            ->count();
                $hrstats['inprocessdrequest']=DB::table("staff_requireds")
                                            ->whereRaw('MONTH(created_at) = ? and YEAR(created_at) = ? AND status = ? AND is_deleted=0',[$currentMonth, $currentYear,'In Progress'])
                                            ->count();
                $hrstats['pendingrequest']=DB::table("staff_requireds")
                                            ->whereRaw('MONTH(created_at) = ? and YEAR(created_at) = ? AND status = ? AND is_deleted=0',[$currentMonth, $currentYear,'Pending'])
                                            ->count();



            }
        /* HR Stats Ends */
        
     
        return view('dashboard',compact('leads','appointments','recentappointments','myappointments','recordings','proposals','statistics_count','chartcreatedat','chartleads','appointmentchartcreatedat','chartleadsappointments','calendar','hrstats'));
        
    }
}
