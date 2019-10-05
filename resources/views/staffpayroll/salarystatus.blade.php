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
<div class="row">
        <div class="col-xs-12">
          <div class="box"> 
            <div class="box-header">
              <h3 class="box-title">{{ucfirst($status)}} Salaries Preview</h3>
              <span class="pull-right">
                  <button class="btn btn-primary" id="StatusSalaries"><li class="fa fa-check"></li> Update</button>
              </span>
            </div>
            <!-- /.box-header -->
            <form role="form" id="frmStatusSalaries" method="POST" action="{{route('payroll.statussalary')}}"> 
              @csrf
              <input type="hidden" name="forMonth" value="{{$forMonth}}">
            <div class="box-body">
              <div class="zui-wrapper">
              <div class="zui-scroller">
              <table id="table_data" class="table table-hover table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Net Salary</th>
                  <th>Paid So Far</th>
                  <th>Remaining Salary</th>
                  <th>Status</th>
                  <th>Reason</th>
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
                  @php ($sumamountpaid=0)
                  @php ($remainingsalary=0)
                  @php ($sumremainingsalary=0)
                  @php ($srno=0)
                  @foreach($salarydata as $emp)
                  <?php
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
                  $grosssalarytotal+=$grosssalary;
                  $netsalarytotal+=$emp->netsalary;
                  $sumamountpaid+=$emp->amountpaid;
                  $remainingsalary=$emp->netsalary-$emp->amountpaid;
                  $sumremainingsalary+=$remainingsalary;
                  $sumsalarydeduction+=$emp->salarydeductions;
                  ?>
                  <input type="hidden" name="salarysheet_id[{{$emp->user_id}}]" value="{{$emp->id}}" >
                   <tr>
                      <td><a href="{!! url('/admins/'.$emp->user_id); !!}" target="_blank" data-toggle="tooltip" title="{{$emp->user->fname}} {{$emp->user->lname}} :: {{$emp->user->department->deptname}}">{{$emp->user->fname}} {{$emp->user->lname}}</a></td>
                      <td>{{$emp->status}}</td>
                      <td>{{number_format($emp->netsalary,2)}}</td>
                      <td>{{number_format($emp->amountpaid,2)}}</td>
                      <td>{{number_format($remainingsalary,2)}}</td>

                      <td>
                        <select class="form-control" name="status[{{$emp->user_id}}]" data-id="{{$emp->user_id}}">
                          <option value="hold" {{($status=="hold") ? "selected" : ""}}>Hold</option>
                          <option value="Unpaid" {{($status=="unhold") ? "selected" : ""}}>Unhold</option>
                        </select>
                      </td>
                      <td>
                          <input name="reason[{{$emp->user_id}}]" id="reason{{$emp->user_id}}" type="text" class="form-control" required>
                      </td>
                   </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total <br>&nbsp; </th>
                    <th>Status<br>&nbsp; </th>
                    <th>{{number_format($netsalarytotal,2)}}</th>
                    <th>{{number_format($sumamountpaid,2)}}</th>
                    <th>{{number_format($sumremainingsalary,2)}}</th>
                    <th>Status</th>
                    <th>Reason</th>
                  </tr>
                </tfoot>
              </table>

              </div>

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

      <div class="loading">
        <div class="loader"></div>
      </div>
@endsection
@push('scripts')
<style>
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
  
  </style>
<script>

$(document).ready(function (e) {
  $('[data-toggle="tooltip"]').tooltip();   


  $(".loading").fadeOut();
  $('#StatusSalaries').click(function() {
    $('#frmStatusSalaries').submit();
  });

  //Status Salary Begins
  $("#frmStatusSalaries").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('payroll.statussalary')}}",
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
                  swal("Failed", data.errors , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $(".loading").fadeOut();
                  setTimeout(function() {
                      swal({
                          title: "Success",
                          text: data.success,
                          type: "success",
                          icon: "success",
                      }).then( function() {
                        location.reload();  
                      });
                  }, 100);
                  
                  //swal("Success", data.success, "success");
                  
                  //location.reload();  
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to process your request this time, Please try again later.", "error");
              }          
       });
    }));
  //Status Salary Ends

});

</script>
@endpush
