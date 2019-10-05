<style>
.button {
border-radius: 3px;
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor: pointer;
}
.buttondownload {
border-radius: 3px;
  background-color: #337ab7;
  border: none;
  color: white;
  padding: 10px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

<table align="center" width="100%" cellpadding="0" cellspacing="0" 
style="color:#000000;font-family:Arial, Helvetica, sans-serif; font-size:12px">


<input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id ?>" />

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
		padding-top:20px;">INVOICE # <?php echo $invoice_id; ?><br />ISSUE DATE: <?php echo date('Y-m-d'); ?><br>
		<font color="#FF0000">
		</font>
		</td>
	</tr>
<tr>
	<td width="77%" align="left" style="color:#000000; font-weight:bold; font-size:24px;
	padding-top:20px;text-transform:uppercase"><p><span style="color:#000000; font-size:15px; 
	font-weight:bold; padding-top:20px;">ONE RAFFLES PLACE, 048616<br />
	Singapore <br />
	Tel: (203) 334-9939(UK) <br />
	Tel: (202) 886-1222(USA)<br />
	Tel: (291) 612-887 (AUS)<br />
	Tel: +65 6958 0826 (SG)<br />
	
	</span></p>
	</td>
	<td width="23%" align="right" valign="top" style="color:#000000; font-size:24px; 
	font-weight:bold;padding-top:20px; color:#F00"> <span style="border:#F00 3px solid;padding:10px;">Unpaid </span>
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
			@foreach($schedules as $schedule)
			<?php $sch_id = $schedule['id']; ?>
			<tr style="height:50px;">
                <td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;">
					{{ $schedule->studentname['fname'] }} {{ $schedule->studentname['lname'] }}
				</td>
				<td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;" >
				@if ($course_list!='')
					@foreach($course_list as $key => $courses)
						@if($key+1 == $schedule->courseID)
						{{ $courses['courses'] }}
						@endif
					@endforeach
				@endif
				</td>			
				<td align="center" style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;" >
					{{ $schedule['dues_original'] }} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $schedule['currency_array'])
							({{ $curr }})
							@endif
						@endforeach
					@endif
				</td>
				<td align="center" style="border-left:#000000 2px solid;border-bottom:#000000 1px solid; color:red" >
					{{ $schedule['paydate']->format('Y-m-d') }}
				</td>
				<td align="center" 
				style="border-left:#000000 2px solid; border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >
				{{ $amount_to_send_local_curreny_sum_ary[$sch_id] }}
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
							@if($key == $schedule['currency_array'])
							({{ $curr }})
							@endif
						@endforeach
					@endif</td>
			</tr>
        </table>
    </td>
</tr>

<tr style="line-height:20px;">
	<td colspan="2" 
	style="font-weight:bold; background-color: #F3F3F3; font-size:15px;">
	<a  href="http://localhost:8000/parents/create_invoice_detail_without_login?invoice_id=<?php echo $invoice_id; ?>">
	CLICK HERE</a> to pay with paypal. Thank you.
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
		<a href="http://localhost:8000/parents/print_invoice?invoice_id=<?php echo $invoice_id; ?>" target="_blank" class="button">Print Invoice</a>
	</td>
	<td  style="float:right">
		<a href="http://localhost:8000/parents/downloadpdf?invoice_id=<?php echo $invoice_id; ?>" target="_blank" class="buttondownload">Download PDF</a>
	</td>	
</tr>

</table>


