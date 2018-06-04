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
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <center><h1 style="color: #b30000;"> Physical & Financial Target </h1></center>
    <form action="/insertpftarget" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="districtcode" hidden>
    <input type="hidden" name="candidatecount" hidden>
    <input type="hidden" name="batchcandidate" hidden>
    <input type="hidden" name="totalcandidate" value="0" hidden>
    <input type="hidden" name="previousinput" value="0" hidden>
    <!-- <span data-field="districtcode" id="districtcode" name="districtcode" hidden></span> -->
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
        <!-- <option value="2018-2019">2018-2019</option>
        <option value="2019-2020">2019-2020</option> -->
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
        <th><div class="form-group">
        <label>Batch Timing:</label><br>
        <!-- <span data-field="timing"></span> -->
        <input type="text" class="form-control" id="timing" name="timing" required readonly>
        </div>
        </th>
    </tr>
    <tr><td>&nbsp</td><td></td><td>&nbsp</td></tr>
    <tr>
        <th>Category Type:<span data-field="type" id="type" name="type"></span>
        </th><td></td>
        <th>Training Subject:<span data-field="subject" id="subject" name="subject"></th>
    </tr>    
</table> <br><br>

<table class="table table-bordered" >
    <tr>
        <th rowspan="2">Sl no</th><th rowspan="2">Category type</th><th colspan="3">Physical target in no</th><th colspan="3">Financial target in Rs</th>
    </tr>
    <tr>
        <td>Male</td><td>Female</td><td>Total</td><td>Male</td><td>Female</td><td>Total</td>
    </tr>
    <tr>
        <td>1</td><th>General</th>
        <td><input required class="tinf" type="number" value="0" name="genpm" id="one" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="genpf" id="two" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="genpt" id="avvy" value="" readonly></td>
        <td><input required class="tinf" type="number" value="0" name="genfm" id="three" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="genff" id="four" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="genft" id=avvy1 value="" readonly></td>    
    </tr>
    <tr>
        <td>2</td><th>SCP</th>
        <td><input required class="tinf" type="number" value="0" name="scppm" id="five" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="scppf" id="six" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="scppt" id="avvy2" value="" readonly></td>
        <td><input required class="tinf" type="number" value="0" name="scpfm" id="seven" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="scpff" id="eight" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="scpft" id="avvy3" value="" readonly></td>      
    </tr>
    <tr>
        <td>3</td><th>TSP</th>
        <td><input required class="tinf" type="number" value="0" name="tsppm" id="nine" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="tsppf" id="ten" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="tsppt" id="avvy4" value="" readonly></td>
        <td><input required class="tinf" type="number" value="0" name="tspfm" id="leven" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="tspff" id="twel" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="tspft" id="avvy5" value="" readonly></td>      
    </tr>
    <tr>
        <td>4</td><th>Minorities</th>
        <td><input required class="tinf" type="number" value="0" name="minpm" id="thirteen" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="minpf" id="fourteen" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="minpt" id="avvy6" value="" readonly></td>
        <td><input required class="tinf" type="number" value="0" name="minfm" id="fifteen" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="minff" id="sixteen" OnChange="av(this)"></td>
        <td><input required class="tinf" type="number" value="0" name="minft" id="avvy7" value="" readonly></td>      
    </tr>
    <tr>
        <td></td><th>Total</th>
        <td><input required class="tinf" type="number"  name="totpm" id="t0"  readonly></td>
        <td><input required class="tinf" type="number" name="totpf" id="t1"  readonly></td>
        <td><input required class="tinf" type="number" name="totpt" id="t2" readonly></td>
        <td><input required class="tinf" type="number" name="totfm" id="t3" readonly></td>
        <td><input required class="tinf" type="number" name="totff" id="t4" readonly></td>
        <td><input required class="tinf" type="number" name="totft" id="t5" readonly></td>     
    </tr>
</table>
<button type="submit" class="btn btn-primary" style="margin-left: 70%;width: 30%;">Submit</button>
</form>
</div>
</div>    
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="fiscalyear"]').on('change', function() {
            var fy = $(this).val();
            if(fy) {
                $.ajax({
                    url: '/pftarget/ajax/'+fy,
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
            var batch = $(this).val();
            // alert(batch);
                    $("input[name='timing']").val("");
                    $("[data-field='subject']").text("");
                    $("[data-field='type']").text("");
                    $("[data-field='district']").text("");
                    $("[data-field='division']").text("");
                    $("input[name='districtcode']").val("");
                    $("input[name='batchcandidate']").val("");
                    $("input[name='candidatecount']").val("");
                    $("input[name='genpm']").val("0");
                    $("input[name='genpf']").val("0");
                    $("input[name='genpt']").val("0");
                    $("input[name='tsppm']").val("0");
                    $("input[name='tsppf']").val("0");
                    $("input[name='tsppt']").val("0");
                    $("input[name='scppm']").val("0");
                    $("input[name='scppf']").val("0");
                    $("input[name='scppt']").val("0");
                    $("input[name='minpm']").val("0");
                    $("input[name='minpf']").val("0");
                    $("input[name='minpt']").val("0");

                    $("input[name='genfm']").val("0");
                    $("input[name='genff']").val("0");
                    $("input[name='genft']").val("0");
                    $("input[name='tspfm']").val("0");
                    $("input[name='tspff']").val("0");
                    $("input[name='tspft']").val("0");
                    $("input[name='scpfm']").val("0");
                    $("input[name='scpff']").val("0");
                    $("input[name='scpft']").val("0");
                    $("input[name='minfm']").val("0");
                    $("input[name='minff']").val("0");
                    $("input[name='minft']").val("0");


                    $("input[name='totpm']").val("0");
                    $("input[name='totpf']").val("0");
                    $("input[name='totpt']").val("0");

                    $("input[name='totfm']").val("0");
                    $("input[name='totff']").val("0");
                    $("input[name='totft']").val("0");
            if(batch) {
                $.ajax({
                    url: '/pftarget/batchajax/'+batch,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                        // alert('success');
                    
                    $("input[name='timing']").val("From: "+ data[0].start_date+" To: "+data[0].end_date);
                    $("[data-field='subject']").text(data[0].batch_type);
                    $("[data-field='type']").text(data[0].centre_type);
                    $("[data-field='district']").text(data[0].district_name);
                    $("[data-field='division']").text(data[0].division);
                    $("input[name='districtcode']").val(data[0].district_id);
                    $("input[name='batchcandidate']").val(data[0].no_of_stud);
                    $("input[name='candidatecount']").val(data[0].candidate_count);
                    if(isNaN(data[0].genpm))
                    $("input[name='genpm']").val(0);
                    else
                    $("input[name='genpm']").val(data[0].genpm);
                    if(isNaN(data[0].genpf))
                    $("input[name='genpf']").val(0);
                    else
                    $("input[name='genpf']").val(data[0].genpf);
                    if(isNaN(data[0].genpt))
                    $("input[name='genpt']").val(0);
                    else
                    $("input[name='genpt']").val(data[0].genpt);
                    if(isNaN(data[0].tsppm))
                    $("input[name='tsppm']").val(0);
                    else
                    $("input[name='tsppm']").val(data[0].tsppm);
                    if(isNaN(data[0].tsppf))
                    $("input[name='tsppf']").val(0);
                    else
                    $("input[name='tsppf']").val(data[0].tsppf);
                    if(isNaN(data[0].tsppt))
                    $("input[name='tsppt']").val(0);
                    else
                    $("input[name='tsppt']").val(data[0].tsppt);
                    if(isNaN(data[0].scppm))
                    $("input[name='scppm']").val(0);
                    else
                    $("input[name='scppm']").val(data[0].scppm);
                    if(isNaN(data[0].scppf))
                    $("input[name='scppf']").val(0);
                    else
                    $("input[name='scppf']").val(data[0].scppf);
                    if(isNaN(data[0].scppt))
                    $("input[name='scppt']").val(0);
                    else
                    $("input[name='scppt']").val(data[0].scppt);
                    if(isNaN(data[0].minpm))
                    $("input[name='minpm']").val(0);
                    else
                    $("input[name='minpm']").val(data[0].minpm);
                    if(isNaN(data[0].minpf))
                    $("input[name='minpf']").val(0);
                    else
                    $("input[name='minpf']").val(data[0].minpf);
                    if(isNaN(data[0].minpt))
                    $("input[name='minpt']").val(0);
                    else
                    $("input[name='minpt']").val(data[0].minpt);

                    if(isNaN(data[0].genfm))
                    $("input[name='genfm']").val(0);
                    else
                    $("input[name='genfm']").val(data[0].genfm);
                    if(isNaN(data[0].genff))
                    $("input[name='genff']").val(0);
                    else
                    $("input[name='genff']").val(data[0].genff);
                    if(isNaN(data[0].genft))
                    $("input[name='genft']").val(0);
                    else
                    $("input[name='genft']").val(data[0].genft);
                    if(isNaN(data[0].tspfm))
                    $("input[name='tspfm']").val(0);
                    else
                    $("input[name='tspfm']").val(data[0].tspfm);
                    if(isNaN(data[0].tspff))
                    $("input[name='tspff']").val(0);
                    else
                    $("input[name='tspff']").val(data[0].tspff);
                    if(isNaN(data[0].tspft))
                    $("input[name='tspft']").val(0);
                    else
                    $("input[name='tspft']").val(data[0].tspft);
                    if(isNaN(data[0].scpfm))
                    $("input[name='scpfm']").val(0);
                    else
                    $("input[name='scpfm']").val(data[0].scpfm);
                    if(isNaN(data[0].scpff))
                    $("input[name='scpff']").val(0);
                    else
                    $("input[name='scpff']").val(data[0].scpff);
                    if(isNaN(data[0].scpft))
                    $("input[name='scpft']").val(0);
                    else
                    $("input[name='scpft']").val(data[0].scpft);
                    if(isNaN(data[0].minfm))
                    $("input[name='minfm']").val(0);
                    else
                    $("input[name='minfm']").val(data[0].minfm);
                    if(isNaN(data[0].minff))
                    $("input[name='minff']").val(0);
                    else
                    $("input[name='minff']").val(data[0].minff);
                    if(isNaN(data[0].minft))
                    $("input[name='minft']").val(0);
                    else
                    $("input[name='minft']").val(data[0].minft);


                    $("input[name='totpm']").val(parseInt(data[0].genpm)+parseInt(data[0].tsppm)+parseInt(data[0].scppm)+parseInt(data[0].minpm));
                    $("input[name='totpf']").val(parseInt(data[0].genpf)+parseInt(data[0].tsppf)+parseInt(data[0].scppf)+parseInt(data[0].minpf));
                    $("input[name='totpt']").val(parseInt(data[0].genpt)+parseInt(data[0].tsppt)+parseInt(data[0].scppt)+parseInt(data[0].minpt));

                    $("input[name='totfm']").val(parseInt(data[0].genfm)+parseInt(data[0].tspfm)+parseInt(data[0].scpfm)+parseInt(data[0].minfm));
                    $("input[name='totff']").val(parseInt(data[0].genff)+parseInt(data[0].tspff)+parseInt(data[0].scpff)+parseInt(data[0].minff));
                    $("input[name='totft']").val(parseInt(data[0].genft)+parseInt(data[0].tspft)+parseInt(data[0].scpft)+parseInt(data[0].minft));
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
    });
</script>
<script type="text/javascript">
function av(avSelect)
{
$batchcandidate = $("input[name='batchcandidate']").val();
$candidatecount = $("input[name='candidatecount']").val();

$total = parseFloat(avSelect.form.one.value)+parseInt(avSelect.form.five.value)+parseFloat(avSelect.form.nine.value)+parseFloat(avSelect.form.thirteen.value)+parseFloat(avSelect.form.two.value)+parseInt(avSelect.form.six.value)+parseFloat(avSelect.form.ten.value)+parseFloat(avSelect.form.fourteen.value);
if($total>$candidatecount){
    alert("You can't exceed the total limit!!"+$candidatecount);
    document.getElementById(""+avSelect.id).value=0;
}
// $totalcandidate = $("input[name='totalcandidate']").val();
// $previousinput = $("input[name='previousinput']").val();
// // $newtotalcandidate = 0;
// // alert($totalcandidate+"   "+$newtotalcandidate);
// if((parseFloat($totalcandidate)+parseFloat(avSelect.value))>$candidatecount){
//     alert("You can't exceed the batch limit!!  "+$candidatecount);
//     document.getElementById(""+avSelect.id).value=0;
//     // $("input[name='totalcandidate']").val(parseFloat($totalcandidate)-parseFloat($previousinput));
// }
// else{
//     $newtotalcandidate = parseFloat($totalcandidate)+parseFloat(avSelect.value);
//     $previousinput = avSelect.value;
//     $("input[name='totalcandidate']").val($newtotalcandidate);
// }
// var id = $(avSelect).attr('id');
// alert(avSelect.value);
// alert($batchcandidaate+"  "+$candidatecount);

var one=avSelect.form.one.value;
var two=avSelect.form.two.value;
var avvy=parseFloat(one)+parseFloat(two);
avSelect.form.avvy.value=avvy;
// if(avSelect.id=="one"||avSelect.id=="two"){
// if(avvy<=$candidatecount)
//   avSelect.form.avvy.value=avvy;
// else{
//   if(isNaN(avvy)){}
//   else{
//   if(avSelect.id=="one"){  
//   avSelect.form.one.value=0;
//   one=avSelect.form.one.value;
//   two=avSelect.form.two.value;
//   avvy=parseFloat(one)+parseFloat(two);
//   avSelect.form.avvy.value=avvy;
//   avSelect.form.one.focus();
//   }
//   if(avSelect.id=="two"){  
//   avSelect.form.two.value=0;
//   one=avSelect.form.one.value;
//   two=avSelect.form.two.value;
//   avvy=parseFloat(one)+parseFloat(two);
//   avSelect.form.avvy.value=avvy;
//   avSelect.form.two.focus();
//   }
//   alert("Sorry!!You can't exceed the total limit.."+ $candidatecount);  
//   }
// }
// }

var three=avSelect.form.three.value;
var four=avSelect.form.four.value;
var avvy1=parseFloat(three)+parseFloat(four);
avSelect.form.avvy1.value=avvy1;

var five=avSelect.form.five.value;
var six=avSelect.form.six.value;
var avvy2=parseFloat(five)+parseFloat(six);
avSelect.form.avvy2.value=avvy2;
// if(avSelect.id=="five"||avSelect.id=="six"){
// if(avvy2<=$candidatecount)
//   avSelect.form.avvy2.value=avvy2;
// else{
//   if(isNaN(avvy2)){}
//   else{
//   if(avSelect.id=="five"){  
//   avSelect.form.five.value=0;
//   five=avSelect.form.five.value;
//   six=avSelect.form.six.value;
//   avvy2=parseFloat(five)+parseFloat(six);
//   avSelect.form.avvy2.value=avvy2;
//   avSelect.form.five.focus();
//   }
//   if(avSelect.id=="six"){  
//   avSelect.form.six.value=0;
//   five=avSelect.form.five.value;
//   six=avSelect.form.six.value;
//   avvy2=parseFloat(five)+parseFloat(six);
//   avSelect.form.avvy2.value=avvy2;
//   avSelect.form.six.focus();
//   }
//   alert("Sorry!!You can't exceed the total limit.."+ $candidatecount);  
//   }
// }
// }


var seven=avSelect.form.seven.value;
var eight=avSelect.form.eight.value;
var avvy3=parseFloat(seven)+parseFloat(eight);
avSelect.form.avvy3.value=avvy3;

var nine=avSelect.form.nine.value;
var ten=avSelect.form.ten.value;
var avvy4=parseFloat(nine)+parseFloat(ten);
avSelect.form.avvy4.value=avvy4;
// if(avSelect.id=="nine"||avSelect.id=="ten"){
// if(avvy4<=$candidatecount)
//   avSelect.form.avvy4.value=avvy4;
// else{
//   if(isNaN(avvy4)){}
//   else{
//   if(avSelect.id=="nine"){  
//   avSelect.form.nine.value=0;
//   nine=avSelect.form.nine.value;
//   ten=avSelect.form.ten.value;
//   avvy4=parseFloat(nine)+parseFloat(ten);
//   avSelect.form.avvy4.value=avvy4;
//   avSelect.form.nine.focus();
//   }
//   if(avSelect.id=="ten"){  
//   avSelect.form.ten.value=0;
//   nine=avSelect.form.nine.value;
//   ten=avSelect.form.ten.value;
//   avvy4=parseFloat(nine)+parseFloat(ten);
//   avSelect.form.avvy4.value=avvy4;
//   avSelect.form.ten.focus();
//   }
//   alert("Sorry!!You can't exceed the total limit.."+ $candidatecount);  
//   }
// }
// }

var leven=avSelect.form.leven.value;
var twel=avSelect.form.twel.value;
var avvy5=parseFloat(leven)+parseFloat(twel);
avSelect.form.avvy5.value=avvy5;

var thirteen=avSelect.form.thirteen.value;
var fourteen=avSelect.form.fourteen.value;
var avvy6=parseFloat(thirteen)+parseFloat(fourteen);
avSelect.form.avvy6.value=avvy6;
// if(avSelect.id=="thirteen"||avSelect.id=="fourteen"){
// if(avvy6<=$candidatecount)
//   avSelect.form.avvy6.value=avvy6;
// else{
//   if(isNaN(avvy6)){}
//   else{
//   if(avSelect.id=="thirteen"){  
//   avSelect.form.thirteen.value=0;
//   thirteen=avSelect.form.thirteen.value;
//   fourteen=avSelect.form.fourteen.value;
//   avvy6=parseFloat(thirteen)+parseFloat(fourteen);
//   avSelect.form.avvy6.value=avvy6;
//   avSelect.form.thirteen.focus();
//   }
//   if(avSelect.id=="fourteen"){  
//   avSelect.form.fourteen.value=0;
//   thirteen=avSelect.form.thirteen.value;
//   fourteen=avSelect.form.fourteen.value;
//   avvy6=parseFloat(thirteen)+parseFloat(fourteen);
//   avSelect.form.avvy6.value=avvy6;
//   avSelect.form.fourteen.focus();
//   }
//   alert("Sorry!!You can't exceed the total limit.."+ $candidatecount);  
//   }
// }
// }

var fifteen=avSelect.form.fifteen.value;
var sixteen=avSelect.form.sixteen.value;
var avvy7=parseFloat(fifteen)+parseFloat(sixteen);
avSelect.form.avvy7.value=avvy7;

var tot0=parseFloat(one)+parseInt(five)+parseFloat(nine)+parseFloat(thirteen);
avSelect.form.t0.value=tot0;

var tot1=parseFloat(two)+parseInt(six)+parseFloat(ten)+parseFloat(fourteen);
avSelect.form.t1.value=tot1;

var tot2=parseFloat(avvy)+parseFloat(avvy2)+parseFloat(avvy4)+parseFloat(avvy6);
avSelect.form.t2.value=tot2;

var tot3=parseFloat(three)+parseFloat(seven)+parseFloat(leven)+parseFloat(fifteen);
avSelect.form.t3.value=tot3;

var tot4=parseFloat(four)+parseFloat(eight)+parseFloat(twel)+parseFloat(sixteen);
avSelect.form.t4.value=tot4;

var tot5=parseFloat(avvy1)+parseFloat(avvy3)+parseFloat(avvy5)+parseFloat(avvy7);
avSelect.form.t5.value=tot5;
}
</script>
@stop
