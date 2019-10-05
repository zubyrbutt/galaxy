@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });

    </script>
@endif
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"> Details</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body" >


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
            <div class="row">
              <div class="col-md-8">
              <table class="table table-striped table-bordered responsive nowrap">
                <tr>
                    <td><b>ID</b></td>
                    <td>{{$data['inventories']->id}}</td>
                </tr>
                <tr>
                    <td><b>Item Name</b></td>
                    <td>{{$data['inventories']->title}}</td>
                </tr>
                <tr>
                    <td><b>Category Name</b></td>
                    <td>{{$data['inventories']->inventoryCategory->category_name}}</td>
                </tr>
                <tr>
                    <td><b>Quantity</b></td>
                    <td id="total_quantity">{{$data['inventories']->quantity}}</td>
                </tr>
                <tr>
                    <td><b>Price</b></td>
                    <td>{{$data['inventories']->price}}</td>
                </tr>

                <tr>
                    <td><b>Description</b></td>
                    <td>{{$data['inventories']->description}}</td>
                </tr>
                 
                <tr>
                    <td><b>Created At</b></td>
                    <td>{{$data['inventories']->created_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td>{{$data['inventories']->updated_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        
                          <span class="text-green"><b>{{$data['inventories']->status}}</b></span>
                        
<!--                             <span class="text-red"><b>Deactive</b></span>
 -->                       
                    </td>
                </tr>

              </table>


              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalSNO">All {{$data['inventories']->title}} SNO</button>
              </div>
              <!-- /.box-footer -->

</div>

<!-- Table specification start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Specification</h3>
              
              <span class="pull-right">
                <a href="#" class="btn btn-info btnAdd"><span class="fa fa-plus"></span> Add </a>
              </span>
              
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap table_data" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Value</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
               
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table specification end -->
<!-- Table Quantity History start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Quantity History</h3>
              
              <span class="pull-right">
                <button  class="btn btn-success btnQuantityAdd"><span class="fa fa-plus"></span> Add QTY</button>
                <a  class="btn btn-info btnQuantityRemove"><span class="fa fa-minus"></span> Issue QTY</a>
              </span>
              
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="quantity_data" class="display table-striped table-bordered responsive nowrap quantity_data" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Quantity Type</th>
                  <th>Quantity</th>
                  <th>Description</th>
                  <th>Issuse For User</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
               
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table Quantity History end -->



<!--Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Specification Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('inventory.spStore')}}" class="form" id="sp_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Name</label>
                           <input type="text"  class="form-control" id="attribute_name" name="attribute_name" required>
                            <span class="text-red">
                              <strong class="attribute_name"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Value</label>
                           <input type="text"  class="form-control" id="attribute_value" name="attribute_value" required>
                            <span class="text-red">
                              <strong class="attribute_value"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="status" class="form-control" required="required">
                              <option value="Active">Active</option>
                              <option value="Disable">Disable</option>
                            </select>
                            <span class="text-red">
                              <strong class="status"></strong>
                            </span>
                        </div> 
                       
                        
                    <input type="hidden" name="edit_id" id="edit_id" value="">     
                    <input type="hidden"  id="inventory_id" name="inventory_id" value="{{$data['inventories']->id}}">    
                </div>
         
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="sp-inventory-update" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--Update Modal end-->

<!-- model for sno --->
  <div class="modal fade" id="modalSNO" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inventory SNO</h4>
        </div>
        <div class="modal-body">
                     <div class="alert alert-danger alert-styled-left" style="display: none;" id="deleteSNO">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="deleteSNO"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="successSNO">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="successSNO"></p>
                    </div>
                <table id="SNO_table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>SNO</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
               
              </table>
    </div>
  </div>
<!-- model for sno end--->


</div>
</div>
<!--Modal -->
  <div class="modal fade" id="QuantityRemoveModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Issuse Inventory Form</h4>
        </div>
        <div class="modal-body">
          
        <form action="{{route('inventory.issuseStore')}}" class="form" id="issuse_inventory_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Quantity</label>
                           <input type="number"  class="form-control" id="quantity" name="quantity" required>
                            <span class="text-red">
                              <strong class="quantity"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                           <input type="text"  class="form-control" id="description" name="description" required>
                            <span class="text-red">
                              <strong class="description"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Issuse For User</label>
                            <select type="text" name="user_id" id="user_id" class="form-control" required="required">
                              @foreach($data['users'] as $row)
                              <option value="{{$row->id}}">{{$row->fname}} {{$row->lname}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="user_id"></strong>
                            </span>
                        </div> 
                       
                        
                    <input type="hidden" name="edit_id" id="edit_id" value="">     
                    <input type="hidden"  id="inventory_id" name="inventory_id" value="{{$data['inventories']->id}}">    
                </div>
         
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="issuse-inventory" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--Update Modal end-->


<!--Modal -->
  <div class="modal fade" id="QuantityAddModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Quantity IN Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('inventory.plusStore')}}" class="form" id="add_quantity_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Quantity</label>
                           <input type="number"  class="form-control" id="quantity" name="quantity" required>
                            <span class="text-red">
                              <strong class="quantity_plus"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                           <input type="text"  class="form-control" id="description" name="description" required>
                            <span class="text-red">
                              <strong class="description_plus"></strong>
                            </span>
                        </div>
                        
                       
                        
                    <input type="hidden" name="edit_id" id="edit_id" value="">     
                    <input type="hidden"  id="inventory_id" name="inventory_id" value="{{$data['inventories']->id}}">    
                </div>
         
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add-quantity" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--Update Modal end-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<script type="text/javascript">
 $( document ).ready(function() {

var InitTable = function(){
    $('#table_data').DataTable({
      "bDestroy": true,
      "processing":true,
      "serverSide":true,
      "ajax":{
               "url": "{{ route('inventorySpecification.fetch') }}",
               "dataType": "json",
               "type": "POST",
               "data":{ _token: "{{csrf_token()}}",id:"{{$data['inventories']->id}}"}
             },
      "columns": [
                { "data": "id" },
                { "data": "attribute_name" },
                { "data": "attribute_value" },
                { "data": "status" },
                { "data": "options" },
            ]
    });
  }

var InitSNOTable = function(){
    $('#SNO_table_data').DataTable({
      "bDestroy": true,
      "processing":true,
      "serverSide":true,
      "ajax":{
               "url": "{{ route('InventorySNOFetch.fetch') }}",
               "dataType": "json",
               "type": "POST",
               "data":{ _token: "{{csrf_token()}}",id:"{{$data['inventories']->id}}"}
             },
      "columns": [
                { "data": "id" },
                { "data": "serial_no" },
                { "data": "status" },
                { "data": "options" },
            ]
    });
  }

var InitQtyTable = function(){
    $('#quantity_data').DataTable({
      "bDestroy": true,
      "processing":true,
      "serverSide":true,
      "ajax":{
               "url": "{{ route('InventoryQtyFetch.fetch') }}",
               "dataType": "json",
               "type": "POST",
               "data":{ _token: "{{csrf_token()}}",id:"{{$data['inventories']->id}}"}
             },
      "columns": [
                { "data": "id" },
                { "data": "quantity_type" },
                { "data": "quantity" },
                { "data": "description" },
                { "data": "user_id" },
                { "data": "created_by" },
                { "data": "status" },
                { "data": "created_at" },
            ]
    });
  }


  InitQtyTable();
  InitSNOTable();
  InitTable();
// code for add form modal show
$(document).on('click', '.btnAdd', function()
{
    $('#myModal').modal('show');
    $('#sp_form')[0].reset();  
});

// code for add QTY form modal show
$(document).on('click', '.btnQuantityAdd', function()
{
    $('#QuantityAddModal').modal('show');
   // $('#sp_form')[0].reset();  
});
// code for Remove QTY form modal show
$(document).on('click', '.btnQuantityRemove', function()
{
    $('#QuantityRemoveModal').modal('show');
    //$('#sp_form')[0].reset();  
});
// code for add form
$('#sp-inventory-update').on('click', function(e) {

  var data = $('#sp_form').serializeArray();
  
  event.preventDefault();
  $.ajax({
          data: data,
          type: $('#sp_form').attr('method'),
          url: $('#sp_form').attr('action'),
          success: function(response)
          {
            
            if(response.errors)
            {
              $(".attribute_name").html(response.errors.attribute_name);
              $('.attribute_name').fadeIn('slow', function(){
                $('.attribute_name').delay(3000).fadeOut(); 
              });
              
              $(".attribute_value").html(response.errors.attribute_value);
              $('.attribute_value').fadeIn('slow', function(){
                $('.attribute_value').delay(3000).fadeOut(); 
              });
              
            }
            else
            {
              $('#myModal').modal('hide');
              $('.success').html(response);
              $('#success').show();
              $('#sp_form')[0].reset();
              InitTable();

              
             
              
            }
          }
        });
}); 

 $(document).on('click', '.edit', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": "{{route('inventory.spEdit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
          $('#edit_id').val(data.id);
          $('#attribute_value').val(data.attribute_value);
          $('#attribute_name').val(data.attribute_name);
          $('#status').val(data.status);
          $('#myModal').modal('show');
        },
          error: function(){},          
      });
});

// code for issuse inventory form
$('#issuse-inventory').on('click', function(e) {

  var data = $('#issuse_inventory_form').serializeArray();
  
  event.preventDefault();
  $.ajax({
          data: data,
          type: $('#issuse_inventory_form').attr('method'),
          url: $('#issuse_inventory_form').attr('action'),
          success: function(response)
          {
            
            if(response.errors)
            {
              $(".quantity").html(response.errors.quantity);
              $('.quantity').fadeIn('slow', function(){
                $('.quantity').delay(3000).fadeOut(); 
              });
              
              $(".description").html(response.errors.description);
              $('.description').fadeIn('slow', function(){
                $('.description').delay(3000).fadeOut(); 
              });

               $(".user_id").html(response.errors.user_id);
              $('.user_id').fadeIn('slow', function(){
                $('.user_id').delay(3000).fadeOut(); 
              });
              
            }
            else
            {
              
              $('#QuantityRemoveModal').modal('hide');
              $('#total_quantity').html(response.quantity);
              $('.success').html(response.success);
              $('#success').show();
              $('#issuse_inventory_form')[0].reset();
              InitQtyTable();
 
            }
          }
        });
}); 
    
// code for issuse inventory form
$('#add-quantity').on('click', function(e) {

  var data = $('#add_quantity_form').serializeArray();
  
  event.preventDefault();
  $.ajax({
          data: data,
          type: $('#add_quantity_form').attr('method'),
          url: $('#add_quantity_form').attr('action'),
          success: function(response)
          {
            
            if(response.errors)
            {
              $(".quantity_plus").html(response.errors.quantity);
              $('.quantity_plus').fadeIn('slow', function(){
                $('.quantity_plus').delay(3000).fadeOut(); 
              });
              
              $(".description_plus").html(response.errors.description);
              $('.description_plus').fadeIn('slow', function(){
                $('.description_plus').delay(3000).fadeOut(); 
              });
            }
            else
            {
              
              $('#QuantityAddModal').modal('hide');
              $('#total_quantity').html(response.quantity);
              $('.success').html(response.success);
              $('#success').show();
              $('#add_quantity_form')[0].reset();
              InitQtyTable();
 
            }
          }
        });
});

$(document).on('click', '.disable', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": "{{route('inventorySNO.disable')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(response)
        {
          InitSNOTable();
          $('.deleteSNO').html(response);
          $('#deleteSNO').show();
        },
          error: function(){},          
      });
});

$(document).on('click', '.active', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": "{{route('inventorySNO.active')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(response)
        {
          InitSNOTable();
          $('.successSNO').html(response);
          $('#successSNO').show();
        },
          error: function(){},          
      });
});


});




</script>

@endsection
