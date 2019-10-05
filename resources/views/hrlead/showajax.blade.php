
<!-- Widget: user widget style 1 -->
	<div class="box box-widget widget-user">
	  <!-- Add the bg color to the header using any of the bg-* classes -->
	  <div class="widget-user-header bg-aqua-active">
		<h3 class="widget-user-username">{{$hrleads['name']}}</h3>
		<h5 class="widget-user-desc">Deparment: {{$hrleads->department->deptname}}</h5>
		<h5 class="widget-user-desc">Post Applied For: {{$hrleads->postapplied}}</h5>
	  </div>
	  <div class="widget-user-image">
		<img class="img-circle" src="{{asset('img/default_avatar_male.jpg')}}" alt="User Avatar">
	  </div>
	  <div class="box-footer">
		<div class="row">
		  <div class="col-sm-12">
			<div class="description-block">
			  <h5 class="description-header">{{$hrleads['mobile']}}</h5>
			  <span class="description-text">{{$hrleads['email']}}</span>
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
              <h3 class="box-title">Status Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed responsvie" id="statustable">
                <tbody>
					<tr>
                  <th>Status</th>
				  <th width="45%">Remarks</th>
				  <th>Created by</th>
				  <th>Created at</th>
				</tr>
				@foreach ($hrleadstatus as $item)
				<tr>
            <td>
						@switch($item->status)
						@case(0)
							<button class="btn btn-danger btn-sm">Rejected</button>
							@break
						@case(1)
							<button class="btn btn-info btn-sm">New</button>
							@break
						@case(2)
							<button class="btn btn-primary btn-sm">Not Picking Call</button>
							@break
						@case(3)
							<button class="btn btn-warning btn-sm">Incorrect Information</button>
							@break
						@case(4)
							<button class="btn btn-primary btn-sm">Call Made</button>
							@break
						@case(5)
							<button class="btn btn-success btn-sm">Interview Scheduled</button>
							@break
						@case(6)
							<button class="btn btn-warning btn-sm">Not Appeared</button>
							@break
						@case(7)
							<button class="btn btn-info btn-sm">Rescheduled</button>
							@break
						@case(8)
							<button class="btn btn-success btn-sm">Appeared</button>
							@break
						@case(9)
							<button class="btn btn-info btn-sm">Second Interview</button>
							@break
						@case(10)
							<button class="btn btn-primary btn-sm">Short listed</button>
							@break
						@case(11)
							<button class="btn btn-success btn-sm">Selected</button>
							@break
						@case(12)
							<button class="btn btn-danger btn-sm">Not Joined</button>
							@break
						@case(13)
							<button class="btn btn-success btn-sm">Joined</button>
							@break
						@default
							<button class="btn btn-danger btn-sm">Unknown</button>
					@endswitch
				  </td>
					  
                  <td>
						{{$item->remarks}}
						@if (!empty($item->recordinglink))
							<br>
							<audio controls>
								<source src="{{$item->recordinglink}}" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
						@endif
				  </td>
				  <td>{{$item->createdby->fname}} {{$item->createdby->lname}}</td>
				  <td>{{$item->created_at}}</td>
				</tr>
				@endforeach
			  </tbody>
			</table>
            </div>
			<!-- /.box-body -->
          </div>
		  <div class="box box-primary ">
				<div class="box-header">
				  <h3 class="box-title">New Status</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="{{url('/hrleads/status')}}" method="POST" id="frmAddHRLeadStatus">
					@csrf
					<input type="hidden" value="{{$hrleads['id']}}" name="hrlead_id">
					<input type="hidden" name="recordinglink" value="">
				  <div class="box-body">
				
					<div class="form-group col-md-6">
						<label>Select status</label>
						<select class="form-control" name="status" id="hrstatus" required>
							<option value="">Select </option>
							@if($hrleads['status'] >= 11)
								<option value="12">Not Joined</option>
								<option value="13">Joined</option>
							@elseif($showstatus==2)
								<option value="9">Second Interview</option>
								<option value="10">Short listed</option>
								<option value="11">Selected</option>
								<option value="0">Rejected</option>
							@elseif($showstatus==1)
								<option value="6">Not Appeared</option>
								<option value="7">Rescheduled</option>
								<option value="8">Appeared</option>
							@else
								<option value="2">Not Picking Call</option>
								<option value="3">Incorrect Information</option>
								<option value="4">Call Made</option>
								<option value="5">Interview Scheduled</option>
							@endif
						</select>
					</div>
					<div class="form-group col-md-6">
						<label>Remarks</label>
						<input type="text"  class="form-control" id="remarks" name="remarks" placeholder="Enter Remakrs" required autocomplete="off">
					</div>
					<div class="form-group col-md-6">
						<label>Post Applied For</label>
						<input type="text"  class="form-control" id="postapplied" name="postapplied" placeholder="Enter Post Applied For" value="{{$hrleads->postapplied}}" autocomplete="off" disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Schedule Interview:</label>
						<div class='input-group date' id='datetimepicker1'>
							<input type='text' class="form-control input-group-addon" name="interviewdate" id="interviewdate" placeholder="Enter Interview Date" autocomplete="off" disabled/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						<?php
							$mindate=date('Y').','.(date('m')-1).','.date('d');
						?>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker1').datetimepicker({
									sideBySide: true,
									minDate: new Date({{$mindate}})
								});
							});
						</script>
					
					</div>
					 <!-- <div id="applicationinfo" style="display:none;">
						<div class="clearfix"></div>
						
						<h3>Basic Information</h3>
						<div class="form-group col-md-6">
							<label>Position Sought</label>
							<input type="text"  class="form-control" id="positionsought" name="positionsought" placeholder="Enter Position Sought" required autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Desired Salary Range </label>
							<input type="text"  class="form-control" id="desiresalary" name="desiresalary" placeholder="Enter Desire Salary Range" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Are you Currently Employed </label>
							<select class="form-control" id="employed" name="employed">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Expecting Starting Date </label>
							<input type="date"  class="form-control" id="startingdate" name="startingdate" min="{{date('Y-m-d')}}" required autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Applied For Shift</label>
							<select class="form-control" id="shift" name="shift" required>
								<option value="Any">Any</option>
								<option value="Day">Day</option>
								<option value="Night">Night</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Qualification</label>
							<input type="text"  class="form-control" id="qualification" name="qualification" placeholder="Enter Qualification" required autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Marital Status</label>
							<select class="form-control" id="maritalstatus" name="maritalstatus" required>
								<option value="Single" selected>Single</option>
								<option value="Married">Married</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Date of Birth</label>
							<input type="date"  class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth" required autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Present Address</label>
							<input type="date"  class="form-control" id="paddress" name="paddress" placeholder="Enter Present Address" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>How did you hear about our company?</label>
							<input type="text"  class="form-control" id="howhear" name="howhear" placeholder="Enter How did you hear about our company?" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Why you want to do this job?</label>
							<input type="text"  class="form-control" id="whythisjob" name="whythisjob" placeholder="Enter Why you want to do this job?" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label>Upload Resume</label>
							<input type="file"  class="form-control" id="resume" name="resume" placeholder="Attach Resume" accept=".doc, .docx, .pdf,">
						</div>
						<h3>Work Experience</h3>
						<p>Please list your work experirence for the past years begining with your most recent job held.</p>
						<table class="table table-striped">
						<tbody><tr>
						<th style="width:10%;">Date From</th>
						<th style="width:10%;">Date to</th>
						<th style="width:20%;">Company Name</th>
						<th>Location</th>
						<th>Contact No</th>
						<th>Job Title</th>
						</tr>
						<tr>
						<td><input type="date"  class="form-control" name="experience[]['datefrom']" placeholder="Date From" autocomplete="off"></td>
						<td><input type="date"  class="form-control" name="experience[]['dateto']" placeholder="Date To" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['companyname']" placeholder="Company Name" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['location']" placeholder="Location" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['contactno']" placeholder="Contact No" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['jobtitle']" placeholder="Job Title" autocomplete="off"></td>
						</tr>
						<tr>
						<td><input type="date"  class="form-control" name="experience[]['datefrom']" placeholder="Date From" autocomplete="off"></td>
						<td><input type="date"  class="form-control" name="experience[]['dateto']" placeholder="Date To" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['companyname']" placeholder="Company Name" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['location']" placeholder="Location" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['contactno']" placeholder="Contact No" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['jobtitle']" placeholder="Job Title" autocomplete="off"></td>
						</tr>
						<tr>
						<td><input type="date"  class="form-control" name="experience[]['datefrom']" placeholder="Date From" autocomplete="off"></td>
						<td><input type="date"  class="form-control" name="experience[]['dateto']" placeholder="Date To" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['companyname']" placeholder="Company Name" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['location']" placeholder="Location" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['contactno']" placeholder="Contact No" autocomplete="off"></td>
						<td><input type="text"  class="form-control" name="experience[]['jobtitle']" placeholder="Job Title" autocomplete="off"></td>
						</tr>
					</tbody></table>

					<div class="form-group col-md-12">
							<label>Reason for leaving current job?</label>
							<input type="text"  class="form-control" id="leavingreason" name="leavingreason" placeholder="Enter reason for leaving current job?" autocomplete="off">
						</div>
					</div>-->
					
				</div>
				  <!-- /.box-body -->
				  <div class="box-footer">
					<button type="submit" id="alertbutton" class="btn btn-primary pull-right">Submit</button>
				  </div>
				</form>
			  </div>


<script>
		
$("#hrstatus").on('change',(function() {
	if($("#hrstatus").val()==5 || $("#hrstatus").val()==7 || $("#hrstatus").val()==8 || $("#hrstatus").val()==9){
		//$('#applicationinfo').hide();
		$("#interviewdate").prop("disabled", false); 
		$("#interviewdate").prop('required',true);
		$("#postapplied").prop("disabled", false); 
		$("#postapplied").prop("required", true);
		
	}else{
		//$('#applicationinfo').hide();
		$("#interviewdate").prop("disabled", true); 
		$("#interviewdate").prop("required", false);
		$("#postapplied").prop("disabled", true); 
		$("#postapplied").prop("required", false);
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
                  swal("Success", data.success, "success");
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