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

		  	  				
			     <div id="attributes">
            <div class="form-group attributes" id="attribute_1">
                    <label for="description" class="col-sm-3 control-label">Attribute</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" name="attributes[]" placeholder="Attribute Name" autocomplete="off" />
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" autocomplete="off" />
                    </div>
                    <div class="col-sm-1">
                      <span class="btn btn-danger attribute_add_btn" style="width: 100%" onclick="removeRow('1')">x</span>
                    </div>
             </div>   
           </div>

            <div class="form-group">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-8">
                    
                  </div>
                  <div class="col-sm-1">
                    <span class="btn btn-primary" style="width: 100%" id="attribute_add_btn" >+</span>
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


function removeRow(row_no){
  $('#attribute_'+row_no).remove();
}


$(function () {


    var row_number = 2;

    $('#attribute_add_btn').click(function(){
      
      var attribute_new = `<div class="form-group attributes" id="attribute_${row_number}">
                  <label for="description" class="col-sm-3 control-label">Attribute</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="attributes[]" placeholder="Attribute Name" autocomplete="off" />
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" autocomplete="off" />
                  </div>
                  <div class="col-sm-1">
                    <span class="btn btn-danger" style="width: 100%" onclick="removeRow(${row_number})">x</span>
                  </div>
           </div>`;

      row_number = row_number + 1;
      $('#attributes').append(attribute_new);     
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