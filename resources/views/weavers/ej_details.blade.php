@extends('layouts.sidebar')
@section('custom_style')
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
    @if (session('formErrorStatus'))
    <div class="alert alert-danger"><center><b>{{ session('formErrorStatus') }}</b></center></div>
    @endif
    @if (session('formSuccessStatus'))
    <div class="alert alert-success"><center><b>{{ session('formSuccessStatus') }}</b></center></div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
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
                                        <h5>2 loom, Elecronic Jacquard and Knotting machine scheme</h5>
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
                                    <td>Name: </td>
                                    <td>{{$app->name}}</td>
                                    <td>Application number:</td>
                                    <td>{{$app->id}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Application district: </td>
                                    <td>{{$app->app_dist_name}} ({{$app->app_district}})</td>
                                    <td>Applied Taluk</td>
                                    <td>{{$app->app_taluk_name}} ({{$app->app_taluk}})</td>
                                </tr>
                                <tr>
                                    <td>Financialyear:</td>
                                    <td>{{$app->fin_year}}</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>House No:</td>
                                    <td>{{$app->resi_houseno}}</td>
                                    <td>Ward No:</td>
                                    <td>{{$app->resi_wardno}}</td>
                                </tr>
                                <tr>
                                    <td>Cross No:</td>
                                    <td>{{$app->resi_crossno}}</td>
                                    <td>Village:</td>
                                    <td>{{$app->resi_village}}</td>
                                </tr>
                                <tr>
                                    <td>Taluk:</td>
                                    <td>{{$app->resi_taluk_name}} ({{$app->resi_taluk}})</td>
                                    <td>District:</td>
                                    <td>{{$app->user_dist_name}} ( {{$app->resi_district}} )</td>
                                </tr>
                                <tr>
                                    <td>PIN:</td>
                                    <td>{{$app->resi_pin}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Landline(including STD code):</td>
                                    <td>{{$app->resi_phone}}</td>
                                    <td>Mobile No:</td>
                                    <td>{{$app->resi_mobile}}</td>
                                </tr>
                                <tr>
                                    <td>DOB:</td>
                                    <td>{{$app->dob}}</td>
                                    <td>Age:</td>
                                    <td>{{$app->age}}</td>
                                </tr>
                                <tr>
                                    <td>Aadhaar:</td>
                                    <td>{{$app->aadhaar}}</td>
                                    <td>Email:</td>
                                    <td>{{$app->email}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                
                                <tr>
                                    <td>Category</td>
                                    <td>{{$app->castecategory}}</td>
                                    <td>Gender</td>
                                    <td>{{$app->gender}}</td>
                                </tr>
                                <tr>
                                    <td>Annual income</td>
                                    <td>{{$app->income}}</td>
                                    <td>Application Status</td>
                                    <td>{{$app->status}}</td>
                                </tr>
                                <tr>
                                    <td>Facility selected</td>
                                    <td>{{$app->facility_sel}}</td>
                                    <td>Working capital assistance?</td>
                                    <td>{{$app->wka}}</td>
                                </tr>
                                <tr>
                                    <td>Expected Unit's address</td>
                                    <td>{{$app->plan_uadd}}</td>
                                    <td>Space available for unit</td>
                                    <td>{{$app->space_sqft}}</td>
                                </tr>
                                <tr>
                                    <td>RR/Meter number</td>
                                    <td>{{$app->rr_number}}</td>
                                    <td>Connected load</td>
                                    <td>{{$app->connect_load}}</td>
                                </tr>
                                <tr>
                                    <td>Building ownership type</td>
                                    <td>{{$app->building_own_type}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Prefered bank type</td>
                                    <td>{{$app->prepBank_type}}</td>
                                    <td>Prefered bank name</td>
                                    <td>{{$app->prepBank_bankname}}</td>
                                </tr>
                                <tr>
                                    <td>Loan ammount sanctioned</td>
                                    <td>{{$app->prepBank_loanamt}}</td>
                                    <td>Date of loan sanction</td>
                                    <td>{{$app->prepBank_date}}</td>
                                </tr>
                                
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>User bank</td>
                                    <td>{{$app->ubank_name}}</td>
                                    <td>User name as per bank</td>
                                    <td>{{$app->ubank_uname}}</td>
                                </tr>
                                <tr>
                                    <td>User bank branch</td>
                                    <td>{{$app->ubank_branch}}</td>
                                    <td>User bank account type</td>
                                    <td>{{$app->ubank_actype}}</td>
                                </tr>
                                <tr>
                                    <td>User bank ac number</td>
                                    <td>{{$app->ubank_acno}}</td>
                                    <td>User bank IFSC</td>
                                    <td>{{$app->ubank_ifsc}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                
                                <tr>
                                    <td>Attachments</td>
                                    <td colspan="3">
                                        <ul>
                                            @if(!empty($app->photo))
                                            <li>Photo</li>
                                            @endif
                                            @if(!empty($app->aadhaar_file))
                                            <li>Aadhaar copy</li>
                                            @endif
                                            @if(!empty($app->cast_cert))
                                            <li>Cast certificate</li>
                                            @endif
                                            @if(!empty($app->ind_licence_copy))
                                            <li>Industry licence copy</li>
                                            @endif
                                            @if(!empty($app->building_docs))
                                            <li>Building doccument</li>
                                            @endif
                                            @if(!empty($app->training_cert))
                                            <li>Training certificate</li>
                                            @endif
                                            @if(!empty($app->prepBank_sancLetter))
                                            <li>Loan sanction copy</li>
                                            @endif

                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Place</td>
                                    <td>{{$app->app_place}}</td>
                                    <td>Application date</td>
                                    <td>{{$app->appdate}}</td>
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
                        <b>District admin remarks</b><br>
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
                    <a href="{{url('/weavers/ej-2loom-list')}}" class="btn btn-warning btn-md">Go back</a>                    
                    <a href="#" id="printThis" class="btn btn-success btn-md">Print applition<br><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
                    <a href="{{ url('/weavers/ej-2loom-getzip/'.$app->id) }}" class="btn btn-info btn-md">Download all attachments<br><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    <hr>
                    @if($app->app_status == 'applied' && $app->userRole == 'TD' && !isset($app->dist_remarks->remarks))
                    <div class="dd-comment">
                    <h4 class="text-center">Add remarks</h4>
                        {{ Form::open(array('url' => 'weavers/ej-2loom-addremarks')) }}
                            {{ Form::textarea('remarks', null, array('required'=>true)) }}
                            {{ Form::hidden('applicationid',$app->id) }}
                            <input class="btn btn-success btn-md" type="submit" value="submit">
                        {{ Form::close() }}
                    </div>
                    @endif
                    @if($app->app_status == 'applied' && $app->userRole == 'DD' && !isset($app->div_remarks->remarks))
                    <div class="dd-comment">
                    <h4 class="text-center">Add remarks</h4>
                        {{ Form::open(array('url' => 'weavers/ej-2loom-addremarks')) }}
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