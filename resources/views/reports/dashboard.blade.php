<?php 
//echo "<pre>";print_r($data['idlebatch']);die;
 ?>
@extends('layouts.sidebar')
@section('content')

<style type="text/css">
    #viewbatchlistcontainer{
        margin-top: 5%;
        margin-bottom: 2%;
    }
</style>


<style type="  ">
  .wellbox {
        width: 338px;
    height: 149px;
    border: 1px solid #d9d9d9;
    padding-top: 0px;
    margin: 3%;
    box-shadow: 2px 4px #888888;
  }
</style>
<div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
<div id="viewtargetcontent" class="col-md-9">
<div class="row" >
  <h4 class="text-center pad_bottom_20 pad_top_20">WELCOME TO {{ Auth::user()->district }} DISTRICT.</h4>
<form action="{{ URL::to('dashboard') }}" method="get">
<div class="col-sm-5" style="margin-left:4%;">
              <label for="usr">Academic Year</label>
              <select onchange="this.form.submit()" class="form-control" id="sel1" name="fiscalyear" required>
              <option value="">-----Select Academic Year-----</option>
              @foreach ($data['academicyear'] as $key )
              <option value="{{ $key->academic_year }}"  {{( $key->academic_year == $data['acyear'] ) ? 'selected' : ''}} >{{ $key->academic_year }}</option>
              @endforeach
              </select>
</div>
<div class="col-sm-5" style=" margin-left:5%;">
  <label for="usr">Training Center: </label>
   <select onchange="this.form.submit()" class="form-control" id="sel1" name="tcid" required>
    <option value="">-----All Training Centers-----</option>
    @foreach ($data['tcinfo'] as $key )
    <option value="{{ $key->centre_id }}"  {{( $key->centre_id == $data['tc'] ) ? 'selected' : ''}} >{{ $key->centre_name }}</option>
    @endforeach
              </select>
 </div>
</form>

</div>

<br><br>
<div class="row">
  <div class="col-sm-5 well wellbox" >
     <h2 style="font-size: 15pt;text-align: left;">Training Center Status</h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#f26c4f;">
      <span class="sr-only">70% Complete</span>
    </div>
                   
   <h2 style="font-size:13pt;text-align: left;">Approved&nbsp&nbsp;   <b style="color:#7cbc01;">{{ $data['active']}}</b> <br>Pending Approval &nbsp&nbsp;<b style="color:#f26c4f;">{{ $data['idle']}}</b><br> Rejected&nbsp&nbsp; <b style="color:#37a8e0;">{{ $data['defunt']}}</b></h2>
    </div>
    
     <div class="col-sm-5 well wellbox" >
     
     <h2 style="font-size:15pt;text-align: left;">No of batches : {{ $data['nobatch']}}</h2>

    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#7cbc01;">
      <span class="sr-only">70% Complete</span>
    </div>
  
  
    <h2 style="font-size:13pt;text-align: left;"><a href="" data-toggle="modal" data-target="#active" >Active</a>&nbsp&nbsp;   <b style="color:#7cbc01;">{{ count($data['activebatch']) }}</b> <br><a href="" data-toggle="modal" data-target="#idle" >Idle</a> &nbsp&nbsp;<b style="color:#f26c4f;">{{ count($data['idlebatch']) }}</b><br><a href="" data-toggle="modal" data-target="#nactive" >Not Active</a>&nbsp&nbsp; <b style="color:#37a8e0;">{{ count($data['nactivebatch'])}}</b>
      <br><a href="" data-toggle="modal" data-target="#completed" >Completed</a> &nbsp&nbsp;<b style="color:#f26c4f;">{{ count($data['completed']) }}</b>
    </h2>  

    </div>
  </div>
 
  <div class="row">
  
<div class="col-sm-5 well wellbox" >
     
     <h2 style="font-size:15pt;text-align: left;">No of candidates</h2>
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#bb070e;">
      <span class="sr-only">70% Complete</span>
    </div>
  <h2 style="font-size: 28pt;text-align: left;">{{ $data['nocandidate']}}</h2>
   
    </div>
       
     <div class="col-sm-5 well wellbox" >
     
     <h2 style="font-size:15pt;text-align: left;">No of candidates Placed</h2>
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#bb070e;">
      <span class="sr-only">70% Complete</span>
    </div>
  <h2 style="font-size: 28pt;text-align: left;">{{ $data['candidateplaced']}}</h2>
   
    </div>
     
  </div>
    
    <div class="row">
  <div class="col-sm-2 offset-sm-2">
   </div>
    <div class="col-sm-12 well wellbox"  style="height:167px;width: 748px;">
     <h2 style="font-size: 15pt;text-align: left;">Expenditure incurred towards training in &nbsp&nbsp;&nbsp&nbsp; &nbsp&nbsp;&nbsp&nbsp;                      </h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#f1b330;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;"><p style="font-size:13pt;text-align: left;"> Stipend &nbsp&nbsp; <b style="color:#f26c4f;"> &nbsp&nbsp; {{ $data['stipend'] }} &nbsp;&nbsp; </b>Raw Material&nbsp;&nbsp;  <b style="color:#37a8e0;"> {{ $data['rawmaterial'] }}  &nbsp;&nbsp;</b>Institutional Expenses&nbsp;&nbsp; <b style="color:#7cbc01;"> {{ $data['inst_exp'] }} </b><br><br><br>
           <b align="right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  |Total<b style="color:#f26c4f;"> {{ $data['total_exp'] }}</b></b></p></h2>
    </div>
    
     
  </div>
    
    
    <div class="row">
 
      <div class="col-sm-5 well wellbox" >
     <h2 style="font-size:15pt;text-align: center;">Training Center Count</h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;">
      <span class="sr-only">70% Complete</span>
    </div>
  
  <br> <h2 style="font-size: 28pt;text-align: center;">{{ $data['status'] }}</h2>
    </div>
    
     <div class="col-sm-5 well wellbox" >
    <h2 style="font-size:15pt;text-align: left;">Expenditure incurred towards<br>providing employment</h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#ffa58a;">
      <span class="sr-only">70% Complete</span>
    </div>
  
    <h2 style="font-size: 28pt;text-align: left;">{{ $data['placementexpense']}}</h2>
    </div>
  </div>
  <h1 align="center">Batch Info</h1>   
   <div class="row">
  
    <div class="col-sm-12 well wellbox"  style="height:auto;width: 748px;">
     <table class="table">
    <thead>
      <tr>
        <th>Batch ID</th>
         <th>Center Name</th>
        <th>Batch Name</th>
       
        <th>Batch Status</th>
        <th>Batch Action</th>
      </tr>
    </thead>
    <tbody>
     <?php  $blog    = $data['info'];
      ?>
      @foreach($blog as $batchInfo)
      <tr class="success">
        <td>{{ $batchInfo->batch_id }}</td>
        <td>{{ $batchInfo->centre_name }}</td>
        <td>{{ $batchInfo->batch_name }}</td>
        <td>{{ $batchInfo->status }}</td>
        <td>{{ $batchInfo->action }}</td>
      </tr>
     @endforeach
    </tbody>
  </table>
    </div>
    
     
  </div>
</div>
<!--================================= Modals================================== -->
<!-- Modal -->
  <div class="modal fade" id="active" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Batch Details</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                 <th>Center Name</th>
                <th>Batch Name</th>
               
                <th>Batch Status</th>
                <th>Batch Action</th>
                <th>Start Date</th>
                <th>End Date</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($data['activebatch'] as $batchInfo)
              <tr class="success">
                <td>{{ $batchInfo->centre_name }}</td>
                <td>{{ $batchInfo->batch_name }}</td>
                <td>{{ $batchInfo->status }}</td>
                <td>{{ $batchInfo->action }}</td>
                 <td>{{ $batchInfo->start_date }}</td>
                <td>{{ $batchInfo->end_date }}</td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="nactive" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Batch Details</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th>Center Name</th>
              <th>Batch Name</th>
               <th>Batch Status</th>
                <th>Batch Action</th>
                <th>Start Date</th>
                <th>End Date</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($data['nactivebatch'] as $batchInfo)
              <tr class="success">
                <td>{{ $batchInfo->centre_name }}</td>
                <td>{{ $batchInfo->batch_name }}</td>
                <td>{{ $batchInfo->status }}</td>
                <td>{{ $batchInfo->action }}</td>
                <td>{{ $batchInfo->start_date }}</td>
                <td>{{ $batchInfo->end_date }}</td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="idle" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Batch Details</h4>
        </div>
        <div class="modal-body">
         <table class="table">
            <thead>
              <tr>
                 <th>Center Name</th>
                <th>Batch Name</th>
               
                <th>Batch Status</th>
                <th>Batch Action</th>
                <th>Start Date</th>
                <th>End Date</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($data['idlebatch'] as $batchInfo)
              <tr class="success">
                <td>{{ $batchInfo->centre_name }}</td>
                <td>{{ $batchInfo->batch_name }}</td>
                <td>{{ $batchInfo->status }}</td>
                <td>{{ $batchInfo->action }}</td>
                 <td>{{ $batchInfo->start_date }}</td>
                <td>{{ $batchInfo->end_date }}</td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="completed" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Batch Details</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                 <th>Center Name</th>
                <th>Batch Name</th>
               
                <th>Batch Status</th>
                <th>Batch Action</th>
                <th>Start Date</th>
                <th>End Date</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($data['completed'] as $batchInfo)
              <tr class="success">
                <td>{{ $batchInfo->centre_name }}</td>
                <td>{{ $batchInfo->batch_name }}</td>
                <td>{{ $batchInfo->status }}</td>
                <td>{{ $batchInfo->action }}</td>
                 <td>{{ $batchInfo->start_date }}</td>
                <td>{{ $batchInfo->end_date }}</td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

</div>

@stop
