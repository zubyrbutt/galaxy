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
  <div class="col-md-12">
    <div class="box box-success collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">Advance Filter</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
          
        </div>
      </div>
      <div class="box-body" style="">
       <form id="filterform">
          <div class="row">
             <div class="form-group col-md-6">
                <label>Select Date Range:</label>
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>MM-DD-YYY - MM-DD-YYY</span>
                    <input type="hidden" name="dateFrom" id="dateFrom" value="">
                    <input type="hidden" name="dateTo" id="dateTo" value="">
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Date Range:</label>
                  <select class="form-control" name="status">
                    <option value="none">Select Status</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                  </select>
                </div>
              </div>
          </div>
          <button class="btn btn-primary pull-right" type="submit" id="btnfilterdata">Filter</button>
        </form>
      </div>
      
  </div>
</div>
</div>
<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Paypal Withdrawal</h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add Withdrawal</a>
                
              </span>
            </div>
            <!-- /.box-header -->

             <div class="box-body">
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div> 

              <table id="table_data" class="display" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Withdraw Date</th>
                  <th>Amount</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot style="background-color: lightgrey;">
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      {{-- <th colspan="4"></th> --}}
                        {{-- <th></th> --}}
                    </tr>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->

<!--Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Paypal Withdrawal Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('paypalwithdrwal.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Amount</label>
                      <input type="number" class="form-control" id="edit_amount" name="amount" placeholder="Amount" autocomplete="off" required >
                      <span class="text-red">
                                <strong class="amount"></strong>
                      </span>
                  </div>
                       
                 <div class="form-group">
                    <label>Date</label>
                      <input type="date" class="form-control" id="edit_withdraw_date" name="withdraw_date" placeholder="Date" autocomplete="off" required >
                      <span class="text-red">
                          <strong class="withdraw_date"></strong>
                      </span>
                  </div>
                  <input type="hidden" name="edit_id" id="edit_id" value="">
                        
                </div>
              
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--Update Modal end-->
      <!-- /.row -->  
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<script src="{{asset('bower_components\bootstrap-datepicker\js\bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('erp/app_paypal.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  var filterdata;
  var dataTableRoute = "{{ route('paypalwithdrwal.fetch') }}";
  var editRoute = "{{route('paypalwithdrwal.edit')}}";
  var activeRoute = "{{route('paypalwithdrwal.active')}}";
  var disableRoute = "{{route('paypalwithdrwal.disable')}}";
  var deleteRoute = "{{route('paypalwithdrwal.delete')}}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "withdraw_date" },
                { "data": "amount" },
                { "data": "totalamount" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {
  InitTable();
  //initialize datatable
  $('#daterange-btn').daterangepicker(

    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#dateFrom').val(start.format('YYYY-MM-DD'));
      $('#dateTo').val(end.format('YYYY-MM-DD'));
    }
  );


});

$(document).on('submit','#filterform',function(e){
  e.preventDefault();
  filterdata = $('#filterform').serializeArray();
  // console.log(filterdata);
  InitTable();
});

//Date picker
  $('.datepicker').datepicker({
    autoclose: true
  });

</script> 

@endsection