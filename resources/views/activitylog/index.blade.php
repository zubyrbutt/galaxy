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
              <h3 class="box-title">Activity Logs</h3>
              <span class="pull-right">          
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>{{date('F 1, Y')}} - {{date('F t, Y')}}</span>
                    <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-1')}}">
                    <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-t')}}">
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
                <script> 
                    $(document).ready(function() { 
                    //Date range as a button
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
                            startDate: moment().startOf('month'),
                            endDate  : moment().endOf('month')
                          },
                          function (start, end) {
                            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                            $('#dateFrom').val(start.format('YYYY-MM-DD'));
                            $('#dateTo').val(end.format('YYYY-MM-DD'));
                            var maintabledate = $('#table_data').DataTable();
                            maintabledate.column('6').search(
                            $('#dateFrom').val()+','+$('#dateTo').val()
                            ).draw();
                          }
                    );
    
                    });
                </script>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Description</th>
                  <th>Record Id</th>
                  <th>Section</th>
                  <th>Performed By</th>
                  <th>Details</th>
                  <th>On</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Description</th>
                  <th>Record Id</th>
                  <th>Section</th>
                  <th>Performed By</th>
                  <th>Details</th>
                  <th>On</th>
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

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
//Fetch Data Begins
  function InitTable() {
    $(".loading").fadeIn();
        $('#table_data').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[1, 'desc']],
        "pageLength": 25,
        "ajax":{
                  "url": "{{ route('activitylogs.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "description" },
            { "data": "subject_id" },
            { "data": "subject_type" },
            { "data": "causer_id" },
            { "data": "properties" },
            { "data": "created_at" },
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
  $(".loading").fadeOut();
});
  

</script>
@endpush