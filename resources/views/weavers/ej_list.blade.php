@extends('layouts.sidebar')
@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@stop
@section('content')
    <div class="container">
    <h2 class="text-center">Applications received for 2 looms, Electronic jacquard and Knotting Machine</h2>
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <br>
        <div class="list-conatiner">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Residential address</th>
                    <th>Taluk</th>
                    <th>District</th>
                    <th>Mobile</th>
                    <th>Date of apllication</th>
                    <th>Status</th>                    
                    <th>Inspection status</th>
                    <th>Actions</th>
                </tr>
            @foreach($applications as $key => $app)
            <tr>
                <td>{{$app->id}}</td>
                <td>{{$app->name}}</td>
                <td>{{$app->resi_houseno.', '.$app->resi_wardno.', '.$app->resi_crossno.', '.$app->resi_village}}</td>
                <td>{{$app->resi_taluk}}</td>
                <td>{{$app->resi_district}}</td>
                <td>{{$app->resi_mobile}}</td>
                <td>{{$app->created_at}}</td>
                <td>
                    @if ($app->status == 'applied')
                    <span class="label label-warning">Applied</span>
                    @endif
                    @if ($app->status == 'approved')
                    <span class="label label-success">Approved</span>
                    @endif
                    @if ($app->status == 'rejected')
                    <span class="label label-danger">Rejected</span>
                    @endif
                </td>                
                <td>
                    @if ($app->ins_status == 'pending')
                    <span class="label label-warning">Pending</span>
                    @endif
                    @if ($app->ins_status == 'approved')
                    <span class="label label-success">Approved</span>
                    @endif
                    @if ($app->ins_status == 'rejected')
                    <span class="label label-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ url('/weavers/ej-2loom-app/details/'.$app->id)}}">View details</a>
                </td>
            </tr>
            @endforeach
            </table>
        </div>
    </div>
@stop
@section('custom_scripts')
    
@stop
