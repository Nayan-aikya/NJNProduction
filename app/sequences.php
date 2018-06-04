<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sequences extends Model
{
           protected $fillable=[   
							'batch_id',
							'centre_id',
							'batch_prefix',
							'centre_prefix'
							];
	public function fetchSequence(){
    	$sequence = sequences::all(); 
        return $sequence;
    }
    public function updateSequence($info){
    	return sequences::where ('id', '1')->update($info);
    }
}
