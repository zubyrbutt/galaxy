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
              <h3 class="box-title">Upload ATTACHMENT / FILE for Proposal : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('LeadController@updateproposal', $pro_id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			
            <div class="row">			
				<!--lead_id against which recording will be stored -->
			    <input name='lead_id' type='hidden' value='<?php echo $lead_id; ?>' />
				<input name='pro_id' type='hidden' value='<?php echo $pro_id; ?>' />
              <div class="col-md-12">
           
				<div class="form-group">
					  <label for="recording_file" class="col-sm-3 control-label">Select file</label>

					  <div class="col-sm-9">
						<input class='form-control' type="file" name="docfile" id="docfile">						
                        <span class="text-red">Only JPG,PNG,PDF and DOCs files are allowed</span>
						@if ($errors->has('docfile'))
							  <span class="text-red">
								  <strong>{{ $errors->first('docfile') }}</strong>
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
                <button type="submit" class="btn btn-info pull-right">Upload</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection