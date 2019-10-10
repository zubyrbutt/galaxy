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


<div class="box box-info" id="lead-project" style="@if( !session('lead_close_form')) display: none; @endif">
            <div class="box-header with-border" >
              <h3 class="box-title">Project</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('/leads/close'); !!}" method="post" enctype="multipart/form-data">
            @csrf
            
            
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
                    <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name" autocomplete="off" require>
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
                    <textarea rows="10" class="form-control" id="projectDescription" name="projectDescription" placeholder="Description" require ></textarea>
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
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" autocomplete="off" require>
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
                    <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" autocomplete="off" />
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
                              <input type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="off" value="" require >
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
                              <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="" autocomplete="off" require>
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


              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
    </div>




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
    }else if(jQuery(this).val() == 'project'){
      jQuery('#lead-project').slideDown();
      jQuery('#lead-recording').slideDown();
    }
  });

</script>

@endsection

