@extends('layouts.public_form')
@section('custom_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<style>
    input[type=text]{ width: 100%; height: 20px;}
    #salutation,#name{ display: inline-block; width:auto; }
    #name{ width:91%; }
</style>
@stop
@section('content')
<form id="formOne" action="{{url('weavers/powersubsidy-apply')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-content" style="max-width:1200px; margin:0 auto;">    
    <div id="content-wrapper"><br>
        <div class="container12" style="background: #f2f2f2; padding: 10px;">
            <div style="max-width: 1000px; margin: 0 auto;">
                <div class="row">
                    <div class="col-sm-2"><img src="{{asset('img/Karnataka_log.png')}}" alt="" srcset=""></div>
                    <div class="col-sm-8">
                        <h4 align="center" class="pad_top_10"><u>Government of Karnataka</u></h4>
                        <h4 align="center" class="pad_top_10"><u>Handloom & Textile Department<br></u>Weaver special package plan</h4>
                    </div>
                    <div class="com-sm-8"><img src="{{asset('img/gov-logo.png')}}" alt="" srcset=""></div>
                </div>
            </div>
            <p class="app_title_text text-center pad_top_20 pad_bottom_20">Application for seeking power subsidy for powerloom industry from government.</p>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <p>District:</p>
                    <?php
                        $dval = array(''=>'Select district');
                        foreach ($dists as $data)
                        {
                            $dval[$data->id] = $data->district_name;
                        }
                    ?>
                    {{ Form::select('app_district', $dval,'null',['id'=>'app_district']) }}
                    <span class="error"></span>
                </div>
                <div class="col-sm-4 text-center">
                    <p>Name of scheme:</p>
                    {{ Form::select('scheme_name', [
                        ''=>'Select',
                        'lt_10hp' => 'Units less than 10hp',
                        'gt_10hp_lt_20hp' => 'Units between 10hp to 20hp',
                        'gt_20hp_50per_off' => 'Units between 20hp and 150hp(50% subsidy)'],
                        'null',
                        ['id'=>'scheme_name']
                    ) }}
                    <span class="error"></span>
                </div>
                <div class="col-sm-4 text-center">
                    <p>Type of unit:</p>
                    {{ Form::select('unit_type', [
                        ''=>'Select',
                        'power_loom_unit' => 'Powerloom unit',
                        'preloom_unit' => 'Preloom units(twisting, doubling etc.)',
                        'shuttleless_loom' => 'Shuttleless Loom unit(including preloom facility)'],
                        'null',
                        ['id'=>'unit_type']
                    ) }}
                    <span class="error"></span>
                </div>
            </div>
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
                    <td>1</td>
                    <td>Applicant's full Name</td>  
                    <td>
                    {{ Form::select('salutation', [
                        'Sri'=>'Sri',
                        'Smt' => 'Smt'],
                        'null',
                        ['id'=>'salutation']
                    ) }}
                    <span class="error"></span>
                    {{ Form::text('name','',['id'=>'name']) }}
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Aadhaar number</td>  
                    <td>
                        {{ Form::text('aadhaar') }}
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">3</td>
                    <td>A)Residential address</td>
                    <td>
                        <table class="table table-bordered">
        
                        <tbody>
                            <tr>
                            <td>House No:</td>
                            <td>{{ Form::text('resi_houseno') }}
                                <span class="error"></span>
                            </td> 
                            <td>Ward No:</td>
                            <td>{{ Form::text('resi_wardno') }}
                                <span class="error"></span>
                            </td>
                            </tr>
                            <tr>
                            <td>Cross No:</td>
                            <td>{{ Form::text('resi_crossno') }}
                            <span class="error"></span>
                            </td>
                            <td>Village:</td>
                            <td>{{ Form::text('resi_village') }}
                            <span class="error"></span>
                            </td>     
                            </tr>
                            <tr>
                                <td>PIN:</td>
                                <td>{{ Form::text('resi_pin') }}
                                <span class="error"></span>
                                </td>
                                <td>Applicant's recent photo</td>
                                <td><input name="photograph" type="file">
                                    <span class="error"></span>
                                </td>    
                            </tr>
                            <tr>
                            <td>Taluk:</td>
                            <td>{{ Form::text('resi_taluk') }}
                            <span class="error"></span>
                            </td>   
                            <td>District:</td>
                            <td>
                                {{ Form::select('resi_district', $dval,'null',['id'=>'app_district']) }}
                                <span class="error"></span>
                            </td>       
                            </tr>
                            <tr>
                            <td>Landline(including STD code):</td>
                            <td>{{ Form::text('resi_phone') }}
                            <span class="error"></span>
                            </td>   
                            <td>Mobile No:</td>
                            <td>{{ Form::text('resi_mobile') }}
                            <span class="error"></span>
                            </td>       
                            </tr>
                        </tbody>
                        </table>
                    </td>
                    
                </tr>            
                <tr>
                    <td>B)Unit Address<br>(Building doccuments to be attached)</td>
                    <td>
                    <table class="table table-bordered">
        
                        <tbody>
                        <tr>
                            <td>Name of the unit:</td>
                            <td colspan="3">
                                {{ Form::text('unit_name') }}
                            <span class="error"></span>
                            </td>
                            </tr>
                        <tr>
                        <tr>
                            <td>Building No:</td>
                            <td>
                                {{ Form::text('unit_no') }}
                            <span class="error"></span>
                            </td> 
                            <td>Ward No:</td>
                            <td>
                                {{ Form::text('unit_wardno') }}
                            <span class="error"></span>
                            </td>
                            </tr>
                        <tr>
                            <td>Cross No:</td>
                            <td>
                                {{ Form::text('unit_crossno') }}
                            <span class="error"></span>
                            </td>
                            <td>Village:</td>
                            <td>
                                {{ Form::text('unit_village') }}
                            <span class="error"></span>
                            </td>     
                        </tr>
                        <tr>
                            <td>PIN:</td>
                            <td>
                                {{ Form::text('unit_pin') }}
                            <span class="error"></span>
                            </td>
                            <td></td>
                            <td></td>     
                        </tr>
                        <tr>
                            <td>Taluk:</td>
                            <td>
                            {{ Form::text('unit_taluk') }}
                            <span class="error"></span>
                            </td>   
                            <td>District:</td>
                            <td>
                                <label id="unit_district">NA</label>
                            </td>       
                        </tr>
                        <tr>
                            <td>Landline(including STD code):</td>
                            <td>
                                {{ Form::text('unit_phone') }}
                            <span class="error"></span>
                            </td>   
                            <td>Mobile No:</td>
                            <td>
                            {{ Form::text('unit_mobile') }}
                            <span class="error"></span>
                            </td>       
                        </tr>
                        </tbody>
                    </table>
                    </td>
                    
                    
                </tr>
                <tr>
                    <td>4</td>
                    <td>Category Name <span id="castecategory" class="error"></span></td>
                    <td>
                        <table class="table table-bordered text-center" style="width:450px; margin-bottom:0;">
                            <tbody>
                                <tr>
                                    <td><label for="SC">SC</label></td>
                                    <td><label for="ST">ST</label></td>
                                    <td><label for="Minority">Minority</label></td>
                                    <td><label for="OBC">OBC</label></td>
                                    <td><label for="General">General</label></td>
                                </tr>
                                <tr>

                                    <td>
                                        {{ Form::radio('castecategory', 'SC', '', ['id'=>'SC']) }}
                                    </td>
                                    <td>
                                        {{ Form::radio('castecategory', 'ST', '', ['id'=>'ST']) }}
                                    </td>
                                    <td>
                                        {{ Form::radio('castecategory', 'Minority', '', ['id'=>'Minority']) }}
                                    </td>
                                    <td>
                                        {{ Form::radio('castecategory', 'OBC', '', ['id'=>'OBC']) }}
                                    </td>
                                    <td>
                                        {{ Form::radio('castecategory', 'General', '', ['id'=>'General']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8">
                                        <input type="file" id="caste_certificate" name="caste_certificate">
                                        <span class="error"></span>
                                    </td>
                                </tr>
                        </tbody>
                        </table>
                    </td>                    
                </tr>
                <tr>
                    <td>5</td>
                    <td>Educational Qualification</td>
                    <td>
                            {{ Form::select('education', [
                                ''=>'Select',
                                'lt_10' => 'Standerd 10 or below',
                                'PUC' => 'PUC',
                                'UG' => 'Graduate',
                                'PG' => 'Post graduate',
                                'textile_engineering' => 'Textile Engineering',]
                            ) }}
                    <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>SSI/MSME registration</td>
                    <td colspan="2">
                        <table class="table table-bordered">
                            <tr>
                                <td>Number</td>
                                <td>
                                    {{ Form::text('reg_number') }}
                                    <span class="error"></span>
                                </td>
                                <td>Mou Date</td>
                                <td>
                                    {{ Form::text('regdate','',['id'=>'regdate']) }}
                                    <span class="error"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Type of ownership</td>
                    <td>
                        {{ Form::select('ownership_type', [
                                ''=>'Select',
                                'Proprietary' => 'Proprietary owner',
                                'Partnership' => 'Partnership',
                                'PVT_LTD' => 'Private limited',
                                'co_op_society' => 'Co-op society',
                                'others' => 'Others',]
                            ) }}
                    <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>7b</td>
                    <td>100% women unit?</td>
                    <td>
                        <label for="100fm_yes">Yes</label>
                        {{ Form::radio('u100per_women', 'Yes', '', ['id'=>'100fm_yes']) }}
                        &nbsp;&nbsp;
                        <label for="100fm_no">No</label>
                        {{ Form::radio('u100per_women', 'No', '', ['id'=>'100fm_no']) }}
                    <span id="u100per_women" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Power sanction load<br>(in hp)</td>
                    <td>
                        {{ Form::text('power_alloted') }}
                        <span class="error"></span>
                    </td>  
                </tr>
            <tr>
            </tr>
            <tr>
                <td>9</td>
                <td>R.R Number/Meter number</td>
                <td>
                    {{ Form::text('rr_number') }}
                <span class="error"></span>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>Details of Machinery</td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <div id="mctype1">
                                    <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Powerloom make name</th>
                                            <th>Number of looms</th>
                                            <th>Type of loom</th>
                                            <th>Width of loom<br> (in inchs)</th>
                                            <th>Power consumption per loom<br> (in hp)</th>
                                            <th>Attachment</th>                                            
                                        </tr>
                                        <tr>
                                            <td>{{ Form::text("mctype1[1][loommake]") }}</td>
                                            <td>{{ Form::text("mctype1[1][loomnum]") }}</td>
                                            <td>
                                                {{ Form::select("mctype1[1][loomtype]", [
                                                    ''=>'Select',
                                                    'Ordinary' => 'Ordinary',
                                                    'Semi_auto' => 'Semi automatic',
                                                    'Auto' => 'Automatic',
                                                    'co_op_society' => 'Co-op society',
                                                    'Rapier' => 'Rapier',]
                                                ) }}
                                            </td>
                                            <td>{{ Form::text("mctype1[1][loomwidth]") }}</td>
                                            <td>{{ Form::text("mctype1[1][loompowercon]") }}</td>
                                            <td>
                                                <label for="dobby1">Dobby</label> {{Form::checkbox("mctype1[1][att][]", 'Dobby','',['id'=>'dobby1'])}}<br>
                                                <label for="jacquard1">Jacquard</label> {{Form::checkbox("mctype1[1][att][]", 'jacquard','',['id'=>'jacquard1'])}}<br>
                                                <label for="dropbox1">Dropbox</label> {{Form::checkbox("mctype1[1][att][]", 'dropbox','',['id'=>'dropbox1'])}}<br>
                                            </td>
                                        </tr>
                                        </tbody>                               
                                    </table>
                                    <button id="mctype1_btn" type="button">Add row</button>
                                </div>
                                
                                <div id="mctype2">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Preloom facility machines</th>
                                        <th>Availability</th>
                                        <th>No of spin looms</th>
                                        <th>No of machines</th>
                                        <th>Power (in hp)</th>
                                    </tr>
                                    <tr>
                                        <td>Pirn winding machine</td>
                                        <td>
                                            <label for="pirnwind_avail_yes">Yes</label>
                                            {{ Form::radio("mctype2[pirnwind][avail]", 'Yes', '', ['id'=>'pirnwind_avail_yes']) }}
                                            &nbsp;<br>&nbsp;
                                            <label for="pirnwind_avail_no">No</label>
                                            {{ Form::radio("mctype2[pirnwind][avail]", 'No', '', ['id'=>'pirnwind_avail_no']) }}
                                            <span class="error"></span>
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[pirnwind][num_loom]") }}
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[pirnwind][num_mcs]") }}

                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[pirnwind][power]") }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bobbin/dubbling/winding</td>
                                        <td>
                                            <label for="bbdbwi_avail_yes">Yes</label>
                                            {{ Form::radio("mctype2[bbdbwi][avail]", 'Yes', '', ['id'=>'bbdbwi_avail_yes']) }}
                                            &nbsp;<br>&nbsp;
                                            <label for="bbdbwi_avail_no">No</label>
                                            {{ Form::radio("mctype2[bbdbwi][avail]", 'No', '', ['id'=>'bbdbwi_avail_no']) }}
                                            <span class="error"></span>
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[bbdbwi][num_loom]") }}
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[bbdbwi][num_mcs]") }}

                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[bbdbwi][power]") }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Warping machine</td>
                                        <td>
                                            <label for="wrp_avail_yes">Yes</label>
                                            {{ Form::radio("mctype2[wrp][avail]", 'Yes', '', ['id'=>'wrp_avail_yes']) }}
                                            &nbsp;<br>&nbsp;
                                            <label for="wrp_avail_no">No</label>
                                            {{ Form::radio("mctype2[wrp][avail]", 'No', '', ['id'=>'wrp_avail_no']) }}
                                            <span class="error"></span>
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[wrp][num_loom]") }}
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[wrp][num_mcs]") }}

                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[wrp][power]") }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Twisting machine</td>
                                        <td>
                                            <label for="twst_avail_yes">Yes</label>
                                            {{ Form::radio("mctype2[twst][avail]", 'Yes', '', ['id'=>'twst_avail_yes']) }}
                                            &nbsp;<br>&nbsp;
                                            <label for="twst_avail_no">No</label>
                                            {{ Form::radio("mctype2[twst][avail]", 'No', '', ['id'=>'twst_avail_no']) }}
                                            <span class="error"></span>
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[twst][num_loom]") }}
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[twst][num_mcs]") }}

                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[twst][power]") }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Other machine</td>
                                        <td>
                                            <label for="other_avail_yes">Yes</label>
                                            {{ Form::radio("mctype2[other][avail]", 'Yes', '', ['id'=>'other_avail_yes']) }}
                                            &nbsp;<br>&nbsp;
                                            <label for="other_avail_no">No</label>
                                            {{ Form::radio("mctype2[other][avail]", 'No', '', ['id'=>'other_avail_no']) }}
                                            <span class="error"></span>
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[other][num_loom]") }}
                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[other][num_mcs]") }}

                                        </td>
                                        <td>
                                            {{ Form::text("mctype2[other][power]") }}
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <div id="mctype3">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Make of shuttleless power loom</th>
                                                <th>Width of loom (Reed space)</th>
                                                <th>Connected power</th>
                                                <th>Attachment type</th>
                                                <th>Number of looms</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{ Form::text("mctype3[1][make]") }}
                                                </td>
                                                <td>
                                                    {{ Form::text("mctype3[1][reed_space]") }}
                                                </td>
                                                <td>
                                                    {{ Form::text("mctype3[1][power]") }}
                                                </td>
                                                <td>
                                                    <label for="dobby3">Dobby</label> {{Form::checkbox("mctype3[1][att][]", 'Dobby','',['id'=>'dobby3'])}}<br>
                                                    <label for="jacquard3">Jacquard</label> {{Form::checkbox("mctype3[1][att][]", 'jacquard','',['id'=>'jacquard3'])}}<br>
                                                    <label for="dropbox3">Dropbox</label> {{Form::checkbox("mctype3[1][att][]", 'dropbox','',['id'=>'dropbox3'])}}<br>
                                                </td>
                                                <td>
                                                    {{ Form::text("mctype3[1][loom_num]") }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button id="mctype3_btn">Add row</button>
                                </div>                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table id="mctypeCommon" class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Raw material used</th>
                                            <th>Monthly average consumption(In KGs)</th>
                                            <th>Monthly average production (In meters)</th>
                                        </tr>
                                        <tr>
                                            <td>{{ Form::text("mctype4[1][raw_mtr]") }}</td>
                                            <td>{{ Form::text("mctype4[1][avg_cons]") }}</td>
                                            <td>{{ Form::text("mctype4[1][avg_prod]") }}</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                                <button id="addrow">Add new row</button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td>Attachments</td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>Electricity power saction letter</td>
                            <td>
                                {{ Form::file('pow_sanc_letter') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Trade licence/Factory licence</td>
                            <td>
                                {{Form::file('trade_licence')}}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>SSI/MSME certificate</td>
                            <td>
                                {{ Form::file('ssi_msme_cert') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Recetnt power bill</td>
                            <td>
                                {{ Form::file('recent_bill') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Recent power bill payment receipt</td>
                            <td>
                                {{ Form::file('recent_receipt') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Building documents/Rent agreement/Lease agreement</td>
                            <td>
                                {{ Form::file('building_docs') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <p>I here by Certify that the information provided by me is true. The power supplied at subsidised  rate will be utilized for power loom and pre-loom activity. In case Power is utilized for any other purpose legal action can be taken on me and my unit. I here by certify that information provided by true </p><br>
    <table>
        <tr>
            <td>Date: </td>
            <td>{{ Form::text('app_date','',['id'=>'app_date']) }}<span class="error"></span></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Place: </td>
            <td>{{ Form::text('app_place','',['id'=>'app_place']) }}<span class="error"></span></td>
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
<script src="{{asset('js/ps_apply_script.js')}}"></script>
@stop
