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

    <center><h1 style="color: #b30000;"> Physical & Financial Target </h1></center>
    <button type="submit" class="btn btn-primary sub">Export To Pdf</button>
    <form action="/pftargetapproval" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="vdistrictcode" hidden>
    <!-- <span data-field="districtcode" id="districtcode" name="districtcode" hidden></span> -->
    <table style="width: 100%;">
    <tr><td>&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp</td><td>&nbsp</td></tr>
    <tr>
    <td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select class="form-control" id="vsel1" name="vfiscalyear" style="width:230px" required>
        <option value="">-----Select Academic Year-----</option>
        <!-- <option value="all">All</option> -->
        @foreach ($academicyear as $key )
        <option value="{{ $key->academic_year }}">{{ $key->academic_year }}</option>
        @endforeach
        </select>
    </div>
    </td>
    <td>
    <div class="form-group">
        <label>Select Training Centre:</label><br>
        <select name="vtc" class="form-control" style="width:300px" required>
        <option value="">--- Select Training Centre ---</option>
        <option value="all">All</option>
        @foreach ($tcs as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
        </select>   
    </div>
    </td>
    <td>
    <div class="form-group">
        <label>Select Batch:</label><br>
        <select name="vbatch" class="form-control" style="width:240px" required>
        <option value="">--- Select Batch ---</option>
        </select>
    </div>
    </td>
    </tr>
    <tr><td>&nbsp</td><td></td><td>&nbsp</td></tr>       
</table> <br><br>
<table class="table table-bordered" >
    <tr>
        <th rowspan="2">Sl no</th><th rowspan="2">Category type</th><th colspan="3">Physical target in no</th><th colspan="3">Finacial target in Rs</th>
    </tr>
    <tr>
        <td>Male</td><td>Female</td><td>Total</td><td>Male</td><td>Female</td><td>Total</td>
    </tr>
    <tr>
        <td>1</td><th>General</th>
        <td><input required class="tinf" type="number" name="vgenpm" id="vone" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vgenpf" id="vtwo" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vgenpt" id="vavvy" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vgenfm" id="vthree" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vgenff" id="vfour" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vgenft" id=vavvy1 value="" readonly></td>  
    </tr>
    <tr>
        <td>2</td><th>SCP</th>
        <td><input required class="tinf" type="number" name="vscppm" id="vfive" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vscppf" id="vsix" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vscppt" id="vavvy2" value="" readonly readonly></td>
        <td><input required class="tinf" type="number" name="vscpfm" id="vseven" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" name="vscpff" id="veight" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vscpft" id="vavvy3" value="" readonly></td>        
    </tr>
    <tr>
        <td>3</td><th>TSP</th>
        <td><input required class="tinf" type="number" name="vtsppm" id="vnine" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vtsppf" id="vten" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vtsppt" id="vavvy4" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vtspfm" id="vleven" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vtspff" id="vtwel" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vtspft" id="vavvy5" value="" readonly></td>        
    </tr>
    <tr>
        <td>4</td><th>Minorities</th>
        <td><input required class="tinf" type="number" name="vminpm" id="vthirteen" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vminpf" id="vfourteen" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vminpt" id="vavvy6" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vminfm" id="vfifteen" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vminff" id="vsixteen" OnChange="av(this)" readonly></td>
        <td><input required class="tinf" type="number" name="vminft" id="vavvy7" value="" readonly></td>      
    </tr>
    <tr>
        <td></td><th>Total</th>
        <td><input required class="tinf" type="number" name="vtotpm" id="vt0" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vtotpf" id="vt1" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vtotpt" id="vt2" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vtotfm" id="vt3" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vtotff" id="vt4" value="" readonly></td>
        <td><input required class="tinf" type="number" name="vtotft" id="vt5" value="" readonly></td>      
    </tr>
</table>
</form>
</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        var tc,fy;
        $('select[name="vfiscalyear"]').on('change', function() {
            $("input[name='vgenpm']").val("");
                    $("input[name='vgenpf']").val("");
                    $("input[name='vgenpt']").val("");
                    $("input[name='vtsppm']").val("");
                    $("input[name='vtsppf']").val("");
                    $("input[name='vtsppt']").val("");
                    $("input[name='vscppm']").val("");
                    $("input[name='vscppf']").val("");
                    $("input[name='vscppt']").val("");
                    $("input[name='vminpm']").val("");
                    $("input[name='vminpf']").val("");
                    $("input[name='vminpt']").val("");

                    $("input[name='vgenfm']").val("");
                    $("input[name='vgenff']").val("");
                    $("input[name='vgenft']").val("");
                    $("input[name='vtspfm']").val("");
                    $("input[name='vtspff']").val("");
                    $("input[name='vtspft']").val("");
                    $("input[name='vscpfm']").val("");
                    $("input[name='vscpff']").val("");
                    $("input[name='vscpft']").val("");
                    $("input[name='vminfm']").val("");
                    $("input[name='vminff']").val("");
                    $("input[name='vminft']").val("");


                    $("input[name='vtotpm']").val("");
                    $("input[name='vtotpf']").val("");
                    $("input[name='vtotpt']").val("");

                    $("input[name='vtotfm']").val("");
                    $("input[name='vtotff']").val("");
                    $("input[name='vtotft']").val(""); 
        });
        $('select[name="vtc"]').on('change', function() {
            tc = $(this).val();
            fy = $('select[name="vfiscalyear"]').val();
            $("input[name='vgenpm']").val("");
                    $("input[name='vgenpf']").val("");
                    $("input[name='vgenpt']").val("");
                    $("input[name='vtsppm']").val("");
                    $("input[name='vtsppf']").val("");
                    $("input[name='vtsppt']").val("");
                    $("input[name='vscppm']").val("");
                    $("input[name='vscppf']").val("");
                    $("input[name='vscppt']").val("");
                    $("input[name='vminpm']").val("");
                    $("input[name='vminpf']").val("");
                    $("input[name='vminpt']").val("");

                    $("input[name='vgenfm']").val("");
                    $("input[name='vgenff']").val("");
                    $("input[name='vgenft']").val("");
                    $("input[name='vtspfm']").val("");
                    $("input[name='vtspff']").val("");
                    $("input[name='vtspft']").val("");
                    $("input[name='vscpfm']").val("");
                    $("input[name='vscpff']").val("");
                    $("input[name='vscpft']").val("");
                    $("input[name='vminfm']").val("");
                    $("input[name='vminff']").val("");
                    $("input[name='vminft']").val("");


                    $("input[name='vtotpm']").val("");
                    $("input[name='vtotpf']").val("");
                    $("input[name='vtotpt']").val("");

                    $("input[name='vtotfm']").val("");
                    $("input[name='vtotff']").val("");
                    $("input[name='vtotft']").val("");
            if(tc=="all"){
                $('select[name="vbatch"]').empty();
                $('select[name="vbatch"]').append('<option value="">-----Select Batch-----</option>'); 
                            $('select[name="vbatch"]').append('<option value="all">All</option>'); 
            }
        else{
            if(tc) {
                $.ajax({
                    url: '/pfreport/ajax/'+tc+'/'+fy,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="vbatch"]').empty();
                        // $('select[name="batch"]').append('<option value="'select'">-----Select-----</option>');
                        var count=0;
                        $.each(data, function(key, value) {
                            if(count==0){
                            $('select[name="vbatch"]').append('<option value="">-----Select Batch-----</option>'); 
                            $('select[name="vbatch"]').append('<option value="all">All</option>'); 
                            }
                            $('select[name="vbatch"]').append('<option value="'+ key +'">'+ value +'</option>');
                            count++;
                        });
                    }

                });
            }else{
                $('select[name="vbatch"]').empty();
            }
        }
        });
        $('select[name="vbatch"]').on('change', function() {
            var batch = $(this).val();
                    $("input[name='vgenpm']").val("");
                    $("input[name='vgenpf']").val("");
                    $("input[name='vgenpt']").val("");
                    $("input[name='vtsppm']").val("");
                    $("input[name='vtsppf']").val("");
                    $("input[name='vtsppt']").val("");
                    $("input[name='vscppm']").val("");
                    $("input[name='vscppf']").val("");
                    $("input[name='vscppt']").val("");
                    $("input[name='vminpm']").val("");
                    $("input[name='vminpf']").val("");
                    $("input[name='vminpt']").val("");

                    $("input[name='vgenfm']").val("");
                    $("input[name='vgenff']").val("");
                    $("input[name='vgenft']").val("");
                    $("input[name='vtspfm']").val("");
                    $("input[name='vtspff']").val("");
                    $("input[name='vtspft']").val("");
                    $("input[name='vscpfm']").val("");
                    $("input[name='vscpff']").val("");
                    $("input[name='vscpft']").val("");
                    $("input[name='vminfm']").val("");
                    $("input[name='vminff']").val("");
                    $("input[name='vminft']").val("");


                    $("input[name='vtotpm']").val("");
                    $("input[name='vtotpf']").val("");
                    $("input[name='vtotpt']").val("");

                    $("input[name='vtotfm']").val("");
                    $("input[name='vtotff']").val("");
                    $("input[name='vtotft']").val("");
            if(batch) {
                $.ajax({
                    url: '/pftargetreport/'+batch+'/'+tc+'/'+fy,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                    $("input[name='vgenpm']").val(data[0].genpm);
                    $("input[name='vgenpf']").val(data[0].genpf);
                    $("input[name='vgenpt']").val(data[0].genpt);
                    $("input[name='vtsppm']").val(data[0].tsppm);
                    $("input[name='vtsppf']").val(data[0].tsppf);
                    $("input[name='vtsppt']").val(data[0].tsppt);
                    $("input[name='vscppm']").val(data[0].scppm);
                    $("input[name='vscppf']").val(data[0].scppf);
                    $("input[name='vscppt']").val(data[0].scppt);
                    $("input[name='vminpm']").val(data[0].minpm);
                    $("input[name='vminpf']").val(data[0].minpf);
                    $("input[name='vminpt']").val(data[0].minpt);

                    $("input[name='vgenfm']").val(data[0].genfm);
                    $("input[name='vgenff']").val(data[0].genff);
                    $("input[name='vgenft']").val(data[0].genft);
                    $("input[name='vtspfm']").val(data[0].tspfm);
                    $("input[name='vtspff']").val(data[0].tspff);
                    $("input[name='vtspft']").val(data[0].tspft);
                    $("input[name='vscpfm']").val(data[0].scpfm);
                    $("input[name='vscpff']").val(data[0].scpff);
                    $("input[name='vscpft']").val(data[0].scpft);
                    $("input[name='vminfm']").val(data[0].minfm);
                    $("input[name='vminff']").val(data[0].minff);
                    $("input[name='vminft']").val(data[0].minft);


                    $("input[name='vtotpm']").val(parseInt(data[0].genpm)+parseInt(data[0].tsppm)+parseInt(data[0].scppm)+parseInt(data[0].minpm));
                    $("input[name='vtotpf']").val(parseInt(data[0].genpf)+parseInt(data[0].tsppf)+parseInt(data[0].scppf)+parseInt(data[0].minpf));
                    $("input[name='vtotpt']").val(parseInt(data[0].genpt)+parseInt(data[0].tsppt)+parseInt(data[0].scppt)+parseInt(data[0].minpt));

                    $("input[name='vtotfm']").val(parseInt(data[0].genfm)+parseInt(data[0].tspfm)+parseInt(data[0].scpfm)+parseInt(data[0].minfm));
                    $("input[name='vtotff']").val(parseInt(data[0].genff)+parseInt(data[0].tspff)+parseInt(data[0].scpff)+parseInt(data[0].minff));
                    $("input[name='vtotft']").val(parseInt(data[0].genft)+parseInt(data[0].tspft)+parseInt(data[0].scpft)+parseInt(data[0].minft));
                    },
                    error: function(e) {
                        // alert('fail');
                    console.log(e.responseText);
                    }
                });
            }else{
                $('select[name="vbatch"]').empty();
            }
        });
    });
</script>
@stop
