@extends('layouts.mainlayout')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });

        </script>
    @endif
    @can('search-leads')
        <div class="row">
            <div class="col-md-12">
                {{--                <form class="form-horizontal" action="{!! url('/leads/search'); !!}" method="post" enctype="multipart/form-data">--}}
                {{--                    @csrf--}}
                <div class="box box-success collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Advance Filter</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: none;">

                        <!--Search Form Begins -->
                        <div class="form-group col-md-12">

                            <label>Select Staff</label>
                            <select name="agentid" id="agentid" class="form-control select2 select2-hidden-accessible"
                                    multiple="" data-placeholder="Select a Satff" style="width: 100%;" tabindex="-1"
                                    aria-hidden="true">
                                @can('show-all-leads')
                                    <option value="all">All</option>@endcan
                                @foreach($agents as $agent)
                                    <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                                @endforeach
                            </select>

                            <label>Select Country</label>
                            <select name="countryId" id="countryId"
                                    class="form-control select2 select2-hidden-accessible" multiple=""
                                    data-placeholder="Select a Satff" style="width: 100%;" tabindex="-1"
                                    aria-hidden="true">
                                @can('show-all-leads')
                                    <option value="all">All</option>@endcan
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
                                <option value="16">Attendees</option>
                                <option value="17">Non-Attendees</option>
                                <option value="18">Towards Closing</option>
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
                            <label for="recentLead"></label><input type="radio" id="recentLead" name="recent"
                                                                   value="recentLead" checked>

                            <label for="male">Status</label>
                            <label for="recentStatus"></label><input type="radio" id="recentStatus" name="recent"
                                                                     value="recentStatus">
                        </div>

                        <script>

                            $(document).ready(function () {
                                $('.select2').select2({
                                    placeholder: "Select Staff",
                                    multiple: false,
                                });
                                //Date range as a button
                                $('#daterange-btn').daterangepicker(
                                    {
                                        ranges: {
                                            'Today': [moment(), moment()],
                                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                        },
                                        startDate: moment().subtract(29, 'days'),
                                        endDate: moment()
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
                        <button type="button" onclick='InitTable()' class="pull-right btn btn-primary"
                                id="searchRecords">Search
                            <i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- /.box -->
                {{--                </form>--}}
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
              <a href="{!! url('/leads/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span>Add Lead</a>
              </span>
                    @endcan

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($leads) > 0)
                        <table id="leadsTable" class="display responsive nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Created By</th>
                                <th>Assigned To</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Country</th>
                                @can('show-lead')
                                    <th>Action</th>
                                @endcan
                            </tr>
                            </thead>

                            <tfoot>

                            <tr>
                                <th>id</th>
                                <th>Created By</th>
                                <th>Assigned To</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Country</th>
                                @can('show-lead')
                                    <th>Action</th>
                                @endcan
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
    <!--Delete modal popup -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmation</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this Record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->

@endsection
