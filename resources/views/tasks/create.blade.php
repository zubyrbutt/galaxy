@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Task for Project : {{$project->projectName}} </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('tasks/store'); !!}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			
            <div class="row">			
				<!--lead_id against which recording will be stored -->
			    <input name='project_id' type='hidden' value='{{$project->id}}' />
              <div class="col-md-12">
			  
			  
				<div class="form-group">
				  <label for="taskTitle" class="col-sm-3 control-label">Title</label>

				  <div class="col-sm-9">
					<input type="text" class="form-control" id="taskTitle" name="taskTitle" placeholder="Task title" autocomplete="off" value="{{old('taskTitle')}}" require>
					@if ($errors->has('taskTitle'))
						  <span class="text-red">
							  <strong>{{ $errors->first('taskTitle') }}</strong>
						  </span>
					  @endif
				  </div>
				</div>

				<div class="form-group">
					  <label for="taskDescription" class="col-sm-3 control-label">Description</label>
					  <div class="col-sm-9">
						<textarea rows="10" class="form-control" id="taskDescription" name="taskDescription" placeholder="Task Description" require >{{old('taskDescription')}}</textarea>
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
                                minDate: new Date(<?php echo date('Y')?>, <?php echo date('m')?> - 1, <?php echo date('d')?>),
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
                                minDate: new Date(<?php echo date('Y')?>, <?php echo date('m')?> - 1, <?php echo date('d')?>),
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
                    <select class="form-control" name="assigned_to" id="assigned_to"  data-show-subtext="true" data-live-search="true">
                        @if(count($users) > 0)
                            @foreach($users as $user)    
                                <option value="{{$user->id}}"  >{{$user->fname}} {{$user->lname}}</option>                    
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
                <a href="{!! url('/tasks/'); !!}/{{$project->id}}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add Task</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection