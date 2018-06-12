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
<div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
<div id="viewtargetcontent" class="col-md-9">
<div class="row" >
<div class="col-sm-5" style="margin-left:4%;">
              <label for="usr">Academic Year</label>
              <select class="form-control" id="sel1" name="fiscalyear" required>
              <option value="">-----Select Academic Year-----</option>
              @foreach ($academicyear as $key )
              <option value="{{ $key->academic_year }}"  {{( $key->academic_year == $acyear ) ? 'selected' : ''}} >{{ $key->academic_year }}</option>
              @endforeach
              </select>
</div>
<div class="col-sm-5" style=" margin-left:5%;">
              <label for="usr">Training Center</label>
              <select class="form-control" id="sel1" name="tc" required>
              <option value="">-----Select Training Centre-----</option>
              <option value="all" selected>All</option>
              @foreach ($tc as $key )
              <option value="{{ $key->centre_id }}">{{ $key->centre_name }}</option>
              @endforeach
              </select>
</div>
</div>
<h1 style="color: #b30000;">Dashboard</h1>

<div class="container">
  <div class="row">

    <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="tcapproved" id="tcapproved" name="division">{{$tcapproved}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of training <br>centers approved</h2>
    </div>
    
     <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 15pt;text-align: left;">Training <br>Center Status</h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#f26c4f;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:13pt;text-align: left;">Active&nbsp&nbsp;   <b style="color:#7cbc01;"><span data-field="tcactive" id="tcactive" name="division">{{$tcactive}}</span></b> &nbsp&nbsp;  Idle &nbsp&nbsp;<b style="color:#f26c4f;"><span data-field="tcidle" id="tcidle" name="tcidle">{{$tcidle}}</span></b>&nbsp&nbsp; Defunct&nbsp&nbsp; <b style="color:#37a8e0;"><span data-field="tcdefunct" id="tcdefunct" name="tcdefunct">{{$tcdefunct}}</span></b></h2>
    </div>
  </div>


  <div class="row">

    <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="curryearbatch" id="curryearbatch" name="curryearbatch">{{$curryearbatch}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#7cbc01;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of batches completed<br>Current financial year</h2>
    </div>
    
     <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="curryearcandidate" id="curryearcandidate" name="curryearcandidate">{{$curryearcandidate}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#bb070e;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of candidates trained <br>in current year</h2>
    </div>
  </div>
    
     <div class="row">

    <div class="col-sm-12" style=" margin:3%;width:745px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 15pt;text-align: left;">Expenditure incurred towards training in Rs.873 &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;                      </h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#f1b330;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;"><p style="font-size:13pt;text-align: left;"> Stipend &nbsp;&nbsp; <b style="color:#f26c4f;"> &nbsp;&nbsp; <span data-field="stipend" id="stipend" name="stipend">{{$stipend}}</span> &nbsp;&nbsp; </b>Raw Material&nbsp;&nbsp;  <b style="color:#37a8e0;"><span data-field="rawmaterial" id="rawmaterial" name="rawmaterial">{{$rawmaterial}}</span></b><br>Institutional Expenses&nbsp;&nbsp; <b style="color:#7cbc01;"> <span data-field="expense" id="expense" name="expense">{{$expense}}</span></b>
           <b align="right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  |Total<b style="color:#f26c4f;"> <span data-field="total" id="total" name="total">{{$total}}</span></b></b></p></h2>
    </div>
    
     
  </div>
    
    
    <div class="row">

    <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="candidateplaced" id="candidateplaced" name="candidateplaced">{{$candidateplaced}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#37a8e0;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of candidates provided<br> for placement</h2>
    </div>
    
     <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="placementexpense" id="placementexpense" name="placementexpense">{{$placementexpense}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#ffa58a;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">Expenditure incurred towards<br>providing employment in Rs</h2>
    </div>
  </div>
    
  <div class="row">
    <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="trainingbacthes" id="trainingbacthes" name="trainingbacthes">{{$trainingbacthes}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#fff568;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of batches under training</h2>
    </div>
    
     <div class="col-sm-4" style=" margin:3%;width:338px;height:149px;
    border: 1px solid #d9d9d9;">
     <h2 style="font-size: 28pt;text-align: left;"><span data-field="trainingcandidates" id="trainingcandidates" name="trainingcandidates">{{$trainingcandidates}}</span></h2>
     
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;height: 6px;background-color:#acde4b;">
      <span class="sr-only">70% Complete</span>
    </div>
  
   <h2 style="font-size:15pt;text-align: left;">No of students under training</h2>
    </div>
  </div>  
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="fiscalyear"]').on('change', function() {
          $('select[name="tc"]').val(0);
        });
        $('select[name="tc"]').on('change', function() {
            var tc = $(this).val();
            var fiscalyear = $("select[name='fiscalyear']").val();
            if(tc) {
                $.ajax({
                    url: '/dashboard/'+tc+'/'+fiscalyear,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                      $("[data-field='tcapproved']").text(data[0].tcapproved);
                      $("[data-field='tcactive']").text(data[0].tcactive);
                      $("[data-field='tcidle']").text(data[0].tcidle);
                      $("[data-field='tcdefunct']").text(data[0].tcdefunct);
                      $("[data-field='curryearbatch']").text(data[0].curryearbatch);
                      $("[data-field='curryearcandidate']").text(data[0].curryearcandidate);
                      $("[data-field='stipend']").text(data[0].stipend);
                      $("[data-field='rawmaterial']").text(data[0].rawmaterial);
                      $("[data-field='expense']").text(data[0].expense);
                      $("[data-field='total']").text(data[0].total);
                      $("[data-field='candidateplaced']").text(data[0].candidateplaced);
                      $("[data-field='placementexpense']").text(data[0].placementexpense);
                      $("[data-field='trainingbacthes']").text(data[0].trainingbacthes);
                      $("[data-field='trainingcandidates']").text(data[0].trainingcandidates);
                    }
                });
            }
            else{                
            }
        });
    });
  </script>
@stop
