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
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Invoice Details of : <b>{{$parents['fname']}} {{$parents['lname']}}</b></h3>
              <span class="pull-right">
              <a href="{!! url('/schedule/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('parents/invoicepreview'); !!}" method="post" enctype="multipart/form-data">
            @csrf
			<input type="hidden" id="parentID" name="parentID" value="{{$parents['id']}}" />
		
			<div class="box-body">
            
            @if(count($schedules) > 0)
              <table id="example1" class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Checkbox</th>
                  <th>ID</th>
				  <th>Name</th>
				  <th>Subject</th>				  
				  <th>SignIn Date</th>
				  <th>Per month Dues</th>				  
				  <th>Per month Dues(US)</th>
				  <th>Paydate</th>				  
				  <th>Status</th>
                  <th>Invoice Duration</th>
				  <th>Invoice Amount(US)</th>
				  <th>Invoice Amount</th>				  
                </tr>
                </thead>
                <tbody>
				<?php 
					
				  $original_curr_converted_output=0;
				  $grand_total_local_currency = 0; 
				?>
                @foreach($schedules as $schedule)
				
				<?php
				  $onemonth=1;
				  $days = 0;
				  //$showonly = $id ;
				  $x = 1;
				?>				
				<tr>
					<td class="tbHead" align="center" bgcolor="#FFFFFF"> 
					<input type="checkbox" name="child_list[]"  value="<?php echo  $schedule->id; ?>"  checked="checked"  onclick="calculate_total();"/></td>
					<input type="hidden" name="schedule_id_list[]"  value="<?php echo  $schedule->id; ?>"  /></td>
                
					<td>{{$schedule->studentID}} </td>
					<td>{{$schedule->fname}} {{$schedule->lname}} </td>
					<td>
					@if ($course_list!='')
						@foreach($course_list as $key => $courses)
							@if($key+1 == $schedule->courseID)
							{{ $courses['courses'] }}
							@endif
						@endforeach
					@endif
					</td>					
					<td>{{$schedule->duedate}} </td>
					<td>{{$schedule->dues_original}}
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $schedule->currency_array)
							({{ $curr }})
							@endif
						@endforeach
					@endif
					</td>
					<td>{{$schedule->dues_usd}} </td>
					<td>{{$schedule->paydate}} </td>					
					<td> 
					  @if ($schedule->std_status === 1)
                      <span class="btn btn-warning">Trial</span>
                      @elseif($schedule->std_status === 2)
                      <span class="btn btn-success">Regular</span>
					  @elseif($schedule->std_status === 5)
                      <span class="btn btn-primary">MakeOver</span>				  
					  @endif
					</td>
					
					
					<td align="center">  
					   <select name="months_<?php echo $schedule->id; ?>" id="months_<?php echo $schedule->id; ?>"  onchange="calculate_total()">
					   <option value="0" <?php   if($x==0){?> selected="selected"<?php }?>>0 Month</option>
					   <option value="1" <?php   if($x==$onemonth){?> selected="selected"<?php }?>>1 Month</option>
					   <?php for($i=2;$i<=10;$i++){ ?>
					   <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
					   <?php }?>
					  </select>    
					   <select name="days_<?php echo $schedule->id; ?>" id="days_<?php echo $schedule->id; ?>"  onchange="calculate_total()">
					   <?php for($i=0;$i<=30;$i++){?>
					   <option value="<?php echo $i; ?>" <?php   if($days==$i){?> selected="selected"<?php }?>><?php echo $i; ?> days</option>
					   <?php }?>
					  </select>
					</td>
					
					<!-- USD Currency -->
					<td width="9%" class="tbHead" align="center"  style="font-size:12px;" >$<input name="send_amount_<?php echo  $schedule->id; ?>"   type="text" id="send_amount_<?php echo  $schedule->id; ?>" 
					value="<?php echo $original_curr_usd=$schedule->dues_usd; ?>" 

					size="6" maxlength="7" readonly="readonly"  />
					<?php //Original currency to USD conversion output<<<<<<<<<<<<<<<<<<<<<<
					$original_curr_converted_output += $original_curr_usd;
					//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ?>
					<input type="hidden" value="<?php echo $original_curr_usd; ?>" id="orignal_<?php echo  $schedule->id; ?>" name="orignal_<?php echo  $schedule->id; ?>" />
					<input type="hidden" value="<?php echo (($original_curr_usd)/30); ?>" id="per_day_amount_<?php echo $schedule->id; ?>" name="per_day_amount_<?php echo  $schedule->id; ?>" />
					</td>
					
					
					
                    <!-- Org Currency -->
					<td width="7%" class="tbHead" align="center"  style="font-size:12px;" >
                    <input name="send_local_amount_<?php echo $schedule->id; ?>"   type="text" id="send_local_amount_<?php echo  $schedule->id; ?>" value="<?php echo $due_amount_local_currency = $schedule->dues_original; ?>" size="6" maxlength="7" readonly="readonly"  />
					<?php 	 
						$grand_total_local_currency += $due_amount_local_currency; 	
					?>
					<input type="hidden" value="<?php echo ($due_amount_local_currency); ?>" id="local_orignal_<?php echo  $schedule->id; ?>" name="local_orignal_<?php echo  $schedule->id; ?>" />
					<input type="hidden" value="<?php echo (($due_amount_local_currency)/30); ?>" id="local_per_day_amount_<?php echo $schedule->id; ?>" name="local_per_day_amount_<?php echo  $schedule->id; ?>" />  
					</td>
					
					
					
				</tr>
                  @endforeach
                </tbody>
                <tfoot>
				
				<tr bgcolor="#fff">
                <?php if($x != 'USD') { ?>
               	<td colspan="10" align="right">&nbsp;</td>
                <?php }else{ ?>
               	<td colspan="10" align="right">&nbsp;</td>
                <?php }?>
                <td width="7%" colspan="" align="left" bgcolor="#fff"><b>Grand Total: </b><br />$<input name="grand_total"  type="text" id="grand_total" size="6" maxlength="7" readonly="readonly"  value="<?php echo 	$original_curr_converted_output;?>"/></td>
                <?php if($x != 'USD') { ?>
                <td width="7%" colspan="" align="left" bgcolor="#fff"><b>Grand Total:</b><br /><input name="grand_total_local_currency"  type="text" id="grand_total_local_currency" size="6" maxlength="7" readonly="readonly"  value="<?php echo $grand_total_local_currency; ?>"/></td>
                <?php } ?>
                </tr>
				
                </tfoot>
              </table>
              @else
              <div>No Record found.</div>
              @endif

            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule'); !!}" class="btn btn-default">Cancel</a>
				<button type="submit" class="btn btn-info pull-right">NEXT</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

<script type="text/javascript">
function calculate_total(){
	var total =0;
	local_total = 0 ;
	var reg_fee =0;
	var chks = document.getElementsByName('child_list[]');	//having ids of child  chks[i].value
	for (var i = 0; i < chks.length; i++)
		{
		if(chks[i].checked==true)
		{	
			var months		=document.getElementById('months_'+chks[i].value).value;
			var days 		=document.getElementById('days_'+chks[i].value).value;
			var per_day 	=document.getElementById('per_day_amount_'+chks[i].value).value;
			var per_month 	=document.getElementById('orignal_'+chks[i].value).value;
			var perday = per_month/30;
			var days_amount =Math.round(perday* days);
			//alert(per_day+'*'+days+'='+Math.round(days_amount));
		document.getElementById('send_amount_'+chks[i].value).value = parseInt(months)*parseFloat(document.getElementById('orignal_'+chks[i].value).value)+days_amount;
		total = parseFloat(total)+parseFloat(document.getElementById('send_amount_'+chks[i].value).value);
		//alert(total);
		
		
			var local_months		=	document.getElementById('months_'+chks[i].value).value;
			var local_days 			=	document.getElementById('days_'+chks[i].value).value;
			var local_per_day 		=	document.getElementById('local_per_day_amount_'+chks[i].value).value;
			var local_per_month 	=	document.getElementById('local_orignal_'+chks[i].value).value;
			var local_perday 		= 	local_per_month/30;
			var local_days_amount 	=	Math.round(local_perday * days);
			
			
		//	alert(local_perday+'*'+local_days+'='+Math.round(local_days_amount));
		// alert(Math.round(days_amount));
		//	return false ;
		document.getElementById('send_local_amount_'+chks[i].value).value = parseInt(months)* parseFloat(document.getElementById('local_orignal_'+chks[i].value).value) + local_days_amount;
		local_total = parseFloat(local_total)+parseFloat(document.getElementById('send_local_amount_'+chks[i].value).value);
		//alert(parseInt(local_total)+ parseInt(reg_fee));
		//return false ;
		
		//reg_fee = parseInt(reg_fee)+parseInt(document.getElementById('registration_fee_'+chks[i].value).value);
		}
	}
	document.getElementById('grand_total').value =  parseFloat(total)+ parseInt(reg_fee);
	//alert(parseInt(local_total)+ parseInt(reg_fee));
	//return false ;
	document.getElementById('grand_total_local_currency').value =  parseFloat(local_total)+ parseInt(reg_fee);
}
	
function selectAll(main){
var chks = document.getElementsByName('child_list[]');	
if(main.checked == true){
		for (var i = 0; i < chks.length; i++)
		{
		chks[i].checked = true;
		}
}
if(main.checked == false){
		for (var i = 0; i < chks.length; i++)
		{
		chks[i].checked = false;
		}
}
	calculate_total();
}

function validate_create_invoice(){
	/*		if(document.getElementById('grand_total').value =='0')
		{
			alert('Grand total amount is zero.');
				return false;
		}*/
		
			var chks = document.getElementsByName('child_list[]');	
			for (var i = 0; i < chks.length; i++)
			{
				if(chks[i].checked == true)
					return true;
			}
	return false;		
}

function parseDate(str) {
    var mdy = str.split('-')
    return new Date(mdy[0], mdy[1]-1, mdy[2]);
}


function calculate_trial_amount(std_id){
var perday = (document.getElementById(std_id+'_due_amount').value)/30;
var today = new Date();
var d1 = parseDate(document.getElementById(std_id+'_due_date').value);
var oneday = 86400000;
var dayscount =  Math.round((d1-today) / oneday);
document.getElementById(std_id+'_days').value =dayscount+' days invoice';
document.getElementById(std_id+'_amount').value =Math.round(dayscount*perday);
	//	alert(perday+'*'+dayscount+'='+dayscount*perday);
}


function validate_trial(){
	var error=0;
	 $('.select_class').each(function() {
            if ($(this).val() == "0") {
				error=error+1;
               // return false;
            }
			
});
if(error>0){

	alert('Select Due Date for trials');
	return false;
}
}	
function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
}	
</script> 
	  
@endsection