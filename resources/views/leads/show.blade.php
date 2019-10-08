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
<?php
function makeLinks($str) {
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	$urls = array();
	$urlsToReplace = array();
	if(preg_match_all($reg_exUrl, $str, $urls)) {
		$numOfMatches = count($urls[0]);
		$numOfUrlsToReplace = 0;
		for($i=0; $i<$numOfMatches; $i++) {
			$alreadyAdded = false;
			$numOfUrlsToReplace = count($urlsToReplace);
			for($j=0; $j<$numOfUrlsToReplace; $j++) {
				if($urlsToReplace[$j] == $urls[0][$i]) {
					$alreadyAdded = true;
				}
			}
			if(!$alreadyAdded) {
				array_push($urlsToReplace, $urls[0][$i]);
			}
		}
		$numOfUrlsToReplace = count($urlsToReplace);
		for($i=0; $i<$numOfUrlsToReplace; $i++) {
			$str = str_replace($urlsToReplace[$i], "<a target='_blank' href=\"".$urlsToReplace[$i]."\">".$urlsToReplace[$i]."</a> ", $str);
		}
		return $str;
	} else {
		return $str;
	}
}
?>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Lead Details of {{$lead_detail->businessName}}</h3>
							<span class="pull-right">
							@can('edit-lead')<a href="{!! url('/leads/'.$lead_detail['id'].'/edit' ); !!}" class="btn btn-info"><li class="fa fa-pencil"></li> Edit</a>@endcan
							@if($lead_detail->approvestatus==0 or $lead_detail->approvestatus==2)
								@can('approve-reject-lead')<a href="{!! url('/leads/approve/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-check"></li> Approve</a>@endcan
							@endif
							@if($lead_detail->approvestatus==0 or $lead_detail->approvestatus==1)
								@can('approve-reject-lead')<a href="{!! url('/leads/reject/'.$lead_detail['id'].'' ); !!}" class="btn btn-danger"><li class="fa fa-ban"></li> Reject</a>@endcan
							@endif
							@if($lead_detail->istraininglead==0)
								@can('for-training-lead')<a href="{!! url('/leads/fortraining/'.$lead_detail['id'].'' ); !!}" class="btn btn-primary"><li class="fa fa-book"></li> For Training</a>@endcan
							@else
								@can('for-training-lead')<a href="{!! url('/leads/removefromtraining/'.$lead_detail['id'].'' ); !!}" class="btn btn-primary"><li class="fa fa-book"></li> Remove From Training</a>@endcan
							@endif
							@can('create-recording')<a href="{!! url('leads/createrecording/'.$lead_detail['id'].'' ); !!}" class="btn btn-warning"><li class="fa fa-plus"></li> Recording</a>@endcan
							@can('create-appointment')<a href="{!! url('leads/createappointments/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-plus"></li> Appintment</a>@endcan
							@can('create-doc')<a href="{!! url('leads/createdocs/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-plus"></li> Document</a>@endcan
							@can('create-proposal')<a href="{!! url('leads/createproposal/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-plus"></li> Proposal</a>@endcan
							@can('create-project')<a href="{!! url('projects/create/'.$lead_detail->user_id.'/'.$lead_detail->id.''); !!}" class="btn btn-danger"><li class="fa fa-plus"></li> Project</a>@endcan
							</span>
            </div>
            <!-- /.box-header -->
				<div class="box-body" >
				  <div class="row">
					<div class="col-md-12">
					<h3>Customer Information:</h3>
					</div>
					
					  <div class="col-md-12">
					  
						<table class="table table-striped">
						<tr>
							<td width="25%"><b>Customer Name</b></td>
							<td width="75%">{{$lead_detail->user->fname}} {{$lead_detail->user->lname}} <input type="hidden" value="{{$lead_detail->id}}" id="lead_id"></td>
							
						</tr>
						<tr>
							<td><b>Phone Number </b></td>
							<td><a href="tel:{{$lead_detail->user->phonenumber}}">{{$lead_detail->user->phonenumber}}</a></td>
						</tr>
						<tr>
							<td><b>Email</b></td>
							<td><a href="mailto:{{$lead_detail->user->email}}">{{$lead_detail->user->email}}</a></td>
						</tr>
						</table>
						</div>
						<div class="col-md-12">
					<h3>Lead Information:</h3>
					</div>
					<div class="col-md-12">
						<table class="table table-striped">
						
						
						
						@if($lead_detail->attributes)
						@php 
						  $attributes = unserialize($lead_detail->attributes) 
						@endphp

						@foreach($attributes as $attribute)
								<tr>
									<td><b>{{ $attribute['name'] }}</b></td>
									<td>{{ $attribute['value'] }}</td>
								</tr>
						@endforeach
						@endif
						
						<tr>
							<td><b>Assigned To</b></td>
							<td>{{isset($lead_detail->assignedTo) ? $lead_detail->assignedTo->fname.' '.$lead_detail->assignedTo->lname : "NA" }}</td>
						</tr>

						<tr>
							<td><b>Created By</b></td>
							<td>{{$lead_detail->createdby->fname}} {{$lead_detail->createdby->lname}}</td>
						</tr>

						<tr>
							<td><b>Status</b></td>
							<td>
								@if ($lead_detail->status === 1)
								  <span class="text-green"><b>Active</b></span>
								@else
									<span class="text-red"><b>Deactive</b></span>
								@endif
							</td>
						</tr>

						<tr>
							<td><b>Created At</b></td>
							<td>{{$lead_detail->created_at->format('d-m-Y')}}</td>
						</tr>
						<tr>
							<td><b>Updated At</b></td>
							<td>{{$lead_detail->updated_at->format('d-m-Y')}}</td>
						</tr>				
						<tr>
							<td><b>Lead Source</b></td>
							<td>{{$lead_detail->source}}</td>
						</tr>
						
					  </table>
					  </div>
				  </div>
				</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
			</div>
			<!-- /.box-footer -->
</div>
<!-- Box Recording begins -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Recordings</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body" style="">
            @if(count($recordings) > 0)
              <table id="nofeatures" class="display responsive" style="width:100%;">
                <thead>
                <tr>
                  <th>Title & Note</th>
				  				<th>Recording</th>
                </tr>
                </thead>
                <tbody>
					<style>
						video {
							width: 100%    !important;
							height: auto   !important;
							}
					</style>
                @foreach($recordings as $recording)
                  <tr>
					<td><b>{{$recording->title}}</b> @ <small>{{$recording->created_at->format("d-M-Y")}}<small><br>
					{{$recording->note}}								
					</td>
					<td>
						@if($recording->link)
						<audio controls>
							<source src="{{$recording->link=="" ? "" : "$recording->link"}}" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>
						@elseif($recording->recording_file && Storage::disk('local')->exists('public/leads_assets/recordings/'.$recording->recording_file))						
						  @if(File::extension('public/leads_assets/recordings/'.$recording->recording_file)=="mp4")
								<video controls style="width: 350px;">
									<source src="{{Storage::disk('local')->url('public/leads_assets/recordings/'.$recording->recording_file)}}" type="audio/mpeg">
									Your browser does not support the audio element.
								</video>
							@else
								<audio controls>
									<source src="{{Storage::disk('local')->url('public/leads_assets/recordings/'.$recording->recording_file)}}" type="audio/mpeg">
									Your browser does not support the audio element.
								</audio>
							@endif
						@else
							NA
						@endif
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
	<div class="box-footer clearfix" style="">
		<div>
			<a href="{!! url('/recordings/'.$lead_detail['id']); !!}" class="pull-right btn btn-info" style="margin-top:5px;">View All</a>
			@can('create-recording')<a href="{!! url('leads/createrecording/'.$lead_detail['id'].'' ); !!}" class="btn btn-warning"><li class="fa fa-plus"></li> Recording</a>@endcan
		</div>
	</div>
	<!-- /.box-footer -->
</div>
<!-- Box Recordings ends -->

<!-- Box Appointments Begins -->

<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Appointments</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				@if(count($appointments) > 0)
				<table id="nofeaturesapp" class="display responsive wrap" style="width:100%;">
					<thead>
					<tr>
						<th>Appointment Date</th>
						<th width="50%">Note</th>
						<th>Assigned To</th>
						<th>Created by</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($appointments as $appointment)
						<tr>
						<td>{{$appointment->appointtime->format('d-M-Y h:i:s')}}</td>
						<td>{{$appointment->note}}</td>
						<td>
							@foreach($appointment->users as $staff)
								{{ $loop->first ? '' : ' ' }}
								<span class="btn bg-blue btn-xs"><small>{{$staff->fname}} {{$staff->lname}}</small></span>
							@endforeach
						</td>
						<td>
							@if($appointment->createdby)
							{{$appointment->createdby->fname}} {{$appointment->createdby->lname}}
							@endif
							

						</td>
						<td>
						<a href="{!! url('leads/create_appnote/'.$lead_detail['id'].'/'.$appointment['id'].'' ); !!}" class="btn btn-primary" title="Create Note"><li class="fa fa-sticky-note"></li> </a>
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
		<div class="box-footer clearfix" style="">
			<div>
				<a href="{!! url('/appointments/'.$lead_detail['id']); !!}" class="pull-right btn btn-info" style="margin-top:5px;">View All</a>
				@can('create-appointment')<a href="{!! url('leads/createappointments/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-plus"></li> Appintment</a>@endcan
			</div>
		</div>
		<!-- /.box-footer -->
	</div>


<!-- Box Appointments ends -->

<!-- Box Proposal Begins -->

<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Proposals</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				@if(count($proposals) > 0)
					  <table id="nofeaturesproposal" class="display responsive" style="width:100%;">
						<thead>
						<tr>
							<th>Title & Note</th>
							<th>File</th>
							<th>Created by</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach($proposals as $proposal)
						  <tr>
							<td><b>{{$proposal->title}}</b> <small> @ {{$proposal->created_at->format('d-m-Y')}}</small><br>{{$proposal->note}}</td>
							<td>
							@if($proposal->docfile)
								@if(Storage::disk('local')->exists('public/leads_assets/proposal/'.$proposal->docfile))
								<a href="{{Storage::disk('local')->url('public/leads_assets/proposal/'.$proposal->docfile)}}" target="_blank" class="btn btn-info"><li class="fa fa-file"></li> View</a>
								@else
									NA
								@endif
							@else
								@can('upload-proposal')<a href="{!! url('leads/uploadproposal/'.$lead_detail['id'].'/'.$proposal['id'].'' ); !!}" class="btn btn-danger" title="Upload Proposal File"><li class="fa fa-exclamation-triangle"></li></a>@endcan
							@endif
							</td>
							<td>{{$proposal->createdby->fname}} {{$proposal->createdby->lname}}</td>
							<td>
							@if(!$proposal->docfile)
							@can('upload-proposal')<a href="{!! url('leads/uploadproposal/'.$lead_detail['id'].'/'.$proposal['id'].'' ); !!}"  class="btn btn-primary" title="Upload Proposal"><i class="fa fa-paperclip"></i> </a>@endcan
							@endif
							@can('edit-proposal')<a href="{!! url('/leads/edit_proposal/'.$proposal['id'].'/'.$lead_detail['id'].''); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>@endcan
							
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
		<div class="box-footer clearfix" style="">
			<div>
					<a href="#" class="pull-right btn btn-info" style="margin-top:5px;">View All</a>
					@can('create-proposal')<a href="{!! url('leads/createproposal/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-plus"></li> Proposal</a>@endcan
			</div>
		</div>
		<!-- /.box-footer -->
	</div>
<!-- Box Proposal ends -->


<!-- Box Docs Begins -->

<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Documents</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				@if(count($docs) > 0)
				<table id="nofeaturesdocs" class="display responsive" style="width:100%;">
					<thead>
					<tr>
						<th>Title & Note</th>
						<th>File</th>
						<th>Created by</th>
					</tr>
					</thead>
					<tbody>
					@foreach($docs as $doc)
						<tr>
						<td><b>{{$doc->title}}</b> <small>@ {{$doc->created_at->format('d-m-Y')}}</small> <br>{{$doc->note}}</td>
						<td>
						@if($doc->docfile)
							
							@if(Storage::disk('local')->exists('public/leads_assets/docfiles/'.$doc->docfile))
							 <a href="{{Storage::disk('local')->url('public/leads_assets/docfiles/'.$doc->docfile)}}" target="_blank" class="btn btn-info"><li class="fa fa-file"></li> View</a>
							@else
								NA
							@endif
						
						@endif
						</td>
						<td>{{$doc->createdby->fname}} {{$doc->createdby->lname}}</td>
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
		<div class="box-footer clearfix" style="">
			<div>
					<a href="#" class="pull-right btn btn-info" style="margin-top:5px;">View All</a>
					@can('create-doc')<a href="{!! url('leads/createdocs/'.$lead_detail['id'].'' ); !!}" class="btn btn-success"><li class="fa fa-plus"></li> Document</a>@endcan
			</div>
		</div>
		<!-- /.box-footer -->
	</div>
<!-- Box Docs ends -->

<!-- Box Chat ends -->
<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Messages/Notes</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				<style>
						.chat {
							list-style: none;
							margin: 0;
							padding: 0;
						}
					
						.chat li {
							margin-bottom: 10px;
							padding-bottom: 5px;
							border-bottom: 1px dotted #B3A9A9;
						}
					
						.chat li .chat-body p {
							margin: 0;
							color: #777777;
						}
					
						.panel-body1 {
							overflow-y: scroll;
							height: 350px;
						}
					.spandate{
						color: #777777;
						font-weight:400;
					}
					.chatimg{
						width: 40px;
						height: 40px;
						border: 2px solid transparent;
						border-radius: 50%;
				}
						
					</style>
					<div id="app">
							<div class="col-md-12">
									<div class="panel panel-default">
											<div class="panel-heading">Quick Chat</div>
			
											<div class="panel-body panel-body1">
													<chat-messages :messages="messages"></chat-messages>
											</div>
											<div class="panel-footer">
													<chat-form
															v-on:messagesent="addMessage"
															:user="{{ Auth::user() }}"
													></chat-form>
											</div>
									</div>
							</div>
						</div>
			
		</div>
		<!-- /.box-body -->
	</div>
<!-- Box Chat ends -->

@endsection