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

<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Staff Check List</h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add Document</a>
                
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
                  <th>Point</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Point</th>
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

<!--Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Staff Check List</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('userdocumemt.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Point</label>
                      <input type="text" class="form-control" id="edit_points" name="points" placeholder="Point" autocomplete="off" require >
                      <span class="text-red">
                        <strong class="points"></strong>
                      </span>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select id="edit_status" name="status" require class="form-control">
                      <option value="Active">Active</option>
                      <option value="Disable">Disable</option>
                    </select>
                    <span class="text-red">
                        <strong class="status"></strong>
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
<script src="{{ asset('erp/app_k.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  var filterdata;
  var dataTableRoute = "{{ route('userdocumemt.fetch') }}";
  var editRoute = "{{route('userdocumemt.edit')}}";
  var activeRoute = "{{route('userdocumemt.active')}}";
  var disableRoute = "{{route('userdocumemt.disable')}}";
  var deleteRoute = "{{route('userdocumemt.delete')}}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "points" },
                { "data": "created_at" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {
  InitTable();
});

</script> 

@endsection