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
              <h3 class="box-title">Trial Confirmation</h3>
              <span class="pull-right">
              <a href="{!! url('/schedule/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            @if(count($trialconfirmation_data) > 0)
              <table id="example1" class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Student</th>
                  <th>Teacher</th>
				  <th>Course</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Agent</th>				  
				  <th>Class Days</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trialconfirmation_data as $trialconfirm)
                  <tr>
                    <td>{{$trialconfirm->studentname['fname']}} {{$trialconfirm->studentname['lname']}}</td>					
                    <td>{{$trialconfirm->teachername['fname']}} {{$trialconfirm->teachername['lname']}}</td>

					<td>{{ $trialconfirm->coursename['courses'] }}</td>

                    <td>{{$trialconfirm['startTime']}}</td>
                    <td>{{$trialconfirm['endTime']}}</td>		
					<td>{{$trialconfirm->agentname['fname']}} {{$trialconfirm->agentname['lname']}}</td>					
					@if ($plan!='')
						@foreach($plan as $key => $plan_name)
							@if($key == $trialconfirm['classType'])
							<td>{{ $plan_name }}</td>
							@endif
						@endforeach
					@endif										
					
                    @can('delete-staff')
                     <!-- For Delete Form begin -->
                    <form id="form{{$trialconfirm['id']}}" action="{{action('ScheduleController@destroy', $trialconfirm['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>
                      @can('edit-schedule')<a href="{!! url('/schedule/'.$trialconfirm['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>@endcan
						
					  @can('status-confirmtrial')<a href="{!! url('/schedule/confirmtrial/'.$trialconfirm['id']); !!}"  class="btn btn-info" title="Confirm Trial"><i class="fa fa-check"></i> </a>@endcan
						
                      <!--@can('delete-schedule')<button class="btn btn-danger" onclick="archiveFunction('form{{$trialconfirm['id']}}')"><i class="fa fa-trash"></i></button>@endcan-->
                    </td>
                   
                    

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
				  <th>Student</th>
                  <th>Teacher</th>
				  <th>Course</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Agent</th>				  
				  <th>Class Days</th>
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