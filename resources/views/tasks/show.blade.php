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
<!-- Box Project Info Begins -->

<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Project Details for: {{$projectTask->title}}</h3>
			<div class="pull-right">
				@if ($projectTask->status === 0)
				<a href="{!! url('/tasks/start/'.$projectTask->id.''); !!}" class="btn btn-success"><i class="fa fa-hourglass-start"></i> Start</a>
				<a href="{!! url('/tasks/edit/'.$projectTask->id.''); !!}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
				@endif
				@if ($projectTask->status === 1)
				<a href="{!! url('/tasks/end/'.$projectTask->id.''); !!}" class="btn btn-danger"><i class="fa fa-hourglass-end"></i> End</a>
				@endif
				<!-- <a href="{!! url('/tasks/reopen/'.$projectTask->id.''); !!}" class="btn btn-warning"><i class="fa fa-folder-open"></i> Re-open</a>-->
				
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				
				<table class="table table-striped">
						<tr>
							<td width="25%"><b>Task</b></td>
							<td width="75%"><strong>{{$projectTask->title}}</strong></td>
						</tr>
						<tr>
							<td><b>Description</b></td>
							<td>{!! html_entity_decode(nl2br(e(makeLinks($projectTask->description)))) !!}</td>
						</tr>
							
						<tr>
							<td><b>Assigned To</b></td>
							<td>{{$projectTask->user->fname}} {{$projectTask->user->lname}}</td>
						</tr>
						<tr>
							<td><b>Starts On</b></td>
							<td>{{$projectTask->startDate->format('d-M-Y H:i:s')}}</td>
						</tr>
						<tr>
							<td><b>Ends On</b></td>
							<td>{{$projectTask->endDate->format('d-M-Y H:i:s')}}</td>
						</tr>
						<tr>
							<td><b>Status</b></td>
							<td>
								@if ($projectTask->status === 2)
									<span class="text-green"><b>Closed</b></span><br>
									Started at: <b>{{$projectTask->startOn->format('d-M-Y H:i:s')}}</b> 
									<br> Closed at: <b>{{$projectTask->endOn->format('d-M-Y H:i:s')}}</b>
								@elseif ($projectTask->status === 1)
									<span class="text-yellow"><b>Inprogress</b></span><br>
									Started at: <b>{{$projectTask->startOn->format('d-M-Y H:i:s')}}</b>
								@elseif ($projectTask->status === 0)
									<span class="text-red"><b>Open</b></span>
								@else
									<span class="text-red"><b>Open</b></span>
								@endif
							</td>
						</tr>
						<tr>
							<td><b>Created By</b></td>
							<td>{{$projectTask->createdby->fname}} {{$projectTask->createdby->lname}}</td>
						</tr>
						<tr>
							<td><b>Created At</b></td>
							<td>{{$projectTask->created_at->format('d-m-Y')}}</td>
						</tr>
						<tr>
							<td><b>Updated At</b></td>
							<td>{{$projectTask->updated_at->format('d-m-Y')}}</td>
						</tr>	
				</table>

	
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix">
			<span class="pull-right">
				@if ($projectTask->status === 0)
				<a href="{!! url('/tasks/start/'.$projectTask->id.''); !!}" class="btn btn-success"><i class="fa fa-hourglass-start"></i> Start</a>
				<a href="{!! url('/tasks/edit/'.$projectTask->id.''); !!}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
				@endif
				@if ($projectTask->status === 1)
				<a href="{!! url('/tasks/end/'.$projectTask->id.''); !!}" class="btn btn-danger"><i class="fa fa-hourglass-end"></i> End</a>
				@endif
				<!-- <a href="{!! url('/tasks/reopen/'.$projectTask->id.''); !!}" class="btn btn-warning"><i class="fa fa-folder-open"></i> Re-open</a>-->
			</span>		
		</div>
	</div>
<!-- Box Project Info ends -->
@endsection