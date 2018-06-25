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

    var castsel = $("input[name='castecategory']:checked").val() || '';
    var mctype = '';
    var scheme_name = '';
    var unit_type_val = '';

    $("#formOne").submit(function(e){
        var app_district = $("select[name='app_district']").val() || '';
        var scheme_name = $("select[name='scheme_name']").val() || '';
        var unit_type = $("select[name='unit_type']").val() || '';
        var name = $("input[name='name']").val();
        var salutation = $("select[name='salutation']").val();
        var aadhaar = $("input[name='aadhaar']").val();
        var resi_houseno = $("input[name='resi_houseno']").val();
        var resi_wardno = $("input[name='resi_wardno']").val();

        var resi_village = $("input[name='resi_village']").val();
        var resi_pin = $("input[name='resi_pin']").val();
        var resi_taluk = $("input[name='resi_taluk']").val();
        var resi_district = $("select[name='resi_district']").val();

        var resi_mobile = $("input[name='resi_mobile']").val();
        var unit_name = $("input[name='unit_name']").val();
        var unit_no = $("input[name='unit_no']").val();
        var unit_wardno = $("input[name='unit_wardno']").val();

        var unit_village = $("input[name='unit_village']").val();
        var unit_pin = $("input[name='unit_pin']").val();
        var unit_taluk = $("input[name='unit_taluk']").val();

        var castecategory = $("input[name='castecategory']:checked").val() || '';
        
        var education = $("select[name='education']").val();
        var reg_number = $("input[name='reg_number']").val();
        var regdate = $("input[name='regdate']").val();
        var ownership_type = $("select[name='ownership_type']").val();
        var u100per_women = $("input[name='u100per_women']:checked").val() || '';
        var power_alloted = $("input[name='power_alloted']").val();
        var rr_number = $("input[name='rr_number']").val();

        var app_date = $("input[name='app_date']").val();
        var app_place = $("input[name='app_place']").val();

        var app_district_check = validate_dropdown(app_district, req_reg, 'app_district');
        var scheme_name_check = validate_dropdown(scheme_name, req_reg, 'scheme_name');
        var unit_type_check = validate_dropdown(unit_type, req_reg, 'unit_type');
        var name_check = validate_inputtext(name, name_reg, 'name');
        var salutation_check = validate_inputtext(salutation, req_reg, 'salutation');
        var aadhaar_check = validate_inputtext(aadhaar, uid_reg, 'aadhaar');
        var resi_houseno_check = validate_inputtext(resi_houseno, req_reg, 'resi_houseno');
        var resi_wardno_check = validate_inputtext(resi_wardno, req_reg, 'resi_wardno');
        var resi_village_check = validate_inputtext(resi_village, req_reg, 'resi_village');
        var resi_pin_check = validate_inputtext(resi_pin, req_reg, 'resi_pin');
        var resi_taluk_check = validate_inputtext(resi_taluk, req_reg, 'resi_taluk');
        var resi_district_check = validate_dropdown(resi_district, req_reg, 'resi_district');
        var resi_mobile_check = validate_inputtext(resi_mobile, mob_reg, 'resi_mobile');
        var unit_name_check = validate_inputtext(unit_name, req_reg, 'unit_name');
        var unit_no_check = validate_inputtext(unit_no, req_reg, 'unit_no');
        var unit_wardno_check = validate_inputtext(unit_wardno, req_reg, 'unit_wardno');
        var unit_village_check = validate_inputtext(unit_village, req_reg, 'unit_village');
        var unit_pin_check = validate_inputtext(unit_pin, pin_reg, 'unit_pin');
        var unit_taluk_check = validate_inputtext(unit_taluk, req_reg, 'unit_taluk');
        var castecategory_check = validate_radio(castecategory, req_reg, 'castecategory');
        var education_check = validate_dropdown(education, req_reg, 'education');
        var reg_number_check = validate_inputtext(reg_number, req_reg, 'reg_number');
        var regdate_check = validate_inputtext(regdate, date_reg, 'regdate');
        var ownership_type_check = validate_dropdown(ownership_type, req_reg, 'ownership_type');
        var u100per_women_check = validate_radio(u100per_women, req_reg, 'u100per_women');
        var power_alloted_check = validate_inputtext(power_alloted, num_reg, 'power_alloted');
        var rr_number_check = validate_inputtext(rr_number, req_reg, 'rr_number');
        var app_date_check = validate_inputtext(app_date, date_reg, 'app_date');
        var app_place_check = validate_inputtext(app_place, req_reg, 'app_place');
        var pow_sanc_letter_check = validate_file('pow_sanc_letter');
        var trade_licence_check = validate_file('trade_licence');
        var ssi_msme_cert_check = validate_file('ssi_msme_cert');
        var recent_bill_check = validate_file('recent_bill');
        var recent_receipt_check = validate_file('recent_receipt');
        var building_docs_check = validate_file('building_docs');
        var photograph_check = validate_file('photograph');
        // cast certificate only for SC/ST
        var caste_certificate_check = false;
        if(castsel == "SC" || castsel=="ST"){
            caste_certificate_check = validate_file('caste_certificate');
        }
        else{
            caste_certificate_check = true;
        }
        console.log("app_distri "+app_district_check);
        console.log("scheme_nam "+scheme_name_check);
        console.log("unit_type_ "+unit_type_check);
        console.log("name_check "+name_check);
        console.log("salutation "+salutation_check);
        console.log("aadhaar_ch "+aadhaar_check);
        console.log("resi_house "+resi_houseno_check);
        console.log("resi_wardn "+resi_wardno_check);
        console.log("resi_villa "+resi_village_check);
        console.log("resi_pin_c "+resi_pin_check);
        console.log("resi_taluk "+resi_taluk_check);
        console.log("resi_distr "+resi_district_check);
        console.log("resi_mobil "+resi_mobile_check);
        console.log("unit_name_ "+unit_name_check);
        console.log("unit_no_ch "+unit_no_check);
        console.log("unit_wardn "+unit_wardno_check);
        console.log("unit_villa "+unit_village_check);
        console.log("unit_pin_c "+unit_pin_check);
        console.log("unit_taluk "+unit_taluk_check);
        console.log("castecateg "+castecategory_check);
        console.log("education_ "+education_check);
        console.log("reg_number "+reg_number_check);
        console.log("regdate_ch "+regdate_check);
        console.log("ownership_ "+ownership_type_check);
        console.log("u100per_wo "+u100per_women_check);
        console.log("power_allo "+power_alloted_check);
        console.log("rr_number_ "+rr_number_check);
        console.log("app_date_c "+app_date_check);
        console.log("app_place_ "+app_place_check);
        console.log("pow_sanc_l "+pow_sanc_letter_check);
        console.log("trade_lice "+trade_licence_check);
        console.log("ssi_msme_c "+ssi_msme_cert_check);
        console.log("recent_bil "+recent_bill_check);
        console.log("recent_rec "+recent_receipt_check);
        console.log("building_d "+building_docs_check);
        console.log("photograph "+photograph_check);
        console.log("caste_cert "+caste_certificate_check );
        if(app_district_check && scheme_name_check && unit_type_check && name_check && salutation_check && aadhaar_check && resi_houseno_check && resi_wardno_check && resi_village_check && resi_pin_check && resi_taluk_check && resi_district_check && resi_mobile_check && unit_name_check && unit_no_check && unit_wardno_check && unit_village_check && unit_pin_check && unit_taluk_check && castecategory_check && education_check && reg_number_check && regdate_check && ownership_type_check && u100per_women_check && power_alloted_check && rr_number_check && app_date_check && app_place_check && pow_sanc_letter_check && trade_licence_check && ssi_msme_cert_check && recent_bill_check && recent_receipt_check && building_docs_check && photograph_check && caste_certificate_check ){
            return true;
        }
        return false;
    });

    //Toggle file upload and scheme selection
    $("input[name='castecategory']").change(function(){
        castsel = $("input[name='castecategory']:checked").val() || '';
        if(castsel == 'SC' || castsel == 'ST'){
            $("#caste_certificate").parent().show();
        }
        else{
            $("#caste_certificate").parent().hide();
        }
    });

    // Application district should be same as unit district
    $('#app_district').change(function(e) {
        $('#unit_district').html($("#app_district option:selected").html());
    });

    // restricting unit type
    tab_type_sel();
    $("#unit_type option").attr('disabled', true );
    $('#scheme_name').change(function(){
        scheme_name = $('#scheme_name').val();
        tab_type_sel();
        $("#unit_type").val('');
        if(scheme_name == 'lt_10hp' || scheme_name == 'gt_10hp_lt_20hp'){
            $("#unit_type option").attr('disabled', false );
            $("#unit_type option[value='shuttleless_loom']").attr('disabled', true ); 
        }
        else if(scheme_name == 'gt_20hp_50per_off'){
            $("#unit_type option").attr('disabled', true );
            $("#unit_type option[value='shuttleless_loom']").attr('disabled', false ); 
        }
        else{
            $("#unit_type option").attr('disabled', true );
        }
    });
    
    // Dissable all conditional tables
    $("#unit_type").change(function(){
            unit_type_val = $("#unit_type").val();
            tab_type_sel();
    });
    
    $('#regdate, #app_date').datepicker({
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

    // deciding what type of machine details required
    function tab_type_sel() {
        if((scheme_name == 'lt_10hp' || scheme_name == 'gt_10hp_lt_20hp') && unit_type_val == 'power_loom_unit'){
            $("#mctype1").show();
            $("#mctype2").hide();
            $("#mctype3").hide();
            mctype = 'mctype1'; 
        }
        else if((scheme_name == 'lt_10hp' || scheme_name == 'gt_10hp_lt_20hp') && unit_type_val == 'preloom_unit'){
            $("#mctype1").hide();
            $("#mctype2").show();
            $("#mctype3").hide();
            mctype = 'mctype2'; 
        }
        else if(scheme_name == 'gt_20hp_50per_off' && unit_type_val == 'shuttleless_loom'){
            $("#mctype1").hide();
            $("#mctype2").hide();
            $("#mctype3").show();
            mctype = 'mctype3'; 
        }
        else{
            $("#mctype1").hide();
            $("#mctype2").hide();
            $("#mctype3").hide();
            mctype = ''; 
        }
    }

    // Dynamic data mctype 4
    var mct_count_4 = 2;
    $("#addrow").on("click", function () {
        var cols = "";
        cols += '<td><input name="mctype4['+mct_count_4+'][raw_mtr]" type="text"></td>';
        cols += '<td><input name="mctype4['+mct_count_4+'][avg_cons]" type="text"></td>';
        cols += '<td><input name="mctype4['+mct_count_4+'][avg_prod]" type="text"></td>';
        $("#mctypeCommon tbody").append("<tr>"+cols+"</tr>");
        mct_count_4++;
    });
    //...................

    // Dynamic data mctype 1
    var mct_count_1 = 2;
    $("#mctype1_btn").on("click", function () {
        var cols = "";
        cols += '<td><input name="mctype1['+mct_count_1+'][loommake]" type="text"></td>';
        cols += '<td><input name="mctype1['+mct_count_1+'][loomnum]" type="text"></td>';
        cols += '<td><select name="mctype1['+mct_count_1+'][loomtype]"><option value="">Select</option><option value="Ordinary">Ordinary</option><option value="Semi_auto">Semi automatic</option><option value="Auto">Automatic</option><option value="co_op_society">Co-op society</option><option value="Rapier">Rapier</option></select></td>';
        cols += '<td><input name="mctype1['+mct_count_1+'][loomwidth]" type="text"></td>';
        cols += '<td><input name="mctype1['+mct_count_1+'][loompowercon]" type="text"></td>';
        cols += '<td><label for="dobby1">Dobby</label> <input id="dobby1" name="mctype1['+mct_count_1+'][att][]" type="checkbox" value="Dobby"><br> <label for="jacquard1">Jacquard</label> <input id="jacquard1" name="mctype1['+mct_count_1+'][att][]" type="checkbox" value="jacquard"><br> <label for="dropbox1">Dropbox</label> <input id="dropbox1" name="mctype1['+mct_count_1+'][att][]" type="checkbox" value="dropbox"></td>';
        $("#mctype1 table tbody").append("<tr>"+cols+"</tr>");
        mct_count_1++;
    });
    //...................
    // Dynamic data mctype 3
    var mct_count_3 = 2;
    $("#mctype3_btn").on("click", function () {
        var cols = "";
        cols += '<td><input name="mctype3['+mct_count_3+'][make]" type="text"></td>';
        cols += '<td><input name="mctype3['+mct_count_3+'][reed_space]" type="text"></td>';
        cols += '<td><input name="mctype3['+mct_count_3+'][power]" type="text"></td>';
        cols += '<td><label for="dobby3">Dobby</label> <input id="dobby3" name="mctype3['+mct_count_3+'][att][]" type="checkbox" value="Dobby"><br><label for="jacquard3">Jacquard</label> <input id="jacquard3" name="mctype3['+mct_count_3+'][att][]" type="checkbox" value="jacquard"><br><label for="dropbox3">Dropbox</label> <input id="dropbox3" name="mctype3['+mct_count_3+'][att][]" type="checkbox" value="dropbox"><br></td>';
        cols += '<td><input name="mctype3['+mct_count_3+'][loom_num]" type="text"></td>';
        $("#mctype3 table tbody").append("<tr>"+cols+"</tr>");
        mct_count_3++;
    });
    //...................
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