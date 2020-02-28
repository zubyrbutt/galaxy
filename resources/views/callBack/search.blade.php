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
                <form class="form-horizontal" action="{!! url('callbacksearch'); !!}" method="post" enctype="multipart/form-data">
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
                                <label>Select Agent</label>
                                <select name="agentid" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Satff" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    @can('show-all-leads')<option value="all">All</option>@endcan
                                    @foreach($agents as $agent)
                                        <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                                    @endforeach
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
                    <h3 class="box-title">Today Call Backs</h3>
                    @can('create-lead')
                        <span class="pull-right">
{{--              <a href="{!! url('/callbacks/'.$leads['id']); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Lead</a>--}}
              </span>
                    @endcan

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($callbacks) > 0)
                        <table id="example1" class="display responsive nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Lead No.</th>
                                <th>Call Back Date</th>
                                <th>Call Back Conversations</th>
                                <th>Note</th>
                                <th>Assigned To</th>
                                <th>Created By</th>
                                <!--<th>Email</th>
                                <th>Phone Number</th>-->
                                <!-- <th>Business Name</th>
                                <th>Business Nature</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($callbacks as $callback)
                                <tr>
                                    <td>
                                        @can('show-lead')
                                            <a href="{!! url('/leads/'.$callback->lead->id); !!}">{{$callback->lead->id}}</a>
                                        @else
                                            {{$callback['id']}}
                                        @endcan
                                    </td>


                                    <td>{{$callback->appointtime->format('d-M-Y h:i:s')}}</td>
                                    <td text="justify">{{ $callback->note}}</td>


                                    @if (count($callback->conversations) != 0)
                                        @foreach($callback->conversations as $conversation)
                                            <td>{{ $conversation->message }}</td>
                                        @endforeach
                                    @else
                                        <td><span class="badge badge-success">Not yet</span></td>
                                    @endif
                                    <td>
                                        @foreach($callback->users as $staff)
                                            {{ $loop->first ? '' : ' ' }}
                                            <span class="btn bg-blue btn-xs"><small>{{$staff->fname}} {{$staff->lname}}</small></span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($callback->createdby)
                                            {{$callback->createdby->fname}} {{$callback->createdby->lname}}
                                        @endif

                                    </td>
                                    <td><span class="text-green"><b>Call Back</b></span></td>
                                    @if(count($callback->conversations) == null )
                                        <td>
                                            <a href="{!! url('leads/callback_note/'.$callback->lead_id.'/'.$callback['id'].'' ); !!}"
                                               class="btn btn-primary" title="Create Note">
                                                <li class="fa fa-sticky-note"></li>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                        @endif

                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Lead No.</th>
                                <th>Call Back Date</th>
                                <th width="40%">Call Back Conversations</th>
                                <th>Note</th>
                                <th>Assigned To</th>
                                <th>Created By</th>
                                <!--<th>Email</th>
                                <th>Phone Number</th>-->
                                <!-- <th>Business Name</th>
                                <th>Business Nature</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <div>No Record found...</div>
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