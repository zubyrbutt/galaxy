@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif

<style>
  .select2-container{
    width: 100% !important;
  }
</style>
 <form class="form-horizontal" action="{!! url('/leads'); !!}" method="post" enctype="multipart/form-data">
    <div class="box box-info">


            @csrf

            <div class="box-header with-border">
              <h3 class="box-title">Add New Lead</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
          <div class="box-body" >
			
            <div class="row">			
                <div class="col-md-12">
                    <h3 class="box-title">Customer Information</h3>
                </div>
			<!-- Customer Info -->

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description" class="col-sm-3 control-label">Assigned To</label>
                        <div class="col-sm-9">
                            <select name="agentid" class="form-control select2" data-placeholder="Select Satff" width="100%">
                            @foreach($agents as $agent)
                                <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                            @endforeach                
                            </select>
                        </div>
                  </div>
              
                  <div class="form-group" >
                      <label class="col-sm-3 control-label">Select Customer</label>
                       <div class="col-sm-9">
                          <input class="customer_select" type="radio" id="addnew" name="customer_select" value="add_new" checked="">
                          <label for="add_new">Add New</label>
                          <span style="margin-left: 15px">
                            <input class="customer_select" type="radio" id="existing" name="customer_select" value="existing"> 
                            <label for="type_group">Existing Customer</label>
                          </span>
                      </div>
                  </div>
                </div>

              <input type="hidden" id="customer_id" name="customer_id" value="0">

              <div class="col-md-12" id="select_customer" style="display: none;">
                <div class="form-group" >
                  <label for="" class="col-sm-3"></label>
                  <div class="col-sm-6">
                  <select class="form-control m-bot15 select2" id="customer" >
                    <option value="0" disabled="" selected="">Select Customer</option>
                    @foreach($users as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->fname }} {{ $customer->lname }}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('customer_id'))
                          <span class="text-red">
                              <strong>{{ $errors->first('customer_id') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-md-12" id="addnew_customer" >
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">First Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ old('fname') }}" require >
                    @if ($errors->has('fname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('fname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="lname" class="col-sm-3 control-label">Last Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}" autocomplete="off" require>
                    @if ($errors->has('lname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('lname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                    @if ($errors->has('email'))
                          <span class="text-red">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}" autocomplete="off" require>
                    @if ($errors->has('phonenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('phonenumber') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
			     </div>
           {{-- Lead Close By ========================================================= --}}
       
            <!--lead_id against which recording will be stored -->
           
            <div class="col-md-12">
              <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Lead Type</label>
                <div class="col-sm-9">
                  <select class="form-control" id="lead_close_by" name="lead_close_by" required="">
                    <option value="" selected="" disabled="">Lead Type</option>
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
      
           {{-- Lead Close By ========================================================= --}}
			<!-- Lead Info -->	
    
</div>

      {{-- Close by Project --}}
<div class="box box-info" id="lead-project" style="@if( !session('lead_close_by_project')) display: none; @endif">

 
  <!-- /.box-header -->

     <div class="box-header with-border" >
      <h3 class="box-title">Project</h3>
    </div>
  
    <div class="box-body" >
      
      <div class="row">
        <!-- Customer Info -->
        <div class="col-md-12">

          {{-- <div class="form-group">
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
          </div> --}}

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
            <label for="startDateProject" class="col-sm-3 control-label">Start Date:</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="startDateProject" name="startDateProject" placeholder="Start Date" autocomplete="off" />
            </div>
            
          </div>
          <div class="form-group">
            <label for="endDate" class="col-sm-3 control-label">End Date</label>
            <div class="col-sm-9" >
              <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" autocomplete="off"  />
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
    
</div>

{{-- Close by Project --}}

      {{-- Close by Class --}}            {{-- style="@if( !session('lead_close_form')) display: none; @endif" --}}     
      <div class="box box-info" id="lead-class"  style="@if( !session('lead_close_by_project')) display: none; @endif">

        

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
                
                @php

                $time_zones = array('Select Zone','Pacific','Mountain','Centeral','Eastern','UK','Western','Eastern[Aus]');

                @endphp


            
                <div class="form-group">
                    <label for="time_zone" class="col-sm-3 control-label" >Time Zone</label>
                    <div class="col-sm-6">
                        <select name="time_zone" id="time_zone" class="form-control select2">
                          <option value=""></option><option value="0" selected="selected">Select </option>
                          
                          @foreach($time_zones as $index => $zone)
                            <option value="{{ $index + 1 }}">{{$zone}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('time_zone'))
                            <span class="text-red">
                                <strong>{{ $errors->first('time_zone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="Time" class="col-sm-3 control-label" >Time</label>
                    <div class="col-sm-6">
                        <select name="Time" id="Time" class="form-control">
                         </select>
                        @if ($errors->has('time_zone'))
                            <span class="text-red">
                                <strong>{{ $errors->first('time_zone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="Pakistan Time" class="col-sm-3 control-label">Pakistan Time</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="pakTime" name="pakTime" placeholder="Start Date" autocomplete="off"  readonly="" />
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
                      <select id="agentId" name="agentId" class="form-control m-bot15 select2">
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
                      {{-- <div class="box-footer">
                        <a href="{!! url('/schedule'); !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right">Add</button>
                      </div> --}}
             
            <!-- /.box-footer -->
          </form>
        </div>


        {{-- Close by Class --}}  
  
  <div class="box box-info">
    
            
           <div class="col-md-12">
              <h3 class="box-title">Lead Information</h3>
            </div> 
            <div class="col-md-12">

                  
           <div id="attributes">
            <div class="form-group attributes" id="attribute_1">
                    <label for="description" class="col-sm-3 control-label">Attribute</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" name="attributes[]" placeholder="Attribute Name" autocomplete="off" />
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" autocomplete="off" />
                    </div>
                    <div class="col-sm-1">
                      <span class="btn btn-danger attribute_add_btn" style="width: 100%" onclick="removeRow('1')">x</span>
                    </div>
             </div>   
           </div>

            <div class="form-group">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-8">
                    
                  </div>
                  <div class="col-sm-1">
                    <span class="btn btn-primary" style="width: 100%" id="attribute_add_btn" >+</span>
                  </div>
                  
            </div>
    
  
             {{-- <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Assigned To</label>
                    <div class="col-sm-9">
                        <select name="agentid" class="form-control select2" data-placeholder="Select Satff" width="100%">
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                        @endforeach                
                        </select>
                    </div>
              </div> --}}

              <div class="form-group">
                <label for="source" class="col-sm-3 control-label">Lead Source</label>
                <div class="col-sm-9">
                    <select name="source" class="form-control select2" data-placeholder="Select Source"  width="100%">
                        <option value="Call">Call</option>
                        <option value="Facebook">Facebook</option>
                    </select>
                </div>
            </div>
      
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/lead/leadshow'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
  </div>

  </form>


<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(function() {
$('.select2').select2();
});
</script>
@endsection
@push('scripts')

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
$(document).ready(function() { 
    // $('.select2').select2({
    //     placeholder: "Select Staff",
    //     multiple: false,
    // }); 

    jQuery('#lead_close_by').change(function(){
      if(jQuery(this).val() == 'class'){
        jQuery('#lead-project').slideUp();
        jQuery('#lead-class').slideDown();
 
      }else if(jQuery(this).val() == 'project'){

        jQuery('#lead-class').slideUp();
        jQuery('#lead-project').slideDown();

      }
      });


    jQuery('#customer').change(function(){
      jQuery('#customer_id').val(jQuery(this).val());
    });

    jQuery('.customer_select[name="customer_select"]').change(function(){
      if(jQuery(this).val() == 'add_new'){
        jQuery('#select_customer').slideUp();
        jQuery('#addnew_customer').slideDown();
        jQuery('#customer_id').val(0);
        
      }else if(jQuery(this).val() == 'existing'){
        jQuery('#addnew_customer').slideUp();
        jQuery('#select_customer').slideDown();

      }
      
   });
});


function removeRow(row_no){
  $('#attribute_'+row_no).remove();
}


$(function () {

    var row_number = 2;

    $('#attribute_add_btn').click(function(){
      
      var attribute_new = `<div class="form-group attributes" id="attribute_${row_number}">
                  <label for="description" class="col-sm-3 control-label">Attribute</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="attributes[]" placeholder="Attribute Name" autocomplete="off" />
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" autocomplete="off" />
                  </div>
                  <div class="col-sm-1">
                    <span class="btn btn-danger" style="width: 100%" onclick="removeRow(${row_number})">x</span>
                  </div>
           </div>`;

      row_number = row_number + 1;
      $('#attributes').append(attribute_new);     
    });
  

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

  jQuery('#time_zone').on('change',function(){
    changetextfunction();
    var token = $("input[name='_token']").val();
    $.ajax({
              url: "<?php echo route('time_zones') ?>",
              dataType : 'json',
              method: 'POST',
              data: {
                
                zone:jQuery(this).val(),
                _token:token,
               
              },
              success: function(data) {
                jQuery('#Time').html(data);
                  var html = '';
                data.forEach(function(value,index){
                  html += `<option value="${value}">${value}</option>`;
                });

                jQuery('#Time').html(html);
                
              }
          });
  });

  
  jQuery('#Time').on('change',function(){
      changetextfunction();
      var token = $("input[name='_token']").val();
      $.ajax({
                url: "<?php echo route('convertToPak') ?>",
                dataType : 'text',
                method: 'POST',
                data: {
                  
                  time:jQuery(this).val(),
                  zone:jQuery('#time_zone').val(),
                  _token:token,
                 
                },
                success: function(data) {
                  jQuery('#pakTime').val(data);
                }
            });
  });
  
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
  // var pakTimelist=document.getElementById('pakTime');
  // var pakTime = pakTimelist.options[pakTimelist.selectedIndex].text;
  var pakTime = jQuery('#pakTime').val();
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
@endpush