@extends('layouts.sidebar')
@section('custom_style')
<style>
    #print_view td{
        padding:5px;
    }
</style>
@stop
@section('content')

    <table id="print_view" width="100%">
        <tr>
            <td style="border: 1px solid #ddd;">
                <table width="650" align="center">
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td><img src="{{asset('img/Karnataka_log.png')}}" alt=""></td>
                                    <td>
                                        <center>
                                            <h4>Govt of Karnataka</h4>
                                            <h3>Department of Handlooms and Textiles</h3>
                                        </center>
                                    </td>
                                    <td><img src="{{asset('img/gov-logo.png')}}" alt=""></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Application ID: <b>{{$app->id}}</b> District ID: <b>{{$app->app_district}}</b></p>
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
                                        <td>Application district: </td>
                                        <td>{{$app->app_district}}</td>
                                        <td>Financialyear:</td>
                                        <td>{{$app->fin_year}}</td>
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
                                        <td>{{$app->resi_taluk}}</td>
                                        <td>District:</td>
                                        <td>{{$app->resi_district}}</td>
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
                                        <td>Inspection remarks</td>
                                        <td colspan="3">{{$app->ins_remarks}}</td>
                                    </tr>
                                    <tr>
                                        <td>Inspection documents</td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Place</td>
                                        <td>{{$app->app_place}}</td>
                                        <td>Application date</td>
                                        <td>{{$app->appdate}}</td>
                                    </tr>
                                    <!-- <tr>
                                        <div style="margin:10px;">
                                        <td colspan="4" class="text-center">
                                            <div style="margin:10px;">
                                                <a href="{{url('weavers/ej-2loom-getzip/'.$app->id)}}" class="btn btn-info">Download all attachments.</a>
                                                <button class="btn btn-info" id="printThis">Print application</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <div style="margin:10px;">
                                                <a href="{{url('/weavers/ej-2loom-list')}}" class="btn btn-warning btn-md">Go back</a>
                                                @if($app->status == 'applied')
                                                <a href="{{url('/weavers/ej-2loom-adminaction/rejected/'.$app->id)}}" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?')">Reject</a>
                                                <a href="{{url('/weavers/ej-2loom-adminaction/approved/'.$app->id)}}" class="btn btn-success btn-md" onclick="return confirm('Are you sure?')">Approve</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr> -->
                                    
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

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