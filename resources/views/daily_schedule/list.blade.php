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
    <div class="col-md-12">
        <form class="form-horizontal" action="{!! url('/daily_schedule/search'); !!}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Advance Filter</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: none;">
            
            <!--Search Form Begins -->
			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Teacher</label>
                <select id="teacherID" name="teacherID" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Teacher" style="width: 100%;" tabindex="-1" aria-hidden="true">
					@if ($teachers_list!='')
						@foreach($teachers_list as $key => $teacher_list)
							<option value="{{ $teacher_list->id }}" >{{ $teacher_list->fname }} {{ $teacher_list->lname }}</option>    
						@endforeach
					@endif              
                </select>
              </div>
			  </div>
			  
			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Days</label>
					<select id="days" name="days[]" class="form-control m-bot15">
					@if ($classdays!='')
						@foreach($classdays as $key => $classday)
						<option value="{{ $classday }}" >{{ $classday }}</option>							
						@endforeach
					@endif
					</select>
              </div>
			  </div>

              <div class="form-group col-md-6"> 
			  <div class="col-sm-12">
			  <label>Select Date </label>
				<input type="date" class="form-control" id="classDate" name="classDate" placeholder="Class Date" autocomplete="off" />
			  </div>
			  </div>


            <!-- Search Form Ends -->
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="searchRecords">Search
                <i class="fa fa-search"></i></button>
          </div>
        </div>
        <!-- /.box -->
      </form>
      </div>
</div>


<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daily Schedule</h3>
              <span class="pull-right">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if($daily_schedules)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Due Date</th>				
				  <th>Student</th>
				  <th>Teacher</th>
				  <th>Course</th>
				  <th>Status</th>
				  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Class Days</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($daily_schedules as $daily_schedule)
                  <tr>
					@if($daily_schedule['paydate']!='')
					<td>{{$daily_schedule['paydate']->format('d')}} </td>
					@elseif($daily_schedule['paydate']=='')
					<td>No date </td>
                    @endif
                    <td>{{$daily_schedule->studentname['fname']}} {{$daily_schedule->studentname['lname']}}</td>					
                    <td>{{$daily_schedule->teachername['fname']}} {{$daily_schedule->teachername['lname']}}</td>
				
					<td>{{ $daily_schedule->coursename['courses'] }}</td>
					<td>
                      @if ($daily_schedule['std_status'] === 1)
                      <span class="btn btn-warning">Trial</span>
                      @elseif($daily_schedule['std_status'] === 2)
                      <span class="btn btn-success">Regular</span>
					  @elseif($daily_schedule['std_status'] === 5)
                      <span class="btn btn-primary">MakeOver</span>				  
					  @endif
                    </td>
                    <td>{{$daily_schedule['startTime']}}</td>
                    <td>{{$daily_schedule['endTime']}} </td>						
					
					
					@if ($plan!='')
						@foreach($plan as $key => $plan_name)
							@if($key == $daily_schedule['classType'])
							<td>{{ $plan_name }}</td>
							@endif
						@endforeach
					@endif					

                    @can('delete-staff')
                    <!-- For Delete Form begin -->
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>

@if ( $invalid[$daily_schedule['id']] == 2 )
<a class="btn btn-danger" title="Start Class"  href="{!! url('/daily_schedule/startClassFunction/'.$daily_schedule['id']) !!}"><i class="glyphicon glyphicon-blackboard"></i> </a>
@elseif ( $invalid[$daily_schedule['id']] == -1 )
<a class="btn btn-success" title="End Class"  href="{!! url('/daily_schedule/endClass/'.$daily_schedule['id']) !!}"><i class="fa fa-times"></i> </a>				
@endif
                    </td>
                   
                    

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
				  <th>Due Date</th>				
				  <th>Student</th>
				  <th>Teacher</th>
				  <th>Course</th>
				  <th>Status</th>
				  <th>Start Time</th>
				  <th>End Time</th>
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
<!-- Select2 script START -->
<script>        
		 $(document).ready(function() { 
			  $('.select2').select2({
				  placeholder: "Select From DropDown",
				  multiple: false,
			  }); 
			  $('.select2').change(
				console.log("select2-console-log")
			  );
		  });

</script>
<!-- Select2 script ENDS -->
@endsection