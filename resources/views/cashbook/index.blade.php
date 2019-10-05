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
          <div class="row col-md-12">
              
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

              <div class="form-group col-md-6">
                  <label>Cash IN Hand Accounts</label>
                    <select type="text" name="account_id"   class="form-control select2" style="width: 100%">
                       <option value="">Choose Option</option>
                       @foreach($data['cashInHand'] as $row)
                       <option value="{{$row->id}}">{{$row->account_name}}</option>
                       @endforeach  
                    </select>
              </div>
          </div>
          <button class="btn btn-primary pull-right" type="submit" id="btnfilterdata">Search</button>
          <!-- <a class="btn btn-primary pull-right" style="margin-right:20px;" type="submit" id="btnfilterClear">Clear</a> -->
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
              <h3 class="box-title">Daily Cash Book</h3>
              <span class="pull-right">
               
                
              </span>
            </div>
            <!-- /.box-header -->

             <div class="box-body">
                    
            <div class="row" id="table_data">
              <div class="col-xs-6">
                <h4 style="text-align:center;">IN</h4>
              <table  class="table table-striped table-hover  display table-bordered" style="width:100%">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody id="">
                <tr>
                  <td>12.12.12</td>
                  <td>test</td>
                  <td>200</td>
                </tr>
                
                </tbody>
              </table>
              </div>
              <div class="col-xs-6">
                <h4 style="text-align:center;">OUT</h4>
              <table  class="table table-striped table-hover  display table-bordered" style="width:100%">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody id="">
                  <td>12.12.12</td>
                  <td>test</td>
                  <td>200</td>
                </tbody>
              </table>
              </div>

              <table class="table" style="width:80%">
                <tr>
                  <td  style="text-align:center;">Cash In hand</td>
                  <td  style="text-align:center;">25</td>
                </tr>
                
              </table>
            </div>
              <div  class="ajaxBusy" style="width:500px;margin: 0 auto"><img src="<?php echo asset('img/loading.gif'); ?>" style="width:100px;"></div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->
<style type="text/css">
  .ajaxBusy {
  display: none;
}
</style>
      <!-- /.row -->  
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<script src="{{asset('bower_components\bootstrap-datepicker\js\bootstrap-datepicker.js')}}"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
  var filterdata;



  var InitTable = function() {
        
           $.ajax({
             "url": "{{ route('cashbook.fetch') }}",
             "dataType": "json",
             "type": "POST",
             "data":{ _token: "{{csrf_token()}}",'filterdata':filterdata},
               beforeSend:function(){
                    // show image here
                    $(".ajaxBusy").show();
                },
             "complete": function(xhr, responseText){
                 //myJSON = JSON.stringify(xhr);
                    console.log(xhr);
                    console.log(xhr.responseText);
                    $('#table_data').html(xhr.responseText);
                    $(".ajaxBusy").hide();
                },
              });
    
} 

$( document ).ready(function() {
  
//initialize datatable
InitTable();

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
  console.log(filterdata);
  InitTable();
});

//Date picker
  $('.datepicker').datepicker({
    autoclose: true
  });
 $('.select2').select2({
      multiple: false,
  }); 
</script> 

@endsection