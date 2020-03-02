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
    @can('search-feedback')
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" action="{!! url('search/feedback') !!}" method="post" enctype="multipart/form-data">
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
                    <h3 class="box-title">Expo 2020 Feedback</h3>

                    <span class="pull-right">
              <a href="{!! url('/expo2020'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Expo Form</a>
              </span>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($expos)>0)
                        <table id="example1" class="display responsive nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Whatsapp</th>
                                <th>Projects</th>
                                <th>Interested</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Created_at</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($expos as $expo)
                                <tr>
                                    <td>{{$expo->id}}</td>

                                    {{--                                    <td>{{$callback->appointtime->format('d-M-Y h:i:s')}}</td>--}}
                                    <td>{{ $expo->name}}</td>
                                    <td>{{ $expo->email }}</td>
                                    <td>{{$expo->phone}}</td>
                                    <td>{{$expo->whatsapp}}</td>
                                    <td>{{$expo->projects}}</td>
                                    <td>{{$expo->interested}}</td>
                                    <td>{{$expo->symbol}}</td>
                                    <td>{{$expo->amount}}</td>
                                    <td>{{$expo->comment}}</td>
                                    <td>{{$expo->rating}}</td>
                                    <td>{{$expo->created_at->diffForHumans()}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Whatsapp</th>
                                <th>Projects</th>
                                <th>Interested</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Created_at</th>

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