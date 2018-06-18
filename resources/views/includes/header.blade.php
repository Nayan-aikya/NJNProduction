<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<div class="outer">
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
      <a class="navbar-brand"><img src="{{asset('img/logo.png')}}" alt="Logo goes Here"></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Contact us @ 1234567890</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">English
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">English</a></li>
          <li><a href="#">Kannada</a></li>
        </ul>
      </li>
      @if(Auth::check())
      <li><a  href="{{ URL::to('logout') }}" data-target="#login-modal" id="loginlogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      @endif
    </ul>
  </div>
</nav>
<nav class="navbar navbar-default header">
  <div class="container-fluid">
    <!-- <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div> -->
    <ul class="nav navbar-nav navbar-center">
        <?php $url="/"; ?>
        @if(Auth::check())
            @if(Auth::user()->user_id == 1)
                <?php $url = "dashboard"; ?>
            @endif
            @if(Auth::user()->user_id == 2)
                <?php $url = "tcdashboard"; ?>
            @endif
        @endif
      <li><a href="">HOME</a></li>
      <li><a href="#">ABOUT US</a></li>
      <li><a href="#">POLICIES</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SCHEMES<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{url('weavers/powersubsidy-list')}}">Power subsidy applications</a></li>
          <li><a href="{{url('weavers/ej-2loom-list')}}">TL/EJ applications</a></li>
          <li><a href="{{url('weavers/invest-list')}}">Investments</a></li>
        </ul>
      </li>
      <li><a href="#">NOTIFICATION</a></li>
      <li><a href="#">CIRCULAR</a></li>
      <li><a href="#">ACTS</a></li>
      <li><a href="#">CITIZENS</a></li>
      <li><a href="#">GALLERY</a></li>
      <li><a href="#">CONTACT US</a></li>
    </ul>
  </div>
</nav>
</div>
