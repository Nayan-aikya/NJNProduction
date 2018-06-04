@extends('layouts.public_form')
@section('custom_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<style>
    input[type=text],{ width: 100%; height: 20px;}
</style>
@stop
@section('content')
@if (session('formErrorStatus'))
<div class="alert alert-danger"><center><b>{{ session('formErrorStatus') }}</b></center></div>
@endif
@if (session('formSuccessStatus'))
<div class="alert alert-success"><center><b>{{ session('formSuccessStatus') }}</b></center></div>
@endif
@if ($errors->any())
    <div >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form id="form2" action="{{url('weavers/ej-2loom-apply')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-content" style="max-width:1200px; margin:0 auto;">
        <h2 align="center"><u>Government of Karnataka</u></h2>
        <h3 align="center"><u>Handloom & Textile Department<br></u>Weaver special package plan</h3>
        <div id="content-wrapper">
            <br>
            <div class="container12" style="background: #f2f2f2; padding: 10px;">
                <p class="text-center">Application for seeking loan to buy Elecronic Jacquard/Knotting machine from government.</p>
                <p>To,<br>Deputy Director,<br>Handloom &amp; Textile Department,<br>District Panchayat,</p>
                <select name="app_district" id="">
                    <option value="">Select district</option>
                    @foreach($dists as $key => $dist)
                    <option value="{{$dist->id}}">{{$dist->district_name}}</option>
                    @endforeach
                </select>
                <span class="error"></span>
                <br>
                <br>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="">
                    <thead>
                        <th>SL NO</th>
                        <th>Profile</th>
                        <th>Information</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Applicant Name & Address</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Name: </td>
                                            <td colspan="3">
                                                <input type="text" name="name" style="width:100%;">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>House No:</td>
                                            <td>
                                                <input name="resi_houseno" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>Ward No:</td>
                                            <td>
                                                <input name="resi_wardno" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cross No:</td>
                                            <td>
                                                <input name="resi_crossno" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>Village:</td>
                                            <td>
                                                <input name="resi_village" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Taluk:</td>
                                            <td>
                                                <input name="resi_taluk" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>District:</td>
                                            <td>
                                                <select name="resi_district" id="">
                                                    <option value="">Select district</option>
                                                    @foreach($dists as $key => $dist)
                                                    <option value="{{$dist->id}}">{{$dist->district_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PIN:</td>
                                            <td>
                                                <input name="resi_pin" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>Recent photo</td>
                                            <td><input name="photo" type="file">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Landline(including STD code):</td>
                                            <td>
                                                <input name="resi_phone" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>Mobile No:</td>
                                            <td>
                                                <input name="resi_mobile" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Father/Husband/Wife Name</td>
                            <td>
                                <input name="fwh_name" type="text">
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>DOB & Age</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>DOB:</td>
                                            <td>
                                                <input id="dob" name="dob" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>Age:</td>
                                            <td>
                                                <input id="age" name="age" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>                                                
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Identity</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Aadhaar:</td>
                                            <td>
                                                <input name="aadhaar" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>Email:</td>
                                            <td>
                                                <input name="email" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>                                                
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Gender</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="mgender">Male</label>                                                
                                                <input id="mgender" value="male" type="radio" name="gender" checked>&nbsp;&nbsp;
                                                <label for="fgender">Female</label>
                                                <input id="fgender" value="female" type="radio" name="gender">
                                                <span class="error gender"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td colspan="2">
                                <span id="facility" class="error"></span>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Facilities expected from govt.</th>
                                        <th>Normal</th>
                                        <th>SCP</th>
                                        <th>TCP</th>
                                    </tr>
                                    <tr>
                                        <td>Electric two loom scheme</td>
                                        <td><input type="radio" name="e2l" value="normal">                                        </td>
                                        <td><input type="radio" name="e2l" value="SCP"></td>
                                        <td><input type="radio" name="e2l" value="TCP"></td>
                                    </tr>
                                    <tr>
                                        <td>Elecronic Jacquard shceme</td>
                                        <td><input type="radio" name="ejs" value="normal"></td>
                                        <td><input type="radio" name="ejs" value="SCP"></td>
                                        <td><input type="radio" name="ejs" value="TCP"></td>
                                    </tr>
                                    <tr>
                                        <td>Knotting machine</td>
                                        <td><input type="radio" name="kms" value="normal"></td>
                                        <td><input type="radio" name="kms" value="SCP"></td>
                                        <td><input type="radio" name="kms" value="TCP"></td>
                                    </tr>
                                    <tr>
                                        <td>Semi automatic power loom</td>
                                        <td><input type="radio" name="sap" value="normal"></td>
                                        <td><input type="radio" name="sap" value="SCP"></td>
                                        <td><input type="radio" name="sap" value="TCP"></td>
                                    </tr>
                                    <tr>
                                        <td>Capital investment scheme</td>
                                        <td><input type="radio" name="cis" value="normal"></td>
                                        <td><input type="radio" name="cis" value="SCP"></td>
                                        <td><input type="radio" name="cis" value="TCP"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Applicant Description<br>(Certificate required)</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>OBC</td>
                                            <td>GEN</td>
                                            <td>SC</td>
                                            <td>ST</td>
                                            <td>PL</td>
                                            <td>SAL</td>
                                            <td>EJ</td>
                                            <td>KM</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="radio" value="OBC" name="castecategory">
                                            </td>
                                            <td>
                                                <input type="radio" value="GEN" name="castecategory" checked>
                                            </td>
                                            <td>
                                                <input type="radio" value="SC" name="castecategory">
                                            </td>
                                            <td>
                                                <input type="radio" value="ST" name="castecategory">
                                            </td>
                                            <td>
                                                <input type="radio" value="PL" name="castecategory">
                                            </td>
                                            <td>
                                                <input type="radio" value="SAL" name="castecategory">
                                            </td>
                                            <td>
                                                <input type="radio" value="EJ" name="castecategory">
                                            </td>
                                            <td>
                                                <input type="radio" value="KM" name="castecategory">
                                                <span class="error castecategory"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8">
                                                <input type="file" name="caste_certificate">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Yearly Income</td>
                            <td>
                                <input type="text" name="income" type="text">
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Space available to setup the unit (in sqr foots)</td>
                            <td>
                                <input name="space_sqft" type="text">
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Training Certificate<br>(certificate from state/central govt.)</td>
                            <td>
                                <input name="training_cert" type="file">
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Planned unit's address</td>
                            <td>
                                <input name="plan_uadd" type="text">
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Power Description</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>R.R No</td>
                                            <td>
                                                <input name="rr_number" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>MSME Registraion No<br>(Only for Jacquard and Knotting machine)</td>
                            <td>
                                <input name="msme_number" type="text">
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Bank preference for scheme sponsorship </td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><label for="bankpref">Nationalised Bank</label>
                                                <input type="radio" value="Nationalised Bank" name="bankpref" id="bankpref" checked>                                                
                                                &nbsp;&nbsp;
                                                <label for="bankpref2">DCC Bank</label>
                                                <input type="radio" value="DCC Bank" name="bankpref" id="bankpref2">
                                                &nbsp;&nbsp; 
                                                <label for="bankpref3">Textile Co-Operative Bank</label>
                                                <input type="radio" value="Textile Co-Operative Bank" name="bankpref" id="bankpref3">
                                                &nbsp;&nbsp;
                                                <label for="bankpref4">Others</label>
                                                <input type="radio" value="Others" name="bankpref" id="bankpref4">
                                                <span class="error bankpref"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Bank account details to receive credits</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Branch name</td>
                                            <td>
                                                <input name="bank_branch" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>SB/Current</td>
                                            <td>
                                                <label for="SB">SB</label>
                                                <input type="radio" value="SB" name="actype" id="SB" checked>
                                                &nbsp;
                                                <label for="current">Current</label>
                                                <input type="radio" value="current" name="actype" id="current">
                                                <span class="error actype"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Account No</td>
                                            <td>
                                                <input name="bank_acno" type="text">
                                                <span class="error"></span>
                                            </td>
                                            <td>IFSC No</td>
                                            <td>
                                                <input name="bank_ifsc" type="text">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Expected loan<br>(in rupies)</td>
                            <td>
                                <input name="exp_loan" type="text">
                                <span class="error"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>I here by Certify that the information provided by me is true. The power supplied at subsidised rate
                    will be utilized for power loom and pre-loom activity. In case Power is utilized for any other
                    purpose legal action can be taken on me and my unit. I here by certify that information provided
                    by true </p>
                <br>
                <table>
                    <tbody>
                        <tr>
                            <td>Date: </td>
                            <td><?php echo date("d-m-Y"); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Place: </td>
                            <td>
                                <input name="app_place" type="text" style="width: 200px; height:20px;">
                                <span class="error"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <center style="margin-right: -400px;">
                    <!-- Signature of the applicant:<br><input name="" type="text" style="width: 200px; height:20px;"> -->
                    <span class="error"></span>
                    <br>
                    <br>
                </center>
                <center>
                    <p id="errorsummer" class="error"></p>
                    <input type="submit" name="submit" value="submit">
                </center>
                <div class="footer">
                </div>
            </div>
        </div>
    </div>
</form>
@stop
@section('custom_scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
// datepick age calculator
$( document ).ready(function() {
    $('#dob').datepicker({
        onSelect: function(value, ui) {
            var today = new Date(), 
                age = today.getFullYear() - ui.selectedYear;
            $('#age').val(age);
        },
        changeMonth: true,
        changeYear: true,
        yearRange: "1908:2018",
        dateFormat: 'dd-mm-yy',
    });

        $("#form2").submit(function(e){
    //Validator regular expressions.
        var req_reg = /^[\w\.\-\'\(\)\#][\w\.\-\'\(\)\s\#]*$/;
        var mob_reg = /^\d{10}$/;
        var name_reg = /^([a-zA-Z\.\s]){1,}$/;
        var pin_reg = /^\d{6}$/;
        var uid_reg = /^\d{12}$/;
        var date_reg = /^\d{2}-\d{2}-\d{4}$/;
        var age_reg = /^\d{1,3}$/;
        var num_reg = /^\d+$/;
        var email_reg = /^([A-Z|a-z|0-9](\.|_|\-){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.|_|\-){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/;

        var app_district = $("select[name='app_district']").val();
        var name = $("input[name='name']").val();
        var resi_houseno = $("input[name='resi_houseno']").val();
        var resi_wardno = $("input[name='resi_wardno']").val();
        var resi_crossno = $("input[name='resi_crossno']").val();
        var resi_village = $("input[name='resi_village']").val();
        var resi_taluk = $("input[name='resi_taluk']").val();
        var resi_district = $("select[name='resi_district']").val();
        var resi_pin = $("input[name='resi_pin']").val();
        var resi_phone = $("input[name='resi_phone']").val();
        var resi_mobile = $("input[name='resi_mobile']").val();
        var fwh_name = $("input[name='fwh_name']").val();

        var dob = $("input[name='dob']").val();
        var age = $("input[name='age']").val();
        var aadhaar = $("input[name='aadhaar']").val();
        var email = $("input[name='email']").val();

        // var gender = $("input[name='gender']:checked").val();
        var e2l = $("input[name='e2l']:checked").val() || '';
        var ejs = $("input[name='ejs']:checked").val() || '';
        var kms = $("input[name='kms']:checked").val() || '';
        var sap = $("input[name='sap']:checked").val() || '';
        var cis = $("input[name='cis']:checked").val() || '';
        var castecategory = $("input[name='castecategory']:checked").val();
        var actype = $("input[name='actype']:checked").val();
        var bankpref = $("input[name='bankpref']:checked").val();

        var rr_number = $("input[name='rr_number']").val();
        var income = $("input[name='income']").val();
        var plan_uadd = $("input[name='plan_uadd']").val();
        var space_sqft = $("input[name='space_sqft']").val();
        var msme_number = $("input[name='msme_number']").val();        
        var bank_branch = $("input[name='bank_branch']").val();
        
        var bank_acno = $("input[name='bank_acno']").val();
        var bank_ifsc = $("input[name='bank_ifsc']").val();
        var exp_loan = $("input[name='exp_loan']").val();
        var app_place = $("input[name='app_place']").val();
        
        if(e2l.match(req_reg) || ejs.match(req_reg) || kms.match(req_reg) || sap.match(req_reg) || cis.match(req_reg)){
            $("#facility").html('');
            facility_check = true;
        }
        else{
            $("#facility").html('Please select atleast one facility.');            
            facility_check = false;
        }

        var name_check = validate_inputtext(name, name_reg, 'name');
        var resi_houseno_check = validate_inputtext(resi_houseno, req_reg, 'resi_houseno');
        var resi_wardno_check = validate_inputtext(resi_wardno, req_reg, 'resi_wardno');
        var resi_crossno_check = validate_inputtext(resi_crossno, req_reg, 'resi_crossno');
        var resi_village_check = validate_inputtext(resi_village, req_reg, 'resi_village');
        var resi_taluk_check = validate_inputtext(resi_taluk, req_reg, 'resi_taluk');
        var resi_district_check = validate_dropdown(resi_district, req_reg, 'resi_district');
        var resi_pin_check = validate_inputtext(resi_pin, pin_reg, 'resi_pin');
        var resi_mobile_check = validate_inputtext(resi_mobile, mob_reg, 'resi_mobile');
        var app_district_check = validate_dropdown(app_district, req_reg, 'app_district');
        var fwh_name_check = validate_inputtext(fwh_name, req_reg, 'fwh_name');
        var dob_check = validate_inputtext(dob, date_reg, 'dob');
        var age_check = validate_inputtext(age, age_reg, 'age');
        var aadhaar_check = validate_inputtext(aadhaar, uid_reg, 'aadhaar');
        var email_check = validate_inputtext(email, email_reg, 'email');
        var rr_number_check = validate_inputtext(rr_number, req_reg, 'rr_number');
        var plan_uadd_check = validate_inputtext(plan_uadd, req_reg, 'plan_uadd');
        var space_sqft_check = validate_inputtext(space_sqft, req_reg, 'space_sqft');
        var msme_number_check = validate_inputtext(msme_number, req_reg, 'msme_number');
        var bank_branch_check = validate_inputtext(bank_branch, req_reg, 'bank_branch');
        var bank_acno_check = validate_inputtext(bank_acno, req_reg, 'bank_acno');
        var bank_ifsc_check = validate_inputtext(bank_ifsc, req_reg, 'bank_ifsc');
        var exp_loan_check = validate_inputtext(exp_loan, req_reg, 'exp_loan');
        var app_place_check = validate_inputtext(app_place, req_reg, 'app_place');
        var income_check = validate_inputtext(income, req_reg, 'income');

        // validate upload
        if($("input[name='caste_certificate']").get(0).files.length === 0){
            $("input[name='caste_certificate'] + .error").html('Please upload file');
            caste_certificate_check = false;
        }
        else{
            $("input[name='caste_certificate'] + .error").html('');
            caste_certificate_check = true;
        }
        if($("input[name='training_cert']").get(0).files.length === 0){
            $("input[name='training_cert'] + .error").html('Please upload file');
            training_cert_check = false;
        }
        else{
            $("input[name='training_cert'] + .error").html('');
            training_cert_check = true;
        }

        if($("input[name='photo']").get(0).files.length === 0){
            $("input[name='photo'] + .error").html('Please upload file');
            photo_check = false;
        }
        else{
            $("input[name='photo'] + .error").html('');
            photo_check = true;
        }

        if(facility_check && photo_check && name_check && resi_houseno_check && resi_wardno_check && resi_crossno_check && resi_village_check && resi_taluk_check && resi_district_check && resi_pin_check && resi_mobile_check && app_district_check && fwh_name_check && dob_check && age_check && aadhaar_check && email_check && rr_number_check && plan_uadd_check && space_sqft_check && msme_number_check && bank_branch_check && bank_acno_check && bank_ifsc_check && exp_loan_check && app_place_check && caste_certificate_check && training_cert_check){
            $("#errorsummer").html('');
            return true;
        }
        else{
            $("#errorsummer").html('One or more errors found, please correct and try again!');
            return false;
        }

        return false;
    });    
});

//Validating input type
function validate_inputtext(strval, regex, parametername) {
    if(strval.match(regex)){
        $("input[name='"+parametername+"'] + .error").html('');
        return true;
    }
    else{
        $("input[name='"+parametername+"'] + .error").html('Please enter valid value.');
        return false;
    }
}
//Validating select option
function validate_dropdown(strval, regex, parametername) {
    if(strval.match(regex)){
        $("select[name='"+parametername+"'] + .error").html('');
        return true;
    }
    else{
        $("select[name='"+parametername+"'] + .error").html('Please enter valid value.');
        return false;
    }
}
//Validating radio option
function validate_radio(strval, regex, parametername) {
    if(strval.match(regex)){
        $("select[name='"+parametername+"'] + .error").html('');
        return true;
    }
    else{
        $("select[name='"+parametername+"'] + .error").html('Please enter valid value.');
        return false;
    }
}

</script>
@stop
