<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print Invoice</title>
</head>
<body onload="window.print();">

<table align="center" width="100%" cellpadding="0" cellspacing="0" 
style="color:#000000;font-family:Arial, Helvetica, sans-serif; font-size:12px">

<input type="hidden" id="parentID" name="parentID" value="{{$parents['id']}}" />
<input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id = $invoice['invoice_id']; ?>" />

	<tr>
		<td align="center" height="10" colspan="2" style="border-top:#000000 3px solid;
		color:#000000; font-weight:bold; font-size:24px;padding-top:20px;text-transform:uppercase;"><span style=" font-size:24px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, sans-serif;">MONTHLY INVOICE</span> 
		</td>
	</tr>
	<tr>
		<td align="left" style="color:#000000; font-weight:bold; font-size:24px;
		padding-top:20px;text-transform:uppercase;">
		<img src="https://www.yourcloudcampus.com/wp-content/uploads/2018/11/logo-black.png" alt="" /><br>
		YourCloudCampus<br />
		<span style=" font-size:15px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, 
		sans-serif;">YourCloudCampus</span>
		</td>
		
		<td align="right" valign="top" style="color:#000000; font-size:15px; font-weight:bold;
		padding-top:20px;">INVOICE # <?php echo $invoice_id; ?><br />ISSUE DATE: <?php echo $invoice['invoice_date']->format('Y-m-d'); ?><br>
		<font color="#FF0000">
		</font>
		</td>
	</tr>
<tr>
	<td width="77%" align="left" style="color:#000000; font-weight:bold; font-size:24px;
	padding-top:20px;text-transform:uppercase"><p><span style="color:#000000; font-size:15px; 
	font-weight:bold; padding-top:20px;">Place,Level 24 ,Tower 1,<br />
	United Kingdom <br />
	Tel: 121-288-3093(UK) <br />
	Tel: 215-764-6162(USA)<br />
	</span></p>
	</td>
	<td width="23%" align="right" valign="top" style="color:#000000; font-size:24px; font-weight:bold;padding-top:20px; color:#F00">
	<?php if($invoice['paid_status']=='0' || $invoice['paid_status']=='3') { ?>
	<span style="border:#F00 3px solid;padding:10px;">Unpaid </span>
	<?php } else if($invoice['paid_status']=='1') { ?>
	<span style="border:#26A908 3px solid;padding:10px; color:#26A908">Paid</span>
	<?php } else if($invoice['paid_status']=='2') { ?>
	<span style="border:#26A908 3px solid;padding:10px; color:#26A908">Canceled</span>
	<?php } else { //Do nothing 
	} ?>
	
	
	</td>
</tr>
<tr>
    <td width="50%" align="left" style="color:#000000; font-size:15px; font-weight:bold; 
	padding-top:20px;" colspan="2">TO<br />
<strong>Customer Name</strong><br>
            {{ $parents->fname }} {{ $parents->lname }} <b>[{{ $parents->email }}]</b><br></td>
</tr>
<tr><td colspan="2"></td></tr>



<tr style="height:30px;">
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

			<!-- loop comes here		start -->
			@foreach($invoice_details as $key => $invoice_detail)
			<?php $index_id = $invoice_detail['id']; ?>
			<tr style="height:50px;">
                <td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;">
					{{ $invoice_detail->student_name }} 
				</td>
				<td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;" >
				@if ($course_list!='')
					@foreach($course_list as $key => $courses)
						@if($key+1 == $course_ary[$index_id])
						{{ $courses['courses'] }}
						@endif
					@endforeach
				@endif
				</td>				
				<td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;" >
					{{ $invoice_detail['monthly_fee'] }} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoice_detail['currency'])
							({{ $curr }})
							@endif
						@endforeach
					@endif
				</td>
				<td align="center" style="border-left:#000000 2px solid;border-bottom:#000000 1px solid; color:red" >
					{{ $invoice_detail['due_date']->format('Y-m-d') }}
				</td>
				<td align="center" 
				style="border-left:#000000 2px solid; border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >
				{{ $amount_to_send_local_curreny_sum_ary[$index_id] }}
				</td>
			</tr>
			@endforeach
			<!-- loop comes here		end -->
			
			
			<tr style="height:30px;">
				<td colspan="4" align="right" style="font-weight:bold; 
				font-size:15px; color:#000000; padding-right:15px;">GRAND TOTAL :
				</td>
				<td align="center">{{ $currency_grand_total }} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoice_detail['currency'])
							( <?php echo $paypal_currency =  $curr; ?> )
							@endif
						@endforeach
					@endif</td>
			</tr>
        </table>
    </td>
</tr>



<tr style="line-height:100px;"><td colspan="2" align="center"><table align="center" width="100%"><tr><td width="50%" align="center" valign="top">
<form name="paypalxclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="paypal-facilitator@nsol.sg">
        <input type="hidden" name="cancel_return" value="http://localhost:8000/parents/create_invoice_detail_without_login?invoice_id=<?php echo $invoice_id ?>" />
        <input type="hidden" name="return" id="returnUrl" value="http://localhost:8000/parents/create_invoice_detail_without_login?invoice_id=<?php echo $invoice_id ?>" />
		<input type="hidden" name="notify_url" id="notify_url" value="http://localhost:8000/parents/create_invoice_detail_without_login?invoice_id=<?php echo $invoice_id ?>" />
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="item_name" value="Student Payment Invoice Number ['<?php echo $invoice_id ?>']">
        <input type="hidden" name="amount" id="paypal_amount" value="2.73">
        <input type="hidden" name="custom" id="custom" value="2.73">
    </form></td><td width="50%" align="center" valign="top">&nbsp;</td></tr></table>
</td></tr>

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

</table>

</body>
</html>