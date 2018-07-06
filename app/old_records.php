<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class old_records extends Model
{
    
    public function insertuser($array){
        $target = old_records::create( $array );        
        return $target;
    }

    
    public function getAllReportByDC($dist){
        $data= array();
        $data['cand_count'] = old_records::where('district',$dist)->count();    

        $data['batch_detail'] = DB::table('old_records')
                     ->select(DB::raw('count(id) as batch_count, center_id'))
                     ->where('district', '=', $dist)
                     ->groupBy('center_id')
                     ->get();
        $data['placed_cand'] = old_records::where('district',$dist)->where('wage_emp',"ಹೌದು")->count(); 
                      
        return $data;
        
    }
}

//SELECT `center_id` ,COUNT(`id`) FROM `old_records` GROUP By `center_id` 