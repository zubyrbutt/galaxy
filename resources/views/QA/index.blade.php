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
<style>
    body{
        padding-right: 0px !important;
    }
    .ratings {
        position: relative;
        vertical-align: middle;
        display: inline-block;
        color: #b1b1b1;
        overflow: hidden;
    }
    .full-stars {
        position: absolute;
        left: 0;
        top: 0;
        white-space: nowrap;
        overflow: hidden;
        color: #fde16d;
    }
    .empty-stars:before, .full-stars:before {
        content:"\2605\2605\2605\2605\2605";
        font-size: 14pt;
    }
    .empty-stars:before {
        -webkit-text-stroke: 1px #848484;
    }
    .full-stars:before {
        -webkit-text-stroke: 1px orange;
    }
    /* Webkit-text-stroke is not supported on firefox or IE */

    /* Firefox */
    @-moz-document url-prefix() {
        .full-stars {
            color: #ECBE24;
        }
    }

</style>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" id="filterform">

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
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Select Date Range:</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                            <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                                            <input type="hidden" name="dateFrom" id="dateFrom" value="">
                                            <input type="hidden" name="dateTo" id="dateTo" value="">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Staff</label>
                                        <select class="form-control select2" id="staff" name="staff_name" style="width: 100%;">
                                            <option value="">None</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}} ({{$user->designation->name}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <script>

                            $(document).ready(function() {

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
    <!-- Table start -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Quality Assurance</h3>
                    <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add </a>

              </span>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                        <button type="button" class="close"><span>×</span><span class="sr-only">Close</span></button>
                        <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                        <button type="button" class="close"><span>×</span><span class="sr-only">Close</span></button>
                        <p class="success"></p>
                    </div>

                    <table id="table_data" class="display responsive nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Report Date</th>
                            <th>Rating</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Report Date</th>
                            <th>Rating</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- Table end -->

    <!--Modal -->
    <div class="modal fade" id="addModel" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Quality Assurace</h4>
                </div>
                <div class="modal-body">

                    <form action="{{route('qualityassurance.store')}}" class="form" id="add_form" method="POST">
                        @csrf
                        <div class="modal-body" id="modalbody">
                            <div class="form-group">
                                <label for="edit_user_id">Select Staff</label>
                                <select class="form-control select2" id="edit_user_id" name="user_id" required
                                        style="width:100%;">
                                    <option value="" selected>None</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}} ({{$user->designation->name}})</option>
                                    @endforeach

                                </select>
                                <span class="text-red">
                                    <strong class="user_id"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="edit_title" name="title"
                                       placeholder="Title" autocomplete="off" require>
                                <span class="text-red">
                                    <strong class="title"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="edit_description" name="description" require class="form-control"
                                          placeholder="Description"></textarea>
                                <span class="text-red">
                                    <strong class="description"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Rating</label>
                                <div class="rate" style="color: orange;width: 100% !important;position: absolute;font-size: 35px;height: 100%;"></div>
                                <input type="hidden" id="userratings" value="" name="userratings">
                            </div>
                            <div class="form-group">
                                <label>Attachments</label>
                                <input type="file" multiple class="form-control" name="attachments[]">
                                <span class="text-red">
                                    <strong class="attachments"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Recording Link</label>
                                <input type="text" class="form-control" id="edit_asset_link" name="asset_link"
                                       placeholder="Link" autocomplete="off" require>
                                <span class="text-red">
                                    <strong class="asset_link"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" id="edit_qa_date" name="qa_date" placeholder="Date" autocomplete="off" required >
                                <span class="text-red">
                                    <strong class="qa_date"></strong>
                                </span>
                            </div>
                           <input type="hidden" name="edit_id" id="edit_id" value="">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!--Update Modal end-->
    <!-- /.row -->
    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .select2-container--classic .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 8px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #3c8dbc;
            border-radius: 4px;
        }

    </style>

    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <script src="{{asset('bower_components\bootstrap-datepicker\js\bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('erp/app_qa.js')}}" type="text/javascript"></script>
    <script src="{{ asset('erp/rater.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var filterdata;
        $(".rate").rate({
            max_value: 5,
            step_size: 0.5,
            initial_value: 0,
        });
        $(".rate").on("change", function (ev, data) {
            $('#userratings').val(data.to);
        });

        $('.select2').select2({
            theme: "classic"
        });
        var dataTableRoute = "{{ route('qualityassurance.fetch') }}";
        var editRoute = "{{route('qualityassurance.edit')}}";
        var activeRoute = "{{route('qualityassurance.active')}}";
        var disableRoute = "{{route('qualityassurance.disable')}}";
        var deleteRoute = "{{route('qualityassurance.delete')}}";
        var token = '{{csrf_token()}}';
        var data = [
            {"data": "id"},
            {"data": "title"},
            {"data": "user_name"},
            {"data": "report_date"},
            {"data": "ratingbar"},
            {"data": "created_at"},
            {"data": "created_by"},
            {"data": "options", "orderable": false},
        ]
        $(document).ready(function () {
            InitTable();
        });
        $(document).on('submit','#filterform',function(e){
            e.preventDefault();
            filterdata = $('#filterform').serializeArray();
            InitTable();
        });
    </script>

@endsection