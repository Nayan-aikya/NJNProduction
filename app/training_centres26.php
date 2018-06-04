<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class training_centres extends Model
{
    protected $fillable=[   'name',
							'centre_id',
							'centre_name',
							'district_id',
							'upload_pic',
							'street',
							'district',
							'state',
							'pin_code',
							'email',
							'mobile_number',
							'landline',
							'website_id',
							'pan_card',
							'pan_card_image',
							'gst',
							'gst_image',
							'training_start',
							'training_end',
							'adhar_card',
							'adhar_card_image',
							'centre_type',
							'training',
							'centre_status',
                            'academic_year'

                     ];
    public function fetchTcList(){
    	$tc = training_centres::all(); 
        return $tc;
    }
    public function deleteTc($centreid){
    	$tc = training_centres::where('centre_id', $centreid);        
        return $tc->delete();
    }
    public function fetchtcforList(){
    	$tc = training_centres::pluck('centre_name','centre_id');    
        echo "<pre>";print_r($tc);die;    
        return $tc;
    }
    public function updateTc($centreid){
    	$tc = training_centres::where('centre_id', $centreid);        
        return $tc->delete();
    }
    public function fetchPendingTcList(){
        $training_centres = training_centres::where('centre_status','created')->get(); 
        return $training_centres;
    }
    public function approveTc($centreid,$new_tc_data){
        $training_centres = training_centres::where ('centre_id', $centreid)->update($new_tc_data);
        return $training_centres;
    }
     public function rejectTc($centreid,$new_tc_data){
        $tc = training_centres::where ('centre_id', $centreid)->update($new_tc_data);
        return $tc;
    }

    public function fetchTcSpecInfo($tcid){
        $tcinfo = training_centres::where('centre_id', $tcid)->get(); 
        return $tcinfo;
    }

    public function fetchDistrictwiseTc($districtid){
        $tc = training_centres::where('district_id',$districtid)->get();        
        return $tc;
    }


}
