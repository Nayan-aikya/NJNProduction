@extends('layouts.sidebar')
@section('custom_style')
<style>
    .wellbox2 {
        width: 100%;
        border: 1px solid #d9d9d9;
        padding: 8px;
        box-shadow: 2px 4px #888888;
    }
</style>
@endSection
@section('content')
    @if($appsdata['userRole'] == 'TD')
    <h4 class="text-center pad_bottom_20 pad_top_20">WELCOME TO {{ $appsdata['adminTypeName']}} DISTRICT.</h4>
    @endIf
    @if($appsdata['userRole'] == 'DD')
    <h4 class="text-center pad_bottom_20 pad_top_20">WELCOME TO {{ $appsdata['adminTypeName']}} DIVISION.</h4>
    @endIf

    @if($errors->any())
    <ul class="list-unstyled">
    @foreach ($errors->all() as $error)
        <li class="alert alert-danger">{{ $error }}</li>
    @endforeach
    </ul>
    @endif
    @if($appsdata['userRole'] != 'TC')
    <div class="row">
        <div class="col-md-6">
            <div class="well wellbox2">
                <h2 style="font-size: 15pt;text-align: left;">2 loom, Elecronic Jacquard and Knotting machine scheme</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ej2l_apps_received'] }}</span>
                      Applications received
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ej2l_apps_complted'] }}</span>
                      Applications processed
                    </li>
                    <li class="list-group-item text-center">
                      <a href="{{ url('/weavers/ej-2loom-list') }}" class="btn btn-success">View applications</a> <a href="{{ url('/weavers/ej-2loom-apply') }}" class="btn btn-info">Fill application</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="well wellbox2">
                <h2 style="font-size: 15pt;text-align: left;">Power subsidy</h2>
                <ul class="list-group">
                <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ps_apps_received'] }}</span>
                      Applications received
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ps_apps_complted'] }}</span>
                      Applications processed
                    </li>
                    <li class="list-group-item text-center">
                      <a href="{{ url('/weavers/powersubsidy-list') }}" class="btn btn-success">View applications</a> <a href="{{ url('/weavers/powersubsidy-apply') }}" class="btn btn-info">Fill application</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    @endif
    <br><div class="row">
        <div class="col-md-6">
            <div class="well wellbox2">
                <h2 style="font-size: 15pt;text-align: left;">NJN Training Scheme</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['status'] }}</span>
                      Training Center Count
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['nobatch'] }}</span>
                      Batch Count
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['nocandidate'] }}</span>
                      Candidates Count
                    </li>
                    <?php $url=""; ?>
                    @if(Auth::check())
                        @if(Auth::user()->user_id == 1)
                            <?php $url = "dashboard"; ?>
                        @endif
                        @if(Auth::user()->user_id == 2)
                            <?php $url = "tcdashboard"; ?>
                        @endif
                        @if(Auth::user()->user_id == 4)
                            <?php $url = "dcdashboard"; ?>
                        @endif
                        @if(Auth::user()->user_id == 6)
                            <?php $url = "stdashboard"; ?>
                        @endif
                    @endif
                    <li class="list-group-item text-center">
                      <a href="{{ URL::to($url) }}" class="btn btn-success">View More</a> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endSection

