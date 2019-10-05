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
              <h3 class="box-title">Manage Interviewees</h3>
              <span class="pull-right">
              <span class="col-md-6">
              <div class="input-group">
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                  <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                  <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-d')}}">
                  <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-d')}}">
                  <i class="fa fa-caret-down"></i>
                </button>
              </div>
              <script>
                
                  $(document).ready(function() { 
                    
                   //Date range as a button
                   $('#daterange-btn').daterangepicker(
                     {
                       ranges   : {
                         'Today'       : [moment(), moment()],
                         'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                         'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                         'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                         'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                       },
                       startDate: moment().subtract(29, 'days'),
                       endDate  : moment()
                     },
                     function (start, end) {
                       $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                       $('#dateFrom').val(start.format('YYYY-MM-DD'));
                       $('#dateTo').val(end.format('YYYY-MM-DD'));
                       var maintabledate = $('#table_data').DataTable();
                       maintabledate.column('6').search(
                        $('#dateFrom').val()+','+$('#dateTo').val()
                        ).draw();
                     }
                   );
                  
                     
                   });

                   </script>
                   </span>
                   <span class="col-md-6">
                   <select class="form-control select2" id="srcdepartment_id" name="srcdepartment_id">
                      <option value="" selected>Show All Deparments</option>    
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->deptname}}</option>    
                    @endforeach
                  </select>
                   </span>
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
                  <th>Interview At</th>
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
                  <th>Interview At</th>
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
                  "url": "{{ route('interviewees.fetch') }}",
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
 
//Show HR Leads Form Begins
$(document).on('click', '.showlead', function()
    {
      var id = $(this).attr('data-id');
      var showstatus = $(this).attr('data-status');
      $.ajax({
        "url": "{{route('hrleads.show')}}",
        type: "POST",
        data: {'id': id,'showstatus':showstatus, _token: '{{csrf_token()}}'},
        
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
                  swal("Success", "Lead delete successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
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
</script>
@endpush