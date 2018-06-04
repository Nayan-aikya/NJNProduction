<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@extends('layouts.sidebar')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    #viewbatchlistcontainer{
        margin-top: 5%;
        margin-bottom: 2%;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
     <h2 style="font-size:15pt;text-align: center;">Training Center Status</h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;">
      <span class="sr-only">70% Complete</span>
    </div>
  
  <br> <h2 style="font-size: 28pt;text-align: center;">{{ $data['status'] }}</h2>
    </div>
     <div class="col-sm-5 well wellbox" >
     
     <h2 style="font-size:15pt;text-align: left;">No of batches</h2>

    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#7cbc01;">
      <span class="sr-only">70% Complete</span>
    </div>
  
  
    <h2 style="font-size: 28pt;text-align: left;">{{ $data['nobatch']}}</h2>
    </div>
  </div>


  <div class="row">
  
<div class="col-sm-5 well wellbox" >
     
     <h2 style="font-size:15pt;text-align: left;">No of candidates trained</h2>
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
  
   <h2 style="font-size:15pt;text-align: left;"><p style="font-size:13pt;text-align: left;"> Stipend &nbsp&nbsp; <b style="color:#f26c4f;"> {{ $data['stipend']}}&nbsp&nbsp; &nbsp&nbsp; </b>Raw Material&nbsp&nbsp;  <b style="color:#37a8e0;">{{ $data['rawmaterial']}}&nbsp&nbsp; &nbsp&nbsp; </b>Institutinoal expenditure&nbsp&nbsp;  <b style="color:#37a8e0;">{{ $data['inst_exp']}}<br><br><br> |Total<b style="color:#f26c4f;"> </b>{{ $data['total_exp']}}</b></p></h2>
    </div>
    
     
  </div>
    
    
    <div class="row">
 
    <div class="col-sm-5 well wellbox" >
     <h2 style="font-size: 28pt;text-align: left;"></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#37a8e0;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of candidates provided<br> for placement</h2>
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
</div>

@stop
