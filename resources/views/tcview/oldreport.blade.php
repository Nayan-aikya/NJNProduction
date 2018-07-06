<?php
 //echo "<pre>";print_r($reports);die;
  ?>
@extends('layouts.sidebar')
@section('custom_style')
<style>
    .wellbox2 {
        width: 100%;
        border: 1px solid #d9d9d9;
        padding: 8px;
        box-shadow: 2px 4px #888888;
    }
    .badge {
        background-color: #1E7E34;
    }
</style>
@endSection
@section('content')
    <div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
    <div id="viewtargetcontent" class="col-md-9">
    <h1 class="text-center pad_bottom_20 pad_top_20">Past Reports for {{ $district }} (2017-2018)</h1>

    @if($errors->any())
    <ul class="list-unstyled">
    @foreach ($errors->all() as $error)
        <li class="alert alert-danger">{{ $error }}</li>
    @endforeach
    </ul>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="well wellbox2">
                <h2 style="font-size: 15pt;text-align: left;"></h2>
                <ul class="list-group">
                    
                    <li class="list-group-item">
                      <span class="badge">{{ count($reports['batch_detail']) }}</span>
                      Training Center Count
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $reports['cand_count'] }}</span>
                      No of candidates Trained
                    </li>
                     <li class="list-group-item">
                      <span class="badge">{{ $reports['placed_cand'] }}</span>
                      No of candidates Placed
                    </li>
                    <li class="list-group-item">
                      <span class="" style="float: center;"><b> Batch Details</b></span>
                     
                    </li>
                    <li class="list-group-item">
                      <span class="cc" style="float: left;"><b>Center ID</b></span>
                      <span class="bc" style="float: right;"><b> Batch Count</b></span><br>
                    </li>
                    @foreach($reports['batch_detail'] as $batch)
                    <li class="list-group-item">
                      <span class="cc" style="float: left;">{{ $batch->center_id }}</span>
                      <span class="badge" style="float: right;">{{ $batch->batch_count }}</span><br>
                    </li>
                    @endforeach
                    <li class="list-group-item">
                     
                      <span class="bc" style="float: right;"><a href = "{{ url::to('fulldetails') }}" class="btn btn-info">View Full Details</a></span><br><br>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
</div>
@endSection

