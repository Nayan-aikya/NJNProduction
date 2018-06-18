// Js for electronic jacquard and 2 loom scheme form validation
// datepick age calculator
$( document ).ready(function() {    

    //Validator regular expressions.
    var req_reg = /^[\w\-\'\(\)\#][\w\.\-\'\(\)\s\#\,\/\:]*$/;
    var mob_reg = /^\d{10}$/;
    var name_reg = /^([a-zA-Z\.\s]){1,}$/;
    var pin_reg = /^\d{6}$/;
    var uid_reg = /^\d{12}$/;
    var date_reg = /^\d{2}-\d{2}-\d{4}$/;
    var age_reg = /^\d{1,3}$/;
    var num_reg = /^\d+$/;
    var email_reg = /^([A-Z|a-z|0-9](\.|_|\-){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.|_|\-){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/;
    // Cast toggle changes
    var castsel = $("input[name='castecategory']:checked").val() || '';
    var facility_sel = $("select[name='facility_sel']").val();
    $('.msme_ssi_tr').hide();

    $("#form2").submit(function(e){

        var app_district = $("select[name='app_district']").val();
        var name = $("input[name='name']").val();
        var salutation = $("select[name='salutation']").val();
        var fin_year = $("select[name='fin_year']").val();
        var resi_houseno = $("input[name='resi_houseno']").val();
        var resi_wardno = $("input[name='resi_wardno']").val();
        var resi_crossno = $("input[name='resi_crossno']").val();
        var resi_village = $("input[name='resi_village']").val();
        var resi_taluk = $("input[name='resi_taluk']").val();
        var resi_district = $("select[name='resi_district']").val();
        var resi_pin = $("input[name='resi_pin']").val();
        var resi_mobile = $("input[name='resi_mobile']").val();
        var fwh_name = $("input[name='fwh_name']").val();
        var app_place = $("input[name='app_place']").val();

        var age = $("input[name='age']").val();
        var aadhaar = $("input[name='aadhaar']").val();

        var gender = $("input[name='gender']:checked").val() || '';

        var castecategory = $("input[name='castecategory']:checked").val() || '';
        var actype = $("input[name='actype']:checked").val();

        var rr_number = $("input[name='rr_number']").val();
        var income = $("input[name='income']").val();
        var plan_uadd = $("textarea[name='plan_uadd']").val();
        var space_sqft = $("input[name='space_sqft']").val();
        var msme_number = $("input[name='msme_number']").val();
        var num_of_looms = $("input[name='num_of_looms']").val();

        var appdate = $("input[name='appdate']").val();
        var connect_load = $("input[name='connect_load']").val();
        
        var prepBank_type = $("input[name='prepBank_type']:checked").val() || '';
        var prepBank_bankname = $("input[name='prepBank_bankname']").val();
        var prepBank_loanamt = $("input[name='prepBank_loanamt']").val();
        var prepBank_date = $("input[name='prepBank_date']").val();

        var ubank_name = $("input[name='ubank_name']").val();
        var ubank_uname = $("input[name='ubank_uname']").val();
        var ubank_branch = $("input[name='ubank_branch']").val();
        var ubank_actype = $("input[name='ubank_actype']:checked").val() || '';
        var ubank_acno = $("input[name='ubank_acno']").val();
        var ubank_ifsc = $("input[name='ubank_ifsc']").val();

        var ubank_name_check = validate_inputtext(ubank_name, req_reg, 'ubank_name');
        var ubank_uname_check = validate_inputtext(ubank_uname, name_reg, 'ubank_uname');
        var ubank_branch_check = validate_inputtext(ubank_branch, req_reg, 'ubank_branch');
        var ubank_actype_check = validate_radio(ubank_actype, req_reg, 'ubank_actype');
        var ubank_acno_check = validate_inputtext(ubank_acno, req_reg, 'ubank_acno');
        var ubank_ifsc_check = validate_inputtext(ubank_ifsc, req_reg, 'ubank_ifsc');
        
        var name_check = validate_inputtext(name, name_reg, 'name');
        var salutation_check = validate_dropdown(salutation, req_reg, 'salutation');
        var fin_year_check = validate_dropdown(fin_year, req_reg, 'fin_year');
        var resi_houseno_check = validate_inputtext(resi_houseno, req_reg, 'resi_houseno');
        var resi_wardno_check = validate_inputtext(resi_wardno, req_reg, 'resi_wardno');
        var resi_crossno_check = validate_inputtext(resi_crossno, req_reg, 'resi_crossno');
        var resi_village_check = validate_inputtext(resi_village, req_reg, 'resi_village');
        var resi_taluk_check = validate_inputtext(resi_taluk, req_reg, 'resi_taluk');
        var resi_district_check = validate_dropdown(resi_district, req_reg, 'resi_district');
        var resi_pin_check = validate_inputtext(resi_pin, pin_reg, 'resi_pin');
        var photo_check = validate_file('photo');
        var aadhaar_file_check = validate_file('aadhaar_file');
        var training_cert_check = validate_file('training_cert');
        var ind_licence_copy_check = validate_file('ind_licence_copy');
        var prepBank_sancLetter_check = validate_file('prepBank_sancLetter');
        
        var resi_mobile_check = validate_inputtext(resi_mobile, mob_reg, 'resi_mobile');
        var app_district_check = validate_dropdown(app_district, req_reg, 'app_district');
        var fwh_name_check = validate_inputtext(fwh_name, name_reg, 'fwh_name');
        var appdate_check = validate_inputtext(appdate, date_reg, 'appdate');
        var age_check = validate_inputtext(age, age_reg, 'age');
        var aadhaar_check = validate_inputtext(aadhaar, uid_reg, 'aadhaar');
        var connect_load_check = validate_inputtext(connect_load, num_reg, 'connect_load');
        var gender_check = validate_radio(gender, req_reg, 'gender');
        var castecategory_check = validate_radio(castecategory, req_reg, 'castecategory');
        var facility_sel_check = validate_dropdown(facility_sel, req_reg, 'facility_sel');

        var prepBank_type_check = validate_radio(prepBank_type, req_reg, 'prepBank_type');
        var prepBank_bankname_check = validate_inputtext(prepBank_bankname, req_reg, 'prepBank_bankname');
        var prepBank_loanamt_check = validate_inputtext(prepBank_loanamt, num_reg, 'prepBank_loanamt');
        var prepBank_date_check = validate_inputtext(prepBank_date, date_reg, 'prepBank_date');

        // cast certificate only for SC/ST
        var caste_certificate_check = false;
        if(castsel == "SC" || castsel=="ST"){
            caste_certificate_check = validate_file('caste_certificate');
        }
        else{
            caste_certificate_check = true;
        }

        var income_check = validate_inputtext(income, num_reg, 'income');
        var building_docs_check = validate_file('building_docs');
        var rr_number_check = validate_inputtext(rr_number, req_reg, 'rr_number');
        
        var msme_number_check = false;
        var num_of_looms_check = false;
        if((castsel == "SC" || castsel=="ST") && (facility_sel =='ejs' || facility_sel =='kms'))
        {
            msme_number_check = validate_inputtext(msme_number, req_reg, 'msme_number');
            num_of_looms_check = validate_inputtext(num_of_looms, num_reg, 'num_of_looms');
        }
        else{
            num_of_looms_check = true;
            msme_number_check = true;
        }

        var plan_uadd_check = validate_textarea(plan_uadd, req_reg, 'plan_uadd');
        var space_sqft_check = validate_inputtext(space_sqft, num_reg, 'space_sqft');
        var app_place_check = validate_inputtext(app_place, req_reg, 'app_place');

        if(ubank_name_check && ubank_uname_check && ubank_branch_check && ubank_actype_check && ubank_acno_check && ubank_ifsc_check && name_check && salutation_check && fin_year_check && resi_houseno_check && resi_wardno_check && resi_crossno_check && resi_village_check && resi_taluk_check && resi_district_check && resi_pin_check && photo_check && aadhaar_file_check && training_cert_check && ind_licence_copy_check && prepBank_sancLetter_check && resi_mobile_check && app_district_check && fwh_name_check && appdate_check && age_check && aadhaar_check && connect_load_check && gender_check && castecategory_check && facility_sel_check && prepBank_type_check && prepBank_bankname_check && prepBank_loanamt_check && prepBank_date_check && caste_certificate_check && income_check && building_docs_check && rr_number_check && msme_number_check && num_of_looms_check && msme_number_check && plan_uadd_check && space_sqft_check && app_place_check){
            $("#errorsummer").html('');
            return true;
        }
        else{
            $("#errorsummer").html('One or more errors found, please correct and try again!');
            return false;
        }

        return false;
    });

    // date picker and age calculator
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

    $("input[name='appdate'],input[name='prepBank_date']").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "2000:2018",
        dateFormat: 'dd-mm-yy',
    });

    //cast change selection
    $("input[name='castecategory']").change(function(){
        castsel = $("input[name='castecategory']:checked").val() || '';
        if(castsel == 'SC' || castsel == 'ST'){
            $("#caste_certificate_tr").show();
            $("#wka_tr").show();
            $("#facility_sel option[value='2lm']").attr('disabled', false ); 
            $("#facility_sel option[value='ejs']").attr('disabled', false ); 
            $("#facility_sel option[value='kms']").attr('disabled', false ); 
            $("#facility_sel option[value='sap']").attr('disabled', false ); 
            $("#facility_sel option[value='ops']").attr('disabled', false ); 
        }
        else{
            $("#wka_tr").hide();
            $("#caste_certificate_tr").hide();
            $("#facility_sel option[value='sap']").attr('disabled', true ); 
            $("#facility_sel option[value='ops']").attr('disabled', true ); 
        }
        $("#facility_sel").val('');
        facility_sel = '';
        q3test();
    });
    
    $("#facility_sel").change(function(){
        facility_sel = $("select[name='facility_sel']").val();
        q3test()
    });

    // MSME SSI selection cases
    function q3test(){
        if(facility_sel == 'ejs' || facility_sel == 'kms'){
            $('.msme_ssi_tr').show();
        }
        else{
            $('.msme_ssi_tr').hide();
        }
    }
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
//Validating textarea type
function validate_textarea(strval, regex, parametername) {
    if(strval.match(regex)){
        $("#"+parametername).html('');
        return true;
    }
    else{
        $("#"+parametername).html('Please enter valid value.');
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
        $("select[name='"+parametername+"'] + .error").html('Please select valid value.');
        return false;
    }
}
//Validating radio option
function validate_radio(strval, regex, parametername) {
    if(strval.match(regex)){
        $("#"+parametername).html('');
        return true;
    }
    else{
        $("#"+parametername).html('Please select valid value.');
        return false;
    }
}

//Validating file upload
function validate_file(fileFieldname) {
    if($("input[name='"+fileFieldname+"']").get(0).files.length === 0){
        $("input[name='"+fileFieldname+"'] + .error").html('Please upload file');
        return false;
    }
    else{
        $("input[name='"+fileFieldname+"'] + .error").html('');
        return true;
    }
}