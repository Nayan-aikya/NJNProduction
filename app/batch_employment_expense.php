<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batch_employment_expense extends Model
{
    protected $fillable=[
    			'centre_id',
    			'batch_id',
    			'academic_year',
				'batch_type',
				'expense',
				'status'
    			];
    public function insertExpense($expense){
    	$expense = batch_employment_expense::insert($expense);     
        return $expense;
    }
    public function checkExpense($fiscalyear,$tc,$batch){
        $expense = batch_employment_expense::where('academic_year',$fiscalyear)->where('centre_id',$tc)->where('batch_id',$batch)->get();     
        return $expense;
    }
    public function updateExpense($fiscalyear,$tc,$batch,$expense){
        $expense = batch_employment_expense::where('academic_year',$fiscalyear)->where('centre_id',$tc)->where('batch_id',$batch)->update($expense);     
        return $expense;
    }
     public function approveExpense($batchid,$centreid,$data){
        $batchinfo = batch_employment_expense::where('batch_id', $batchid)->where('centre_id', $centreid)->update($data); 
        return $batchinfo;
    }
}
