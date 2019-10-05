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
              <h3 class="box-title">Add Appointment for Lead : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('leads/storeappointments'); !!}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			
            <div class="row">			
				<!--lead_id against which recording will be stored -->
			    <input name='lead_id' type='hidden' value='<?php echo $lead_id; ?>' />
              <div class="col-md-12">
                <div class="form-group">
                  <label for="title" class="col-sm-3 control-label">Select Date & Time</label>

                  <div class="col-sm-9">
                        <div>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" name="appointtime" autocomplete="off" />
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
						<textarea type="text" class="form-control" id="note" name="note" placeholder="Any note, please put here." rows="10">{{old('note')}}</textarea>
						@if ($errors->has('note'))
							  <span class="text-red">
								  <strong>{{ $errors->first('note') }}</strong>
							  </span>
						  @endif
					  </div>
				</div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Select Staff</label>

                  <div class="col-sm-9">
                    <select name="agentids[]" class="form-control" multiple id="selectAgents">
                        @if(count($agents) > 0)
                            @foreach($agents as $agent)    
                                <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>                    
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('agentids'))
                          <span class="text-red">
                              <strong>{{ $errors->first('agentids') }}</strong>
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
                <button type="submit" class="btn btn-info pull-right">Add Appointment</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
<script>
    $(document).ready(function() {
        $("#selectAgents").select2({
            placeholder: "Select a Staff",
            allowClear: true
        }); 
         
    });
</script>
@endsection