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
              <h3 class="box-title">Edit Chapter </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('ChapterController@update', $edit_chapter->id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			<input name="_method" type="hidden" value="PATCH">
            <div class="row">			
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ $edit_chapter->name }}" require >
                    @if ($errors->has('name'))
                          <span class="text-red">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
               
		
				<div class="form-group">
					  <label for="description" class="col-sm-3 control-label">Description</label>

					  <div class="col-sm-9">
						<textarea type="text" class="form-control" id="description" name="description" placeholder="Any note, please put here.">{{ $edit_chapter->description }}</textarea>
						@if ($errors->has('description'))
							  <span class="text-red">
								  <strong>{{ $errors->first('description') }}</strong>
							  </span>
						  @endif
					  </div>
				</div>
			
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a href="{!! url('/chapters/'); !!}/" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection