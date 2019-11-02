
<!-- Widget: user widget style 1 -->
	<div class="box box-widget widget-user">
	  <!-- Add the bg color to the header using any of the bg-* classes -->
	  <div class="widget-user-header bg-aqua-active">
		<h3 class="widget-user-username">{{$student['fname']}} {{$student['lname']}}</h3>
		<h5 class="widget-user-desc"></h5>
	  </div>
	  <div class="widget-user-image">
		<img class="img-circle" src="{{asset('img/default_avatar_male.jpg')}}" alt="User Avatar">
	  </div>
	  <div class="box-footer">
		<div class="row">
		  <div class="col-sm-12">
			<div class="description-block">
			  <span class="description-text"><b>Username: </b>{{$student['email']}}</span><br>
			  <span class="description-text"><b>Gender:</b>
			                        @if ($student->student_gender_dob['gender'] === 1)
									Male
									@endif
									@if ($student->student_gender_dob['gender'] === 2)
									Female
									@endif
									</span><br>
			  <span class="description-text"><b>DOB: </b>{{$student->student_gender_dob['dob']->format('d-M-Y')}}</span><br>
			  

			</div>
			<!-- /.description-block -->
		  </div>
		</div>
		<!-- /.row -->
	  </div>
	</div>
	<!-- /.widget-user -->
	<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Student Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed responsvie" id="statustable">
                <tbody>
				<tr>
                  <th>Name</th>
				  <th>Username</th>
				  {{-- <th>Parent</th> --}}
				  <th>Ext</th>
				  <th>Created by</th>
				  <th>Created at</th>
				</tr>
				@foreach ($student_details as $student_detail)
				<tr>
				  <td>{{$student_detail['fname']}} {{$student_detail['lname']}}</td>
				  <td>{{$student_detail['email']}}</td>
				  {{-- <td>{{$student->parent_name['fname']}} {{$stud ent->parent_name['lname']}}</td> --}}
				  <td>{{$student->parent_name->getextId['extId']}}</td>
				  <td>{{$student_detail->createdby_self['fname']}} {{$student_detail->createdby_self['lname']}}</td>
				  <td>{{$student_detail['created_at']->format('d-m-Y')}}</td>
				</tr>
				@endforeach
			  </tbody>
			</table>
            </div>
			<!-- /.box-body -->
          </div>

<script>
		
$("#hrstatus").on('change',(function() {
	if($("#hrstatus").val()==5 || $("#hrstatus").val()==7 || $("#hrstatus").val()==8 || $("#hrstatus").val()==9){
		$("#interviewdate").prop("disabled", false); 
		$("interviewdate").attr("required", true);
		//$('#applicationinfo').hide();
	}else{
		//$('#applicationinfo').hide();
		$("#interviewdate").prop("disabled", true); 
		$("interviewdate").attr("required", false);
	}
}));

$("#frmAddHRLeadStatus").on('submit',(function(e) {
	e.preventDefault();	
	$.ajax({
         url: "{{url('/hrleads/status')}}",
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
                  if(data.errors.status){
                    errordetails+=data.errors.status+ "\n";
                  }
                  if(data.errors.remarks){
                    errordetails+=data.errors.remarks+ "\n";
                  }
                  swal("Failed", "Unable to Create.\n " + errordetails , "error");
                }
                else
                {
                  //$('#modal-default').modal('toggle');
                  
                  swal("Success", "Status updated successfully.", "success");
				  var dt = new Date();
				  var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
				  var statusdata ='<tr><td>'+$('#hrstatus option:selected').text() + '</td> <td> ' + $('#remarks').val() + ' </td><td>{{auth()->user()->fname}} {{auth()->user()->lname}}</td>'+ ' </td><td>' + time +'</td></tr>';
				  $('#statustable').append(statusdata);
				  
				  $("#frmAddHRLeadStatus")[0].reset(); 
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
 
</script>