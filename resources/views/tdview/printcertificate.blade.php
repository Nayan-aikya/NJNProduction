
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')
@section('content')

 <div class="row" id="viewtargetcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
    <center><h1 style="color: #b30000;"> Print Certificate </h1></center>
               <form action="{{ URL::to('printcertification') }}" method="get">

    <!-- <span data-field="districtcode" id="districtcode" name="districtcode" hidden></span> -->
    <table style="width: 100%;">
   
    <tr><td>&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp</td><td>&nbsp</td></tr>
    <tr>
    <td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select class="form-control" id="vsel1" name="vfiscalyear" required>
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
                    <option value="">--- Select Training Centre ---</option>
                    @foreach ($data['tcs'] as $key => $value)
                    <option value="{{ $key }}" {{( $key == $data['tc'] ) ? 'selected' : ''}}>{{ $value }}</option>
                    @endforeach
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
                <select onchange="this.form.submit()" name="vbatch" class="form-control" style="width:350px" required>
                <option value="">--- Select Batch ---</option>
                @if(!empty($data['batchid']))
                    @foreach ($data['batchlist'] as $key)
                    <option value="{{ $key->batch_id }}"  {{( $key->batch_id == $data['batchid'] ) ? 'selected' : ''}}>{{ $key->batch_name }}</option>
                    @endforeach
                   
                @endif
                </select>
            </div>
            </form>
        </td>
        <td></td>
        
    </tr>
   
</table> <br><br>

<h1 id="heading">Candidate List</h1>
<table class="table table-bordered">
 <thead>
      <tr>
        <th>Candidate Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Print</th>
      </tr>
 </thead>
 @if(!empty($data['candidate']))
 @foreach ($data['candidate'] as $c)
    <tr><td>{{$c->candidate_id}}</td><td>{{$c->first_name}}</td><td>{{$c->last_name}}</td><td>{{$c->gender}}</td>
    <td>
       
            {{ csrf_field() }}
            <button  type="submit" class="btn btn-danger"><i></i> Print</button>
    </td>
    </tr>
 @endforeach
 @endif
 </table>

</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="vtc"]').on('change', function() {
            var tc = $(this).val();
            var fy = $('select[name="vfiscalyear"]').val();
            if(tc) {
                $.ajax({
                    url: '/approvepftarget/ajax/'+tc+'/'+fy,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="vbatch"]').empty();
                        // $('select[name="batch"]').append('<option value="'select'">-----Select-----</option>');
                        var count=0;
                        $.each(data, function(key, value) {
                            if(count==0){
                            $('select[name="vbatch"]').append('<option value="">-----Select Batch-----</option>'); 
                            }
                            $('select[name="vbatch"]').append('<option value="'+ key +'">'+ value +'</option>');
                            count++;
                        });
                    }

                });
            }else{
                $('select[name="vbatch"]').empty();
            }
        });
       
        });
    
</script>

@stop
