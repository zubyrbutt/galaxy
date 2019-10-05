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
              <h3 class="box-title">DC Confirmation List</h3>
              <span class="pull-right">
              <a href="{!! url('/schedule/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            @if(count($deadconfirmation_list) > 0)
              <table id="example1" class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Student</th>
                  <th>Teacher</th>
				  <th>Course</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>DC By</th>				  
				  <th>DC Comments</th>
				  <th>Reason</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deadconfirmation_list as $deadconfirm_list)
                  <tr>
                    <td>{{$deadconfirm_list->studentname['fname']}} {{$deadconfirm_list->studentname['lname']}}</td>					
                    <td>{{$deadconfirm_list->teachername['fname']}} {{$deadconfirm_list->teachername['lname']}}</td>

					<td>{{ $deadconfirm_list->coursename['courses'] }}</td>

                    <td>{{$deadconfirm_list['startTime']}}</td>
                    <td>{{$deadconfirm_list['endTime']}}</td>		
					<td>{{$deadconfirm_list->deadbyname['fname']}} {{$deadconfirm_list->deadbyname['lname']}}</td>					
					<td>{{$deadconfirm_list->comments_dead}} </td>
					@if($dead_reason!='')
						@foreach($dead_reason as $key => $dr)
							@if($deadconfirm_list->dead_reason==$key)
								<td>{{$dr}} </td>
							@endif
						@endforeach
					@endif
					
                    @can('delete-staff')
                     <!-- For Delete Form begin -->
                    <form id="form{{$deadconfirm_list['id']}}" action="{{action('ScheduleController@destroy', $deadconfirm_list['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>
					
                      @can('toScheduleFromDeadList')<a href="{!! url('/schedule/toScheduleFromDeadList/'.$deadconfirm_list['id']); !!}"  class="btn btn-success" title="Back to Schedule"><i class="fa fa-reply"></i> </a>@endcan
						
					  @can('confirmdead_list')<a href="{!! url('/schedule/confirmdead_list/'.$deadconfirm_list['id']); !!}"  class="btn btn-danger" title="DC"><i class="fa fa-times"></i> </a>@endcan
						
                      <!--@can('delete-schedule')<button class="btn btn-danger" onclick="archiveFunction('form{{$deadconfirm_list['id']}}')"><i class="fa fa-trash"></i></button>@endcan-->
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
				  <th>DC By</th>				  
				  <th>DC Comments</th>
				  <th>Reason</th>				  
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