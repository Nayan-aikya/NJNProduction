<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('includes.survey_head')
    @yield('title_text')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    @yield('custom_style')
</head>
<body>
    <header class="navbar-fixed-top" id="head">
        @include('includes.header')
    </header>
        <!-- main content -->
        <div id="content" style="padding:0 !important; overflow-x: hidden;">
            @yield('content')
        </div> 
    <footer id="foot" >
        @include('includes.footer')
    </footer>
</body>
@yield('custom_scripts')
</html>