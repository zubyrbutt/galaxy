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
    @can('search-leads')
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="{!! url('/leads/search'); !!}" method="post" enctype="multipart/form-data">
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

                <label>Select Staff</label>
                <select name="agentid" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Satff" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  @can('show-all-leads')<option value="all">All</option>@endcan
                  @foreach($agents as $agent)
                    <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                  @endforeach                
                </select>

                  <label>Select Country</label>
                <select name="countryId" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Satff" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  @can('show-all-leads')<option value="all">All</option>@endcan
                  @foreach($countries as $country)
                    <option value="{{$country->ccountry}}">{{$country->ccountry}}</option>
                  @endforeach
                </select>

              </div>
              <div class="form-group col-md-12">
              <label>Status</label>
              <select class="form-control" name="status" id="status" required="required">
                <option value="all">All</option>
                <option value="1">Inprocess</option>
                <option value="3">Rejected</option>
                <option value="4">Not Interested</option>
              <option value="5">Call Back</option>
           <option value="6">Interested in Webinar</option>
                <option value="7">Meeting Done</option>
                <option value="8">Invoice Sent</option>
                <option value="9">Spam</option>
                <option value="10">NSNC</option>
                <option value="11">Duplicate</option>
                <option value="12">Details Sent on WhatsApp</option>
                <option value="13">Details Send on Email</option>
                <option value="14">Interested in Property</option>
                <option value="15">Follow Up</option>

              </select>

            </div>

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
                  <br>
                  <label>Most Recent:</label><br>
                  <label for="male">Leads</label>
                  <label for="recentLead"></label><input type="radio" id="recentLead" name="recent" value="recentLead" checked>

                  <label for="male">Status</label>
                  <label for="recentStatus"></label><input type="radio" id="recentStatus" name="recent" value="recentStatus">
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
@endcan
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Leads</h3>
              @can('create-lead')
              <span class="pull-right">
              <a href="{!! url('/leads/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Lead</a>
              </span>
              @endcan

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($leads) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Lead No.</th>
                  <th>Created By</th>
                  <th>Assigned To</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Customer Name</th>
                  <!--<th>Email</th>
                  <th>Phone Number</th>-->
                  <!-- <th>Business Name</th>
                  <th>Business Nature</th> -->
                  <th>Status</th>
                  <th>Country</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leads as $lead)
                  <tr>
                    <td>
                      @can('show-lead')
                        <a href="{!! url('/leads/'.$lead['id'] ); !!}">{{$lead['id']}}</a>
                      @else
                        {{$lead['id']}}
                      @endcan
                    </td>
                    <td>{{$lead->createdby->fname }} {{ $lead->createdby->lname }}</td>
                    <td>{{isset($lead->assignedTo) ? $lead->assignedTo->fname.' '.$lead->assignedTo->lname : "NA" }}</td>
                    <td>{{$lead->created_at->format('d-m-Y')}}</td>
                    <td>{{$lead->updated_at->diffForhumans()}}</td>
                    <td>{{$lead->user->fname }} {{ $lead->user->lname }}</td>
                    <!--<td>{  {$lead->user->email}  }</td>
                    <td>{  {$lead->user->phonenumber}  }</td>-->
                    <!-- <td>{{$lead['businessName']}}</td> -->
                    <!-- <td>{{$lead['businessNature']}}</td> -->
                    <td>
                      @switch($lead->status)
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
                        <span class="text-green"><b>Interested in Webinar</b></span>
                        @break
                        @case(7)
                        <span class="text-green"><b>Meeting Done</b></span>
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
                        <span class="text-info"><b>Duplicate</b></span>
                        @break
                        @case(12)
                        <span class="text-info"><b>Details Sent on WhatsApp</b></span>
                        @break
                        @case(13)
                        <span class="text-info"><b>Details Send on Email</b></span>
                        @break
                            @case(14)
                                <span class="text-green"><b>Interested in Property</b></span>
                                @break
                                @case(15)
                                <span class="text-green"><b>Follow Up</b></span>
                                @break
                        @default
                        <span class="text-green"><b>New</b></span>
                      @endswitch
                    </td>
                      <td>{{$lead->ccountry}}</td>
                    @can('delete-lead')
                     <!-- For Delete Form begin -->
                    <form id="form{{$lead['id']}}" action="{{action('LeadController@destroy', $lead['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    @endcan
                    <td>
                      @can('show-lead')
                        <a href="{!! url('/leads/'.$lead['id'] ); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>
                      @endcan
                      @can('edit-lead')
                        <a href="{!! url('/leads/'.$lead['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
                      @endcan
                      @can('status-lead')
                        @if ($lead['status'] === 1)
                          <a href="{!! url('/leads/deactivate/'.$lead['id']); !!}"  class="btn btn-warning" title="Deactivate"><i class="fa fa-times"></i> </a>
                        @else
                          <a href="{!! url('/leads/active/'.$lead['id']); !!}"  class="btn btn-info" title="Active"><i class="fa fa-check"></i> </a>
                        @endif
                      @endcan
                      @can('delete-lead')
                        <button class="btn btn-danger" onclick="archiveFunction('form{{$lead['id']}}')"><i class="fa fa-trash"></i></button>
                      @endcan
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Lead No.</th>
                    <th>Created By</th>
                    <th>Assigned To</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Customer Name</th>
                    <!--<th>Email</th>
                    <th>Phone Number</th>-->
                    <!-- <th>Business Name</th> -->
                    <!-- <th>Business Nature</th> -->
                    <th>Status</th>
                    <th>Country</th>
                    <th>Action</th>
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