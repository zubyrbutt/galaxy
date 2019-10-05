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
              <h3 class="box-title">Manage Students</h3>
              <span class="pull-right">
			  @can('create-schedule')
				  <a href="{!! url('/schedule/create'); !!}" class="btn btn-success"><span class="fa fa-plus"></span> Add Schedule</a>
			  @endcan				  
			  @can('create-student')	
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Add Student</button>
			  @endcan	
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
				  <th>Parent</th>				  
                  <th>Phone</th>
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
				  <th>Parent</th>				  
                  <th>Phone</th>
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
	  
      <!-- Add Modal Begins 			ADD PARENT-->  	  
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Student</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/student')}}" method="POST" id="frmAddStudent">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="lname">Last Name</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name " autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Enter username" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="off" required>
                  </div>

				  <!--Select2 dropdown used -->
				  <div class="form-group">
					<label>Select Parent</label>
					<select id="parent_id" name="parent_id" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select teacher" style="width: 100%;" tabindex="-1" aria-hidden="true">
					  <option value="0" >Select Parent</option>
					  @foreach($parents as $key => $parent)
						<option value="{{ $parent->id }}" >{{ $parent->fname }} {{ $parent->lname }}</option>    
					  @endforeach              
					</select>
				  </div>
				  
                  <div class="form-group">
                    <label for="gender" >Gender</label>
                    <select name="gender" class="form-control">
					    <option value="">Select gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                  </div>
			      <div class="form-group">
                    <label for="dob" >Date of Birth:</label>
                      <input type="date" class="form-control" id="dob" name="dob" placeholder="dob" autocomplete="off" />			  
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
                <h4 class="modal-title">Edit Student</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('student.update')}}" method="POST" id="frmEditStudent">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">

                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="editfname" name="fname" placeholder="Enter First Name" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="lname">Last Name</label>
                      <input type="text" class="form-control" id="editlname" name="lname" placeholder="Enter Last Name " autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="editusername" name="email" placeholder="Enter username" autocomplete="off" required>
                  </div>

				  <div class="form-group">
					<label for="extension" class="">Parent</label>
						<select class="form-control m-bot15" id="editparent_id" name="parent_id">
							<option value="0" >Select Parent</option>
							@if ($parents!='')
								@foreach($parents as $key => $parent)
									<option value="{{ $parent->id }}" >{{ $parent->fname }} {{ $parent->lname }}</option>    
								@endforeach
							@endif
						</select>
				  </div>
                  <div class="form-group">
                    <label for="gender" >Gender</label>
                    <select id="editgender" name="gender" class="form-control">
					    <option value="">Select gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                  </div>
			      <div class="form-group">
                    <label for="dob" >Date of Birth:</label>
                      <input type="date" class="form-control" id="editdob" name="dob" placeholder="dob" autocomplete="off" />			  
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
		

		
      <!-- Resetpassword Modal Begins -->   
      <div class="modal fade" id="modal-default-resetpassword">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reset Password Student > <span id="studentName_span"></span></h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('student.update')}}" method="POST" id="frmResetpasswordStudent">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
				  <input name="resetpassword" type="hidden" value="1">
                  <input name="id" id="resetpasswordid" type="hidden" value="0">
                  <div class="box-body">

						<div class="form-group">
						  <label for="newpassword" class="">New Password</label>
							<input type="password" class="form-control" id="editpassword" name="password" placeholder="New Password"  autocomplete="off" require>
							@if ($errors->has('password'))
								  <span class="text-red">
									  <strong>{{ $errors->first('password') }}</strong>
								  </span>
							@endif
						</div>
						<div class="form-group">
						  <label for="repassword" class="">Confirm Password</label>
							<input type="password" class="form-control" id="editpassword_confirmation" name="password_confirmation" placeholder="Confirm Password"  autocomplete="off" require>
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
        <!-- Resetpassword Modal Ends -->  		
		
		
		
		

        <!-- Show and Action Modal Begins -->   
      <div class="modal fade" id="modal-default-show">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body" id="showStudentDetails">
             
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
                  "url": "{{ route('student.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "fullname" },
            { "data": "email" },
			{ "data": "parent" },
            { "data": "phonenumber" },
            { "data": "status" },			
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut();
 //Add Student Begins
  $("#frmAddStudent").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/student')}}",
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
					var parent_id=data.parent_id;
                  $('#modal-default').modal('toggle');
                  $("#frmAddStudent")[0].reset(); 
                  swal("Success", "Student created successfully.", "success");
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
    }));
  //Add Student Ends
  //Edit Student Form Begins
    $(document).on('click', '.edit', function()
    {
	  //alert('123');
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('student.edit')}}",
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
          $('#editfname').val(data.fname);
          $('#editlname').val(data.lname);
		  $('#editusername').val(data.email);
		  //$('#editpassword').val(data.password);
		  $('#editparent_id').val(data.parent_id);
		  $('#editgender').val(data.student_gender_dob.gender);
		  $('#editdob').val(data.student_gender_dob.dob);
		 var date = new Date(data.student_gender_dob.dob);
		 var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 ))
                    .toISOString()
                    .split("T")[0];
		  $('#editdob').val(dateString);

          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Student Form Ends
  //Update Student Begins
  $("#frmEditStudent").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('student.update')}}",
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
                  if(data.errors.fname){
                    errordetails+=data.errors.fname+ "\n";
                  }
                  if(data.errors.lname){
                    errordetails+=data.errors.lname+ "\n";
                  }
                  if(data.errors.email){
                    errordetails+=data.errors.email+ "\n";
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
                  swal("Failed", "Unable to update student, " + errordetails , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditStudent")[0].reset(); 
                  swal("Success", "Student updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Update parent, Please try again later.", "error");
              }          
       });
    }));
    //Update Student Ends



    //Delete Student Begins
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
                url: "student/delete/"+id,
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
                  swal("Success", "Student deleted successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to delete student." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Student Ends
	
	
	
	
	
	
//Show Student Form Begins
$(document).on('click', '.showstudent', function()
    {
		//alert('show parents');
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('student.show')}}",
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
          $('#showStudentDetails').html(data);
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
  //Show Student Form Ends	
	
    //Change Student Status Begins
    $(document).on('click', '.status', function()
    {
      swal({
        title: "Are you sure want to change the status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-action');
          if(action==2){
              url="{{url('/student/deactivate/')}}";
          }else{
              url="{{url('/student/active/')}}";
          }
          $.ajax({
            "url":url,
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
              swal("Success", "Student status updated successfully.", "success");
              InitTable();
              $(".loading").fadeOut();
              //Populating Form Data to Edit Ends
            },
              error: function(){
                $(".loading").fadeOut();
                swal("Failed", "Unable to update Student status." , "error");
              },          
          });
        } 
      });

    });
	






  //Resetpassword Edit Form Begins
    $(document).on('click', '.resetpassword', function()
    {
      var id = $(this).attr('data-id');
	  //alert(id);
      $.ajax({
        "url": "{{route('student.edit')}}",
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
          $('#modal-default-resetpassword').modal('toggle');
          $('#resetpasswordid').val(data.id);
          //$('#editpassword').val(data.password);
          //$('#editpassword_confirmation').val(data.email);
		  $('#studentName_span').text(data.fname);
		  

          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Resetpassword Edit Form Ends	
  //Update Resetpassword Begins
  $("#frmResetpasswordStudent").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('student.update')}}",
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
                  if(data.errors.password){
                    errordetails+=data.errors.password+ "\n";
                  }
			  
                  swal("Failed", "Unable to reset password, " + data.errors.password , "error");
                }
                else
                {
                  $('#modal-default-resetpassword').modal('toggle');
                  $("#frmResetpasswordStudent")[0].reset(); 
                  swal("Success", "Student Password Reset Successful.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to reset password, Please try again later.", "error");
              }          
       });
    }));
    //Update Resetpassword Ends	
	

  });
  

</script>

<!-- Select2 script START -->
<script>        
		 $(document).ready(function() { 
			  $('.select2').select2({
				  placeholder: "Select From DropDown",
				  multiple: false,
			  }); 
			  $('.select2').change(
				console.log("select2-console-log")
			  );
		  });

</script>
<!-- Select2 script ENDS -->
@endpush