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
 $user = Auth::user();
?>

{{-- @if(count($myappointments) > 0 && auth()->user()->isGoOnAppoints==1)
<div class="row">
<!-- My Appointments -->
<div class="col-md-12">
    <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">My Appointments</h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($myappointments as $appointment)
                <li class="item">
                <div class="product-img info-box-icon bg-red" style="height: 60px; width: 60px; font-size: 40px; line-height: 60px; margin:5px;">
                    <i class="fa fa-calendar"></i>
                </div>
                  <div class="product-info">
                  
                    <a href="{!! url('/leads/'.$appointment->lead->id ); !!}" class="product-title">{{$appointment->appointtime->format('d-M-Y h:i:s')}} with {{$appointment->lead->businessName}}</a>
                    <span class="product-description">
                        {{$appointment->note}}<br>
                        @foreach($appointment->users as $staff)
                          {{ $loop->first ? '' : ' ' }}
                          <span class="btn bg-blue btn-xs"><small>{{$staff->fname}} {{$staff->lname}}</small></span>
                        @endforeach
                        <br>
                        By: {{$appointment->createdby->fname}} {{$appointment->createdby->lname}}
                        </span>
                  </div>
                </li>
                @endforeach
                <!-- /.item -->                
              </ul>
            </div>
            <!-- /.box-body -->
           </div>

    </div>
</div>
@endif --}}
@can('stats-number')
<!-- Statistics begins-->
<div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-object-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Projects</span>
              <span class="info-box-number">{{$statistics_count['projects']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-hourglass-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Leads</span>
              <span class="info-box-number">{{$statistics_count['leads']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> Interested in Webinar</span>
              <span class="info-box-number">{{$statistics_count['appointments']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-audio-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Recordings</span>
              <span class="info-box-number">{{$statistics_count['recordings']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
</div>
<!-- Statistics ends -->
@endcan


@can('stats-hr')
<!-- HR Staff Statistics begins-->
<div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Staff</span>
              <span class="info-box-number">{{$hrstats['activestaff']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-check-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Joined This Month</span>
              <span class="info-box-number">{{$hrstats['joined']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Left This Month</span>
              <span class="info-box-number">{{$hrstats['left']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
</div>
<!-- HR Staff Statistics ends -->

<!-- HR Hiring Request Statistics begins-->
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-blue">
      <div class="inner">
        <h3>{{$hrstats['totalrequests']}}</h3>

        <p>Requests This Month</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-stalker"></i>
      </div>
    </div>
  </div>
<!-- /.col -->

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3>{{$hrstats['completedrequest']}}</h3>

      <p>Completed/Fulfilled This Month</p>
    </div>
    <div class="icon">
      <i class="ion ion-paper-airplane"></i>
    </div>
  </div>
</div>
<!-- /.col -->
<!-- fix for small devices only -->
<div class="clearfix visible-sm-block"></div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>{{$hrstats['inprocessdrequest']}}</h3>

      <p>Inprocess This Month</p>
    </div>
    <div class="icon">
      <i class="ion ion-edit"></i>
    </div>
  </div>
</div>
<!-- /.col -->

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3>{{$hrstats['pendingrequest']}}</h3>

      <p>Pending This Month</p>
    </div>
    <div class="icon">
      <i class="ion ion-clipboard"></i>
    </div>
  </div>
</div>
<!-- /.col -->


</div>
<!-- HR Hiring Request Statistics ends-->
@endcan



  <div class="row">
    @can('lead-chart-10')
    <!-- Lead Chart Begins-->
    <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Last 10 days leads </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
    <!-- Lead Chart Ends -->
    @endcan
    @can('appointment-chart-10')
    <!-- Appointments Chart Begins-->
    <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Last 10 days Appointments </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart2" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
    <!-- Appointments Chart Ends -->
    @endcan
    @can('today-appointments')
    <!-- Today Appointments -->
    <div class="col-md-12">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Today Appointments</h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
{{--               @if(count($recentappointments) > 0)
              <ul class="products-list product-list-in-box">
                @foreach($recentappointments as $appointment)
                <li class="item">
                <div class="product-img info-box-icon bg-green" style="height: 60px; width: 60px; font-size: 40px; line-height: 60px; margin:5px;">
                    <i class="fa fa-calendar"></i>
                </div>
                  <div class="product-info">
                  
                    <a href="{!! url('/leads/'.$appointment->lead->id ); !!}" class="product-title">{{$appointment->appointtime->format('d-M-Y h:i:s')}} with {{$appointment->lead->businessName}}</a>
                    <span class="product-description">
                        {{$appointment->note}}<br>
                        @foreach($appointment->users as $staff)
                          {{ $loop->first ? '' : ' ' }}
                          <span class="btn bg-blue btn-xs"><small>{{$staff->fname}} {{$staff->lname}}</small></span>
                        @endforeach
                        <br>
                        By: {{$appointment->createdby->fname}} {{$appointment->createdby->lname}}
                        </span>
                  </div>
                </li>
                @endforeach
                <!-- /.item -->                
              </ul>
              @else
                <p>No Record(s) found.</p>
              @endif --}}

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
            <a href="{!! url('/appointments/'); !!}" class="uppercase">View All Appointments</a>
            </div>
            <!-- /.box-footer -->
          </div>

    </div>
    @endcan
    @can('latest-appointments')
        <!-- Appointments -->
        <div class="col-md-12">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Appointments</h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
{{--               @if(count($appointments) > 0)
              <ul class="products-list product-list-in-box">
                @foreach($appointments as $appointment)
                <li class="item">
                <div class="product-img info-box-icon bg-aqua" style="height: 60px; width: 60px; font-size: 40px; line-height: 60px; margin:5px;">
                    <i class="fa fa-calendar"></i>
                </div>
                  <div class="product-info">
                    <a href="{!! url('/leads/'.$appointment->lead->id ); !!}" class="product-title">{{$appointment->appointtime->format('d-M-Y h:i:s')}} with {{$appointment->lead->businessName}}</a>
                    <span class="product-description">
                        {{$appointment->note}}<br>
                        @foreach($appointment->users as $staff)
                          {{ $loop->first ? '' : ' ' }}
                          <span class="btn bg-blue btn-xs"><small>{{$staff->fname}} {{$staff->lname}}</small></span>
                        @endforeach
                        <br>
                        By: {{$appointment->createdby->fname}} {{$appointment->createdby->lname}}
                        </span>
                  </div>
                </li>
                @endforeach
                <!-- /.item -->                
              </ul>
              @else
                <p>No Record(s) found.</p>
              @endif --}}

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{!! url('/appointments/'); !!}" class="uppercase">View All Appointments</a>
            </div>
            <!-- /.box-footer -->
          </div>

    </div>

    </div>
    @endcan
    <div class="row">
    @can('latest-leads')
      <!-- Lastest Leads -->
    <div class="col-md-12">
    <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Leads</h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(count($leads) > 0)
              <ul class="products-list product-list-in-box">
                @foreach($leads as $lead)
                <li class="item">
                <div class="product-img info-box-icon bg-red" style="height: 60px; width: 60px; font-size: 40px; line-height: 60px; margin:5px;">
                    <i class="fa fa-hourglass-o"></i>
                </div>
                  <div class="product-info">
                    <a href="{!! url('/leads/'.$lead->id ); !!}" class="product-title">{{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}}) 
                    <span class="product-description">
                            {{$lead->businessAddress}}, 
                            {{$lead->businessNature}}<br>
                            By: {{$lead->createdby->fname}} {{$lead->createdby->lname}}
                        </span>
                  </div>

                </li>
                @endforeach
                <!-- /.item -->                
              </ul>
              @else
                <p>No Record(s) found.</p>
              @endif

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{!! url('/leads/' ); !!}" class="uppercase">View All Leads</a>
            </div>
            <!-- /.box-footer -->
          </div>
    </div>
@endcan
@can('latest-recordings')
       <div class="col-md-12">
      <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Latest Recordings</h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="notificationtable" class="table responsive nowrap">
                <tbody><tr>
                  <th>Note</th>
                  <th>Recording</th>
                </tr>
                @foreach($recordings as $recording)
                <tr>
                <td>
                  <a href="{!! url('leads',$recording->lead_id); !!}">{{$recording->lead->businessName}}
                  ({{$recording->lead->user->fname}} {{$recording->lead->user->lname}})</a> @
                  <small> {{$recording->created_at->format('d-M-Y')}} </small><br>
                  {{$recording->title}}
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
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
            <a href="{!! url('/recordings/'); !!}" class="uppercase">View All Recordings</a>
            </div>
          </div>
          
      </div>
@endcan

    </div>


@can('pending-proposal')
<!-- Box Proposal Begins -->

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Proposals</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="">
      @if(count($proposals) > 0)
          <table id="nofeaturesproposal" class="display responsive wrap" style="width:100%;">
          <thead>
          <tr>
            <th>Title & Note</th>
            <th>Lead</th>
            <th>File</th>
            <th>Created by</th>
          </tr>
          </thead>
          <tbody>
          @foreach($proposals as $proposal)
            <tr>
            <td><b>{{$proposal->title}}</b> <small> @ {{$proposal->created_at->format('d-m-Y')}}</small><br>{{$proposal->note}}</td>
            <td><b><a href="{!! url('leads/'.$proposal->lead_id ); !!}">{{$proposal->lead->businessName}}</a></td>
            <td>
            @if($proposal->docfile)
              @if(Storage::disk('local')->exists('public/leads_assets/proposal/'.$proposal->docfile))
              <a href="{{Storage::disk('local')->url('public/leads_assets/proposal/'.$proposal->docfile)}}" target="_blank" class="btn btn-info"><li class="fa fa-file"></li> View</a>
              @else
                NA
              @endif
            @else
            <a href="{!! url('leads/uploadproposal/'.$proposal->lead_id.'/'.$proposal['id'].'' ); !!}" class="btn btn-danger" title="Upload Proposal File"><li class="fa fa-exclamation-triangle"></li></a>
            @endif
            </td>
            <td>{{$proposal->createdby->fname}} {{$proposal->createdby->lname}}</td>
            
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
<!-- Box Proposal ends -->
@endcan
@can('show-dashboard-calendar')
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-primary">
          <div class="panel-heading">Schedule Appointments</div>

          <div class="panel-body">
              {!! $calendar->calendar() !!}
          </div>
      </div>
  </div>
</div>
@endcan
@endsection
@push('scripts')
<!-- For Charts -->
<script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     */
    var data="{{$chartcreatedat}}";
    var areaChartData = {
      labels  : JSON.parse(data.replace(/&quot;/g,'"')),
      datasets: [
        {
          label               : 'Leads',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : {{$chartleads}}
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    
    //-------------
    //- Lead CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    var dataappointment="{{$appointmentchartcreatedat}}";
    var AppointmentChartData = {
      labels  : JSON.parse(dataappointment.replace(/&quot;/g,'"')),
      datasets: [
        {
          label               : 'Leads',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : {{$chartleadsappointments}}
        }
      ]
    }


    //-------------
    //- Appointment CHART -
    //--------------

    var barChartCanvas                   = $('#lineChart2').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = AppointmentChartData
    barChartData.datasets[0].fillColor   = '#00a65a'
    barChartData.datasets[0].strokeColor = '#00a65a'
    barChartData.datasets[0].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(AppointmentChartData, barChartOptions)

    

  })
</script>
@can('show-dashboard-calendar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
@endcan
@endpush