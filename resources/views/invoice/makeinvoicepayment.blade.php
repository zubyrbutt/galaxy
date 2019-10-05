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
            <form class="form-horizontal" action="{!! url('invoice/updateinvoicepayment'); !!}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body" >
			
            @if(count($invoicedetails) > 0)
<table align="center" width="100%" cellpadding="0" cellspacing="0" 
style="color:#000000;font-family:Arial, Helvetica, sans-serif; font-size:12px">

<input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $data['invoiceid'] ?>" />

	<tr>
		<td align="center" height="10" colspan="2" style="border-top:#000000 3px solid;
		color:#000000; font-weight:bold; font-size:24px;padding-top:20px;text-transform:uppercase;"><span style=" font-size:24px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, sans-serif;">MONTHLY INVOICE</span> 
		</td>
	</tr>
	<tr>
		<td align="left" style="color:#000000; font-weight:bold; font-size:24px;
		padding-top:10px;text-transform:uppercase;">
		<img src="https://www.yourcloudcampus.com/wp-content/uploads/2018/11/logo-black.png" alt="" /><br>
		YourCloudCampus<br />
		</td>
		
		<td align="right" valign="top" style="color:#000000; font-size:15px; font-weight:bold;
		padding-top:10px;">INVOICE # <?php echo $data['invoiceid']; ?><br />ISSUE DATE: {{ $invoice->invoice_date->format('Y-m-d') }}<br>
		<font color="#FF0000">
		</font>
		</td>
	</tr>
<tr>
	<td width="77%" align="left" style="color:#000000; font-weight:bold; font-size:14px;
	padding-top:10px;text-transform:uppercase"><p><span style="color:#000000; font-size:15px; 
	font-weight:bold; padding-top:20px;">ONE RAFFLES PLACE, 048616<br />
	Singapore <br />
	Tel: (203) 334-9939(UK) <br />
	Tel: (202) 886-1222(USA)<br />
	Tel: (291) 612-887 (AUS)<br />
	Tel: +65 6958 0826 (SG)<br />
	
	</span></p>
	</td>
	@if($invoice->paid_status==1)
	<td width="23%" align="right" valign="top" style="color:#000000; font-size:24px; 
	font-weight:bold;padding-top:10px; color:#00cc00"> <span style="border:#00cc00 3px solid;padding:10px;">paid </span>
	</td>
	@else
	<td width="23%" align="right" valign="top" style="color:#000000; font-size:24px; 
	font-weight:bold;padding-top:10px; color:#F00"> <span style="border:#F00 3px solid;padding:10px;">Unpaid </span>
	</td>	
	@endif
</tr>
<tr>
    <td width="50%" align="left" style="color:#000000; font-size:15px; font-weight:bold; 
	padding-top:10px;" colspan="2">TO<br />
<strong>Customer Name</strong><br>
{{ $invoice->parent_name }}  <b>[{{ $parent_email }}]</b><br></td>
</tr>
<tr><td colspan="2"></td></tr>



<tr style="height:20px;">
    <td colspan="2" align="center">
        <table align="center" width="100%" style="font-size:15px; color:#000000;" 
		cellpadding="0" cellspacing="0">
            <tr style="height:30px;">
                <td  align="center" style="font-weight:bold; border-top:#000000 2px solid;
				border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Student Name</td>
                <td  align="center" style="font-weight:bold; border-top:#000000 2px solid;
				border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Subject</td>				
                <td  align="center" style="font-weight:bold;border-top:#000000 2px solid;
				border-left:#000000 2px solid; border-bottom:#000000 2px solid;
				background-color:#F3F3F3;text-transform:uppercase ">
				Monthly Fee</td>
				<td  align="center" style="font-weight:bold;
				border-top:#000000 2px solid;border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Due Date</td>
				<td  align="center" style="font-weight:bold;
				border-top:#000000 2px solid;border-bottom:#000000 2px solid;
				border-right:#000000 2px solid;border-left:#000000 2px solid;
				background-color:#F3F3F3;text-transform:uppercase ">
				Total </td>
			</tr>	
			
			<?php $amount_sum = array(); ?>
			<!-- loop comes here		start -->
			@foreach($invoicedetails as $invoicedetail)
			<?php $sch_id = $invoicedetail['id'];  
			$amount_sum[$invoicedetail['id']] = $invoicedetail['payment_local']; ?>
			<tr style="height:30px;">
                <td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;">
					{{ $invoicedetail->studentname['fname'] }} {{ $invoicedetail->studentname['lname'] }}
				</td>
				<td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;" >
				@if ($course_list!='')
					@foreach($course_list as $key => $courses)
						@if($key+1 == $invoicedetail->subject['courseID'])
						{{ $courses['courses'] }}
						@endif
					@endforeach
				@endif
				</td>			

					<td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;">
					{{ $invoicedetail['payment_local'] }} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoicedetail['currency'])
							[ {{ $curr }} ]
							@endif
						@endforeach
					@endif
					</td>
				
				<td align="center" style="border-left:#000000 2px solid;border-bottom:#000000 1px solid; color:red" >
					{{ $invoicedetail['invoice_date']->format('Y-m-d') }}
				</td>
				<td align="center" 
				style="border-left:#000000 2px solid; border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >
				{{ $invoicedetail['payment_local'] }}
				</td>
			</tr>
			@endforeach
			<!-- loop comes here		end -->
			
			
			<tr style="height:30px;">
				<td colspan="4" align="right" style="font-weight:bold; 
				font-size:15px; color:#000000; padding-right:15px;">GRAND TOTAL :
				</td>
				<td align="center"><?php echo array_sum($amount_sum); ?>
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoicedetail['currency'])
							({{ $curr }})
							@endif
						@endforeach
					@endif</td>
			</tr>
        </table>
    </td>
</tr>


<tr style="line-height:100px;">
<td colspan="2"></td>
</tr>

<tr align="center" style="color:#000000;font-weight:bold; font-size:16px;">
	<td colspan="2"><span style="font-size:12px;font-weight:normal;"><strong>
	YourCloudCampus</strong></span>
	</td>
</tr>

<tr>
	<td colspan="2" align="center" style="font-size:11px;"><br><strong>
	Beta Version v3</strong>
	</td>
</tr>
<tr>
	<td colspan="2" style="border-bottom:#000000 3px solid;"></td>
</tr>

<tr>
	<td  style="">
		<a href="http://localhost:8000/parents/print_invoice?invoice_id=<?php echo $data['invoiceid']; ?>" target="_blank" class="button">Print Invoice</a>
	</td>
	<td  style="float:right">
		<a href="http://localhost:8000/parents/downloadpdf?invoice_id=<?php echo $data['invoiceid']; ?>" target="_blank" class="buttondownload">Download PDF</a>
	</td>	
</tr>

</table>
              @else
              <div>No Record found.</div>
              @endif			
			
            <div class="row">
              <div class="col-md-12">
				
				<!--<div class="form-group">
					  <label for="studentID" class="col-sm-3 control-label">Student Name(Static)</label>
					  <div class="col-sm-6">
						<label for="studentID" class="control-label">[ {{ $data['student_names'] }} ]</label>
					  </div>      
				</div>-->
				
				<div class="form-group">
					  <label for="invoiceid" class="col-sm-3 control-label">Invoice Id</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="invoiceid" name="invoiceid" value="{{ $data['invoiceid'] }}" readonly/>
					  </div>      
				</div>

				<div class="form-group">
					  <label for="parent_name" class="col-sm-3 control-label">Parent Name</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="parent_name" name="parent_name" value="{{ $invoice->parent_name }}" readonly/>
					  </div>      
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

				
				<!-- onchange="getCurrencyValue(this.value)" -->
				<div class="form-group">
					  <label for="currency" class="col-sm-3 control-label">Currency</label>
					  <div class="col-sm-6">
							<select id="currency_id" name="currency_id"  class="form-control m-bot15" readonly>
							@if ($currency!='')
								@foreach($currency as $key => $curr)
								<option value="{{ $key }}" {{ $key == $invoicedetail['currency'] ? 'selected=selected' : '' }} >{{ $curr }}</option>								
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
				
				

				
				
				
				<!--<div class="form-group">
					  <label for="amountDefaultNew" class="col-sm-3 control-label">Actual Amount</label>
					  <div class="col-sm-6">-->
						<input type="hidden" class="form-control" id="amountDefaultNew" name="amountDefaultNew" value="{{ $data['invoicedetail_sum'] }}" placeholder="" readonly/>
					  <!--</div>
					  @if ($errors->has('amountDefaultNew'))
						<span class="text-red">
							<strong>{{ $errors->first('amountDefaultNew') }}</strong>
						</span>
					  @endif					  
				</div>-->
				
				<div class="form-group">
					  <label for="amountOriginalNew" class="col-sm-3 control-label">Invoiced Amount</label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="amountOriginalNew" name="amountOriginalNew" value="{{ $data['invoicedetail_sum'] }}" placeholder="" readonly />
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
					  <label for="feeDeductNew" class="col-sm-3 control-label">Fee</label>
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

<!-- CCV,VT,BANK,WU -->
				<div class="form-group">
					  <label for="cardSave_ccv_code" style="display:none;" id="cardSave_ccv_code_label" class="col-sm-3 control-label">CCV CODE</label>
					  <div class="col-sm-6">
						<input type="text" style="display:none;" class="form-control" id="cardSave_ccv_code" name="cardSave_ccv_code" placeholder="" />
					  </div>  
				</div>
				<div class="form-group">
					  <label for="VirtualTerminal_name" style="display:none;" id="VirtualTerminal_name_label" class="col-sm-3 control-label">Card holder name</label>
					  <div class="col-sm-6">
						<input type="text" style="display:none;" class="form-control" id="VirtualTerminal_name" name="VirtualTerminal_name" placeholder="" />
					  </div>  
				</div>
				<div class="form-group">
					  <label for="VirtualTerminal_number" style="display:none;" id="VirtualTerminal_number_label" class="col-sm-3 control-label">Card number</label>
					  <div class="col-sm-6">
						<input type="text" style="display:none;" class="form-control" id="VirtualTerminal_number" name="VirtualTerminal_number" placeholder="" />
					  </div>  
				</div>
				<div class="form-group">
					  <label for="VirtualTerminal_date" style="display:none;" id="VirtualTerminal_date_label" class="col-sm-3 control-label">Expiry date</label>
					  <div class="col-sm-6">
						<input type="text" style="display:none;" class="form-control" id="VirtualTerminal_date" name="VirtualTerminal_date" placeholder="" />
					  </div>  
				</div>
				
				<div class="form-group">
					  <label for="bank_payment_image" style="display:none;" id="bank_payment_image_label" class="col-sm-3 control-label">Select file</label>
					  <div class="col-sm-6">
						<input class='form-control' style="display:none;" type="file" name="bank_payment_image" id="bank_payment_image">						
                        <span class="text-red" style="visibility:hidden;">Only JPG,PNG files are allowed</span>
					  </div>
					  @if ($errors->has('bank_payment_image'))
                          <span class="text-red">
                              <strong>{{ $errors->first('bank_payment_image') }}</strong>
                          </span>
                      @endif					  
				</div>
				
				<div class="form-group">
					  <label for="bankName" style="display:none;" id="bankName_label" class="col-sm-3 control-label">Bank Selection</label>
					  <div class="col-sm-6">
							<select id="bankName" style="display:none;" name="bankName" class="form-control m-bot15">
							@if ($bankNameList!='')
								@foreach($bankNameList as $key => $bankName)
								<option value="{{ $key }}" >{{ $bankName }}</option>							
								@endforeach
							@endif
							</select>					
					  </div>
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
                <button type="submit" class="btn btn-info pull-right">Make Payment</button>
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
//labels

	cardSave_ccv_code_label = inputID=document.getElementById('cardSave_ccv_code_label');
	VirtualTerminal_name_label = inputID=document.getElementById('VirtualTerminal_name_label');
	VirtualTerminal_number_label = inputID=document.getElementById('VirtualTerminal_number_label');
	VirtualTerminal_date_label = inputID=document.getElementById('VirtualTerminal_date_label');
	WU_BANK_PHY_payment_image_label = inputID=document.getElementById('bank_payment_image_label');
	BANK_NAME_label = inputID=document.getElementById('bankName_label');


	if(ccv_code_text=="Card Save")
	{
		//alert("You have selected "+ccv_code_text+" - Enabling CCV Code Textbox");
		cardSave_ccv_code.style.display='block';
		cardSave_ccv_code_label.style.display='block';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.display='none';
		VirtualTerminal_name_label.style.display='none';
		
		VirtualTerminal_number.style.display='none';
		VirtualTerminal_number_label.style.display='none';
		
		VirtualTerminal_date.style.display='none';
		VirtualTerminal_date_label.style.display='none';
		
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.display='none';
		WU_BANK_PHY_payment_image_label.style.display='none';
		
		//Bank Selection
		BANK_NAME.style.display='none';
		BANK_NAME_label.style.display='none';
	}
	else if(ccv_code_text=="Virtual Terminal")
	{
		cardSave_ccv_code.style.display='block';
		cardSave_ccv_code_label.style.display='block';
		
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.display='block';
		VirtualTerminal_name_label.style.display='block';
		
		VirtualTerminal_number.style.display='block';
		VirtualTerminal_number_label.style.display='block';
		
		VirtualTerminal_date.style.display='block';
		VirtualTerminal_date_label.style.display='block';
		
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.display='none';
		WU_BANK_PHY_payment_image_label.style.display='none';
		
		//Bank Selection
		BANK_NAME.style.display='none';
		BANK_NAME_label.style.display='none';
	}
	else if(ccv_code_text=="Western Union" || ccv_code_text=="Bank" || ccv_code_text=="Physical payment") //Newly added for bank payment //17-01-17
	{
		
		cardSave_ccv_code.style.display='none';
		cardSave_ccv_code_label.style.display='none';
		
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.display='none';
		VirtualTerminal_name_label.style.display='none';
		
		VirtualTerminal_number.style.display='none';
		VirtualTerminal_number_label.style.display='none';
		
		VirtualTerminal_date.style.display='none';
		VirtualTerminal_date_label.style.display='none';
		
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.display='block';
		WU_BANK_PHY_payment_image_label.style.display='block';
		
		//Bank Selection
		BANK_NAME.style.display='block';
		BANK_NAME_label.style.display='block';
	}
	else
	{
		cardSave_ccv_code.style.display='none';
		cardSave_ccv_code_label.style.display='none';
		
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.display='none';
		VirtualTerminal_name_label.style.display='none';
		
		VirtualTerminal_number.style.display='none';
		VirtualTerminal_number_label.style.display='none';
		
		VirtualTerminal_date.style.display='none';
		VirtualTerminal_date_label.style.display='none';
		
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.display='none';
		WU_BANK_PHY_payment_image_label.style.display='none';
		
		//Bank Selection
		BANK_NAME.style.display='none';
		BANK_NAME_label.style.display='none';
	}
}


</script>

<script>
//////////////////////////////// POPULATE CURRENCY VALUES///////////	start
  $(document).ready(function(){
//resetting all the values
	//document.getElementById("amountOriginalNew").value='';
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
/* 	if ($("select[name='currency_id']")[0].selectedIndex <= 0) {
    alert('Please select currency.');
    $("select[name='currency_id']").focus();
    return false;
} */


	var currency_id=document.getElementById('currency_id').value;
	var strURL="/schedule/getCurrencyValueFromDB";
	
	//alert(currency_id);

      //var currency_id = $(this).val();
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