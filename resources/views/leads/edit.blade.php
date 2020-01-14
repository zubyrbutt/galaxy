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
              <h3 class="box-title">Edit Lead</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('LeadController@update', $lead->id)}}" method="post" enctype="multipart/form-data">
            @csrf
			<input name="_method" type="hidden" value="PATCH">
          <div class="box-body" >
			
            <div class="row">			
                <div class="col-md-12">
                    <h3 class="box-title">Customer/Lead Information</h3>
                </div>
			<!-- Customer Info -->	
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">First Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ $lead->user->fname }}" readonly >
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
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ $lead->user->lname }}" autocomplete="off" readonly>
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
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $lead->user->email }}" autocomplete="off" readonly>
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
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="{{ $lead->user->phonenumber }}" autocomplete="off" readonly>
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
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" value="{{ $lead->user->mobilenumber }}" autocomplete="off" readonly>
                    @if ($errors->has('mobilenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('mobilenumber') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="whatsapp" class="col-sm-3 control-label">WhatsApp</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number" value="{{ $lead->user->whatsapp }}" autocomplete="off" readonly>
                    @if ($errors->has('whatsapp'))
                          <span class="text-red">
                              <strong>{{ $errors->first('whatsapp') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
			</div>
			<!-- Lead Info -->		

      {{-- Close by Property --}}      
      <input type="hidden" id="lead_close_by" name="lead_close_by" value="property">
    
            <div class="col-md-12">
                    <div class="box-body" >
                    <div class="row">
                      <div class="col-md-12">

                      <div class="form-group">
                  <label for="country" class="col-sm-3 control-label">Current Country</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="ccountry" name="ccountry" placeholder="Current Country" value="{{ $lead->ccountry }}" autocomplete="off" require>
                    @if ($errors->has('ccountry'))
                          <span class="text-red">
                              <strong>{{ $errors->first('ccountry') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>


                <div class="form-group">
                  <label for="profession" class="col-sm-3 control-label">Profession</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession" value="{{ $lead->profession }}" autocomplete="off" require>
                    @if ($errors->has('profession'))
                          <span class="text-red">
                              <strong>{{ $errors->first('profession') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>



                <div class="form-group">
                    <label for="startDate" class="col-sm-3 control-label">Lead Date</label>
                    <div class="col-sm-9">
                    <input type="date" class="form-control" id="leaddate" name="leaddate" placeholder="Lead Date" autocomplete="off" value="{{ $lead->leaddate->format('Y-m-d') }}" />
                    </div>      
                </div>


                <div class="form-group">
                    <label for="cityinterest" class="col-sm-3 control-label">City of  Interest</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="cityinterest" name="cityinterest" placeholder="City of Interest" autocomplete="off" value="{{ $lead->cityinterest }}" />
                    </div>      
                </div>

                <div class="form-group">
                            <label for="gendar" class="col-sm-3 control-label">Property Type</label>
                    
                            <div class="col-sm-9">
                                <input class="group_type" type="checkbox" id="residential" name="residential" value="residential" {{($lead->residential=== 1 ? "checked" : "")}}>
                                <label for="residential">Residential</label>
                                <input class="group_type" type="checkbox" id="commercial" name="commercial" value="commercial" {{($lead->commercial=== 1 ? "checked" : "")}}> 
                                <label for="commercial">Commercial</label>
                            </div>
                  </div>

                  <div class="form-group">
                            <label class="col-sm-3 control-label">Interested In</label>
                    
                            <div class="col-sm-9">
                                <input class="group_type" type="checkbox" id="cash" name="cash" value="cash" {{($lead->cash=== 1 ? "checked" : "")}}>
                                <label for="cash">Cash</label>
                                <input class="group_type" type="checkbox" id="installment" name="installment" value="installment" {{($lead->installment=== 1 ? "checked" : "")}}> 
                                <label for="installment">Installment</label>
                            </div>
                  </div>

                  <div class="form-group">
                            <label for="investmenthistory" class="col-sm-3 control-label">History of Investment</label>
                    
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="investmenthistory" name="investmenthistory" placeholder="History of Investment" value="{{ $lead->investmenthistory }}" autocomplete="off" />
                            </div>
                  </div>


                  <div class="form-group">
                            <label for="investmentpurpose" class="col-sm-3 control-label">Purpose of Investment</label>
                    
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="investmentpurpose" name="investmentpurpose" placeholder="Purpose of Investment" value="{{ $lead->investmentpurpose }}" autocomplete="off" />
                            </div>
                  </div>


                
                <div class="form-group">
                          <label class="col-sm-3 control-label">Comments</label>
                    <div class="col-sm-9">
                              <textarea class="form-control" rows="3" id="comments" name="comments" placeholder="Enter Comments if any...">{{$lead->comments}}</textarea>
                    </div>
                </div>

                      </div>
                      </div>

                  </div>
                      <!-- /.box-body -->
        {{-- Close by Property --}}  			
            
			<div class="col-md-12">
              <h3 class="box-title">Other Information</h3>
            </div> 
            <div class="col-md-12">
			
		      
            <div id="attributes">
              @php 
                  $next_row = 1;
              @endphp
              @if($lead->attributes)
                @php 
                  $attributes = unserialize($lead->attributes) 
                @endphp
                
                @foreach($attributes as $index => $attribute)

                    <div class="form-group attributes" id="attribute_{{ $index + 1 }}">
                        <label for="description" class="col-sm-3 control-label">Attribute</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" name="attributes[]" placeholder="Attribute Name" value="{{ $attribute['name'] }}" autocomplete="off" />
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" value="{{ $attribute['value'] }}" autocomplete="off" />
                          </div>
                          <div class="col-sm-1">
                            <span class="btn btn-danger attribute_add_btn" style="width: 100%" onclick="removeRow({{ $index + 1 }})">x</span>
                          </div>
                   </div>
                @php 
                  $next_row = $index + 2;

                @endphp
                @endforeach
                @endif

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
                <label for="source" class="col-sm-3 control-label">Lead Source</label>
                <div class="col-sm-9">
                    <select name="source" class="form-control select2" data-placeholder="Select Source"  width="100%">
                        <option value="call" {{($lead->source=== "call" ? "selected" : "")}}>Call</option>
                        <option value="facebook" {{($lead->source=== "facebook" ? "selected" : "")}}>Facebook</option>
                        <option value="googleads" {{($lead->source=== "googleads" ? "selected" : "")}}>Google Ads</option>
                    </select>
                </div>
            </div>
		
            <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Assigned To</label>
                    <div class="col-sm-9">
                        <select name="agentid" class="form-control select2" data-placeholder="Select Satff"  width="100%">
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}" {{($agent->id==$lead->assignedto) ? "selected" : ""}} >{{$agent->fname}} {{$agent->lname}}</option>
                        @endforeach                
                        </select>
                    </div>
              </div>
              
              
              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
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

   var row_number = {{ $next_row }};

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