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
              <h3 class="box-title">Edit Task for Project [{{ $projectTask->project->projectName }}]</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('ProjectTaskController@update', $projectTask->id)}}" method="post" enctype="multipart/form-data">
            @csrf
						<!--<input name="_method" type="hidden" value="PATCH">-->
						<input name="project_id" type="hidden" value="{{ $projectTask->project->id }}">
          <div class="box-body" >
			
            <div class="row">			
                <div class="col-md-12">
                    <h3 class="box-title"></h3>
                </div>
			<!-- Customer Info -->	
            <div class="col-md-12">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">Title</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="taskTitle" name="taskTitle" placeholder="First Name" autocomplete="off" value="{{ $projectTask->title }}"  >
                    @if ($errors->has('taskTitle'))
                          <span class="text-red">
                              <strong>{{ $errors->first('taskTitle') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="lname" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <textarea rows="10" class="form-control" id="taskDescription" name="taskDescription" placeholder="Task Description" require >{{ $projectTask->description }}</textarea>
                    @if ($errors->has('taskDescription'))
                          <span class="text-red">
                              <strong>{{ $errors->first('taskDescription') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="startDate" class="col-sm-3 control-label">Start Date</label>

                  <div class="col-sm-9">
                        <div>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" name="startDate" autocomplete="off" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
						
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker1').datetimepicker({
                                sideBySide: true,
                                defaultDate: "{!! date('m/d/Y H:i:s', strtotime($projectTask->startDate))!!}"

                            });
                        });
                        
                        
                        </script>
                    
                    @if ($errors->has('startDate'))
                          <span class="text-red">
                              <strong>{{ $errors->first('startDate') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

				<div class="form-group">
                  <label for="endDate" class="col-sm-3 control-label">End Date</label>

                  <div class="col-sm-9">
                        <div>
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' class="form-control" name="endDate" autocomplete="off" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker2').datetimepicker({
                                sideBySide: true,
                                defaultDate: "{!! date('m/d/Y H:i:s', strtotime($projectTask->endDate))!!}"
                            });
                        });
                    </script>
                    
                    @if ($errors->has('endDate'))
                          <span class="text-red">
                              <strong>{{ $errors->first('endDate') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="assigned_to" class="col-sm-3 control-label">Assigned to</label>

                  <div class="col-sm-9">
                    <select class="form-control" name="assigned_to" id="assigned_to">
                        @if(count($users) > 0)
                            @foreach($users as $user)    
                                <option value="{{$user->id}}" {{($projectTask->user_id==$user->id ) ? "selected": ""}} >{{$user->fname}} {{$user->lname}}</option>                    
                            @endforeach
                        @else
                            <option value="">None</option>
                        @endif
                    </select>
                    @if ($errors->has('assigned_to'))
                          <span class="text-red">
                              <strong>{{ $errors->first('assigned_to') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
				
			</div>
			
              </div>
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/lead/leadshow'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Edit</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection