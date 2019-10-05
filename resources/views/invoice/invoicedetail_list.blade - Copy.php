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
              <h3 class="box-title">Manage Invoice Details</h3>
			  @can('create-invoice')
				<span class="pull-right">
				  <a href="{!! url('/invoice/invoicecreate'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>
				</span>
			  @endcan	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            @if(count($invoicedetails) > 0)
              <table id="example1" class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Invoice</th>
                  <th>Parent</th>
				  <th>Teacher</th>
                  <th>Student</th>
				  <th>Amount USD</th>
				  <th>Amount</th>
				  <th>Sch</th>
                </tr>
                </thead>
                <tbody>
				<?php 
				  $amount_sum = array();
				?>
                @foreach($invoicedetails as $invoicedetail)
                  <tr>
                    <td>{{ $invoicedetail['invoice_id']}} </td>	
					<?php $amount_sum[$invoicedetail['id']] = $invoicedetail['payment']; ?>
                    <td>{{ $invoicedetail->parent_name['fname'] }} {{ $invoicedetail->parent_name['lname'] }} </td>
					<td>{{ $invoicedetail->teachername['fname'] }} {{ $invoicedetail->teachername['lname'] }}</td>
					<td>{{ $invoicedetail->studentname['fname'] }} {{ $invoicedetail->studentname['lname'] }}</td>
                    <td>{{ $invoicedetail['payment'] }}</td>					
					<td>{{ $invoicedetail['payment_local'] }} 
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoicedetail['currency'])
							[ {{ $curr }} ]
							@endif
						@endforeach
					@endif					
					
					</td>
					<td>{{ $invoicedetail['schedule_id'] }}</td>
					

                    @can('delete-staff')
                    <!-- For Delete Form begin -->
                    <!-- For Delete Form Ends -->
                    @endcan

                   
                    

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
				  <th></th>
                  <th></th>
				  <th></th>
                  <th>Grand Total:</th>
				  <th>$ <?php echo array_sum($amount_sum); ?></th>
				  <th></th>
				  <th></th>
                </tr>
                </tfoot>
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