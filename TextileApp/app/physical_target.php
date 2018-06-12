<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class physical_target extends Model
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
    public function insertPhysicalTarget($array){
    	$target = physical_target::create( $array );        
        return $target;
    } 

    public function approvePhyTarget($array){
    	$target = physical_target::where('batch_id', $array['vbatch'])
    								->where('financial_year', $array['vfiscalyear'])
    								->where('centre_id', $array['vtc'])
    								->update(array('status' => $array['status']));
		return $target;
    } 
    
    public function checkPhysicalTarget($districtid,$year,$tc,$batch,$type){
    	$target = physical_target::where('district_id',$districtid)->where('financial_year',$year)->where('centre_id',$tc)->where('batch_id',$batch)->get();
    	return $target;

    }
    public function updatePhysicalTarget($districtid,$year,$tc,$batch,$type,$array){
    	$target = physical_target::where('district_id',$districtid)->where('financial_year',$year)->where('centre_id',$tc)->where('batch_id',$batch)->update($array);        
        return $target;
    }
    public function updateStatus($districtid,$year,$tc,$batch,$array){
        $target = physical_target::where('district_id',$districtid)->where('financial_year',$year)->where('centre_id',$tc)->where('batch_id',$batch)->update($array);        
        return $target;
    }
}
