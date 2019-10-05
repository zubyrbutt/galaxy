
<!-- Widget: user widget style 1 -->
	<div class="box box-widget widget-user">
	  <!-- Add the bg color to the header using any of the bg-* classes -->
	  <div class="widget-user-header bg-aqua-active">
		<h3 class="widget-user-username">{{$parents['fname']}} {{$parents['lname']}}</h3>
		<h5 class="widget-user-desc"></h5>
	  </div>
	  <div class="widget-user-image">
		<img class="img-circle" src="{{asset('img/default_avatar_male.jpg')}}" alt="User Avatar">
	  </div>
	  <div class="box-footer">
		<div class="row">
		  <div class="col-sm-12">
			<div class="description-block">
			  <h5 class="description-header">{{$parents['phonenumber']}}</h5>
			  <span class="description-text">{{$parents['email']}}</span><br>
			  <span class="description-text"><b>EXT ID: </b>{{$parents->getextid['extId']}}</span>
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
              <h3 class="box-title">Student Invoice Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed responsvie" id="statustable">
                <tbody>
					<tr>
                  <th>ID</th>
				  <th>Name</th>
				  <th>SignIn Date</th>
				  <th>Dues Original</th>				  
				  <th>Dues USD</th>
				  <th>Status</th>				  
				</tr>
				
				@foreach ($schedules as $schedule)
				<tr>
					<td>{{$schedule->studentID}} </td>
					<td>{{$schedule->fname}} {{$schedule->lname}} </td>
					<td>{{$schedule->duedate}} </td>
					<td>{{$schedule->dues_original}} </td>					
					<td>{{$schedule->dues_usd}} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $schedule->currency_array)
							({{ $curr }})
							@endif
						@endforeach
					@endif
					</td>
					<td>{{$schedule->std_status}} </td>			
					
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