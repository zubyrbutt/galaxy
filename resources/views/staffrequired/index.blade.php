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
         body {
            padding-right: 0px !important;
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Department</label>
                                        <select name="filter_department_id" id="filter_department_id" class="form-control select2">
                                            <option value="">Choose Option</option>
                                            @foreach($departments as $row)
                                                <option value="{{$row->id}}">{{$row->deptname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-md-4">
                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select class="form-control" name="status" >
                                            <option value="">Select</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Fullfilled">Fullfilled</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Pending">Pending</option>
                                            {{--<option value="Completed">Completed</option>--}}
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
                    <h3 class="box-title">Staff Required</h3>
                    <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add Requirenment</a>
                
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

                        <table id="table_data" class="display nowrap responsive" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Salary Range</th>
                            <th>No. of Staff</th>
                            <th>Staff Sent</th>
                            <th>Staff Joined</th>
                            <th>Requested By</th>
                            <th>Required Date</th>
                            <th>Created At</th>
                            <th class="sorting_asc">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Salary Range</th>
                            <th>No. of Staff</th>
                            <th>Staff Sent</th>
                            <th>Staff Joined</th>
                            <th>Requested By</th>
                            <th>Required Date</th>
                            <th>Created At</th>
                            <th>Status</th>
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
                    <h4 class="modal-title">Staff Requirement Form </h4>
                </div>
                <div class="modal-body">

                    <form action="{{route('staffrequired.store')}}" class="form" id="add_form" method="POST">
                        @csrf
                        <div class="modal-body" id="modalbody">

                            <div class="form-group">
                                <label>Department</label>
                                <select name="department_id" id="edit_department_id" class="form-control select2">
                                    <option value="">Choose Option</option>
                                    @foreach($departments as $row)
                                        <option value="{{$row->id}}">{{$row->deptname}}</option>
                                    @endforeach
                                </select>
                                <span class="text-red">
                        <strong class="department_id"></strong>
                      </span>
                            </div>

                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" id="edit_position" name="position"
                                       placeholder="Position" autocomplete="off" require>
                                <span class="text-red">
                        <strong class="position"></strong>
                      </span>
                            </div>

                            <div class="form-group">
                                <label>Salary From</label>
                                <input type="number" class="form-control" id="edit_salary_from" name="salary_from"
                                       placeholder="Salary From" autocomplete="off" require>
                                <span class="text-red">
                        <strong class="salary_from"></strong>
                      </span>
                            </div>
                            <div class="form-group">
                                <label>Salary To</label>
                                <input type="number" class="form-control" id="edit_salary_to" name="salary_to"
                                       placeholder="Salary To" autocomplete="off" require>
                                <span class="text-red">
                        <strong class="salary_to"></strong>
                      </span>
                            </div>
                            <div class="form-group">
                                <label>Number of Staff</label>
                                <input type="text" class="form-control" id="edit_number_of_staff" name="number_of_staff"
                                       placeholder="Number of Staff" autocomplete="off" require>
                                <span class="text-red">
                        <strong class="number_of_staff"></strong>
                      </span>
                            </div>

                            <div class="form-group">
                                <label>Required Date</label>
                                <input type="date" class="form-control" id="edit_required_date" name="required_date"
                                       placeholder="Required Date" autocomplete="off" require>
                                <span class="text-red">
                                <strong class="required_date"></strong>
                      </span>
                            </div>
                            <div class="form-group">
                                <label>Job Description</label>
                                <textarea class="form-control" rows="3" id="edit_job_desc" name="job_desc"></textarea>
                                <span class="text-red">
                                <strong class="job_desc"></strong>
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
    <!-- Update Status to Completed modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="changeStatusToCompleted">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Mark As Completed</h4>
                </div>

                <form role="form" id="markascompletedform">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Staff Joined</label>
                            <input type="number" class="form-control" id="staff_joined" name="staff_joined" placeholder="Number Of Staff Joined" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="description">Remarks</label>
                            <textarea type="text" class="form-control" rows="5" name="remarks" placeholder="Enter Your Remarks" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Mark As Completed</label>
                            <input type="checkbox" name="markascompleted" id="markascompleted">
                        </div>
                        <input type="hidden" value="" id="complete_sr_id" name="complete_sr_id">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="viewjobdetail" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-aqua-active" style="height: unset;">
                            <h3 class="widget-user-username" id="job_position"></h3>
                            <h5 class="widget-user-desc" id="job_department"></h5>
                            <h5 class="widget-user-desc" id="staff_required_date"></h5>
                            <h5 class="widget-user-desc" id="no_of_staff"></h5>
                            <h5 class="widget-user-desc" id="job_salaryrang"></h5>
                            <h5 class="widget-user-desc" id="job_createdby"></h5>
                            <h5 class="widget-user-desc" id="job_created_at"></h5>
                        </div>

                        <div class="box-footer" style="padding-top: 0px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="">
                                        <h5 class="description-header" id="request_status"></h5>
                                        <span class="description-text" id="staff_description"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary ">
                        <div class="box-header">
                            <h3 class="box-title">New Status</h3>
                        </div>
                        <div class="errormessages text-danger"></div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="staffrequiredStatusForm" method="POST"
                              action="{{route('staffrequired.changestatus')}}">
                            @csrf
                            <input type="hidden" value="" name="staffrequired_id" id="staffrequired_id">
                            <input type="hidden" value="" name="rePosition" id="rePosition">
                            <div class="box-body">
                                <div class="form-group col-md-4">
                                    <label>Select status</label>
                                    <select class="form-control" name="status" id="newstatus" required >
                                        <option value="">Select</option>
                                        <option value="Fullfilled">Fullfilled</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Rejected">Rejected</option>
                                        {{--<option value="Completed">Completed</option>--}}
                                    </select>
                                </div>
                                <div class="form-group col-md-2 numberofemployee" style="display: none;">
                                    <label>Number</label>
                                    <input type="text" class="form-control" id="employeesent" name="employeesent"
                                           placeholder="No" required autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" id="remarks" name="remarks"
                                           placeholder="Enter Remakrs" required autocomplete="off">
                                </div>

                               <div class="box-footer">
                                   <button data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing..." type="submit" id="btnstaffrequiredstatus" class="btn btn-primary pull-right">
                                       Submit
                                   </button>
                               </div>


                            </div>
                            <!-- /.box-body -->
                        </form>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Updated By</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody class="status_content_here">

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <!--Update Modal end-->
        <!-- /.row -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
        <script src="{{asset('bower_components\bootstrap-datepicker\js\bootstrap-datepicker.js')}}"></script>
        <script src="{{ asset('erp/app_k.js')}}" type="text/javascript"></script>
        <script type="text/javascript">

            var filterdata;
            var dataTableRoute = "{{ route('staffrequired.fetch') }}";
            var editRoute = "{{route('staffrequired.edit')}}";
            var activeRoute = "{{route('staffrequired.active')}}";
            var disableRoute = "{{route('staffrequired.disable')}}";
            var deleteRoute = "{{route('staffrequired.delete')}}";
            var viewdetailroute = "{{route('staffrequired.viewdetail')}}";
            var token = '{{csrf_token()}}';
            var data = [
                {"data": "id"},
                {"data": "position"},
                {"data": "department",'name':'department.deptname'},
                {"data": "salary_range"},
                {"data": "number_of_staff"},
                {"data": "employeesent"},
                {"data": "employeejoined"},
                {"data": "requestedby",'name':'user.fname'},
                {"data": "created_at"},
                {"data": "required_date"},
                {"data": "status"},
                {"data": "options", "orderable": false},
            ]

            // var data = [
            //     {"data": "id",'name':'id'},
            //     {"data": "position",'name':'position'},
            //     {"data": "detp",'name':'detp'},
            //     {"data": "salary_range",'name':'salary_range'},
            //     {"data": "number_of_staff",'name':'number_of_staff'},
            //     {"data": "employeesent",'name':'employeesent'},
            //     {"data": "employeejoined",'name':'employeejoined'},
            //     {"data": "requestedby",'name':'requestedby'},
            //     {"data": "created_at",'name':'created_at'},
            //     {"data": "required_date",'name':'required_date'},
            //     {"data": "status",'name':'status'},
            //     {"data": "options", "orderable": false},
            // ]
            $(document).ready(function () {
                //$('body').addClass('sidebar-collapse');
                InitTable();
                //initialize datatable
                $('#daterange-btn').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'Last 60 Days': [moment().subtract(59, 'days'), moment()],
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

            $('#newstatus').bind('change',function () {
               var status = $(this).val();
               if(status=='Fullfilled'){
                   $('.numberofemployee').show();
               }else{
                   $('.numberofemployee').hide();
               }
            });

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true
            });

            $(document).on('submit','#filterform',function(e){
                e.preventDefault();
                filterdata = $('#filterform').serializeArray();
                InitTable();
            });

        </script>

@endsection