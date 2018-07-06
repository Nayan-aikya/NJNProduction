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
@endSection

