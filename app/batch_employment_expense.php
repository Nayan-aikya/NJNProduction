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
    public function checkExpense($fiscalyear,$tc,$batch,$type){
        $expense = batch_employment_expense::where('academic_year',$fiscalyear)->where('centre_id',$tc)->where('batch_id',$batch)->where('batch_type',$type)->get();     
        return $expense;
    }
    public function updateExpense($fiscalyear,$tc,$batch,$type,$expense){
        $expense = batch_employment_expense::where('academic_year',$fiscalyear)->where('centre_id',$tc)->where('batch_id',$batch)->where('batch_type',$type)->update($expense);     
        return $expense;
    }
}
