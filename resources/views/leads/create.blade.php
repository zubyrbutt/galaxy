@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Lead</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('/leads'); !!}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			
            <div class="row">			
                <div class="col-md-12">
                    <h3 class="box-title">Customer Information</h3>
                </div>
			<!-- Customer Info -->	
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">First Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ old('fname') }}" require >
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
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}" autocomplete="off" require>
                    @if ($errors->has('lname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('lname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

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
                  <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}" autocomplete="off" require>
                    @if ($errors->has('phonenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('phonenumber') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
			</div>
			<!-- Lead Info -->					
            
			<div class="col-md-12">
              <h3 class="box-title">Lead Information</h3>
            </div> 
            <div class="col-md-12">
			<div class="form-group">
                  <label for="businessName" class="col-sm-3 control-label">Business Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Business Name" autocomplete="off" value="{{old('businessName')}}" require >
                    @if ($errors->has('businessName'))
                          <span class="text-red">
                              <strong>{{ $errors->first('businessName') }}</strong>
                          </span>
                      @endif
                  </div>
            </div>

            <div class="form-group">
                  <label for="businessName" class="col-sm-3 control-label">Business Address</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="businessAddress" name="businessAddress" placeholder="Business Address" autocomplete="off" value="{{old('businessAddress')}}" require >
                    @if ($errors->has('businessAddress'))
                          <span class="text-red">
                              <strong>{{ $errors->first('businessAddress') }}</strong>
                          </span>
                      @endif
                  </div>
            </div>


			<div class="form-group">
                  <label for="businessNature" class="col-sm-3 control-label">Business Nature</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="businessNature" name="businessNature" placeholder="Business Nature" autocomplete="off" value="{{old('businessNature')}}" require >
                    @if ($errors->has('businessNature'))
                          <span class="text-red">
                              <strong>{{ $errors->first('businessNature') }}</strong>
                          </span>
                    @endif
                  </div>
            </div>

			<div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea rows="10" class="form-control" id="description" name="description" placeholder="Description" autocomplete="off" require >{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                          <span class="text-red">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                  </div>
            </div>
			
			<!-- checkboxes -->
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Shared Company Profile</button>
                    <input type="checkbox" class="hidden"  name="company_pro" value="1">
                    </span>

                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Shared Tesimonials</button>
                    <input type="checkbox" class="hidden"  name="testimonials" value="1">
                    </span>

                    <span class="button-checkbox">
                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Shared Solutions & Services</button>
                    <input type="checkbox" class="hidden"  name="solser" value="1">
                    </span>

                </div>
            </div>

			<!-- Social links -->						
			<div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Facebook Link:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fblink" name="fblink" placeholder="Facebook link" autocomplete="off" />
                  </div>
                  <div class="col-sm-3">
                    <input type="number" class="form-control" id="fblike" name="fblike" placeholder="Facebook Likes" autocomplete="off" />
                  </div>
            </div>
			<div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Twitter</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="twlink" name="twlink" placeholder="Twitter Link" autocomplete="off"  />
                  </div>
                  <div class="col-sm-3">
                    <input type="number" class="form-control" id="twfollwer" name="twfollwer" placeholder="Twitter Follower" autocomplete="off"  />
                  </div>
            </div>
			<div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Instagram</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="inlink" name="inlink" placeholder="Instagram Link" autocomplete="off"   />
                  </div>
                  <div class="col-sm-3">
                    <input type="number" class="form-control" id="incfollower" name="incfollower" placeholder="Instagram Follower" autocomplete="off"  />
                  </div>
            </div>
			<div class="form-group">
                  <label for="description" class="col-sm-3 control-label">LinkedIn</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="lilink" name="lilink" placeholder="LinkedIn Link" autocomplete="off" />
                  </div>
                  <div class="col-sm-3">
                    <input type="number" class="form-control" id="livisitor" name="livisitor" placeholder="LinkedIn Visitor" autocomplete="off" />
                  </div>
            </div>
			<div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Web</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="weblink" name="weblink" placeholder="Website Address if any" autocomplete="off" value="" />
                  </div>
            </div>

            <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Assigned To</label>
                    <div class="col-sm-9">
                        <select name="agentid" class="form-control select2" data-placeholder="Select Satff" width="100%">
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                        @endforeach                
                        </select>
                    </div>
              </div>
              <div class="form-group">
                <label for="source" class="col-sm-3 control-label">Lead Source</label>
                <div class="col-sm-9">
                    <select name="source" class="form-control select2" data-placeholder="Select Source"  width="100%">
                        <option value="Call">Call</option>
                        <option value="Facebook">Facebook</option>
                    </select>
                </div>
            </div>
			
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/lead/leadshow'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() { 
    $('.select2').select2({
        placeholder: "Select Staff",
        multiple: false,
    }); 
});
$(function () {
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