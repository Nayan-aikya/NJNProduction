@extends('layouts.public_form')
@section('custom_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@stop
@section('content')
<form id="formOne" action="{{url('weavers/powersubsidy-apply')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-content" style="max-width:1200px; margin:0 auto;">
    <h2 align="center"><u>Government of Karnataka</u></h2>
    <h3 align="center"><u>Application form for Claiming Power Subsidy<br>(New Renewal Application (With effect from 01/04/2011 ))</u></h3>
    <div id="content-wrapper"><br>
        <div class="container12" style="background: #f2f2f2; padding: 10px;">
            
            <!-- <p align="center"> <img src="pulpitrock.jpg" alt="Smiley face" width="142" height="150" align="right"> </p><br> -->
        
            <p align="center"><b>Handloom &amp; Textile Department</b></p>
    <p align="center"> 
    District: <select name="app_district" id="">
        <option value="">Select</option>
        @foreach($dists as $key => $dist)
        <option value="{{$dist->id}}">{{$dist->district_name}}</option>
        @endforeach
    </select>
    <span class="error"></span>
    </p>
    @if (session('formErrorStatus'))
    <div class="error"><center><b>{{ session('formErrorStatus') }}</b></center></div>
    @endif
    @if (session('formSuccessStatus'))
    <div class="success"><center><b>{{ session('formSuccessStatus') }}</b></center></div>
    @endif
    <br>
    <br>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="">     
            <tbody><tr>
                    <td></td>
                    <td>Full Name</td>  
                    <td>
                        <input name="name" value="{{$errors->first('name')}}" type="text" style="width:100%; height:20px;">
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">1</td>
                    <td>A)Residential address</td>
                    <td>
                        <table class="table table-bordered">
        
                        <tbody>
                            <tr>
                            <td>House No:</td>
                            <td><input name="resi_houseno" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                            </td> 
                            <td>Ward No:</td>
                            <td><input name="resi_wardno" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                            </td>
                            </tr>
                            <tr>
                            <td>Cross No:</td>
                            <td><input name="resi_crossno" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>
                            <td>Village:</td>
                            <td><input name="resi_village" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>     
                            </tr>
                            <tr>
                                <td>PIN:</td>
                                <td><input name="resi_pin" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td>
                                <td></td>
                                <td></td>     
                            </tr>
                            <tr>
                            <td>Taluk:</td>
                            <td><input name="resi_taluk" type="text" style="width:100%;">
                            <span class="error"></span>
                            </td>   
                            <td>District:</td>
                            <td>
                                <select name="resi_district" id="" style="width:100%; height:20px;">
                                    <option value="">Select</option>
                                    @foreach($dists as $key => $dist)
                                    <option value="{{$dist->id}}">{{$dist->district_name}}</option>
                                    @endforeach
                                </select>
                                <span class="error"></span>
                            </td>       
                            </tr>
                            <tr>
                            <td>Landline(including STD code):</td>
                            <td><input name="resi_phone" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>   
                            <td>Mobile No:</td>
                            <td><input name="resi_mobile" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>       
                            </tr>
                        </tbody>
                        </table>
                    </td>
                    
                </tr>            
                <tr>
                    <td>B)Unit Address</td>
                    <td>
                    <table class="table table-bordered">
        
                        <tbody>
                        <tr>
                            <td>House No:</td>
                            <td><input name="unit_houseno" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td> 
                            <td>Ward No:</td>
                            <td><input name="unit_wardno" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>
                            </tr>
                        <tr>
                        <td>Cross No:</td>
                            <td><input name="unit_crossno" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>
                            <td>Village:</td>
                            <td><input name="unit_village" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>     
                        </tr>
                        <tr>
                            <td>PIN:</td>
                            <td><input name="unit_pin" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>
                            <td></td>
                            <td></td>     
                        </tr>
                        <tr>
                            <td>Taluk:</td>
                            <td><input name="unit_taluk" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>   
                            <td>District:</td>
                            <td>
                                <select name="unit_district" id="" style="width:100%;">
                                    <option value="">Select</option>
                                    @foreach($dists as $key => $dist)
                                    <option value="{{$dist->id}}">{{$dist->district_name}}</option>
                                    @endforeach
                                </select>
                                <span class="error"></span>
                            </td>       
                        </tr>
                        <tr>
                            <td>Landline(including STD code):</td>
                            <td><input name="unit_phone" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>   
                            <td>Mobile No:</td>
                            <td><input name="unit_mobile" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>       
                        </tr>
                        <tr>
                            <td>Unit meter number:</td>
                            <td colspan="2"><input name="unit_meter" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>   
                        </tr>
                        </tbody>
                    </table>
                    </td>
                    
                    
                </tr>
                <tr>
                    <td>2</td>
                    <td>Category Name</td>
                    <td>
                    <table class="table table-bordered">
        
                        <tbody>
                            <tr>
                            <td>Name of the Subcast(Sc/St/minority/Backward class-1/2A/2B/3B/Others)</td>
                            <td><input name="subcast" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td> 
                            <td>Category:(SC/ST/OBC)</td>
                            <td><input name="cast_category" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                    
                </tr><tr>
                    <td>3</td>
                    <td>Educational Qualification</td>
                    <td><input name="education" type="text" style="width:100%; height:20px;">
                    <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>SSI Registration</td>
                    <td colspan="2">
                        <table class="table table-bordered">
                            <tr>
                                <td>Number</td>
                                <td><input name="reg_number" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td>
                                <td>Mou Date</td>
                                <td><input id="regdate" name="reg_date" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Ownership or Participation /others</td>
                    <td><input name="ownership_type" type="text" style="width:100%; height:20px;">
                    <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td rowspan="2">power sanction</td>
                    <td>
                        <table class="table table-bordered">
        
                        <tbody>
                            <tr>
                            <td>Sanctioned:</td>
                            <td><input name="power_alloted" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td> 
                            <td>Serviced:</td>
                            <td><input name="power_consumed" type="text" style="width:100%; height:20px;">
                            <span class="error"></span>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                        </td>
                </tr>
            <tr>
            </tr>
                <tr>
                    <td>7</td>
                    <td>R.R No</td>
                    <td><input name="rr_number" type="text" style="width:100%; height:20px;">
                    <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Details of Machinery</td>
                    <td>
                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>A.Details of the Power looms(in AnnexureA):</td>
                                <td><input name="mc_details_A" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td> 
                                <td>B.Details of the pre-loom Machinery (in AnnexureB):</td>
                                <td><input name="mc_details_B" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>C.Details of the dying machinery(in AnnexureC):</td>
                                <td><input name="mc_details_C" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td>
                                <td>D.Details of the Raw Material :</td>
                                <td><input name="mc_details_D" type="text" style="width:100%; height:20px;">
                                <span class="error"></span>
                                </td>     
                            </tr>
                        </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Uploads(Scanned copies)</td>
                    <td>
                        <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Annexure A:</td>
                                <td>Annexure B:</td>                                
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="annexurea" id="annexurea">
                                    <span class="error">
                                </td>
                                <td>
                                    <input type="file" name="annexureb" id="annexureb">
                                    <span class="error"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Annexure C:</td>
                                <td>Annexure D:</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="annexurec" id="annexurec">
                                    <span class="error">
                                </td>
                                <td>
                                    <input type="file" name="annexured" id="annexured">
                                    <span class="error"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Certificate:</td><td>Photograph:</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="certificate" id="certificate">
                                    <span class="error"></span>
                                </td>
                                <td>
                                    <input type="file" name="photograph" id="photograph">
                                    <span class="error"></span>
                                </td> 
                            </tr>
                        </tbody>
                        </table>
                    </td>
                </tr>
    </tbody></table> <br>
    <p>I here by Certify that the information provided by me is true. The power supplied at subsidised  rate will be utilized for power loom and pre-loom activity. In case Power is utilized for any other purpose legal action can be taken on me and my unit. I here by certify that information provided by true </p><br>
    <table>
        <tr>
            <td>Date: </td>
            <td><input readonly value="<?php echo date("d-m-Y"); ?>" name="app_date" type="text" style="width: 200px; height:20px;"><span class="error"></span></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Place: </td>
            <td><input name="app_place" type="text" style="width: 200px; height:20px;"><span class="error"></span></td>
        </tr>
    </table>        
        <br>
            <center style="margin-right: -400px;">
                <span class="error"></span>
                    <br><br></center>
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
    
    $( document ).ready(function() {
        $("#formOne").submit(function(e){
        var name = $("input[name='name']").val();
        var resi_houseno = $("input[name='resi_houseno']").val();
        var resi_wardno = $("input[name='resi_wardno']").val();
        var resi_crossno = $("input[name='resi_crossno']").val();
        var resi_village = $("input[name='resi_village']").val();
        var resi_taluk = $("input[name='resi_taluk']").val();
        var app_district = $("select[name='app_district']").val();
        var resi_district = $("select[name='resi_district']").val();
        var resi_pin = $("input[name='resi_pin']").val();
        var resi_phone = $("input[name='resi_phone']").val();
        var resi_mobile = $("input[name='resi_mobile']").val();
        var unit_houseno = $("input[name='unit_houseno']").val();
        var unit_wardno = $("input[name='unit_wardno']").val();
        var unit_crossno = $("input[name='unit_crossno']").val();
        var unit_village = $("input[name='unit_village']").val();
        var unit_taluk = $("input[name='unit_taluk']").val();
        var unit_district = $("select[name='unit_district']").val();
        var unit_pin = $("input[name='unit_pin']").val();
        var unit_phone = $("input[name='unit_phone']").val();
        var unit_mobile = $("input[name='unit_mobile']").val();
        var unit_meter = $("input[name='unit_meter']").val();
        var subcast = $("input[name='subcast']").val();
        var cast_category = $("input[name='cast_category']").val();
        var education = $("input[name='education']").val();
        var reg_number = $("input[name='reg_number']").val();
        var reg_date = $("input[name='reg_date']").val();
        var ownership_type = $("input[name='ownership_type']").val();
        var power_alloted = $("input[name='power_alloted']").val();
        var power_consumed = $("input[name='power_consumed']").val();
        var rr_number = $("input[name='rr_number']").val();
        var mc_details_A = $("input[name='mc_details_A']").val();
        var mc_details_B = $("input[name='mc_details_B']").val();
        var mc_details_C = $("input[name='mc_details_C']").val();
        var mc_details_D = $("input[name='mc_details_D']").val();
        var app_date = $("input[name='app_date']").val();
        var app_place = $("input[name='app_place']").val();
        var req_reg = /^([a-zA-Z0-9\_\-\#\.\,\(\)\/]){1,}$/;
        var mob_reg = /^\d{10}$/;
        var name_reg = /^([a-zA-Z\.\s]){1,}$/;
        var pin_reg = /^\d{6}$/;
        var uid_reg = /^\d{12}$/;
        var date_reg = /^\d{2}-\d{2}-\d{4}$/;
        var age_reg = /^\d{1,3}$/;
        var num_reg = /^\d+$/;
        var email_reg = /^([A-Z|a-z|0-9](\.|_|\-){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.|_|\-){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/;


        var name_check = validate_inputtext(name, name_reg, 'name');
        var resi_houseno_check = validate_inputtext(resi_houseno, req_reg, 'resi_houseno');
        var resi_wardno_check = validate_inputtext(resi_wardno, req_reg, 'resi_wardno');
        var resi_crossno_check = validate_inputtext(resi_crossno, req_reg, 'resi_crossno');
        var resi_village_check = validate_inputtext(resi_village, resi_village, 'resi_village');
        var resi_taluk_check = validate_inputtext(resi_taluk, resi_taluk, 'resi_taluk');
        var resi_district_check = validate_dropdown(resi_district, req_reg, 'resi_district');
        var app_district_check = validate_dropdown(app_district, req_reg, 'app_district');
        var resi_pin_check = validate_inputtext(resi_pin, pin_reg, 'resi_pin');
        // var resi_phone_check = validate_inputtext(resi_phone, req_reg, 'resi_phone');
        var resi_mobile_check = validate_inputtext(resi_mobile, mob_reg, 'resi_mobile');
        var unit_houseno_check = validate_inputtext(unit_houseno, req_reg, 'unit_houseno');
        var unit_wardno_check = validate_inputtext(unit_wardno, req_reg, 'unit_wardno');
        var unit_crossno_check = validate_inputtext(unit_crossno, req_reg, 'unit_crossno');
        var unit_village_check = validate_inputtext(unit_village, req_reg, 'unit_village');
        var unit_taluk_check = validate_inputtext(unit_taluk, req_reg, 'unit_taluk');
        var unit_district_check = validate_dropdown(unit_district, req_reg, 'unit_district');
        var unit_pin_check = validate_inputtext(unit_pin, pin_reg, 'unit_pin');
        // var unit_phone_check = validate_inputtext(unit_phone, req_reg, 'unit_phone');
        var unit_mobile_check = validate_inputtext(unit_mobile, mob_reg, 'unit_mobile');
        var unit_meter_check = validate_inputtext(unit_meter, req_reg, 'unit_meter');
        var subcast_check = validate_inputtext(subcast, req_reg, 'subcast');
        var cast_category_check = validate_inputtext(cast_category, req_reg, 'cast_category');
        var education_check = validate_inputtext(education, req_reg, 'education');
        var reg_number_check = validate_inputtext(reg_number, req_reg, 'reg_number');
        var reg_date_check = validate_inputtext(reg_date, date_reg, 'reg_date');
        var ownership_type_check = validate_inputtext(ownership_type, req_reg, 'ownership_type');
        var power_alloted_check = validate_inputtext(power_alloted, req_reg, 'power_alloted');
        var power_consumed_check = validate_inputtext(power_consumed, req_reg, 'power_consumed');
        var rr_number_check = validate_inputtext(rr_number, req_reg, 'rr_number');
        var mc_details_A_check = validate_inputtext(mc_details_A, req_reg, 'mc_details_A');
        var mc_details_B_check = validate_inputtext(mc_details_B, req_reg, 'mc_details_B');
        var mc_details_C_check = validate_inputtext(mc_details_C, req_reg, 'mc_details_C');
        var mc_details_D_check = validate_inputtext(mc_details_D, req_reg, 'mc_details_D');
        var app_date_check = validate_inputtext(app_date, req_reg, 'app_date');
        var app_place_check = validate_inputtext(app_place, req_reg, 'app_place');

        if($("input[name='photograph']").get(0).files.length === 0){
            $("input[name='photograph'] + .error").html('Please upload photograph');
            photograph_check = false;
        }
        else{
            $("input[name='photograph'] + .error").html('');
            photograph_check = true;
        }

        if(app_district_check && name_check && resi_houseno_check && resi_wardno_check && resi_crossno_check && resi_village_check && resi_taluk_check && resi_district_check && resi_pin_check && resi_mobile_check && unit_houseno_check && unit_wardno_check && unit_crossno_check && unit_village_check && unit_taluk_check && unit_district_check && unit_pin_check && unit_mobile_check && unit_meter_check && subcast_check && cast_category_check && education_check && reg_number_check && reg_date_check && ownership_type_check && power_alloted_check && power_consumed_check && rr_number_check && mc_details_A_check && mc_details_B_check && mc_details_C_check && mc_details_D_check && app_date_check && app_place_check && photograph_check){
            $("#errorsummer").html('');
            return true;
        }
        else{
            $("#errorsummer").html('One or more errors found, please correct and try again!');
            return false;
        }
    });
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
        
        $('#regdate').datepicker({
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
    });
</script>
@stop
