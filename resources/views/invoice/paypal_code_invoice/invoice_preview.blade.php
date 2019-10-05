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




.multiselect-container{

  max-height:200px;
  overflow:auto;
  width:100%;
  
}
</style>

    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Invoice Details</h3>
            </div>
            <!-- /.box-header -->
			
<!-- form start -->
<form class="form-horizontal" action="{!! url('parents/saveinvoice'); !!}" method="post" enctype="multipart/form-data">
@csrf
<input type="hidden" id="parentID" name="parentID" value="{{$parents['id']}}" />
<input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id = date("YmdHis").$parents['id']; ?>" />

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Monthly Invoice 
            <small class="pull-right"><?php echo date('Y-m-d'); ?></small>
			
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>YourCloudCampus</strong><br>
            PLACE,LEVEL 24 ,TOWER 1,<br>
            UNITED KINGDOM <br>
            TEL: 121-288-3093(UK) <br>
            TEL: 215-764-6162(USA)
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>Parent Name</strong><br>
            {{ $parents->fname }} {{ $parents->lname }} <b>[{{ $parents->id }}]</b><br>
            
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $invoice_id?></b><br>
          <br>
          <b>Date:</b> <?php echo date('Y-m-d') ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Student Name </th>
              <th>MONTHLY FEE	</th>
              <th>DUE DATE	</th>
              <th>MAX DATE TRAN</th>
			  <th>NO OF MONTHS-ORG	</th>
              <th>TOTAL </th>
            </tr>
            </thead>
            <tbody>
				<?php
				/* $cad_amt = 50;
				$cad_amt_sum = 0;	
				for ($x = 1; $x <= 3; $x++) {
				echo $cad_amt_sum += $cad_amt; */
                ?>
				@foreach($schedules as $schedule)
				<?php $sch_id = $schedule->sch_id; ?>
                  <tr>
					<td>{{ $schedule->fname }} {{ $schedule->lname }}</td>
					<td>{{ $schedule->dues_original }} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $schedule->currency_array)
							({{ $curr }})
							@endif
						@endforeach
					@endif
					</td>
					<td>{{ $schedule->paydate }}</td>
					<!-- Transaction part -->
					<td>{{ $schedule->maxdate_rec }}</td>
					<!-- Transaction part -->
					<td>{{ $months_ary[$sch_id] }} month , {{ $days_ary[$sch_id] }} day</td>	
					<td>{{ $amount_to_send_local_curreny_sum_ary[$sch_id] }}</td>
					
                  </tr>
<!--months,days, amount_to_send, amount_to_send_local_currency -->				  
<input name="registration_fee_<?php echo  $sch_id; ?>" id="registration_fee_<?php echo  $sch_id; ?>"  type="hidden" value="<?php echo  $sch_id	; ?>"  />
<input type="hidden" value="<?php echo $schedule->paydate; ?>" id="curr_due_date_<?php echo   $sch_id; ?>" name="curr_due_date_<?php echo   $sch_id; ?>" />

<input type="hidden" value="{{ $days_ary[$sch_id] }}" id="days_<?php echo $sch_id; ?>" name="days_<?php echo $sch_id; ?>" />
<input type="hidden" value="{{ $months_ary[$sch_id] }}" id="months_<?php echo $sch_id; ?>" name="months_<?php echo $sch_id; ?>" />
 
<input type="hidden" value="{{ $amount_to_send_local_curreny_sum_ary[$sch_id] }} " id="send_local_amount_<?php echo $sch_id; ?>" name="send_local_amount_<?php echo $sch_id; ?>" />
<input type="hidden" value="{{ $amount_to_send_sum_ary[$sch_id] }} " id="send_amount_<?php echo $sch_id; ?>" name="send_amount_<?php echo $sch_id; ?>" />

<input type="hidden" value="{{ $amount_to_send_local_curreny_monthly_fee[$sch_id] }} " id="send_local_amount_monthly<?php echo $sch_id; ?>" name="send_local_amount_monthly<?php echo $sch_id; ?>" />


<input name="child_list[]"  type="hidden" id="child_<?php echo $sch_id; ?>" value="<?php echo $sch_id; ?>"  />
<input name="schedule_id_list[]"  type="hidden" id="schedule_id_list_<?php echo $sch_id; ?>" value="<?php echo $sch_id; ?>"  />
<input name="duedate"  type="hidden" id="duedate_<?php echo $sch_id; ?>" value="<?php echo $schedule->paydate; ?>"  />
<input name="curr_ary<?php echo $sch_id; ?>"  type="hidden" id="curr_ary<?php echo $sch_id; ?>" value="<?php echo $schedule->currency_array; ?>"  />
<!-- Will use this later, to check that all currencies are equal under 1 parent  -->
<input name="curr_ary_val[]"  type="hidden" id="curr_ary_val_<?php echo $sch_id; ?>" value="<?php echo $schedule->currency_array; ?>"  />


				@endforeach
                <?php
                  /* } */
                ?>


            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>

          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">


        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due 2/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php //echo $cad_amt_sum; ?>
				{{ $currency_grand_total }}
				</td>
              </tr>

              <tr>
                <th>Total:</th>
                <td><?php //echo $cad_amt_sum; ?>
				{{ $currency_grand_total }}
				</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
		<div class="col-md-9">
		<div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Send Invoice to email</label>

                  <div class="col-sm-6">
                    <input type="email" class="form-control" id="invoice_email" name="invoice_email" placeholder="Email" value="{{ $parents_email }}" autocomplete="off" require>
                    @if ($errors->has('email'))
                          <span class="text-red">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
        </div>
		</div>
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
			
			
			

              <div class="box-footer">
                <a href="{!! url('/parents/createinvoice/'.$parents['id']); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->
</form>			  

</div>
<script>

</script>
@endsection