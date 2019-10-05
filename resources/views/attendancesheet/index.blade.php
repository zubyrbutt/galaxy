@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif
<?php

?>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Attendance Sheet for the Month of {{date('M-Y' , strtotime($srchmonth."-01"))}}</h3>
              <span class="pull-right">
                  <button class="btn btn-primary addatt">Mark Attendance</button>
                  <!-- @can('locksalarysheet')<a href="{{ route('locksalarysheet')}}?dated={{$srchmonth."-01"}}" class="btn btn-danger"><li class="fa fa-lock"></li> Lock Salary Sheet </a>@endcan -->
                  <input class="custom-input" type="month" name="srchmonth" id="srchmonth" autocomplete="off"  min="2019-01" max="{{date('Y-m')}}"  value="{{$srchmonth}}" />
                  <select class="select2-multiple2" id="srcdepartment_id" name="srcdepartment_id[]" multiple="multiple">
                    <option value="">Show All Deparments</option>    
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}" {{(in_array($department->id,$deparment_id)) ? "selected": "" }}>{{$department->deptname}}</option>    
                    @endforeach
                  </select>
                  <button class="btn btn-success" id="filterDept"><li class="fa fa-search"></li></button>
                  <button class="btn btn-primary" id="btnExport" onclick="fnExcelReport();"><li class="fa fa-file-excel-o fa-lg"></li></button>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              @foreach($employees_list as $index => $list)
              @if($index == 0)
              <h3>PKR</h3>
              @elseif($index == 1)
              <h3>USD</h3>
              @endif
              <div class="zui-wrapper">
              <div class="zui-scroller">

              <table id="table_data_{{ $index }}" class="zui-table table  table-hover" style="width:100%">
                <thead>
                <tr>
                  <th class="zui-sticky-col1">Sr. No. <br> &nbsp;</th>
                  <th class="zui-sticky-col2">Name <br>&nbsp; </th>                
                  <th class="zui-sticky-col3">Basic Salary <br>&nbsp; </th>
                
                  <th class="zui-sticky-col5">Designation <br>&nbsp; </th>
                  <th class="zui-sticky-col6">Shift <br> &nbsp; </th>
                  @foreach($daterange as $date)
                  <th class="{{($date->format('D')=='Sun') ? 'bg-green' : '' }}">{{$date->format('d')}} <br> <small>{{$date->format('D')}}</small></th>
                  @endforeach
                  <th>Tardies</th>
                  <th>Short Leaves</th>
                  <th>Absents</th>
                  <th>Paid Leave</th>
                  <th>Unpaid Leave</th>
                  <th>Presents</th>
                  <th>Total Days</th>
                  <th>Deducted Days</th>
                  <!-- <th>Earned Salary</th> -->
                  <th>Gross Salary</th>
                  <th>Other Deductions</th>
                  <!-- <th>Absent Fine</th> -->
                  <th>Salary Deducted</th>
                  <th>Total Deduction</th>
                  <th>Additions</th>
                  <th>Per Day</th>
                  <th>Worked Hours</th>
                  <th>Salary Type</th>
                  <th>Currency</th>
  
                  <th>Net Salary</th>
                  @if($index == 1)
                  <th>Net Salary in PKR</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                  @php ($basicsalarytotal=0)
                  @php ($netsalarytotal=0)
                  @php ($totaldeductions=0)
                  @php ($totaladditions=0)
                  @php ($sumsalarydeduction=0)
                  @php ($earnedsalary=0)
                  @php ($earnedsalarytotal=0)
                  @php ($grosssalarytotal=0)
                  @php ($sumabsentfine=0)
                  @php ($sumsalarydeducteddays=0)
                  @php ($srno=0)


                  @foreach($list as $emp)
                  <?php
                  $joiningmonth=$emp->staffdetails->joiningdate->format('Y-m-d');
                  $thismonth=date('Y-m-t' , strtotime($srchmonth."-01"));
                  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $joiningmonth);
                  $from = \Carbon\Carbon::createFromFormat('Y-m-d', $thismonth);                  
                  ?>
                  @if($to->lessThan($from))
                  <?php
                  $srno++;
                  $basicsalary=($emp->staffdetails->salary) ? $emp->staffdetails->salary : '0.00';

                  $salary_type=  ($emp->staffdetails->salary_type) ? $emp->staffdetails->salary_type : 'fixed';
                  $currency_type=($emp->staffdetails->currency_type) ? $emp->staffdetails->currency_type : 'usd';

                  $basicsalarytotal+=$basicsalary;
                  if(!empty($emp->deductions_count)){
                    //$totaldeductions=$totaldeductions + $emp->deductions_count;
                  }
                  if(!empty($emp->additions_count)){
                    $totaladditions+=$emp->additions_count;
                  }
                  $grosssalary=$emp->salary+$basicsalary;
                  $earnedsalarytotal+=$emp->salary;
                  $grosssalarytotal+=$emp->salary+$basicsalary;
                  ?>
                   <tr>
                      <td class="zui-sticky-col1"><a href="{!! url('/admins/'.$emp->id); !!}" target="_blank">{{$srno}}</a></td>
                      <td class="zui-sticky-col2"><a href="{!! url('/admins/'.$emp->id); !!}" target="_blank" data-toggle="tooltip" title="{{$emp->fname}} {{$emp->lname}} :: {{$emp->department->deptname}} ">{{$emp->fname}} {{$emp->lname}}</a></td>
                      <td class="zui-sticky-col3">{{$basicsalary}}</td>
                      <td class="zui-sticky-col5">{{$emp->designation->name}} &nbsp; </td>
                      <td class="zui-sticky-col6">{{ucfirst($emp->staffdetails->shift)}} &nbsp; </td>
                      <?php                      
                        $tardis=0;
                        $shortleave=0;
                        $absents=0;
                        $leaves=0;
                        $upleaves=0;
                        $presents=0;
                        $unpaiddays=0;
                        $totaldays=0;
                        $deducteddays=0;
                        $salarydeduction=0;
                        $deductiontotal=0;
                        $absentfine=0;
                        $deductions_count=0;
                        $workedhours=0;
                        $salary=0;
                       
                      ?>
                      @foreach($emp->att as $att)
                      <?php
                          if($att['dayname']=='Sun'){
                              $class="bg-green";
                          }elseif($att['status']=='H'){
                              $class="bg-green";
                          }elseif($att['status']=='X'){
                              $class="bg-red";
                          }else{
                              $class="";
                          }
                          $tardis+=$att['tardies'];
                          $workedhours+=$att['workedhours'];
                          $shortleave+=$att['shortleaves'];
                          if($att['status']=='X'){
                            if(strtotime($att->dated) < strtotime(date("Y-m-d")) ){
                              $absents++;
                              $absentfine+=$settings['absentfine'];
                            }
                          }elseif($att['status']=='P' or $att['status']=='H'){
                            $presents++;
                          }elseif($att['status']=='-'){
                            $unpaiddays++;
                          }elseif($att['status']=='UL'){
                            $upleaves++;
                          }else{
                            $leaves++;
                          }
                          
                          if(( $att['remarks']=='Late Arrival and Early Left' || $att['remarks']=='Short Leave' || $att['remarks']=='Late Arrival' || $att['remarks']=='Early Left') && $att['status']=="P" ){
                            if(strtotime($att->dated) < strtotime(date("Y-m-d")) ){
                              $statusClass="text-yellow";
                            }else{
                              $statusClass="";
                            }
                          }elseif($att['status']=="P" && $att['dayname']!='Sun'){
                            $statusClass="text-green";
                          }else{
                            $statusClass="";
                          }

                          $totaldays++; 
                      ?>
                      <td class="{{$class}}"> <span class="{{$statusClass}}"  data-toggle="tooltip" title="{{$att['dayno']}} - {{$att['remarks']}}  ({{$att['checkin']}}-{{$att['checkout']}})">{{$att['status']}}</span></td>
                      @endforeach
                      <?php
                        //Salary Calculation beings
                        //Deduction plus fine
                        $deductions_count =($emp->deductions_count) ? $emp->deductions_count : 0;
                        //$deductions_count+= $absentfine;
                        //Tardy conversion to deducted days
                        $deducteddays+=intdiv($tardis,$settings['tardydaydeduct']);
                        //Short leaves conversion to deducted days
                        $deducteddays+=intdiv($shortleave,$settings['shortleavedaydeduct']);
                        //Absents + Unpaid Leave + Unpaid days
                        $deducteddays+=$absents+$upleaves+$unpaiddays;
                        //Per day salary
                        $perdaysalary=$grosssalary/$settings['daysinmonth'];                        
                        //Unpaid days salary
                        $salarydeduction=$perdaysalary * $deducteddays;
                        if($salarydeduction > $grosssalary){
                          $salarydeduction=$grosssalary;
                        }
                        $sumsalarydeducteddays+=$salarydeduction;
                        //Total deductions
                        $deductiontotal=$salarydeduction + $emp->deductions_count + $absentfine;
                        //$totaldeductions+=$emp->deductions_count + $absentfine;
                        $totaldeductions+=$emp->deductions_count;
                        //Net salary
                        $netsalary=$grosssalary - $deductiontotal  + $emp->additions_count;
                        if($netsalary < 0){
                          $netsalary=0;
                        }
                        //Sum Absent Fine
                        $sumabsentfine+=$absentfine;
                        //Salary Calculation ends
                        $netsalarytotal+=$netsalary;
                        $sumsalarydeduction+=$deductiontotal;

                      ?>
                      <td>{{$tardis}}</td>
                      <td>{{$shortleave}}</td>
                      <td>{{$absents}}</td>
                      <td>{{$leaves}}</td>
                      <td>{{$upleaves}}</td>
                      <td>{{$presents}}</td>
                      <td>{{$totaldays}}</td>
                      <td>{{$deducteddays}}</td>
                      <!-- <td>{{$emp->salary}}</td>-->
                      <td>{{$emp->salary+$basicsalary}}</td>
                      <td>{{($deductions_count) ? $deductions_count : '0'}}</td>
                      <!--<td>{{$absentfine}}</td>-->
                      <td>{{number_format($salarydeduction,2)}}</td>
                      <td>{{number_format($deductiontotal,2)}}</td>
                      <td>{{($emp->additions_count) ? $emp->additions_count: '0'}}</td>
                      <td>{{number_format($perdaysalary,2)}}</td>
                      <td>{{ ucfirst($salary_type) }}</td>
                      <td>{{ ucfirst($salary_type) }}</td>
                      <td>{{ $workedhours }}</td>
                      <td>
                        @if($salary_type == 'hourly')
                        @php ($salary = number_format($netsalary,2) * $workedhours)
                       
                        @else
                        @php ($salary = number_format($netsalary,2) )
                        
                        @endif
                        {{ $salary }}
                      </td>
                      
                      @if($index == 1)
                      <td>{{ number_format($salary * $settings['usdtopkr'], 2) }}</td>
                      @endif
                   </tr>
                   @endif
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th class="zui-sticky-col1">&nbsp; <br> &nbsp;</th>
                    <th class="zui-sticky-col2">Total <br>&nbsp; </th>
                    <th class="zui-sticky-col3">{{number_format($basicsalarytotal,2)}} <br>&nbsp; </th>
                  
                    <th class="zui-sticky-col5">Designation <br>&nbsp; </th>
                    <th class="zui-sticky-col6">Shift <br> &nbsp; </th>
                    @foreach($daterange as $date)
                    <th class="{{($date->format('D')=='Sun') ? 'bg-green' : '' }}">{{$date->format('d')}} <br> <small>{{$date->format('D')}}</small></th>
                    @endforeach
                    <th colspan="8">Total</th>
                    <!-- <th>{{number_format($earnedsalarytotal,2)}}</th> -->
                    <th>{{number_format($grosssalarytotal,2)}}</th>
                    <th>{{number_format($totaldeductions,2)}}</th>
                   <!-- <th>{{number_format($sumabsentfine,2)}}</th> -->
                    <th>{{number_format($sumsalarydeducteddays,2)}}</th>
                    <th>{{number_format($sumsalarydeduction,2)}}</th>
                    <th>{{number_format($totaladditions,2)}}</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>

                    <th>{{number_format($netsalarytotal,2)}}</th>
                    @if($index == 1)
                    <th>-</th>
                    @endif
                  </tr>
                </tfoot>
              </table>
              </div>
              </div>
              @endforeach

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->        
      
      <div class="loading">
        <div class="loader"></div>
      </div>



 <!-- Add Modal Begins -->   
 <div class="modal fade" id="modal-default-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Attendance</h4>
        </div>
        
        
        <div class="modal-body">
          <form role="form" action="{{route('attendancesheet.update')}}" method="POST" id="frmEdit">
            @csrf
             <div class="box-body">
                <div class="form-group">
                    <label for="dated">Select Employee</label>
                    <select class="form-control" name="user_id" id="user_id">
                        <option value="">Select Employee</option>
                        
                        @foreach($employees_list as $list)
                          @foreach($list as $emp)
                              <option value="{{$emp->id}}">{{$emp->fname}} {{$emp->lname}}</option>
                          @endforeach
                        @endforeach
                    </select>
                </div>
              <div class="form-group">
                <label for="dated">Date</label>
                <input type="date" class="form-control" id="dated" name="dated"  autocomplete="off">
              </div>
              <div class="form-group">
                <label for="checkin">Check In</label>
                <input type="text" class="form-control" id="checkin" name="checkin" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="checkout">Check Out</label>
                <input type="text" class="form-control" id="checkout" name="checkout" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="checkoutfound">Check Out Marked</label>
                <select class="form-control" id="checkoutfound" name="checkoutfound">
                  <option value="Yes" selected>Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="shortleaves">Short Leave</label>
                <input type="number" class="form-control" id="shortleaves" name="shortleaves" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="tardies">Tardy</label>
                <input type="number" class="form-control" id="tardies" name="tardies" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="workedhours">Worked Hours</label>
                <input type="number" class="form-control" id="workedhours" name="workedhours" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <input type="text" class="form-control" id="remarks" name="remarks" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="status">Select Status</label>
                <select class="form-control" id="status" name="status">
                  <option value="P" selected>Present</option>
                  <option value="SL">Sick Leave</option>
                  <option value="CL">Causal Leave</option>
                  <option value="UL">Unpaid Leave</option>
                  <option value="X">Absent</option>
                  <option value="-">Not Applicable</option>
                  
                </select>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
            </div>
          </form>
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- Add Modal Ends -->  


@endsection
@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

<style>
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 24px;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 8px;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.loading{
    display: hidden;
    position: fixed;
    left: 0;
    top: 0;
    padding-top: 45vh;
    padding-left:100vh;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: gray;
    opacity: 0.8;
}
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


.zui-table {
    border: none;
}
.zui-table tbody td {
    white-space: nowrap;
}
.zui-wrapper {
    position: relative;
}
.zui-scroller {
    margin-left: 341px;
    /*overflow-x: scroll;*/
    overflow-y: visible;
    padding-bottom: 5px;
    width: 78%;
}
.zui-table .zui-sticky-col1 {
    left: 0;
    position: absolute;
    top: auto;
    width: 80px;
}

.zui-table .zui-sticky-col2 {
    left: 80px;
    position: absolute;
    top: auto;
    width: 160px;
}

.zui-table .zui-sticky-col3 {
    left: 240px;
    position: absolute;
    top: auto;
    width: 100px;
}

  table td:nth-child(1) {
      background: #f3f3f3;
  }
  table td:nth-child(2) {
        background: #f3f3f3;
        text-align: left;
  }

  table td:nth-child(3) {
       background: #f3f3f3;
       text-align: center;
  }
  table th:nth-child(1) {
      background: #f3f3f3;
  }
  table th:nth-child(2) {
        background: #f3f3f3;
        text-align: left;
  }

  table th:nth-child(3) {
       background: #f3f3f3;
       text-align: center;
  }

  table th, td{
    text-align: center;
  }

  table td:nth-last-child(1){
    background: #f3f3f3;
  } 

  table th:nth-last-child(1){
    background: #f3f3f3;
  }
  

  table td:nth-last-child(3){
    background: #f3f3f3;
  } 

  table th:nth-last-child(3){
    background: #f3f3f3;
  }

  table td:nth-last-child(4){
    background: #f3f3f3;
  } 

  table th:nth-last-child(4){
    background: #f3f3f3;
  } 

  table td:nth-last-child(8){
    background: #f3f3f3;
  } 

  table th:nth-last-child(8){
    background: #f3f3f3;
  } 

  .custom-input{
    height: 28px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .select2-results__option .wrap:before{
    font-family:fontAwesome;
    color:#999;
    content:"\f096";
    width:25px;
    height:25px;
    padding-right: 10px;
    
  }
  .select2-results__option[aria-selected=true] .wrap:before{
      content:"\f14a";
  }
  /* not required css */
  .row
  {
    padding: 10px;
  }
  .select2-multiple2
  {
    width: 50%;
  }

</style>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="{{asset('js/jquery.doubleScroll.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<script type="text/javascript" src="https://rawgit.com/wasikuss/select2-multi-checkboxes/master/select2.multi-checkboxes.js"></script>

<script type="text/javascript" src="{{asset('js/FileSaver.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tableExport.js')}}"></script>


<script>

$(document).ready(function (e) {
   // $('#user_id').select2();
  //InitTable();
  @foreach($employees_list as $index => $list)
  $('#table_data_{{$index}}').wrap("<div id=\"scrooll_div_{{$index}}\"></div>");
  @endforeach
  
   @foreach($employees_list as $index => $list)
    $('#scrooll_div_{{$index}}').doubleScroll();
  @endforeach


  $('[data-toggle="tooltip"]').tooltip();   

  $('#filterDept').click( function() {
    var url;
    if($('#srcdepartment_id').val()!="" && $('#srchmonth').val()==""){
      url="{{route('attendancesheet')}}?deparment_id="+$('#srcdepartment_id').val();
    }else if($('#srchmonth').val()!="" && $('#srcdepartment_id').val()==""){
      url="{{route('attendancesheet')}}?srchmonth="+$('#srchmonth').val();
    }else if($('#srchmonth').val()!="" && $('#srcdepartment_id').val()!=""){
      url="{{route('attendancesheet')}}?deparment_id="+$('#srcdepartment_id').val()+"&srchmonth="+$('#srchmonth').val();
    }else{
      url ="{{route('attendancesheet')}}";
    }
    window.location.href =url;
  });

  $('.select2-multiple2').select2MultiCheckboxes({
    templateSelection: function(selected, total) {
      return "Selected " + selected.length + " of " + total;
    },
  });
  $(".loading").fadeOut();
  
  
  //Add Attendance Form Begins
    $(document).on('click', '.addatt', function()
    {
        $(".loading").fadeOut();
        $('#modal-default-add').modal('toggle');
        
    });
  //Add Attendance Form Ends
  
  
  //Add Attendance Submit Begins
  $("#frmEdit").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('attendancesheet.store')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  swal("Failed", "Unable to update, " + data.errors.dated , "error");
                }
                else
                {
                  $('#modal-default-add').modal('toggle');
                  $("#frmEdit")[0].reset(); 
                  swal("Success", data.success, "success");
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to updated, Please try again later.", "error");
              }          
       });
    }));
    //Add Attendance Submit Ends

});



//Excel Export begins
function fnExcelReport()
{
  $(".loading").fadeIn();
  $("table").tableExport({type:'excel'});
  $(".loading").fadeOut();
}
//Excel Export ends

</script>
@endpush
