@extends('layouts.sidebar')
@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@stop
@section('content')
    <div class="container">
    <h2 class="text-center">Applications received</h2>
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
                    <th>Mobile</th>
                    <th>Date of apllication</th>
                    <th>Application Status</th> 
                    <th>Actions</th>
                </tr>
                @foreach($applications as $key => $app)
                <tr>
                    <td>{{$app->id}}</td>
                    <td>{{$app->name}}</td>
                    <td>{{$app->resi_mobile}}</td>
                    <td>{{$app->created_at}}</td>
                    <td>
                    @if ($app->app_status == 'applied')
                        <span class="label label-warning">Applied</span>
                        @endif
                        @if ($app->app_status == 'closed')
                        <span class="label label-success">Closed</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ url('/weavers/ej-2loom-app/details/'.$app->id)}}">View details</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="pages text-center">
            {{ $applications->links() }}
        </div>
    </div>
@stop
@section('custom_scripts')
    
@stop
