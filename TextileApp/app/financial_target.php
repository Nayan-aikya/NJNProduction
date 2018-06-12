<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class financial_target extends Model
{
    protected $fillable=[   
							'district_id',
							'financial_year',
							'centre_id',
							'batch_id',
							'general_male_target',
							'general_female_target',
							'general_total_target',
							'tsp_male_target',
							'tsp_female_target',
							'tsp_total_target',
							'scp_male_target',
							'scp_female_target',
							'scp_total_target',
							'min_male_target',
							'min_female_target',
							'min_total_target',
							'created_by',
							'status',
                            'status_updated_date'
                     ];
    public function insertFinancialTarget($array){
    	$target = financial_target::create( $array );        
        return $target;
    }
     public function checkFinancialTarget($districtid,$year,$tc,$batch,$type){
    	$target = financial_target::where('district_id',$districtid)->where('financial_year',$year)->where('centre_id',$tc)->where('batch_id',$batch)->get();
    	return $target;
    }
    public function updateFinancialTarget($districtid,$year,$tc,$batch,$type,$array){
    	$target = financial_target::where('district_id',$districtid)->where('financial_year',$year)->where('centre_id',$tc)->where('batch_id',$batch)->update($array);        
        return $target;
    }
    public function updateStatus($districtid,$year,$tc,$batch,$array){
    	$target = financial_target::where('district_id',$districtid)->where('financial_year',$year)->where('centre_id',$tc)->where('batch_id',$batch)->update($array);        
        return $target;
    }
    // public function fetchBatch($id){
    //     $target = financial_target::where('centre_id',$id)->where('status','Created')->pluck('batch_name','batch_id');        
    //     return $target;
    // }
    
}
