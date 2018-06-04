<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
 <div class="row" id="viewbatchcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @elseif(Session::has('fail'))
        <div class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span><em> {!! session('fail') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
        <h1 style="color: #b30000;">Training Centre Approval</h1>
        <table class="table table-bordered">
        <tr>
        	<th>Centre&nbspID</th>
        	<th>Centre&nbspName</th>
        	<th>Owner&nbspName</th>
        	<th>District</th>
        	<th>Type&nbspof&nbspcentre</th>
        	<th>Subject</th>
        	<th>Mobile</th>
        	<th>Email</th>
        	<th>Approve</th>
        	<th>Reject</th>
        </tr>
        @foreach($tcinfo as $row)
        <tr>
          <td>{{ $row->centre_id }}</td>
          <td>{{ $row->centre_name }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->district }}</td>
          <td>{{ $row->centre_type }}</td>
          <td>{{ $row->training }}</td>
          <td>{{ $row->mobile_number }}</td>
          <td>{{ $row->email }}</td>
          <td>
          <form action="{{ url('approvetc/'.$row->centre_id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                    <i></i> Approve
                    </button>
                </form>
          </td>
          <td>
          	<form action="{{ url('rejecttc/'.$row->centre_id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">
                    <i></i> Reject
                    </button>
                </form>
          </td>
        </tr>
        @endforeach
        </table>
        </div>
</div>   
@stop
