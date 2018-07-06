<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldInspection extends Model
{
    protected $fillable=[   
        'appID',
        'appType',
        'ins_build_picture',
        'ins_loom_pictures',
        'ins_status',
        'ins_date',
        'ins_remarks',
        'ins_lat',
        'ins_long',
    ];
}
