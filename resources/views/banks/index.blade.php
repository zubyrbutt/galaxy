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

<?php 

function categoryTree($p_id='0',$sub=''){
  $cat_sub = App\BudgetCategory::where('parent_id',$p_id)->orderby('category_name','ASC')->get();
  foreach ($cat_sub as $key) {
  
  echo '<option value="'.$key->id.'">'.$sub.$key->category_name.'</option>';
  categoryTree($key->id,$sub.'---');
  }
}
                       

?>




<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Banks</h3>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Account Number</th>
                  <th>Account Title</th>
                  <th>Bank Name</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Account Number</th>
                  <th>Account Title</th>
                  <th>Bank Name</th>
                  <th>Address</th>
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

<div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Banks Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('bank.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                 <div class="form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" id="edit_account_number" name="account_number" placeholder="Account Number" autocomplete="off" value="{{ old('account_number') }}" require >
                    <span class="text-red">
                              <strong class="account_number"></strong>
                    </span>
                </div>
                <div class="form-group">
                  <label>Account Title</label>
                  
                    <input type="text" class="form-control" id="edit_account_title" name="account_title" placeholder="Account Title" autocomplete="off" value="{{ old('account_title') }}" require >
                    <span class="text-red">
                              <strong class="account_title"></strong>
                    </span>
                </div>
                <div class="form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" id="edit_bank_name" name="bank_name" placeholder="Bank Name" autocomplete="off" value="{{ old('bank_name') }}" require >
                    <span class="text-red">
                              <strong class="bank_name"></strong>
                    </span>
                </div>
                <div class="form-group">
                  <label>Address</label>
                    <input type="text" class="form-control" id="edit_address" name="address" placeholder="Address" autocomplete="off" value="{{ old('address') }}" require >
                    <span class="text-red">
                              <strong class="address"></strong>
                    </span>
                </div>
                <!-- <div class="form-group">
                  <label>Status</label>
                    <select type="text" class="form-control" id="edit_status" name="status" require>
                      <option value="Active">Active</option>
                      <option value="Disable">Disable</option>
                    </select>
                   
                      <span class="text-red">
                              <strong class="status"></strong>
                    </span>
                </div> -->
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
      <!-- /.row -->  
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('erp/app.js')}}" type="text/javascript"></script>

<script type="text/javascript">
var dataTableRoute = "{{ route('bank.fetch') }}";
  var editRoute = "{{route('bank.edit')}}";

  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "account_number" },
                { "data": "account_title" },
                { "data": "bank_name" },
                { "data": "address" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();


});
</script>
@endsection