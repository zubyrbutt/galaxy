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
              <h3 class="box-title">Manage Recordings</h3>
              <span class="pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($recordings) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Lead No.</th>
                  <th>Customer Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>                
                  <th>Business Name</th>
                  <th>Business Nature</th>
                  <th>Created By</th>
                  <th>Status</th>
				          <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recordings as $recording)
                  <tr>
                    <td>{{$recording['id']}}</td>
                    <td>{{$recording->user->fname }} {{ $recording->user->lname }}</td>
                    <td>{{$recording->user->email}}</td>
                    <td>{{$recording->user->phonenumber}}</td>			
                    <td>{{$recording['businessName']}}</td>
                    <td>{{$recording['businessNature']}}</td>
                    <td>{{$recording->createdby->fname }} {{ $recording->createdby->lname }}</td>
                    <td>
                      @if ($recording['status'] === 1)
                      <span class="btn btn-success">Active</span>
                      @else
                      <span class="btn btn-danger">Deactive</span>
                      @endif
                    </td>
                     <!-- For Delete Form begin -->
                    <form id="form{{$recording['id']}}" action="{{action('RecordingController@destroy', $recording['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    <td>
                      <a href="{!! url('/recordings/'.$recording['id'] ); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>    
                      <a href="{!! url('/recordings/'.$recording['id'].'/recordingcreate'); !!}" target='_blank'  class="btn btn-warning" title="Recording link"><i class="fa fa-file-audio-o"></i> </a>
					            <button class="btn btn-danger" onclick="archiveFunction('form{{$lead['id']}}')"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  @endforeach			  
                </tbody>
                <tfoot>
                <tr>
                  <th>Lead No.</th>
                  <th>Customer Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Business Name</th>
                  <th>Business Nature</th>
                  <th>Created By</th>
                  <th>Status</th>				  
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