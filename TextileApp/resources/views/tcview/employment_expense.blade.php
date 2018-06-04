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
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}
        <button type="button" class="close" data-dismiss="alert">×</button></em>
        </div>
        @endif
    <center><h1 style="color: #b30000;"> Employment Status and Expenses  </h1></center>
    <!-- <form action="/employmentexpenseupdate" method="post"> -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="districtcode" hidden>
    <input type="hidden" name="batchtype" hidden>
    <table style="width: 100%;">
    <tr>
        <td ></td><td>&nbsp&nbsp&nbsp&nbsp</td><th style="text-align: right;">District:<span data-field="district" id="district" name="district"></span>
        <br>Division:<span data-field="division" id="division" name="division"></span></th>
    </tr>
    <tr><td>&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp</td><td>&nbsp</td></tr>
    <tr>
    <td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select class="form-control" id="sel1" name="fiscalyear" required>
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
                <label>Select Training Centre:</label><br>
                @foreach ($tcname as $tc)
                <input type="hidden" class="form-control" id="tc" name="tc" value="{{ $tc->centre_id}}" required readonly>
                <input type="text" class="form-control" id="tcname" name="tcname" value="{{ $tc->centre_name}}" required readonly>
                @endforeach                
        </div>
    </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label>Select Batch:</label><br>
                <select name="batch" class="form-control" style="width:350px" required>
                    <option value="">--- Select Batch ---</option>
                </select>
            </div>
        </td>
        <td></td>
        <td>
        <label>Batch Type:</label><br>
        <input type="text" class="form-control" id="type" name="type" required readonly></td>
    </tr>
    <tr><td>&nbsp</td><td></td><td>&nbsp</td></tr>
</table> 
<div><h2>Candidate List :-</h2><br></div>
<div id="view"></div>
<div class="form-group">
<table>
<tr>
    <td><label>Employment expense:</label></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input class="form-control" id="expense" name="expense" required ></td>
</tr>
</table>
</div>
<div id="btnview"></div>
<!-- <button type="submit" class="btn btn-primary" style="margin-left: 70%;width: 30%;">Submit</button> -->
<!-- </form> -->
</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        var batch,tc,expense,academicyear,type;
        var candidatearr=[];
        $('select[name="fiscalyear"]').on('change', function() {
            var fy = $(this).val();
            if(fy) {
                $.ajax({
                    url: '/employmentexpense/ajax/'+fy,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="batch"]').empty();
                        // $('select[name="batch"]').append('<option value="'select'">-----Select-----</option>');
                        var count=0;
                        $.each(data, function(key, value) {
                           if(count==0){
                            $('select[name="batch"]').append('<option value="">-----Select Batch-----</option>'); 
                            }
                            $('select[name="batch"]').append('<option value="'+ key +'">'+ value +'</option>');
                            count++;
                        });
                    }

                });
            }else{
                $('select[name="batch"]').empty();
            }
        });
        $('select[name="batch"]').on('change', function() {
            batch = $(this).val();
                    $("[data-field='district']").text("");
                    $("[data-field='division']").text("");
                    $("input[name='districtcode']").val("");
            var arr=[];
            var row = '<meta name="csrf-token" content="{{ csrf_token() }}" /><table class="table table-bordered"><tr><th hidden></th><th>Candidate ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Category</th><th>Employed</th><th>Industry Type</th><th></th></tr>';       
            var btn;
            if(batch) {
                $.ajax({
                    url: '/employmentexpense/batchajax/'+batch,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                    $("[data-field='district']").text(data[0].district_name);
                    $("[data-field='division']").text(data[0].division);
                    $("input[name='districtcode']").val(data[0].district_id);
                    $("input[name='type']").val(data[0].batch_type);
                    $.each(data[0].candidate, function (i, item) {
                    // row += '<tr><form action="/employmentexpenseupdate" method="post"><input type="hidden" name="_token" value="{{ csrf_token() }}"><td hidden><input type="hidden" name="candidateid" value='+item.candidate_id+'></td><td>' + item.candidate_id + '</td><td>' + item.first_name + '</td><td>' + item.last_name + '</td><td>' + item.gender + '</<td><td>' + item.batch_type + '</td><td><input type="radio" name="status" value="Yes"> Yes<br>' +'<input type="radio" name="status" value="No"> No<br></td><td><select name="industry"><option value="">-----Select-----</option><option value="Industries">Industries</option> '+
                    //     ' <option value="Own">Own</option> <option value="Group Activity">Group Activity</option><option value="Others">Others</option></select> </td><td><button type="submit" class="btn  btn-danger saveTest"  data-toggle="modal" data-target="#myModal" data-id="' + item.candidate_id+ '">Save</button></td></form></tr>';
                    row += '<tr><td>' + item.candidate_id + '</td><td>' + item.first_name + '</td><td>' + item.last_name + '</td><td>' + item.gender + '</<td><td>' + item.batch_type + '</td><td><input type="radio" name="status'+ item.candidate_id +'" value="Yes"> Yes<br>' +'<input type="radio" name="status'+ item.candidate_id +'" value="No"> No<br></td><td><select name="industry'+ item.candidate_id +'"><option value="">-----Select-----</option><option value="Industries">Industries</option> '+
                        ' <option value="Own">Own</option> <option value="Group Activity">Group Activity</option><option value="Others">Others</option></select> </td><td><button class="btn  btn-danger saveTest"  data-toggle="modal" data-target="#myModal" data-id="' + item.candidate_id+ '">Save</button></td></form></tr>';

                });
                row+='</table>';
                $('#view').html('');
                $('#view').append(row);
                btn = '<button type="submit" class="btn btn-primary submitTest" style="margin-left: 70%;width: 30%;">Submit</button>';
                $('#btnview').html('');
                $('#btnview').append(btn);
                    },
                    error: function(e) {
                        // alert('fail');
                    console.log(e.responseText);
                    }
                });
            }else{
                $('select[name="batch"]').empty();
            }
        });
        $(document).on('click', '.saveTest', function () {
            var id = $(this).attr('data-id');            
            tc = $('input[name="tc"]').val();
            academicyear = $('select[name="fiscalyear"]').val();
            type = $("input[name='type']").val();            
            // var expense = $('input[name="expense"]').val();
            // alert(tc+"  "+batch+"  "+id);
            var status = 'status'+id;
            // alert(status);
            var statusval = $("input[name="+status+"]:checked").val();
            // alert(statusval);  
            var industry = 'industry'+id;
            // alert(industry);
            var industryval = $("select[name="+industry+"]").val();
            var obj={"tc": tc ,"batch": batch ,"candidateid": id , "status": statusval , "type": type,"industry": industryval};
            candidatearr.push(obj);
            // alert(industryval);           
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // var id = $(this).attr('data-id');
            // $.ajax({
            //     url: '/employmentexpenseupdate',
            //     type: "POST",
            //     data: {_token: CSRF_TOKEN ,candidateid: $(this).attr('data-id')},
            //     dataType: "json",
            //     success: function (data) {
            //         // alert('success'+data.msg);
            //         alert('Removed successfully!!');
            //     }
            // });
        });
        $(document).on('click', '.submitTest', function () {
            // alert(tc+"  "+batch);
            // alert(JSON.stringify(candidatearr));
            expense = $("input[name='expense']").val();
            // alert(expense);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/employmentexpenseupdate',
                type: "POST",
                data: {_token: CSRF_TOKEN ,"tc": tc,"batch": batch,"fiscalyear": academicyear,
                "expense": expense,"candidatearr": candidatearr,"type": type},
                dataType: "json",
                success: function (data) {
                    // alert('success'+data.msg);
                    alert('Added successfully!!');
                }
            });
        });
    });
</script>

@stop
