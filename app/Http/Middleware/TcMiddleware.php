<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use Illuminate\Support\Facades\Auth;

class TcMiddleware
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
       
        else{
            return redirect('home');
        }
        return $next($request);

    }
}
