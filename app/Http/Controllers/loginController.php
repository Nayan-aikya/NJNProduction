<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\users;
use Hash;
use App\user_roles;



class loginController extends BaseController
{
    public function login(Request $req)
    {
    	$username = $req->input('user');
    	$password = $req->input('pass');
        session()->put('username',$username);
        session()->put('password',$password);
        // $userdata = array(
        // 'centre_id' => '',
        // 'district' => 'Mysore',
        // 'username'     => $username,
        // 'password'  => Hash::make($password)
        // );
        // users::insert($userdata);
        $userdata = array(            
        'username'     => $username,
        'password'  => $password
        );

         if (Auth::attempt($userdata)) {
            $user=new Users();
            $userinfo=$user->fetchUserId($username);
            $centreid=$userinfo[0]->centre_id;
            session()->put('centreid',$centreid);
            // echo $userinfo[0]->user_id;
            $userrole=new user_roles();
            $role=$userrole->fetchRole($userinfo[0]->user_id);            
            
            if($role[0]->role_id =='TD')  
                return view('pages.tdhome');       
            if($role[0]->role_id =='TC')  
                return view('pages.tchome');
         }
         else{
             return view('pages.loginfail');
         }
    }
    public function logout(Request $req)
    {
        Session::flush();
        Auth::logout();
        return view('pages.login');
    }
}
