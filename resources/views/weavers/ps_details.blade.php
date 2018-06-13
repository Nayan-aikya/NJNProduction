@extends('layouts.sidebar')
@section('custom_style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@stop
@section('content')

    <div class="form-content">
    <h2 align="center"><u>Government of Karnataka</u></h2>
    <h3 align="center"><u>Application form for Claiming Power Subsidy<br>(New Renewal Application (With effect from 01/04/2011 ))</u></h3>
    <div id="content-wrapper"><br>
        <div class="container12" style="background: #f2f2f2; padding: 10px;">
            
            <!-- <p align="center"> <img src="pulpitrock.jpg" alt="Smiley face" width="142" height="150" align="right"> </p><br> -->
        
            <p align="center"><b>Handloom &amp; Textile Department</b></p>
    <p align="center"> Bangalore Urban Zilla Panchayat</p>
    <br>
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <br>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="">     
            <tbody>
                <tr>
                    <td></td>
                    <td>Applicant details</td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Full Name: </td>  
                                <td>{{$app->name}}</td>
                                <td>Application ID: </td>  
                                <td>{{$app->id}}</td>
                            </tr>
                        </table>
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
                                <td>PIN:</td>
                                <td>{{$app->resi_pin}}</td>
                                <td></td>
                                <td></td>     
                            </tr>
                            <tr>
                            <td>Taluk:</td>
                            <td>{{$app->resi_taluk}}</td>   
                            <td>District:</td>
                            <td>{{$app->resi_district}}</td>       
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
                    <td>B)Unit Address</td>
                    <td>
                    <table class="table table-bordered">
        
                        <tbody>
                        <tr>
                            <td>House No:</td>
                            <td>{{$app->unit_houseno}}</td> 
                            <td>Ward No:</td>
                            <td>{{$app->unit_wardno}}</td>
                            </tr>
                        <tr>
                        <td>Cross No:</td>
                            <td>{{$app->unit_crossno}}</td>
                            <td>Village:</td>
                            <td>{{$app->unit_village}}</td>     
                        </tr>
                        <tr>
                            <td>PIN:</td>
                            <td>{{$app->unit_pin}}</td>
                            <td></td>
                            <td></td>     
                        </tr>
                        <tr>
                            <td>Taluk:</td>
                            <td>{{$app->unit_taluk}}</td>   
                            <td>District:</td>
                            <td>{{$app->unit_district}}</td>       
                        </tr>
                        <tr>
                            <td>Landline(including STD code):</td>
                            <td>{{$app->unit_phone}}</td>   
                            <td>Mobile No:</td>
                            <td>{{$app->unit_mobile}}</td>       
                        </tr>
                        <tr>
                            <td>Unit meter number:</td>
                            <td colspan="2">{{$app->unit_meter}}</td>   
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
                            <td>{{$app->subcast}}</td> 
                            <td>Category:(SC/ST/OBC)</td>
                            <td>{{$app->cast_category}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                    
                </tr><tr>
                    <td>3</td>
                    <td>Educational Qualification</td>
                    <td>{{$app->education}}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>SSI Registration</td>
                    <td colspan="2">
                        <table class="table table-bordered">
                            <tr>
                                <td>Number</td>
                                <td>{{$app->reg_number}}</td>
                                <td>Mou Date</td>
                                <td>{{$app->reg_date}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Ownership or Participation /others</td>
                    <td>{{$app->ownership_type}}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td rowspan="2">power sanction</td>
                    <td>
                        <table class="table table-bordered">
        
                        <tbody>
                            <tr>
                            <td>Sanctioned:</td>
                            <td>{{$app->power_alloted}}</td> 
                            <td>Serviced:</td>
                            <td>{{$app->power_consumed}}</td>
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
                    <td>{{$app->rr_number}}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Details of Machinery</td>
                    <td>
                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>A.Details of the Power looms(in AnnexureA):</td>
                                <td>{{$app->mc_details_A}}</td> 
                                <td>B.Details of the pre-loom Machinery (in AnnexureB):</td>
                                <td>{{$app->mc_details_B}}</td>
                            </tr>
                            <tr>
                                <td>C.Details of the dying machinery(in AnnexureC):</td>
                                <td>{{$app->mc_details_C}}</td>
                                <td>D.Details of the Raw Material :</td>
                                <td>{{$app->mc_details_D}}</td>     
                            </tr>
                        </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Uploads(Scanned copies)</td>
                    <td>
                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Annexure A:</td>
                                <td>
                                    @if($app->annexurea != '')
                                    <a href="{{url('weavers/powersubsidy-getfile/annexurea/'.$app->id)}}" target="_blank">Download</a>
                                    @endif
                                </td> 
                                <td>Annexure B:</td>
                                <td>
                                    @if($app->annexureb != '')
                                    <a href="{{url('weavers/powersubsidy-getfile/annexureb/'.$app->id)}}" target="_blank">Download</a></td>
                                    @endif
                            </tr>
                            <tr>
                                <td>Annexure C:</td>
                                <td>
                                    @if($app->annexurec != '')
                                    <a href="{{url('weavers/powersubsidy-getfile/annexurec/'.$app->id)}}" target="_blank">Download</a>
                                    @endif
                                </td> 
                                <td>Annexure D:</td>
                                <td>
                                    @if($app->annexured != '')
                                    <a href="{{url('weavers/powersubsidy-getfile/annexured/'.$app->id)}}" target="_blank">Download</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Certificate:</td>
                                <td>
                                    @if($app->certificate != '')
                                    <a href="{{url('weavers/powersubsidy-getfile/certificate/'.$app->id)}}" target="_blank">Download</a>
                                    @endif
                                </td> 
                                <td>Photograph:</td>
                                <td>
                                    @if($app->photograph != '')
                                    <a href="{{url('weavers/powersubsidy-getfile/photograph/'.$app->id)}}" target="_blank">Download</a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="text-center">
                            <a href="{{url('weavers/powersubsidy-getzip/'.$app->id)}}" class="btn btn-info">Download all attachments.</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
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
    </tbody></table> <br>
    <p>I here by Certify that the information provided by me is true. The power supplied at subsidised  rate will be utilized for power loom and pre-loom activity. In case Power is utilized for any other purpose legal action can be taken on me and my unit. I here by certify that information provided by true </p><br>
    <table>
        <tr>
            <td>Date: </td>
            <td>{{$app->app_date}}</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Place: </td>
            <td>{{$app->app_place}}</td>
        </tr>
    </table>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Actions</h2>
        </div>
        <div class="col-md-12 text-center">
            <a href="{{url('/weavers/powersubsidy-list')}}" class="btn btn-warning btn-md">Go back</a>
            @if($app->status == 'applied')
            <a href="{{url('/weavers/powersubsidy-adminaction/rejected/'.$app->id)}}" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?')">Reject</a>
            <a href="{{url('/weavers/powersubsidy-adminaction/approved/'.$app->id)}}" class="btn btn-success btn-md" onclick="return confirm('Are you sure?')">Approve</a>
            @endif
        </div>
    </div>
        <br>  
                <div class="footer">
                </div>         
        </div>
    </div>
    </div>
@stop
@section('custom_scripts')
<script>

</script>
@stop
