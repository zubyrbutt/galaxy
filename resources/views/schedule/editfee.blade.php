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
            <form class="form-horizontal" action="{{action('ScheduleController@updatefee', $id)}}" method="post" enctype="multipart/form-data" >
            @csrf
<input name="_method" type="hidden" value="PATCH">
        <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
				

		
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
				

				
<!--Setup fee update -->
				<div class="form-group">
					  <label for="startDate" class="col-sm-3 control-label">Dues Original</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="dues_original" name="dues_original" value="{{$edit_schedule->dues_original}}"  autocomplete="off" />
					  </div> 
					  @if ($errors->has('dues_original'))
						<span class="text-red">
							<strong>{{ $errors->first('dues_original') }}</strong>
						</span>
					  @endif
				</div>
				<div class="form-group">
					  <label for="startDate" class="col-sm-3 control-label">Dues(USD)</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="dues_usd" name="dues_usd" value="{{$edit_schedule->dues_usd}}"  autocomplete="off" />
					  </div>
					  @if ($errors->has('dues_usd'))
						<span class="text-red">
							<strong>{{ $errors->first('dues_usd') }}</strong>
						</span>
					  @endif					  
				</div>
				<div class="form-group">
					  <label for="currency" class="col-sm-3 control-label">Currency</label>
					  <div class="col-sm-6">
							<select id="currency_id" name="currency_id"  class="form-control m-bot15">
							@if ($currency!='')
								@foreach($currency as $key => $curr)
								<option value="{{ $key }}" {{ $key == $edit_schedule->currency_array ? 'selected=selected' : '' }} >{{ $curr }}</option>
								@endforeach
							@endif
							</select>
							@if ($errors->has('currency_id'))
							  <span class="text-red">
								  <strong>{{ $errors->first('currency_id') }}</strong>
							  </span>
							@endif							
					  </div>
				</div>				
				
				<div class="form-group">
					  <label for="duedate" class="col-sm-3 control-label">SignUp Date</label>
					  <div class="col-sm-6">
					  @if($edit_schedule->duedate==NULL)
					    <input type="date" class="form-control" id="duedate" name="duedate"  value="" />
					  @else
					    <input type="date" class="form-control" id="duedate" name="duedate"  value="{{$edit_schedule->duedate->format('Y-m-d')}}" />
					  @endif
					  </div>  
					  @if ($errors->has('duedate'))
						<span class="text-red">
							<strong>{{ $errors->first('duedate') }}</strong>
						</span>
					  @endif					  
				</div>
				<div class="form-group">
					  <label for="paydate" class="col-sm-3 control-label">Recurring Date</label>
					  <div class="col-sm-6">
					  @if($edit_schedule->paydate==NULL)
						<input type="date" class="form-control" id="paydate" name="paydate"  value="" />
					  @else
						<input type="date" class="form-control" id="paydate" name="paydate"  value="{{$edit_schedule->paydate->format('Y-m-d')}}" />  
					  @endif
					  </div> 
					  @if ($errors->has('paydate'))
						<span class="text-red">
							<strong>{{ $errors->first('paydate') }}</strong>
						</span>
					  @endif					  
				</div>					

              </div>
              </div>

        </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update Fee</button>
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
@endsection