@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif

    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Project</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('ProjectController@update', $project->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
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
                                <option value="{{$customer->id}}" {{($project->user_id==$customer->id ) ? "selected": ""}} >{{$customer->fname}} {{$customer->lname}}</option>                    
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
                                <option value="{{$lead->id}}" {{($project->lead_id==$lead->id ) ? "selected": ""}}>{{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</option>                    
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
                    <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name" autocomplete="off" require value="{{$project->projectName}}">
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
                    <textarea rows="10" class="form-control" id="projectDescription" name="projectDescription" placeholder="Description" require >{{$project->projectDescription}}</textarea>
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
                    
                        <input type="radio" name="projectType" value="1" {{($project->projectType==1 ) ? "checked": ""}}>
                        <label for="projectType">Fixed</label>
                    
                    <br>               
                    
                        <input type="radio" name="projectType" value="2" {{($project->projectType==2 ) ? "checked": ""}}>
                        <label for="projectType">Monthly</label>
                    
                </div>
            </div>

			<!-- Social links -->						
			<div class="form-group">
                  <label for="startDate" class="col-sm-3 control-label">Start Date:</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="startDate" name="startDate" autocomplete="off" value="{{$project->startDate->format('Y-m-d')}}" />
                  </div>
                  
            </div>
			<div class="form-group">
                  <label for="endDate" class="col-sm-3 control-label">End Date</label>
                  <div class="col-sm-9" >
                    <input type="date" class="form-control" id="endDate" name="endDate" autocomplete="off" value="{{($project->endDate) ?$project->endDate->format('Y-m-d') : ""}}" />
                  </div>
                  
            </div>

            <!-- checkboxes -->
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;SMM</button>
                    <input type="checkbox" class="hidden"  name="isSMM" value="1" {{ $project->isSMM == 1 ? "checked" : "" }} >
                    </span>

                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;iOS App</button>
                    <input type="checkbox" class="hidden"  name="isiOS" value="1" {{ $project->isiOS == 1 ? "checked" : "" }}>
                    </span>

                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Android App</button>
                    <input type="checkbox" class="hidden"  name="isAndroid" value="1" {{ $project->isAndroid == 1 ? "checked" : "" }}>
                    </span>

                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Website</button>
                    <input type="checkbox" class="hidden"  name="isWeb" value="1" {{ $project->isWeb == 1 ? "checked" : "" }}>
                    </span>

                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Custom Solution</button>
                    <input type="checkbox" class="hidden"  name="isCustom" value="1" {{ $project->isCustom == 1 ? "checked" : "" }}>
                    </span>

                </div>
            </div>

                <?php  $users = json_decode(json_encode($project->users));
                $ids = array_column($users, 'id');
                //dd($ids); ?>

              <div class="form-group">
                <label for="staff_id" class="col-sm-3 control-label">Assign To Staff</label>
                <div class="col-sm-9" >
                <select class="form-control select2" name="staff_id[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                  @foreach($user as $row)
                  <option value="{{ $row->id }}" @if(in_array($row->id, $ids)) selected @endif>{{ $row->fname }} {{  $row->lname }} ({{$row->department->deptname}} - {{$row->designation->name}})</option>
                  @endforeach
                </select>
              </div>
              </div>

			
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/projects'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
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
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});

</script>
@endsection