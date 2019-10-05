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
              <h3 class="box-title">Pay Salaries Preview</h3>
              <span class="pull-right">
                  <button class="btn btn-primary" id="paySalaries"><li class="fa fa-money"></li> Confirm</button>
              </span>
            </div>
            <!-- /.box-header -->
            <form role="form" id="frmPaySalaries" method="POST" action="{{route('payroll.paysalary')}}"> 
              @csrf
              <input type="hidden" name="forMonth" value="{{$forMonth}}">
            <div class="box-body">
              <div class="zui-wrapper">
              <div class="zui-scroller">
              <table id="table_data" class="table table-hover table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <!--<th>Basic Salary </th>
                  <th>Gross Salary</th>
                  <th>Other Deductions</th>
                  <th>Additions</th>
                  <th>Salary Deduction</th>-->
                  <th>Status</th>
                  <th>Net Salary</th>
                  <th>Paid So Far</th>
                  <th>Remaining Salary</th>
                  <th>Amount Pay</th>
                  <th>Payment Method</th>
                  <th>Cheque No.</th>
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
                      <!-- <td>{{$basicsalary}}</td>
                      <td>{{$emp->grosssalary}}</td>
                      <td>{{($emp->otherdeductions) ? $emp->otherdeductions : '-'}}</td>
                      <td>{{($emp->additions) ? $emp->additions : '-'}}</td>
                      <td>{{number_format($emp->salarydeductions,2)}}</td>-->
                      <td>{{$emp->status}}</td>
                      <td>{{number_format($emp->netsalary,2)}}</td>
                      <td>{{number_format($emp->amountpaid,2)}}</td>
                      <td>{{number_format($remainingsalary,2)}}</td>
                      <td>
                        <input name="amountpay[{{$emp->user_id}}]" type="number" class="form-control" value="{{$remainingsalary}}" {{($emp->status=='Paid') ? 'readonly' :''}}>
                        <input name="remaining[{{$emp->user_id}}]" type="hidden" class="form-control" value="{{$remainingsalary}}" >
                      </td>
                      <td>
                        <select class="form-control PaymentMethod" name="paymentmethod[{{$emp->user_id}}]" data-id="{{$emp->user_id}}" {{($emp->status=='Paid') ? 'readonly' :''}}>
                          <option value="cash">Cash</option>
                          <option value="opencheque">Open Cheque</option>
                          <option value="crosscheque">Cross Cheque</option>
                        </select>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-6">
                            <select class="form-control" name="bankid[{{$emp->user_id}}]" id="bankid{{$emp->user_id}}" disabled>
                              <option value="">Select Bank</option>
                              @foreach($banks as $bank)
                              <option value="{{$bank->id}}">{{$bank->bank_name}}-{{$bank->account_title}}-{{$bank->account_number}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input name="chequeno[{{$emp->user_id}}]" id="chequeno{{$emp->user_id}}" type="number" class="form-control" disabled >
                          </div>
                        </div>
                      </td>
                   </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total <br>&nbsp; </th>
                    <!--<th>{{number_format($basicsalarytotal,2)}} <br>&nbsp; </th>
                    <th>{{number_format($grosssalarytotal,2)}}</th>
                    <th>{{number_format($totaldeductions,2)}}</th>
                    <th>{{number_format($totaladditions,2)}}</th>
                    <th>{{number_format($sumsalarydeduction,2)}}</th>-->
                    <th>{{number_format($netsalarytotal,2)}}</th>
                    <th>{{number_format($sumamountpaid,2)}}</th>
                    <th>{{number_format($sumremainingsalary,2)}}</th>
                    <th>Amount Pay</th>
                    <th>Payment Method</th>
                    <th>Cheque No.</th>
                  </tr>
                </tfoot>
              </table>

              </div>
              <button class="btn btn-primary pull-right" id="paySalaries" type="submit"><li class="fa fa-money"></li> Confirm</button>
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

  $(".PaymentMethod").on('change',(function() {
    
    var id=$(this).data("id");
    var val=$(this).val();
    if(val!=='cash'){
      $("#chequeno"+id).prop("disabled", false); 
		  $("#chequeno"+id).prop("required", true);
      $("#bankid"+id).prop("disabled", false);
      $("#bankid"+id).prop("required", true);
    }else{
      $("#chequeno"+id).prop("disabled", true); 
		  $("#chequeno"+id).prop("required", false);
      $("#bankid"+id).prop("disabled", true);
      $("#bankid"+id).prop("required", false);
    }
    

  }));
  $(".loading").fadeOut();
  $('#paySalaries').click(function() {
    $('#frmPaySalaries').submit();
  });

  //Pay Salary Begins
  $("#frmPaySalaries").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('payroll.paysalary')}}",
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
                  //$("#frmPaySalaries")[0].reset(); 
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
  //Pay Salary Ends

  

});

</script>
@endpush
