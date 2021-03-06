<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
<style type="text/css">
    input[type='file'] {
  color: transparent;    /* Hides your "No File Selected" */
}
</style>
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
        <th>Action</th>
        <th>Attendence</th>
      </tr>
 </thead>
<form method="get" action="{{ url::to('candidatelistinfo') }}">
    <div class="form-group">
        <label>Select Batch:</label><br>
        <select name="batchid" onchange="this.form.submit()"  class="form-control" style="width:350px" required>
        <option value="">--- All ---</option>
        @foreach($batchlist as $value)
            <option value="{{ $value->batch_id }}" {{( $value->batch_id == $batchid ) ? 'selected' : ''}} >{{ $value->batch_name }}</option>
        @endforeach
        </select>
    </div>  
</form>
 @foreach ($candidate as $c)
    <tr><td>{{$c->candidate_id}}</td><td>{{$c->first_name}}</td><td>{{$c->last_name}}</td><td>{{$c->gender}}</td><td>{{$c->batch_id}}</td><td>{{$c->batch_name}}</td><td>{{$c->batch_type}}</td>
    <td>
        <?php $src = "/uploads/".$c->photo; ?>
   		 <form id="uploadphoto.{{$c->candidate_id}}"  action="{{ url('uploadcandidatephoto/'.$c->candidate_id.'/'.$c->batch_id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <span style="float:left;margin-top: 4%;"><input type="file" name="photo" /></span><br>
            <span style="float:right;margin-top: -10%;"><button class="btn btn-primary">Upload</button></span>
            <p style="color: blue;">(Image size should begit below 1Mb)</p>
            @if(!empty($c->photo))<img src="{{ $src }}" style="height: 90px; width: auto; float: right;">@endif
        </form>
    </td>
    <td>
    @if($c->action != 'Completed')
            <a  class="btn btn-danger" href="#deleteEmployeeModal{{ $c->candidate_id }}" class="delete" data-toggle="modal">Remove</a>
    @endif
    </td>
    <td>
    @if($c->action == 'Completed')
    <form action="{{ url('updateAttendance') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" name="canid" value="{{ $c->candidate_id }}">
        <input required class="tinf" type="number" value="{{ $c->attendence }}" name="attendence"  onchange="this.form.submit()" >
    </form>
    @endif
    </td>
    </tr>
    <div id="deleteEmployeeModal{{ $c->candidate_id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Delete Candidate</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <p>Are you sure you want to delete this employee?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('batchcandidatedelete/'.$c->candidate_id.'/'.$c->batch_id)  }}" method="POST">
                            {{ csrf_field() }}
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                            <button type="submit" class="btn btn-danger"><i></i> Remove</button>
                           
                        </form>
                    </div>
            </div>
        </div>
    </div>
 @endforeach
 </table>
{{ $candidate->links() }}
</div>
</div>

@stop