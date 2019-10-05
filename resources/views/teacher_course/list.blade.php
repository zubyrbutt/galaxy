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
              <h3 class="box-title">Manage Teacher Course</h3>
              <span class="pull-right">
			  @can('create-teacher_course')
              <a href="{!! url('/teacher_course/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Course</a>
			  @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($teacher_courses) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Teacher</th>
				  <th>Course</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>
                @foreach($teacher_courses as $teacher_course)
                  <tr>
					<td>{{$teacher_course->teachername['fname'] }} {{$teacher_course->teachername['lname'] }} </td>
					<td>{{$teacher_course->coursename['courses'] }} </td>
                    @can('delete-teacher_course')
                     <!-- For Delete Form begin -->
                    <form id="form{{$teacher_course['id']}}" action="{{action('TeacherCourseController@destroy', $teacher_course['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>
                      @can('show-teacher_course')<a href="{!! url('/teacher_course/'.$teacher_course['id']); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>@endcan
                      @can('edit-teacher_course')<a href="{!! url('/teacher_course/'.$teacher_course['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>@endcan
					  
                      @can('delete-teacher_course')<button class="btn btn-danger" onclick="archiveFunction('form{{$teacher_course['id']}}')"><i class="fa fa-trash"></i></button>@endcan
                    </td>
                   
                    

                  </tr>
                  @endforeach
                </tbody>

                <tfoot>
                <tr>
                  <th>Teacher</th>
				  <th>Course</th>
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