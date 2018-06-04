<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidates extends Model
{
     protected $fillable=[   
     						
    						'serial_no',
							'first_name',
							'last_name',
							'phone_no',
							'email',
							'dob',
							'aadhar_no',
							'gender',
							'marital_status',
							'religion',
							'category',
							'relationship',
							'relation_firstname',
							'relation_lastname',
							'current_location',
							'current_street',
							'current_city',
							'current_state',
							'current_district',
							'current_taluk',
							'current_village',
							'current_pincode',
							'permanent_location',
							'permanent_street',
							'permanent_city',
							'permanent_state',
							'permanent_district',
							'permanent_taluk',
							'permanent_village',
							'permanent_pincode',
							'education',
							'subject',
							'yearofpassing',
							'physically_challenged',
							'skill',
							'apprentiseship',
							'perviously_employed',
							'willing_migrate',
							'expected_salary_outside',
							'expected_salary_within',
							'preferred_training_period',
							'status',

							'candidate_id',
							'photo'

                     ];
    public function createCandidate($insert){
    	$candidates = candidates::insert($insert);     
        return $candidates;
    }
    public function fetchCandidate(){
    	$candidates = candidates::where('status','Created')->get();     
        return $candidates;
    }
    public function updateCandidateStatus($id,$data){
    	$candidates = candidates::where('candidate_id',$id)->update($data);     
        return $candidates;
    }
    public function fetchCandidateMappedList($centreid,$batchid,$batchtype){
    	$candidates = candidates::where('status','Mapped')->get();     
        return $candidates;
    }
    public function fetchCandidateList(){
    	$candidates = candidates::get();     
        return $candidates;
    }


    public function uploadImage($candidateid,$batchid,$filename){
    	$data = array('photo' => $filename);
    	$candidates = candidates::where('candidate_id',$candidateid)->update($data);     
        return $candidates;
    }
    
}
