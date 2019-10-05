@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">DC via Pending List -  Parent : <b>{{$parents['fname']}} {{$parents['lname']}}</b></h3>
              <span class="pull-right">
              <a href="{!! url('/schedule/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('invoice/invoice_dead'); !!}" method="post" enctype="multipart/form-data">
            @csrf
			<input type="hidden" id="parentID" name="parentID" value="{{$parents['id']}}" />
		
			<div class="box-body">
            
            @if(count($invoice_deadconfirmation) > 0)
              <table id="example1" class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Chk box</th>
                  <th>Student</th>
				  <th>Teacher</th>
				  <th>Subject</th>				  
				  <th>Per month Dues</th>				  
				  <th>Per month Dues(US)</th>
				  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice_deadconfirmation as $invoice_dead)
				<tr>
					<td> 
					<input type="checkbox" name="schedule_id_list[]"  value="<?php echo  $invoice_dead->sch_id; ?>"  checked="checked"  /></td>
					
					<td>{{$invoice_dead->studentname['fname']}} {{$invoice_dead->studentname['lname']}} </td>
					<td>{{$invoice_dead->teachername['fname']}} {{$invoice_dead->teachername['lname']}}</td>
					<td>
					@if ($course_list!='')
						@foreach($course_list as $key => $courses)
							@if($key+1 == $invoice_dead->courseID)
							{{ $courses['courses'] }}
							@endif
						@endforeach
					@endif
					</td>					
					<td>{{$invoice_dead->dues_original}}
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoice_dead->currency_array)
							({{ $curr }})
							@endif
						@endforeach
					@endif
					</td>
					<td>{{$invoice_dead->dues_usd}} </td>
					<td> 
					  @if ($invoice_dead->std_status === 1)
                      <span class="btn btn-warning">Trial</span>
                      @elseif($invoice_dead->std_status === 2)
                      <span class="btn btn-success">Regular</span>
					  @elseif($invoice_dead->std_status === 5)
                      <span class="btn btn-primary">MakeOver</span>				  
					  @endif
					</td>
				</tr>
                  @endforeach
				<tr>
				  <th>Chk box</th>
                  <th>Student</th>
				  <th>Teacher</th>
				  <th>Subject</th>				  
				  <th>Per month Dues</th>				  
				  <th>Per month Dues(US)</th>
				  <th>Status</th>				  
                </tr>
                </tbody>

              </table>
              @else
              <div>No Record found.</div>
              @endif			  
            </div>
                <div class="form-group">
                  <label for="dead_reason" class="col-sm-3 control-label">DC Reason</label>
                  <div class="col-sm-6">
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
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/invoice'); !!}" class="btn btn-default">Cancel</a>
				<button type="submit" class="btn btn-info pull-right">Make DC</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection