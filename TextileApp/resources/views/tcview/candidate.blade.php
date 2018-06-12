<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
<div class="row" id="batchcreatecontainer">
<div id="sidebar" class="col-md-3">
@include('includes.sidebar')
</div>
<div id="targetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @elseif(Session::has('fail'))
        <div class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span><em> {!! session('fail') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
<h1 id="heading">Candidate Upload</h1>
<table class="table table-bordered">
 <thead>
      <tr>
      	<th>Candidate Id</th>
      	<th>First Name</th>
      	<th>Last Name</th>
      	<th>Gender</th>
        <th>Bacth Id</th>
        <th>Batch Name</th>
        <th>Batch Type</th>
        <th>Photo Upload</th>
        <th></th>
      </tr>
 </thead>
 @foreach ($candidate as $c)
    <tr><td>{{$c->candidate_id}}</td><td>{{$c->first_name}}</td><td>{{$c->last_name}}</td><td>{{$c->gender}}</td><td>{{$c->batch_id}}</td><td>{{$c->batch_name}}</td><td>{{$c->batch_type}}</td>
    <td>
   		 <form id="uploadphoto.{{$c->candidate_id}}"  action="{{ url('uploadcandidatephoto/'.$c->candidate_id.'/'.$c->batch_id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <span style="float:left;margin-top: 4%;"><input type="file" name="photo" /></span><br>
            <span style="float:right;margin-top: -10%;"><button class="btn btn-primary">Upload</button></span>
            <p style="color: blue;">(Image size should begit below 1Mb)</p>
        </form>
    </td>
    <td>
    	<form action="{{ url('batchcandidatedelete/'.$c->candidate_id.'/'.$c->batch_id)  }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger"><i></i> Remove</button>
        </form>
    </td>
    </tr>
 @endforeach
 </table>
</div>
</div>
@stop