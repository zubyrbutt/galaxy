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
              <h3 class="box-title">Edit Timings </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{{action('TeacherTimingController@update', $id)}}" method="post" enctype="multipart/form-data">
            @csrf
<input name="_method" type="hidden" value="PATCH">
                        <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
	
				
				<div class="form-group">
                  <label for="sun" class="col-sm-3 control-label">Days</label>
                  <div class="col-sm-9">
                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Sunday</button>
                    <input type="checkbox" class="hidden"  name="sun" value="1" {{ $edit_timing->sun==1 ? "checked" : "" }}>
                    </span>
                  
					<span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Monday</button>
                    <input type="checkbox" class="hidden"  name="mon" value="1" {{ $edit_timing->mon==1 ? "checked" : "" }}>
                    </span>
					
					<span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Tuesday</button>
                    <input type="checkbox" class="hidden"  name="tue" value="1" {{ $edit_timing->tue==1 ? "checked" : "" }}>
                    </span>
					
					<span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Wednesday</button>
                    <input type="checkbox" class="hidden"  name="wed" value="1" {{ $edit_timing->wed==1 ? "checked" : "" }}>
                    </span>
					
					<span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Thursday</button>
                    <input type="checkbox" class="hidden"  name="thu" value="1" {{ $edit_timing->thu==1 ? "checked" : "" }}>
                    </span>
					
					<span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Friday</button>
                    <input type="checkbox" class="hidden"  name="fri" value="1" {{ $edit_timing->fri==1 ? "checked" : "" }}>
                    </span>
					
					<span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Saturday</button>
                    <input type="checkbox" class="hidden"  name="sat" value="1" {{ $edit_timing->sat==1 ? "checked" : "" }}>
                    </span>
					
				  </div>
                </div>
				
				
				
				
				

				<div class="form-group">
                  <label for="startTime" class="col-sm-3 control-label">Start time</label>
                  <div class="col-sm-6">
						<select class="form-control m-bot15" id="startTime" name="startTime">
								@if ($time!='')
									@foreach($time as $key => $time_value)
										<option value=<?php echo $key; ?> {{ $key == $edit_timing->startTime ? 'selected=selected' : '' }}>{{ $time_value }}</option>    
									@endforeach
								@endif
						</select>
						@if ($errors->has('startTime'))
                          <span class="text-red">
                              <strong>{{ $errors->first('startTime') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="endTime" class="col-sm-3 control-label">End time</label>
                  <div class="col-sm-6">
                      <select class="form-control m-bot15" id="endTime" name="endTime">
								@if ($time!='')
									@foreach($time as $key => $time_value)
										<option value=<?php echo $key; ?> {{ $key == $edit_timing->endTime ? 'selected=selected' : '' }}>{{ $time_value }}</option>    
									@endforeach
								@endif
					  </select>
						@if ($errors->has('endTime'))
                          <span class="text-red">
                              <strong>{{ $errors->first('endTime') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
		
				<div class="form-group">
					  <label for="teacherID" class="col-sm-3 control-label">Teacher</label>
					  <div class="col-sm-6">
						<select id="teacherID" name="teacherID" class="form-control m-bot15">
							@if ($teachers_list!='')
								@foreach($teachers_list as $key => $teacher)
									@if ($key>=0)
									<option value={{$teacher->id}} {{ $teacher->id == $edit_timing->teacher_id ? 'selected=selected' : '' }}>{{ $teacher->fname }} {{ $teacher->lname }} </option>    
									@endif
								@endforeach
							@endif
						</select>
						@if ($errors->has('teacherID'))
							  <span class="text-red">
								  <strong>{{ $errors->first('teacherID') }}</strong>
							  </span>
						  @endif
					  </div>
				</div>

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/teacher_timing'); !!}" class="btn btn-default">Cancel</a>
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
@endsection