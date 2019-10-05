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

<!-- Form start -->

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Budget Categories</h3>
              
              <!--<span class="pull-right">
                <a href="" class="btn btn-info"><span class="fa fa-plus"></span> Add Trulies</a>
              </span>-->
              
            </div>
            <!-- /.box-header -->
      <div class="box-body">

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


        <form class="form-horizontal form" action="{{route('budgetCategory.store')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">Category Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" autocomplete="off" value="{{ old('category_name') }}" require >
                    <span class="text-red">
                              <strong class="category_name"></strong>
                    </span>
                    @if ($errors->has('category_name'))
                          <span class="text-red">
                              <strong>{{ $errors->first('category_name') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="parent_id" class="col-sm-3 control-label">Parent</label>

                  <div class="col-sm-9">
                    <select type="text" class="form-control" id="parent_id" name="parent_id" require>
                      <option value="0">Parent</option>
                      @foreach($budgetCategories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                      @endforeach
                      

                      </select>
                      @if ($errors->has('parent_id'))
                          <span class="text-red">
                              <strong>{{ $errors->first('parent_id') }}</strong>
                          </span>
                      @endif
                      <span class="text-red">
                              <strong class="parent_id"></strong>
                    </span>
                  </div>
                </div>
              </div>
              </div>
          </div>
                   <input type="hidden" name="edit_id" id="edit_id" value="">

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
        </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Form end -->

<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Categories</h3>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table  class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                  
                </thead>
                <tbody id="table_data">
                  
                </tbody>
                
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->
      <!-- /.row -->  
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
  var InitTable = function() {
        
           $.ajax({
             "url": "{{ route('budgetCategory.fetch') }}",
             "dataType": "json",
             "type": "POST",
             "data":{ _token: "{{csrf_token()}}"},

             "complete": function(xhr, responseText){
                 //myJSON = JSON.stringify(xhr);
                    console.log(xhr);
                    console.log(xhr.responseText);
                    $('#table_data').html(xhr.responseText);
                },
              });
    
}

$( document ).ready(function() {

  InitTable();

$( "form" ).submit(function( event ) {
  var data = $( this ).serializeArray();
  event.preventDefault();
  $.ajax({
          data: data,
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          success: function(response)
          {
            if(response.errors)
            {
              $(".category_name").html(response.errors.category_name);
              $(".parent_id").html(response.errors.parent_id);
              var success = $('.category_name');
              scrollTo(success,-100);
              
            }
            else
            {
           
              InitTable();
              $('.success').html(response);
              $('#success').show();
              $('.form')[0].reset();
              var succ = $('.success');
              scrollTo(succ,-100);
              
            }
          }
        });
});



$(document).on('click', '.edit', function()
{

var id = $(this).attr('data-id');
$.ajax({
        "url": "{{route('budgetCategory.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
          $('#edit_id').val(data.id);
          $('#category_name').val(data.category_name);
          $('#parent_id').val(data.parent_id);
                                
          var success = $('#edit_id');
          scrollTo(success,-100);
        },
          error: function(){},          
      });
});


$(document).on('click', '.delete-category', function()
{
//alert('asdasd');
   $('.tab-pane').removeClass('active');
  $('#colored-rounded-tab1').addClass('active');
var id = $(this).attr('data-id');
$.ajax({
        "url": "",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
              InitTable();
              $('.delete').html(data);
              $('#delete').show();
              var succ = $('.delete');
              scrollTo(succ,-100);
        },
          error: function(){},          
      });
});


});
</script>
@endsection