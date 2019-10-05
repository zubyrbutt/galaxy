@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });

    </script>
@endif
<!-- some CSS styling changes and overrides -->

<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
<style type="text/css">
      .ajax-load{
        background: #e1e1e1;
        padding: 10px 0px;
        width: 100%;
      }
    </style>
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"> Details</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body" >


               @if($message = Session::get('delete'))
                      <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">
                      </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                     @if($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">
                      </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif

                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div>
            <div class="row">
              <div class="col-md-8">
              <table class="table table-striped table-bordered responsive nowrap">
                <tr>
                    <td><b>ID</b></td>
                    <td>{{$data['complaint']->id}}</td>
                </tr>
                <tr>
                    <td><b>User Name</b></td>
                    <td>{{$data['complaint']->user->fname}}</td>
                </tr>
                <tr>
                    <td><b>Department</b></td>
                    <td>{{$data['complaint']->department->deptname}}</td>
                </tr>
                <tr>
                    <td><b>Title</b></td>
                    <td>{{$data['complaint']->title}}</td>
                </tr>
                <tr>
                    <td><b>Description</b></td>
                    <td>{{$data['complaint']->description}}</td>
                </tr>
                 
                

                <tr>
                    <td><b>Created At</b></td>
                    <td>{{$data['complaint']->created_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td>{{$data['complaint']->updated_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        
                          <span class="text-green"><b>{{$data['complaint']->status}}</b></span>
                        
<!--                             <span class="text-red"><b>Deactive</b></span>
 -->                       
                    </td>
                </tr>

              </table>


              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->

</div>



<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Comment</h3>
              
              <span class="pull-right">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add Comment</a>
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#forwardModal"><span class="fa fa-plus"></span> Forwarded</a>
              </span>
              
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap table_data" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Comment</th>
                  <th>Created At</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                   <th>ID</th>
                  <th>User Name</th>
                  <th>Comment</th>
                  <th>Created At</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>

<!--Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('complaint.commentStore')}}" class="form" id="status_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Comment</label>
                           <textarea  class="form-control comment" name="comment" style="height: 150px;"  required>
                            </textarea>
                            <span class="text-red">
                              <strong class="comment_status"></strong>
                            </span>
                        </div>
                       
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="status" class="form-control" required="required">
                              <option value="Pending">Pending</option>
                              <option value="In Process">In Process</option>
                              <option value="Closed">Closed</option>
                            </select>
                            <span class="text-red">
                              <strong class="status_status"></strong>
                            </span>
                        </div> 
                        
                        
                </div>
                    <div class="modal-footer">
                      <input type="hidden"  id="complaint_id" name="complaint_id" value="{{$data['complaint']->id}}">
                      <input type="submit" class="btn btn-primary" id="comment-complaint-update" value="Save">
                    </div>   
            </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--Update Modal end-->

<!--forward Modal -->
  <div class="modal fade" id="forwardModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('complaint.commentStore')}}" class="form" id="forward_status_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea  class="form-control comment" name="comment" style="height: 150px;"  required>
                            </textarea>
                            <span class="text-red">
                              <strong class="forward_comment_status"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                          <label>Department</label>
                            <select type="text" class="form-control" id="status_department_id" name="department_id" require>
                              @foreach($data['department'] as $row)
                              <option value="{{$row->id}}">{{$row->deptname}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="department_id_status"></strong>
                            </span>
                        </div>
                       
                        <div class="form-group">
                          <input type="hidden" name="status" value="Forwarded">
                        </div> 
                        
                        
                </div>
                    <div class="modal-footer">
                      <input type="hidden"   name="complaint_id" value="{{$data['complaint']->id}}">
                      <input type="submit" class="btn btn-primary" id="forward_comment-complaint-update" value="Save">
                    </div>   
            </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--Update forward Modal end-->
<div class="row">
<div class="col-md-12" id="comment-data">
    @include('complaints.presult')
  </div>
</div>  
<div class="ajax-load text-center" style="display:none">
  <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More </p>
</div>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
 $( document ).ready(function() {

var InitTable = function(){
    $('#table_data').DataTable({
      "bDestroy": true,
      "processing":true,
      "serverSide":true,
      "ajax":{
               "url": "{{ route('complaintComment.fetch') }}",
               "dataType": "json",
               "type": "POST",
               "data":{ _token: "{{csrf_token()}}",id:"{{$data['complaint']->id}}"}
             },
      //"ajax":"{{ route('complaintComment.fetch') }}",
      "columns": [
                { "data": "id" },
                { "data": "user_id" },
                { "data": "comment" },
                { "data": "created_at" },
                { "data": "status" },
            ]
    });
  }


  InitTable();

$('#comment-complaint-update').on('click', function(e) {

  var data = $('#status_form').serializeArray();
  console.log(data);
  event.preventDefault();
  $.ajax({
          data: data,
          type: $('#status_form').attr('method'),
          url: $('#status_form').attr('action'),
          success: function(response)
          {
            
            if(response.errors)
            {
              $(".comment_status").html(response.errors.comment);
              $('.comment_status').fadeIn('slow', function(){
                $('.comment_status').delay(3000).fadeOut(); 
              });
              
              $(".status_status").html(response.errors.status);
              $('.status_status').fadeIn('slow', function(){
                $('.status_status').delay(3000).fadeOut(); 
              });
              
            }
            else
            {
              $('#myModal').modal('hide');
              $('.success').html(response);
              $('#success').show();
              $('#status_form')[0].reset();
              InitTable();

              
             
              
            }
          }
        });
}); 

$('#forward_comment-complaint-update').on('click', function(e) {

  var data = $('#forward_status_form').serializeArray();
  console.log(data);
  event.preventDefault();
  $.ajax({
          data: data,
          type: $('#forward_status_form').attr('method'),
          url: $('#forward_status_form').attr('action'),
          success: function(response)
          {
            
            if(response.errors)
            {
              $(".forward_comment_status").html(response.errors.comment);
              $('.forward_comment_status').fadeIn('slow', function(){
                $('.forward_comment_status').delay(3000).fadeOut(); 
              });
            }
            else
            {
              $('#forwardModal').modal('hide');
              $('.success').html(response);
              $('#success').show();
              $('#forward_status_form')[0].reset();
              InitTable();

              
             
              
            }
          }
        });
}); 


});


var page = 1;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          loadMoreData(page);
      }
  });


  function loadMoreData(page){
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
            //console.log(data.html);
              if(data.html == ""){
                  $('.ajax-load').html("No more comments found");
                  return;
              }
              $('.ajax-load').hide();
              $("#comment-data").append(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
                alert('server not responding...');
          });
  }
</script>

@endsection
