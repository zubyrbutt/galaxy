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




.multiselect-container{

  max-height:200px;
  overflow:auto;
  width:100%;
  
}
</style>
<!-- script for multi select under ADD COURSE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Course</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! url('/teacher_course'); !!}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body" >
				<div class="row">
				  <div class="col-md-8">	
					
					<div class="form-group">
					  <label for="teacherID" class="col-sm-3 control-label">Teachers List</label>
					  <div class="col-sm-6">
						<select name="teacherID" class="form-control select2 select2-hidden-accessible" data-placeholder="Select Teacher" style="width: 100%;" tabindex="-1" aria-hidden="true">
							@if ($teachers_list!='')
								@foreach($teachers_list as $key => $teacher_list)
									<option value="{{ $teacher_list->id }}" >{{ $teacher_list->fname }} {{ $teacher_list->lname }}</option>    
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
					

					<div class="form-group">
					  <label for="courseID" class="col-sm-3 control-label">Course</label>
					  <div class="col-sm-6">
							<select id="courseID" name="courseID[]" class="form-control m-bot15" multiple >
							@if ($course_list!='')
								@foreach($course_list as $key => $course)
									@if ($key>0)
									<option value="{{ $key }}">{{ $course }}</option>
									@endif
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
					
				  </div>
				</div>
            </div>
			
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/teacher_course'); !!}" class="btn btn-default">Cancel</a>
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







$(document).ready(function() {
$('#courseID').multiselect({
nonSelectedText: 'Select Course',
buttonWidth:'100%'
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
@endsection