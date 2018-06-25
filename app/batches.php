<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batches extends Model
{
    protected $fillable=[
    			'batch_id',
    			'batch_name',
				'training_type',
				'no_of_stud',
				'start_date',
				'end_date',
				'status',
				'district_id',
				'centre_id',
                'academic_year'
    			];
    public function deleteBatch($batchid){
    	$batch = batches::where('batch_id', $batchid);        
        return $batch->delete();
    }
    public function updateBatch($new_batch_data,$batchid){
    	$batch = batches::where ('batch_id', $batchid)->update($new_batch_data);
        return $batch;
    }
    public function fetchBatchList(){
        $batches = batches::all(); 
        return $batches;
    }
    public function fetchBatchListByTc($cid){
        $batches = batches::where('centre_id',$cid)->get(); 
        return $batches;
    }
    public function fetchPendingBatchList($district){
        $batches = batches::where('district_id',$district)->where('status','Pending')->get(); 
        return $batches;
    }
    public function fetchPendingBatchListPaginate($district,$centre_id){
        if(!empty($centre_id))
            $batches = batches::where('district_id',$district)->where('centre_id',$centre_id)->where('status','Pending')->paginate(10); 
        else
            $batches = batches::where('district_id',$district)->where('status','Pending')->paginate(10); 
        return $batches;
    }
    public function approveBatch($batchid,$new_batch_data){
        $batch = batches::where ('batch_id', $batchid)->update($new_batch_data);
        return $batch;
    }
    public function rejectBatch($batchid,$new_batch_data){
        $batch = batches::where ('batch_id', $batchid)->update($new_batch_data);
        return $batch;
    }
    public function fetchBatchSpecInfo($batchid){
        $batchinfo = batches::where('batch_id', $batchid)->get(); 
        return $batchinfo;
    }
}
