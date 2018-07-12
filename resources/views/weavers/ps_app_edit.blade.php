<?php 
// dd($app);
$dval = array(''=>'Select district');
foreach ($app->dists as $data)
{
    $dval[$data->id] = $data->district_name;
}
?>
@extends('layouts.public_form')
@section('custom_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<style>
    input[type=text], input[type=number]{ width: 100%; height: 20px;}
    select{ height: 20px;}
    #salutation,#name{ display: inline-block; width:auto; }
    #name{ width:91%; }
    .app_title_text{
        font-size:18px;
    }
    .small_txt{
        max-width: 200px;
    }
    .disp_inline{
        display: inline;
    }
    #othervalfeild{
        display: none;
    }
</style>
@stop
@section('content')
{{ Form::model($app, array('url' => 'weavers/powersubsidy-update/'.$app->id, 'method' => 'POST','files' => true, 'id'=>'formOne')) }}
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-content" style="max-width:1200px; margin:0 auto;">    
    <div id="content-wrapper"><br>
        <div class="container12" style="background: #f2f2f2; padding: 10px;">
            <div style="max-width: 1000px; margin: 0 auto;">
                <div class="row">
                    <div class="col-sm-2"><img src="{{asset('img/Karnataka_log.png')}}" alt="" srcset=""></div>
                    <div class="col-sm-8">
                        <h4 align="center" class="pad_top_10"><u>Government of Karnataka</u></h4>
                        <h4 align="center" class="pad_top_10"><u>Department of Handlooms and Textiles<br></u>Weaver special package Scheme</h4>
                    </div>
                    <div class="com-sm-8"><img src="{{asset('img/gov-logo.png')}}" alt="" srcset=""></div>
                </div>
                <p class="app_title_text text-center pad_top_20 pad_bottom_20">Application for seeking power subsidy for powerloom industry.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>To,<br>Deputy Director /Assistant Director,<br>Department of Handloom &amp; Textile<br>Zilla Panchayat,</p>
                    <span>District: {{ $app->app_dist_name }}</span>
              
                    <span class="error"></span>                    
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled text-right">
                        <li><a target="_blank" href="{{asset('files/less_than_10HP.pdf')}}">Download guidelines for units less than 10HP</a></li>
                        <li><a target="_blank" href="{{asset('files/Above_10HP_below_20HP.pdf')}}">Download guidelines for units above 10HP, below 20HP</a></li>
                        <li><a target="_blank" href="{{asset('files/shuttleless.pdf')}}">Download guidelines for units between 20HP and 150HP(50% subsidy)</a></li>
                    </ul>
                </div>
            </div>
            <div class="pad_top_20 pad_bottom_20"></div>
            <div class="row">
                <div class="col-sm-4 text-center">
                        <p class=""><label>For the financial year </label><br>
                            {{ Form::select('fin_year', [
                                ''=>'Select',
                                '2018-19'=>'2018-19',
                                '2017-18' => '2017-18',
                                '2016-17' => '2016-17',
                                '2015-16' => '2015-16',
                                '2014-15' => '2014-15',
                                '2013-14' => '2013-14',
                                '2012-13' => '2012-13',
                                '2011-12' => '2011-12',
                                '2010-11' => '2010-11',
                                '2009-10' => '2009-10'],
                                'null',
                                ['id'=>'fin_year']
                            ) }}
                            <span class="error"></span>
                        </p>
                </div>
                <div class="col-sm-4 text-center">
                    <label for="">Name of scheme:</label><br>
                    {{ Form::select('scheme_name', [
                        ''=>'Select',
                        'lt_10hp' => 'Units less than 10HP',
                        'gt_10hp_lt_20hp' => 'Units between 10HP to 20HP',
                        'gt_20hp_50per_off' => 'Units between 20HP and 150HP(50% subsidy)'],
                        null,
                        ['id'=>'scheme_name']
                    ) }}
                    <span class="error"></span>
                </div>
                <div class="col-sm-4 text-center">
                    <label for="">Type of unit:</label><br>
                    {{ Form::select('unit_type', [
                        ''=>'Select',
                        'power_loom_unit' => 'Powerloom unit',
                        'preloom_unit' => 'Preloom units(twisting, doubling etc.)',
                        'shuttleless_loom' => 'Shuttleless Loom unit(including preloom facility)'],
                        null,
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
                        'Smt' => 'Smt',
                        'Kumari' => 'Kumari'],
                        null,
                        ['id'=>'salutation']
                    ) }}
                    <span class="error"></span>
                    {{ Form::text('name',null,['id'=>'name']) }}
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Identity</td>
                    <td collspan="2">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>Aadhaar number</td>  
                                <td>
                                    {{ Form::text('aadhaar',null,['maxlength'=>'12']) }}
                                    <span class="error"></span>
                                </td>
                                <td>Aadhaar copy</td>
                                <td>
                                    {{ Form::file('aadhaar_file') }}
                                    <span class="error"></span>
                                </td>
                            </tr>
                        </table>
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
                                <td>{{ Form::text('resi_pin',null,['maxlength'=>'6']) }}
                                <span class="error"></span>
                                </td>
                                <td>Applicant's recent photo</td>
                                <td><input name="photograph" type="file">
                                    <span class="error"></span>
                                </td>    
                            </tr>
                            <tr>                               
                            <td>District:</td>
                                <td>
                                {{ Form::select('resi_district', $dval,'null',['id'=>'resi_district']) }}
                                    <span class="error"></span>
                                </td>
                                <td>Taluk:</td>
                                <td>                                    
                                    {{ Form::select('resi_taluk', [
                                        ''=>'Select',],
                                        null,
                                        ['id'=>'resi_taluk']
                                    ) }}
                                    <span class="error"></span>
                                </td>
                            </tr>
                            <tr>
                            <td>Landline(including STD code):</td>
                            <td>{{ Form::text('resi_phone') }}
                            <span class="error"></span>
                            </td>   
                            <td>Mobile No:</td>
                            <td>{{ Form::text('resi_mobile',null,['maxlength'=>'10']) }}
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
                                {{ Form::text('unit_pin',null,['maxlength'=>'6']) }}
                            <span class="error"></span>
                            </td>
                            <td></td>
                            <td></td>     
                        </tr>
                        <tr>
                            <td>District:</td>
                            <td>
                                <label id="unit_district">{{ $app->app_dist_name }}</label>
                            </td>
                            <td>Taluk:</td>
                            <td>
                                {{ Form::select('app_taluk', [
                                    ''=>'Select',],
                                    'null',
                                    ['id'=>'app_taluk']
                                ) }}
                                <span class="error"></span>
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
                            {{ Form::text('unit_mobile',null,['maxlength'=>'10']) }}
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
                                'textile_engineering' => 'Textile Engineering',
                                'Others' => 'Others',],
                                null,
                                ['id'=>'education']
                            ) }}
                    <span class="error"></span>
                    <div id="education_other_div" class="disp_inline">
                        <span>Please specify: </span>
                        {{ Form::text('education_other',null,['id'=>'education_other','class'=>'small_txt'])}}
                        <span class="error"></span>
                    </div>
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
                                <td>Registration Date</td>
                                <td>
                                    {{ Form::text('regdate',null,['id'=>'regdate','autocomplete'=>'off']) }}
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
                                'Others' => 'Others',],
                                null,
                                ['id'=>'ownership_type']
                            ) }}
                    <span class="error"></span>
                    <div id="ownership_other_div" class="disp_inline">
                        <span>Company name: </span>
                        {{ Form::text('ownership_other',null,['id'=>'ownership_other','class'=>'small_txt'])}}
                        <span class="error"></span>
                    </div>
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
                <td>R.R/Meter Number</td>
                <td>
                    {{ Form::text('rr_number') }}
                <span class="error"></span>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>Power sanctioned</td>
                <td colspan="2">
                    <table class="table table-bordered">
                        <tr>
                            <td>Load<br>(in HP)</td>
                            <td>
                                {{ Form::text('power_alloted') }}
                                <span class="error"></span>
                            </td>
                            <td>Sanctioned Date</td>
                            <td>
                                {{ Form::text('power_alloted_date',null,['id'=>'power_alloted_date','autocomplete'=>'off']) }}
                                <span class="error"></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>10</td>
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
                                            <th>Power consumption<br>per loom (in HP)</th>
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
                                                    'Hi_Tech_pl' => 'Hi-Tech PL',
                                                    //'Rapier' => 'Rapier',
                                                    ]
                                                ) }}
                                            </td>
                                            <td>{{ Form::text("mctype1[1][loomwidth]") }}</td>
                                            <td>{{ Form::text("mctype1[1][loompowercon]") }}</td>
                                            <td style="width:120px;">
                                                {{Form::checkbox("mctype1[1][att][]", 'Dobby','',['id'=>'dobby1'])}}&nbsp;<label for="dobby1">Dobby</label><br>
                                                {{Form::checkbox("mctype1[1][att][]", 'jacquard','',['id'=>'jacquard1'])}}&nbsp;<label for="jacquard1">Jacquard</label><br>
                                                {{Form::checkbox("mctype1[1][att][]", 'dropbox','',['id'=>'dropbox1'])}}&nbsp;<label for="dropbox1">Dropbox</label><br>
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
                                        <th>No of Spindles</th>
                                        <th>No of machines</th>
                                        <th>Power (in HP)</th>
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
                                            {{ Form::input('number', 'mctype2[pirnwind][power]', null, ['id' => 'pwr1']) }}
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
                                            {{ Form::input('number', 'mctype2[bbdbwi][power]', null, ['id' => 'pwr2']) }}
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
                                            {{ Form::input('number', 'mctype2[wrp][power]', null, ['id' => 'pwr3']) }}
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
                                            {{ Form::input('number', 'mctype2[twst][power]', null, ['id' => 'pwr4']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Other machine<br>
                                            {{ Form::text('mctype2[other][othername]','',['id'=>'othervalfeild']) }}
                                        </td>
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
                                            {{ Form::input('number', 'mctype2[other][power]', null, ['id' => 'pwr5']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><b>Total</b></td>
                                        <td><span id="powertotal"></span></td>
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
                                                <td style="width:120px;">
                                                    {{Form::checkbox("mctype3[1][att][]", 'Dobby','',['id'=>'dobby3'])}} <label for="dobby3">Dobby</label><br>
                                                    {{Form::checkbox("mctype3[1][att][]", 'jacquard','',['id'=>'jacquard3'])}} <label for="jacquard3">Jacquard</label><br>
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
                <td>11</td>
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
                            <td>Recent power bill</td>
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
                            <td>Recent Tax Paid Recipt</td>
                            <td>
                                {{ Form::file('recent_tax_receipt') }}
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
            <td>{{ Form::text('app_date',null,['id'=>'app_date','autocomplete'=>'off']) }}<span class="error"></span></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Place: </td>
            <td>{{ Form::text('app_place',null,['id'=>'app_place']) }}<span class="error"></span></td>
        </tr>
    </table>        
        <br>
            <center style="margin-right: -400px;">
                <span class="error"></span>
                    <br><br></center>
                <center>
                    <p id="errorsummer" class="error"></p>
                    <button class="btn btn-lg" type="submit" name="Submit" value="Submit"><b>Submit</b></button>
                    &nbsp;&nbsp;
                    <button class="btn btn-lg" type="reset" value="Reset"><b>Reset</b></button>
                </center>   
                <div class="footer">
                </div>         
        </div>
    </div>
    </div>
{{Form::close() }}
@stop
@section('custom_scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('js/ps_edit_script.js')}}"></script>
@stop
