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
              <h3 class="box-title">Invoice Preview</h3>
			  @can('create-invoice')
				<span class="pull-right">
				  <a href="{!! url('/invoice/invoicecreate'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>
				</span>
			  @endcan	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            @if(count($invoicedetails) > 0)
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
		</td>
		
		<td align="right" valign="top" style="color:#000000; font-size:15px; font-weight:bold;
		padding-top:20px;">INVOICE # <?php echo $invoice_id; ?><br />ISSUE DATE: {{ $invoice->invoice_date->format('Y-m-d') }}<br>
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

<!--<tr style="line-height:20px;">
	<td colspan="2" 
	style="font-weight:bold; background-color: #F3F3F3; font-size:15px;">
	<a  href="http://localhost:8000/parents/create_invoice_detail_without_login?invoice_id=<?php echo $invoice_id; ?>">
	CLICK HERE</a> to pay with paypal. Thank you.
	</td>
</tr>-->

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
              @else
              <div>No Record found.</div>
              @endif

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

@endsection