<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class states extends Model
{
               protected $fillable=[   
							'state_names'
							];
	public function fetchState(){
    	$states = states::all(); 
        return $states;
    }
}
