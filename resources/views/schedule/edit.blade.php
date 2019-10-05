@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
    <div class="box box-info">


            <div class="box-header with-border">
              <h3 class="box-title">Edit Schedule </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{{action('ScheduleController@update', $id)}}" method="post" enctype="multipart/form-data" >
            @csrf
<input name="_method" type="hidden" value="PATCH">
        <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
				

				<!--<div class="form-group">
					<label class="col-sm-3 control-label">Student</label>
					<div class="col-sm-6">
						<select id="studentID" name="studentID" disabled="disabled" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Student" style="width: 100%;" tabindex="-1" aria-hidden="true">
						  <option value=''>Select Student</option>
						  @if ($students_list!='')
							  @foreach($students_list as $key => $student)
							  <option value={{$student->id}} {{ $student->id == $edit_schedule->studentID ? 'selected=selected' : '' }} > {{ $student->fname }} {{ $student->lname }}</option>
							  @endforeach
						  @endif
						</select>
						@if ($errors->has('studentID'))
                          <span class="text-red">
                              <strong>{{ $errors->first('studentID') }}</strong>
                          </span>
                        @endif
					</div>
					<!-- /.form-group -->			
				<!--</div>-->		
				<div class="form-group">
					<label class="col-sm-3 control-label">Student</label>
					<div class="col-sm-6">
						<input class="form-control" id="studentNAME" name="studentNAME" type='text' readonly='readonly' value="{{ $edit_schedule->studentname->fname }} {{ $edit_schedule->studentname->lname }}" />
						<input id="studentID" name="studentID" type='hidden' value={{ $edit_schedule->studentID }} />
						@if ($errors->has('studentID'))
                          <span class="text-red">
                              <strong>{{ $errors->first('studentID') }}</strong>
                          </span>
                        @endif
					</div>
					<!-- /.form-group -->			
				</div>
				
				<div class="form-group">
                  <label for="pakTime" class="col-sm-3 control-label">Pakistan time</label>
                  <div class="col-sm-6">
                      <select name="pakTime" id="pakTime" onchange="javascript: changetextfunction()" class="form-control">
						@if($pakTime!='')
							@foreach($pakTime as $key => $pTime)
								<option value="{{ $key }}" >{{ $pTime }}</option>
							@endforeach
						@endif
					  </select>
					  @if ($errors->has('pakTime'))
                          <span class="text-red">
                              <strong>{{ $errors->first('pakTime') }}</strong>
                          </span>
                      @endif
					<label for="OLDpakTime" class="control-label">Old Pakistan time:<span class="text-green">{{ $edit_schedule->startTime }} </span></label>					  
                  </div>
                </div>
		

				<div class="form-group">
					  <label for="startDate" class="col-sm-3 control-label">Start Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="startDate" name="startDate" value="{{$edit_schedule->startDate->format('Y-m-d')}}"  autocomplete="off" />
					  </div>      
				</div>
				<div class="form-group">
					  <label for="endDate" class="col-sm-3 control-label">End Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="endDate" name="endDate" value="{{$edit_schedule->endDate->format('Y-m-d')}}"  autocomplete="off" />
					  </div>      
				</div>				
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Class Duration</label>
                  <div class="col-sm-6">
					<select class="form-control" id="slotDuration" name="slotDuration">
						<option value="0">Select Duration</option>
						<option value="1" {{ $slot == 1 ? 'selected=selected' : '' }} >30 Mins</option>
						<option value="2" {{ $slot == 2 ? 'selected=selected' : '' }} >60 Mins</option>
						<option value="3" {{ $slot == 3 ? 'selected=selected' : '' }} >90 Mins</option>
					</select>					  
					  @if ($errors->has('courseID'))
								  <span class="text-red">
									  <strong>{{ $errors->first('courseID') }}</strong>
								  </span>
					  @endif
				  </div>
                </div>
				
				<div class="form-group">
					  <label for="courseID" class="col-sm-3 control-label">Course</label>
					  <div class="col-sm-6">
							<select id="courseID" name="courseID" class="form-control m-bot15">
								<option value="0">Select Course</option>	
							@if ($course_list!='')
								@foreach($course_list as $key => $course)
								<option value="{{ $key+1 }}" {{ $key+1 == $edit_schedule->courseID ? 'selected=selected' : '' }} >{{ $course->courses }}</option>							
								@endforeach
							@endif
							</select>
							@if ($errors->has('courseID'))
							  <span class="text-red">
								  <strong>{{ $errors->first('courseID') }}</strong>
							  </span>
							@endif
					  </div>
				</div>
				
				<div class="form-group">
				  <label for="classType" class="col-sm-3 control-label">Class Type</label>
				  <div class="col-sm-6">
						<select id="classType" name="classType" class="form-control m-bot15">
						@if ($plan!='')
							@foreach($plan as $key => $classType)
							<option value="{{ $key }}" {{ $key == $edit_schedule->classType ? 'selected=selected' : '' }} >{{ $classType }}</option>							
							@endforeach
						@endif
						</select>
						@if ($errors->has('classType'))
						  <span class="text-red">
							  <strong>{{ $errors->first('classType') }}</strong>
						  </span>
					  @endif
				  </div>
				</div>

				<div class="form-group">
                  <label for="teacherID" class="col-sm-3 control-label">Teacher</label>
                  <div class="col-sm-6">
					<select class="form-control m-bot15" id="teacherID" name="teacherID">
					
					</select>
					  @if ($errors->has('teacherID'))
                          <span class="text-red">
                              <strong>{{ $errors->first('teacherID') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>		

				<div class="form-group">
                  <label for="prevteacherID" class="col-sm-3 control-label"></label>
                  <div class="col-sm-6">
<label for="prevteacherID" class="control-label">{{ $edit_schedule->teachername['fname'] }} {{ $edit_schedule->teachername['lname'] }}<span class="text-green"></span></label>
<input id="prevteacherID" name="prevteacherID" type='hidden' value={{ $edit_schedule->teacherID }} />
						@if ($errors->has('prevteacherID'))
							  <span class="text-red">
								  <strong>{{ $errors->first('prevteacherID') }}</strong>
							  </span>
						@endif
                  </div>
                </div>				
				
				<!--<div class="form-group">
					  <label for="skypetext" class="col-sm-3 control-label">Skype</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="skypetext" name="skypetext" placeholder="Enetr skype id" autocomplete="off" />
					  </div>  
					  @if ($errors->has('skypetext'))
                          <span class="text-red">
                              <strong>{{ $errors->first('skypetext') }}</strong>
                          </span>
                      @endif
				</div>-->

				<div class="form-group">
					  <label for="agentId" class="col-sm-3 control-label">Agent</label>
					  <div class="col-sm-6">
							<select id="agentId" name="agentId" class="form-control m-bot15">
								<option value="0">Select Agent</option>	
							@if ($agents!='')
								@foreach($agents as $key => $agent)
								<option value="{{ $agent->id }}" {{ $agent->id == $edit_schedule->agentId ? 'selected=selected' : '' }} >{{ $agent->fname }}</option>
								@endforeach
							@endif
							</select>
							@if ($errors->has('agentId'))
							  <span class="text-red">
								  <strong>{{ $errors->first('agentId') }}</strong>
							  </span>
							@endif
					  </div>
				</div>
				
			
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Comments</label>
				    <div class="col-sm-6">
                      <textarea class="form-control" rows="3" id="comments" name="comments" placeholder="Enter Comments for teacher..." >{{ $edit_schedule->comments }}</textarea>
				    </div>
				</div>
				

              </div>
              </div>

        </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
<script>
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
</script>

<script type="text/javascript">
  $("select[name='pakTime']").change(function(){
/* 	$("select[name='classType'")[0].selectedIndex = 0;
    alert('Time has been reset.');
    $("select[name='classType']").focus(); */
  });
</script>

<script type="text/javascript">
  $("select[name='classType']").change(function(){
	
	if ($("select[name='classType']")[0].selectedIndex <= 0) {
		$("select[name='teacherID'").html('');
    alert('Please select Class days.');
    $("select[name='classType']").focus();
    return false;
}

	var course=document.getElementById('courseID').value;
	var classType=document.getElementById('classType').value;
	var pakTimelist=document.getElementById('pakTime');
	var pakTime = pakTimelist.options[pakTimelist.selectedIndex].text;
	var zoneID=0; 
	var slotDuration=document.getElementById('slotDuration').value
	
      var classType = $(this).val();
	  console.log(classType);
      var token = $("input[name='_token']").val();
	  //alert(usertype_teamlead);
	  $.ajax({
          url: "<?php echo route('/schedule/availableTeacher') ?>",
		  dataType : 'json',
          method: 'POST',
          data: {classType:classType,slotDuration:slotDuration,course:course,pakTime:pakTime,_token:token},
          success: function(data) {
			  console.log(token);
			  console.log(data);
            $("select[name='teacherID'").html('');
            $("select[name='teacherID'").html(data.options);
          }
      });
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
<script>        
	function changetextfunction()
	{
		//document.getElementById("startDate").value='';
		document.getElementById("slotDuration").selectedIndex=0;
		//document.getElementById("courseID").selectedIndex=0;
		document.getElementById("classType").selectedIndex=0;
		document.getElementById("teacherID").selectedIndex=0;
		
	}
</script>
@endsection