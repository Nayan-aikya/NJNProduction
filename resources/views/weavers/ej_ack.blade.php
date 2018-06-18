<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 12px;
        }
    </style>
</head>

<!-- <body> -->
<body onload="window.print()">
    <table width="100%">
        <tr>
            <td style="border: 1px solid #ddd;">
                <table width="650" align="center">
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td><img src="{{asset('img/Karnataka_log.png')}}" alt=""></td>
                                    <td>
                                    <center>
                                        <h4>Govt of Karnataka</h4>
                                        <h3>Department of Handlooms and Textiles</h3>
                                        <h2>Acknowledgement</h2>
                                        <p>Application for seeking financial assistance for purchasing of 2 loom, Elecronic Jacquard and Knotting machine from government.</p>
                                    </center>
                                    </td>
                                    <td><img src="{{asset('img/gov-logo.png')}}" alt=""></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="1" cellpadding="4" style="border-collapse: collapse; border:1px solid #ccc;" width="100%">
                                <tbody>
                                    <tr>
                                        <td>Name: </td>
                                        <td>{{$e1->name}}</td>
                                        <td>Application number:</td>
                                        <td>{{$e1->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Application district: </td>
                                        <td>{{$e1->app_district}}</td>
                                        <td>Financialyear:</td>
                                        <td>{{$e1->fin_year}}</td>
                                    </tr>
                                    <tr>
                                        <td>House No:</td>
                                        <td>{{$e1->resi_houseno}}</td>
                                        <td>Ward No:</td>
                                        <td>{{$e1->resi_wardno}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cross No:</td>
                                        <td>{{$e1->resi_crossno}}</td>
                                        <td>Village:</td>
                                        <td>{{$e1->resi_village}}</td>
                                    </tr>
                                    <tr>
                                        <td>Taluk:</td>
                                        <td>{{$e1->resi_taluk}}</td>
                                        <td>District:</td>
                                        <td>{{$e1->resi_district}}</td>
                                    </tr>
                                    <tr>
                                        <td>PIN:</td>
                                        <td>{{$e1->resi_pin}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Landline(including STD code):</td>
                                        <td>{{$e1->resi_phone}}</td>
                                        <td>Mobile No:</td>
                                        <td>{{$e1->resi_mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td>DOB:</td>
                                        <td>{{$e1->dob}}</td>
                                        <td>Age:</td>
                                        <td>{{$e1->age}}</td>
                                    </tr>
                                    <tr>
                                        <td>Aadhaar:</td>
                                        <td>{{$e1->aadhaar}}</td>
                                        <td>Email:</td>
                                        <td>{{$e1->email}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Category</td>
                                        <td>{{$e1->castecategory}}</td>
                                        <td>Gender</td>
                                        <td>{{$e1->gender}}</td>
                                    </tr>
                                    <tr>
                                        <td>Annual income</td>
                                        <td>{{$e1->income}}</td>
                                        <td>Application Status</td>
                                        <td>{{$e1->status}}</td>
                                    </tr>
                                    <tr>
                                        <td>Facility selected</td>
                                        <td>{{$e1->facility_sel}}</td>
                                        <td>Working capital assistance?</td>
                                        <td>{{$e1->wka}}</td>
                                    </tr>
                                    <tr>
                                        <td>Expected Unit's address</td>
                                        <td>{{$e1->plan_uadd}}</td>
                                        <td>Space available for unit</td>
                                        <td>{{$e1->space_sqft}}</td>
                                    </tr>
                                    <tr>
                                        <td>RR/Meter number</td>
                                        <td>{{$e1->rr_number}}</td>
                                        <td>Connected load</td>
                                        <td>{{$e1->connect_load}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Prefered bank type</td>
                                        <td>{{$e1->prepBank_type}}</td>
                                        <td>Prefered bank name</td>
                                        <td>{{$e1->prepBank_bankname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Loan ammount sanctioned</td>
                                        <td>{{$e1->prepBank_loanamt}}</td>
                                        <td>Date of loan sanction</td>
                                        <td>{{$e1->prepBank_date}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>User bank</td>
                                        <td>{{$e1->ubank_name}}</td>
                                        <td>User name as per bank</td>
                                        <td>{{$e1->ubank_uname}}</td>
                                    </tr>
                                    <tr>
                                        <td>User bank branch</td>
                                        <td>{{$e1->ubank_branch}}</td>
                                        <td>User bank account type</td>
                                        <td>{{$e1->ubank_actype}}</td>
                                    </tr>
                                    <tr>
                                        <td>User bank ac number</td>
                                        <td>{{$e1->ubank_acno}}</td>
                                        <td>User bank IFSC</td>
                                        <td>{{$e1->ubank_ifsc}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Place</td>
                                        <td>{{$e1->app_place}}</td>
                                        <td>Applied date/time</td>
                                        <td>{{$e1->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>