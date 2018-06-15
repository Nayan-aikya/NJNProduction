<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batch_candidates extends Model
{
          protected $fillable=[   
          					'academic_year',
							'centre_id',
							'batch_id',
							'batch_type',
							'candidate_id',
                            'employment_status',
                            'employed_industry'
							];
	public function createbatchCandidate($array){
    	$candidates = batch_candidates::insert($array);     
        return $candidates;
    }	
    public function checkCandidate($id){
    	$candidates = batch_candidates::where('candidate_id',$id)->get();     
        return $candidates;
    }
    public function batchCandidate($id){
        echo $id;
        $candidates = batch_candidates::where('batch_id',$id)->get();     
        return $candidates;
    }
    public function deletebatchCandidate($id){
    	$candidates = batch_candidates::where('candidate_id',$id)->delete();     
        return $candidates;
    }	
    public function employmentstatusUpdate($tc,$batch,$candidateid,$industry,$status){
        $candidates = batch_candidates::where('candidate_id',$candidateid)->where('centre_id',$tc)->where('batch_id',$batch)->update(array('employment_status' => $status , 'employed_industry' => $industry));     
        return $candidates;
    }
    public function uploadImage($candidateid,$batchid,$filename){
        $data = array('certificate' => $filename);
        $candidates = batch_candidates::where('candidate_id',$candidateid)->update($data);     
        return $candidates;
    }	
    public function viewFile($candidateid,$batchid){
        $candidates = batch_candidates::where('candidate_id',$candidateid)->where('batch_id',$batchid)->get();     
        return $candidates;
    }
}
