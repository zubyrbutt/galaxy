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


<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="{!! url('todayMassage'); !!}" method="GET" enctype="multipart/form-data">
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
           

              <div class="form-group col-md-12">
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

              <script>
                
                 $(document).ready(function() { 
                  $('.select2').select2({
                      placeholder: "Select Staff",
                      multiple: false,
                  }); 
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
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="searchRecords">Search
                <i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- /.box -->
      </form>
      </div>
</div>



<!-- row -->
<div class="row">
  <div class="col-xs-12">
	<!-- Message -->
	<div class="col-xs-6">
		<?php
			$dated="";
			$showdate=1;
		?>
		@if(count($messages) > 0)
		@foreach($messages as $message)
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
		<ul class="timeline" id="timelinemore" data-next-page="{{$messages->nextPageUrl() }}">
			@if($showdate===1)
			<!-- timeline time label 
			<li class="time-label" >
						<span class="bg-red">
							{{$dated}}
						</span>
			</li>-->
			<!-- /.timeline-label -->
			@endif
			<!-- timeline item -->
			<li>
				<i class="fa fa-envelope bg-blue"></i>
        
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> {{$message->created_at->format('d-M-Y H:i')}} </span>

					<h3 class="timeline-header"><a href="#">{{$message->user->fname}} {{$message->user->lname}}</a> posted in <a href="{!! url('/projects/'.$message->project_id ); !!}" target="_blank">{{$message->project->projectName}}</a> </h3>

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
  
	<!-- Message -->

    <!-- Task -->
		<div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Task</h3>
              <span class="pull-right">
                 
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" >
            
              <table id="table_data" class="display" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Project</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Status</th>
                  <th>Created by</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	 @foreach($tasks as $task)
                  <tr>
                    <td>{{$task['id']}}</td>
					          <td>{{$task['title']}}</td>
                    <td>{{$task->project->projectName}}</td>
                    <td>{{$task->startDate->format('d-M-Y h:i:s') }}</td>
                    <td>{{$task->endDate->format('d-M-Y h:i:s')}}</td>
                    <td>@if ($task->status === 2)
                        <span class="text-green"><b>Closed</b></span>
                      @elseif ($task->status === 1)
                        <span class="text-yellow"><b>Inprogress</b></span>
                      @elseif ($task->status === 0)
                        <span class="text-red"><b>Open</b></span>
                      @else
                        <span class="text-red"><b>Open</b></span>
                      @endif</td>
                    <td>{{$task->createdby->fname}} {{$task->createdby->lname}}</td>
                    <td>{{$task->created_at->format('d-M-Y h:i:s') }}</td>
                    <td>
                      <a href="{!! url('/tasks/detail/'.$task['id'] ); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>
                      @if ($task->status === 0)
                        <a href="{!! url('/tasks/edit/'.$task['id'].''); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>      
                      @endif

                    </td>
                  </tr>
                  @endforeach		
                </tbody>
                <tfoot>
               <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Project</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Status</th>
                  <th>Created by</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
		<!-- Task --> 
	
    
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

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<script>





$( document ).ready(function() {

   $('#table_data').DataTable();
 
});

/*var InitTable = function() {
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
*/



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