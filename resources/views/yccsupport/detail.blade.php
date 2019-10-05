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
        .green {
            background-color: #6fb936;
        }

        .thumb {
            margin-bottom: 30px;
        }

        .page-top {
            margin-top: 85px;
        }


        img.zoom {
            width: 100%;
            border-radius: 5px;
            object-fit: cover;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
        }

        .fancybox-lock .fancybox-overlay {
            overflow: unset !important;
            overflow-y: unset !important;
        }

        .transition {
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }

        .modal-header {

            /*border-bottom: none;*/
        }

        .modal-title {
            color: #000;
        }

        /*.modal-footer {*/
            /*display: none;*/
        /*}*/

        .fancybox-skin {
            height: 100% !important;
            width: 50% !important;
            margin: 0 auto !important;
        }

        .fancybox {
            display: block !important;
        }

    </style>
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

    <!-- Table start -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ycc Support</h3>
                    <span class="pull-right">
                        {{--<form id="formsupportstatus">--}}
                            {{--@csrf--}}
                            {{--<input type="hidden" name="support_id" value="{{$data->id}}">--}}
                        {{--</form>--}}
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addModel">Assign</button>
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

                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>From</th>
                            <td>{{$data->from}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$data->email}}</td>
                        </tr>

                        <tr>
                            <th>Subject</th>
                            <td>{{$data->subject}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$data->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{!! $data->body !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="label label-success">{{$data->status}}</span></td>
                        </tr>
                        <tr>
                            <th>Source</th>
                            <td><span class="label label-primary">{{$data->supportfrom}}</span></td>
                        </tr>
                        <tr>
                            <th>Assigned To</th>
                            <td>{{$data->assigneduser->fname .' '. $data->assigneduser->lname}}</td>
                        </tr>
                        <tr>
                            <th>Assigned By</th>
                            <td>{{$data->assignedbyuser->fname .' '. $data->assignedbyuser->lname}}</td>
                        </tr>
                    </table>

                </div>
                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    @if($feedback)
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Feedback</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="">
            <table class="table">
                <tr>
                    <th>Feedback</th>
                    <td>{{ $feedback->feedback }}</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>
                        @if($feedback->rating=='satisfied')
                            <span class="label label-success">Satisfied</span>
                        @elseif($feedback->rating=='not_satisfied')
                            <span class="label label-warning">Not Satisfied</span>
                        @else
                            <span class="label label-danger">Poor Service</span>
                        @endif

                    </td>
                </tr>
            </table>
        </div>
    </div> 
    @endif



       <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Attachments</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            @if(count($data->attachments) > 0)
                <?php
                function _group_by($array, $key)
                {
                    $return = array();
                    foreach ($array as $val) {
                        $return[$val[$key]][] = $val;
                    }
                    return $return;
                }

                $newarray = _group_by($data->attachments, 'type');
                ?>
                @foreach($newarray as $assets)
                    <div class="clearfix"></div>
                    @foreach($assets as $asset)
                        @if($asset->type==1)
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a class="fancybox" rel="ligthbox">
                                    <img src="{{Storage::disk('local')->url('public/ycc_support/'.$asset->attachment)}}"
                                         style="" class="zoom " alt="">
                                </a>
                            </div>
                        @elseif($asset->type==2)
                            <audio controls>
                                <source src="{{Storage::disk('local')->url('public/ycc_support/'.$asset->attachment)}}"
                                        type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @else
                            <?php $filename = pathinfo(Storage::disk('local')->url('public/ycc_support/' . $asset->attachment)); ?>
                            <div class="mailbox-attachment-info" style="width: 25%;">
                                <p class="mailbox-attachment-name">{{$filename['extension']}}</p>
                                <span class="mailbox-attachment-size">
                                {{number_format((Storage::disk('local')->size('public/ycc_support/'.$asset->attachment)/1024),2)}} KBs
                                <a href="{{Storage::disk('local')->url('public/ycc_support/'.$asset->attachment)}}"
                                   target="_blank" class="btn btn-default btn-xs pull-right"><i
                                            class="fa fa-cloud-download"></i></a>
                            </span>
                            </div>
                        @endif
                    @endforeach
                @endforeach

            @else
                <p>No Attachments available</p>
            @endif
        </div>
        <!-- /.box-body -->
    </div>

    <div id="btnNew" style="cursor:pointer;z-index:100;" class="pull-right">
        @if($data->status!='closed')
        <span class="btn bg-orange btn-flat btn-lg margin" id="btnNewMessage" onclick="openNav()"><li class="fa fa-plus"></li> New Message</span>
        @endif
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div style="padding: 50px;">
            <!-- form start -->
            <form role="form" id="frmMessage" method="POST" action="{{route('yccsupportaddmessage')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="yccsupport_id" value="{{$data->id}}">
                <input type="hidden" name="yccsupport_subject" value="{{$data->subject}}">
                <input type="hidden" name="yccsupport_from" value="{{$data->from}}">
                <input type="hidden" name="yccsupport_email" value="{{$data->email}}">
                <div class="box-body">
                    <div class="form-group">
                        <textarea class="form-control" rows="12" name="message" id="message" placeholder="Enter your Message Here"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" id="attachments" name="attachments[]" class="btn btn-danger btn-lg" multiple>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="progress">Progress</option>
                            <option value="closed_request">Closed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">External</label>
                        <input type="checkbox" id="internalorexternal" name="internalorexternal" class="btn btn-danger btn-lg">
                    </div>
                    <div class="form-group">
                        <span id="errmessage"></span>
                        <button data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing..." class="btn btn-danger btn-lg pull-right btnMessage">Post Message</button>
                    </div>
                </div>
            </form>
            <!-- form ends -->
        </div>
    </div>

    {{--Assigned to someone Model Starts--}}

    <div class="modal fade assignetostaffmodel" id="addModel" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">YCC Support</h4>
                </div>
                    <form action="{{route('yccsupport.active')}}" class="form" id="assignedtoform" method="POST">
                        @csrf
                        <div class="modal-body" id="modalbody">
                            <input type="hidden" name="yccsupport_id" value="{{$data->id}}">
                            <div class="form-group">
                                <label>Select Staff</label>
                                <select class="form-control select2" id="staff" name="staff_name" style="width: 100%;">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}} ({{$user->designation->name}})</option>
                                    @endforeach
                                </select>
                                <span class="text-red">
                                    <strong class="staff_name"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="5" id="edit_assigned_message" name="assigned_message" require class="form-control"
                                          placeholder="Description"></textarea>
                                <span class="text-red">
                                    <strong class="assigned_message"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing..." type="submit" class="btn btn-primary" id="btn_assigned">Assign</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    {{--Assigned to someone Model Ends--}}


    <div class="row">
        <div class="col-md-12" id="message-data">
            <ul class="timeline" id="timelinemore">
            @include('yccsupport.presult')
            </ul>
        </div>
    </div>
    <div class="ajax-load text-center" style="display:none">
        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More </p>
    </div>
    <!-- Table end -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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
    <script>
        $('.select2').select2({
            theme: "classic"
        });
        function openNav() {
            document.getElementById("mySidenav").style.width = "70%";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
        $(document).ready(function () {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function () {
                $(this).addClass('transition');
            }, function () {
                $(this).removeClass('transition');
            });
            $('.btnMessage').on('click', function (event) {
                event.preventDefault();
                var button = $(this);
                button.button('loading');
                
                var data = $('#frmMessage')[0];
                var formData = new FormData(data);
                $.ajax({
                    data: formData,
                    type: $('#frmMessage').attr('method'),
                    url: $('#frmMessage').attr('action'),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.errors) {
                            $.each(response.errors, function (index, value) {
                                $("." + index).html(value[0]);
                                $("." + index).fadeIn('slow', function () {
                                    $("." + index).delay(3000).fadeOut();
                                });
                            });
                        } else {
                            swal("Success", response, "success");
                            $('#frmMessage')[0].reset();
                            button.button('reset');
                            location.reload();
                        }
                    }
                });
            });

            $('#btn_assigned').on('click', function (event) {
                // return;
                event.preventDefault();
                var button = $(this);
                button.button('loading');
                $.ajax({
                    data: $('#assignedtoform').serialize(),
                    type: 'POST',
                    url: "{{route('yccsupport.active')}}",
                    success: function (response) {
                        if (response.errors) {
                            $.each(response.errors, function (index, value) {
                                $('.assignetostaffmodel').find("." + index).html(value[0]);
                                $('.assignetostaffmodel').find("." + index).fadeIn('slow', function () {
                                    $('.assignetostaffmodel').find("." + index).delay(3000).fadeOut();
                                });
                            });
                        }
                        button.button('reset');
                        swal("Success", response, "success");
                        location.reload();
                     }
                });
            });

        });
        var pages = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                if(pages!=0){
                    pages++;
                    loadMoreData(pages);
                }
            }
        });
        function loadMoreData(page) {
            $.ajax(
                {
                  url: '?page=' + page,
                  type: "get",
                  beforeSend: function () {
                      $('.ajax-load').show();
                  }
                })
                .done(function (data) {
                    if (data.html == "") {
                        pages=0;
                        $('.ajax-load').html("No more messages found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#timelinemore").append(data.html);
                    // console.log(data.next_page);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }

    </script>
@endsection