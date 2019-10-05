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
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Make Regular</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! url('schedule/storeMakeRegular'); !!}" method="post" enctype="multipart/form-data">
            @csrf
			<input type="hidden" id="schedule_id" name="schedule_id" value="{{ $id }}" />
			<input type="hidden" id="studentID" name="studentID" value="{{ $data['studentID'] }}" />
			<input type="hidden" id="teacherID" name="teacherID" value="{{ $data['teacherID'] }}" />
			<input type="hidden" id="agentId" name="agentId" value="{{ $data['agentId'] }}" />
			
            <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
				
				<div class="form-group">
					  <label for="studentID" class="col-sm-3 control-label">Student Name(Static)</label>
					  <div class="col-sm-6">
						<label for="studentID" class="control-label">{{ $show_schedule->studentname->fname }} {{ $show_schedule->studentname->lname }}</label>
					  </div>      
				</div>
				<div class="form-group">
					  <label for="courseID" class="col-sm-3 control-label">Course(Static)</label>
					  <div class="col-sm-6">
						 <label for="courseID" class="control-label">{{ $show_schedule->coursename->courses }}</label>
					  </div>      
				</div>
				<div class="form-group">
					  <label for="paydate" class="col-sm-3 control-label">Plan(Static)</label>
					  <div class="col-sm-6">
						<label for="paydate" class="control-label">{{ $data['classType'] }}</label>
					  </div>      
				</div>
				<div class="form-group">
					  <label for="paydate" class="col-sm-3 control-label">Start Time(Static)</label>
					  <div class="col-sm-6">
						<label for="paydate" class="control-label">{{ $show_schedule->startTime }}</label>
					  </div>      
				</div>
				
				
				
				<div class="form-group">
					  <label for="signInDate" class="col-sm-3 control-label">SignIn Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="signInDate" name="signInDate" placeholder="" autocomplete="off" onchange='date_rec_date_signin()' />
					  </div>      
				</div>		
				
				<div class="form-group">
					  <label for="dateReceived" class="col-sm-3 control-label">Date Received</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="dateReceived" name="dateReceived" placeholder="" autocomplete="off" readonly='readonly' />
					  </div>      
				</div>
				
				<div class="form-group">
					  <label for="paydate" class="col-sm-3 control-label">Paying Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="paydate" name="paydate" placeholder="" autocomplete="off" readonly='readonly' />
					  </div>      
				</div>
				
				
				
				<div class="form-group">
					  <label for="transactionID" class="col-sm-3 control-label">Transaction ID</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="transactionID" name="transactionID" placeholder="" autocomplete="off" />
					  </div>  
					  @if ($errors->has('transactionID'))
                          <span class="text-red">
                              <strong>{{ $errors->first('transactionID') }}</strong>
                          </span>
                      @endif
				</div>				
				<div class="form-group">
					  <label for="paymentMode" class="col-sm-3 control-label">Method</label>
					  <div class="col-sm-6">
							<select id="method_id" name="method_id" class="form-control m-bot15" onchange='update_payment_method();'>
							@if ($paymentMode!='')
								@foreach($paymentMode as $key => $paymentModes)
								<option value="{{ $key }}" >{{ $paymentModes }}</option>							
								@endforeach
							@endif

							</select>
							@if ($errors->has('method_id'))
							  <span class="text-red">
								  <strong>{{ $errors->first('method_id') }}</strong>
							  </span>
							@endif
					  </div>
				</div>
				
				<!-- onchange="getCurrencyValue(this.value)" -->
				<div class="form-group">
					  <label for="currency" class="col-sm-3 control-label">Currency</label>
					  <div class="col-sm-6">
							<select id="currency_id" name="currency_id"  class="form-control m-bot15">
							@if ($currency!='')
								@foreach($currency as $key => $curr)
								<option value="{{ $key }}" >{{ $curr }}</option>							
								@endforeach
							@endif
							</select>
							@if ($errors->has('currency_id'))
							  <span class="text-red">
								  <strong>{{ $errors->first('currency_id') }}</strong>
							  </span>
							@endif							
					  </div>
				</div>
				<input type='hidden' id='simple_convert' />
				
				
				<div class="form-group">
					  <label for="cardSave_ccv_code" class="col-sm-3 control-label">CCV CODE</label>
					  <div class="col-sm-6">
						<input type="text" style="visibility:hidden;" class="form-control" id="cardSave_ccv_code" name="cardSave_ccv_code" placeholder="" />
					  </div>  
				</div>
				<div class="form-group">
					  <label for="VirtualTerminal_name" class="col-sm-3 control-label">Card holder name</label>
					  <div class="col-sm-6">
						<input type="text" style="visibility:hidden;" class="form-control" id="VirtualTerminal_name" name="VirtualTerminal_name" placeholder="" />
					  </div>  
				</div>
				<div class="form-group">
					  <label for="VirtualTerminal_number" class="col-sm-3 control-label">Card number</label>
					  <div class="col-sm-6">
						<input type="text" style="visibility:hidden;" class="form-control" id="VirtualTerminal_number" name="VirtualTerminal_number" placeholder="" />
					  </div>  
				</div>
				<div class="form-group">
					  <label for="VirtualTerminal_date" class="col-sm-3 control-label">Expiry date</label>
					  <div class="col-sm-6">
						<input type="text" style="visibility:hidden;" class="form-control" id="VirtualTerminal_date" name="VirtualTerminal_date" placeholder="" />
					  </div>  
				</div>
				
				<div class="form-group">
					  <label for="bank_payment_image" class="col-sm-3 control-label">Select file</label>
					  <div class="col-sm-6">
						<input class='form-control' style="visibility:hidden;" type="file" name="bank_payment_image" id="bank_payment_image">						
                        <span class="text-red" style="visibility:hidden;">Only JPG,PNG files are allowed</span>
					  </div>
					  @if ($errors->has('bank_payment_image'))
                          <span class="text-red">
                              <strong>{{ $errors->first('bank_payment_image') }}</strong>
                          </span>
                      @endif					  
				</div>
				
				<div class="form-group">
					  <label for="bankName" class="col-sm-3 control-label">Bank Selection</label>
					  <div class="col-sm-6">
							<select id="bankName" style="visibility:hidden;" name="bankName" class="form-control m-bot15">
							@if ($bankNameList!='')
								@foreach($bankNameList as $key => $bankName)
								<option value="{{ $key }}" >{{ $bankName }}</option>							
								@endforeach
							@endif
							</select>					
					  </div>
				</div>
				
				
				
				<div class="form-group">
					  <label for="amountDefaultNew" class="col-sm-3 control-label">Actual Slot rate (Editable)</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="amountDefaultNew" name="amountDefaultNew" placeholder="" />
					  </div>
					  @if ($errors->has('amountDefaultNew'))
						<span class="text-red">
							<strong>{{ $errors->first('amountDefaultNew') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
					  <label for="amountOriginalNew" class="col-sm-3 control-label">Invoiced Amount</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="amountOriginalNew" name="amountOriginalNew" placeholder="" />
					  </div>
					  @if ($errors->has('amountOriginalNew'))
						<span class="text-red">
							<strong>{{ $errors->first('amountOriginalNew') }}</strong>
						</span>
					  @endif				  
				</div>
				
				<!-- onchange="javascript : calculate_currency_conversion();" -->
				<div class="form-group">
					  <label for="totalReceivedNew" class="col-sm-3 control-label">Net Received</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="totalReceivedNew" name="totalReceivedNew" placeholder="" />
					  </div>
					  @if ($errors->has('totalReceivedNew'))
						<span class="text-red">
							<strong>{{ $errors->first('totalReceivedNew') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
					  <label for="feeDeductNew" class="col-sm-3 control-label">Paypal Fee</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="feeDeductNew" name="feeDeductNew" placeholder="" />
					  </div>
					  @if ($errors->has('feeDeductNew'))
						<span class="text-red">
							<strong>{{ $errors->first('feeDeductNew') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
					  <label for="discountNew" class="col-sm-3 control-label">Discount Given</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="discountNew" name="discountNew" placeholder="" />
					  </div>
					  @if ($errors->has('discountNew'))
						<span class="text-red">
							<strong>{{ $errors->first('discountNew') }}</strong>
						</span>
					  @endif					  
				</div>

				<div class="form-group">
					  <label for="additionalFee" class="col-sm-3 control-label">Additional Fee</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="additionalFee" name="additionalFee" placeholder="" />
					  </div>
					  @if ($errors->has('additionalFee'))
						<span class="text-red">
							<strong>{{ $errors->first('additionalFee') }}</strong>
						</span>
					  @endif					  
				</div>				
				
				
				<div class="form-group">
					  <label for="amountUsdSimpleNew" class="col-sm-3 control-label">Net Converted Amount USD</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="amountUsdSimpleNew" name="amountUsdSimpleNew" placeholder="" />
					  </div>
					  @if ($errors->has('amountUsdSimpleNew'))
						<span class="text-red">
							<strong>{{ $errors->first('amountUsdSimpleNew') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
					  <label for="sender_name" class="col-sm-3 control-label">Sender Name</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="" />
					  </div>
					  @if ($errors->has('sender_name'))
						<span class="text-red">
							<strong>{{ $errors->first('sender_name') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
					  <label for="email" class="col-sm-3 control-label">Email</label>
					  <div class="col-sm-6">
						<input type="email" class="form-control" id="email" name="email" placeholder="" />
					  </div>
					  @if ($errors->has('email'))
						<span class="text-red">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					  @endif					  
				</div>
					
				<div class="form-group">
					  <label for="courseStart" class="col-sm-3 control-label">Course Start Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="courseStart" name="courseStart" placeholder="" autocomplete="off" />
					  </div>      
				</div>
				<div class="form-group">
					  <label for="courseEnd" class="col-sm-3 control-label">Course End Date</label>
					  <div class="col-sm-6">
						<input type="date" class="form-control" id="courseEnd" name="courseEnd" value="{{ $end_date_readonly }}" />
					  </div>      
				</div>				
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Employee Commision</label>
					<div class="col-sm-6">
						<select id="agent_comm" name="agent_comm" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Employee" style="width: 100%;" tabindex="-1" aria-hidden="true">
						  <option value='0'>Select Employee</option>
						  @if ($employees_list!='')
							  @foreach($employees_list as $key => $employee)
							  <option value="{{ $employee->id }}">{{ $employee->fname }} {{ $employee->lname }}</option>
							  @endforeach
						  @endif
						</select>
						@if ($errors->has('agent_comm'))
                          <span class="text-red">
                              <strong>{{ $errors->first('agent_comm') }}</strong>
                          </span>
                        @endif
					</div>
					<!-- /.form-group -->			
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Teacher Commision</label>
					<div class="col-sm-6">
						<select id="teacher_comm" name="teacher_comm" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Employee" style="width: 100%;" tabindex="-1" aria-hidden="true">
						  <option value='0'>Select Teacher</option>
						  @if ($teachers_list!='')
							  @foreach($teachers_list as $key => $teacher)
							  <option value="{{ $teacher->id }}">{{ $teacher->fname }} {{ $teacher->lname }}</option>
							  @endforeach
						  @endif
						</select>
						@if ($errors->has('teacher_comm'))
                          <span class="text-red">
                              <strong>{{ $errors->first('teacher_comm') }}</strong>
                          </span>
                        @endif
					</div>
					<!-- /.form-group -->			
				</div>					
				
				<div class="form-group">
					  <label for="grade" class="col-sm-3 control-label">Grade</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="grade" name="grade" placeholder="" />
					  </div>
					  @if ($errors->has('grade'))
						<span class="text-red">
							<strong>{{ $errors->first('grade') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
					  <label for="grade" class="col-sm-3 control-label">Syllabus</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="syllabus" name="syllabus" placeholder="" />
					  </div>
					  @if ($errors->has('syllabus'))
						<span class="text-red">
							<strong>{{ $errors->first('syllabus') }}</strong>
						</span>
					  @endif					  
				</div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Comments</label>
				    <div class="col-sm-6">
                      <textarea class="form-control" rows="3" id="comments" name="comments" placeholder="Enter Comments for teacher..."></textarea>
				    </div>
					  @if ($errors->has('comments'))
						<span class="text-red">
							<strong>{{ $errors->first('comments') }}</strong>
						</span>
					  @endif					
				</div>
				
				<div class="form-group">
					  <label for="grade" class="col-sm-3 control-label">Recording Link</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="record_link" name="record_link" placeholder="" />
					  </div>
					  @if ($errors->has('record_link'))
						<span class="text-red">
							<strong>{{ $errors->first('record_link') }}</strong>
						</span>
					  @endif					  
				</div>
				
<!-- NEW VALUES -->
<div id="label" style='visibility:hidden'>Actual Slot USD:</div><div id="field"><input type='hidden' id='amountDefaultNew_Usd' name='amountDefaultNew_Usd' value='' readonly='readonly'/> </div>
<div id="label" style='visibility:hidden'>Invoiced Amount USD:</div><div id="field"><input type='hidden' id='amountOriginalNew_Usd' name='amountOriginalNew_Usd'  required/> </div>
<div id="label" style='visibility:hidden'>Paypal Fee  USD:</div><div id="field"><input type='hidden' id='feeDeductNew_Usd' name='feeDeductNew_Usd'  required/> </div>
<div id="label" style='visibility:hidden'>Discount USD :</div><div id="field"><input type='hidden' id='discountNew_Usd' name='discountNew_Usd' readonly='readonly' required/> </div>
<div id="label" style='visibility:hidden'>Additional fee USD :</div><div id="field"><input type='hidden' id='additionalFee_Usd' name='additionalFee_Usd' readonly='readonly' required/> </div>				

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
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
//Function to change DATE RECEIVED with SIGNIN DATE in make_regular.php
function date_rec_date_signin()
{
	var signInDate = document.getElementById('signInDate').value;
	document.getElementById('dateReceived').value = signInDate;
	document.getElementById('paydate').value = signInDate;
	if(signInDate = document.getElementById('dateReceived').value)
	{
		alert("SignIn Date MATCHES Date Received & Recurring/Paying Date");
	}
	else
	{
		alert("SignIn Date DOESN'T MATCH Date Received");
	}
}

//Function to update METHOD in the transaction_new.php
function update_payment_method()
{
	var pay_method_id_value = document.getElementById('method_id');
	var pay_method_id_text = pay_method_id_value.options[pay_method_id_value.selectedIndex].text;
	/* document.getElementById('method').value = pay_method_new_text;
	if(pay_method_new_text = document.getElementById('method').value)
	{
		//alert("Method READONLY populated");
	}
	else
	{
		//alert("Method READONLY NOT populated");
	} */
	var ccv_code_value = document.getElementById('method_id');
	var ccv_code_text = ccv_code_value.options[ccv_code_value.selectedIndex].text;
	//alert(ccv_code_text);
	cardSave_ccv_code = inputID=document.getElementById('cardSave_ccv_code');
	
	//Virtual termincal fields alomg with card save NEWLY ADDED // 28-11-16
	VirtualTerminal_name = inputID=document.getElementById('VirtualTerminal_name');
	VirtualTerminal_number = inputID=document.getElementById('VirtualTerminal_number');
	VirtualTerminal_date = inputID=document.getElementById('VirtualTerminal_date');
	//Bank payment image upload field along with CARDSAVE and VIRTUAL TERMINAL //17-01-17
	WU_BANK_PHY_payment_image = inputID=document.getElementById('bank_payment_image');
	//Bank Selection //27-07-18
	BANK_NAME = inputID=document.getElementById('bankName');
	if(ccv_code_text=="Card Save")
	{
		//alert("You have selected "+ccv_code_text+" - Enabling CCV Code Textbox");
		cardSave_ccv_code.style.visibility='visible';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='hidden';
		VirtualTerminal_number.style.visibility='hidden';
		VirtualTerminal_date.style.visibility='hidden';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='hidden';
		//Bank Selection
		BANK_NAME.style.visibility='hidden';
	}
	else if(ccv_code_text=="Virtual Terminal")
	{
		cardSave_ccv_code.style.visibility='visible';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='visible';
		VirtualTerminal_number.style.visibility='visible';
		VirtualTerminal_date.style.visibility='visible';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='hidden';
		//Bank Selection
		BANK_NAME.style.visibility='hidden';
	}
	else if(ccv_code_text=="Western Union" || ccv_code_text=="Bank" || ccv_code_text=="Physical payment") //Newly added for bank payment //17-01-17
	{
		
		cardSave_ccv_code.style.visibility='hidden';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='hidden';
		VirtualTerminal_number.style.visibility='hidden';
		VirtualTerminal_date.style.visibility='hidden';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='visible';
		//Bank Selection
		BANK_NAME.style.visibility='visible';
	}
	else
	{
		cardSave_ccv_code.style.visibility='hidden';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='hidden';
		VirtualTerminal_number.style.visibility='hidden';
		VirtualTerminal_date.style.visibility='hidden';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='hidden';
		//Bank Selection
		BANK_NAME.style.visibility='hidden';		
	}
}


</script>

<script>
//////////////////////////////// POPULATE CURRENCY VALUES///////////	start
  $("select[name='currency_id']").change(function(){
//resetting all the values
	document.getElementById("amountOriginalNew").value='';
	document.getElementById("totalReceivedNew").value='';
	document.getElementById("feeDeductNew").value='';
	document.getElementById("discountNew").value='';
	document.getElementById("additionalFee").value='';
	
	
	document.getElementById("amountDefaultNew_Usd").value='';
	document.getElementById("amountOriginalNew_Usd").value='';
	document.getElementById("amountUsdSimpleNew").value='';
	document.getElementById("feeDeductNew_Usd").value='';
	document.getElementById("discountNew_Usd").value='';
	document.getElementById("additionalFee_Usd").value='';
//
	if ($("select[name='currency_id']")[0].selectedIndex <= 0) {
    alert('Please select currency.');
    $("select[name='currency_id']").focus();
    return false;
}


	var currency_id=document.getElementById('currency_id').value;
	var strURL="/schedule/getCurrencyValueFromDB";
	
	//alert(currency_id);

      var currency_id = $(this).val();
	  console.log(currency_id);
      var token = $("input[name='_token']").val();
	  $.ajax({
          url: "<?php echo route('/schedule/getCurrencyValueFromDB') ?>",
		  dataType : 'json',
          method: 'POST',
          data: {currency_id:currency_id,_token:token},
          success: function(data) {
			  console.log(token);
			  console.log(data);
            $('#simple_convert').html('');
            $('#simple_convert').html(data.responseText);
			//document.getElementById('simple_convert').innerHTML = data.responseText;
          }
      });
  });	
////////////////////////////////////////////////////////////////////	end
</script>



<script>
//////////////////////////////// calculate_currency_conversion////////	start
  $("#totalReceivedNew").change(function(){
	//alert('change');
	if ($("select[name='totalReceivedNew']").value == 0 || $("select[name='totalReceivedNew']").value == '') {
		//$("select[name='simple_convert'").html('');
    alert('NET RECEIVED cannot be zero - ERROR.');
    //$("select[name='currency_id']").focus();
    return false;
}

	var amount_default = document.getElementById("amountDefaultNew").value;
	var amount_original = document.getElementById("amountOriginalNew").value;
	var received_amt = document.getElementById("totalReceivedNew").value;
	//var simple_convert = document.getElementByName("simple_convert").value;
	var simple_convert=$("input[name=simple_convert]").val();
	//alert(simple_convert);
	//Calculate Fee 
	var fee_deduct = amount_original - received_amt;
	document.getElementById("feeDeductNew").value=fee_deduct;
	//Calculate discount
	var discountNew = amount_default - amount_original;
	if(discountNew<0){
		document.getElementById("additionalFee").value = Math.abs(discountNew.toFixed(2));
		var additionalFee = document.getElementById("additionalFee").value;
		discountNew = 0;
		document.getElementById("discountNew").value = discountNew;
		alert("Alert: Discount is Negative , Populating additional fee");
		//return true;
	}
	else{
		var additionalFee;
		document.getElementById("additionalFee").value=0;
		additionalFee = document.getElementById("additionalFee").value;
	}

			//USD Conversions
			//Converting Total received Amount to USD
			var amountUsdSimpleNew = simple_convert*received_amt;
			amountUsdSimpleNew = amountUsdSimpleNew.toFixed(2);
			
			amountDefaultNew_Usd = amount_default * simple_convert;
			amountOriginalNew_Usd = amount_original * simple_convert;
			feeDeductNew_Usd = fee_deduct * simple_convert;
			//amountUsdSimpleNew Done above
			discountNew_Usd = discountNew * simple_convert;
			additionalFee_Usd = additionalFee * simple_convert;	
			if(amount_original!=0)
			{

				//NEW
				//alert("Successful");
				document.getElementById("totalReceivedNew").value = received_amt;
				document.getElementById("discountNew").value = discountNew.toFixed(2);
				//Assigning values to the id of USD elements
				document.getElementById("amountDefaultNew_Usd").value = amountDefaultNew_Usd.toFixed(2);
				document.getElementById("amountOriginalNew_Usd").value = amountOriginalNew_Usd.toFixed(2);
				document.getElementById("feeDeductNew_Usd").value = feeDeductNew_Usd.toFixed(2);
				document.getElementById("discountNew_Usd").value = discountNew_Usd.toFixed(2);
				document.getElementById("additionalFee_Usd").value = additionalFee_Usd.toFixed(2);
				document.getElementById("amountUsdSimpleNew").value = amountUsdSimpleNew;
				
				return true;
			}
			if(amount_original==0)
			{
				alert("Un - Successful ");
				return false;
			}		
			
  });	
////////////////////////////////////////////////////////////////////	end
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

@endsection