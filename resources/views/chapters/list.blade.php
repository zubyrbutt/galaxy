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
              <h3 class="box-title">Manage Chapters</h3>
			  <span class="pull-right">
              <a href="{!! url('/chapters/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Chapter</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($chapters) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Chapter Name</th>
                  <th>Chapter Description</th>
                  <th>Created By</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($chapters as $chapter)
                  <tr>
                    <td>{{$chapter['name']}}</td>
                    <td>{{$chapter['description'] }}</td>
                    <td>{{$chapter->createdby->fname }} {{ $chapter->createdby->lname }}</td>
                     <!-- For Delete Form begin -->
                    <form id="form{{$chapter['id']}}" action="{{action('ChapterController@destroy', $chapter['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    <td>
                      <a href="{!! url('/chapters/'.$chapter['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>                     
                    </td>
                  </tr>
                  @endforeach			  
                </tbody>
                <tfoot>
                <tr>
                  <th>Chapter Name</th>
                  <th>Chapter Description</th>
                  <th>Created By</th>
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