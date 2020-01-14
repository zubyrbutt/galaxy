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

<form class="form-horizontal" action="{!! url('/admins'); !!}" method="post" enctype="multipart/form-data" role="form">
    @csrf
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Staff</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>   
            <div class="box-body" >
            <div class="row">
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                      <div class="file-loading">
                          
                          <input id="avatar-1" name="avatar-1" type="file">
                      </div>
                  </div>
                  <div class="kv-avatar-hint"><small>Select file < 1000 KB</small></div>
              </div> 
              <div class="col-md-8">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">First Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ old('fname') }}" required >
                    @if ($errors->has('fname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('fname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="lname" class="col-sm-3 control-label">Last Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}" autocomplete="off" required>
                    @if ($errors->has('lname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('lname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}" autocomplete="off" required>
                    @if ($errors->has('phonenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('phonenumber') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="mobilenumber" class="col-sm-3 control-label">Mobile Number</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" value="{{ old('mobilenumber') }}" autocomplete="off" required>
                    @if ($errors->has('mobilenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('mobilenumber') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>


                <div class="form-group">
                    <label for="gendar" class="col-sm-3 control-label">Gender</label>
            
                    <div class="col-sm-9">
                        <input type="radio" id="genderm" name="gender" value="male" checked>
                        <label for="genderm">Male</label>
                        <input type="radio" id="genderf" name="gender" value="female"> 
                        <label for="genderf">Female</label>

                        

                        @if ($errors->has('gender'))
                            <span class="text-red">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              
              </div>
              </div>
          </div>
</div>


<!-- Regarding User row begins -->
<div class="row">
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
                        <div class="form-group">
                            <label for="department_id" class="col-sm-3 control-label">Select Department</label>
          
                            <div class="col-sm-9">
                                <select class="select2 form-control" id="department_id" name="department_id" required>
                                    <option value="" selected>None</option>    
                                  @foreach ($departments as $department)
                                  <option value="{{$department->id}}"  {{ ($department->id==old('department_id')) ? 'selected' : '' }}    >{{$department->deptname}}</option>    
                                  @endforeach
                                </select>
                              @if ($errors->has('department_id'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                          <div class="form-group">
                                <label for="designation_id" class="col-sm-3 control-label">Select Designation</label>
              
                                <div class="col-sm-9">
                                  <select id="designation_id" name="designation_id" class="form-control select2" required>
                                          @if(count($designations) > 0)
                                              <option value="" selected>None</option>
                                              @foreach($designations as $designation)    
                                                  <option value="{{$designation->id}}"" {{ ($designation->id==old('designation_id')) ? 'selected' : '' }}>{{$designation->name}}</option>                    
                                              @endforeach
                                          @else
                                              <option value="">None</option>
                                          @endif
                                      </select>
                                      @if ($errors->has('designation_id'))
                                      <span class="text-red">
                                          <strong>{{ $errors->first('designation_id') }}</strong>
                                      </span>
                                      @endif
                                </div>
                              </div>

                              <div class="form-group">
                                    <label for="role_id" class="col-sm-3 control-label">Select Role</label>
                  
                                    <div class="col-sm-9">
                                      <select id="role_id" name="role_id" class="form-control select2" required>
                                              @if(count($roles) > 0)
                                                  <option value="" selected>None</option>
                                                  @foreach($roles as $role)    
                                                      <option value="{{$role->id}}" {{ ($role->id==old('role_id')) ? 'selected' : '' }}>{{$role->role_title}}</option>                    
                                                  @endforeach
                                              @else
                                                  <option value="">None</option>
                                              @endif
                                          </select>
                                          @if ($errors->has('role_id'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                            </span>
                                          @endif
                                    </div>
                                  </div>



                    </div>
                </div>
    
            </div>
    
    </div>
    </div>
    
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
                            
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                                    @if ($errors->has('email'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                
                                <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password</label>
                
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="{{str_random(6)}}" autocomplete="off" required>
                                    @if ($errors->has('password'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>

            
                        </div>
                        </div>
            
                    </div>
            
            </div>
            </div>
        </div>
<!-- Regarding User now end-->

        
           
                <div class="box-footer">
                        <a href="{!! url('/admins'); !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right">Add Staff</button>
                      </div>
                      <!-- /.box-footer -->
        </div>
        </div>
        
</div>
<!-- Other Info & Settings end-->


</form>


@endsection


@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<style>
.select2-container--classic .select2-selection--single .select2-selection__rendered{
    line-height: 35px;
    
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 8px;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #3c8dbc;
    border-radius: 4px;
}
.select2 {
width:100%!important;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    

$(document).ready(function (e) {
    $(".select2").select2({
    theme: "classic"
    });

    $('[data-mask]').inputmask();
});

$(function () {
    $('#starttime, #endtime').datetimepicker({
        format: 'LT'
    });
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
</script>

@endpush