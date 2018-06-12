@extends('layouts.sidebar')
@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@stop
@section('content')
<div class="form-content">
        <h2 align="center"><u>Government of Karnataka</u></h2>
        <h3 align="center"><u>Handloom & Textile Department<br></u>Weaver special package plan</h3>
        <div id="content-wrapper">
            <br>
            <div class="container12" style="background: #f2f2f2; padding: 10px;">
                <p class="text-center">Application for seeking loan to buy Elecronic Jacquard/Knotting machine from government.</p>
                <p>To,<br>Deputy Director,<br>Handloom &amp; Textile Department,<br>District Panchayat,</p>
                <p>{{$app->app_district}}</p>
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
                                            <td colspan="3">{{$app->name}}</td>
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
                                            <td>Recent photo</td>
                                            <td>@if($app->photo != '')
                                                <a href="{{url('weavers/ej-2loom-getfile/photo/'.$app->id)}}" target="_blank">Download</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Landline(including STD code):</td>
                                            <td>{{$app->resi_phone}}</td>
                                            <td>Mobile No:</td>
                                            <td>{{$app->resi_mobile}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Father/Husband/Wife Name</td>
                            <td>{{$app->fwh_name}}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>DOB & Age</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>DOB:</td>
                                            <td>{{$app->dob}}</td>
                                            <td>Age:</td>
                                            <td>{{$app->age}}</td>
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
                                            <td>{{$app->aadhaar}}</td>
                                            <td>Email:</td>
                                            <td>{{$app->email}}</td>
                                        </tr>                                                
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Gender</td>
                            <td>{{$app->gender}}</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td colspan="2">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Facilities expected from govt.</th>                                    
                                        <th>Selecte</th>
                                    </tr>
                                    <tr>
                                        <td>Electric two loom scheme</td>
                                        <td>{{$app->e2l}}</td>
                                    </tr>
                                    <tr>
                                        <td>Elecronic Jacquard shceme</td>
                                        <td>{{$app->ejs}}</td>
                                    </tr>
                                    <tr>
                                        <td>Knotting machine</td>
                                        <td>{{$app->kms}}</td>
                                    </tr>
                                    <tr>
                                        <td>Semi automatic power loom</td>
                                        <td>{{$app->sap}}</td>
                                    </tr>
                                    <tr>
                                        <td>Capital investment scheme</td>
                                        <td>{{$app->cis}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Category</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>{{$app->cis}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($app->photo != '')
                                                <a href="{{url('weavers/ej-2loom-getfile/cast_cert/'.$app->id)}}" target="_blank">Download</a>
                                                @endif
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Yearly Income</td>
                            <td>{{$app->cast_cert}}</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Space available to setup the unit (in sqr foots)</td>
                            <td>{{$app->space_sqft}}</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Training Certificate<br>(certificate from state/central govt.)</td>
                            <td>
                                @if($app->photo != '')
                                <a href="{{url('weavers/ej-2loom-getfile/training_cert/'.$app->id)}}" target="_blank">Download</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Planned unit's address</td>
                            <td>{{$app->plan_uadd}}</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Power Description</td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>R.R No</td>
                                            <td>{{$app->rr_number}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>MSME Registraion No<br>(Only for Jacquard and Knotting machine)</td>
                            <td>{{$app->msme_number	}}</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Bank preference for scheme sponsorship </td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                        <td>{{$app->bankpref}}</td>
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
                                            <td>{{$app->bank_branch}}</td>
                                            <td>SB/Current</td>
                                            <td>{{$app->actype}}</td>
                                        </tr>
                                        <tr>
                                            <td>Account No</td>
                                            <td>{{$app->bank_acno}}</td>
                                            <td>IFSC No</td>
                                            <td>{{$app->bank_ifsc}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Expected loan<br>(in rupies)</td>
                            <td>{{$app->exp_loan}}</td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Inspection</td>
                            <td>
                                <ul>
                                    <li>Inspection photos: {{$app->ins_app_photo}}</li>
                                    <li>Aadhaar number: {{$app->ins_aadhaar_no}}</li>
                                    <li>Aadhaar photo: {{$app->ins_aadhaar_img}}</li>
                                    <li>
                                    @if ($app->ins_status == 'pending')
                                    <span class="label label-warning">Pending</span>
                                    @endif
                                    @if ($app->ins_status == 'approved')
                                    <span class="label label-success">Approved</span>
                                    @endif
                                    @if ($app->ins_status == 'rejected')
                                    <span class="label label-danger">Rejected</span>
                                    @endif
                                    </li>
                                </ul>
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
                            <td>{{$app->created_at}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Place: </td>
                            <td>{{$app->app_place}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <center class="text-center">
                    <!-- Signature of the applicant:<br><input name="" type="text" style="width: 200px; height:20px;"> -->
                    <span class="error"></span>
                    <br>
                    <a href="{{url('weavers/ej-2loom-getzip/'.$app->id)}}" class="btn btn-info">Download all attachments.</a>
                    <br>
                </center>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Actions</h2>
                    </div>
                    <div class="col-md-12 text-center">
                        <a href="{{url('/weavers/ej-2loom-list')}}" class="btn btn-warning btn-md">Go back</a>
                        @if($app->status == 'applied')
                        <a href="{{url('/weavers/ej-2loom-adminaction/rejected/'.$app->id)}}" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?')">Reject</a>
                        <a href="{{url('/weavers/ej-2loom-adminaction/approved/'.$app->id)}}" class="btn btn-success btn-md" onclick="return confirm('Are you sure?')">Approve</a>
                        @endif
                    </div>
                </div>
                <div class="footer">
                </div>
            </div>
        </div>
    </div>
@stop
