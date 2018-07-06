<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivAppCommits extends Model
{
    //
    protected $fillable=[
        'appID',
        'appType',
        'remarks',
        'status',
    ];
}
