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
                $request->merge(array('current_did'=>$did, 'userRole'=>'TD', 'district_name'=> $loggedinuser_district));
                return $next($request);
            }
            if($logged_type_id == 4){
                // division user
                $loggedinuser_division = Auth::user()->division;
                $request->merge(array('userRole'=>'DD', 'division_name'=> $loggedinuser_division));
                return $next($request);
            }
            return redirect()->back();
        }
        return redirect('login');        
    }
}
