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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal" action="{{action('UserController@update', $id)}}" method="post" enctype="multipart/form-data" role="form">
@csrf
<input name="_method" type="hidden" value="PATCH">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Staff/User {{$user->fname}} {{$user->lname}}</h3>
              <span class="pull-right">
                    @can('show-staff')<a href="{!! url('/admins/'.$user['id']); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> View</a>@endcan
              </span>
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
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ $user->fname }}" require >
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
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ $user->lname }}" autocomplete="off" require>
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
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="{{ $user->phonenumber }}" autocomplete="off" required>
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
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" value="{{ $user->mobilenumber }}" autocomplete="off" required>
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
                            <input type="radio" id="genderm" name="gender" value="male" {{ ($user->staffdetails->gender=='male') ? 'checked' : '' }}>
                            <label for="genderm">Male</label>
                            <input type="radio" id="genderf" name="gender" value="female" {{ ($user->staffdetails->gender=='female') ? 'checked' : '' }}> 
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
                                      <option value="{{$department->id}}"  {{ ($department->id==$user->department_id) ? 'selected' : '' }}    >{{$department->deptname}}</option>    
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
                                                      <option value="{{$designation->id}}"" {{ ($designation->id==$user->designation_id) ? 'selected' : '' }}>{{$designation->name}}</option>                    
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
                                                          <option value="{{$role->id}}" {{ ($role->id==$user->role_id) ? 'selected' : '' }}>{{$role->role_title}}</option>                    
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
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" autocomplete="off" require>
                                        @if ($errors->has('email'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Status</label>
                    
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="1" <?php echo ($user->status==1) ? "selected" : ""; ?>>Active</option>
                                            <option value="2" <?php echo ($user->status==2) ? "selected" : ""; ?>>Deactivate</option>
                                        </select>
                                    </div>
                                    </div>
                
                            </div>
                            </div>
                
                        </div>
                
                </div>
                </div>
            </div>
    <!-- Regarding User now end-->
    
    <!-- Other Info & Settings begins -->
    <div class="row">
            <div class="col-md-12">
            
                    
                    <div class="box-footer">
                            <a href="{!! url('/admins'); !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right">Update Staff</button>
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