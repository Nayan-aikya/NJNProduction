<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
<div class="row" id="batchcreatecontainer">
<div id="sidebar" class="col-md-3">
@include('includes.tdsidebar')
</div>
<div id="targetcontent" class="col-md-9">
		@if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
<h1 id="heading">Create Centre Type</h1>
<form action="/createcentretype" method="post">
{{csrf_field()}}
<table style="width: 80%;" cellspacing="15">
<tr>
<td><label class="lbl">Type Name:</label><br>
<input id="ctname" class="input" type="text" name="typename" required ><br></td>
</tr>
<tr>
<td colspan="1"><br><button type="submit" class="btn btn-primary" width="100%">Submit</button></td></tr>
</table>
</form>
</div>
</div>
@stop