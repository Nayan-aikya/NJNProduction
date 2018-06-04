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
    <center><h1 style="color: #b30000;"> Physical & Financial Target Approve</h1></center>
    @if(session()->has('message'))
  <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session()->get('message') }}
              </div>
@endif
    <form action="/approvetargets" method="post" id="form_id">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="vdistrictcode" hidden>
    <input type="hidden" name="batchid" id ="batchid" value="">
    <input type="hidden" name="status" id ="status" value="">

    <!-- <span data-field="districtcode" id="districtcode" name="districtcode" hidden></span> -->
    <table style="width: 100%;">
    <tr>
        <td ></td><td>&nbsp&nbsp&nbsp&nbsp</td><th style="text-align: right;">District:<span data-field="vdistrict" id="dvistrict" name="vdistrict"></span>
        <br>Division:<span data-field="vdivision" id="vdivision" name="vdivision"></span></th>
    </tr>
    <tr><td>&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp</td><td>&nbsp</td></tr>
    <tr>
    <td>
    <div class="form-group">
        <label>Financial Year:</label><br>
        <select class="form-control" id="vsel1" name="vfiscalyear" required>
        <option value="">-----Select Academic Year-----</option>
        <option value="2018-2019">2018-2019</option>
        <option value="2019-2020">2019-2020</option>
        </select>
    </div>
    </td><td></td>
    <td>
        <div class="form-group">
                <label>Select Training Centre:</label><br>
                <select name="vtc" class="form-control" style="width:350px" required>
                    <option value="">--- Select TC ---</option>
                    @foreach ($tcs as $key => $value)
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
                <select name="vbatch" class="form-control" style="width:350px" required>
                <!-- <option value="">--- Select Batch ---</option> -->
                </select>
            </div>
        </td>
        <td></td>
        <th><div class="form-group">
        <label>Batch Timing:</label><br>
        <!-- <span data-field="timing"></span> -->
        <input type="text" class="form-control" id="vtiming" name="vtiming" required readonly>
        </div>
        </th>
    </tr>
    <tr><td>&nbsp</td><td></td><td>&nbsp</td></tr>
    <tr>
        <th>Category Type:<span data-field="vtype" id="vtype" name="vtype"></span>
        </th><td></td>
        <th>Training Subject:<span data-field="vsubject" id="vsubject" name="vsubject"></th>
    </tr>    
</table> <br><br>

<table class="table table-bordered" >
    <tr>
        <th rowspan="2">Sl no</th><th rowspan="2">Category type</th><th colspan="3">Physical target in no</th><th colspan="3">Financial target</th>
    </tr>
    <tr>
        <td>Male</td><td>Female</td><td>Total</td>
    </tr>
    <tr>
        <td>1</td><th>General</th>
        <td><input required readonly class="tinf" type="number" name="vgenpm" id="vone" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vgenpf" id="vtwo" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vgenpt" id="vavvy" value="" readonly></td>
         
    </tr>
    <tr>
        <td>2</td><th>SCP</th>
        <td><input required readonly class="tinf" type="number" name="vscppm" id="vfive" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vscppf" id="vsix" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vscppt" id="vavvy2" value="" readonly></td>
           
    </tr>
    <tr>
        <td>3</td><th>TSP</th>
        <td><input required readonly class="tinf" type="number" name="vtsppm" id="vnine" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vtsppf" id="vten" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" name="vtsppt" id="vavvy4" value="" readonly></td>
         
    </tr>
    <tr>
        <td>4</td><th>Minorities</th>
        <td><input required readonly class="tinf" type="number" name="vminpm" id="vthirteen" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vminpf" id="vfourteen" OnChange="av(this)"></td>
        <td><input required readonly class="tinf" type="number" name="vminpt" id="vavvy6" value="" readonly></td>
        
    </tr>
    <tr>
        <td></td><th>Total</th>
        <td><input required readonly class="tinf" type="number" name="vtotpm" id="vt0" value="" readonly></td>
        <td><input required readonly class="tinf" type="number" name="vtotpf" id="vt1" value="" readonly></td>
        <td><input required readonly class="tinf" type="number" name="vtotpt" id="vt2" value="" readonly></td>
      
    </tr>
</table>
<div align="right">
    <button type="submit" class="btn btn-success sub" onclick="myFunction('approve')">Approve</button>
    <button type="submit" class="btn btn-primary sub"  onclick="myFunction('reject')">Reject</button>
</div>
</form>
</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="vtc"]').on('change', function() {
            var tc = $(this).val();
            if(tc) {
                $.ajax({
                    url: '/viewpftarget/ajax/'+tc,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="vbatch"]').empty();
                        // $('select[name="batch"]').append('<option value="'select'">-----Select-----</option>');
                        $.each(data, function(key, value) {
                            $('select[name="vbatch"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }

                });
            }else{
                $('select[name="vbatch"]').empty();
            }
        });
        $('select[name="vbatch"]').on('change', function() {

            var batch = $(this).val();
            document.getElementById("batchid").value = batch;
            if(batch) {
                $.ajax({
                    url: '/viewpftarget/batchajax/'+batch,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                        // alert('success');
                    $("input[name='vtiming']").val("From: "+ data[0].start_date+" To: "+data[0].end_date);
                    $("[data-field='vsubject']").text(data[0].batch_type);
                    $("[data-field='vtype']").text(data[0].centre_type);
                    $("[data-field='vdistrict']").text(data[0].district_name);
                    $("[data-field='vdivision']").text(data[0].division);
                    $("input[name='vdistrictcode']").val(data[0].district_id);
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
function myFunction(status){

document.getElementById("status").value = status;
document.getElementById("form_id").submit();// Form submission


}
</script>

@stop
