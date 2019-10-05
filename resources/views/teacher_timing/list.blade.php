@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Teacher Timingss</h3>
              <span class="pull-right">
              <a href="{!! url('/teacher_timing/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Timings</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($teacher_timings) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Teacher</th>
                  <th>Mon</th>
                  <th>Tue</th>
                  <th>Wed</th>
                  <th>Thur</th>
				  <th>Fri</th>
                  <th>Sat</th>
				  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($teacher_timings as $teacher_timing)
				  <?php
                  //for ($x = 1; $x <= 20; $x++) {
                ?>
                  <tr>
                    <td>{{ $teacher_timing->teachername['fname'] }} {{ $teacher_timing->teachername['lname'] }}</td>				  
				
					@if ($teacher_timing->mon==1) 
						<td style='color:green'>ON</td>
					@else
						<td style='color:red'>OFF</td>
					@endif
					
					@if ($teacher_timing->tue==1) 
						<td style='color:green'>ON</td>
					@else
						<td style='color:red'>OFF</td>
					@endif
					
					@if ($teacher_timing->wed==1) 
						<td style='color:green'>ON</td>
					@else
						<td style='color:red'>OFF</td>
					@endif

					@if ($teacher_timing->thu==1) 
						<td style='color:green'>ON</td>
					@else
						<td style='color:red'>OFF</td>
					@endif
					
					@if ($teacher_timing->fri==1) 
						<td style='color:green'>ON</td>
					@else
						<td style='color:red'>OFF</td>
					@endif
					
					@if ($teacher_timing->sat==1) 
						<td style='color:green'>ON</td>
					@else
						<td style='color:red'>OFF</td>
					@endif
				
					@if ($time!='')
						@foreach($time as $key => $time_value)
							@if($key == $teacher_timing->startTime)
							<td>{{ $time_value }}</td>
							@endif
						@endforeach
					@endif
					
					@if ($time!='')
						@foreach($time as $key => $time_value)
							@if($key == $teacher_timing->endTime)
							<td>{{ $time_value }}</td>
							@endif
						@endforeach
					@endif
					
                    @can('delete-teacher_course')
					<!-- For Delete Form begin -->
                    <form id="form{{$teacher_timing['id']}}" action="{{action('TeacherTimingController@destroy', $teacher_timing['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>
                      @can('show-teacher_timing')<a href="{!! url('/teacher_timing/'.$teacher_timing['id']); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>@endcan
                      @can('edit-teacher_timing')<a href="{!! url('/teacher_timing/'.$teacher_timing['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>@endcan
					  
                      @can('delete-teacher_timing')<button class="btn btn-danger" onclick="archiveFunction('form{{$teacher_timing['id']}}')"><i class="fa fa-trash"></i></button>@endcan
                    </td>
                  </tr>
				@endforeach
                <?php
                  //}
                ?>
				  
                </tbody>
                <tfoot>
                <tr>
				  <th>Teacher</th>
                  <th>Mon</th>
                  <th>Tue</th>
                  <th>Wed</th>
                  <th>Thur</th>
				  <th>Fri</th>
                  <th>Sat</th>
				  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Action</th>
                </tr>
                </tfoot>
              </table>
			@else
		  <div>No Record found.</div>
		  @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

@endsection