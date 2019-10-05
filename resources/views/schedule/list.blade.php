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
              <h3 class="box-title">Manage Schedule</h3>
			  @can('create-schedule')
				<span class="pull-right">
				  <a href="{!! url('/schedule/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>
				</span>
			  @endcan	
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            

              <table id="table_data" class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>id</th>
				  <th>Student</th>
                  <th>Teacher</th>
				  <th>Course</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Class Days</th>
				  <th>Status</th>
				  <th>Pay Date</th>				  
				  <th>Action</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
				  <th>id</th>
				  <th>Student</th>
                  <th>Teacher</th>
				  <th>Course</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Class Days</th>
				  <th>Status</th>
				  <th>Pay Date</th>					  
				  <th>Action</th>
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

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1111; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto; /* 15% from the top and centered */
    padding: 2px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Modal Header */
.modal-header {
    padding: 2px 8px;

}


/* Modal Footer */
.modal-footer {
    padding: 2px 8px;
}


</style>	  

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
 <script src="{{ asset('bower_components/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<script type="text/javascript">



  var InitTable = function() {
   
  $('#table_data').DataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "Paginate": true,
             "ajax":{
             "url": "{{ route('schedule.fetch') }}",
             "dataType": "json",
             "type": "POST",
             "data":{ _token: "{{csrf_token()}}"},
              },  
                  
      "columns": [
                { "data": "id" },
                { "data": "studentname" },
                { "data": "teachername" },
                { "data": "coursename" },
                { "data": "startTime" },
                { "data": "endTime" },
                { "data": "classType" },
				{ "data": "status" },
				{ "data": "paydate" },
				
                { "data": "options",orderable:false,searchable:false},
               
            ]  ,
                   
           
        });

       //jQuery('#table_data .dataTables_td input').addClass(""); // modify table search input
        //jQuery('#trulie_data .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
        //jQuery('#trulie_data .dataTables_length select').select2(); // initialize select2 dropdown
}



$( document ).ready(function() {

  InitTable();
 
});
</script>

@endpush