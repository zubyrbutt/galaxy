@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
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
              <h3 class="box-title">Invoice Details</h3>
            </div>
            <!-- /.box-header -->
			


    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Monthly Invoice {{ $months }}
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
            [parent id]<br>
            
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #201809281152202004</b><br>
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
              <th>MONTHLY FEE(CAD)	</th>
              <th>DUE DATE	</th>
              <th>NO OF MONTHS-ORG	</th>
              <th>TOTAL (CAD)</th>
            </tr>
            </thead>
            <tbody>
				<?php
				$cad_amt = 50;
				$cad_amt_sum = 0;	
				for ($x = 1; $x <= 3; $x++) {
				echo $cad_amt_sum += $cad_amt;
                ?>
                  <tr>
					<td>Student <?php echo $x; ?></td>
					<td>50 <?php echo $x; ?></td>
					<td><?php echo date('Y-m-d'); ?></td>
					<td>1 month 0 days</td>
					<td>50</td>
                  </tr>

                <?php
                  }
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
                <td><?php echo $cad_amt_sum; ?></td>
              </tr>

              <tr>
                <th>Total:</th>
                <td><?php echo $cad_amt_sum; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
		<div class="col-md-9">
		<div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Send Invoice to email</label>

                  <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email-Pick the email from db" value="{{ old('email') }}" autocomplete="off" require>
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
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
			
			
			

              <div class="box-footer">
                <a href="{!! url('/schedule_parent/createInvoice/'); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->
</div>


@endsection