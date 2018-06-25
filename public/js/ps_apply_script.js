// Js for power subsidy scheme form validation
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
    var education = $("select[name='education']").val() || '';
    edu_change();
    var ownership_type = $("select[name='ownership_type']").val() || '';
    ownership_change();
    
    $("#formOne").submit(function(e){        
        education = $("select[name='education']").val();

        var app_district_check = validate_dropdown(req_reg, 'app_district');
        var app_taluk_check = validate_dropdown(req_reg, 'app_taluk');
        var scheme_name_check = validate_dropdown(req_reg, 'scheme_name');
        var unit_type_check = validate_dropdown(req_reg, 'unit_type');
        var name_check = validate_inputtext(name_reg, 'name');
        var salutation_check = validate_dropdown(req_reg, 'salutation');
        var aadhaar_check = validate_inputtext(uid_reg, 'aadhaar');
        var resi_houseno_check = validate_inputtext(req_reg, 'resi_houseno');
        var resi_wardno_check = validate_inputtext(req_reg, 'resi_wardno');
        var resi_village_check = validate_inputtext(req_reg, 'resi_village');
        var resi_pin_check = validate_inputtext(req_reg, 'resi_pin');
        var resi_taluk_check = validate_dropdown(req_reg, 'resi_taluk');
        var resi_district_check = validate_dropdown(req_reg, 'resi_district');
        var resi_mobile_check = validate_inputtext(mob_reg, 'resi_mobile');
        var unit_name_check = validate_inputtext(req_reg, 'unit_name');
        var unit_no_check = validate_inputtext(req_reg, 'unit_no');
        var unit_wardno_check = validate_inputtext(req_reg, 'unit_wardno');
        var unit_village_check = validate_inputtext(req_reg, 'unit_village');
        var unit_pin_check = validate_inputtext(pin_reg, 'unit_pin');
        var castecategory_check = validate_radio(req_reg, 'castecategory');
        var reg_number_check = validate_inputtext(req_reg, 'reg_number');
        var regdate_check = validate_inputtext(date_reg, 'regdate');        
        var u100per_women_check = validate_radio(req_reg, 'u100per_women');
        var power_alloted_check = validate_inputtext(num_reg, 'power_alloted');
        var power_alloted_date_check = validate_inputtext(date_reg, 'power_alloted_date');
        var rr_number_check = validate_inputtext(req_reg, 'rr_number');
        var app_date_check = validate_inputtext(date_reg, 'app_date');
        var app_place_check = validate_inputtext(req_reg, 'app_place');
        var pow_sanc_letter_check = validate_file('pow_sanc_letter');
        var trade_licence_check = validate_file('trade_licence');
        var ssi_msme_cert_check = validate_file('ssi_msme_cert');
        var recent_bill_check = validate_file('recent_bill');
        var recent_receipt_check = validate_file('recent_receipt');
        var recent_tax_receipt_check = validate_file('recent_tax_receipt');
        var building_docs_check = validate_file('building_docs');
        var photograph_check = validate_file('photograph');
        var aadhaar_file_check = validate_file('aadhaar_file');

        // Education feild for others
        education_check = false;
        validate_dropdown(req_reg, 'education');
        if(education == 'lt_10' || education == 'PUC' || education == 'UG' || education == 'PG'|| education == 'textile_engineering'){
            education_check = true;
        }
        var education_other = $("input[name='education_other']").val();
        if(education == 'Others' && validate_inputtext(req_reg, 'education_other')){
            education_check = true;
        }
        
        // ownership_type other field test
        var ownership_type_check = false;
        validate_dropdown(req_reg, 'ownership_type');
        var ownership_type = $("select[name='ownership_type']").val() || '';
        if(ownership_type == 'Proprietary' || ownership_type == 'Partnership' || ownership_type =='PVT_LTD' || ownership_type == 'co_op_society'){
            ownership_type_check = true;
        }
        if(ownership_type == 'Others' && validate_inputtext(req_reg, 'ownership_other')){
            ownership_type_check = true;
        }

        if(app_district_check && app_taluk_check && scheme_name_check && unit_type_check && name_check && salutation_check && aadhaar_check && aadhaar_file_check && resi_houseno_check && resi_wardno_check && resi_village_check && resi_pin_check && resi_taluk_check && resi_district_check && resi_mobile_check && unit_name_check && unit_no_check && unit_wardno_check && unit_village_check && unit_pin_check && castecategory_check && education_check && reg_number_check && regdate_check && ownership_type_check && u100per_women_check && power_alloted_check && power_alloted_date_check && rr_number_check && app_date_check && app_place_check && pow_sanc_letter_check && trade_licence_check && ssi_msme_cert_check && recent_bill_check && recent_receipt_check && recent_tax_receipt_check && building_docs_check && photograph_check){
            return true;
        }
        else{
            $("#errorsummer").html('One or more errors found, please correct and try again!');
            return false;
        }
    });

    // Education change
    $("#education").change(function() {
        education = $("select[name='education']").val();
        edu_change();
    });
    function edu_change(){
        if(education == 'Others'){
            $('#education_other_div').show();
        }
        else{
            $('#education_other_div').hide();
            $('#education_other').val('');
        }
    }

    // Ownership change
    $("#ownership_type").change(function() {
        ownership_type = $("select[name='ownership_type']").val();
        ownership_change();
    });
    function ownership_change(){
        if(ownership_type == 'Others'){
            $('#ownership_other_div').show();
        }
        else{
            $('#ownership_other_div').hide();
            $('#ownership_other').val('');
        }
    }

    //Toggle file upload and scheme selection
    $("input[name='castecategory']").change(function(){
        castsel = $("input[name='castecategory']:checked").val() || '';
    });

    // Application district should be same as unit district
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
    
    // Calendar activation
    $('#regdate, #app_date, #power_alloted_date').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "1908:2018",
        dateFormat: 'dd-mm-yy',
    });

    // Other Preloom other machine details change
    $("input[name='mctype2[other][avail]']").change(function(){
        var oval = $("input[name='mctype2[other][avail]']:checked").val() || '';
        if(oval == 'Yes'){
            $('#othervalfeild').show();
        }
        else{
            $('#othervalfeild').hide();
            $('#othervalfeild').val('');
        }
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
        cols += '<td><select name="mctype1['+mct_count_1+'][loomtype]"><option value="">Select</option><option value="Ordinary">Ordinary</option><option value="Semi_auto">Semi automatic</option><option value="Auto">Automatic</option><option value="Hi_Tech_pl">Hi-Tech PL</option></select></td>';
        cols += '<td><input name="mctype1['+mct_count_1+'][loomwidth]" type="text"></td>';
        cols += '<td><input name="mctype1['+mct_count_1+'][loompowercon]" type="text"></td>';
        cols += '<td><input id="dobby1" name="mctype1['+mct_count_1+'][att][]" type="checkbox" value="Dobby">&nbsp;<label for="dobby1">Dobby</label><br><input id="jacquard1" name="mctype1['+mct_count_1+'][att][]" type="checkbox" value="jacquard">&nbsp;<label for="jacquard1">Jacquard</label><br><input id="dropbox1" name="mctype1['+mct_count_1+'][att][]" type="checkbox" value="dropbox">&nbsp;<label for="dropbox1">Dropbox</label></td>';
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
        cols += '<td><input id="dobby3" name="mctype3['+mct_count_3+'][att][]" type="checkbox" value="Dobby"> <label for="dobby3">Dobby</label><br><input id="jacquard3" name="mctype3['+mct_count_3+'][att][]" type="checkbox" value="jacquard"> <label for="jacquard3">Jacquard</label></td>';
        cols += '<td><input name="mctype3['+mct_count_3+'][loom_num]" type="text"></td>';
        $("#mctype3 table tbody").append("<tr>"+cols+"</tr>");
        mct_count_3++;
    });
    //...................

    //Total of machine type 3
    $('#pwr1, #pwr2, #pwr3, #pwr4, #pwr5').change(function(){
        var pwr1 = parseInt($("#pwr1").val());
            if(pwr1 == '' || isNaN(pwr1)){
                pwr1 = 0;
            }
        var pwr2 = parseInt($("#pwr2").val());
            if(pwr2 == '' || isNaN(pwr2)){
                pwr2 = 0;
            }
        var pwr3 = parseInt($("#pwr3").val());
            if(pwr3 == '' || isNaN(pwr3)){
                pwr3 = 0;
            }
        var pwr4 = parseInt($("#pwr4").val());
            if(pwr4 == '' || isNaN(pwr4)){
                pwr4 = 0;
            }
        var pwr5 = parseInt($("#pwr5").val());
            if(pwr5 == '' || isNaN(pwr5)){
                pwr5 = 0;
            }
        var totalpwr = pwr1+pwr2+pwr3+pwr4+pwr5;
        $("#powertotal").html(totalpwr);
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
