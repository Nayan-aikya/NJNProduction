<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class academicyear extends Model
{
    protected $fillable=[   
          					'academic_year'
          				];
    public function fetchAcademicyear(){
    	$academicyear = academicyear::all();     
        return $academicyear;
    }
}
