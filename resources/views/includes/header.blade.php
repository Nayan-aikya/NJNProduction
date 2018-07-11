<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<div class="outer">
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
      <a class="navbar-brand"><img src="{{asset('img/logo.png')}}" alt="Logo goes Here"></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      @if(Auth::check())
      <li><a href="#">Support Numbers: 9740139896, 9740137638 </a></li>
      @endif
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">English
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">English</a></li>
          <li><a href="#">Kannada</a></li>
        </ul>
      </li>
    
    <?php $show = "Welcome"; ?>
    @if(Auth::check())
    @if(Auth::user()->user_id == 1 && isset($ldistrict))
        <?php $show = $ldistrict; ?>
    @endif
    @if(Auth::user()->user_id == 2 && isset($ltcName))
        <?php $show = $ltcName; ?>
    @endif
    @if(Auth::user()->user_id == 4 && isset($ldivision))
        <?php $show = $ldivision; ?>
    @endif
    @if(Auth::user()->user_id == 6 )
        <?php $show = "Karnataka"; ?>
    @endif
    @endif
    @if(Auth::check())
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $show }}
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a  href="{{ URL::to('logout') }}" data-target="#login-modal" id="loginlogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </li>
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
        <?php $url=""; ?>
        @if(Auth::check())
            @if(Auth::user()->user_id == 1)
                <?php $url = "dashboard"; ?>
            @endif
            @if(Auth::user()->user_id == 2)
                <?php $url = "tcdashboard"; ?>
            @endif
            @if(Auth::user()->user_id == 4)
                <?php $url = "dcdashboard"; ?>
            @endif
        @endif
     
      <li><a href="{{ url('/home') }}">HOME</a></li>
      <li><a href="{{ URL::to($url) }}">Training</a></li>
      <li><a href="{{ url('/weavers/schemes') }}">Schemes</a></li>
     
    </ul>
  </div>
</nav>
</div>
