<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
	use Notifiable;
      protected $fillable=[   
							'district',
							'username',
							'password',
							'centre_id',
							'user_id'
							];
	protected $hidden = [
        'password', 'remember_token',
    ];
    public function fetchUserInfo($username){
    	$district = users::where('username', $username)->get();     
        return $district;
    }
    public function fetchUserId($username){
    	$user = users::where('username', $username)->get();     
        return $user;
    }
    public function insertUser($array){
        $user = users::create( $array );        
        return $user;
    }
    public function findId($username,$centreid){
        $user = users::where('username', $username)->where('centre_id', $centreid)->get();     
        return $user;
    }
    public function updateUser($username,$centreid,$array){
        $user = users::where('username', $username)->where('centre_id', $centreid)->update($array);     
        return $user;
    }
    public function fetchTrainingCentreId($username,$password){
        $tcid = users::where('username', $username)->get();     
        return $tcid;
    }
}
