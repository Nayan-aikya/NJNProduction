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
    @if($appsdata['userRole'] == 'SD')
    <h4 class="text-center pad_bottom_20 pad_top_20">WELCOME TO KARNATAKA STATE.</h4>
    @endIf
    @if($errors->any())
    <ul class="list-unstyled">
    @foreach ($errors->all() as $error)
        <li class="alert alert-danger">{{ $error }}</li>
    @endforeach
    </ul>
    @endif
    @if($appsdata['userRole'] != 'SD')
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
    @if($appsdata['userRole'] == 'SD')
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
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ej_field_inspections'] }}</span>
                      Field inspections completed
                    </li>
                    <li class="list-group-item">
                      <span class="badge">0</span>
                      Old applications uploaded
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ej2l_apps_received'] }}</span>
                      Applications submitted
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
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ps_field_inspections'] }}</span>
                      Field inspections completed
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ps_apps_uploaded'] }}</span>
                      Old applications uploaded
                    </li>
                    <li class="list-group-item">
                      <span class="badge">{{ $appsdata['ps_apps_submitted'] }}</span>
                      Applications submitted
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="well wellbox2">
                <h2 style="font-size: 15pt;text-align: left;">District wise EJ-2L applications</h2>
                <table class="table table-striped table-bordered ">
                    <tr>
                        <th>District</th><th>Applications</th>
                    </tr>
                
                <?php
                foreach($appsdata['ej_districtwise'] as $dv){
                    echo '<tr><td>'.$dv->district_name.'</td><td>'.$dv->total.'</td></tr>';
                }
                ?>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="well wellbox2">
                <h2 style="font-size: 15pt;text-align: left;">District wise power subsidy applications</h2>
                <table class="table table-striped table-bordered ">
                    <tr>
                        <th>District</th><th>Applications</th>
                    </tr>
                
                <?php
                foreach($appsdata['ps_districtwise'] as $dv){
                    echo '<tr><td>'.$dv->district_name.'</td><td>'.$dv->total.'</td></tr>';
                }
                ?>
                </table>
            </div>
        </div>
        
    </div>
    @endif
    
@endSection

