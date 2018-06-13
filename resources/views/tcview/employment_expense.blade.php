<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')
 <div class="row" id="viewtargetcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.sidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
    <center><h1 style="color: #b30000;"> Employment Expense  </h1></center>
               <form action="{{ URL::to('employmentexpense') }}" method="get">

    <!-- <span data-field="districtcode" id="districtcode" name="districtcode" hidden></span> -->
    <table style="width: 100%;">
   
    <tr><td>&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp</td><td>&nbsp</td></tr>
    <tr>
    <td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select onchange="this.form.submit()" class="form-control" id="vsel1" name="vfiscalyear" required>
        <option value="">-----Select Academic Year-----</option>
        @foreach ($data['academicyear'] as $key )
        <option value="{{ $key->academic_year }}" {{( $key->academic_year == $data['acyear'] ) ? 'selected' : ''}}>{{ $key->academic_year }}</option>
        @endforeach
        <!-- <option value="2018-2019">2018-2019</option> -->
        <!-- <option value="2019-2020">2019-2020</option> -->
        </select>
    </div>
    </td><td></td>
    <td>
        <div class="form-group">
                <label>Select Training Centre:</label><br>
                <select name="vtc" class="form-control" style="width:350px" required>
                    <option value="{{ $data['tc'] }}" >{{ $data['tcs'] }}</option>
                </select>   
        </div>
    </td>
    </tr>
    <tr>
        <td>
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="vdistrictcode" hidden>
            <div class="form-group">
                <label>Select Batch:</label><br>
                <select  name="vbatch" onchange="this.form.submit()" class="form-control" style="width:350px" required>
                <option value="">--- Select Batch ---</option>
                    @foreach ($data['batchlist'] as $key => $value)
                    <option value="{{ $key }}"  {{( $key == $data['batchid'] ) ? 'selected' : ''}}>{{ $value }}</option>
                    @endforeach
                   
                </select>
            </div>
            </form>
        </td>
        <td></td>
        
    </tr>
   
</table> <br><br>
 <form method="Post" action="/employmentexpenseupdate">

@if(!$data['candidate']->isEmpty())
<h1 id="heading">Candidate List</h1>
<div class="row">
<table class="table table-bordered">
 <thead>
      <tr>
        <th>Candidate Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Category</th>
        <th>Employed</th>
        <th>Industry Type</th>
      </tr>
 </thead>
 
 @foreach ($data['candidate'] as $key => $c)
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="tcid" hidden value="{{  $data['tc'] }}">
    <input type="hidden" name="baid" hidden value="{{  $data['batchid'] }}">
    <input type="hidden" name="acyear" hidden value="{{  $data['acyear'] }}">
    
    <input type="hidden" name="cand_id[]" hidden value="{{ $c->candidate_id }}">
    <tr><td>{{$c->candidate_id}}</td>
        <td>{{$c->first_name}}</td>
        <td>{{$c->last_name}}</td>
        <td>{{$c->gender}}</td>
        <td>{{$c->category}}</td>
        <td><input type="radio" name="employ{{ $key }}" value="YES" > Yes<br>
            <input type="radio" name="employ{{ $key }}" value="NO" checked="checked"> No<br></td>
            <td>
                <select name="indus_type[]">
                  <option value="Industries">Industries</option>
                  <option value="Own">Own</option>
                  <option value="Group Activity">Group Activity</option>
                  <option value="Others">Others</option>
                </select> 
            </td>
   
    </tr>

 @endforeach

  
 </table>
</div>
 <div> 
    <label>Employment Expense : </label>
    <input type="number" name="batch_expense" value="">
    <button type="submit" class="btn btn-primary" >Submit</button></td>
</div>
 @endif
</form>

</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="vfiscalyear"]').on('change', function() {
            var fy = $('select[name="vfiscalyear"]').val();
            if(fy) {
                $.ajax({
                    url: '/approvepftarget/ajax/'+fy,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                                       alert(fy);

                    }

                });
            }else{
                $('select[name="vbatch"]').empty();
            }
        });
       
        });
    
</script>

@stop
