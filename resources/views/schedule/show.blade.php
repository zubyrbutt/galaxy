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
              <h3 class="box-title">{{ $show_schedule->studentname->fname }} {{ $show_schedule->studentname->lname }} - Schedule Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row"> 
			  <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                          <img src="http://erp.nsol.sg/img/staff/default_avatar_male.jpg" width="90%">
                  </div>
              </div> 
              <div class="col-md-8">
              <table class="table table-striped">
                <tr>
                    <td width="25%"><b>First Name </b></td>
                    <td width="75%" >{{ $show_schedule->studentname->fname }}</td>
                </tr>
                <tr>
                    <td width="25%"><b>Last Name </b></td>
                    <td width="75%" >{{ $show_schedule->studentname->lname }}</td>
                </tr>				
				<tr>
                    <td width="25%"><b>Teacher</b></td>
                    <td width="75%" >{{ $show_schedule->teachername->fname }} {{ $show_schedule->teachername->lname }}</td>
                </tr>
				<tr>
                    <td width="25%"><b>Course</b></td>
                    <td width="75%" >{{ $show_schedule->coursename->courses }} </td>
                </tr>			
                <tr>
                    <td width="25%"><b>Start time</b></td>
                    <td width="75%" >{{ $show_schedule->startTime }}</td>
                </tr>
                <tr>
                    <td width="25%"><b>End time</b></td>
                    <td width="75%" >{{ $show_schedule->endTime }}</td>
                </tr>
				<!--<tr>
                    <td><b>Start Date</b></td>
                    <td>{{ $show_schedule->startDate->format('Y-m-d') }}</td>
                </tr>
				<tr>
                    <td><b>End Date</b></td>
                    <td>{{ $show_schedule->endDate->format('Y-m-d') }}</td>
                </tr>-->
				<tr>
                    <td width="25%"><b>Class Days</b></td>
                    <td width="75%" >{{ $data['classType'] }}</td>
                </tr>
				
                <tr>
                    <td width="25%"><b>Status</b></td>
                    <td width="75%" >{{ $data['std_status'] }}</td>
                </tr>			
              </table>
                  

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/schedule'); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->
	</div>
	
	<!-- DATES and DUES ROW -->
	<div class="row">
    <div class="col-md-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Dates</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped">
						  <tbody>
						  <tr>
							<td><b>Start Date</b></td>
							<td>{{ $show_schedule->startDate->format('Y-m-d') }}</td>
						  </tr>
						  <tr>
							  <td><b>End Date</b></td>
							  <td>{{ $show_schedule->endDate->format('Y-m-d') }}</td>
						  </tr>
							<tr>
								<td><b>Due Date</b></td>
								<td>{{ $show_schedule->duedate }}</td>
							</tr>
							<tr>
								<td><b>Pay Date</b></td>
								<td>{{ $show_schedule->paydate }}</td>
							</tr>							
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>

    <div class="col-md-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Dues</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
						<table class="table table-striped">
						  <tbody>
						  <tr>
							<td><b>Dues (USD)</b></td>
							<td>{{ $show_schedule->dues_usd }}</td>
						  </tr>
						 {{--  <tr>
							<td><b>Dues Original Currency({{$data['currency']}})</b></td>
							<td>{{ $show_schedule->dues_original }}</td>
						  </tr>	 --}}					
						  </tbody>
						</table>          
				</div>
				</div>
			  </div>
		</div>
	</div>
    </div>


	<!-- DATES and DUES ROW -->
	<div class="row">
    <div class="col-md-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Country,Agent,Parent</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped">
						  <tbody>
							{{-- <tr>
								<td><b>Country</b></td>
								<td>
									{{ $data['country'] }}</td>
							</tr> --}}
							<tr>
								<td><b>Agent</b></td>
								<td>{{ $show_schedule->agentname->fname }} {{ $show_schedule->agentname->lname }}</td>
							</tr>
							
							<tr>
								<td><b>Parent</b></td>
								<td>{{ $show_schedule->studentname->parent_name['fname'] }} {{ $show_schedule->studentname->parent_name['lname'] }}</td>
							</tr>							
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>

    <div class="col-md-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Created and Modified</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
						<table class="table table-striped">
						  <tbody>
							<tr>
								<td><b>Created by</b></td>
								<td>{{ $show_schedule->createdby->fname }} {{ $show_schedule->createdby->lname }}</td>
							</tr>
							<tr>
								<td><b>Modified by</b></td>
								<td>{{ $show_schedule->modifiedby->fname }} {{ $show_schedule->modifiedby->lname }}</td>
							</tr>
							
							<tr>
								<td><b>Created at</b></td>
								<td>{{ $show_schedule->created_at->format('Y-m-d') }}</td>
							</tr>
							<tr>
								<td><b>Updated at</b></td>
								<td>{{ $show_schedule->updated_at->format('Y-m-d') }}</td>
							</tr>						  
						  </tbody>
						</table>          
				</div>
				</div>
			  </div>
		</div>
	</div>
    </div>



	
@endsection