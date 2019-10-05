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
        <form class="form-horizontal" action="{!! url('daily_schedule/classDetails/search'); !!}" method="post" enctype="multipart/form-data">
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
			@if($role_id!==5)
			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Teacher</label>
                <select id="teacherID" name="teacherID" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Teacher" style="width: 100%;" tabindex="-1" aria-hidden="true">
					<option value="">Select Teacher</option>
					@if ($teachers_list!='')
						@foreach($teachers_list as $key => $teacher_list)
							<option value="{{ $teacher_list->id }}" >{{ $teacher_list->fname }} {{ $teacher_list->lname }}</option>    
						@endforeach
					@endif              
                </select>
              </div>
			  </div>
			  @endif
			  
			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Student</label>
                <select id="studentID" name="studentID" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Student" style="width: 100%;" tabindex="-1" aria-hidden="true">
					<option value="">Select Student</option>
					@if ($students_list!='')
						@foreach($students_list as $key => $student_list)
							<option value="{{ $student_list->id }}" >{{ $student_list->fname }} {{ $student_list->lname }}</option>    
						@endforeach
					@endif              
                </select>
              </div>
			  </div>
			  
			  
			  
              <div class="form-group col-md-6"> 
			  <div class="col-sm-12">			  
                  <label>Select Date Range:</label>  
                  <div class="input-group">
                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                      <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                      <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-d')}}">
                      <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-d')}}">
                      <i class="fa fa-caret-down"></i>
                    </button>
                  </div>
			  </div>
			  </div>

			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Status</label>
					<select id="class_status" name="class_status" class="form-control m-bot15">
					@if ($present_absent!='')
						<option value="-1" selected>All</option>
						@foreach($present_absent as $key => $pa)
						<option value="{{ $key }}" >{{ $pa }}</option>							
						@endforeach
					@endif
					</select>
              </div>
			  </div>				  

              <script>
                
                 $(document).ready(function() { 
                  $('.select2').select2({
                      placeholder: "Select Staff",
                      multiple: false,
                  }); 
                  $('.select2').change(
                    console.log("123123")
                  );
                 
                  //Date range as a button
                  $('#daterange-btn').daterangepicker(
                    {
                      ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                      },
                      startDate: moment().subtract(29, 'days'),
                      endDate  : moment()
                    },
                    function (start, end) {
                      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                      $('#dateFrom').val(start.format('YYYY-MM-DD'));
                      $('#dateTo').val(end.format('YYYY-MM-DD'));
                    }
                  );

                  });
                


              </script>
            <!-- Search Form Ends -->


            <!-- Search Form Ends -->
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="searchRecords">Search
                <i class="fa fa-search"></i></button>
				<input name='search-submit' value='1' type='hidden' />
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
              <h3 class="box-title">Class Details</h3>
              <span class="pull-right">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($student_attendances) > 0)
              <table id="example3" class="display nowrap" style="width:100%">
                <thead>
                <tr>			
				  <th>Student</th>
				  <th>Teacher</th>
				  <th>Start Time</th>
				  <th>Class Start Time</th>
				  <th>Class End Time</th>
				  <th>Class Duration</th>
				  <th>Date</th>
				  <th>Student Status</th>
				  <th>Status</th>				  
				  <th>Comments</th>
				  <th>Lesson Details</th>
				  <th>Quran Comments</th>
				  <th>Sch id</th>
                </tr>
                </thead>
                <tbody>
                @foreach($student_attendances as $stu_att)
                  <tr>
                    <td>{{$stu_att->studentname['fname']}} {{$stu_att->studentname['lname']}}</td>
                    <td>{{$stu_att->teachername['fname']}} {{$stu_att->teachername['lname']}}</td>					
                    <td>{{$stu_att->startTime}}</td>
					<td>{{$stu_att->classStartTime}}</td>
                    <td>{{$stu_att->endTime}} </td>
<?php 
	//Subtracting STARTTIME from ENDTIME
	$endTime = strtotime($stu_att->endTime);
	$classStartTime = strtotime($stu_att->classStartTime);
	if($endTime<$classStartTime)
	{
		$class_duration =  round(abs(strtotime(nl2br( $stu_att->endTime)) - strtotime(nl2br( $stu_att->classStartTime))));
		$class_duration = gmdate('H:i:s',$class_duration);
		$class_duration = round(abs(strtotime($class_duration)));
		$_24_hr_time = round(abs(strtotime('23:59:59')));
		$cal_time = $_24_hr_time - $class_duration;
		$class_duration = gmdate('H:i:s',$cal_time);
	}
	else
	{
		$class_duration =  round(abs(strtotime(nl2br( $stu_att->endTime)) - strtotime(nl2br( $stu_att->classStartTime))));
		$class_duration = gmdate('H:i:s',$class_duration);
	}
?>
					
					<td><?php echo $class_duration; ?> </td>	
					<td>{{$stu_att->date->format('Y-m-d')}} </td>	
					<td>
                      @if ($stu_att->std_status === 1)
                      <span class="label label-warning">Trial</span>
                      @elseif($stu_att->std_status === 2)
                      <span class="label label-success">Regular</span>
					  @elseif($stu_att->std_status === 5)
                      <span class="label label-primary">MakeOver</span>				  
					  @endif
                    </td>
					<td>
                      @if ($stu_att->status === 1)
                      <span>Present</span>
                      @elseif($stu_att->status === 0)
                      <span>Absent</span>			  
					  @endif
                    </td>					
					<td>{{$stu_att->comments}}</td>
					<td>{{$stu_att->lessonDetails}}</td>
					<td>
					@if($stu_att->dua!==NULL) {{$stu_att->getdua['dua']}} @endif
					@if($stu_att->prayer!==NULL) <br>{{$stu_att->getprayer['name']}} @endif
					@if($stu_att->kalima!==NULL) <br>{{$stu_att->kalima}} @endif
					@if($stu_att->lesson!==NULL) <br>{{$stu_att->getlesson['lessonName']}} @endif
					@if($stu_att->surah!==NULL) <br>{{$stu_att->getsurah['level']}} @endif
					@if($stu_att->verseFrom!==NULL or $stu_att->verseTo!==NULL)<br>Verse From:{{$stu_att->verseFrom}} , 
					Verse To:{{$stu_att->verseTo}}<br>@endif
					</td>
					<td>{{$stu_att->schedule_id}}</td>
					
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>			
				  <th>Student</th>
				  <th>Teacher</th>
				  <th>Start Time</th>
				  <th>Class Start Time</th>
				  <th>Class End Time</th>
				  <th>Class Duration</th>
				  <th>Date</th>
				  <th>Student Status</th>
				  <th>Status</th>
				  <th>Comments</th>
				  <th>Lesson Details</th>
				  <th>Dua</th>
				  <th>Sch id</th>
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