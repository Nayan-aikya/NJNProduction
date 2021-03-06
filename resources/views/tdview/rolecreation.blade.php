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
<h1 id="heading">Role Creation</h1>
<form action="/createRole" method="post">
{{csrf_field()}}
<table style="width: 80%;" cellspacing="15">
<tr>
<td><label class="lbl">Role Name:</label><br>
<input id="rcrolename" class="input" type="text" name="rolename" required onchange="myFunction()"><br></td>
</tr>
<tr>
<td><label  class="lbl">Role ID:</label><br>
<input id="rcroleid" class="input" type="text" name="roleid" required ><br></td>
</tr>
<tr>
<td colspan="1"><br><button type="submit" class="btn btn-primary" width="100%">Submit</button></td></tr>
</table>
</form>
</div>
</div>
<script type="text/javascript">
	function myFunction() {
    var x = document.getElementById("rcrolename").value;
    var temp="";
    temp=x.charAt(0);
    var pos=x.indexOf(' ');
    temp+=x.charAt(pos+1);
    temp+=x.charAt(x.length-1);
    document.getElementById("rcroleid").value=temp.toUpperCase();
    }
</script>
@stop