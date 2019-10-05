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
              <h3 class="box-title">Edit Topic </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('TopicController@update', $edit_topic->id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			<input name="_method" type="hidden" value="PATCH">
            <div class="row">			
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ $edit_topic->name }}" require >
                    @if ($errors->has('name'))
                          <span class="text-red">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="countryId" class="col-sm-3 control-label">Chapter</label>
                  <div class="col-sm-9">
					<select id="chapterId" name="chapterId" class="form-control m-bot15" name="countryId">
						@if ($chapters!='')
							@foreach($chapters as $key => $chapter)
								<option value="{{ $chapter['id'] }}" {{ $key ==  $edit_topic['id']  ? 'selected="selected"' : '' }}>{{ $chapter['name'] }}</option>    
							@endforeach
						@endif
					</select>
					@if ($errors->has('chapterId'))
                          <span class="text-red">
                              <strong>{{ $errors->first('chapterId') }}</strong>
                          </span>
                    @endif
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="phonenumber" class="col-sm-3 control-label">Topic Order</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="orderId" name="orderId" placeholder="Topic Order" value="{{ $edit_topic->orderId }}" autocomplete="off" require>
                    @if ($errors->has('orderId'))
                          <span class="text-red">
                              <strong>{{ $errors->first('orderId') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
               
				<div class="form-group">
					  <label for="description" class="col-sm-3 control-label">Description</label>
					  <div class="col-sm-9">
						<textarea type="text" class="form-control" id="description" name="description" placeholder="Any note, please put here.">{{ $edit_topic->description }}</textarea>
						@if ($errors->has('description'))
							  <span class="text-red">
								  <strong>{{ $errors->first('description') }}</strong>
							  </span>
						  @endif
					  </div>
				</div>
				
				<div class="form-group">
					  <label for="topic_file" class="col-sm-3 control-label">Select file</label>
					  <div class="col-sm-9">
						<input class='form-control' type="file" name="topic_file" id="topic_file" value="{{ $edit_topic->topic_file }}">						
                        <span class="text-red"></span>
							@if ($errors->has('topic_file'))
							  <span class="text-red">
								  <strong>{{ $errors->first('topic_file') }}</strong>
							  </span>
							@endif
					  </div>
				</div>
			
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a href="{!! url('/topics/'); !!}/" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection