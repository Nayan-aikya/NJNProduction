<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')

@section('content')
<div class="row" id="editbatchlistcontainer">
<div id="sidebar" class="col-md-3">
@include('includes.sidebar')
</div>
<div id="targetcontent" class="col-md-9">
		@if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
<h1 id="heading">Update Batch List</h1>
<form action="/updatebatchinfo" method="post">
{{csrf_field()}}
<table style="width: 80%;" cellspacing="15">
@foreach($batchinfo as $row)
<tr>
<td><label>Batch Name:</label><br>
<input class="form-control" type="text" name="batchname" value="{{ $row -> batch_name }}" required><br></td>
<td><input class="form-control" type="hidden" name="batchid" value="{{ $row -> batch_id }}"></td>
<td><label>Training Type:</label><br>
<input  class="form-control" type="text" name="trainingtype"  value="{{ $row -> training_type }}"  required><br></td>
</tr>
<tr>
<td><label>Start Date:</label><br>
<input  class="form-control" type="date" name="startdate" value="{{  $startdate }}"  required><br></td>	
<td></td>
<td><label>End Date:</label><br>
<input  class="form-control" type="date" name="enddate" value="{{ $enddate }}"  required><br></td>
</tr>
<tr><td colspan="1"><label>Number of Candidates:</label><br>
<input class="form-control" type="number" name="noofstud" value="{{ $row -> no_of_stud }}"  required></td><br><td></td>
<td colspan="1"><br><button type="submit" class="btn btn-primary" style="width: 100%;">Update</button></td></tr>
@endforeach
</table>
</form>
</div>
</div>
@stop