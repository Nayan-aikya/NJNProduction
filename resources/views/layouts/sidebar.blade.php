<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('includes.head')
    @yield('custom_style')
</head>
<body>
    <header class="navbar-fixed-top" id="head">
        @include('includes.header')
    </header>
        <!-- main content -->
        <div id="content">
            @yield('content')
        </div> 
    <footer id="foot" >
        @include('includes.footer')
    </footer>
</body>
@yield('custom_scripts')
</html>