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
              <h3 class="box-title">DC Confirmation : {{$schedule->studentname['fname']}} </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('ScheduleController@confirmdead', $id)}}" method="post" enctype="multipart/form-data">
            @csrf
			<input name="_method" type="hidden" value="PATCH">
          <div class="box-body" >
			
            <div class="row">			
				<!--schedule_id -->
			    
              <div class="col-md-12">
			  

				<div class="form-group">
					  <label for="comments_dead" class="col-sm-3 control-label">Reason/Comments For Student(DC):</label>
					  <div class="col-sm-9">
						<textarea rows="10" class="form-control" id="comments_dead" name="comments_dead" placeholder="DC Description" require >{{old('comments_dead')}}</textarea>
						@if ($errors->has('comments_dead'))
							  <span class="text-red">
								  <strong>{{ $errors->first('comments_dead') }}</strong>
							  </span>
						  @endif
					  </div>
				</div>			  

                <div class="form-group">
                  <label for="dead_reason" class="col-sm-3 control-label">DC Reason</label>

                  <div class="col-sm-9">
                    <select class="form-control" name="dead_reason" id="dead_reason"  data-show-subtext="true" data-live-search="true">
                        @if(count($dead_reason) > 0)
                            @foreach($dead_reason as $key => $deadr)    
                                <option value="{{$key}}"  >{{$deadr}}</option>                    
                            @endforeach
                        @else
                            <option value="">None</option>
                        @endif
                    </select>
                    @if ($errors->has('dead_reason'))
                          <span class="text-red">
                              <strong>{{ $errors->first('dead_reason') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
				
				<div class="form-group">
				  <label for="record_link_dead" class="col-sm-3 control-label">Recording Link</label>

				  <div class="col-sm-9">
					<input type="text" class="form-control" id="record_link_dead" name="record_link_dead" placeholder="Recording Link" autocomplete="off" value="{{old('taskTitle')}}" require>
					@if ($errors->has('record_link_dead'))
						  <span class="text-red">
							  <strong>{{ $errors->first('record_link_dead') }}</strong>
						  </span>
					  @endif
				  </div>
				</div>				

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule/'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Confirm DC</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection