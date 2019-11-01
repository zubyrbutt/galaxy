<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\User;
use App\Role;
use App\Schedule;
use App\StudentAttendance;

function getUserFullName($id) {
	$data = \DB::table('users')
        ->where('id', $id)
        ->first();

    return $data->fname." ".$data->lname;
}

  function getClassTypeSchedule($_plan){
	  $_classType='';
	  if ($_plan=='1') {
	  
	  $_classType=" classType in ('".$_plan."','3','4','6','7','5')";
  } else if ($_plan=='2') {
	  
	  $_classType=" classType in ('".$_plan."','3','4','10','8','9')";
  
  }else if ($_plan=='3') {
	  
	  $_classType=" classType in ('".$_plan."','1','2','4','5','6','7','8','9')";
  }
  else if ($_plan=='4') {
	  
	  $_classType=" classType in ('".$_plan."','1','2','3','5','6','7','10','8','9')";
  }
  else if ($_plan=='5') {
	  
	  $_classType=" classType in ('".$_plan."','1','3','4')";
  }
  else if ($_plan=='6') {
	  
	  $_classType=" classType in ('".$_plan."','1','3','4')";
  } if ($_plan=='7') {
	  
	  $_classType=" classType in ('".$_plan."','1','3','4')";
  }else if ($_plan=='8') {
	 
	  $_classType=" classType in ('".$_plan."','2','3','4')";
  }else if ($_plan=='9') {
	 
	  $_classType=" classType in ('".$_plan."','2','3','4')";
  }
  else if ($_plan=='10') {
	  
	  $_classType=" classType in ('".$_plan."','2','4')";
  }
    else if ($_plan=='11') {
	  
	  $_classType=" classType in ('".$_plan."')";
  }
  return $_classType;
}
	  
	  
  function getCondition($_plan){
	  $_condition='';
	  
  if ($_plan=='1') {
	  $_condition="mon='1' and tue='1' and wed='1'";
	  
  } else if ($_plan=='2') {
	  $_condition="thu='1' and fri='1' and sat='1'";
	  
  
  }else if ($_plan=='3') {
	  $_condition="mon='1' and tue='1' and wed='1' and thu='1' and fri='1'";
	  
  }
  else if ($_plan=='4') {
	  $_condition="mon='1' and tue='1' and wed='1' and thu='1' and fri='1' and sat='1'";
	  
  }
  else if ($_plan=='5') {
	  $_condition="mon='1'";
	  
  }
  else if ($_plan=='6') {
	  $_condition="tue='1'";
	  
  }else if ($_plan=='7') {
	  $_condition="wed='1'";
	  
  }else if ($_plan=='8') {
	  $_condition="thu='1'";
	  
  }
  else if ($_plan=='9') {
	  $_condition="fri='1'";
	  
  }else if ($_plan=='10') {
	  $_condition="sat='1'";
	  
  }
  else if ($_plan=='11') {
	  $_condition="sun='1'";
	  
  }
  return $_condition;
}	  


  function getPlan($_day){
  
  //global $_return;
  $_keys='';
  $planDays=array('Select Plan','Monday,Tuesday,Wednesday','Thursday,Friday,Saturday','Monday,Tuesday,Wednesday,Thursday,Friday','Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
  foreach($planDays as $_key => $_plan){
  $_array=explode(',',$_plan);
  $_return=in_array($_day,$_array);
  if($_return)
  $_keys.="'".$_key."',";
  }
  $_keys;
  return trim($_keys,",");
  }


  function makeTime($time,$duration){
    $time_ary = array('Select [label] ','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');
	  
	  $key=array_keys($time_ary,$time);
	  if($key[0]+$duration<count($time_ary)){
		  return $time_ary[$key[0]+$duration];
		  }
	  else{
		  return $time_ary[($key[0]+$duration+1)-count($time_ary)];
		  }
	  
	  }

   function systemDate(){
	  
  $todayDate = date("Y-m-d");// current date
  // $currentTime = time($todayDate); //Change date into time
  $currentTime = time(); //Change date into time
  $timeAfterOneHour = $currentTime-8*60*60;

  //return date("Y-m-d H:i:s",$timeAfterOneHour);
  return date("Y-m-d",$timeAfterOneHour);
  
  }

  function systemDateTime(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time(); //Change date into time
  $timeAfterOneHour = $currentTime-8*60*60;

  return date("Y-m-d H:i:s",$timeAfterOneHour);
  //return date("Y-m-d",$timeAfterOneHour);
  
  }
  
  function prepareDate($_date){
  
  $date=date('Y-m-d',strtotime($_date));
  return $date;
  
  }  
  
  function makeSlot($sTime,$eTime){
  //global $_LIST;
  //$data=getSchedule($id);
  
  $slot=getTimeDiff($sTime,$eTime);
  switch($slot)
  {
	  case '00:30:00':
		{ return '1'; break;}
	  case '01:00:00':
		{ return '2'; break;}
	  case '01:30:00':
		{ return '3'; break;}}
		return false;
  }
  
function getTimeDiff($dtime,$atime){
 
 $nextDay=$dtime>$atime?1:0;
 $dep=explode(':',$dtime);
 $arr=explode(':',$atime);
 $diff=abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));
 $hours=floor($diff/(60*60));
 $mins=floor(($diff-($hours*60*60))/(60));
 $secs=floor(($diff-(($hours*60*60)+($mins*60))));
 if(strlen($hours)<2){$hours="0".$hours;}
 if(strlen($mins)<2){$mins="0".$mins;}
 if(strlen($secs)<2){$secs="0".$secs;}
 return $hours.':'.$mins.':'.$secs;
}

  function checkSchedule($request,$edit_id=""){
	  $classType = $request->get('classType');
	  $_classType = getClassTypeSchedule($classType);
	  $edit_sch = \App\Schedule::where('teacherID',$request->get('teacherID'))
	  ->where('startTime',$request->get('startTime'))
	  ->where('std_status','!=',3)->where('std_status','!=',4)->where('std_status','!=',7)
	  ->whereRaw($_classType)
	  ->where('id','!=',$edit_id)
	  ->count()
	  ;
	  if($edit_sch > 0){
		if(!empty($edit_id) && $edit_id!=$edit_sch->id){
			return false;
		}
		else{
			return true;
		}
	  }
	  return !$edit_sch;
  }

  
  function getData($_id,$_index){
  global $_LIST;
  //return $_LIST[$_index][$_id];
  return $_index[$_id];
  }

  function getClassStatus($_id,$_date=""){
  $_row=getSchedule($_id);
  //exit;
  $systemDate = systemDate();
  if(prepareDate($_date)!=$systemDate){ return "0"; }
	$sql = \App\StudentAttendance::where('studentID',$_row[0]->studentID)
	->where('teacherID','=',$_row[0]->teacherID)
	->where('startTime','=',$_row[0]->startTime)
	->where('date','=',$systemDate)
	->count();  

  if($sql<1){
	  return '2';
  }else	{
	$sql = \App\StudentAttendance::where('studentID',$_row[0]->studentID)
	->where('teacherID','=',$_row[0]->teacherID)
	->where('startTime','=',$_row[0]->startTime)
	->where('date','=',$systemDate)
	->get();
			return $sql[0]->status;
		}
  }

 
  function getSchedule($_id){
	$schedules = \App\Schedule::where('id',$_id)->get();  
	//echo $schedules[0]->id;
	return $schedules;
  }  



  function startClass($_id){
  //$_valid=getClassStatus($_id);
  $systemdate = systemDate();
  $_row=getSchedule($_id);
  
  $timenow = time();
  //$newtime = $timenow+32400;
  $newtime = $timenow;
//global $_LIST;
  //$sql = "INSERT INTO `campus_attendance_student` ( `studentID` ,  `teacherID` , `courseID` , `classType` , `std_status` , `startTime` , `classStartTime` , `date` , status , `schedule_id` ) VALUES(  '".$_row['studentID']."' ,  '".$_row['teacherID']."' , '".$_row['courseID']."' , '".$_row['classType']."' , '".$_row['std_status']."' , '".$_row['startTime']."' ,  '".date('H:i:s' , $newtime)."' ,  '".$_LIST['systemdate']."' ,'-1' , '".$_row['id']."' ) "; 
  //mysql_query($sql) or die(mysql_error()); 
  $student_attendance = new \App\StudentAttendance;
  $student_attendance->studentID = $_row[0]->studentID;
  $student_attendance->teacherID = $_row[0]->teacherID;
  $student_attendance->courseID = $_row[0]->courseID;
  $student_attendance->classType = $_row[0]->classType;
  $student_attendance->std_status = $_row[0]->std_status;
  $student_attendance->startTime = $_row[0]->startTime;
  $student_attendance->classStartTime = date('H:i:s' , $newtime);
  $student_attendance->date = $systemdate;
  $student_attendance->status = -1;
  $student_attendance->schedule_id = $_id;
  $student_attendance->save();
  $last_attendance_id = $student_attendance->id;
  //echo $last_attendance_id;exit;
  return $last_attendance_id;
  }

  
  function getClassId($_id,$_date=""){
  $_row=getSchedule($_id);
  $systemdate = systemDate();
  if(prepareDate($_date)!=$systemdate){ return "-1"; }
  	$sql = \App\StudentAttendance::where('studentID',$_row[0]->studentID)
	->where('teacherID','=',$_row[0]->teacherID)
	->where('startTime','=',$_row[0]->startTime)
	->where('date','=',$systemdate)
	->count();
  if($sql<1){
	  return $sql;
  }else{
	$sql = \App\StudentAttendance::where('studentID',$_row[0]->studentID)
	->where('teacherID','=',$_row[0]->teacherID)
	->where('startTime','=',$_row[0]->startTime)
	->where('date','=',$systemdate)
	->get();
	  return $sql[0]->id;
	  
	  }
  }  
///////////////////////////////////////////////////////////////////////////////////////////

//Paypal TranId verfication		//START
function get_transaction_details( $transaction_id ) { 
    $api_request = 'USER=' . urlencode( 'paypal_api1.nsol.sg' )
                .  '&PWD=' . urlencode( '6TL5SKDCSJ9THAT3' )
                .  '&SIGNATURE=' . urlencode( 'AkUjHm9nrRkb7XlPIL5iOi0B5OXoAHVd-3w1lI8F.CwfSKB0QWpuqWlT' )
                .  '&VERSION=76.0'
                .  '&METHOD=GetTransactionDetails'
                .  '&TransactionID=' . $transaction_id;

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

    // Uncomment these to turn off server and peer verification
    // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
    // curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_POST, 1 );

    // Set the API parameters for this transaction
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	

    // Request response from PayPal
    $response = curl_exec( $ch );
    // print_r($response);

    // If no response was received from PayPal there is no point parsing the response
    if( ! $response )
        die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );

    curl_close( $ch );

    // An associative array is more usable than a parameter string
    parse_str( $response, $parsed_response );

    return $parsed_response;
}
//Paypal TranId verfication		//END

///////////////////////////////////////////////////////////////////////////////////////////  