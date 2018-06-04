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
        <h1 style="color: #b30000;">Batch Approval</h1>
        <table class="table table-bordered">
        <tr><th>Batch Id</th><th>Batch Name</th><th>Batch Type</th><th>Start Date</th><th>End Date</th><th>No Of Candidate</th><th>Approve</th><th>Reject</th></tr>
            @foreach($batchinfo as $row)
            <tr>
                <td>{{$row->batch_id}}</td><td>{{$row->batch_name}}</td><td>{{$row->training_type}}</td><td>{{$row->start_date}}</td><td>{{$row->end_date}}</td><td>{{$row->no_of_stud}}</td>
                <td>
                <form action="{{ url('approvebatch/'.$row->batch_id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                    <i></i> Approve
                    </button>
                </form>
                </td>  
                <td>
                <form action="{{ url('rejectbatch/'.$row->batch_id) }}" method="POST">
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
