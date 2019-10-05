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
              <h3 class="box-title">Manage HR Leads</h3>
              <span class="pull-right">
              @can('create-hrleads')             
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Add New Lead</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default-upload"><span class="fa fa-plus"></span> Upload Leads</button>
              @endcan
              <select class="form-control select2" id="srcdepartment_id" name="srcdepartment_id">
                <option value="" selected>Show All Deparments</option>    
              @foreach ($departments as $department)
              <option value="{{$department->id}}">{{$department->deptname}}</option>    
              @endforeach
            </select>
            </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Deparment</th>
                  <th>Created By</th>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Deparment</th>
                  <th>Created By</th>
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
              <h4 class="modal-title">Add New Lead</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/hrleads')}}" method="POST" id="frmAddHRLead">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter  Name" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="mobile">Mobile Number</label>
                      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="department_id">Select Department</label>
                    <select class="form-control" id="department_id" name="department_id" required>
                        <option value="" selected>Select Department</option>    
                      @foreach ($departments as $department)
                      <option value="{{$department->id}}">{{$department->deptname}}</option>    
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

       <!-- Add Modal Begins -->   
       <div class="modal fade" id="modal-default-upload">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload New Leads</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{url('/hrleads/upload')}}" method="POST" id="frmUploadHRLead" enctype="multipart/form-data">
                  @csrf
                  <div class="box-body">
                    <div class="form-group">
                        <label for="leadfile">Select File</label>
                        <input type="file" class="form-control" name="leadfile" id="txtFileUpload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <p><a href="#">Download sample file here</a></p>
                        <table id="csvtable" class="display responsive wrap" style="width:100%">
                            <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Mobile</th>
                                 </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Mobile</th>
                                </tr>
                                </tfoot>
                        </table>


                    </div>
                    <div class="form-group">
                      <label for="department_id">Select Department</label>
                      <select class="form-control" id="department_id" name="department_id" required>
                          <option value="" selected>Select Department</option>    
                        @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->deptname}}</option>    
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
                <h4 class="modal-title">Edit Lead</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('hrleads.update')}}" method="POST" id="frmEditHRLead">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="editname" name="name" placeholder="Enter  Name" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="editemail" name="email" placeholder="Enter Email Address" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="mobile">Mobile Number</label>
                          <input type="text" class="form-control" id="editmobile" name="mobile" placeholder="Enter Mobile Number" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <label for="department_id">Select Department</label>
                        <select class="form-control" id="editdepartment_id" name="department_id" required>
                            <option value="" selected>Select Department</option>    
                          @foreach ($departments as $department)
                          <option value="{{$department->id}}">{{$department->deptname}}</option>    
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
                  "url": "{{ route('hrleads.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "department_id" },
            { "data": "user_id" },
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
  theme: "classic"
});
 $(".loading").fadeOut();
 //Filter by Department begins
 var maintable = $('#table_data').DataTable();
 // Event listener to the two range filtering inputs to redraw on input
 $('#srcdepartment_id').change( function() {
   
    maintable.column('4').search(
      $("#srcdepartment_id").val()
    ).draw();

 });
 //Filter by Department ends
 //Add HR Lead Begins
  $("#frmAddHRLead").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/hrleads/')}}",
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
                  if(data.errors.name){
                    errordetails+=data.errors.name+ "\n";
                  }
                  if(data.errors.email){
                    errordetails+=data.errors.email+ "\n";
                  }
                  if(data.errors.mobile){
                    errordetails+=data.errors.mobile+ "\n";
                  }
                  if(data.errors.department_id){
                    errordetails+=data.errors.department_id+ "\n";
                  }
                  swal("Failed", "Unable to Create new lead.\n " + errordetails , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $("#frmAddHRLead")[0].reset(); 
                  swal("Success", "New lead created successfully.", "success");
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
  //Add HR Lead Ends
  //Upload HR Lead Begins
  $("#frmUploadHRLead").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/hrleads/upload')}}",
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
                  if(data.errors.leadfile){
                    errordetails+=data.errors.leadfile+ "\n";
                  }
                  if(data.errors.department_id){
                    errordetails+=data.errors.department_id+ "\n";
                  }
                  swal("Failed", "Unable to upload.\n " + errordetails , "error");
                }
                else
                {
                  $('#modal-default-upload').modal('toggle');
                  $("#frmUploadHRLead")[0].reset(); 
                  swal("Success", data.success, "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to upload, Please try again later.", "error");
              }          
       });
    }));
  //Upload HR Lead Ends

//Show HR Leads Form Begins
$(document).on('click', '.showlead', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('hrleads.show')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        
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
          $('#modal-default-show').modal('toggle');
          $('#showLeadDetails').html(data);
          //Populating Form Data to Edit Begins
          /*$('#modal-default-show').modal('toggle');
          $('#showid').val(data.id);
          $('#showname').val(data.name);
          $('#showemail').val(data.email);
          $('#showmobile').val(data.mobile);
          $('#showdepartment_id').val(data.department_id);*/
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Show HR Leads Form Ends



  //Edit HR Leads Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('hrleads.edit')}}",
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
          $('#editname').val(data.name);
          $('#editemail').val(data.email);
          $('#editmobile').val(data.mobile);
          $('#editdepartment_id').val(data.department_id);
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit HR Leads Form Ends

  //Update Department Begins
  $("#frmEditHRLead").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('hrleads.update')}}",
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
                  if(data.errors.name){
                    errordetails+=data.errors.name+ "\n";
                  }
                  if(data.errors.email){
                    errordetails+=data.errors.email+ "\n";
                  }
                  if(data.errors.mobile){
                    errordetails+=data.errors.mobile+ "\n";
                  }
                  if(data.errors.department_id){
                    errordetails+=data.errors.department_id+ "\n";
                  }
                  swal("Failed", "Unable to update lead.\n " + errordetails , "error");
                  
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditHRLead")[0].reset(); 
                  swal("Success", "Lead updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to update lead, Please try again later.", "error");
              }          
       });
    }));
    //Update Department Ends
 
    //Delete HR Leads Begins
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
                url: "hrleads/delete/"+id,
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
                  if(data.errors){
                    swal("Failed", data.errors , "error");
                  }else{
                    swal("Success", "Lead delete successfully.", "success");
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
                    swal("Failed", "Unable to delete lead." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete HR Leads Ends

  });
  
//CSV render begins
$(document).ready(function() {
  $('#csvtable').hide();
  $('#modal-default-upload').on('hidden.bs.modal', function () {
    $('#csvtable').hide();
    var csvdata = $('#csvtable').DataTable();
                csvdata.clear()
                .draw();
    $('#frmUploadHRLead')[0].reset();
    
  });
// The event listener for the file upload
document.getElementById('txtFileUpload').addEventListener('change', upload, false);

// Method that checks that the browser supports the HTML5 File API
function browserSupportFileUpload() {
    var isCompatible = false;
    if (window.File && window.FileReader && window.FileList && window.Blob) {
    isCompatible = true;
    }
    return isCompatible;
}

// Method that reads and processes the selected file
function upload(evt) {
if (!browserSupportFileUpload()) {
    alert('The File APIs are not fully supported in this browser!');
    } else {
        var jsonData = null;
        var file = evt.target.files[0];
        var fileName = file.name;
        var name=fileName;
        var ext = fileName.substr(fileName.lastIndexOf('.') + 1);
        var reader = new FileReader();
        if(ext=="csv"){
          reader.readAsText(file);
        }else{
          reader.readAsBinaryString(file);
        }
        reader.onload = function(event) {
          
            if(ext=="csv"){
              //Read CSV file
              var csvData = event.target.result ;
              jsonData = $.csv.toArrays(csvData);
              if (jsonData && jsonData.length > 0) {
                //alert('Imported -' + jsonData.length + '- rows successfully!');
                $('#csvtable').show();
                $('#csvtable').DataTable({
                  "destroy": true,
                  "ordering": false,
                  "pageLength": 10,
                  data  :  jsonData,
                  });
              } else {
                swal("Failed", "No data to import!" , "error");
              }
            }else{
              //Read XLSX File
               csvData = event.target.result;
                var result;
                var workbook = XLSX.read(csvData, { type: 'binary' });
                
                var sheet_name_list = workbook.SheetNames;
                sheet_name_list.forEach(function (y) { 
                    //Convert the cell value to Json
                    var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[y]);
                    if (roa.length > 0) {
                      jsonData = roa;
                    }
                });
                if (jsonData && jsonData.length > 0) {
                //alert('Imported -' + jsonData.length + '- rows successfully!');
                $('#csvtable').show();
                $('#csvtable').DataTable({
                  "destroy": true,
                  "ordering": false,
                  "pageLength": 10,
                  data  :  jsonData,
                  "columns": [
                        { "data": "name" },
                        { "data": "email" },
                        { "data": "mobile" },
                    ]  

                  });
              } else {
                  swal("Failed", "No data to import!" , "error");
              }
            }
        };
        reader.onerror = function() {
            swal("Failed", "Unable to read file" , "error");
        };
    }
}
});
//CSV render ends

</script>
@endpush