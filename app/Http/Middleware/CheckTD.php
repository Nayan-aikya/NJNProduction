<?php

namespace App\Http\Middleware;

use Closure;
use App\districts;
use App\user_roles;
use Illuminate\Support\Facades\Auth;

class CheckTD
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
            $loggedinuser_id = Auth::user()->user_id;
            $loggedinuser_district = Auth::user()->district;

            $did = districts::where('district_name', '=' ,$loggedinuser_district)->value('id');

            $userrole=new user_roles();
            $role=$userrole->fetchRole($loggedinuser_id);            
            
            if($role[0]->role_id =='TD' && $did != '') {
                // Only for TD user
                $request->merge(array('current_did'=>$did));
                return $next($request);
            }
            else{
                // for none TD
                return redirect()->back();
            }
        }
        return redirect('home');        
    }
}
