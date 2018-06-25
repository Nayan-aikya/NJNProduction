<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
<div class="row" id="batchcreatecontainer">
<div id="sidebar" class="col-md-3">
@include('includes.sidebar')
</div>
<div id="targetcontent" class="col-md-9">
		@if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
<h1 id="heading">Batch Creation</h1>
<form action="{{ url('/batchcreate') }}" method="post">
{{csrf_field()}}
<table style="width: 80%;" cellspacing="15">
<tr>
<td>
        <label>Financial Year: <span class="star">*</span></label><br>
        <select class="form-control" id="sel1" name="fiscalyear" required>
        <option value="">-----Select Academic Year-----</option>
        @foreach ($academicyear as $key )
        <option value="{{ $key->academic_year }}">{{ $key->academic_year }}</option>
        @endforeach
        <!-- <option value="2018-2019">2018-2019</option>
        <option value="2019-2020">2019-2020</option> -->
        </select>    
</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><br><label>Batch Name: <span class="star">*</span></label><br>
<input class="form-control" type="text" name="batchname" required><br>
                @if ($errors->has('batchname'))

                    <span class="text-danger">{{ $errors->first('batchname') }}</span>

                @endif
</td>
</tr>
<tr>
<td><br><label>Start Date: <span class="star">*</span></label><br>
<input  class="form-control" type="date" name="startdate" required><br>
                @if ($errors->has('startdate'))

                    <span class="text-danger">{{ $errors->first('startdate') }}</span>

                @endif
</td>	
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><br><label>End Date: <span class="star">*</span></label><br>
<input  class="form-control" type="date" name="enddate" required><br>
                @if ($errors->has('enddate'))

                    <span class="text-danger">{{ $errors->first('enddate') }}</span>

                @endif
</td>
</tr>
<tr><td colspan="1"><label>Number of Candidates: <span class="star">*</span></label><br>
<input class="form-control" type="number" name="noofstud" required></td><br>
                @if ($errors->has('noofstud'))

                    <span class="text-danger">{{ $errors->first('noofstud') }}</span>

                @endif
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><label>Training Type: <span class="star">*</span></label><br>

<!-- <div class="form-group"> -->
                <!-- <label>Select Batch:</label><br> -->
                <select name="trainingtype" class="form-control" style="width:350px" required>
                    <option value="">--- Select TrainingType ---</option>
                    @foreach ($trainingtype as $key )
                    <option value="{{ $key->subjects }}">{{ $key->subjects }}</option>
                    @endforeach
                </select>               
<!-- </div> -->
<!-- <input  class="form-control" type="text" name="trainingtype" required><br></td></tr> -->
<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="1"><br><button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button></td></tr>
</table>
</form>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="trainingtype"]').on('change', function() {
            var type = $(this).val();
            if(type) {
                $.ajax({
                    url: '/batchcreate/'+type,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {    
                    	var no = $("input[name='noofstud']").val();   
                    	// alert(no +"  "+data[0].no_of_candidate);                
                    	if(parseFloat(no)>parseFloat(data[0].no_of_candidate))
                    	{
                    		alert("Batch size shouldn't exceed..."+data[0].no_of_candidate);
                    		$("input[name='noofstud']").val("")
                    	}
                    }

                });
            }else{
                $('select[name="trainingtype"]').empty();
            }
        });
});
</script>
@stop