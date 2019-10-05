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
</style>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">End Class</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{{action('DailyScheduleController@endClassFunction', $id)}}" method="post" enctype="multipart/form-data">
            @csrf
<input name="_method" type="hidden" value="PATCH">			
            <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
				
				
				<!--<h3 class="box-title">Science Teacher:</h3>-->
				<div class="form-group">
					<label for="startDate" class="col-sm-3 control-label">Status:</label>
					<div class="col-sm-9">
						
						<!--	<input type="radio" name="status" id="status" value="0">
							<label for="status">Absent</label>
						
						<br>-->               
						
							<input type="radio" name="status" id="status" value="1">
							<label for="status">Present</label>
							@if ($errors->has('status'))
							  <span class="text-red">
								  <strong>{{ $errors->first('status') }}</strong>
							  </span>
							@endif							
						
					</div>
				</div>
				
				<!--Science Teachers Part 		start-->
				@if($subject_is_quran===0)
				<div class="form-group">
					  <label for="grade" class="col-sm-3 control-label">Grade</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="grade" name="grade" value="{{ $sch_garde }}" placeholder="" readonly='readonly'/>
							@if ($errors->has('grade'))
							  <span class="text-red">
								  <strong>{{ $errors->first('grade') }}</strong>
							  </span>
							@endif					  
					  </div>  						  
				</div>
				
				
				<div class="form-group">
					  <label for="bank_payment_image" class="col-sm-3 control-label">Select file</label>
					  <div class="col-sm-6">
						<input class='form-control' type="file" name="lecture_file" id="lecture_file">						
                        <span class="text-red" >Only JPG/PNG are allowed(200KB)</span>
							@if ($errors->has('lecture_file'))
							  <span class="text-red">
								  <strong>{{ $errors->first('lecture_file') }}</strong>
							  </span>
							@endif						
					  </div>						  
				</div>
				
				<!--Common section for Science and Quran teachers-->
				<hr>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Lesson Details</label>
				    <div class="col-sm-6">
                      <textarea class="form-control" rows="3" id="lessonDetails" name="lessonDetails" placeholder="Enter Lesson Details...">{{ old('lessonDetails') }}</textarea>
							@if ($errors->has('lessonDetails'))
							  <span class="text-red">
								  <strong>{{ $errors->first('lessonDetails') }}</strong>
							  </span>
							@endif					    
					</div>					
				</div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Comments</label>
				    <div class="col-sm-6">
                      <textarea class="form-control" rows="3" id="comments" name="comments" placeholder="Enter Comments...">{{ old('comments') }}</textarea>
							@if ($errors->has('comments'))
							  <span class="text-red">
								  <strong>{{ $errors->first('comments') }}</strong>
							  </span>
							@endif					    
					</div>					
				</div>
			
				@endif
				<!--Science Teachers Part 		end-->
				
				<hr>
				
				
				
				@if($subject_is_quran===1)
				<!--Quran Teachers Part 		start-->
				<!--<h3 class="box-title">Quran Teacher:</h3>-->
				<div class="form-group">
					  <label for="dua" class="col-sm-3 control-label">Dua</label>
					  <div class="col-sm-6">
							<select id="dua" name="dua" class="form-control m-bot15">
							@if ($duas!='')	
								<option value="0">Select Dua</option>	
								@foreach($duas as $key => $dua)
								<option value="{{ $dua->id }}" >{{ $dua->dua }}</option>							
								@endforeach
							@endif
							</select>
					  </div>					  
				</div>
				
				<div class="form-group">
					  <label for="prayer" class="col-sm-3 control-label">Prayer</label>
					  <div class="col-sm-6">
							<select id="prayer" name="prayer" class="form-control m-bot15">
							@if ($prayers!='')	
								<option value="0">Select prayer</option>	
								@foreach($prayers as $key => $prayer)
								<option value="{{ $prayer->id }}" >{{ $prayer->name }}</option>							
								@endforeach
							@endif
							</select>							
					  </div>
				</div>
				
				<div class="form-group">
					  <label for="kalima" class="col-sm-3 control-label">kalima</label>
					  <div class="col-sm-6">
							<select id="kalima" name="kalima" class="form-control m-bot15" >
								<option value="" selected="selected">Select Kalima </option>
                                <option value="Kalima 1">Kalima 1</option>
                                <option value="Kalima 2">Kalima 2</option>
                                <option value="Kalima 3">Kalima 3</option>
                                <option value="Kalima 4">Kalima 4</option>
                                <option value="Kalima 5">Kalima 5</option>
                                <option value="Kalima 6">Kalima 6</option>
							</select>
					  </div>
				</div>
				
				<div class="form-group">
					  <label for="lesson" class="col-sm-3 control-label">Lesson Recited</label>
					  <div class="col-sm-6">
							<select id="lesson" name="lesson" class="form-control m-bot15">
							@if ($syllabus!='')	
								<option value="0">Select syllabus</option>	
								@foreach($syllabus as $key => $syllabu)
								<option value="{{ $syllabu->id }}" >{{ $syllabu->lessonName }} [{{ $syllabu->arabicName }}]</option>							
								@endforeach
							@endif
							</select>							
					  </div>							
				</div>
				
				<div class="form-group">
					  <label for="surah" class="col-sm-3 control-label">Surah</label>
					  <div class="col-sm-6">
							<select id="surah" name="surah" class="form-control m-bot15">
							@if ($surahs!='')	
								<option value="0">Select surah</option>	
								@foreach($surahs as $key => $surah)
								<option value="{{ $surah->id }}" >{{ $surah->level }} </option>							
								@endforeach
							@endif
							</select>							
					  </div>					  
				</div>
				
				
				<div class="form-group">
                  <label for="verseFrom" class="col-sm-3 control-label">VerseFrom</label>
                  <div class="col-sm-6">
                      <select class="form-control m-bot15" name="verseFrom">
						@if ($verses!='')
							@foreach($verses as $key => $verse)
								<option value="{{ $key }}" >{{ $verse }}</option>    
							@endforeach
						@endif
					</select>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="verseTo" class="col-sm-3 control-label">VerseTo</label>
                  <div class="col-sm-6">
                      <select class="form-control m-bot15" name="verseTo">
						@if ($verses!='')
							@foreach($verses as $key => $verse)
								<option value="{{ $key }}" >{{ $verse }}</option>    
							@endforeach
						@endif
					</select>
                  </div>
                </div>
				@endif
				<!--Quran Teachers Part 		end-->				


				<div class="form-group">
					  <label for="record_link" class="col-sm-3 control-label">Recording link</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="record_link" name="record_link" placeholder="" />
							@if ($errors->has('record_link'))
							  <span class="text-red">
								  <strong>{{ $errors->first('record_link') }}</strong>
							  </span>
							@endif					  
					  </div>  					  
				</div>					
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/daily_schedule'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">End Class</button>
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
    //alert('Please select Class days.');
    $("select[name='classType']").focus();
    return false;
}
      var classType = $(this).val();
	  console.log(classType);
      var token = $("input[name='_token']").val();
	  //alert(usertype_teamlead);
	  $.ajax({
          url: "<?php echo route('/schedule/availableTeacher') ?>",
		  dataType : 'json',
          method: 'POST',
          data: {classType:classType,_token:token},
          success: function(data) {
			  console.log(token);
			  console.log(data);
            $("select[name='teacherID'").html('');
            $("select[name='teacherID'").html(data.options);
          }
      });
  });
</script>
@endsection