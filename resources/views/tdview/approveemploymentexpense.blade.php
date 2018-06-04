<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    #viewbatchlistcontainer{
        margin-top: 5%;
        margin-bottom: 2%;
    }
</style>
 <div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        <h1 style="color: #b30000;">List Of Completed Batches</h1>
        @if(session()->has('message'))    
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session()->get('message') }}
              </div>
        @endif
        <table class="table table-bordered">
        <tr>
            <th>Centre Id</th>
            <th>Centre Name</th>
            <th>District</th>
            <th>Batch Id</th>
            <th>Batch Name</th>
            <th>Batch Type</th>
            <th>Status</th>
            <th>Expense</th>   
            <th></th>   
            <th></th>            
        </tr>       
        @foreach($info as $row)
        <tr>
            <td>{{$row->centre_id}}</td>
            <td>{{$row->centre_name}}</td>
            <td>{{$row->district}}</td>
            <td>{{$row->batch_id}}</td>
            <td>{{$row->batch_name}}</td>
            <td>{{$row->batch_type}}</td>
            <td>{{$row->action}}</td> 
            <td>{{$row->expense}}</td> 
            <td>
          <form action="{{ url('approveexpense/'.$row->batch_id . '/' .$row->centre_id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                    <i></i> Approve
                    </button>
                </form>
          </td>
          <td>
            <form action="{{ url('rejectexpense/'.$row->batch_id . '/' .$row->centre_id) }}" method="POST">
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
