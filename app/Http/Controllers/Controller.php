<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\training_centres;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $user;
    private $signed_in;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->signed_in = Auth::check();

            view()->share('signed_in', $this->signed_in);
            view()->share('user', $this->user);

            if(Auth::check()){
            	if(Auth::User()->user_id == 1)
            		view()->share('ldistrict', Auth::User()->district);
            	if(Auth::User()->user_id == 2){
            		$tc = new training_centres();
        			$tcname = $tc->fetchTcName(Auth::User()->centre_id);
            		view()->share('ltcName', $tcname);
            	}
            	if(Auth::User()->user_id == 4)
            		view()->share('ldivision', Auth::User()->username);
            }
            return $next($request);
        });

    }

}
