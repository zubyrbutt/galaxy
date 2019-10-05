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
 


<!-- Advance Filter -->
<div class="row">
        <div class="col-xs-12">

      <form class="form-horizontal filter_form" enctype="multipart/form-data">
          @csrf
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Advance Filter</h3>            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: none;">
            
            
            <div class="row col-md-12">
               
            
                <div class="form-group col-md-6">
                  <label>Status</label>
                  <select name="status" id="filter_status" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                          <option value="Pending">Pending</option>
                          <option value="In Process">In Process</option>
                          <option value="Forwarded">Forwarded</option>
                          <option value="Closed">Closed</option>
                  </select>
                </div>

                <div class="form-group col-md-6 pull-right">
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
            </div>

            
            <!-- Search Form Ends -->
          </div>

          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="filterRecords">Search
                <i class="fa fa-search"></i></button>
              <button type="submit" class="pull-right btn btn-primary" style="margin-right: 20px;" id="filterClear">Clear Filter
              </button>
          </div>
        </div>
        <!-- /.box -->
      </form>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Advance Filter End-->




<!-- Form start -->
{{--
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Complaints</h3>
              
              <!--<span class="pull-right">
                <a href="" class="btn btn-info"><span class="fa fa-plus"></span> Add Trulies</a>
              </span>-->
              
            </div>
            <!-- /.box-header -->
      <div class="box-body">

                    @if($message = Session::get('delete'))
                      <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">
                      </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                     @if($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">
                      </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif

                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div>


        <form class="form-horizontal form" action="{{route('complaint.store')}}" method="post" enctype="multipart/form-data" id="add-form">
            @csrf
          <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
               <div class="form-group">
                  <label for="status" class="col-sm-3 control-label">Department</label>

                  <div class="col-sm-9">
                    <select type="text" class="form-control" id="edit_department_id" name="department_id" require>
                      <option value="">Choose Option</option>
                      @foreach($data['department'] as $row)
                      <option value="{{$row->id}}">{{$row->deptname}}</option>
                      @endforeach
                    </select>
                   
                      <span class="text-red">
                              <strong class="department_id"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="title" class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="edit_title" name="title" placeholder="Title" autocomplete="off" value="{{ old('title') }}" require >
                    <span class="text-red">
                              <strong class="title"></strong>
                    </span>
                    @if ($errors->has('title'))
                          <span class="text-red">
                              <strong>{{ $errors->first('title') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea type="text" class="form-control" id="edit_description" name="description" placeholder="Description" autocomplete="off" value="{{ old('description') }}" require style="height:200px;"></textarea>
                    <span class="text-red">
                              <strong class="description"></strong>
                    </span>
                    @if ($errors->has('description'))
                          <span class="text-red">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
               
              </div>
              </div>
          </div>
                   <input type="hidden" name="edit_id" id="edit_id" value="">

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="add-form-btn">Save</button>
              </div>
              <!-- /.box-footer -->
        </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Form end -->
--}}
<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">My Department Complaints</h3>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Department</th>
                  <th>Title</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                   <th>ID</th>
                  <th>User Name</th>
                  <th>Department</th>
                  <th>Title</th>
                  <th>Created At</th>
                  <th>Status</th>
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
<!-- Table end -->

      <!-- /.row -->  

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
<script src="{{ asset('erp/app.js')}}" type="text/javascript"></script>

<script type="text/javascript">
  var dataTableRoute = "{{ route('departcomplaint.fetch') }}";
  var editRoute = "{{route('complaint.edit')}}";
  var disableRoute = "{{route('complaint.disable')}}";

  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "user_id" },
                { "data": "department_id" },
                { "data": "title" },
                { "data": "created_at" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();
});
</script> 
<script type="text/javascript">

$( document ).ready(function() {


$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.


    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
});


});


$(document).ready(function() { 
  $('.select2').select2({
      placeholder: "Select Staff",
      multiple: false,
  }); 
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

$('.clearfix').on('click', '#filterRecords', function () {
       var status       =    $('#filter_status').val();
       var dateFrom     =    $('#dateFrom').val();
       var dateTo       =    $('#dateTo').val();
    event.preventDefault();  
   $.ajax({
            url: "{{url('getFilterData')}}",
            type: "POST",
            data: {_token:'{{csrf_token()}}','status':status,'dateFrom':dateFrom,'dateTo':dateTo},
            dataType : "json",
            success: function(data){
              InitTable();
    },
    error: function(){},          
    });
});

$('.clearfix').on('click', '#filterClear', function () { 
   event.preventDefault();
       $('.filter_form')[0].reset();
       var status       =    $('#filter_status').val('');
       var dateFrom     =    $('#dateFrom').val('');
       var dateTo       =    $('#dateTo').val(''); 
  InitTable();
});  

</script>
@endsection