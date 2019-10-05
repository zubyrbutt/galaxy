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
              <h3 class="box-title">Upload Proposal for Lead : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('leads/storeproposal'); !!}" method="post" enctype="multipart/form-data">
            @csrf
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
				
			
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a href="{!! url('/leads/'); !!}/{{$lead_id}}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Create</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection