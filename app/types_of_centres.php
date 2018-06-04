<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class types_of_centres extends Model
{
         protected $fillable=[   
							'types'
							];
	public function fetchCentreTypes(){
    	$types = types_of_centres::all(); 
        return $types;
    }
    public function insertCentreType($array){
    	$types = types_of_centres::create($array); 
        return $types;
    }
}
