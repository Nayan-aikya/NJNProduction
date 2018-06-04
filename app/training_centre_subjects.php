<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class training_centre_subjects extends Model
{
    protected $fillable=[   
							'subjects',
                            'academic_year',
                            'no_of_candidate'
							];
	public function fetchSubject(){
    	$subjects = training_centre_subjects::all(); 
        return $subjects;
    }
    public function insertSubject($array){
    	$types = training_centre_subjects::create($array); 
        return $types;
    }
    public function fetchspecSubject($subject){
        $subjects = training_centre_subjects::where('subjects',$subject)->get(); 
        return $subjects;
    }
}
