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

    <!-- Table start -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ycc Support</h3>
                    {{-- <span class="text-right"> --}}
                        <form method="POST" action="{{ route('getnewsupportemails') }}">
                         @csrf
                        
                        <button type="submit" class="btn bg-orange pull-right" id="fetchnewsupports">Fetch New</button>   
                        </form>
                        <a style="margin-right: 5px;" href="#" class="btn btn-info addModelbtn pull-right" id="#addModel"><span class="fa fa-plus"></span> Add </a>
                    {{-- </span> --}}
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
                            <th>From</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>From</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Source</th>
                            <th>Status</th>
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
        <!-- /.col -->
    </div>
    <!-- Table end -->

    <!--Modal -->
    <div class="modal fade" id="addModel" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">YCC Support</h4>
                </div>
                <div class="modal-body">

                    <form action="{{route('yccsupport.store')}}" class="form" id="add_form" method="POST">
                        @csrf
                        <div class="modal-body" id="modalbody">

                            <div class="form-group">
                                <label>From</label>
                                <input type="text" class="form-control" id="edit_from" name="from"
                                       placeholder="From" autocomplete="off" require>
                                <span class="text-red">
                                    <strong class="from"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email"
                                       placeholder="Email" autocomplete="off" require>
                                <span class="text-red">
                                    <strong class="email"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input class="form-control" type="text" id="edit_subject" placeholder="Subject"
                                       name="subject">
                                <span class="text-red">
                                    <strong class="subject"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea id="edit_body" name="body" require class="form-control"
                                          placeholder="Body"></textarea>
                                <span class="text-red">
                                    <strong class="body"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Attachments</label>
                                <input type="file" multiple class="form-control" name="attachments[]">
                                <span class="text-red">
                                    <strong class="attachments"></strong>
                                </span>
                            </div>
                            <input type="hidden" name="edit_id" id="edit_id" value="">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Update Modal end-->
    <!-- /.row -->


    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <script src="{{asset('bower_components\bootstrap-datepicker\js\bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('erp/app_support.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var filterdata;

        var dataTableRoute = "{{ route('yccsupport.fetch') }}";
        var editRoute = "{{route('yccsupport.edit')}}";
        var activeRoute = "{{route('yccsupport.active')}}";
        var disableRoute = "{{route('yccsupport.disable')}}";
        var deleteRoute = "{{route('yccsupport.delete')}}";
        var token = '{{csrf_token()}}';
        var data = [
            {"data": "id"},
            {"data": "from"},
            {"data": "email"},
            {"data": "subject"},
            {"data": "supportfrom"},
            {"data": "status"},
            {"data": "created_at"},
            {"data": "options", "orderable": false},
        ];
        $(document).ready(function () {
            InitTable();
        });
        $(document).on('submit', '#filterform', function (e) {
            e.preventDefault();
            filterdata = $('#filterform').serializeArray();
            InitTable();
        });
    </script>

@endsection