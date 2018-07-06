@extends('layouts.sidebar')
@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<style>
    td{
        padding: 6px;
    }
    .app-action{
        padding: 10px;
    }
    .dd-actions a, .dd-actions input, .dd-actions select{
        width: 90%;
        margin: 5px auto;
        display: block;
    }
    .dd-comment textarea{ width:100%; }
</style>
@stop

@section('content')
    @section('content')
    @if (session('formErrorStatus'))
    <div class="alert alert-danger"><center><b>{{ session('formErrorStatus') }}</b></center></div>
    @endif
    @if (session('formSuccessStatus'))
    <div class="alert alert-success"><center><b>{{ session('formSuccessStatus') }}</b></center></div>
    @endif
    <div class="row pad_top_20">
        <div class="col-md-9">
            <table width="100%" align="center" id="print_view" class="border1ccc">
                <tr>
                    <td>
                        <table width="100%">
                            <tr>
                                <td><img src="{{asset('img/Karnataka_log.png')}}" alt=""></td>
                                <td>
                                    <center>
                                        <h4>Govt of Karnataka</h4>
                                        <h4>Department of Handlooms and Textiles</h4>
                                        <h4>Application details</h4>
                                        <h5>Power subsidy scheme</h5>
                                    </center>
                                </td>
                                <td><img src="{{asset('img/gov-logo.png')}}" alt=""></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="1" cellpadding="4" style="border-collapse: collapse; border:1px solid #ccc;" width="100%">
                            <tbody>
                                <tr>
                                    <td>Name </td>
                                    <td>{{$app->salutation}} {{$app->name}}  </td>
                                    <td>Application ID</td>
                                    <td>{{$app->id}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Applied district</td>
                                    <td>{{$app->app_dist_name}} ({{$app->app_district}})</td>
                                    <td>Application year</td>
                                    <td>{{$app->app_year}}</td>
                                </tr>
                                <tr>
                                    <td>Scheme</td>
                                    <td>{{$app->scheme_name}}</td>
                                    <td>Unit type</td>
                                    <td>{{$app->unit_type}}</td>
                                </tr>
                                <tr>
                                    <td>Applied Taluk</td>
                                    <td>{{$app->app_taluk_name}} ({{$app->app_taluk}})</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><center><b>Residential details</b></center></td>
                                </tr>
                                <tr>
                                    <td>Aadhaar</td>
                                    <td>{{$app->aadhaar}}</td>
                                    <td>Mobile no</td>
                                    <td>{{$app->resi_mobile}}</td>
                                </tr>
                                <tr>
                                    <td>House No</td>
                                    <td>{{$app->resi_houseno}}</td>
                                    <td>Ward no</td>
                                    <td>{{$app->resi_wardno}}</td>
                                </tr>
                                <tr>
                                    <td>Cross no</td>
                                    <td>{{$app->resi_crossno}}</td>
                                    <td>Village</td>
                                    <td>{{$app->resi_village}}</td>
                                </tr>
                                <tr>
                                    <td>Taluk</td>
                                    <td>{{$app->resi_taluk_name}} ({{$app->resi_taluk}})</td>
                                    <td>Dist</td>
                                    <td>{{$app->user_dist_name}} ( {{$app->resi_district}} )</td>
                                </tr>
                                <tr>
                                    <td>PIN</td>
                                    <td>{{$app->resi_pin}}</td>
                                    <td>Mobile</td>
                                    <td>{{$app->resi_mobile}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><center><b>Unit details</b></center></td>
                                </tr>
                                <tr>
                                    <td>Unit Name</td>
                                    <td>{{$app->unit_name}}</td>
                                    <td>Mobile</td>
                                    <td>{{$app->unit_mobile}}</td>
                                </tr>
                                <tr>
                                    <td>Unit No</td>
                                    <td>{{$app->unit_no}}</td>
                                    <td>Ward no</td>
                                    <td>{{$app->unit_wardno}}</td>
                                </tr>
                                <tr>
                                    <td>Cross no</td>
                                    <td>{{$app->unit_crossno}}</td>
                                    <td>Village</td>
                                    <td>{{$app->unit_village}}</td>
                                </tr>
                                <tr>
                                    <td>Taluk</td>
                                    <td>{{$app->unit_taluk}}</td>
                                    <td>Dist</td>
                                    <td>{{$app->unit_district}}</td>
                                </tr>
                                <tr>
                                    <td>PIN</td>
                                    <td>{{$app->unit_pin}}</td>
                                    <td>Landline</td>
                                    <td>{{$app->unit_phone}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{$app->castecategory}}</td>
                                    <td>Education</td>
                                    <td>{{$app->education}} {{$app->education_other}}</td>
                                </tr>
                                <tr>
                                    <td>SSI/MSME reg. no.</td>
                                    <td>{{$app->reg_number}}</td>
                                    <td>SSI/MSME reg. date</td>
                                    <td>{{$app->reg_number}}</td>
                                </tr>
                                <tr>
                                    <td>Ownership type</td>
                                    <td>{{$app->ownership_type}} {{$app->ownership_other}}</td>
                                    <td>100% women unit?</td>
                                    <td>{{$app->u100per_women}}</td>
                                </tr>
                                <tr>
                                    <td>Power sactioned</td>
                                    <td>{{$app->power_alloted}} ({{$app->power_alloted_date}})</td>
                                    <td>RR number</td>
                                    <td>{{$app->rr_number}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><center><b>Machinary details</b></center></td>
                                </tr>                                    
                                <tr>
                                    <td colspan="4">
                                        <?php
                                            $type = $app->typecheck;
                                            if($app->mctype1){
                                                $temp1 = json_decode($app->mctype1);
                                                ?>
                                                <table width="100%" border="1" style="border-collapse: collapse; border:1px solid #ccc;">
                                                <tr>
                                                    <th>Powerloom make name</th>
                                                    <th>Number of looms</th>
                                                    <th>Type of loom</th>
                                                    <th>Width of loom</th>
                                                    <th>Power consumption per loom</th>
                                                    <th>Attachment</th>
                                                </tr>
                                                <?php

                                                foreach ($temp1 as $key => $value) {
                                                    $t2 =''; 
                                                    if(isset($value->att))
                                                    {
                                                        $t2 = implode(',',$value->att);
                                                    }
                                                    $loommake =  isset($value->loommake) ? $value->loommake : "";
                                                    $loomnum =  isset($value->loomnum) ? $value->loomnum : "";
                                                    $loomtype =  isset($value->loomtype) ? $value->loomtype : "";
                                                    $loomwidth =  isset($value->loomwidth) ? $value->loomwidth : "";
                                                    $loompowercon =  isset($value->loompowercon) ? $value->loompowercon : "";
                                                    
                                                    echo"<tr><td>".$loommake."</td><td>".$loomnum."</td><td>".$loomtype."</td><td>".$loomwidth."</td><td>".$loompowercon."</td><td>".$t2."</td></tr>";
                                                }
                                                ?>
                                                </table>
                                                <?php
                                            }
                                            if($app->mctype2){
                                                $val = json_decode($app->mctype2);
                                            ?>
                                                <table border="1" width="100%" style="border-collapse: collapse; border:1px solid #ccc;">
                                                    <tr>
                                                        <th>Preloom facility machines</th>
                                                        <th>Availability</th>
                                                        <th>No of spin looms</th>
                                                        <th>No of machines</th>
                                                        <th>Power (in hp)</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Pirn winding machine</td>
                                                        <td>{{$val->pirnwind->avail or ''}}</td>
                                                        <td>{{$val->pirnwind->num_loom}}</td>
                                                        <td>{{$val->pirnwind->num_mcs}}</td>
                                                        <td>{{$val->pirnwind->power}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bobbin/dubbling/winding</td>
                                                        <td>{{$val->bbdbwi->avail or ''}}</td>
                                                        <td>{{$val->bbdbwi->num_loom}}</td>
                                                        <td>{{$val->bbdbwi->num_mcs}}</td>
                                                        <td>{{$val->bbdbwi->power}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Warping machine</td>
                                                        <td>{{$val->wrp->avail or ''}}</td>
                                                        <td>{{$val->wrp->num_loom}}</td>
                                                        <td>{{$val->wrp->num_mcs}}</td>
                                                        <td>{{$val->wrp->power}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Twisting machine</td>
                                                        <td>{{$val->twst->avail or ''}}</td>
                                                        <td>{{$val->twst->num_loom}}</td>
                                                        <td>{{$val->twst->num_mcs}}</td>
                                                        <td>{{$val->twst->power}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other machines<br>
                                                            @if ($val->other->othername)
                                                            {{$val->other->othername}}
                                                            @endif
                                                        </td>
                                                        <td>{{$val->other->avail or ''}}</td>
                                                        <td>{{$val->other->num_loom}}</td>
                                                        <td>{{$val->other->num_mcs}}</td>
                                                        <td>{{$val->other->power}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Total</td>
                                                        <td>{{$val->totalpower}}</td>
                                                    </tr>
                                                </table>
                                            <?php
                                            }
                                            if($app->mctype3){
                                                $temp1 = json_decode($app->mctype3);
                                                ?>
                                                <table width="100%" border="1" style="border-collapse: collapse; border:1px solid #ccc;">
                                                <tr>
                                                    <th>Make of shuttleless power loom</th>
                                                    <th>Width of loom (Reed space)</th>
                                                    <th>Connected power</th>
                                                    <th>Attachment type</th>
                                                    <th>Number of looms</th>
                                                </tr>
                                                <?php
                                                foreach ($temp1 as $key => $value) {
                                                    $t2 =''; 
                                                    if(isset($value->att))
                                                    {
                                                        $t2 = implode(',',$value->att);
                                                    }
                                                    $make =  isset($value->make) ? $value->make : "";
                                                    $reed_space =  isset($value->reed_space) ? $value->reed_space : "";
                                                    $power =  isset($value->power) ? $value->power : "";
                                                    $loom_num =  isset($value->loom_num) ? $value->loom_num : "";
                                                    echo"<tr><td>".$make."</td><td>".$reed_space."</td><td>".$power."</td><td>".$t2."</td><td>".$loom_num."</td></tr>";
                                                }
                                                ?>
                                                </table>
                                                <?php
                                            }
                                        ?>                                                
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <?php
                                        $temp = json_decode($app->mctype4);                                            
                                        ?>
                                        <table width="100%" border="1" style="border-collapse: collapse; border:1px solid #ccc;">
                                            <tr>
                                                <th>Raw material used</th>
                                                <th>Monthly average consumption(In KGs)</th>
                                                <th>Monthly average production (In meters)</th>
                                            </tr>
                                            <?php
                                                foreach ($temp as $key => $value) {
                                                    $raw_mtr =  isset($value->raw_mtr) ? $value->raw_mtr : "";
                                                    $avg_cons =  isset($value->avg_cons) ? $value->avg_cons : "";
                                                    $avg_prod =  isset($value->avg_prod) ? $value->avg_prod : "";
                                                    echo"<tr><td>".$raw_mtr."</td><td>".$avg_cons."</td><td>".$avg_prod."</td></tr>";
                                                }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Attachments</td>
                                    <td colspan="3">
                                        <ul>
                                            @if(!empty($app->photograph))
                                            <li>Photo</li>
                                            @endif
                                            @if(!empty($app->building_docs))
                                            <li>Building doccument</li>
                                            @endif
                                            @if(!empty($app->cast_certificate))
                                            <li>Cast certificate</li>
                                            @endif
                                            @if(!empty($app->pow_sanc_letter))
                                            <li>Power sanction letter</li>
                                            @endif
                                            @if(!empty($app->trade_licence))
                                            <li>Trade licence</li>
                                            @endif
                                            @if(!empty($app->ssi_msme_cert))
                                            <li>SSI/MSME certificate</li>
                                            @endif
                                            @if(!empty($app->recent_bill))
                                            <li>Recent power bill</li>
                                            @endif
                                            @if(!empty($app->recent_receipt))
                                            <li>Recent power recipt</li>
                                            @endif
                                            @if(!empty($app->aadhaar_file))
                                            <li>Aadhaar copy</li>
                                            @endif
                                            @if(!empty($app->recent_tax_receipt))
                                            <li>Recent tax receipt</li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Application date</td>
                                    <td>{{$app->app_date}}</td>
                                    <td>Place</td>
                                    <td>{{$app->app_place}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <?php
                                    if(isset($app->insp_remarks->ins_status)){
                                ?>
                                <tr>
                                    <td colspan="4"><center><b>Inspection details</b></center></td>
                                </tr>                                    
                                <tr>
                                    <td>Inspection Status</td>
                                    <td>{{$app->insp_remarks->ins_status}}</td>
                                    <td>Inspection date</td>
                                    <td>{{$app->insp_remarks->ins_date}}</td>
                                </tr>
                                <tr>
                                    <td>Inspection remarks</td>
                                    <td colspan="3">{{$app->insp_remarks->ins_remarks}}</td>
                                </tr>
                                <tr>
                                    <td>Inspection attachments</td>
                                    <td colspan="3">
                                        <ul>
                                            @if(!empty($app->insp_remarks->ins_build_picture))
                                            <li>Building Image</li>
                                            @endif
                                            <?php
                                            $t1 = json_decode($app->insp_remarks->ins_loom_pictures);
                                                if(is_array($t1)){
                                                    foreach ($t1 as $key => $value) {
                                                        echo "<li>".$value."</li>";
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Inspection Location</td>
                                    <td colspan="3">
                                        <ul>
                                            <li>Lattitude: {{$app->insp_remarks->ins_lat}}</li>
                                            <li>Longitude: {{$app->insp_remarks->ins_long}}</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>

                                <?php
                                    }
                                ?>
                                                                
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-3">
            <div class="app-action border1ccc">
                <ul class="list-group">
                    <li class="list-group-item active text-bold"><b>Timelines</b></li>
                    <li class="list-group-item">
                        <b>Application</b><br>
                        Received: {{$app->app_date}}<br>
                        Current status: {{$app->app_status}}
                    </li>
                    <li class="list-group-item">
                        <b>Inspection</b><br>
                        Date: {{$app->insp_remarks->ins_date or 'NA'}}<br>
                        Status: {{$app->insp_remarks->ins_status or 'NA'}}
                    </li>
                    <li class="list-group-item">
                        <b>District remarks</b><br>
                        Remarks: {{$app->dist_remarks->remarks or "NA"}}<br>
                        Date: {{$app->dist_remarks->created_at or "NA"}}
                    </li>
                    <li class="list-group-item">
                        <b>Division admin remarks</b><br>
                        Remarks: {{$app->div_remarks->remarks or "NA"}}<br>
                        Acceptance: {{$app->div_remarks->acceptance or "NA"}}<br>
                        Date: {{$app->div_remarks->created_at or "NA"}}
                    </li>
                </ul>
                <div class="dd-actions">
                    <h4 class="text-center">Options</h4>
                    <a href="{{url('/weavers/powersubsidy-list')}}" class="btn btn-warning btn-md">Go back</a>                    
                    <a href="#" id="printThis" class="btn btn-success btn-md">Print applition<br><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
                    <a href="{{ url('/weavers/powersubsidy-getzip/'.$app->id) }}" class="btn btn-info btn-md">Download all attachments<br><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    <hr>
                    

                    @if($app->app_status == 'applied' && $app->userRole == 'TD' && !isset($app->dist_remarks->remarks))
                    <div class="dd-comment">
                    <h4 class="text-center">Add remarks</h4>
                        {{ Form::open(array('url' => 'weavers/powersubsidy-addremarks')) }}
                            {{ Form::textarea('remarks', null, array('required'=>true)) }}
                            {{ Form::hidden('applicationid',$app->id) }}
                            <input class="btn btn-success btn-md" type="submit" value="submit">
                        {{ Form::close() }}
                    </div>
                    @endif
                    @if($app->app_status == 'applied' && $app->userRole == 'DD' && !isset($app->div_remarks->remarks))
                    <div class="dd-comment">
                    <h4 class="text-center">Add remarks</h4>
                        {{ Form::open(array('url' => 'weavers/powersubsidy-addremarks')) }}
                            {{ Form::textarea('remarks', null, array('required'=>true)) }}
                            {{ Form::hidden('applicationid',$app->id) }}
                            {{ Form::select('acceptance', [''=>'Select','accepted' => 'Accepted', 'rejected' => 'Rejected'], null, ['class'=>'form-control', 'required'=>'required']) }}
                            <input class="btn btn-success btn-md" type="submit" value="submit">
                        {{ Form::close() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('custom_scripts')
<script>
$(function () {
    $("#printThis").click(function () {
        var contents = $("#print_view").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
</script>
@stop
