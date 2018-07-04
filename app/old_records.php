<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class old_records extends Model
{
    
    public function insertuser($array){
        $target = old_records::create( $array );        
        return $target;
    }
}
