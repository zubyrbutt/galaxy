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
                    <td>{{$data['itstation']->id}}</td>
                </tr>
                <tr>
                    <td><b>Station Number</b></td>
                    <td>{{$data['itstation']->station_number}}</td>
                </tr>
                <tr>
                    <td><b>Floor No</b></td>
                    <td>{{$data['itstation']->floor->floor_no}}</td>
                </tr>
                <tr>
                    <td><b>Room No</b></td>
                    <td>{{$data['itstation']->room->room_no}}</td>
                </tr>
              
                <tr>
                    <td><b>Description</b></td>
                    <td>{{$data['itstation']->description}}</td>
                </tr>
                 
                <tr>
                    <td><b>Created At</b></td>
                    <td>{{$data['itstation']->created_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td>{{$data['itstation']->updated_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        
                          <span class="text-green"><b>{{$data['itstation']->status}}</b></span>
                        
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
              </div>
              <!-- /.box-footer -->

</div>

<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">IT Station Inventories</h3>
              
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn"><span class="fa fa-plus"></span> Add </a>
              </span>
              
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap table_data" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Inventory Name</th>
                  <th>Inventory SNO</th>
                  <th>Created AT</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Inventory Name</th>
                  <th>Inventory SNO</th>
                  <th>Created AT</th>
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

<!--Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Inventory Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('itstation.InventoryStore')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Inventory Name</label>
                           <select type="text" name="inventory_id" id="inventory_id" class="form-control" required="required">
                              <option value="">Choose Option</option>
                              @foreach($data['inventories'] as $row)
                              <option value="{{$row->id}}">{{$row->title}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="inventory_id"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Inventory SNO</label>
                           <select type="text" name="inventory_sno_id" id="inventory_sno_id" class="form-control" required="required">
                              <option value="">Choose Option</option>
                             
                            </select>
                            <span class="text-red">
                              <strong class="inventory_sno_id"></strong>
                            </span>
                        </div>
                        
                       
                        
                    <input type="hidden"  id="station_id" name="station_id" value="{{$data['itstation']->id}}">    
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
               "url": "{{ route('ITStationInventory.fetch') }}",
               "dataType": "json",
               "type": "POST",
               "data":{ _token: "{{csrf_token()}}",id:"{{$data['itstation']->id}}"}
             },
      //"ajax":"{{ route('complaintComment.fetch') }}",
      "columns": [
                { "data": "id" },
                { "data": "inventory_id" },
                { "data": "inventory_sno_id" },
                { "data": "created_at" },
                { "data": "status" },
                { "data": "options" },
            ]
    });
  }


  InitTable();
// code for add form modal show
$(document).on('click', '.addModelbtn', function()
{
    $('#addModel').modal('show');
    $('#add_form')[0].reset();

});
// code for add form
$('#add_form_btn').on('click', function(e) {
var data = $('#add_form').serializeArray();
event.preventDefault();
  $.ajax({
  data: data,
  type: $('#add_form').attr('method'),
  url: $('#add_form').attr('action'),
  success: function(response)
  {
  if(response.errors)
  {
  $.each(response.errors, function( index, value ) {
    $("."+index).html(value);
    $("."+index).fadeIn('slow', function(){
      $("."+index).delay(3000).fadeOut(); 
    });
  });

  }
  else
  {
    InitTable();
    $('.success').html(response);
    $('#success').show();
    $('#add_form')[0].reset();
    $('#addModel').modal('hide');
  }
  }
  });
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

$(document).on('click', '.disable', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": "{{route('itstation.inventory.disable')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(response)
        {
          InitTable();
          $('.delete').html(response);
          $('#delete').show();
        },
          error: function(){},          
      });
});

$(document).on('click', '.active', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": "{{route('itstation.inventory.active')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(response)
        {
          InitTable();
          $('.success').html(response);
          $('#success').show();
        },
          error: function(){},          
      });
});

});



$(document).on('change','#inventory_id',function(){
    var inventory_id = $(this).val();
      $.ajax({
              url: "{{route('itemSNOFetchByInventory')}}",
              data: { '_token': "{{csrf_token()}}",'inventory_id':inventory_id},
              type: 'POST',
              success: function (data) {
                // console.log(data); 
               var html = '';
                $.each(data, function(i, item) {
                  html+='<option value="'+item.id+'">';
                  html+=item.serial_no;
                  html+='</option>';

                });

                $('#inventory_sno_id').html(html);


              },
              error: function (xhr, status, error) {
                  
              }
      });

   });
       
</script>

@endsection
