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

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Lead Details of {{$lead_detail->name}}</h3>
	        </div>
            <!-- /.box-header -->
				<div class="box-body" >
				  <div class="row">
					<div class="col-md-12">
					<h3>Lead Information:</h3>
					</div>
					
					  <div class="col-md-12">
					  
						<table class="table table-striped">
						<tr>
							<td width="25%"><b>Name</b></td>
							<td width="75%">{{$lead_detail->name}}</td>
							
						</tr>
						<tr>
							<td><b>Phone Number </b></td>
							<td>{{$lead_detail->contactno}}</td>
						</tr>
						<tr>
							<td><b>Email</b></td>
							<td>{{$lead_detail->email}}</td>
						</tr>
						<tr>
							<td><b>Country</b></td>
							<td>{{$lead_detail->country}}</td>
						</tr>
						<tr>
							<td><b>Subject</b></td>
							<td>{{$lead_detail->subject}}</td>
						</tr>
						<tr>
							<td><b>Message</b></td>
							<td>{{$lead_detail->message}}</td>
						</tr>
						<tr>
							<td><b>Status</b></td>
								<td>
									@switch($lead_detail->status)
										@case(0)
											<span class="text-green"><b>New</b></span>
											@break
										@case(1)
											<span class="text-orange"><b>Inprocess</b></span>
											@break
										@case(2)
											<span class="text-green"><b>Closed</b></span>
											@break								
										@case(3)
											<span class="text-red"><b>Rejected</b></span>
											@break								
										@case(4)
											<span class="text-red"><b>Not Interested</b></span>
											@break
										@case(5)
											<span class="text-green"><b>Call Back</b></span>
											@break
										@case(6)
											<span class="text-green"><b>Trial Committed</b></span>
											@break
										@case(7)
											<span class="text-green"><b>Trial Delivered</b></span>
											@break
										@case(8)
											<span class="text-green"><b>Invoice Sent</b></span>
											@break					
										@case(9)
											<span class="text-red"><b>Spam</b></span>
											@break
										@case(10)
											<span class="text-green"><b>NSNC</b></span>
											@break
										@case(11)
											<span class="text-green"><b>Duplicate</b></span>
											@break										
										@default
											<span class="text-green"><b>New</b></span>
									@endswitch
								</td>
							</tr>
	
							<tr>
								<td><b>Created At</b></td>
								<td>{{$lead_detail->created_at->format('d-m-Y  H:i:s')}}</td>
							</tr>
							<tr>
								<td><b>Updated At</b></td>
								<td>{{$lead_detail->updated_at->format('d-m-Y')}}</td>
							</tr>				
							<tr>
								<td><b>Ref Code</b></td>
								<td>{{$lead_detail->refcode}}</td>
							</tr>
							<tr>
								<td><b>Source</b></td>
								<td>{{$lead_detail->source}}</td>
							</tr>
						</table>
						</div>
						<div class="col-md-12">
					</div>
					
				  </div>
				</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url('yccleads') }}" class="btn btn-default">Back</a>
                 
                 <a href="{{url('nextPrevious',[$lead_detail->id,'Next']) }}" class="btn btn-default pull-right">&nbsp&nbsp&nbsp Next &nbsp&nbsp&nbsp</a>
				<a href="{{url('nextPrevious',[$lead_detail->id,'Previous']) }}" class="btn btn-default pull-right" style="margin-right: 30px;">Previous</a>
               
			</div>
			<!-- /.box-footer -->
</div>


<!-- Box Appointments Begins -->
<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Status Notes</h3>
            <button class='btn btn-primary edit-modal pull-right' data-toggle='modal' data-target='#myModal'>Add Status</button>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				@if(count($notes) > 0)
				<table id="nofeaturesapp" class="display table table-striped responsive wrap" style="width:100%;">
					<thead>
					<tr>
						<th>Status</th>
						<th width="50%">Note</th>
						<th>Created by</th>
						<th>Dated</th>
					</tr>
					</thead>
					<tbody>
					@foreach($notes as $note)
						<tr>
						<td>
							@switch($note->status)
								@case(0)
									<span class="text-green"><b>New</b></span>
									@break
								@case(1)
									<span class="text-orange"><b>Inprocess</b></span>
									@break
								@case(2)
									<span class="text-green"><b>Closed</b></span>
									@break								
								@case(3)
									<span class="text-red"><b>Rejected</b></span>
									@break								
								@case(4)
									<span class="text-red"><b>Not Interested</b></span>
									@break
								@case(5)
									<span class="text-green"><b>Call Back</b></span>
									@break
								@case(6)
									<span class="text-green"><b>Trial Committed</b></span>
									@break
								@case(7)
									<span class="text-green"><b>Trial Delivered</b></span>
									@break
								@case(8)
									<span class="text-green"><b>Invoice Sent</b></span>
									@break												
								@case(9)
									<span class="text-red"><b>Spam</b></span>
									@break
								@case(10)
									<span class="text-green"><b>NSNC</b></span>
									@break		
								@default
									<span class="text-green"><b>New</b></span>
							@endswitch
						</td>
						<td>{{$note->note}}</td>
						<td>{{$note->createdby->fname}} {{$note->createdby->lname}}</td>
						<td>{{$note->created_at->format('d-m-Y  H:i:s')}}</td>
						<td>
						</td>
						</tr>
						@endforeach			  
					</tbody>
					<tfoot>
					</tfoot>
				</table>
				@else
				<div>No Record found.</div>
				@endif	
	
		</div>
		<!-- /.box-body -->
</div>
<!-- Box Appointments ends -->

<!-- The Modal -->
<div id="myModal" class="modal">
    <form action="{{ url('yccleadstatus')}}" method="POST" id="yccleads">
      @csrf
      <!-- Modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 id="modalheader">Your Cloud Campus Leads</h2>
              </div>
              <div class="modal-body" id="modalbody">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{$lead_detail->name}}" readonly>
                  </div>
                  <div class="form-group">
                      <label>Contact No</label>
                      <input type="text" name="contactno" id="contactno" class="form-control" value="{{$lead_detail->contactno}}" readonly>
                  </div>
                  <div class="form-group">
                      <label>Subject</label>
                      <input type="text" name="subject" id="subject" class="form-control" value="{{$lead_detail->subject}}" readonly>
                  </div>
                  <div class="form-group">
                      <label>Country</label>
                      <input type="text" name="country" id="country" class="form-control" value="{{$lead_detail->country}}" readonly>
                  </div>
                  <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" id="status" required="required">
                          <option value="1" selected>Inprocess</option>
                          <option value="2">Closed</option>
                          <option value="3">Rejected</option>
                          <option value="4">Not Interested</option>                
                          <option value="5">Call Back</option>
                          <option value="6">Trial Committed</option>
                          <option value="7">Trial Delivered</option>
                          <option value="8">Invoice Sent</option>
                          <option value="9">Spam</option>
                          <option value="10">NSNC</option>
                          <option value="11">Duplicate</option>  
                      </select>  
                  </div>
                  <div class="form-group">
                      <label>Message</label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..." name="notes" id="notes" required></textarea>
                  </div>
                
              </div>
              <div class="modal-footer" id="modalfooter">
                  <input type="hidden" name="yccleadid" id="yccleadid" class="form-control" value="{{$lead_detail->id}}" readonly required="required">
                  <input type="hidden" name="show_page" id="show_page" class="form-control" value="show_page" readonly>
                <input type="submit" class="btn btn-primary" id="btn-update" value="Update">
              </div>
            </div>
    </form>
</div>
<!-- Modal -->
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1111; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto; /* 15% from the top and centered */
    padding: 2px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Modal Header */
.modal-header {
    padding: 2px 8px;

}


/* Modal Footer */
.modal-footer {
    padding: 2px 8px;
}


</style>
<script type="text/javascript">
window.onclick = function(event) {
if (event.target == modal) {
    modal.style.display = "none";
}
}
</script>
@endsection