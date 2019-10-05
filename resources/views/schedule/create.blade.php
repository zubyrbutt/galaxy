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
              <h3 class="box-title">Add Schedule</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! url('/schedule'); !!}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Student</label>
					<div class="col-sm-6">
						<select id="studentID" name="studentID" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Student" style="width: 100%;" tabindex="-1" aria-hidden="true">
						  <option value='0'>Select Student</option>
						  @if ($students_list!='')
							  @foreach($students_list as $key => $student)
							  <option value="{{ $student->id }}">{{ $student->fname }} {{ $student->lname }}</option>
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
				</div>

				
				<div class="form-group">
                  <label for="pakTime" class="col-sm-3 control-label">Pakistan time</label>
                  <div class="col-sm-6">
                      <select name="pakTime" id="pakTime" onchange="javascript: changetextfunction()" class="form-control"><option value=""></option><option value="0" selected="selected">Select  </option><option value="1">00:00</option><option value="2">00:30</option><option value="3">01:00</option><option value="4">01:30</option><option value="5">02:00</option><option value="6">02:30</option><option value="7">03:00</option><option value="8">03:30</option><option value="9">04:00</option><option value="10">04:30</option><option value="11">05:00</option><option value="12">05:30</option><option value="13">06:00</option><option value="14">06:30</option><option value="15">07:00</option><option value="16">07:30</option><option value="17">08:00</option><option value="18">08:30</option><option value="19">09:00</option><option value="20">09:30</option><option value="21">10:00</option><option value="22">10:30</option><option value="23">11:00</option><option value="24">11:30</option><option value="25">12:00</option><option value="26">12:30</option><option value="27">13:00</option><option value="28">13:30</option><option value="29">14:00</option><option value="30">14:30</option><option value="31">15:00</option><option value="32">15:30</option><option value="33">16:00</option><option value="34">16:30</option><option value="35">17:00</option><option value="36">17:30</option><option value="37">18:00</option><option value="38">18:30</option><option value="39">19:00</option><option value="40">19:30</option><option value="41">20:00</option><option value="42">20:30</option><option value="43">21:00</option><option value="44">21:30</option><option value="45">22:00</option><option value="46">22:30</option><option value="47">23:00</option><option value="48">23:30</option></select>
                      @if ($errors->has('pakTime'))
                          <span class="text-red">
                              <strong>{{ $errors->first('pakTime') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

				<div class="form-group">
					  <label for="startDate" class="col-sm-3 control-label">Start Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" autocomplete="off" />
					  </div>      
				</div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Select</label>
                  <div class="col-sm-6">
					  <select class="form-control" id="slotDuration" name="slotDuration">
						<option value="1">30 mins</option>
						<option value="2">60 mins</option>
						<option value="3">90 mins</option>
					  </select>
					  @if ($errors->has('slotDuration'))
								  <span class="text-red">
									  <strong>{{ $errors->first('slotDuration') }}</strong>
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
								<option value="{{ $course->id }}" >{{ $course->courses }}</option>							
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
								<option value="{{ $key }}" >{{ $classType }}</option>							
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
					  <label for="agentId" class="col-sm-3 control-label">Agent</label>
					  <div class="col-sm-6">
							<select id="agentId" name="agentId" class="form-control m-bot15">
								<option value="0">Select Agent</option>	
							@if ($agents_list!='')
								@foreach($agents_list as $key => $agent_list)
								<option value="{{ $agent_list->id }}" >{{ $agent_list->fname }} {{ $agent_list->lname }}</option>							
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
                      <textarea class="form-control" rows="3" id="comments" name="comments" placeholder="Enter Comments for teacher..."></textarea>
				    </div>
				</div>

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add</button>
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
	
	//alert(course+" "+classType+" "+pakTime);

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
		document.getElementById("startDate").value='';
		document.getElementById("slotDuration").selectedIndex=0;
		document.getElementById("courseID").selectedIndex=0;
		document.getElementById("classType").selectedIndex=0;
		document.getElementById("teacherID").selectedIndex=0;
		
	}
</script>

@endsection