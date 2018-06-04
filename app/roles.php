<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $fillable=[   
							'role_id',
							'role_type'
							];
    public function insertRole($array){
        $role = roles::create( $array );        
        return $role;
    }
    public function fetchRole($roleid){
        $role = roles::where( 'role_id', $roleid )->get();        
        return $role;
    }
    public function fetchID($roleid,$rolename){
        $role = roles::where( 'role_type', $rolename )->where( 'role_id', $roleid )->get();      
        return $role;
    }
}
