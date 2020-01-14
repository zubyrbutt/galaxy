@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif

<style>
  .select2-container{
    width: 100% !important;
  }
</style>
 <form class="form-horizontal" action="{!! url('/leads'); !!}" method="post" enctype="multipart/form-data">
    <div class="box box-info">


            @csrf

            <div class="box-header with-border">
              <h3 class="box-title">Add New Lead</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
          <div class="box-body" >
			
            <div class="row">			
                <div class="col-md-12">
                    <h3 class="box-title">Customer/Lead Information</h3>
                </div>
			<!-- Customer Info -->

                  <div class="col-md-12">
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
              
                  <div class="form-group" >
                      <label class="col-sm-3 control-label">Select Customer</label>
                       <div class="col-sm-9">
                          <input class="customer_select" type="radio" id="addnew" name="customer_select" value="add_new" checked="">
                          <label for="add_new">Add New</label>
                          <span style="margin-left: 15px">
                            <input class="customer_select" type="radio" id="existing" name="customer_select" value="existing"> 
                            <label for="type_group">Existing Customer</label>
                          </span>
                      </div>
                  </div>
                </div>

              <input type="hidden" id="customer_id" name="customer_id" value="0">

              <div class="col-md-12" id="select_customer" style="display: none;">
                <div class="form-group" >
                  <label for="" class="col-sm-3"></label>
                  <div class="col-sm-6">
                  <select class="form-control m-bot15 select2" id="customer" >
                    <option value="0" disabled="" selected="">Select Customer</option>
                    @foreach($users as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->fname }} {{ $customer->lname }}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('customer_id'))
                          <span class="text-red">
                              <strong>{{ $errors->first('customer_id') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-md-12" id="addnew_customer" >
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

                <div class="form-group">
                  <label for="mobilenumber" class="col-sm-3 control-label">Mobile/Cell Number</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile/Cell Number" value="{{ old('mobilenumber') }}" autocomplete="off" require>
                    @if ($errors->has('mobilenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('mobilenumber') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="whatsapp" class="col-sm-3 control-label">WhatsApp Number</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number" value="{{ old('mobilenumber') }}" autocomplete="off" require>
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
                    <input type="text" class="form-control" id="ccountry" name="ccountry" placeholder="Current Country" value="{{ old('ccountry') }}" autocomplete="off" require>
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
                    <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession" value="{{ old('profession') }}" autocomplete="off" require>
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
                    <input type="date" class="form-control" id="leaddate" name="leaddate" placeholder="Lead Date" autocomplete="off" />
                    </div>      
                </div>


                <div class="form-group">
                    <label for="cityinterest" class="col-sm-3 control-label">City of  Interest</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="cityinterest" name="cityinterest" placeholder="City of Interest" autocomplete="off" />
                    </div>      
                </div>

                <div class="form-group">
                            <label for="gendar" class="col-sm-3 control-label">Property Type</label>
                    
                            <div class="col-sm-9">
                                <input class="group_type" type="checkbox" id="residential" name="residential" value="residential" checked="">
                                <label for="residential">Residential</label>
                                <input class="group_type" type="checkbox" id="commercial" name="commercial" value="commercial"> 
                                <label for="commercial">Commercial</label>
                            </div>
                  </div>

                  <div class="form-group">
                            <label class="col-sm-3 control-label">Interested In</label>
                    
                            <div class="col-sm-9">
                                <input class="group_type" type="checkbox" id="cash" name="cash" value="cash" checked="">
                                <label for="cash">Cash</label>
                                <input class="group_type" type="checkbox" id="installment" name="installment" value="installment"> 
                                <label for="installment">Installment</label>
                            </div>
                  </div>

                  <div class="form-group">
                            <label for="investmenthistory" class="col-sm-3 control-label">History of Investment</label>
                    
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="investmenthistory" name="investmenthistory" placeholder="History of Investment" autocomplete="off" />
                            </div>
                  </div>


                  <div class="form-group">
                            <label for="investmentpurpose" class="col-sm-3 control-label">Purpose of Investment</label>
                    
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="investmentpurpose" name="investmentpurpose" placeholder="Purpose of Investment" autocomplete="off" />
                            </div>
                  </div>


                
                <div class="form-group">
                          <label class="col-sm-3 control-label">Comments</label>
                    <div class="col-sm-9">
                              <textarea class="form-control" rows="3" id="comments" name="comments" placeholder="Enter Comments if any..."></textarea>
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
    
  
             {{-- <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Assigned To</label>
                    <div class="col-sm-9">
                        <select name="agentid" class="form-control select2" data-placeholder="Select Satff" width="100%">
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                        @endforeach                
                        </select>
                    </div>
              </div> --}}

              <div class="form-group">
                <label for="source" class="col-sm-3 control-label">Lead Source</label>
                <div class="col-sm-9">
                    <select name="source" class="form-control select2" data-placeholder="Select Source"  width="100%">
                        <option value="call" selected>Call</option>
                        <option value="facebook">Facebook</option>
                        <option value="googleads">Google Ads</option>
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
  </div>

  </form>


<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(function() {
$('.select2').select2();
});
</script>
@endsection
@push('scripts')

<script>
$(function() {
$('.select2').select2();
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

<script>
$(document).ready(function() { 
    // $('.select2').select2({
    //     placeholder: "Select Staff",
    //     multiple: false,
    // }); 


    jQuery('#customer').change(function(){
      jQuery('#customer_id').val(jQuery(this).val());
    });

    jQuery('.customer_select[name="customer_select"]').change(function(){
      if(jQuery(this).val() == 'add_new'){
        jQuery('#select_customer').slideUp();
        jQuery('#addnew_customer').slideDown();
        jQuery('#customer_id').val(0);
        
      }else if(jQuery(this).val() == 'existing'){
        jQuery('#addnew_customer').slideUp();
        jQuery('#select_customer').slideDown();

      }
      
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


<script>
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

<script type="text/javascript">

  jQuery('#time_zone').on('change',function(){
    changetextfunction();
    var token = $("input[name='_token']").val();
    $.ajax({
              url: "<?php echo route('time_zones') ?>",
              dataType : 'json',
              method: 'POST',
              data: {
                
                zone:jQuery(this).val(),
                _token:token,
               
              },
              success: function(data) {
                jQuery('#Time').html(data);
                  var html = '';
                data.forEach(function(value,index){
                  html += `<option value="${value}">${value}</option>`;
                });

                jQuery('#Time').html(html);
                
              }
          });
  });

  
  jQuery('#Time').on('change',function(){
      changetextfunction();
      var token = $("input[name='_token']").val();
      $.ajax({
                url: "<?php echo route('convertToPak') ?>",
                dataType : 'text',
                method: 'POST',
                data: {
                  
                  time:jQuery(this).val(),
                  zone:jQuery('#time_zone').val(),
                  _token:token,
                 
                },
                success: function(data) {
                  jQuery('#pakTime').val(data);
                }
            });
  });
  
  jQuery('.group_type[name="type"]').change(function(){
    jQuery('#classType option:first-child').prop('selected',true);
  });

  $("select[name='classType']").change(function(){
  
    if ($("select[name='classType']")[0].selectedIndex <= 0) {
      $("select[name='teacherID'").html('');
      alert('Please select Class days.');
      $("select[name='classType']").focus();
      return false;
  }

  var course=document.getElementById('courseID').value;
  var classType=document.getElementById('classType').value;
  var group_type=jQuery('.group_type[name="type"]:checked').val();
  // var pakTimelist=document.getElementById('pakTime');
  // var pakTime = pakTimelist.options[pakTimelist.selectedIndex].text;
  var pakTime = jQuery('#pakTime').val();
  var zoneID=0; 
  var slotDuration=document.getElementById('slotDuration').value
  
  //alert(course+" "+classType+" "+pakTime);

      var classType = $(this).val();
    console.log(classType);
      var token = $("input[name='_token']").val();
    //alert(usertype_teamlead);
    $.ajax({
          url: "<?php echo route('/schedule/availableTeacher') ?>",
      dataType : 'json',
          method: 'POST',
          data: {classType:classType,slotDuration:slotDuration,course:course,pakTime:pakTime,_token:token,type:group_type},
          success: function(data) {
        console.log(token);
        console.log(data);
            $("select[name='teacherID'").html('');
            $("select[name='teacherID'").html(data.options);
          }
      });
  });
</script>
<!-- Select2 script START -->
<script>        
     $(document).ready(function() { 
        $('.select2').select2({
          placeholder: "Select From DropDown",
          multiple: false,
        }); 
        $('.select2').change(
        console.log("select2-console-log")
        );
      });

</script>
<!-- Select2 script ENDS -->

<script>        
  function changetextfunction()
  {
    document.getElementById("startDate").value='';
    document.getElementById("slotDuration").selectedIndex=0;
    document.getElementById("courseID").selectedIndex=0;
    document.getElementById("classType").selectedIndex=0;
    document.getElementById("teacherID").selectedIndex=0;
    
  }
</script>
@endpush