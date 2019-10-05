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
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->

<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="{!! url('invoice/invoicelist/search'); !!}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Advance Filter</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: none;">
            
            <!--Search Form Begins -->

			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Parent</label>
                <select id="parentID" name="parentID" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Parent" style="width: 100%;" tabindex="-1" aria-hidden="true">
					<option value="">Select Parent</option>
					@if ($parents!='')
						@foreach($parents as $key => $parent)
							<option value="{{ $parent->id }}" >{{ $parent->fname }} {{ $parent->lname }}</option>    
						@endforeach
					@endif              
                </select>
              </div>
			  </div>
			  
			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Student</label>
                <select id="studentID" name="studentID" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Student" style="width: 100%;" tabindex="-1" aria-hidden="true">
					<option value="">Select Student</option>
					@if ($students!='')
						@foreach($students as $key => $student)
							<option value="{{ $student->id }}" >{{ $student->fname }} {{ $student->lname }}</option>    
						@endforeach
					@endif              
                </select>
              </div>
			  </div>
			  
			  
			  
              <div class="form-group col-md-6"> 
			  <div class="col-sm-12">			  
                  <label>Select Date Range:</label>  
                  <div class="input-group">
                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                      <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                      <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-d')}}">
                      <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-d')}}">
                      <i class="fa fa-caret-down"></i>
                    </button>
                  </div>
			  </div>
			  </div>

<!--paid status -->
			  <div class="form-group col-md-6">
			  <div class="col-sm-12">
                <label>Select Status</label>
                <select id="paid_status" name="paid_status" class="form-control select2 " multiple="" data-placeholder="Select Status" style="width: 100%;" tabindex="-1" aria-hidden="true">
					
					<option value="0">pending</option>
					<option value="1">paid</option>
					<option value="2">cancel</option>
					<option value="3">process</option>
                </select>
              </div>
			  </div>
			  

              <script>
                
                 $(document).ready(function() { 
                  $('.select2').select2({
                      placeholder: "Select Staff",
                      multiple: false,
                  }); 
                  $('.select2').change(
                    console.log("123123")
                  );
                 
                  //Date range as a button
                  $('#daterange-btn').daterangepicker(
                    {
                      ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                      },
                      startDate: moment().subtract(29, 'days'),
                      endDate  : moment()
                    },
                    function (start, end) {
                      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                      $('#dateFrom').val(start.format('YYYY-MM-DD'));
                      $('#dateTo').val(end.format('YYYY-MM-DD'));
                    }
                  );

                  });
                


              </script>
            <!-- Search Form Ends -->


            <!-- Search Form Ends -->
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="searchRecords">Search
                <i class="fa fa-search"></i></button>
				<input name='search-submit' value='1' type='hidden' />
          </div>
        </div>
        <!-- /.box -->
      </form>
      </div>
</div>  
  
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pending Invoices</h3>
			  @can('create-invoice')
				<span class="pull-right">
				  <a href="{!! url('/invoice/invoicecreate'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Schedule</a>
				</span>
			  @endcan	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            @if(count($invoices) > 0)
              <table id="example3" class="display nowrap" style="width:100%">
                <thead>
                <tr>
				  <th>Invoice ID</th>
				  <th>Parent</th>
                  <th>Invoice Date</th>
				  <th>Status</th>
				  <th>Amount(USD)<!--Payment--></th>
				  <th>Amount<!--Payment local--></th>
				  <!--<th>Country</th>-->
				  <th>Created by</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php 
				  $amount_sum = array();
				?>				
                @foreach($invoices as $invoice)
				<?php $url_arry = array();
$chil_names = ''; ?>
                  <tr>
				  <?php $amount_sum[$invoice['i_id']] = $invoice->total_amount; ?>
                    
					<td>{{ $invoice->invoice_id }}</td>	
<!--Following loop is not get students of the parent and show in tooltip -->                     		
@foreach($invoicedetails_students as $stu_name)
	@if( $invoice->invoice_id == $stu_name->invoice_id )
		<?php $fName = $stu_name->studentname['fname'];
			  $lName = $stu_name->studentname['lname'];
			  $url_arry[] = ucfirst($fName).' '.$lName;	?>
	@else
	@endif

@endforeach	
<?php //echo "<span style='color:red'>" . $chil_names = implode(' , ',$url_arry) . "</span>"  
$chil_names = implode(' , ',$url_arry) ?>
	 
					<td><a href="#" data-toggle="tooltip" data-placement="right" title="[<?php echo $chil_names; ?>]">{{ $invoice->parent_name }}</a><br></td>			
                    <td>{{ $invoice->invoice_date->format('Y-m-d') }}</td>
					@if($invoice->paid_status==0)
						<td style='color:red'>UNPAID</td>
					@elseif($invoice->paid_status==1)
						<td style='color:green'>PAID</td>
					@endif
                    <td>{{ $invoice->total_amount }}</td>
					<td>{{ $invoice->total_amount_local }}
					@if ($currency!='')
						@foreach($currency as $key => $curr)
							@if($key == $invoice['currency'])
							<b>({{ $curr }})</b>
							@endif
						@endforeach
					@endif
					</td>
					<!--@foreach($parent_country as $p_country)
						@if( $invoice->parent_id == $p_country->user_id )
							@if ($country!='')
								@foreach($country as $key => $cntry)
									@if($key == $p_country->countryID)
									<td>{{ $cntry }}</td>
									@endif
								@endforeach
							@endif
						@else
						@endif
					@endforeach-->
					
					<td>{{ $invoice->createdby['fname'] }} {{ $invoice->createdby['lname'] }}</td>					
                    @can('delete-staff')
                    <!-- For Delete Form begin -->
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>
                      <a href="{!! url('/invoice/invoicedetail_list/'.$invoice->invoice_id); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>
                      <a href="{!! url('/invoice/makeinvoicepayment/'.$invoice->invoice_id); !!}" class="btn btn-warning" title="Make Invoice Payment">Make Payment </a>
                      
					  <a class='btn btn-primary invoice_reminder' href='javascript:void(0)' data-id="<?php echo $invoice['i_id']?>" title='Add Reminder'>Reminder</a> 
					  
					  @can('status-confirmdead')
					  <a href="{!! url('/invoice/invoice_deadconfirmation/'.$invoice->parent_id); !!}" class="btn btn-warning" title="DC"><i class="fa fa-times"></i> </a>
					  @endcan					  
					  
					  @can('edit-invoice')<a href="{!! url('/invoice/'.$invoice->invoice_id.'/edit'); !!}" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>@endcan					  
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
				  <th></th>
                  <th>Grand Total:</th>
				  <th>$ <?php echo array_sum($amount_sum); ?></th>
				  <th></th>
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

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
      <!-- Edit Modal Begins -->   
      <div class="modal fade" id="modal-default-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add reminder for <input name="invoice_id" id="editinvoice" type="" readonly /></h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('invoice.reminder_update')}}" method="POST" id="frmEditDepartment">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
				  <input name="invoice_id" id="editinvoice" type="hidden" value="0" />
                  <div class="box-body">
                <div class="form-group">
                  <label for="comments_reminder" class="">Comments</label>
                    <textarea type="text" class="form-control" id="editcomments_reminder" name="comments_reminder" rows="4" cols="30" required></textarea><br>
					@if ($errors->has('comments_reminder'))
                          <span class="text-red">
                              <strong>{{ $errors->first('comments_reminder') }}</strong>
                          </span>
                      @endif
                  
                </div>
				
				<div class="form-group">
					  <label for="date_reminder" class="">Reminder date</label>
						<input type="date" class="form-control" id="editdate_reminder" name="date_reminder" placeholder="Start Date" autocomplete="off" />
					       
				</div>				
				

				
					
					
					
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                  </div>
                </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Edit Modal Ends -->	  
	  



<script>
  //invoice_reminder Form Begins
    $(document).on('click', '.invoice_reminder', function()
    {
	  //alert('123');
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('invoice.invoice_reminder')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          //Populating Form Data to Edit Begins
          $('#modal-default-edit').modal('toggle');
          $('#editid').val(data.id);
          $('#editinvoice').val(data.invoice_id);
		  //$('#editcountryID').val(data.parentdetail_relation.countryID)='';	  
		  //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //invoice_reminder Form Ends
  //Update reminder_update Begins
  $("#frmEditDepartment").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('invoice.reminder_update')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
              
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  var errordetails="";
				  if(data.errors.invoice_id){
                    errordetails+=data.errors.invoice_id+ "\n";
                  }
                  if(data.errors.comments_reminder){
                    errordetails+=data.errors.comments_reminder+ "\n";
                  }
                  if(data.errors.date_reminder){
                    errordetails+=data.errors.date_reminder+ "\n";
                  }
			  
                  swal("Failed", "Unable to update reminder " , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditDepartment")[0].reset(); 
                  swal("Success", "Invoice Reminder updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Update reminder, Please try again later.", "error");
              }          
       });
    }));
    //Update reminder_update Ends
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
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
@endsection