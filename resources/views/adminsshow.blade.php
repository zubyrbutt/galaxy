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
    body{
        padding-right: 0 !important;
    }
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
<div id="PrintArea">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{$user->fname}} {{$user->lname}} Details</h3>
              <span class="pull-right">
                  @can('edit-staff')
                    <a href="{!! url('/admins/'.$user['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> Edit </a>
                  @endcan
                  
              </span>
            </div>
            
            
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row">
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                          <img src="{{ asset('img/staff/'.$user->avatar) }}" width="90%">
                  </div>
              </div> 
              <div class="col-md-8">
              <table class="table table-striped">
                <tr>
                    <td><b>First Name</b></td>
                    <td>{{$user->fname}}</td>
                </tr>
                <tr>
                    <td><b>Last Name</b></td>
                    <td>{{$user->lname}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td><b>Phone Number</b></td>
                    <td>{{$user->phonenumber}}</td>
                </tr>
                <tr>
                    <td><b>Mobile Number</b></td>
                    <td>{{$user->mobilenumber}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        @if ($user->status === 1)
                          <span class="text-green"><b>Active</b></span>
                        @else
                            <span class="text-red"><b>Deactive</b></span>
                        @endif
                    </td>
                </tr>
              </table>
              </div>
             </div>
          </div>
</div>


<?php $count=0; ?>

<!-- Regarding User row begins -->
{{--<div class="row">--}}
    @can('view-UserDepartmentRole')
    <div class="col-md-6">
    <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">User Department & Role</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                              <td>Deparment</td>
                              <td>{{$user->department->deptname}}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{$user->designation->name}}</td>
                              </tr>
                              <tr>
                                  <td>User Role</td>
                                  <td>{{$user->role->role_title}}</td>
                                </tr>
                          </table>
                    </div>
                </div>
            </div>
    </div>
    </div>
            <?php $count++;
            if($count%2==0){
                echo '<div class="clearfix"></div>';
            }
            ?>
    @endcan
    @can('view-userAccountInfo')
    <div class="col-md-6">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Account Info</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                  <td>Email</td>
                                  <td>{{ $user->email }}</td>
                                </tr> 
                                <tr>
                                  <td>Status</td>
                                  <td>
                                      @if ($user->status === 1)
                                        <span class="text-green"><b>Active</b></span>
                                      @else
                                        <span class="text-red"><b>Deactive</b></span>
                                      @endif  
                                  </td>
                                </tr>
                              </table>
                        </div>
                        </div>
                    </div>
            
            </div>
            </div>
            <?php $count++;
            if($count%2==0){
                echo '<div class="clearfix"></div>';
            }
            ?>
    @endcan
    {{--<div class="clearfix"></div>--}}
 </div>
<!-- Regarding User now end-->





<div class="loading">
    <div class="loader"></div>
</div>

@endsection

@push('scripts')
<style>
    .loading{
        display: hidden;
        position: fixed;
        left: 0;
        top: 0;
        padding-top: 45vh;
        padding-left:100vh;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: gray;
        opacity: 0.8;
    }
    .loader {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    </style>

<script>
$(document).ready(function (e) {
  $(".loading").fadeOut();
  $("#PrintDetail").click(function () {
    printDetails();
  });
  //Attendance Filter begins
  $('#filterDept').click( function() {
    var url;
    if($('#srchmonth').val()!=""){
      url="{{url('admins')}}/{{$user->id}}/?srchmonth="+$('#srchmonth').val();
    }else{
      url ="{{url('admins')}}/{{$user->id}}/";
    }
    window.location.href =url;
  }); 
  //Attendance Filter ends
  $('#checkin, #checkout').datetimepicker({
            format: 'LT'
        });
  //Edit Attendance Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('attendancesheet.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          //Populating Form Data to Edit Begins
          $('#modal-default-edit').modal('toggle');
          $('#editid').val(data.id);
          $('#dated').val(data.dated);
          $('#checkin').val(data.checkin);
          $('#checkin').val(data.checkin);
          $('#checkout').val(data.checkout);
          $('#checkoutfound').val(data.checkoutfound);
          $('#shortleaves').val(data.shortleaves);
          $('#tardies').val(data.tardies);
          $('#workedhours').val(data.workedhours);
          $('#remarks').val(data.remarks);
          $('#status').val(data.status);
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Attendance Form Ends
  //Update Attendance Begins
  $("#frmEdit").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('attendancesheet.update')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  swal("Failed", "Unable to update, " + data.errors.dated , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEdit")[0].reset(); 
                  swal("Success", data.success, "success");
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to updated, Please try again later.", "error");
              }          
       });
    }));
    //Update Attendance Ends
  });




// add employee checklist data 

$(document).on('submit','#checklistForm',function(event){
  event.preventDefault();
  var formdata = $('#checklistForm').serializeArray();

  $.ajax({
      url: "{{route('adduserchecklists')}}",
      data: formdata,
      type: 'POST',
      success: function (data) {
         swal({
            title: "Success!",
            text: "Data Saved Successfully!",
            icon: "success",
            button: "Close",
        });
      },
      error: function (xhr, status, error) {

      }
  });
});


// add employee checklist data 

$(document).on('submit','#userEndServiceChecklistForm',function(event){
  event.preventDefault();
  var formdata = $('#userEndServiceChecklistForm').serializeArray();
  // console.log(formdata);return;
  $.ajax({
      url: "{{route('endservicelists')}}",
      data: formdata,
      type: 'POST',
      success: function (data) {
         swal({
            title: "Success!",
            text: "Data Saved Successfully!",
            icon: "success",
            button: "Close",
        });
      },
      error: function (xhr, status, error) {

      }
  });
});

// add employee checklist data 

$(document).on('submit','#endserviceForm',function(event){
  event.preventDefault();
  // var formdata = $('#endserviceForm').serializeArray();
  var form = $('#endserviceForm')[0];
  var formData = new FormData(form);
  //console.log(formdata);//return;
  $.ajax({
      url: "{{route('endservice')}}",
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
         swal({
            title: "Success!",
            text: "Data Saved Successfully!",
            icon: "success",
            button: "Close",
        });
      },
      error: function (xhr, status, error) {

      }
  });
});



</script>
@endpush
 