@extends('layouts.sidebar')
@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@stop
@section('content')
    <div class="container">
    <h2 class="text-center">Applications received for investment</h2>
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
                    <th>Registration number</th>
                    <th>Unit Name</th>
                    <th>Company Address</th>
                    <th>Unit Address</th>
                    <th>Unit City</th>
                    <th>Date of apllication</th>
                    <th>Status</th>                    
                </tr>
            @foreach($applications as $key => $app)
            <tr>
                <td>{{$app->id}}</td>
                <td>{{$app->regno}}</td>
                <td>{{$app->unit_name}}</td>
                <td>{{$app->company_address}}</td>
                <td>{{$app->unit_address}}</td>
                <td>{{$app->unit_city}}</td>
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
            </tr>
            @endforeach
            </table>
        </div>
    </div>
@stop
@section('custom_scripts')
    
@stop
