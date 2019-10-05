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
              <h3 class="box-title">Manage topics</h3>
			  <span class="pull-right">
              <a href="{!! url('/topics/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Topic</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($topics) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Chapter</th>   
				  <th>File</th> 
				  <th>Created By</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topics as $topic)
                  <tr>
                    <td>{{$topic['name']}}</td>
                    <td>{{$topic['description'] }}</td>
                    <td>{{$topic->chapter->name }} </td>	
					<td>		
						@if($topic->topic_file && Storage::disk('local')->exists('public/training/files/'.$topic->topic_file))						
						  @if(File::extension('public/training/files/'.$topic->topic_file)=="mp4")
								<video controls style="width: 350px;">
									<source src="{{Storage::disk('local')->url('public/training/files/'.$topic->topic_file)}}" type="audio/mpeg">
									Your browser does not support the audio element.
								</video>
						@elseif(File::extension('public/storage/training/files'.$topic->topic_file)=="jpg")
									<img src="{{Storage::disk('local')->url('public/training/files/'.$topic->topic_file)}}" width='50px' height='50px' >
									
							@else
								<audio controls>
									<source src="{{Storage::disk('local')->url('public/training/files/'.$topic->topic_file)}}" type="audio/mpeg">
									Your browser does not support the audio element.
								</audio>
							@endif
						@else
							NA
						@endif
					</td>
					
					<td>{{$topic->createdby->fname }} {{ $topic->createdby->lname }}</td>
					 <!-- For Delete Form begin -->
                    <form id="form{{$topic['id']}}" action="{{action('TopicController@destroy', $topic['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    <td>
                      <a href="{!! url('/topics/'.$topic['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>                     
					  <button class="btn btn-danger" onclick="archiveFunction('form{{$topic['id']}}')"><i class="fa fa-trash"></i></button>
					</td>
					
					
                  </tr>
                  @endforeach			  
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
				  <th>Chapter</th>
				  <th>File</th> 
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