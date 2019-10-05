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

            border-bottom: none;
        }

        .modal-title {
            color: #000;
        }

        .modal-footer {
            display: none;
        }

        .fancybox-skin {
            height: 100% !important;
            width: 50% !important;
            margin: 0 auto !important;
        }

        .fancybox {
            display: block !important;
        }

    </style>
    <!-- Table start -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Quality Assurance</h3>
                    <span class="pull-right">
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
                            <th>User</th>
                            <td>{{$qa_data->user->fname .' '. $qa_data->user->lname}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$qa_data->title}}</td>
                        </tr>

                        <tr>
                            <th>Created By</th>
                            <td>{{$qa_data->created_by->fname .' '. $qa_data->created_by->lname}}</td>
                        </tr>
                        <tr>
                            <th>Recording Link</th>
                            <td><a href="{{$qa_data->asset_link}}"></a>{{$qa_data->asset_link}}</td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>
                                <div class="rate"
                                     style="width: 100% !important;
                                            position: absolute;
                                            font-size: 25px;
                                            height: 100%;
                                            color: orange"
                                     data-rate-value="{{$qa_data->userratings}}"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><a href="{{$qa_data->qa_date}}"></a>{{$qa_data->qa_date}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$qa_data->description}}</td>
                        </tr>
                    </table>

                </div>
                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Quality Assurance Assets</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            @if(count($qa_data->qa_attachments) > 0)
                <?php
                function _group_by($array, $key)
                {
                    $return = array();
                    foreach ($array as $val) {
                        $return[$val[$key]][] = $val;
                    }
                    return $return;
                }

                $newarray = _group_by($qa_data->qa_attachments, 'type');
                ?>
                @foreach($newarray as $assets)
                    <div class="clearfix"></div>
                    @foreach($assets as $asset)
                        @if($asset->type==1)
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a class="fancybox" rel="ligthbox">
                                    <img src="{{Storage::disk('local')->url('public/staff/'.$asset->attachment)}}"
                                         style="" class="zoom " alt="">
                                </a>
                            </div>
                        @elseif($asset->type==2)
                            <audio controls>
                                <source src="{{Storage::disk('local')->url('public/staff/'.$asset->attachment)}}"
                                        type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @else
                            <?php $filename = pathinfo(Storage::disk('local')->url('public/staff/' . $asset->attachment)); ?>
                            <div class="mailbox-attachment-info" style="width: 25%;">
                                <p class="mailbox-attachment-name">{{$filename['extension']}}</p>
                                <span class="mailbox-attachment-size">
                                {{number_format((Storage::disk('local')->size('public/staff/'.$asset->attachment)/1024),2)}} KBs
                                <a href="{{Storage::disk('local')->url('public/staff/'.$asset->attachment)}}"
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
    <!-- Table end -->
    <script src="{{ asset('erp/rater.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
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
        });
    </script>
    <script>
        $(".rate").rate({
            max_value: 5,
            step_size: 0.5,
            initial_value: 0,
            readonly: true,
        });
    </script>
@endsection