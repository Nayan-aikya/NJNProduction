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
                                        </center>
                                    </td>
                                    <td><img src="{{asset('img/gov-logo.png')}}" alt=""></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><center>Your application has been successfully submitted.</center></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="1" cellpadding="4" style="border-collapse: collapse; border:1px solid #ccc;" width="100%">
                                <tbody>
                                    <tr>
                                        <td>Name </td>
                                        <td>{{$psa->salutation}} {{$psa->name}}  </td>
                                        <td>Application ID</td>
                                        <td>{{$psa->id}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Applied resi_district</td>
                                        <td>{{$psa->app_district}}</td>
                                        <td>Application year</td>
                                        <td>{{$psa->app_year}}</td>
                                    </tr>
                                    <tr>
                                        <td>Scheme</td>
                                        <td>{{$psa->scheme_name}}</td>
                                        <td>Unit type</td>
                                        <td>{{$psa->unit_type}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><center><b>Residential details</b></center></td>
                                    </tr>
                                    <tr>
                                        <td>Aadhaar</td>
                                        <td>{{$psa->aadhaar}}</td>
                                        <td>Mobile no</td>
                                        <td>{{$psa->resi_mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td>House No</td>
                                        <td>{{$psa->resi_houseno}}</td>
                                        <td>Ward no</td>
                                        <td>{{$psa->resi_wardno}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cross no</td>
                                        <td>{{$psa->resi_crossno}}</td>
                                        <td>Village</td>
                                        <td>{{$psa->resi_village}}</td>
                                    </tr>
                                    <tr>
                                        <td>Taluk</td>
                                        <td>{{$psa->resi_taluk}}</td>
                                        <td>Dist</td>
                                        <td>{{$psa->resi_district}}</td>
                                    </tr>
                                    <tr>
                                        <td>PIN</td>
                                        <td>{{$psa->resi_pin}}</td>
                                        <td>Mobile</td>
                                        <td>{{$psa->resi_mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><center><b>Unit details</b></center></td>
                                    </tr>
                                    <tr>
                                        <td>Unit Name</td>
                                        <td>{{$psa->unit_name}}</td>
                                        <td>Mobile</td>
                                        <td>{{$psa->unit_mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit No</td>
                                        <td>{{$psa->unit_no}}</td>
                                        <td>Ward no</td>
                                        <td>{{$psa->unit_wardno}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cross no</td>
                                        <td>{{$psa->unit_crossno}}</td>
                                        <td>Village</td>
                                        <td>{{$psa->unit_village}}</td>
                                    </tr>
                                    <tr>
                                        <td>Taluk</td>
                                        <td>{{$psa->unit_taluk}}</td>
                                        <td>Dist</td>
                                        <td>{{$psa->unit_district}}</td>
                                    </tr>
                                    <tr>
                                        <td>PIN</td>
                                        <td>{{$psa->unit_pin}}</td>
                                        <td>Landline</td>
                                        <td>{{$psa->unit_phone}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{$psa->castecategory}}</td>
                                        <td>Education</td>
                                        <td>{{$psa->education}}</td>
                                    </tr>
                                    <tr>
                                        <td>SSI/MSME reg. no.</td>
                                        <td>{{$psa->reg_number}}</td>
                                        <td>SSI/MSME reg. date</td>
                                        <td>{{$psa->reg_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ownership type</td>
                                        <td>{{$psa->ownership_type}}</td>
                                        <td>100% women unit?</td>
                                        <td>{{$psa->u100per_women}}</td>
                                    </tr>
                                    <tr>
                                        <td>Power sactioned</td>
                                        <td>{{$psa->power_alloted}}</td>
                                        <td>RR number</td>
                                        <td>{{$psa->rr_number}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><center><b>Machinary details</b></center></td>
                                    </tr>                                    
                                    <tr>
                                        <td colspan="4">
                                            <?php
                                                $type = $psa->typecheck;
                                                if($psa->mctype1){
                                                    $temp1 = json_decode($psa->mctype1);
                                                    ?>
                                                    <table width="100%" border="1" style="border-collapse: collapse; border:1px solid #ccc;">
                                                    <tr>
                                                        <th>Powerloom make name</th>
                                                        <th>Number of looms</th>
                                                        <th>Type of loom</th>
                                                        <th>Width of loom</th>
                                                        <th>Power consumption per loom</th>
                                                        <th>Attachment</th>
                                                    </tr>
                                                    <?php

                                                    foreach ($temp1 as $key => $value) {
                                                        $t2 =''; 
                                                        if(isset($value->att))
                                                        {
                                                            $t2 = implode(',',$value->att);
                                                        }
                                                        echo"<tr><td>".$value->loommake."</td><td>".$value->loomnum."</td><td>".$value->loomtype."</td><td>".$value->loomwidth."</td><td>".$value->loompowercon."</td><td>".$t2."</td></tr>";
                                                    }
                                                    ?>
                                                    </table>
                                                    <?php
                                                }
                                                if($psa->mctype2){
                                                    $val = json_decode($psa->mctype2);
                                                ?>
                                                    <table border="1" width="100%" style="border-collapse: collapse; border:1px solid #ccc;">
                                                        <tr>
                                                            <th>Preloom facility machines</th>
                                                            <th>Availability</th>
                                                            <th>No of spin looms</th>
                                                            <th>No of machines</th>
                                                            <th>Power (in hp)</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Pirn winding machine</td>
                                                            <td>{{$val->pirnwind->avail}}</td>
                                                            <td>{{$val->pirnwind->num_loom}}</td>
                                                            <td>{{$val->pirnwind->num_mcs}}</td>
                                                            <td>{{$val->pirnwind->power}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bobbin/dubbling/winding</td>
                                                            <td>{{$val->bbdbwi->avail}}</td>
                                                            <td>{{$val->bbdbwi->num_loom}}</td>
                                                            <td>{{$val->bbdbwi->num_mcs}}</td>
                                                            <td>{{$val->bbdbwi->power}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Warping machine</td>
                                                            <td>{{$val->wrp->avail}}</td>
                                                            <td>{{$val->wrp->num_loom}}</td>
                                                            <td>{{$val->wrp->num_mcs}}</td>
                                                            <td>{{$val->wrp->power}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Twisting machine</td>
                                                            <td>{{$val->twst->avail}}</td>
                                                            <td>{{$val->twst->num_loom}}</td>
                                                            <td>{{$val->twst->num_mcs}}</td>
                                                            <td>{{$val->twst->power}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other machine</td>
                                                            <td>{{$val->other->avail}}</td>
                                                            <td>{{$val->other->num_loom}}</td>
                                                            <td>{{$val->other->num_mcs}}</td>
                                                            <td>{{$val->other->power}}</td>
                                                        </tr>
                                                    </table>
                                                <?php
                                                }
                                                if($psa->mctype3){
                                                    $temp1 = json_decode($psa->mctype3);
                                                    ?>
                                                    <table width="100%" border="1" style="border-collapse: collapse; border:1px solid #ccc;">
                                                    <tr>
                                                        <th>Make of shuttleless power loom</th>
                                                        <th>Width of loom (Reed space)</th>
                                                        <th>Connected power</th>
                                                        <th>Attachment type</th>
                                                        <th>Number of looms</th>
                                                    </tr>
                                                    <?php
                                                    foreach ($temp1 as $key => $value) {
                                                        $t2 =''; 
                                                        if(isset($value->att))
                                                        {
                                                            $t2 = implode(',',$value->att);
                                                        }
                                                        echo"<tr><td>".$value->make."</td><td>".$value->reed_space."</td><td>".$value->power."</td><td>".$t2."</td><td>".$value->loom_num."</td></tr>";
                                                    }
                                                    ?>
                                                    </table>
                                                    <?php
                                                }
                                            ?>                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <?php
                                            $temp = json_decode($psa->mctype4);                                            
                                            ?>
                                            <table width="100%" border="1" style="border-collapse: collapse; border:1px solid #ccc;">
                                                <tr>
                                                    <th>Raw material used</th>
                                                    <th>Monthly average consumption(In KGs)</th>
                                                    <th>Monthly average production (In meters)</th>
                                                </tr>
                                                <?php
                                                    foreach ($temp as $key => $value) {
                                                      echo"<tr><td>".$value->raw_mtr."</td><td>".$value->avg_cons."</td><td>".$value->avg_prod."</td></tr>";
                                                    }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Application date</td>
                                        <td>{{$psa->app_date}}</td>
                                        <td>Pace</td>
                                        <td>{{$psa->app_place}}</td>
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