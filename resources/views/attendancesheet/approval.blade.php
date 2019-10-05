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
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Emp Name</th>
                  <th>Date</th>
                  <th>Check-In</th>
                  <th>Check-Out</th>                
                  <th>Tardies</th>
                  <th>Short Leave</th>
                  <th>Remarks</th>
                  <th>Modified By</th>
                  <th>Status</th>
                  <th>At</th>
                  <th>Approved Status</th>
                  <th>Approved By</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Emp Name</th>
                  <th>Date</th>
                  <th>Check-In</th>
                  <th>Check-Out</th>
                  <th>Tardies</th>
                  <th>Short Leave</th>
                  <th>Remarks</th>
                  <th>Modified By</th>
                  <th>Status</th>
                  <th>At</th>
                  <th>Approved Status</th>
                  <th>Approved By</th>
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


      <!-- Edit Modal Begins -->   
      <div class="modal fade" id="modal-default-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="empname"></h4>
              </div>
              <div class="modal-body" id="comparison">
                
              </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                      <input type="hidden" name="approvalid" id="approvalid" value="0">
                      <input type="hidden" name="user_id" id="user_id" value="0">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <span class="pull-right">
                        @can('att-reject')
                        <button type="button" class="btn btn-danger" id="reject">Reject</button>
                        @endcan
                        @can('att-approve')
                        <button type="button" class="btn btn-success" id="approve">Approve</button>
                        @endcan

                        @can('att-approve')
                        <button type="button" class="btn btn-success" id="approveall">Approve All</button>
                        @endcan
                        
                      </span>
                  </div>
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
                  "url": "{{ route('attendancesheet.approvalfetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "empname" },
            { "data": "dated" },
            { "data": "checkin" },
            { "data": "checkout" },
            { "data": "tardies" },
            { "data": "shortleaves" },
            { "data": "remarks" },
            { "data": "modifiedby" },
            { "data": "status" },
            { "data": "created_at" },
            { "data": "approvestatus" },
            { "data": "approvedby" },
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut(); 
  //View Begins
    $(document).on('click', '.view', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('attendancesheet.viewapproval')}}",
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
          $('#modal-default-edit').modal('toggle');
          $('#empname').html(data.empname);
          $('#comparison').html(data.data);
          $('#approvalid').val(id);
          $('#user_id').val(data.uid);
          
          console.log(data.approvestatus);
          if(data.approvestatus==1){
            $("#approve").hide();          
            $("#approveall").hide();
            $("#reject").hide();
          }else{
            $("#approve").show();          
            $("#approveall").show();
            $("#reject").show();
          }
        },
          error: function(){},          
      });
    });
  //View Ends
  //Approve Begins
  $("#approve").on('click',(function(e) {
  e.preventDefault();
  var id=$('#approvalid').val();
  $.ajax({
       "url": "{{route('attendancesheet.approve')}}",
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
              
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  swal("Failed",  data.errors , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $('#approvalid').val('0');
                  $('#user_id').val('0');
                  swal("Success", data.success, "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                console.log(e);
                swal("Failed", "Unable to peform this action, Please try again later.", "error");
              }          
       });
    }));
    //Approve Ends

    //Approve All Begins
    $(document).on('click', '#approveall', function()
    {
      swal({
        title: "Are you sure want to APPROVE ALL pending requests of this employee?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willRejected) => {
        if (willRejected) {
          var user_id=$('#user_id').val();
          $.ajax({
            "url":"{{route('attendancesheet.approveall')}}",
            type: "POST",
            data: {'user_id': user_id,_token: '{{csrf_token()}}'},
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
           },success: function(data)
            {
              
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  swal("Failed",  data.errors , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $('#approvalid').val('0');
                  $('#user_id').val('0');
                  swal("Success", data.success, "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                console.log(e);
                swal("Failed", "Unable to peform this action, Please try again later.", "error");
              }           
          });
        } 
      });

    });
    //Approve All Ends


    //Reject Begins
    $(document).on('click', '#reject', function()
    {
      swal({
        title: "Are you sure want to reject this request?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willRejected) => {
        if (willRejected) {
          var id=$('#approvalid').val();
          $.ajax({
            "url":"{{route('attendancesheet.reject')}}",
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
           },success: function(data)
            {
              
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  swal("Failed",  data.errors , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $('#approvalid').val('0');
                  $('#user_id').val('0');
                  swal("Success", data.success, "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                console.log(e);
                swal("Failed", "Unable to peform this action, Please try again later.", "error");
              }           
          });
        } 
      });

    });
    //Reject Ends


  });
  

</script>
@endpush