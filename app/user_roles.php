<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_roles extends Model
{
    protected $fillable=[   
							'role_id',
							'user_id',
							'role_type',
							'status'
							];
	public function fetchRole($userid){
    	$user = user_roles::where('user_id', $userid)->get();     
        return $user;
    }
    public function fetchUserId($roleid){
    	$user = user_roles::where('role_id', $roleid)->get();     
        return $user;
    }
    public function insertRole($array){
        $role = user_roles::create( $array );        
        return $role;
    }
}
