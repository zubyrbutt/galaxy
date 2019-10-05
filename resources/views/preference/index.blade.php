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
              <h3 class="box-title">Manage Preferences</h3>
              @can('create-preference')
              <span class="pull-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> New Preference</button>
                </span>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Option</th>
                  <th>Description</th>
                  <th>Value</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Modified By</th>
                  <th>Modified At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Option</th>
                  <th>Description</th>
                  <th>Value</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Modified By</th>
                  <th>Modified At</th>
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
              <h4 class="modal-title">Add New Preference</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/settings/preferences')}}" method="POST" id="frmAddPreference">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="option">Preference Name</label>
                    <input type="text" class="form-control" id="option" name="option" placeholder="Enter Preference Name" autocomplete="off" required pattern="[a-zA-Z0-9]+"> 
                  </div>
                  <div class="form-group">
                      <label for="description">Preference Description</label>
                      <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="value">Preference Value</label>
                      <input type="text" class="form-control" id="value" name="value" placeholder="Enter Value" autocomplete="off">
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
                <h4 class="modal-title">Edit Preference</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('preference.update')}}" method="POST" id="frmEditPreference">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="option">Preference Name</label>
                        <input type="text" class="form-control" id="editoption" name="option" placeholder="Enter Preference Name" autocomplete="off" required pattern="[a-zA-Z0-9]+"> 
                      </div>
                      <div class="form-group">
                          <label for="description">Preference Description</label>
                          <input type="text" class="form-control" id="editdescription" name="description" placeholder="Enter Description" autocomplete="off">
                      </div>
                      <div class="form-group">
                          <label for="value">Preference Value</label>
                          <input type="text" class="form-control" id="editvalue" name="value" placeholder="Enter Value" autocomplete="off">
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

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
                  "url": "{{ route('preferences.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "option" },
            { "data": "description" },
            { "data": "value" },
            { "data": "created_by" },
            { "data": "created_at" },
            { "data": "modified_by" },
            { "data": "updated_at" },
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut();
 
 //Add Department Begins
  $("#frmAddPreference").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/settings/preferences/')}}",
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
                  swal("Failed", "Unable to Create new preference, " + data.errors.option , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $("#frmAddPreference")[0].reset(); 
                  swal("Success", "New preference created successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to create new preference, Please try again later.", "error");
              }          
       });
    }));
  //Add Department Ends
  //Edit Department Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('preference.edit')}}",
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
          //Populating Form Data to Edit Begins
          $('#modal-default-edit').modal('toggle');
          $('#editid').val(data.id);
          $('#editoption').val(data.option);
          $('#editdescription').val(data.description);
          $('#editvalue').val(data.value);
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Department Form Ends
  //Update Department Begins
  $("#frmEditPreference").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('preference.update')}}",
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
                  console.log(data.errors);
                  $(".loading").fadeOut();
                  swal("Failed", "Unable to update preference, " + data.errors.option , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditPreference")[0].reset(); 
                  swal("Success", "Preference updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create new preference, Please try again later.", "error");
              }          
       });
    }));
    //Update Department Ends

    //Delete Department Begins
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
                url: "preference/delete/"+id,
                type: request_method,
                dataType: "JSON",
                data: form_data,
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
                  swal("Success", "Preference delete successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to delete preference." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Department Ends

  });
  

</script>
@endpush