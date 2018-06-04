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
<h1 id="heading">Create Training Subject</h1>
<form action="/createsubject" method="post">
{{csrf_field()}}
<table style="width: 40%;" cellspacing="15">
<tr>
<td>
        <label>Financial Year:</label><br>
        <select class="form-control" id="sel1" name="fiscalyear" required>
        <option value="">-----Select Financial Year-----</option>
        <!-- <option value="2018-2019">2018-2019</option> -->
        <!-- <option value="2019-2020">2019-2020</option> -->
        @foreach ($academicyear as $key )
        <option value="{{ $key->academic_year }}">{{ $key->academic_year }}</option>
        @endforeach
        </select>    
</td></tr>
<tr><td><label class="lbl">Subject Name:</label><br>
<input id="ctname" class="form-control" type="text" name="subjectname" required ><br></td></tr>
<tr><td><label class="lbl">No Of Candidate:</label><br>
<input id="ctname" class="form-control" type="text" name="candidate" required ><br></td>
</tr>
<tr>
<td><br><button type="submit" class="btn btn-primary" style="width:100%">Submit</button></td></tr>
</table>
</form>
</div>
</div>
@stop