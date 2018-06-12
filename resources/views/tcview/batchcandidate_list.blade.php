<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')

 <div class="row" id="targetcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.sidebar')
        </div>
        <!-- main content -->
        <div id="targetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
    <center><h1 style="color: #b30000;"> Batch - Candidate List </h1></center>
    <!-- <form action="" method="post"> -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="mappingdistrictcode" hidden>
    <!-- <span data-field="districtcode" id="districtcode" name="districtcode" hidden></span> -->
    <table style="width: 100%;">
    <tr>
        <td ></td><td>&nbsp&nbsp&nbsp&nbsp</td><th style="text-align: right;">District:<span data-field="mappingdistrict" id="mappingdistrict" name="mappingdistrict"></span>
        <br>Division:<span data-field="mappingdivision" id="mappingdivision" name="mappingdivision"></span></th>
    </tr>
    <tr><td>&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp</td><td>&nbsp</td></tr>
    <tr>
    <td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select class="form-control" id="sel1" name="mappingfiscalyear" required>
        <option value="">-----Select Academic Year-----</option>
        @foreach ($academicyear as $key )
        <option value="{{ $key->academic_year }}">{{ $key->academic_year }}</option>
        @endforeach
        <!-- <option value="2018-2019">2018-2019</option> -->
        <!-- <option value="2019-2020">2019-2020</option> -->
        </select>
    </div>
    </td><td></td>
    <td>
        <div class="form-group">
                <label>Select Training Subject:</label><br>
                <select name="mappingsubject" class="form-control" style="width:350px" required>
                    <option value="">--- Select Subject ---</option>
                    @foreach ($tbinfo as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
        </div>
    </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label>Select Batch:</label><br>
                <select name="mappingbatch" class="form-control" style="width:350px" required>
                <!-- <option value="">--- Select Batch ---</option> -->
                </select>
            </div>
        </td>
        <td></td>
        <th><div class="form-group">
        <label>Batch Timing:</label><br>
        <!-- <span data-field="timing"></span> -->
        <input type="text" class="form-control" id="mappingtiming" name="mappingtiming" required readonly>
        </div>
        </th>
    </tr>
    <tr><td>&nbsp</td><td></td><td>&nbsp</td></tr>
    <tr>
        <th>Category Type:<span data-field="mappingtype" id="mappingtype" name="mappingtype"></span>
        </th><td></td>
        <th>Training Subject:<span data-field="mappingtsubject" id="mappingtsubject" name="mappingtsubject"></th>
    </tr>    
</table> <br><br>
<div id="myview">@include('candidate.blade.php')</div>
<div id="view"></div>
<!-- <button type="submit" class="btn btn-primary" style="margin-left: 70%;width: 30%;">Submit</button> -->
<!-- </form> -->
</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {        
        $('select[name="mappingsubject"]').on('change', function() {
            var fy=$('select[name="mappingfiscalyear"]').val();
            var subject = $(this).val();
            if(subject) {
                $.ajax({
                    url: '/candidatelist/ajax/'+subject+'/'+fy,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="mappingbatch"]').empty();
                        // $('select[name="batch"]').append('<option value="'select'">-----Select-----</option>');
                        var count=0;
                        $.each(data, function(key, value) {
                            if(count==0){
                            $('select[name="mappingbatch"]').append('<option value="">-----Select Batch-----</option>');
                            }
                            $('select[name="mappingbatch"]').append('<option value="'+ key +'">'+ value +'</option>');
                            count++;
                        });
                    }

                });
            }else{
                $('select[name="mappingbatch"]').empty();
            }
        });
        $('select[name="mappingbatch"]').on('change', function() {
            var batch = $(this).val();
            // alert(batch);
            $("input[name='mappingtiming']").val("From: "+" To: ");
                    $("[data-field='mappingtsubject']").text("");
                    $("[data-field='mappingtype']").text("");
                    $("[data-field='mappingdistrict']").text("");
                    $("[data-field='mappingdivision']").text("");
                    $("input[name='mappingdistrictcode']").val("");

                    var row = '<meta name="csrf-token" content="{{ csrf_token() }}" /><table class="table table-bordered"><tr><th>Candidate ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Category</th><th>Education</th><th>Skill</th><th>Candidate Image</th><th></th></tr>';
            if(batch) {
                $.ajax({
                    url: '/candidatelist/batchajax/'+batch,
                    type: "GET",
                    dataType: "json",
                    success:function(data) { 
                    console.log(data[0].candidate); 
                        // alert('success');
                    $("input[name='mappingtiming']").val("From: "+ data[0].start_date+" To: "+data[0].end_date);
                    $("[data-field='mappingtsubject']").text(data[0].batch_type);
                    $("[data-field='mappingtype']").text(data[0].centre_type);
                    $("[data-field='mappingdistrict']").text(data[0].district_name);
                    $("[data-field='mappingdivision']").text(data[0].division);
                    $("input[name='mappingdistrictcode']").val(data[0].district_id);

                    // row = '<meta name="csrf-token" content="{{ csrf_token() }}" /><table class="table table-bordered"><tr><th>Candidate ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Category</th><th>Education</th><th>Skill</th><th></th></tr>';
                    $.each(data[0].candidate, function (i, item) {
                    row += '<tr><td>' + item.candidate_id + '</td><td>' + item.first_name + '</td><td>' + item.last_name + '</td><td>' + item.gender + '</<td><td>' + item.category + '</td><td>' + item.education + '</td><td>' + item.skill + '</td><td><input type="file" name="image'+item.candidate_id+'" class="form-control" id="file'+item.candidate_id+'"><button class="btn  btn-danger uploadTest"  data-toggle="modal" data-target="#myModal" data-id="' + item.candidate_id+ '">Submit</button></td><td><button class="btn  btn-danger saveTest"  data-toggle="modal" data-target="#myModal" data-id="' + item.candidate_id+ '">Remove</button></td></tr>';
                });
                row+='</table>';
                $('#view').html('');
                $('#view').append(row);
                
                    },
                    error: function(e) {
                        // alert('fail');
                    console.log(e.responseText);
                    }
                });
            }else{
                $('select[name="mappingbatch"]').empty();
            }
        });

         $(document).on('click', '.saveTest', function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/batchcandidatedelete',
                type: "POST",
                data: {_token: CSRF_TOKEN ,candidateid: $(this).attr('data-id')},
                dataType: "json",
                success: function (data) {
                    // alert('success'+data.msg);
                    alert('Removed successfully!!');
                }
            });
        });

         $(document).on('click', '.uploadTest', function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-id');
            var photo=$('input[name="image'+id+'"]').val();
            var file = document.getElementById('file'+id).files[0];
            alert(file);
            $.ajax({
                url: '/candidatephotoupload',
                type: "POST",
                data: {_token: CSRF_TOKEN ,'candidateid': $(this).attr('data-id'),'photo': $('input[name="image'+id+'"]')},
                mimeType: "multipart/form-data",
                success: function (data) {
                    // alert('success'+data.msg);
                    alert('Uploaded successfully!!');
                }
            });
            // alert(id);
            // var image = $("#file"+id)[0].files[0];
            // alert(image);
        });
    });
</script>
@stop
