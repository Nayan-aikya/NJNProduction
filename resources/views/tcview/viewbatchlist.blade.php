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
        <table class="table table-bordered">

        <tr><th>Batch Id</th><th>Batch Name</th><th>Batch Type</th><th>Start Date</th><th>End Date</th><th>No Of Candidate</th><th>Batch Status</th><th>Physical/Finanicial Status</th><th>Candidate Upload</th><th>Update/Delete</th><th>Action</th></tr>
            @foreach($batchinfo as $row)
            
            <tr>
                <td>{{$row->batch_id}}</td><td>{{$row->batch_name}}</td><td>{{$row->training_type}}</td><td>{{$row->start_date}}</td><td>{{$row->end_date}}</td><td>{{$row->no_of_stud}}</td><td>{{$row->status}}</td><td>{{$row->phystatus}}</td>  
                <td>
                <form id="uploadform.{{$row->batch_id}}"  action="{{ url('importExcel/'.$row->batch_id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <span style="float:left;margin-top: 4%;"><input type="file" name="import_file" /></span><br>
                <span style="float:right;margin-top: -10%;"><button class="btn btn-primary">Import</button></span>
                </form>
              
                </td>
               
                <td>
                     @if($row->status != "Approved")
                     <form id="editform.{{$row->batch_id}}" action="{{ url('batch/'.$row->batch_id) }}" method="get">
                    {{ csrf_field() }}<a onclick="document.getElementById('editform.{{$row->batch_id}}').submit();"><i class="glyphicon glyphicon-edit" id="edit"></i></a></form>
                    <form id="deleteform.{{$row->batch_id}}" action="{{ url('deletebatchlist/'.$row->batch_id) }}" method="POST">
                    {{ csrf_field() }}<a onclick="document.getElementById('deleteform.{{$row->batch_id}}').submit();"><i class="glyphicon glyphicon-trash"></i></a></form>
                    @else
                        <span align="center" title="Cannot edit or delete approved batches!!"><a ><i class="glyphicon glyphicon-info-sign"></i></a></span>
                    @endif
                </td>
                
                <td> 
                    @if($row->status == "Approved" && $row->phystatus == "Approved"  && $row->finstatus == "Approved" && $row->action != "Completed" && $row->action != "Start" && $row->start_date <= date('Y-m-d'))
                        <form id="actionstartform.{{$row->id}}" action="{{ url('batchAction/'.$row->batch_id.'/Start') }}" method="POST">
                    {{ csrf_field() }}<a onclick="document.getElementById('actionstartform.{{$row->id}}').submit();" class="btn btn-primary batchbtn" href="#"><span text-primary"></span>Start</a><br><br></form>
                    @else
                         <a disabled class="btn btn-primary batchbtn" href="#"><span text-primary"></span>Start</a><br><br>
                    @endif

                    @if($row->status == "Approved" && $row->phystatus == "Approved"  && $row->finstatus == "Approved" && $row->action == "Start")
                    <form id="actionholdform.{{$row->id}}" action="{{ url('batchAction/'.$row->batch_id.'/Hold') }}" method="POST">
                    {{ csrf_field() }}
                        <a onclick="document.getElementById('actionholdform.{{$row->id}}').submit();" class="btn btn-warning batchbtn" href="#"><span text-primary"></span>Hold</a><br><br></form>
                    @else
                        <a disabled class="btn btn-warning batchbtn" href="#"><span text-primary"></span>Hold</a><br><br>
                    @endif

                    @if($row->status == "Approved" && $row->phystatus == "Approved"  && $row->finstatus == "Approved" && date('Y-m-d') >= $row->end_date && $row->action != "Completed")
                    <form id="actioncompletedform.{{$row->id}}" action="{{ url('batchAction/'.$row->batch_id.'/Completed') }}" method="POST">
                    {{ csrf_field() }}
                        <a onclick="document.getElementById('actioncompletedform.{{$row->id}}').submit();" class="btn btn-success batchbtn" href="#"><span text-primary"></span>Completed </a><br><br></form>
                    @else
                        <a disabled class="btn btn-success batchbtn" href="#"><span text-primary"></span>Completed</a><br><br>
                    @endif
                </td>         
            </tr>
            @endforeach
        </table>
        </div>
</div>   
@stop
