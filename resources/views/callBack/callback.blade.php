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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Appointments</h3>
                    <span class="pull-right">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($callbacks) > 0)
                            <table id="example1" class="display responsive wrap" style="width:100%">
                                <thead>
                            <tr>
                                <th>Id</th>
                                <th>Appointment Time</th>
                                <th width="45%">Note</th>
                                <th>Business Name</th>
                                <th>Business Nature</th>
                                <th>Created By</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($callbacks as $appointment)

                                <tr>
                                    <td>{{$appointment['id']}}</td>
                                    <td>{{$appointment->appointtime->format('d-M-Y h:i:s') }}</td>
                                    <td>{{$appointment->note}}</td>
                                    <td><a href="{!! url('/leads/'.$appointment->lead_id ); !!}">{{$appointment->lead->businessName}}</a></td>
                                    <td>{{$appointment->lead->businessNature}}</td>
                                    <td>{{$appointment->createdby->fname }} {{ $appointment->createdby->lname }}</td>
                                    <td>
                                        @foreach($appointment->users as $staff)
                                            {{ $loop->first ? '' : ' ' }}
                                            <span class="btn bg-blue btn-xs"><small>{{$staff->fname}} {{$staff->lname}}</small></span>
                                        @endforeach
                                    </td>
                                <!-- For Delete Form begin
                    <form id="form{{$appointment['id']}}" action="{{action('AppointmentController@destroy', $appointment['id'])}}" method="post">
                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                    </form>
                                    For Delete Form Ends -->
                                    <td>
                                    <!--<a href="{!! url('/appointment/'.$appointment['id'] ); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>
                      <a href="{!! url('/appointment/'.$appointment['id'].'/recordingcreate'); !!}" target='_blank'  class="btn btn-warning" title="Recording link"><i class="fa fa-file-audio-o"></i> </a>
					            <button class="btn btn-danger" onclick="archiveFunction('form{{$appointment['id']}}')"><i class="fa fa-trash"></i></button>-->
                                        Action
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Appointment Time</th>
                                <th>Note</th>
                                <th>Business Name</th>
                                <th>Business Nature</th>
                                <th>Created By</th>
                                <th>Assigned To</th>
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