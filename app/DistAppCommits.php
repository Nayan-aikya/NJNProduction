<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistAppCommits extends Model
{
    protected $fillable=[   
        'appID',
        'appType',
        'remarks'
    ];
}
