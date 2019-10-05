<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="user-id" content="{{ Auth::check() ? Auth::user()->id : ''}}">
  <title>{{ config('app.name', 'NSOL ERP') }}</title>
  <link rel="icon" href="{{ asset('img/favicon.png')}}" type="image/png">

  @include('customer-front-layouts.partials.headerscripts')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Include header bar -->
 @include('customer-front-layouts.partials.topnav')
<!-- Include left side bar -->
@include('customer-front-layouts.partials.leftnav')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<!-- Include content header -->
  @include('customer-front-layouts.partials.contentheader')

    <!-- Main content -->
    <section class="content container-fluid">    
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Include main footer -->
  @include('customer-front-layouts.partials.footer')

  <!-- Include Right sidebar for setting if required -->
  @include('customer-front-layouts.partials.rightsidebar')

</div>
<!-- ./wrapper -->

<!-- Include Footer scripts -->
@include('customer-front-layouts.partials.footerscripts')
@stack('scripts')

</body>
</html>