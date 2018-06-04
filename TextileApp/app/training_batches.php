<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class training_batches extends Model
{
     protected $fillable=[   
							'centre_id',
							'batch_id',
							'status',
							'created_by',
							'batch_type',
							'batch_name',
							'batch_academic_year',
                            'action',
                            'stipend',
                            'raw_material',
                            'inst_exp',
                            'total_expense',
                            'employment_expense_status'
                     ];
    public function insertTrainingBatch($array){
    	$batch = training_batches::create( $array );        
        return $batch;
    } 
    public function fetchtrainingBatch($centreid){
    	$batch = training_batches::where("centre_id",$centreid)->pluck('batch_name','batch_id');
        return $batch;
    }

    public function fetchtrainingspecBatch($centreid,$academicyear){
        $batch = training_batches::where("centre_id",$centreid)->where("batch_academic_year",$academicyear)->pluck('batch_name','batch_id');
        return $batch;
    }

    public function fetchcompletedtrainingBatch($centreid,$year){
        $batch = training_batches::where("centre_id",$centreid)->where('action',"Completed")->where('batch_academic_year',$year)->pluck('batch_name','batch_id');
        return $batch;
    }

    public function editBatchAction($batchid,$action){
        if ($action == "Start") 
        {
           $field = "start_date";
           $value = date('Y-m-d H:i:s');
        }
        if ($action == "Completed") 
        {
           $field = "completed_date";
           $value = date('Y-m-d H:i:s');
        }
        if ($action == "Hold") 
        {
           $field = "hold_date";
           $value = date('Y-m-d H:i:s');
        }       
        $data = training_batches::where ('id', $batchid)->update(array('action' => $action,$field => $value));
        return $data;
    }
    public function fetchBatchList(){
        $batches = training_batches::all(); 
        return $batches;
    }

    public function fetchCompletedBatchList(){
        $batches = training_batches::where('action',"Completed")->get();
        return $batches;
    }
    
    public function updateBatchExpense($data){ 
        $success = training_batches::where ('id', $data['id'])->update( $data );
        return $success;
    }

    public function fetchtrainingType($centreid){
        $batch = training_batches::where("centre_id",$centreid)->pluck('batch_type','batch_type');
        return $batch;
    }
    public function fetchTypeBatch($centreid,$type,$academicyear){
        $batch = training_batches::where("centre_id",$centreid)->where("batch_type",$type)->where('batch_academic_year',$academicyear)->pluck('batch_name','batch_id');
        return $batch;
    }
    public function fetchBatchSpecInfo($batchid){
        $batchinfo = training_batches::where('batch_id', $batchid)->get(); 
        return $batchinfo;
    }
    public function approveExpense($batchid,$centreid,$data){
        $batchinfo = training_batches::where('batch_id', $batchid)->where('centre_id', $centreid)->update($data); 
        return $batchinfo;
    }
    public function rejectExpense($batchid,$centreid,$data){
        $batchinfo = training_batches::where('batch_id', $batchid)->where('centre_id', $centreid)->get($data); 
        return $batchinfo;
    }
}
