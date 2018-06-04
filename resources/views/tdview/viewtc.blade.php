
@extends('layouts.sidebar')
@section('content')

   <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
   
 <div class="row" id="viewbatchcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
        <h1 style="color: #b30000;">Training Centre List</h1>
        <table class="table table-bordered">
        <tr>           

            <th>ID</th><th>Owner Name</th><th>Center ID</th><th>District ID</th><th>Upload Picture</th><th>street</th><th>district</th><th>state</th><th>PIN Code</th><th>Email</th><th>Mobile number</th><th>landline</th><th>website_id</th><th>PAN Card</th><th>PAN image</th><th>GST</th><th>GST Image</th><th>Training_start</th><th>Adhar Card</th><th>Adhar Image</th><th>Center Type</th><th>Training Subject</th><th>Center Status</th><th>Update</th><th>Delete</th>
        </tr>
            @foreach($tcinfo as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->centre_id}}</td>
                <td>{{$row->district_id}}</td>
                <td>{{$row->upload_pic}}</td>
                <td>{{$row->street}}</td>
                <td>{{$row->district}}</td>
                <td>{{$row->state}}</td>
                <td>{{$row->pin_code}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->mobile_number}}</td>
                <td>{{$row->landline}}</td>
                <td>{{$row->website_id}}</td>
                <td>{{$row->pan_card}}</td>
                <td>{{$row->pan_card_image}}</td>
                <td>{{$row->gst}}</td>
                <td>{{$row->gst_image}}</td>
                <td>{{$row->training_start}}</td>
                <td>{{$row->adhar_card}}</td>
                <td>{{$row->adhar_card_image}}</td>
                <td>{{$row->centre_type}}</td>
                <td>{{$row->training}}</td>
                <td>{{$row->centre_status}}</td>
                <td>
                    <form id="viewtcedit.{{$row->centre_id}}" action="{{ url('viewtcedit/'.$row->centre_id) }}" method="POST">
                    {{ csrf_field() }}<a onclick="document.getElementById('viewtcedit.{{$row->centre_id}}').submit();"><i class="glyphicon glyphicon-edit"></i></a></form>
                </td>
                <td>
                    <form id="deleteform.{{$row->centre_id}}" action="{{ url('deletetcview/'.$row->centre_id) }}" method="POST">
                    {{ csrf_field() }}<a onclick="document.getElementById('deleteform.{{$row->centre_id}}').submit();"><i class="glyphicon glyphicon-trash"></i></a></form>                    
                </td>           
            </tr>
            @endforeach
        </table>
        </div>
</div>   
@stop
