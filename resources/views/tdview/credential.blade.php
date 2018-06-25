<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
 <div class="row" id="targetcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
        <div id="targetcontent" class="col-md-9">
    <h1 style="color: #b30000;" align="Center"> Credentials </h1>
    <div align="right"><b>District :  {{ $district }}</b></div><br>
@if(session()->has('success'))           
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session()->get('success') }}
              </div>
        @endif
@if(!empty($tcinfo) && count($tcinfo) > 0)

<div id="view">
   <table class="table table-bordered">
         <thead>
         <tr>
            <th>Training Center ID</th>
            <th>Training Center Name</th>
            <th>Username</th>
            <th>Password</th>
            <th></th>
         </tr>
         </thead>
         <tbody>
            @foreach($tcinfo as $user)
            <form action="{{ url('fetchdistrictwisetc/') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="centreid" value ="{{ $user->centre_id }}" >
                <input type="hidden" name="type" value ="TC" >
                 <input type="hidden" name="district" value ="{{ $district }}" >
            <tr>
               <td>{{ $user->centre_id }}</td>
               <td>{{ $user->centre_name }}</td>
               <td><input type="text" name="username" value ="{{ $user->username }}" ></td>
               <td><input type="text" name="password" value ="" ></td>
               <td><input type="submit" name="" value ="Update" ></td>
            </tr>
            
            </form>

            @endforeach
         </tbody>
      </table>
      {{ $tcinfo->links() }}
</div>

@endif
</div>
</div>  
@stop
