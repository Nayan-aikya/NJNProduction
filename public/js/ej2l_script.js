// Js for electronic jacquard and 2 loom scheme form validation
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

    $("#form2").submit(function(e){

        // var ubank_name_check = validate_inputtext(req_reg, 'ubank_name');
        // var ubank_uname_check = validate_inputtext(name_reg, 'ubank_uname');
        // var ubank_branch_check = validate_inputtext(req_reg, 'ubank_branch');
        // var ubank_actype_check = validate_radio(req_reg, 'ubank_actype');
        // var ubank_acno_check = validate_inputtext(req_reg, 'ubank_acno');
        // var ubank_ifsc_check = validate_inputtext(req_reg, 'ubank_ifsc');
        
        var name_check = validate_inputtext(name_reg, 'name');
        var salutation_check = validate_dropdown(req_reg, 'salutation');
        var fin_year_check = validate_dropdown(req_reg, 'fin_year');
        var resi_houseno_check = validate_inputtext(req_reg, 'resi_houseno');
        var resi_wardno_check = validate_inputtext(req_reg, 'resi_wardno');
        var resi_crossno_check = validate_inputtext(req_reg, 'resi_crossno');
        var resi_village_check = validate_inputtext(req_reg, 'resi_village');
        var resi_taluk_check = validate_dropdown(req_reg, 'resi_taluk');
        var resi_district_check = validate_dropdown(req_reg, 'resi_district');
        var resi_pin_check = validate_inputtext(pin_reg, 'resi_pin');
        var photo_check = validate_file('photo');
        var aadhaar_file_check = validate_file('aadhaar_file');
        var training_cert_check = validate_file('training_cert');
        var ind_licence_copy_check = validate_file('ind_licence_copy');
        // var prepBank_sancLetter_check = validate_file('prepBank_sancLetter');
        var general_licence_copy_check = validate_file('general_licence_copy');
        
        var resi_mobile_check = validate_inputtext(mob_reg, 'resi_mobile');
        var app_district_check = validate_dropdown(req_reg, 'app_district');
        var fwh_name_check = validate_inputtext(name_reg, 'fwh_name');
        var appdate_check = validate_inputtext(date_reg, 'appdate');
        var age_check = validate_inputtext(age_reg, 'age');
        var aadhaar_check = validate_inputtext(uid_reg, 'aadhaar');
        var connect_load_check = validate_inputtext(num_reg, 'connect_load');
        var gender_check = validate_radio(req_reg, 'gender');
        var castecategory_check = validate_radio(req_reg, 'castecategory');
        var building_own_type_check = validate_radio(req_reg, 'building_own_type');
        var facility_sel_check = validate_dropdown(req_reg, 'facility_sel');

        // var prepBank_type_check = validate_radio(req_reg, 'prepBank_type');
        // var prepBank_bankname_check = validate_inputtext(req_reg, 'prepBank_bankname');
        // var prepBank_loanamt_check = validate_inputtext(num_reg, 'prepBank_loanamt');
        // var prepBank_date_check = validate_inputtext(date_reg, 'prepBank_date');

        // cast certificate only for SC/ST
        var caste_certificate_check = false;
        if(castsel == "SC" || castsel=="ST"){
            caste_certificate_check = validate_file('caste_certificate');
        }
        else{
            caste_certificate_check = true;
        }

        var income_check = validate_inputtext(num_reg, 'income');
        var building_docs_check = validate_file('building_docs');
        var rr_number_check = validate_inputtext(req_reg, 'rr_number');
        
        var msme_number_check = validate_inputtext(req_reg, 'msme_number');
        var num_of_looms_check = validate_inputtext(num_reg, 'num_of_looms');

        var plan_uadd_check = validate_textarea(req_reg, 'plan_uadd');
        var space_sqft_check = validate_inputtext(num_reg, 'space_sqft');
        var app_place_check = validate_inputtext(req_reg, 'app_place');

        if(name_check && salutation_check && fin_year_check && resi_houseno_check && resi_wardno_check && resi_crossno_check && resi_village_check && resi_taluk_check && resi_district_check && resi_pin_check && photo_check && aadhaar_file_check && training_cert_check && ind_licence_copy_check && general_licence_copy_check && resi_mobile_check && app_district_check && fwh_name_check && appdate_check && age_check && aadhaar_check && connect_load_check && gender_check && castecategory_check && facility_sel_check && caste_certificate_check && income_check && building_docs_check && rr_number_check && msme_number_check && num_of_looms_check && msme_number_check && plan_uadd_check && space_sqft_check && app_place_check && building_own_type_check){
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
            $("#facility_sel option[value='2lm']").attr('disabled', false ); 
            $("#facility_sel option[value='ejs']").attr('disabled', false ); 
            $("#facility_sel option[value='kms']").attr('disabled', false ); 
            $("#facility_sel option[value='sap']").attr('disabled', false ); 
            $("#facility_sel option[value='ops']").attr('disabled', false ); 
        }
        else{
            $("#caste_certificate_tr").hide();
            $("#facility_sel option[value='sap']").attr('disabled', true ); 
            $("#facility_sel option[value='ops']").attr('disabled', true ); 
        }
        $("#facility_sel").val('');
        facility_sel = '';
        wkaTest();
    });
    
    $("#facility_sel").change(function(){
        facility_sel = $("select[name='facility_sel']").val();
        wkaTest();
    });

    // Working capital test
    function wkaTest() {
        if(castsel =='SC' || castsel =='ST'){
            if(facility_sel == '2lm' || facility_sel == 'sap' || facility_sel == 'ops'){
                $('#wka_tr').show();
            }
            else{
                $('#wka_tr').hide();
            }
        }
        else{
            $('#wka_tr').hide();
        }
    }
     // Application district change
     $('#app_district').change(function(e) {
        $('#unit_district').html($("#app_district option:selected").html());
        var did = $("#app_district option:selected").val();
        if(did != ''){
            $.ajax({url: "/weavers/get_talukas/"+did, success: function(result){
                $("#app_taluk").html(result);
            }});
        }
        else{
            $("#app_taluk").html('');
        }
    });
    // Residential taluk
    $('#resi_district').change(function(e) {
        var did = $("#resi_district option:selected").val();
        if(did!=''){
            $.ajax({url: "/weavers/get_talukas/"+did, success: function(result){
                $("#resi_taluk").html(result);
            }});
        }
        else{
            $("#resi_taluk").html('');
        }
    });
});


//Validating input type
function validate_inputtext(regex, parametername) {
    var content = $("input[name='"+parametername+"']").val();
    if(content.match(regex)){
        $("input[name='"+parametername+"'] + .error").html('');
        return true;
    }
    else{
        $("input[name='"+parametername+"'] + .error").html('Please enter valid value.');
        return false;
    }
}
//Validating textarea type
function validate_textarea(regex, parametername) {
    var content = $("textarea[name='"+parametername+"']").val();;
    if(content.match(regex)){
        $("select[name='"+parametername+"'] + .error").html('');
        return true;
    }
    else{
        $("select[name='"+parametername+"'] + .error").html('Please enter valid value.');
        return false;
    }
}
//Validating select option
function validate_dropdown(regex, parametername) {
    var content = $("select[name='"+parametername+"']").val() || '';
    if(content.match(regex)){
        $("select[name='"+parametername+"'] + .error").html('');
        return true;
    }
    else{
        $("select[name='"+parametername+"'] + .error").html('Please select valid value.');
        return false;
    }
}
//Validating radio option
function validate_radio(regex, parametername) {
    var content = $("input[name='"+parametername+"']:checked").val() || '';
    if(content.match(regex)){
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
