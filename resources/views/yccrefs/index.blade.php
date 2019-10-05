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
              <h3 class="box-title">Manage References</h3>
              @can('create-yccref')
              <span class="pull-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Add New Reference</button>
                </span>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Lead No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contct No</th>
                  <th>Country</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Ref by</th>
                  <th>Status</th>
                  <th>Ref Date</th>
                  <th>Note</th>
                  <th>UpdatedBy</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Lead No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contct No</th>
                  <th>Country</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Ref by</th>
                  <th>Status</th>
                  <th>Ref Date</th>
                  <th>Note</th>
                  <th>UpdatedBy</th>
                  <th>Updated At</th>
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
              <h4 class="modal-title">Add New Reference</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/yccref')}}" method="POST" id="frmAddReference">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="deptname">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="contactno">Contact No.</label>
                    <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Enter Contact No. " autocomplete="off" required>
                  </div>

                  <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="message">Note</label>
                    <input type="text" class="form-control" id="message" name="message" placeholder="Enter Note" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="source">Source</label>
                    <input type="text" class="form-control" id="source" name="source" placeholder="Enter Source" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="user_id">Select Staff</label>
                    <select class="form-control select2" id="user_id" name="user_id" required style="width:100%;">
                      <option value="" selected>None</option>
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
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
                <h4 class="modal-title">Edit Reference</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('yccref.update')}}" method="POST" id="frmEditReference">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="editname" name="name" placeholder="Enter Name" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                      <label for="deptname">Email</label>
                      <input type="email" class="form-control" id="editemail" name="email" placeholder="Enter Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="contactno">Contact No.</label>
                      <input type="text" class="form-control" id="editcontactno" name="contactno" placeholder="Enter Contact No. " autocomplete="off" required>
                    </div>
  
                    <div class="form-group">
                      <label for="country">Country</label>
                      <input type="text" class="form-control" id="editcountry" name="country" placeholder="Enter Country" autocomplete="off">
                    </div>
  
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" class="form-control" id="editsubject" name="subject" placeholder="Enter Subject" autocomplete="off">
                    </div>
  
                    <div class="form-group">
                      <label for="message">Note</label>
                      <input type="text" class="form-control" id="editmessage" name="message" placeholder="Enter Note" autocomplete="off">
                    </div>
  
                    <div class="form-group">
                      <label for="source">Source</label>
                      <input type="text" class="form-control" id="editsource" name="source" placeholder="Enter Source" autocomplete="off">
                    </div>
  
                    <div class="form-group">
                      <label for="user_id">Select Staff</label>
                      <select class="form-control select2" id="edituser_id" name="user_id" required style="width:100%;">
                        <option value="" selected>None</option>
                        @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
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
        
        

<!-- Status Modal -->
<div id="newstatus" class="modal fade">
  <form action="{{ url('yccrefs.status')}}" method="POST" id="yccrefstatus" role="form">
    @csrf
    <div class="modal-dialog">
    <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 id="modalheader">YCC Reference</h2>
            </div>
            <div class="modal-body" id="modalbody">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="statusname" class="form-control" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Contact No</label>
                    <input type="text" name="contactno" id="statuscontactno" class="form-control" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="statusemail" class="form-control" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" selected>Inprocess</option>
                        <option value="2">Closed</option>
                        <option value="3">Rejected</option>
                        <option value="4">Not Interested</option>                
                        <option value="5">Call Back</option>
                        <option value="6">Trial Committed</option>
                        <option value="7">Trial Delivered</option>
                        <option value="8">Invoice Sent</option>
                        <option value="9">Spam</option>
                        <option value="10">NSNC</option>
                        <option value="11">Duplicate</option>
                    </select>  
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="notes" id="notes" required></textarea>
                </div>
              
            </div>
            <div class="modal-footer" id="modalfooter">
                <input type="hidden" name="yccrefid" id="yccrefid" class="form-control" value="" readonly>
              <input type="submit" class="btn btn-primary" id="btn-update" value="Update">
            </div>
          </div>
    </div>
  </form>
</div>
<!-- Status Modal -->

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
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
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
  
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
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
                  "url": "{{ route('yccrefs.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
          { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "contactno" },
                { "data": "country" },
                { "data": "subject" },
                { "data": "message" },
                { "data": "user_id" },
                { "data": "status" },
                { "data": "created_at" },
                { "data": "lastdesc" ,"orderable":false},
                { "data": "UpdatedBy" ,"orderable":false },
                { "data": "lastUpdateAt" ,"orderable":false },
                { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut();
 $('.select2').select2({
    theme: "classic"
 }); 
 //Add Reference Begins
  $("#frmAddReference").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/yccref/')}}",
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
                  var validationerrors="";
                  if(data.errors.name){
                    validationerrors+="\n" + data.errors.name;
                  }
                  if(data.errors.contactno){
                    validationerrors+="\n" + data.errors.contactno;
                  }
                  
                  swal("Failed", "Unable to Create new Reference, " + validationerrors , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $("#frmAddReference")[0].reset(); 
                  swal("Success", "Reference created successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create new Reference, Please try again later.", "error");
              }          
       });
    }));
  //Add Reference Ends
  //Edit Reference Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('yccref.edit')}}",
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
          $('#editcontactno').val(data.contactno);
          $('#editcountry').val(data.country);
          $('#editemail').val(data.email);
          $('#editmessage').val(data.message);
          $('#editname').val(data.name);
          $('#editsource').val(data.source);
          $('#editsubject').val(data.subject);
          $('#edituser_id').val(data.user_id);
          $("#edituser_id").select2("trigger", "select", {
              data: { id: data.user_id }
          });
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Reference Form Ends
  //Update Reference Begins
  $("#frmEditReference").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('yccref.update')}}",
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
                  var validationerrors="";
                  if(data.errors.name){
                    validationerrors+="\n" + data.errors.name;
                  }
                  if(data.errors.contactno){
                    validationerrors+="\n" + data.errors.contactno;
                  }
                  
                  swal("Failed", "Unable to update Reference, " + validationerrors , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditReference")[0].reset(); 
                  swal("Success", "Reference updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create new Reference, Please try again later.", "error");
              }          
       });
    }));
    //Update Reference Ends

    //Change Reference Status Begins
     //Modal open begins
    $(document).on('click', '.newstatus', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('yccref.edit')}}",
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
          //Populating Status Form 
          $('#newstatus').modal('toggle');
          $('#yccrefid').val(data.id);
          $('#statuscontactno').val(data.contactno);
          $('#statusemail').val(data.email);
          $('#statusname').val(data.name);
          //Populating Status Form 
        },
          error: function(){},  
        });

    });
    //Modal open ends


    $('#yccrefstatus').on('submit', function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        type: "POST",
        url: "{{ route('yccrefs.status') }}",
        data: $('#yccrefstatus').serialize(),
        success: function(response) {
          if(response.errors)
          {
            swal("Failed", "All fields are required, Please fill the detail before submitting.", "error");
          }
          else
          {
            $('#yccrefstatus').trigger("reset");
            swal("Success", "Status updated successfully.", "success");
            InitTable();
            $(".loading").fadeOut();
            $('#newstatus').modal('hide');		
          }
            
        }
    });
    return false;
});
    //Change Reference Status Ends

    //Delete Reference Begins
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
                url: "yccref/delete/"+id,
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
                  swal("Success", "Reference delete successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to delete Reference." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Reference Ends

  });
  

</script>
@endpush