@extends('layouts.mainlayout')
<style type="text/css">
    /*
  PEN BY: @AliRanjbar
  Site: www.aliranjbar.ir
  pen lang: html, css, js(jquery)
  */
    @import url('https://fonts.googleapis.com/css?family=Lobster');

    .chat-data-loading {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background: #222d3294;
        z-index: 99;
    }

    .chat-data-loading:after {
        content: "";
        width: 50px;
        height: 50px;
        position: absolute;
        top: -30px;
        right: 0;
        left: 0;
        bottom: 0;
        margin: auto;
        border: 6px solid #f2f2f2;
        border-top: 6px dotted #f2f2f2;
        border-bottom: 6px dotted #f2f2f2;
        border-radius: 50%;
        animation: loading 2s infinite;
    }

    .chat-data-loading:before {
        font-family: 'Lobster', cursive;
        font-size: 20px;
        letter-spacing: 1px;
        color: white;
        content: "Loading...";
        position: absolute;
        top: 57%;
        text-align: center;
        right: 0;
        left: 0;
        margin: auto;
    }

    @keyframes loading {
        0% {
            transform: rotate(0);
        }
        50% {
            transform: rotate(360deg);
        }
    }

    .inbox_people {
        background: #fff;
        float: left;
        overflow: hidden;
        width: 30%;
        border-right: 1px solid #ddd;
    }

    .inbox_msg {
        border: 1px solid #ddd;
        clear: both;
        overflow: hidden;
    }

    .top_spac {
        margin: 20px 0 0;
    }

    .recent_heading {
        float: left;
        width: 40%;
    }

    .srch_bar {
        display: inline-block;
        width: 100%;
    }

    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
        color: #0465ac;
        font-size: 16px;
        margin: auto;
        line-height: 29px;
    }

    .srch_bar input {
        outline: none;
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }

    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }

    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
        font-size: 15px;
        color: #464646;
        margin: 0 0 8px 0;
    }

    .chat_ib h5 span {
        font-size: 13px;
        float: right;
    }

    .chat_ib p {
        font-size: 12px;
        color: #989898;
        margin: auto;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat_img {
        float: left;
        width: 11%;
    }

    .chat_img img {
        width: 100%;
        border-radius: 50%;
    }

    .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
    }

    .chat_people {
        overflow: hidden;
        clear: both;
    }

    .chat_list {
        border-bottom: 1px solid #ddd;
        margin: 0;
        padding: 18px 16px 10px;
    }

    .chat_list:hover {
        cursor: pointer;
    }

    .inbox_chat {
        height: 550px;
        overflow-y: auto;
    }

    .active_chat {
        background: #e8f6ff;
    }

    .incoming_msg_img {
        display: inline-block;
        width: 6%;
    }

    .incoming_msg_img img {
        width: 100%;
    }

    .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
    }

    .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 0 15px 15px 15px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .received_withd_msg {
        width: 57%;
    }

    .mesgs {
        float: left;
        padding: 30px 15px 0 25px;
        width: 70%;
    }

    .sent_msg p {

        background: #0465ac;
        border-radius: 12px 15px 15px 0;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .outgoing_msg {
        overflow: hidden;
        margin: 26px 0 26px;
    }

    .sent_msg {
        padding-right: 10px;
        float: right;
        width: 46%;
    }

    .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
        outline: none;
    }

    .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
    }

    .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border: none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 15px;
        height: 33px;
        right: 0;
        top: 11px;
        width: 33px;
    }

    .messaging {
        padding: 0 0 50px 0;
    }

    .msg_history {
        height: 516px;
        overflow-y: auto;
    }

    .only_bigscreen {
        display: block;
    }

    .mobile_button {
        display: none
    }

    .second h3 {
        width: 70%;
    }

    /* .inbox_people {
      width: 20%;
    } */
    .show_on_mobile_only {
        display: none;
    }

    @media only screen and (max-width: 768px) {

        .only_bigscreen {
            display: none;
        }

        .chat_ib h5 {
            text-align: center;
            margin-top: 10px;
        }

        .mobile_button {
            display: block
        }

        .show_on_mobile_only {
            display: none;
        }
    }

    @media only screen and (max-width: 450px) {
        .chat_img {
            width: 23%;
        }

        .chat_ib {
            width: 70%;
        }

        .inbox_people {
            display: none;
        }

        .only_bigscreen {
            display: none;
        }

        .mobile_button {
            display: block
        }

        .mesgs {
            width: 100%;
        }

        .inbox_people {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            z-index: 1030;
            left: 0;
            background-color: #f9f9f9;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .inbox_people .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .show_on_mobile_only {
            display: block;
        }

        .second h3 {
            font-size: 14px;
        }

        .received_withd_msg {
            width: 100%;
        }

        .sent_msg {
            width: 100%;
        }

        .sent_msg p {
            padding: 5px 10px 5px 12px;
        }

        /*
        PEN BY: @AliRanjbar
        Site: www.aliranjbar.ir
        pen lang: html, css, js(jquery)
        */
        @import url('https://fonts.googleapis.com/css?family=Lobster');

    }

    body {
        padding-right: 0px !important;
    }
</style>

@section('content')
    <div class="chat-data-loading"></div>
    <div id="app">

        <div class="box">

            <?php
            $create_Group = 0;
            $addNewUserPermission = 0;
            ?>
            @can('create-chat-groups')
                <?php $create_Group = 1; ?>
            @endcan

            @can('chat-add-new-chat-single')
                <?php $addNewUserPermission = 1; ?>
            @endcan

            <div class="box-body">

                <chat-component
                        :user="{{ auth()->user() }}"
                        :rooms="{{ $rooms }}"
                        :group_permission="{{$create_Group}}"
                        :adduserpermission="{{$addNewUserPermission}}">
                </chat-component>

            </div>

        </div>

    </div>
@endsection