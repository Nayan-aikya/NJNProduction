<?php

namespace App\Http\Middleware;

use Closure;
use App\districts;
use App\user_roles;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // check user is logged in...
            $logged_type_id = Auth::user()->user_id;

            if($logged_type_id == 1){
                // District user
                $loggedinuser_district = Auth::user()->district;
                $did = districts::where('district_name', '=' ,$loggedinuser_district)->value('id');
                 $disID = districts::where('district_name', '=' ,$loggedinuser_district)->value('district_code');
                $request->merge(array('current_did'=>$did, 'userRole'=>'TD', 'district_name'=> $loggedinuser_district,'current_didID'=>$disID));
                return $next($request);
            }
            if($logged_type_id == 4){
                // division user
                $loggedinuser_division = Auth::user()->division;
                $request->merge(array('userRole'=>'DD', 'division_name'=> $loggedinuser_division));
                return $next($request);
            }
            if($logged_type_id == 2){
                // division user
                $center_id = Auth::user()->centre_id;
                $request->merge(array('userRole'=>'TC', 'center_id'=> $center_id));
                return $next($request);
            }
            if($logged_type_id == 6){
                // division user
                $request->merge(array('userRole'=>'SD'));
                return $next($request);
            }
            return redirect()->back();
        }
        return redirect('login');        
    }
}
