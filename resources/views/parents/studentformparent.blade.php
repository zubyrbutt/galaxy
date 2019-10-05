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
              <h3 class="box-title">Add Student Against Parent: </h3><span style='color:green; font-weight:bold'> {{ $parent_name['fname'] }} {{ $parent_name['lname'] }}</span>
              @can('create-student')
              @endcan
			  <span class="pull-right">
			  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Add New Student</button>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($student_details) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Student Name</th>
				  <th>Email</th>
                  <th>isCustomer</th>
                  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>
                @foreach($student_details as $student_detail)
                  <tr>
					<td>{{$student_detail['id'] }} </td>
					<td>{{$student_detail['fname'] }} {{$student_detail['lname'] }} </td>
					<td>{{$student_detail['email'] }} </td>
					<td>{{$student_detail['iscustomer'] }} </td>
                     <!-- For Delete Form begin -->
                    <form id="form{{$student_detail['id']}}" action="{{action('ParentController@destroy', $student_detail['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
					<!--@can('delete-student_detail')-->
                    <!--@endcan-->
                    <td>
                      @can('show-student_detail')<a href="{!! url('/student_detail/'.$student_detail['id']); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>@endcan
                      @can('edit-student_detail')<a href="{!! url('/student_detail/'.$student_detail['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>@endcan
					  
                      <button class="btn btn-danger" onclick="archiveFunction('form{{$student_detail['id']}}')"><i class="fa fa-trash"></i></button>
					</td>
                   
                    

                  </tr>
                  @endforeach
                </tbody>

                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Student Name</th>
				  <th>Email</th>
                  <th>isCustomer</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              @else
              <div>No Record found.</div>
              @endif
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
              <h4 class="modal-title">Add New Student</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/parents')}}" method="POST" id="frmAddHRLead">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="lname">Last Name</label>
                      <input type="lname" class="form-control" id="lname" name="lname" placeholder="Enter Last Name " autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Enter username" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="off" required>
                  </div>
				  
                  <div class="form-group">
                    <label for="gender" >Gender</label>
                    <select id="gender" name="gender" class="form-control">
					    <option value="">Select gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                  </div>
			      <div class="form-group">
                    <label for="dob" >Date of Birth:</label>
                      <input type="date" class="form-control" id="dob" name="dob" placeholder="dob" autocomplete="off" />			  
				  </div>
				  
				<input type="hidden" class="form-control" id="parent_id" name="parent_id" value="{{ $last_parent_id }}" >
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <span class="pull-right"><button type="submit" class="btn btn-primary btn-submit">Submit</button></span>
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
	  
	  
<script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(".btn-submit").click(function(e){
		//alert('F******');
        e.preventDefault();
        var fname = $("input[name=fname]").val();
		var lname = $("input[name=lname]").val();
		var email = $("input[name=email]").val();	
        var password = $("input[name=password]").val();
		var parent_id = $("input[name=parent_id]").val();
		var gender = $( "#gender" ).val();
		var dob = $("input[name=dob]").val();

        $.ajax({

           type:'POST',

           url:'/parents/studentparent_store/',

           data:{fname:fname ,lname:lname , password:password, email:email, parent_id:parent_id, gender:gender, dob:dob},

           success:function(data){
			if(data.errors)
                {
                  $(".loading").fadeOut();                
                  var errordetails="";
                  if(data.errors.fname){
                    errordetails+=data.errors.fname+ "\n";
                  }
                  if(data.errors.lname){
                    errordetails+=data.errors.lname+ "\n";
                  }
                  if(data.errors.email){
                    errordetails+=data.errors.email+ "\n";
                  }
                  if(data.errors.password){
                    errordetails+=data.errors.password+ "\n";
                  }
				  if(data.errors.parent_id){
                    errordetails+=data.errors.parent_id+ "\n";
                  }
				  if(data.errors.gender){
                    errordetails+=data.errors.gender+ "\n";
                  }
				  if(data.errors.dob){
                    errordetails+=data.errors.dob+ "\n";
                  }					  
                  swal("Failed", "Unable to Create new Student.\n " + errordetails , "error");
                }
                else
                {
				  //alert(data.success);
				  $('#modal-default').modal('toggle');
				  $("#frmAddHRLead")[0].reset(); 
				  swal("Success", "New Student Against Parent created successfully.", "success").then(function() {
						window.location = "{{ url('parents/studentformparent') }}/"+parent_id;
					});
				  InitTable();
                  $(".loading").fadeOut();
				}
           },
		      error: function(e) 
              {
				if(data.errors)
                {
					$(".loading").fadeOut();
					swal("Failed", "Unable to Create Student," + data.errors.email , "error");
				}
				else {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create Student, Please try again later." , "error");
				}
              } 

        });



	});

</script>	  
	  

@endsection
@push('scripts')
<style>

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
//Fetch Data Begins	PARENT
var last_parent_id = "{{ $last_parent_id }}";
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
                  "url": "{{ url('studentformparent/') }}"+1,
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "fullname" },
            { "data": "email" },
            { "data": "phonenumber" },
            { "data": "iscustomer" },
			{ "data": "role_id" },
            { "data": "status" },
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends PARENT

$(document).ready(function (e) {
  InitTable();
 
  $(".select2").select2({
  theme: "classic"
});
// $(".loading").fadeOut();
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
	  alert('we r here');
  e.preventDefault();
  $.ajax({
         url: "{{url('/parents/studentparent_store/')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
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
                  if(data.errors.fname){
                    errordetails+=data.errors.fname+ "\n";
                  }
                  if(data.errors.lname){
                    errordetails+=data.errors.lname+ "\n";
                  }
                  if(data.errors.username){
                    errordetails+=data.errors.username+ "\n";
                  }
                  if(data.errors.password){
                    errordetails+=data.errors.password+ "\n";
                  }
				  if(data.errors.parent_id){
                    errordetails+=data.errors.parent_id+ "\n";
                  }				  
                  swal("Failed", "Unable to Create new Student.\n " + errordetails , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $("#frmAddHRLead")[0].reset(); 
                  swal("Success", "New Student Against Parent created successfully.", "success");
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
