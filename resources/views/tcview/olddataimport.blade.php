<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.sidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @elseif(Session::has('fail'))
        <div class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span><em> {!! session('fail') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
        <h1 style="color: #b30000;">List Of Batches</h1>
        @if(session()->has('message'))
           
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session()->get('message') }}
              </div>
        @endif
        <div class="row">
 <form id=""  action="{{ url('olddata') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <span style="float:left;margin-top: 4%;"><input type="file" name="import_file" /></span><br>
                <span style="float:right;margin-top: -10%;"><button class="btn btn-primary">Import old data</button></span>
                </form></div>
            </div>
        </div>
@stop