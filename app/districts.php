<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class districts extends Model
{
    	protected $fillable=[   
							'district_name',
							'district_code',
							'division'
                     ];
    public function fetchDivisionInfo($district){
    	$division = districts::where('district_name',$district)->get(); 
        return $division;
    }
    public function fetchDistrict(){
    	$district = districts::all(); 
        return $district;
    }    
    public function pluckDistrictCode($dist){
        $district = districts::where('district_name',$dist)->value('district_code');
        
        return $district;
    } 
    
}
