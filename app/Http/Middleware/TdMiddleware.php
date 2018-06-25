<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use Illuminate\Support\Facades\Auth;
class TdMiddleware
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
        if(Auth::check() && Auth::user()->user_id == 2){
            return redirect('tcdashboard');
        }
        if(Auth::check() && Auth::user()->user_id == 1){
            return redirect('dashboard');
        }
       
        return $next($request);
    }
}
