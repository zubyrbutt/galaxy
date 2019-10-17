@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
<script>
$( document ).ready(function() {
swal("Success", "{{session('success')}}", "success");
});
</script>
@endif
<div class="box box-info" >
  <div class="box-header with-border">
    <h3 class="box-title">Lead Close : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  {{-- <form class="form-horizontal" action="{!! url('leads/storerecording'); !!}" method="post" enctype="multipart/form-data"> --}}
    @csrf
    <div class="box-body" >
      
      <div class="row">
        <!--lead_id against which recording will be stored -->
        <input name='lead_id' type='hidden' value='<?php echo $lead_id; ?>' />
        <div class="col-md-12">
          <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Lead Close By</label>
            <div class="col-sm-9">
              <select class="form-control" id="lead_close_by" name="lead_close_by" required="">
                <option value="" selected="" disabled="">Lead Close By</option>
                <option value="class">Class</option>
                <option value="project">Project</option>
              </select>
              @if ($errors->has('lead_close_by'))
              <span class="text-red">
                <strong>{{ $errors->first('lead_close_by') }}</strong>
              </span>
              @endif
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      {{--  <a href="{!! url('/leads/'); !!}/{{$lead_id}}" class="btn btn-default">Cancel</a>
      <button type="submit" class="btn btn-info pull-right">Upload</button> --}}
    </div>
    <!-- /.box-footer -->
  {{-- </form> --}}
</div>


{{-- Close by Project --}}
<div class="box box-info" id="lead-project" style="@if( !session('lead_close_form')) display: none; @endif">

 
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" action="{!! url('/leads/close'); !!}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="box box-info" >
      <div class="box-header with-border">
        <h3 class="box-title">Upload Recording for Lead : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      {{-- <form class="form-horizontal" action="{!! url('leads/storerecording'); !!}" method="post" enctype="multipart/form-data"> --}}
        {{--           @csrf --}}
        <div class="box-body" >
          
          <div class="row">
            <!--lead_id against which recording will be stored -->
            <input name='lead_id' type='hidden' value='<?php echo $lead_id; ?>' />
            <div class="col-md-12">
              <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="off" value="{{ old('title') }}" require >
                  @if ($errors->has('title'))
                  <span class="text-red">
                    <strong>{{ $errors->first('title') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="link" class="col-sm-3 control-label">Link</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ old('title') }}" autocomplete="off" require>
                  @if ($errors->has('link'))
                  <span class="text-red">
                    <strong>{{ $errors->first('link') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              <div class="form-group">
                <label for="note" class="col-sm-3 control-label">Note</label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="note" name="note" placeholder="Any note, please put here.">{{old('note')}}</textarea>
                  @if ($errors->has('note'))
                  <span class="text-red">
                    <strong>{{ $errors->first('note') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              <div class="form-group">
                <label for="recording_file" class="col-sm-3 control-label">Select file</label>
                <div class="col-sm-9">
                  <input class='form-control' type="file" name="recording_file" id="recording_file">
                  <span class="text-red">Only MP3 files are allowed</span>
                  @if ($errors->has('recording_file'))
                  <span class="text-red">
                    <strong>{{ $errors->first('recording_file') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        {{-- <div class="box-footer">
          <a href="{!! url('/leads/'); !!}/{{$lead_id}}" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Upload</button>
        </div> --}}
        <!-- /.box-footer -->
      {{-- </form> --}}
    </div>
    
     <div class="box-header with-border" >
      <h3 class="box-title">Project</h3>
    </div>
    <input type="hidden"  name="customer_id"  value="{{ Request::segment(3) }}">
    <input type="hidden" name="lead_id" value="{{ Request::segment(4) }}">
    <div class="box-body" >
      
      <div class="row">
        <!-- Customer Info -->
        <div class="col-md-12">
          <div class="form-group">
            <label for="user_id" class="col-sm-3 control-label">Select Customer</label>
            <div class="col-sm-9">
              <select class="form-control" name="user_id" id="user_id">
                @if(count($customers) > 0)
                @foreach($customers as $customer)
                <option value="{{$customer->id}}" {{(isset($customerid) && $customerid==$customer->id ) ? "selected": ""}} >{{$customer->fname}} {{$customer->lname}}</option>
                @endforeach
                @else
                <option value="">None</option>
                @endif
              </select>
              @if ($errors->has('user_id'))
              <span class="text-red">
                <strong>{{ $errors->first('user_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="lead_id" class="col-sm-3 control-label">Select Lead</label>
            <div class="col-sm-9">
              <select class="form-control" name="lead_id" id="lead_id">
                @if(count($leads) > 0)
                <option value="">None</option>
                @foreach($leads as $lead)
                <option value="{{$lead->id}}" {{(isset($leadid) && $leadid==$lead->id ) ? "selected": ""}}>{{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</option>
                @endforeach
                @else
                <option value="">None</option>
                @endif
              </select>
              @if ($errors->has('lead_id'))
              <span class="text-red">
                <strong>{{ $errors->first('lead_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="projectName" class="col-sm-3 control-label">Project Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name" value="{{ old('projectName') }}" autocomplete="off" require>
              @if ($errors->has('projectName'))
              <span class="text-red">
                <strong>{{ $errors->first('projectName') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="projectDescription" class="col-sm-3 control-label">Project Description</label>
            <div class="col-sm-9">
              <textarea rows="10" class="form-control" id="projectDescription" name="projectDescription" placeholder="Description" require >{{old('projectDescription')}}</textarea>
              @if ($errors->has('projectDescription'))
              <span class="text-red">
                <strong>{{ $errors->first('projectDescription') }}</strong>
              </span>
              @endif
            </div>
          </div>
          
          <!-- checkboxes -->
          <div class="form-group">
            <label for="startDate" class="col-sm-3 control-label">Project Type:</label>
            <div class="col-sm-9">
              
              <input type="radio" name="projectType" value="1">
              <label for="projectType">Fixed</label>
              
              <br>
              
              <input type="radio" name="projectType" value="2">
              <label for="projectType">Monthly</label>
              
            </div>
          </div>
          <div class="form-group">
            <label for="amount" class="col-sm-3 control-label">Amount:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="{{ old('amount') }}" autocomplete="off" require>
              @if ($errors->has('amount'))
              <span class="text-red">
                <strong>{{ $errors->first('amount') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <!-- Social links -->
          <div class="form-group">
            <label for="startDate" class="col-sm-3 control-label">Start Date:</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="startDate" name="startDate" value="{{ old('startDate') }}" placeholder="Start Date" autocomplete="off" />
            </div>
            
          </div>
          <div class="form-group">
            <label for="endDate" class="col-sm-3 control-label">End Date</label>
            <div class="col-sm-9" >
              <input type="date" class="form-control" id="endDate" name="endDate" value="{{ old('endDate') }}" placeholder="End Date" autocomplete="off"  />
            </div>
          </div>
          <!-- checkboxes -->
          <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
              <span class="button-checkbox">
                <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;SMM</button>
                <input type="checkbox" class="hidden"  name="isSMM" value="1">
              </span>
              <span class="button-checkbox">
                <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;iOS App</button>
                <input type="checkbox" class="hidden"  name="isiOS" value="1">
              </span>
              <span class="button-checkbox">
                <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Android App</button>
                <input type="checkbox" class="hidden"  name="isAndroid" value="1">
              </span>
              <span class="button-checkbox">
                <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Website</button>
                <input type="checkbox" class="hidden"  name="isWeb" value="1">
              </span>
              <span class="button-checkbox">
                <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Custom Solution</button>
                <input type="checkbox" class="hidden"  name="isCustom" value="1">
              </span>
            </div>
          </div>
          {{--<div class="form-group">
            <label for="endDate" class="col-sm-3 control-label">Assign To Staff</label>
            <div class="col-sm-9" >
              @foreach($data['user'] as $row)
              <div class="checkbox" style="width:25%;float:left;">
                <label>
                  <input type="checkbox" name="staff_id[]" value="{{ $row->id }}" >
                  {{ $row->fname }} {{  $row->lname }}
                </label>
              </div>
              @endforeach
            </div>
          </div>--}}
          <div class="form-group">
            <label for="staff_id" class="col-sm-3 control-label">Assign To Staff</label>
            <div class="col-sm-9" >
              <select class="form-control select2" name="staff_id[]" multiple="multiple" data-placeholder="Select a Team members" style="width: 100%;">
                @foreach($data['user'] as $row)
                <option value="{{ $row->id }}">{{ $row->fname }} {{  $row->lname }} ({{$row->department->deptname}} - {{$row->designation->name}})</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- /.box-body -->
    <div class="box-footer">
      <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
      <button type="submit" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>


{{-- Close by Project --}}


{{-- Close by Class --}}            {{-- style="@if( !session('lead_close_form')) display: none; @endif" --}}     
<div class="box box-info" id="lead-class" style="display: none;">

 
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" action="{!! url('/leads/close'); !!}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="box box-info" >
      <div class="box-header with-border">
        <h3 class="box-title">Upload Recording for Lead : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      {{-- <form class="form-horizontal" action="{!! url('leads/storerecording'); !!}" method="post" enctype="multipart/form-data"> --}}
        {{--           @csrf --}}
        <div class="box-body" >
          
          <div class="row">
            <!--lead_id against which recording will be stored -->
            <input name='lead_id' type='hidden' value='<?php echo $lead_id; ?>' />
            <div class="col-md-12">
              <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="off" value="{{ old('title') }}" require >
                  @if ($errors->has('title'))
                  <span class="text-red">
                    <strong>{{ $errors->first('title') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="link" class="col-sm-3 control-label">Link</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ old('title') }}" autocomplete="off" require>
                  @if ($errors->has('link'))
                  <span class="text-red">
                    <strong>{{ $errors->first('link') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              <div class="form-group">
                <label for="note" class="col-sm-3 control-label">Note</label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="note" name="note" placeholder="Any note, please put here.">{{old('note')}}</textarea>
                  @if ($errors->has('note'))
                  <span class="text-red">
                    <strong>{{ $errors->first('note') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              <div class="form-group">
                <label for="recording_file" class="col-sm-3 control-label">Select file</label>
                <div class="col-sm-9">
                  <input class='form-control' type="file" name="recording_file" id="recording_file">
                  <span class="text-red">Only MP3 files are allowed</span>
                  @if ($errors->has('recording_file'))
                  <span class="text-red">
                    <strong>{{ $errors->first('recording_file') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        {{-- <div class="box-footer">
          <a href="{!! url('/leads/'); !!}/{{$lead_id}}" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Upload</button>
        </div> --}}
        <!-- /.box-footer -->
      {{-- </form> --}}
    </div>
    

    <div class="box-header with-border">
              <h3 class="box-title">Add Schedule</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! url('/closeByClass'); !!}" method="post" enctype="multipart/form-data">
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
                    <label for="gendar" class="col-sm-3 control-label">Type</label>
            
                    <div class="col-sm-9">
                        <input class="group_type" type="radio" id="type_individual" name="type" value="individual" checked="">
                        <label for="type_individual">Individual</label>
                        <input class="group_type" type="radio" id="type_group" name="type" value="group"> 
                        <label for="type_group">Group</label>
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


{{-- Close by Class --}}






<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(function() {
$('.select2').select2();
});
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
<script>
jQuery('#lead_close_by').change(function(){
if(jQuery(this).val() == 'class'){
jQuery('#lead-project').slideUp();
jQuery('#lead-recording').slideUp();

jQuery('#lead-class').slideDown();
jQuery('#lead-recording-class').slideDown();
}else if(jQuery(this).val() == 'project'){

jQuery('#lead-class').slideUp();
jQuery('#lead-recording-class').slideUp();

jQuery('#lead-project').slideDown();
jQuery('#lead-recording').slideDown();

}
});
</script>

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
  
  jQuery('.group_type[name="type"]').change(function(){
    jQuery('#classType option:first-child').prop('selected',true);
  });

  $("select[name='classType']").change(function(){
  
  if ($("select[name='classType']")[0].selectedIndex <= 0) {
    $("select[name='teacherID'").html('');
    alert('Please select Class days.');
    $("select[name='classType']").focus();
    return false;
}

  var course=document.getElementById('courseID').value;
  var classType=document.getElementById('classType').value;
  var group_type=jQuery('.group_type[name="type"]:checked').val();
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
          data: {classType:classType,slotDuration:slotDuration,course:course,pakTime:pakTime,_token:token,type:group_type},
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