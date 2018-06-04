<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject_candidate extends Model
{
    protected $fillable=[   
          					'academic_year',
							'subject',
							'no_of_candidate'
							];
}
