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
<style>
/* Dropdown Button */
.dropbtn {
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fffdfd;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.8);
  z-index: 1;
  width: 120px;
  text-align: center;
}

/* Links inside the dropdown */
.dropdown-content a {
  margin: 5px;
  text-decoration: none;
  text-align: center;

}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

</style>
<div class="row">
        <div class="col-xs-12">
          <div class="box"> 
            <div class="box-header">
              <h3 class="box-title">Attendance Sheet for the Month of {{date('M-Y' , strtotime($srchmonth."-01"))}}</h3>
              <span class="pull-right">
                  <button class="btn btn-danger" id="btnholdSalaries"><li class="fa fa-hand-paper-o"></li> Hold Salaries</button>  
                  <button class="btn btn-success" id="btnunholdSalaries"><li class="fa fa-thumbs-o-up"></li> Unhold Salaries</button>  
                  <button class="btn btn-primary" id="paySalaries"><li class="fa fa-money"></li> Pay Salaries</button>
                  <input class="custom-input" type="month" name="srchmonth" id="srchmonth" autocomplete="off"  min="2019-01" max="{{date('Y-m')}}"  value="{{$srchmonth}}" />
                  <select class="custom-input" id="status" name="status">
                    <option value="">Select Status</option>    
                    <option value="" {{($status=="") ? "selected" : "" }}>All</option>
                    <option value="Paid" {{($status=="Paid") ? "selected" : "" }}>Paid</option>
                    <option value="Unpaid" {{($status=="Unpaid") ? "selected" : "" }}>Unpaid/Partial Paid</option>                    
                    <option value="hold" {{($status=="hold") ? "selected" : "" }}>Hold</option>
                  </select>

                  <select class="select2-multiple2 custom-input" id="srcdepartment_id" name="srcdepartment_id[]" multiple="multiple">
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
            <form role="form" id="frmPaySalaries" method="POST" action="{{route('payroll.createsalary')}}"> 
              @csrf
              <input type="hidden" name="forMonth" value="{{date('M-Y' , strtotime($srchmonth."-01"))}}">
              <input type="hidden" id="holdsalaries" name="holdsalaries" value="0">
              <input type="hidden" id="unholdsalaries" name="unholdsalaries" value="0">
            <div class="box-body">
              <div class="zui-wrapper">
              <div class="zui-scroller table-responsive">
              <table id="table_data" class="zui-table table table-hover">
                <thead>
                <tr>
                  <th class="zui-sticky-col1">@can('pay-salarysheet')<input type="checkbox" id="checkAll">@endcan <br> &nbsp;</th>
                  <th class="zui-sticky-col2">Name &nbsp; </th>
                  <th class="zui-sticky-col2">Department &nbsp; </th>
                  <th class="zui-sticky-col2">Designation &nbsp; </th>
                  <th class="zui-sticky-col2">Shift &nbsp; </th>
                  <th class="zui-sticky-col3">Basic Salary &nbsp; </th>
                  <!--<th>Tardies</th>
                  <th>Short Leaves</th>
                  <th>Absents</th>
                  <th>Paid Leave</th>
                  <th>Unpaid Leave</th>
                  <th>Presents</th>
                  <th>Total Days</th>
                  <th>Deducted Days</th>-->
                  <th>Earned Salary</th>
                  <th>Gross Salary</th>
                  <th>Other Deductions</th>
                  <th>Absent Fine</th>
                  <th>Salary Deduction</th>
                  <th>Total Deduction</th>
                  <th>Additions</th>
                  <th>Per Day</th>
                  <th>Net Salary</th>
                  <th>Amount Paid</th>
                  <th>Remaining Salary</th>
                  <th>Hold Salary</th>
                </tr>
                </thead>
                <tbody>
                  @php ($basicsalarytotal=0)
                  @php ($netsalarytotal=0)
                  @php ($totaldeductions=0)
                  @php ($totaladditions=0)
                  @php ($sumsalarydeduction=0)
                  @php ($sumstotaldeduction=0)
                  @php ($sumabsentfine=0)
                  @php ($earnedsalary=0)
                  @php ($earnedsalarytotal=0)
                  @php ($grosssalarytotal=0)
                  @php ($sumreaminingsalary=0)
                  @php ($sumamountpaid=0)
                  @php ($sumholdsalaries=0)
                  @php ($srno=0)
                  @foreach($salarydata as $emp)
                  <?php
                  //dd($emp->toArray());
                  $srno++;
                  $basicsalary=$emp->basicsalary;
                  $basicsalarytotal+=$basicsalary;
                  if(!empty($emp->otherdeductions)){
                    $totaldeductions+=$emp->otherdeductions;
                  }
                  if(!empty($emp->additions)){
                    $totaladditions+=$emp->additions;
                  }
                  $grosssalary=$emp->grosssalary;
                  $earnedsalarytotal+=$emp->earnedsalary;
                  $sumabsentfine+=$emp->absentfine;
                  $grosssalarytotal+=$grosssalary;
                  $netsalarytotal+=$emp->netsalary;
                  $sumsalarydeduction+=$emp->salarydeductions;
                  $sumstotaldeduction+=$emp->totaldeductions;
                  $sumamountpaid+=$emp->amountpaid;
                  $reaminingsalary=$emp->netsalary-$emp->amountpaid;
                  $sumreaminingsalary+=$reaminingsalary;
                  if($emp->status=='hold'){
                    $sumholdsalaries+=$reaminingsalary;
                    $holdsalary=$reaminingsalary;
                    $trclass="text-red";
                    $reason=$emp->lastsalarystatus->first();
                  }else{
                    $trclass="";
                    $holdsalary=0;
                  }
                  ?>
                   <tr class="{{$trclass}}">
                      <td class="zui-sticky-col1">@can('pay-salarysheet')
                        @if($emp->status!='Paid')
                          <input type="checkbox" name="paysalary[{{$emp->id}}]"  id="paysalary_{{$emp->id}}" class="empcheckbox" value="1">
                        @else
                          <li class="fa fa-check-circle fa-lg text-green" ></li>
                        @endif
                        @endcan
                      </td>
                      <td class="zui-sticky-col2">
                        <div class="dropdown">
                            <a class="dropbtn" href="{!! url('/admins/'.$emp->user_id); !!}" target="_blank" data-toggle="tooltip" title="{{$emp->user->fname}} {{$emp->user->lname}} :: {{$emp->user->department->deptname}}">{{$emp->user->fname}} {{$emp->user->lname}}</a>
                            @if($emp->status=='hold')
                              <li class="fa fa-pause fa-sm text-red" data-toggle="tooltip" title="{{$reason->reason}}"></li> 
                            @endif
                            @if($emp->status!='Paid')                       
                            <div class="dropdown-content">
                              <a href="{!! url('/admins/'.$emp->user_id); !!}" target="_blank" class="btn btn-info btn-xs" title="View Profile"><li class="fa fa-eye" ></li></a>                              
                                @if($emp->status=='hold')
                                  <a href="#" class="btn btn-success btn-xs EmpUnholdSalary" data-id="{{$emp->id}}"  title="Unhold Salary"><li class="fa fa-thumbs-o-up"></li></a>
                                @else
                                  <a href="#" class="btn btn-danger btn-xs EmpHoldSalary" data-id="{{$emp->id}}"  title="Hold Salary"><li class="fa fa-hand-paper-o"></li></a>
                                  <a href="#" class="btn btn-primary btn-xs EmpPaySalary" data-id="{{$emp->id}}" title="Pay Salary"><li class="fa fa-money"></li></a>
                                @endif
                            </div>
                            @endif
                          </div>
                      </td>
                      <td class="zui-sticky-col2">{{$emp->user->department->deptname}} &nbsp; </td>
                      <td class="zui-sticky-col2">{{$emp->user->designation->name}} &nbsp; </td>
                      <td class="zui-sticky-col2">{{ucfirst($emp->user->staffdetails->shift)}} &nbsp; </td>
                      <td class="zui-sticky-col3">{{$basicsalary}}</td>
                      <!--<td>{{$emp->tardies}}</td>
                      <td>{{$emp->shortleaves}}</td>
                      <td>{{$emp->absents}}</td>
                      <td>{{$emp->paidleaves}}</td>
                      <td>{{$emp->unpaidleaves}}</td>
                      <td>{{$emp->presents}}</td>
                      <td>{{$emp->totaldays}}</td>
                      <td>{{$emp->deductedays}}</td>-->
                      <td>{{$emp->earnedsalary}}</td>
                      <td>{{$emp->grosssalary}}</td>
                      <td>{{($emp->otherdeductions) ? $emp->otherdeductions : '0'}}</td>
                      <td>{{($emp->absentfine) ? $emp->absentfine : '0'}}</td>
                      <td>{{($emp->salarydeductions) ? $emp->salarydeductions : '0'}}</td>
                      <td>{{number_format($emp->totaldeductions,2)}}</td>
                      <td>{{($emp->additions) ? $emp->additions: '0'}}</td>
                      <td>{{number_format($emp->perdaysalary,2)}}</td>
                      <td>{{number_format($emp->netsalary,2)}}</td>
                      <td><a href="javascript:void(0)" class="showpayments" data-dated="{{date('M-Y' , strtotime($srchmonth."-01"))}}"  data-id="{{$emp->user_id}}" data-sid="{{$emp->id}}">{{number_format($emp->amountpaid,2)}}</a></td>
                      <td>{{number_format($reaminingsalary,2)}}</td>
                      <td>{{number_format($holdsalary,2)}}</td>
                   </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th class="zui-sticky-col1">&nbsp; <br> &nbsp;</th>
                    <th class="zui-sticky-col2"> &nbsp; </th>
                    <th class="zui-sticky-col2">Department &nbsp; </th>
                    <th class="zui-sticky-col2">Designation&nbsp; </th>
                    <th class="zui-sticky-col2">Shift &nbsp; </th>
                    <th class="zui-sticky-col3">{{number_format($basicsalarytotal,2)}} &nbsp; </th>
                    <th>{{number_format($earnedsalarytotal,2)}}</th>
                    <th>{{number_format($grosssalarytotal,2)}}</th>
                    <th>{{number_format($totaldeductions,2)}}</th>
                    <th>{{number_format($sumabsentfine,2)}}</th>
                    <th>{{number_format($sumsalarydeduction,2)}}</th>
                    <th>{{number_format($sumstotaldeduction,2)}}</th>
                    <th>{{number_format($totaladditions,2)}}</th>
                    <th>-</th>
                    <th>{{number_format($netsalarytotal,2)}}</th>
                    <th>{{number_format($sumamountpaid,2)}}</th>
                    <th>{{number_format($sumreaminingsalary,2)}}</th>
                    <th>{{number_format($sumholdsalaries,2)}}</th>
                    
                  </tr>
                </tfoot>
              </table>

              </div>
              <button class="btn btn-primary pull-right" id="paySalaries" type="submit"><li class="fa fa-money"></li> Pay Salaries</button>
              </div>
            </div>
            <!-- /.box-body -->
          </form> 
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->     

      <iframe id="txtArea1" style="display:none"></iframe>


      <!-- Show and Action Modal Begins -->   
      <div class="modal fade" id="modal-default-show">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body" id="showLeadDetails">
               
              </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <span class="pull-right">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </span>
                  </div>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Show and Action Modal Ends -->  
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

</style>
 <style>


.zui-table td:nth-child(1) {
      background: #f3f3f3;
  }
  .zui-table td:nth-child(2) {
        background: #f3f3f3;
        text-align: left;
  }

  .zui-table td:nth-child(6) {
       background: #f3f3f3;
       text-align: center;
  }
  .zui-table th:nth-child(1) {
      background: #f3f3f3;
  }
  .zui-table th:nth-child(2) {
        background: #f3f3f3;
        text-align: left;
  }

  .zui-table th:nth-child(6) {
       background: #f3f3f3;
       text-align: center;
  }

  .zui-table th, td{
    text-align: center;
  }

  .zui-table td:nth-last-child(1){
    color: red;
  } 

  .zui-table th:nth-last-child(1){
    color: red;
  }

  .zui-table td:nth-last-child(2){
    background: #f3f3f3;
  } 

  .zui-table th:nth-last-child(2){
    background: #f3f3f3;
  }
  
  .zui-table td:nth-last-child(3){
    background: #f3f3f3;
  } 

  .zui-table th:nth-last-child(3){
    background: #f3f3f3;
  }  

  .zui-table td:nth-last-child(6){
    background: #f3f3f3;
  } 

  .zui-table th:nth-last-child(6){
    background: #f3f3f3;
  }  

  .zui-table td:nth-last-child(10){
    background: #f3f3f3;
  } 

  .zui-table th:nth-last-child(10){
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

<script>

$(document).ready(function (e) {
  $('#table_data').wrap("<div id=\"scrooll_div\"></div>");
  $('#scrooll_div').doubleScroll();

  $('[data-toggle="tooltip"]').tooltip();   

  $('#filterDept').click( function() {
    var url;
    var salarystatus=$('#status').val();
    if(salarystatus!=""){
      salarystatus="&status="+salarystatus;
    }
    if($('#srcdepartment_id').val()!="" && $('#srchmonth').val()==""){
      url="{{route('payroll.salarysheet')}}?deparment_id="+$('#srcdepartment_id').val()+salarystatus;
    }else if($('#srchmonth').val()!="" && $('#srcdepartment_id').val()==""){
      url="{{route('payroll.salarysheet')}}?srchmonth="+$('#srchmonth').val()+salarystatus;
    }else if($('#srchmonth').val()!="" && $('#srcdepartment_id').val()!=""){
      url="{{route('payroll.salarysheet')}}?deparment_id="+$('#srcdepartment_id').val()+"&srchmonth="+$('#srchmonth').val()+salarystatus;
    }else{
      url ="{{route('payroll.salarysheet')}}";
    }
    window.location.href =url;
  });

  $('.select2-multiple2').select2MultiCheckboxes({
    templateSelection: function(selected, total) {
      return "Selected " + selected.length + " of " + total;
    },
  });
 
  $('#checkAll').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    checkboxes.prop('checked', $(this).is(':checked'));
  });

  $('.empcheckbox').click(function() {
    if($('#checkAll').prop('checked')){
      $('#checkAll').prop('checked', false);
    }
  });

  $('#paySalaries').click(function() {
    $('#frmPaySalaries').submit();
  });
//Hold Salaries
  $('#btnholdSalaries').click(function() {
    $('#holdsalaries').val(1);
    $('#unholdsalaries').val(0);
    $('#frmPaySalaries').submit();
  });
//Unhold Salaries
  $('#btnunholdSalaries').click(function() {
    $('#holdsalaries').val(0);
    $('#unholdsalaries').val(1);
    $('#frmPaySalaries').submit();
  });


//Individual Employee Begins
//Emp Hold Salaries
  $('.EmpHoldSalary').click(function() {
    var empid=$(this).attr('data-id');
    $('#paysalary_'+empid).prop('checked', true);
    $('#holdsalaries').val(1);
    $('#unholdsalaries').val(0);
    $('#frmPaySalaries').submit();
  });
//Emp unhold Salaries
  $('.EmpUnholdSalary').click(function() {
    var empid=$(this).attr('data-id');
    $('#paysalary_'+empid).prop('checked', true);
    $('#holdsalaries').val(0);
    $('#unholdsalaries').val(1);
    $('#frmPaySalaries').submit();
  });
//Emp Pay Salaries
  $('.EmpPaySalary').click(function() {
    var empid=$(this).attr('data-id');
    $('#paysalary_'+empid).prop('checked', true);
    $('#frmPaySalaries').submit();
  });
//Individual Employee Ends
  

  //Show Partial payments of user begins
$(document).on('click', '.showpayments', function()
    {
      var user_id = $(this).attr('data-id');
      var salarysheet_id = $(this).attr('data-sid');
      var dated = $(this).attr('data-dated');
      $.ajax({
        "url": "{{route('payroll.userpayments')}}",
        type: "POST",
        data: {'user_id': user_id,'salarysheet_id': salarysheet_id ,'forMonth': dated ,_token: '{{csrf_token()}}'},
        
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
          $(".loading").fadeOut();
          $('#modal-default-show').modal('toggle');
          $('#showLeadDetails').html(data);

        },
          error: function(){},          
      });
    });
  //Show Partial payments of user ends


});


//Excel Export begins
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('table_data'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<a[^>]*>|<\/a>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
//Excel Export ends

</script>
@endpush
