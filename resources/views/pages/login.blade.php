<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
<div id="logincontent">
    <div class="container logincontainer">
      <h1>Login to Your Account</h1><br>
    <form action="/login" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input required type="text" name="user" placeholder="Username">
    <input required type="password" name="pass" placeholder="Password">
    <input type="submit" name="login" value="Login" class="logsubmit">
    </form>         
      <div class="login-help">
    <a href="#">Register</a> - <a href="#">Forgot Password</a>
    </div>
  </div>
</div>
@stop
