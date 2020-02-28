<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style>
        .thanks {
            font-family: Anton, serif;
            font-size: 8em;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center mt-5">  <img src="{{asset('./img/grlogo.png')}}" class="img-fluid mb-5 mt-5"   alt="logo" width="225" height="225"/><br></div>
    <div class="jumbotron text-center mt-5">

        <img class="text-center"
        src="{{asset('./img/svg/check.svg')}}"
        alt="triangle with all three sides equal"
        height="87"
        width="100"/><br>
        <small>submit successfully..</small>
        <h1 class="text-center thanks">THANKS</h1>
        <p>for your feedback. Your input will be taken into consideration.</p>
    </div>

    <div class="jumbotron text-center mt-5" style="background-color: #fff;">


        <a href="http://galaxyrealtors.pk/" class="btn btn-success btn-sm" >
            Back To Website
        </a>
        <p>www.galaxyrealtors.pk</p>

    </div>

</div>


</body>
</html>
