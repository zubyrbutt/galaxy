<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Galaxy Realtors | Feedback form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="{{ asset('img/favicon.png')}}" type="image/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
{{--    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">--}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <style>
        .wrapper {
            padding: 4em;
            padding-bottom: 0;
        }

        .currency-selector {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            padding-left: .5rem;
            border: 0;
            background: transparent;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

            background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='1024' height='640'><path d='M1017 68L541 626q-11 12-26 12t-26-12L13 68Q-3 49 6 24.5T39 0h952q24 0 33 24.5t-7 43.5z'></path></svg>") 90%/12px 6px no-repeat;

            font-family: inherit;
            color: inherit;
        }

        .currency-amount {
            text-align: left;
        }

        .currency-addon {
            width: 6em;
            text-align: left;
            position: relative;
        }
    </style>
</head>
<body style="background-color: #ECF0F5">

    <div class="container mt-3 mb-5" >

<div class="jumbotron" style="background-color: #fff">


    {{--    @if ($errors->any())--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--            <div>{{$error}}</div>--}}
{{--        @endforeach--}}
{{--    @endif--}}
    <hr>
    <img src="{{asset('img/expo2020.jpg')}}" class="img-fluid" style="width: 100%"><hr>
    <h2 class="text-center">Galaxy Realtors Expo <b>2020</b> Feedback  Form</h2>
    <form action="{{url('expo_store')}}" method="post">
        @csrf
        <input type="hidden" id="event" name="event" value="1">
        <div class="form-group">
            <i class="fa fa-user"></i>    <label for="name"> Full Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your full name" name="name">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <i class="fa fa-at"></i> <label for="email">  Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email')  }}</span>
            @endif
        </div>
        <div class="form-group">
            <i class="fa fa-phone"></i> <label for="pwd"> Phone/Mobile:</label>
            <input type="text" class="form-control" id="phone" placeholder="Enter phone/mobile" name="phone">
            @if($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone')  }}</span>
            @endif
        </div>
        <div class="form-group">
            <i class="fa fa-whatsapp"></i> <label for="pwd">  WhatsApp:</label>
            <input type="text" class="form-control" id="whatsapp" placeholder="Enter whatsApp number" name="whatsapp">
            @if($errors->has('whatsapp'))
                <span class="text-danger">{{ $errors->first('whatsapp')  }}</span>
            @endif
        </div>


        <div class="">
            <strong>Out of presented projects, which one do you like most?</strong><br>
            <select title="Please Select" id="multiple-checkboxes" name="projects[]" class="selectpicker" multiple>

                <option value="capital smart city">Capital Smart City</option>
                <option value="Royal Castle">Royal Castle</option>
                <option value="5g emporium">5g Emporium</option>
                <option value="Sparco Twin Tower">Sparco Twin Tower</option>
                <option value="Pearl Mall">Pearl Mall</option>
                <option value="any other">Any Other</option>

            </select>
            @if($errors->has('projects'))
                <span class="text-danger">{{ $errors->first('projects')  }}</span>
            @endif
        </div>

        <div class="">
            <strong>Interested In?</strong><br>
            <select title="Please Select" name="interested[]" id="multiple-checkboxes" class="selectpicker" multiple>
                <option value="commercial">Commercial</option>
                <option value="residential">Residential</option>

            </select>
            @if($errors->has('interested'))
                <span class="text-danger">{{ $errors->first('interested')  }}</span>
            @endif
        </div>
        <strong>How much do you want to invest?</strong><br>
        <div class="" style="width: 300px">


            <label class="sr-only" for="inlineFormInputGroup">Amount</label>
            <div class="input-group">
                <div class="input-group-addon currency-symbol">$</div>
                <input type="text" class="form-control currency-amount" name="amount" id="inlineFormInputGroup"
                       placeholder="0.00" size="8">
                <div class="input-group-addon currency-addon">

                    <select class="currency-selector" name="symbol">
                        <option data-symbol="PKR" data-placeholder="0.0" selected>PKR</option>
                        <option data-symbol="£" data-placeholder="0.00">GBP</option>
                        <option data-symbol="$" data-placeholder="0">US</option>
                        <option data-symbol="$" data-placeholder="0.00">AUD</option>
                    </select>

                </div>
                </label>

            </div>

        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control animated" cols="50" id="new-review" name="comment"
                      placeholder="Enter your review here..." rows="5"></textarea>
        </div>

        <div class="text-right">

            <strong>Please give us a rating</strong>
            <div class="form-group" id="rating-ability-wrapper">

                <label class="control-label" for="rating">
                    <span class="field-label-info"></span>
                    <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">

                    <button type="button" class="btnrating btn btn-default btn-sm" data-attr="1" id="rating-star-1">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default btn-sm" data-attr="2" id="rating-star-2">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default btn-sm" data-attr="3" id="rating-star-3">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default btn-sm" data-attr="4" id="rating-star-4">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btnrating btn btn-default btn-sm" data-attr="5" id="rating-star-5">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </button>
                    <h4 class="bold rating-header" style="">
                        <span class="selected-rating">0</span><small> / 5</small>
                    </h4>
                    @if($errors->has('selected_rating'))
                        <span class="text-danger">{{ $errors->first('selected_rating')  }}</span>
                    @endif
                </label>
            </div>
            <button type="submit" class="btn btn-success mb-5">Submit</button>

        </div>
    </form>
</div>
    </div>
<script>
    function updateSymbol(e) {
        var selected = $(".currency-selector option:selected");
        $(".currency-symbol").text(selected.data("symbol"))
        $(".currency-amount").prop("placeholder", selected.data("placeholder"))
        $('.currency-addon-fixed').text(selected.text())
    }

    $(".currency-selector").on("change", updateSymbol)

    updateSymbol()
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
</body>
<script>
    jQuery(document).ready(function ($) {

        $(".btnrating").on('click', (function (e) {

            var previous_value = $("#selected_rating").val();

            var selected_value = $(this).attr("data-attr");
            $("#selected_rating").val(selected_value);

            $(".selected-rating").empty();
            $(".selected-rating").html(selected_value);

            for (i = 1; i <= selected_value; ++i) {
                $("#rating-star-" + i).toggleClass('btn-success');
                $("#rating-star-" + i).toggleClass('btn-default');
            }

            for (ix = 1; ix <= previous_value; ++ix) {
                $("#rating-star-" + ix).toggleClass('btn-success');
                $("#rating-star-" + ix).toggleClass('btn-default');
            }

        }));

    });
</script>

</html>
