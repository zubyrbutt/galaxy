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
              <h3 class="box-title">Manage Tasks for: {{$project->projectName}}</h3>
              @if(Auth::user()->role->id !='3')
              <span class="pull-right">
                <a href="{!! url('/tasks/create/'); !!}/{{$project->id}}" class="btn btn-info"><span class="fa fa-plus"></span> Add Task</a>
                </span>
              @endif  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($tasks) > 0)
              <table id="example1" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
				          <th>Project</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Status</th>
                  <th>Created by</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                  <tr>
                    <td>{{$task['id']}}</td>
					          <td>{{$task['title']}}</td>
                    <td>{{$task->project->projectName}}</td>
                    <td>{{$task->startDate->format('d-M-Y h:i:s') }}</td>
                    <td>{{$task->endDate->format('d-M-Y h:i:s')}}</td>
                    <td>@if ($task->status === 2)
                        <span class="text-green"><b>Closed</b></span>
                      @elseif ($task->status === 1)
                        <span class="text-yellow"><b>Inprogress</b></span>
                      @elseif ($task->status === 0)
                        <span class="text-red"><b>Open</b></span>
                      @else
                        <span class="text-red"><b>Open</b></span>
                      @endif</td>
                    <td>{{$task->createdby->fname}} {{$task->createdby->lname}}</td>
                    <td>{{$task->created_at->format('d-M-Y h:i:s') }}</td>
                    <td>
                      <a href="{!! url('/tasks/detail/'.$task['id'] ); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>
                      @if ($task->status === 0)
                        <a href="{!! url('/tasks/edit/'.$task['id'].''); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>      
                      @endif

                    </td>
                  </tr>
                  @endforeach			  
                </tbody>
                <tfoot>
                <tr>
                <th>Id</th>
                  <th>Title</th>
				          <th>Project</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Status</th>
                  <th>Created by</th>
                  <th>Created At</th>
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