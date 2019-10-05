<?php
$user = Auth::user();
?>
 <!-- Main Header -->
 <header class="main-header">
<!-- Logo -->
<a href="{!! url('/home'); !!}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>BKSOL</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>BKSOL ERP</b></span>
</a>


{{-- birthday code Style and Condition --}}
{{-- @if( $bduser->staffdetails->dob->format('m-d') === date('m-d'))
<style>
  canvas{display:block}
  .birthdayHeading{
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  font-family: "Source Sans Pro";
  font-size: 5em;
  font-weight: 900;
  text-align: center;
  -webkit-user-select: none;
  user-select: none;
  }
  .birthdayHeadingBtn{
  position: absolute;
  top: 60%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  font-family: "Source Sans Pro";
  font-size: 5em;
  font-weight: 900;
  -webkit-user-select: none;
  user-select: none;
  }
  
</style>

<div style="position: fixed; opacity: 0.7;" id="canvasHBD">
  <button class="btn btn-primary birthdayHeadingBtn" onclick="hideHBD()">Thank You</button>
<h1 class="birthdayHeading">
  Happy Birth Day {{$bduser->fname}}</h1>
 <canvas id="birthday" id=""></canvas>
</div>
  <script>
    function hideHBD(){
      localStorage.setItem("wish", "1");
      
      document.getElementById('canvasHBD').style.display = 'none';

       }
  </script>
  <script>
      var wished = localStorage.getItem('wish');
      if( wished == '1'){
        document.getElementById('canvasHBD').style.display = 'none';
      } 
    </script>
@else
<script>
localStorage.setItem("wish", "0");
</script>
@endif
 --}}
{{-- end of birthday code --}}

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      <!-- Notifications Menu -->
      <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">{{Auth::user()->unreadNotifications->count()}}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have {{Auth::user()->unreadNotifications->count()}}  unread notification(s)</li>
          <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
              @foreach(Auth::user()->unreadNotifications as $notification)
              <li><!-- start notification -->
                <a href="{{$notification->data['letter']['redirectURL']}}" title="{{$notification->data['letter']['title']}}" data-notif-id="{{$notification->id}}">
                  <i class="fa fa-users text-aqua"></i> {{$notification->data['letter']['title']}}
                </a>
              </li>
              <!-- end notification -->
              @endforeach
            </ul>
          </li>
          @if(Auth::user()->unreadNotifications->count() > 0)
          <li class="footer"><a href="#">View all</a></li>
          @endif
        </ul>
      </li>
      
      
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="{{ asset('img/staff/'.$user->avatar) }}" class="user-image" alt="User Image">
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{$user->fname}} {{$user->lname}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            <img src="{{ asset('img/staff/'.$user->avatar) }}" class="img-circle" alt="User Image">
            <p>
              {{$user->fname}} {{$user->lname}}
              <small>Member since {{$user->created_at->format('M, Y')}}</small>
              <small>Last login at {{auth()->user()->lastLoginAt() !="" ? auth()->user()->lastLoginAt()->diffForHumans() : "NA"}}</small>
              
            </p>
          </li>
          <li class="user-footer">
            <div>
              <a href="{!! url('/profile'); !!}" class="btn btn-primary btn-flat">Profile</a>
              <a href="{!! url('/changepassword'); !!}" class="btn btn-warning btn-flat">Change Password</a>
              <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
            
          </li>
        </ul>
      </li>
      
    </ul>
  </div>
</nav>
</header>