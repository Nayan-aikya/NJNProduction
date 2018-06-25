@extends('layouts.public_form')
@section('title_text')
<title>NJN applications</title>
@stop
@section('custom_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    input[type=text]{ width: 100%; height: 20px;}
    select{ height: 20px;}
    #salutation,#name{ display: inline-block; width:90px; }
    #name{ width:calc(100% - 95px); }
    .app_title_text{
        font-size:18px;
    }
    .cat_select_txt{
        display: inline-block; padding: 10px; margin-left: 20px; font-weight: bold;
    }
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
        <div id="content-wrapper">
            <br>
            <div class="container12" style="background: #f2f2f2; padding: 10px;">
                <div style="max-width: 1000px; margin: 0 auto;">
                    <div class="row">
                        <div class="col-sm-2"><img src="{{asset('img/Karnataka_log.png')}}" alt="" srcset=""></div>
                        <div class="col-sm-8">
                            <h4 align="center" class="pad_top_10"><u>Government of Karnataka</u></h4>
                            <h4 align="center" class="pad_top_10"><u>Department of Handlooms & Textiles<br></u>Weaver special package Scheme</h4>
                        </div>
                        <div class="com-sm-8"><img src="{{asset('img/gov-logo.png')}}" alt="" srcset=""></div>
                    </div>
                </div>
                <p class="text-center pad_top_20 pad_bottom_20 app_title_text">Application for seeking financial assistance for purchasing of 2 loom, Elecronic Jacquard and Knotting machine from Government.</p>
                <div class="row">
                    <div class="col-sm-8">
                        <p>To,<br>Deputy Director /Assistant Director,<br>Department of Handloom &amp; Textile<br>Zilla Panchayat,</p>
                        <span>District: </span>
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
                    <div class="col-sm-4">
                        <ul class="list-unstyled text-right">
                            <li><a target="_blank" href="{{asset('files/2PowerloomsGuidelines.pdf')}}">Download guidelines for 2 powerloom scheme</a></li>
                            <li><a target="_blank" href="{{asset('files/15-Weavers-Special-Package-New-Components.pdf')}}">Download guidelines for elecronic jacquard scheme</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="pad_top_20 pad_bottom_22">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Taluk </label>
                        {{ Form::select('app_taluk', [
                            ''=>'Select',],
                            'null',
                            ['id'=>'app_taluk']
                        ) }}
                        <span class="error"></span>
                    </div>
                    <div class="col-sm-6">
                        <label>For the financial year </label>
                        {{ Form::select('fin_year', [
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
                    </div>
                </div>
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
                            <td>Applicant's Name & Address</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Name: </td>
                                            <td colspan="3">
                                            {{ Form::select('salutation', [
                                                'Sri'=>'Sri',
                                                'Smt' => 'Smt',
                                                'Kumari' => 'Kumari'],
                                                'null',
                                                ['id'=>'salutation']
                                            ) }}
                                            <span class="error"></span>
                                            {{ Form::text('name','',['id'=>'name']) }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>House No:</td>
                                            <td>
                                                {{ Form::text('resi_houseno') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Ward No:</td>
                                            <td>
                                                {{ Form::text('resi_wardno') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cross No:</td>
                                            <td>
                                                {{ Form::text('resi_crossno') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Village:</td>
                                            <td>
                                                {{ Form::text('resi_village') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>District:</td>
                                            <td>
                                                <select name="resi_district" id="resi_district">
                                                    <option value="">Select district</option>
                                                    @foreach($dists as $key => $dist)
                                                    <option value="{{$dist->id}}">{{$dist->district_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error"></span>
                                            </td>
                                            <td>Taluk:</td>
                                            <td>
                                                {{ Form::select('resi_taluk', [''=>'Select',],
                                                        'null',
                                                        ['id'=>'resi_taluk']
                                                    ) }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PIN:</td>
                                            <td>
                                                {{ Form::text('resi_pin','',['maxlength'=>'6']) }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Recent photo</td>
                                            <td>
                                                {{ Form::file('photo') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Landline(including STD code):</td>
                                            <td>
                                                {{ Form::text('resi_phone') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Mobile No:</td>
                                            <td>
                                                {{ Form::text('resi_mobile','',['maxlength'=>'10']) }}
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
                                {{ Form::text('fwh_name') }}
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
                                                {{ Form::text('dob','',['id'=>'dob','autocomplete'=>'off']) }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Age:</td>
                                            <td>
                                                {{ Form::text('age','',['id'=>'age']) }}
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
                                                {{ Form::text('aadhaar','',['maxlength'=>'12']) }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Aadhaar copy</td>
                                            <td>
                                                {{ Form::file('aadhaar_file') }}
                                                <span class="error"></span>
                                            </td>
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>
                                                {{ Form::text('email') }}
                                                <span class="error"></span>
                                            </td>
                                            <td colspan="2"></td>
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
                                                {{ Form::radio('gender', 'male', 'checked', ['id'=>'mgender']) }}&nbsp;&nbsp;
                                                <label for="fgender">Female</label>
                                                {{ Form::radio('gender', 'female', '', ['id'=>'fgender']) }}
                                                <span id="gender" class="error gender"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>                        
                        <tr>
                            <td>6</td>
                            <td>Category of the applicant<br>(Certificate to be uploaded in case of SC/ST)
                            <br><span id="castecategory" class="error castecategory"></span>
                            </td>
                            <td>
                                <table class="table table-bordered text-center" style="width:450px; margin-bottom:0; float:left;">
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
                                                {{ Form::radio("castecategory", 'SC', '', ['id'=>'SC']) }}
                                            </td>
                                            <td>
                                                {{ Form::radio("castecategory", 'ST', '', ['id'=>'ST']) }}
                                            </td>
                                            <td>
                                                {{ Form::radio("castecategory", 'Minority', '', ['id'=>'Minority']) }}
                                            </td>
                                            <td>
                                                {{ Form::radio("castecategory", 'OBC', '', ['id'=>'OBC']) }}                                              
                                            </td>
                                            <td>
                                                {{ Form::radio("castecategory", 'General', '', ['id'=>'General']) }}                                              
                                            </td>
                                        </tr>
                                        <tr id="caste_certificate_tr">
                                            <td colspan="8">
                                                <input type="file" id="caste_certificate" name="caste_certificate">
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span class="cat_select_txt"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Facilities expected from govt.</td>
                            <td>
                                <span id="facility" class="error"></span>
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="40%"><b>Facility selection.</b></td>
                                        <td>
                                            {{ Form::select('facility_sel', [
                                                ''=>'Select',
                                                '2lm'=>'Purchase of 2 powerloom scheme',
                                                'ejs' => 'Elecronic Jacquard shceme',
                                                'kms' => 'Knotting machine',
                                                'sap' => 'Semi automatic power loom',
                                                'ops' => 'Ordinary powerloom'],
                                                'null',
                                                ['id'=>'facility_sel']
                                            ) }}
                                            <span class="error"></span>
                                        </td>
                                    </tr>
                                    <tr id="wka_tr">
                                        <td><label for="wka">Working capital assistance for SC/ST</label></td>
                                        <td> {{Form::checkbox("wka", 'Yes','',['id'=>'wka'])}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Annual income<br>(In rupees)</td>
                            <td>
                                {{ Form::text('income') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr id="spc_avl">
                            <td>9</td>
                            <td>Space available for the unit</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Built Up Area (in sft)</td>
                                            <td>
                                                {{ Form::text('space_sqft') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>SSI/MSME License</td>
                                            <td>
                                                {{ Form::file('ind_licence_copy') }}
                                                <span class="error"></span>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>General License Copy</td>
                                            <td colspan="3">
                                                {{ Form::file('general_licence_copy') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Building Details</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Building&nbsp;type</td>
                                            <td style="width: 100px;">
                                                {{ Form::radio('building_own_type','Own', '', ['id'=>'own']) }}&nbsp;<label for="own">Own</label><br>
                                                {{ Form::radio('building_own_type','Rent','',['id'=>'rent']) }}&nbsp;<label for="rent">Rent</label><br>
                                                {{ Form::radio('building_own_type','Lease','',['id'=>'Lease']) }}&nbsp;<label for="Lease">Lease</label><br>
                                                <span id="building_own_type" class="error"></span>
                                            </td>
                                            <td>Building documents/<br>Rent agreement/<br>Lease agreement</td>
                                            <td>
                                                {{ Form::file('building_docs') }}
                                                <span class="error"></span>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Address of proposed unit</td>
                            <td>
                                {{ Form::textarea('plan_uadd', null, ['size' => '100%x5']) }}
                                <span id="plan_uadd" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Training Certificate<br>(certificate from state/central govt.)</td>
                            <td>
                                {{ Form::file('training_cert') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Power details</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>R.R/Meter Number</td>
                                            <td>
                                                {{ Form::text('rr_number') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Connected Load/Power (HP)</td>
                                            <td>
                                                {{ Form::text('connect_load') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="msme_ssi_tr">
                            <td>14</td>
                            <td>MSME/SSI Registraion No</td>
                            <td>
                                {{ Form::text('msme_number') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr class="msme_ssi_tr">
                            <td>14&nbsp;a</td>
                            <td>Number of looms</td>
                            <td>
                                {{ Form::text('num_of_looms') }}
                                <span class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Bank preference for scheme sponsorship </td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><label for="bankpref1">Nationalised Bank</label>
                                                {{ Form::radio('prepBank_type', 'Nationalised Bank', '', ['id'=>'bankpref1']) }}                                              
                                                &nbsp;&nbsp;
                                                <label for="bankpref2">Financial Institutes</label>
                                                {{ Form::radio('prepBank_type', 'Financial Institute', '', ['id'=>'bankpref2']) }}
                                                &nbsp;&nbsp; 
                                                <label for="bankpref3">Co-operative Bank</label>
                                                {{ Form::radio('prepBank_type', 'Co operative Bank', '', ['id'=>'bankpref3']) }}
                                                &nbsp;&nbsp;
                                                <label for="bankpref4">Co-operative Society</label>
                                                {{ Form::radio('prepBank_type', 'Co operative Society', '', ['id'=>'bankpref4']) }}
                                                &nbsp;&nbsp;
                                                <label for="bankpref5">Other</label>
                                                {{ Form::radio('prepBank_type', 'Other', '', ['id'=>'bankpref5']) }}
                                                <span id="prepBank_type" class="error bankpref"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Bank name</td>
                                            <td>
                                                {{ Form::text('prepBank_bankname') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Amount of Sanctioned loan<br>(Rupees)</td>
                                            <td>
                                                {{ Form::text('prepBank_loanamt') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Amount Sanctioned Date</td>
                                            <td>
                                                {{ Form::text('prepBank_date','',['autocomplete'=>'off']) }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Sanction letter Copy</td>
                                            <td>
                                                {{ Form::file('prepBank_sancLetter') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Beneficiary Account Details</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Bank name</td>
                                            <td>
                                                {{ Form::text('ubank_name') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Name as per bank</td>
                                            <td>{{ Form::text('ubank_uname') }}
                                                <span class="error actype"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Branch name</td>
                                            <td>
                                                {{ Form::text('ubank_branch') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>Account type</td>
                                            <td>
                                                <label for="SB">SB</label>
                                                {{ Form::radio('ubank_actype', 'SB', 'checked', ['id'=>'SB']) }}
                                                &nbsp;
                                                <label for="current">Current</label>
                                                {{ Form::radio('ubank_actype', 'current', '', ['id'=>'current']) }}
                                                <span class="error actype"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Account No</td>
                                            <td>
                                                {{ Form::text('ubank_acno') }}
                                                <span class="error"></span>
                                            </td>
                                            <td>IFSC No</td>
                                            <td>
                                                {{ Form::text('ubank_ifsc') }}
                                                <span class="error"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <br>
                <p>I Hereby declare that all above furnished information is correct to the best of my knowledge and belief. I further declare that I/My Family have not availed any financial assistance under above scheme earlier. I also abide by all the terms and conditions of the scheme and amendments to it time to time.</p>
                <br>
                <table>
                    <tbody>
                        <tr>
                            <td>Date: </td>
                            <td>
                            {{ Form::text('appdate','',['autocomplete'=>'off']) }}
                            <span class="error"></span>
                            </td>
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
</form>
@stop
@section('custom_scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('js/ej2l_script.js')}}"></script>
@stop
