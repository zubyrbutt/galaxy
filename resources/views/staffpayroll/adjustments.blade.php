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
              <h3 class="box-title">Manage Staff's Adjustments</h3>
              <span class="pull-right">
              @can('create-adjustment')             
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Add New </button>
              @endcan
            </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Employee</th>
                  <th>Dated</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Description</th>
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th>Approve/Reject By</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Employee</th>
                  <th>Dated</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Description</th>
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th>Approve/Reject By</th>
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
      <!-- /.row -->   

      <!-- Add Modal Begins -->   
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add New</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="POST" id="frmAdd">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="name">Dated</label>
                    <input type="date" class="form-control" id="dated" name="dated" placeholder="Enter Date" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="type">Type</label>
                      <select class="form-control select2" id="type" name="type" required>
                          <option value="" selected>Select Type</option>    
                          <option value="0">Deduction</option>
                          <option value="1">Addition</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" autocomplete="off" required>
                    </div>
  
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" autocomplete="off" required>
                    </div>
                
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Pending" selected>Pending</option>
                      </select>
                  </div>
               

                  <div class="form-group">
                    <label for="user_id">Select Employee/Staff</label>
                    <select class="form-control select2" id="user_id" name="user_id" required>
                        <option value="" selected>Select Employee/Staff</option>    
                      @foreach ($employees as $emp)
                      <option value="{{$emp->id}}">{{$emp->fname}} {{$emp->lname}} ({{$emp->designation->name}})</option>    
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- Add Modal Ends -->   

        

      <!-- Edit Modal Begins -->   
      <div class="modal fade" id="modal-default-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="" method="POST" id="frmEdit">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">
                      <div class="form-group">
                          <label for="name">Dated</label>
                          <input type="date" class="form-control" id="editdated" name="dated" placeholder="Enter Date" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control select2" id="edittype" name="type" required>
                                <option value="" selected>Select Type</option>    
                                <option value="0">Deduction</option>
                                <option value="1">Addition</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="amount">Amount</label>
                              <input type="number" class="form-control" id="editamount" name="amount" placeholder="Enter Amount" autocomplete="off" required>
                          </div>
        
                          <div class="form-group">
                              <label for="description">Description</label>
                              <input type="text" class="form-control" id="editdescription" name="description" placeholder="Enter Description" autocomplete="off" required>
                          </div>
      
                        <div class="form-group">
                          <label for="user_id">Select Employee/Staff</label>
                          <select class="form-control select2" id="edituser_id" name="user_id" required>
                              <option value="" selected>Select Employee/Staff</option>    
                            @foreach ($employees as $emp)
                            <option value="{{$emp->id}}">{{$emp->fname}} {{$emp->lname}} ({{$emp->designation->name}})</option>    
                            @endforeach
                          </select>
                        </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                  </div>
                </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Edit Modal Ends --> 
        
        <!-- Show and Action Modal Begins -->   
      <div class="modal fade" id="modal-default-show">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body" id="showLeadDetails">
             
            </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                  <span class="pull-right">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </span>
                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- Show and Action Modal Ends -->  
        
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<style>
.select2-container--classic .select2-selection--single .select2-selection__rendered{
    line-height: 35px;
    
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 8px;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #3c8dbc;
    border-radius: 4px;
}

</style>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.8.9/jquery.csv.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>


<script>
//Fetch Data Begins
  function InitTable() {
    $(".loading").fadeIn();
        $('#table_data').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[0, 'desc']],
        "pageLength": 25,
        "ajax":{
                  "url": "{{ route('adjustments.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "user_id" },
            { "data": "dated" },
            { "data": "type" },
            { "data": "amount" },
            { "data": "description" },
            { "data": "created_by" },
            { "data": "modified_by" },
            { "data": "approved_by" },
            { "data": "created_at" },
            { "data": "status" },
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 
  $(".select2").select2({
    theme: "classic",
    width: "100%"
  });
 $(".loading").fadeOut();
 
 //Add Begins
  $("#frmAdd").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('adjustments.store')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
                if(data.errors)
                {
                  $(".loading").fadeOut();                
                  var errordetails="";
                  if(data.errors.user_id){
                    errordetails+=data.errors.user_id+ "\n";
                  }
                  if(data.errors.dated){
                    errordetails+=data.errors.dated+ "\n";
                  }
                  if(data.errors.amount){
                    errordetails+=data.errors.amount+ "\n";
                  }
                  if(data.errors.description){
                    errordetails+=data.errors.description+ "\n";
                  }
                  if(data.errors.type){
                    errordetails+=data.errors.type+ "\n";
                  }
                  if(data.errors.status){
                    errordetails+=data.errors.status+ "\n";
                  }
                  swal("Failed", "Unable to Create.\n " + errordetails , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $("#frmAdd")[0].reset(); 
                  swal("Success", "Created successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create, Please try again later.", "error");
              }          
       });
    }));
  //Add Ends
  

  //Edi Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('adjustments.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          if(data.errors)
          {
            swal("Failed", data.errors , "error");
            return false;
          }else{
            //Populating Form Data to Edit Begins
            $('#modal-default-edit').modal('toggle');
            var date = moment(data.dated); //Get the current date
            var dated=date.format("YYYY-MM-DD"); //2014-07-10
            $('#editid').val(data.id);
            $('#editdated').val(dated);
            $('#editdescription').val(data.description);
            $('#edittype').val(data.type);
            $("#edittype").select2("trigger", "select", {
                data: { id: data.type }
            });
            $('#editamount').val(data.amount);
            $('#editstatus').val(data.status);
            $('#edituser_id').val(data.user_id);
            $("#edituser_id").select2("trigger", "select", {
                data: { id: data.user_id }
            });
            //Populating Form Data to Edit Ends
          }
        },
          error: function(){},          
      });
    });
  //Edit Form Ends

  //Update Begins
  $("#frmEdit").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('adjustments.update')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
              
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  var errordetails="";
                  if(data.errors.user_id){
                    errordetails+=data.errors.user_id+ "\n";
                  }
                  if(data.errors.dated){
                    errordetails+=data.errors.dated+ "\n";
                  }
                  if(data.errors.amount){
                    errordetails+=data.errors.amount+ "\n";
                  }
                  if(data.errors.description){
                    errordetails+=data.errors.description+ "\n";
                  }
                  if(data.errors.type){
                    errordetails+=data.errors.type+ "\n";
                  }
                  if(data.errors.status){
                    errordetails+=data.errors.status+ "\n";
                  }
                  swal("Failed", "Unable to update.\n " + errordetails , "error");
                  
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEdit")[0].reset(); 
                  swal("Success", "Updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to update, Please try again later.", "error");
              }          
       });
    }));
    //Update Ends
 
    //Approve Begins
    $(document).on('click', '.approve', function(e)
    {
      swal({
        title: "Are you sure to Approve this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');  
          var token= '{{csrf_token()}}';
              e.preventDefault();
              
              var request_method = $("#form"+id).attr("method"); 
              var form_data = $("#form"+id).serialize(); 
              
              $.ajax({
                //url: "adjustments/delete/"+id,
                url: "{!! route('adjustments.approve') !!}",
                type: request_method,
                dataType: "JSON",
                data: {
                           id: id,
                          _token: token
                      },
                beforeSend : function()
                {
                  $(".loading").fadeIn();
                },
                statusCode: {
                  403: function() {
                    $(".loading").fadeOut();                
                    swal("Failed", "Permission deneid for this action." , "error");
                    return false;
                  }
                },
                success: function(data)
                {
                  $(".loading").fadeOut();
                  if(data.errors)
                  {
                    swal("Failed", data.errors , "error");
                    return false;
                  }else{
                    swal("Success", data.success, "success");
                    var table = $('#table_data').DataTable();
                    table.draw();
                    $(".loading").fadeOut();
                  }
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to perform this request, please try later." , "error");
                  },          
              });
          
        } 
      });

    });
    //Approve Ends


    //Reject Begins
    $(document).on('click', '.reject', function(e)
    {
      swal({
        title: "Are you sure to Reject this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');  
          var token= '{{csrf_token()}}';
              e.preventDefault();
              
              $.ajax({
                url: "{!! route('adjustments.reject') !!}",
                type: 'POST',
                dataType: "JSON",
                data: {
                           id: id,
                          _token: token
                      },
                beforeSend : function()
                {
                  $(".loading").fadeIn();
                },
                statusCode: {
                  403: function() {
                    $(".loading").fadeOut();                
                    swal("Failed", "Permission deneid for this action." , "error");
                    return false;
                  }
                },
                success: function(data)
                {
                  $(".loading").fadeOut();
                  if(data.errors)
                  {
                    swal("Failed", data.errors , "error");
                    return false;
                  }else{
                    swal("Success", data.success, "success");
                    var table = $('#table_data').DataTable();
                    table.draw();
                    $(".loading").fadeOut();
                  }
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to perform this request, please try later." , "error");
                  },          
              });
          
        } 
      });

    });
    //Reject Ends



    //Delete Begins
    $(document).on('click', '.delete', function(e)
    {
      swal({
        title: "Are you sure to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');  
          var token= '{{csrf_token()}}';
              e.preventDefault();
              
              var request_method = $("#form"+id).attr("method"); 
              var form_data = $("#form"+id).serialize(); 
              
              $.ajax({
                //url: "adjustments/delete/"+id,
                url: "{!! route('adjustments.destroy') !!}",
                type: request_method,
                dataType: "JSON",
                data: {
                          id: id,
                          _method: 'DELETE',
                          _token: token
                      },
                beforeSend : function()
                {
                  $(".loading").fadeIn();
                },
                statusCode: {
                  403: function() {
                    $(".loading").fadeOut();                
                    swal("Failed", "Permission deneid for this action." , "error");
                    return false;
                  }
                },
                success: function(data)
                {
                  $(".loading").fadeOut();
                  if(data.errors)
                  {
                    swal("Failed", data.errors , "error");
                    return false;
                  }else{
                    swal("Success", data.success, "success");
                    var table = $('#table_data').DataTable();
                    table
                    .row( $(this).parents('tr') )
                    .remove()
                    .draw();

                    $(".loading").fadeOut();
                  }
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to perform this request, please try later." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Ends

  });
  
</script>
@endpush