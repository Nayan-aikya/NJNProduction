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
        <div class="row" id="viewtargetcontainer">
          <form action="{{ URL::to('approvebatch') }}" method="get">
           
            <div class="col-sm-5" style=" margin-left:5%;">
              <label for="usr">Training Center: </label>
               <select onchange="this.form.submit()" class="form-control" id="sel1" name="tcid" required>
                <option value="">-----All Training Centers-----</option>
                @foreach ($tcinfo as $key )
                <option value="{{ $key->centre_id }}"  {{( $key->centre_id == $tc ) ? 'selected' : ''}} >{{ $key->centre_name }}</option>
                @endforeach
                          </select>
             </div>
            </form>  
        </div>
        
        <table class="table table-bordered">
        <tr><th>Batch Id</th><th>Batch Name</th><th>Batch Type</th><th>Start Date</th><th>End Date</th><th>No Of Candidate</th><th>Approve</th><th>Reject</th></tr>
            @foreach($batchinfo as $row)

            <form action="{{ url('approvebatch/'.$row->batch_id) }}" method="POST">
                                    {{ csrf_field() }}

            <tr>
                <input type="hidden" name="batchid" value="{{ $row->batch_id }}">
                <td>{{$row->batch_id}}</td><td>{{$row->batch_name}}</td><td>{{$row->training_type}}</td><td><input type="date" name="start_date" value="{{$row->start_date}}"></td><td><input type="date" name="end_date" value="{{$row->end_date}}"></td><td>{{$row->no_of_stud}}</td>
                <td>
                    <input class="btn btn-success" type="submit" name="submit" value="Approve">
                   
                </td>  
                <td>
                    <input class="btn btn-danger" type="submit" name="submit" value="Reject">
                </td>              
            </tr>
            </form>
            @endforeach
        </table>
        {{ $batchinfo->links() }}
        </div>
</div>   
@stop
