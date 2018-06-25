<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class powerSubsidyApps extends Model
{
    //
    protected $fillable=[   
        'app_year',
        'app_district',
        'scheme_name',
        'unit_type',
        'name',
        'photograph',
        'aadhaar',
        'resi_houseno',
        'resi_wardno',
        'resi_crossno',
        'resi_village',
        'resi_pin',
        'resi_taluk',
        'resi_district',
        'resi_phone',
        'resi_mobile',
        'unit_name',
        'unit_no',
        'unit_wardno',
        'unit_crossno',
        'unit_village',
        'unit_pin',
        'unit_taluk',
        'unit_phone',
        'unit_mobile',
        'castecategory',
        'cast_certificate',
        'education',
        'reg_number',
        'regdate',
        'ownership_type',
        '100per_women',
        'power_alloted',
        'rr_number',
        'pow_sanc_letter',
        'trade_licence',
        'ssi_msme_cert',
        'recent_bill',
        'recent_receipt',
        'building_docs',
        'mctype1',
        'mctype2',
        'mctype3',
        'mctype4',
        'app_date',
        'app_place',
        'ins_aadhar_img',
        'ins_aadhar_no',
        'ins_photo',
        'ins_lat',
        'ins_long',
        'ins_remark',
        'ins_status'
    ];
}
