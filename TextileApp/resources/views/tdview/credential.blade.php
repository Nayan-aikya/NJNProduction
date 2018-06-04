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
    <h1 style="color: #b30000;"> Credential </h1>
    <table>
    <tr><td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select class="form-control" id="sel1" name="fiscalyear" required>
        <option value="">-----Select Academic Year-----</option>
        <!-- <option value="2018-2019">2018-2019</option> -->
        <!-- <option value="2019-2020">2019-2020</option> -->
        @foreach ($academicyear as $key )
        <option value="{{ $key->academic_year }}">{{ $key->academic_year }}</option>
        @endforeach
        </select>
    </div>
    </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
        <div class="form-group">   
              <label for="usr">District:</label><br>
              <select class="form-control" id="sel1" name="district" required>
              <option value="" disabled selected>Select your District</option>
              @foreach ($districts as $district)
              <option value="{{ $district->district_code }}">{{ $district->district_name}}</option>
              @endforeach
              </select>
        </div>
    </td>
    </tr>   
</table> <br><br>
<div id="view"></div>
</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="district"]').on('change', function() {
            var district = $(this).val();
            if(district) {
                $.ajax({
                    url: '/fetchdistrictwisetc/ajax/'+district,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                         var row = '<meta name="csrf-token" content="{{ csrf_token() }}" /><table class="table table-bordered"><tr><th>Center Id</th><th>Centre Name</th><th>District</th><th>Username</th><th>Password</th><th></th></tr>';
                $.each(data, function (i, item) {
                    row += '<tr><td>' + item.centre_id + '</td><td>' + item.centre_name + '</td><td>' + item.district + '</td><td hidden><input type="text" class="form-control" id="credentialdistrict' + item.centre_id + '" name="district" value="' + item.district + '"></<td><td><input type="text" class="form-control" id="credentialuser' + item.centre_id + '" name="username"></<td><td><input type="text" class="form-control" id="credentialpass' + item.centre_id + '" name="password"></<td><td><button class="btn  btn-danger saveTest"  data-toggle="modal" data-target="#myModal" data-id="' + item.centre_id + '">Save</button></td></tr>';

                });
                row+='</table>';
                $('#view').html('');
                $('#view').append(row);
                }
                });
            }else{
            }
        });
        $(document).on('click', '.saveTest', function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-id');
            var username = $('#credentialuser'+id).val();
            var password = $('#credentialpass'+id).val();
            // alert($('#credentialuser'+id).val()+"   "+$('#credentialpass'+id).val()+"   "+$('#credentialdistrict'+id).val());
            $.ajax({
                url: '/fetchdistrictwisetc',
                type: "POST",
                data: {_token: CSRF_TOKEN , type: 'TC',username: $('#credentialuser'+id).val() , password: $('#credentialpass'+id).val() , district: $('#credentialdistrict'+id).val() ,centreid: $(this).attr('data-id')},
                dataType: "json",
                success: function (data) {
                    // alert('success'+data.msg);
                }
            });
        });
        });
</script>
@stop
