@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
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


<!-- row -->
<div class="row">
	<div class="col-md-6">
		<?php
			$dated="";
			$showdate=1;
		?>
		@if(count($data['messages']) > 0)
		@foreach($data['messages'] as $message)
		<?php

			if($dated==""){
				$dated=$message->created_at->format('d-M-Y');
				$showdate=1;
			}elseif($dated===$message->created_at->format('d-M-Y')){				
					$showdate=0;
			}else{
				$showdate=1;
				$dated=$message->created_at->format('d-M-Y');
			}
		?>
		<!-- The time line -->
		<ul class="timeline" id="timelinemore" data-next-page="{{$data['messages']->nextPageUrl() }}">
			@if($showdate===1)
			<!-- timeline time label -->
			<li class="time-label" >
						<span class="bg-red">
							{{$dated}}
						</span>
			</li>
			<!-- /.timeline-label -->
			@endif
			<!-- timeline item -->
			<li>
				<i class="fa fa-envelope bg-blue"></i>

				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> {{$message->created_at->format('H:i')}} </span>

					<h3 class="timeline-header"><a href="#">{{$message->user->fname}} {{$message->user->lname}}</a> posted</h3>

					<div class="timeline-body">
						{!! html_entity_decode(nl2br(e(makeLinks($message->message)))) !!}
								@if(count($message->assets) > 0)
								<div class="clearfix"><br></div>
								<ul class="mailbox-attachments clearfix">
									@foreach($message->assets as $asset)
									@if(Storage::disk('local')->exists('public/projects_assets/'.$message->project_id.'/messages/'.$asset->attachment))
									
										<li>
											<div class="mailbox-attachment-info">
												<p class="mailbox-attachment-name">{{$asset->orginalfilename}}</p>
														<span class="mailbox-attachment-size">
														{{number_format((Storage::disk('local')->size('public/projects_assets/'.$message->project_id.'/messages/'.$asset->attachment)/1024),2)}} KBs
															<a href="{{Storage::disk('local')->url('public/projects_assets/'.$message->project_id.'/messages/'.$asset->attachment)}}" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
														</span>
											</div>
										</li>
										@endif
										@endforeach
									</ul>
							@endif
					</div>

				</div>
			</li>
			<!-- END timeline item -->
			
			@endforeach
		</ul>
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@endif
			<!-- timeline ends -->
<style>
	.loader {
			border: 8px solid #f2f2f2; /* Light grey */
			border-top: 8px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 40px;
			height: 40px;
			animation: spin 2s linear infinite;
	}
	
	@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
	}
	</style>
	<div id="loader" class="loader text-center"></div>
<style>

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1050;
    top: 0;
    right: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 4px 4px 4px 16px;
    text-decoration: none;
    color: #f1f1f1;
    display: block;
    transition: 0.3s;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    left: 5px;
    font-size: 56px;
		border-radius:100%;
}
@media screen and (max-height: 450px)
{
	.sidenav
	{width:100%;}
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>


<script>

var InitTable = function() {
  $.ajax({
                url: "{{url('/todayMassage/fetch')}}",
                type: "POST",
                data: {_token:'{{csrf_token()}}'},
                dataType : "json",
                success: function(data){
                 console.log(data);
        },
        error: function(){},          
        });
}


$( document ).ready(function() {

  InitTable();

 
});





function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

	$(window).scroll(function(e){ 
  var $el = $('#btnNew'); 
  var isPositionFixed = ($el.css('position') == 'fixed');
  if ($(this).scrollTop() > 200 && !isPositionFixed){ 
    $('#btnNew').css({'position': 'fixed', 'top': '0px', 'right': '10px'}); 
  }
  if ($(this).scrollTop() < 200 && isPositionFixed)
  {
    $('#btnNew').css({'position': 'static', 'top': '0px', 'right': '10px'}); 
  } 
});

$(document).ready(function (e) {



var ajaxRunning = false;
$(document).ready(function() {
	$('#loader').hide();
		 $(window).scroll(fetchPosts);
	
		 function fetchPosts() {
	
				 var page = $('.timeline').data('next-page');

				 if(page !== null) {
	
						 clearTimeout( $.data( this, "scrollCheck" ) );

					
						 $.data( this, "scrollCheck", setTimeout(function() {
								 var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 100;
	
								 if(scroll_position_for_posts_load >= $(document).height()) {				 	
										  $.ajax(page, {asynchronous:true, evalScripts:true, method:'get', 
													beforeSend: function() {
														$('#loader').show();
													},
													success: function(data) {
														$('#loader').hide();
														$('#timelinemore').append(data.messages);
														$('#timelinemore').data('next-page', data.next_page);

													},
													complete: function() {
														$('#loader').hide();
															ajaxRunning = false;
													}
												},);
								 }
						 }, 350))
	
				 }
		 }
	
	
 });
});

</script>
@endsection