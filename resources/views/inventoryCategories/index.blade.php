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
              <h3 class="box-title">Inventory Categories</h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add Inventory</a>
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div> 

              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
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
          <h4 class="modal-title">Inventory Category Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('inventoryCategory.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Category Name</label>
                      <input type="text" class="form-control" id="edit_category_name" name="category_name" placeholder="Category Name" autocomplete="off" value="{{ old('category_name') }}" require >
                      <span class="text-red">
                                <strong class="category_name"></strong>
                      </span>
                      @if ($errors->has('category_name'))
                            <span class="text-red">
                                <strong>{{ $errors->first('category_name') }}</strong>
                            </span>
                        @endif
                  </div>
                       
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="edit_status" class="form-control" required="required">
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
<script src="{{ asset('erp/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  var dataTableRoute = "{{ route('inventoryCategory.fetch') }}";
  var editRoute = "{{route('inventoryCategory.edit')}}";
  var activeRoute = "{{route('inventoryCategory.active')}}";
  var disableRoute = "{{route('inventoryCategory.disable')}}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "category_name" },
                { "data": "created_at" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();
});
</script> 

@endsection