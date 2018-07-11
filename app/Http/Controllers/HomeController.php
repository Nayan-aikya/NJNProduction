<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use App\ej2l_Applications;
use App\powerSubsidyApps;
use App\taluks;
use App\DistAppCommits;
use App\DivAppCommits;
use App\FieldInspection;
use View;

use DB;
use Session;
use App\batches;
use App\users;
use App\training_centres;
use App\districts;
use App\training_centre_subjects;
use App\states;
use App\types_of_centres;
use App\sequences;
use App\training_batches;
use App\physical_target;
use App\financial_target;
use App\candidates;
use App\batch_candidates;
use App\batch_employment_expense;
use App\academicyear;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Excel;
use DateTime;
class HomeController extends Controller
{
	public function home(Request $request)
    {
    	$dividata = array();
    	$userRole = $request->userRole;
        $dividata['userRole'] = $userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $disID = $request->current_didID;
            $dividata['adminTypeName'] = $request->district_name;

            $dividata['ej2l_apps_received'] = ej2l_Applications::where('app_district', '=', $did)->count();                          
            $dividata['ej2l_apps_complted'] = ej2l_Applications::where('app_status', '=', 'closed')->where('app_district', '=', $did)->count();

            $dividata['ps_apps_received'] = powerSubsidyApps::where('app_district', '=', $did)->count();
            $dividata['ps_apps_complted'] = powerSubsidyApps::where('app_district', '=', $did)->where('app_status', '=', 'closed')->count();

            $dividata['status']=$tcactive = DB::table('training_centres')->where('district_id',$disID)->count();
            $dividata['nobatch'] = DB::table('batches')->where('district_id',$disID)->count();
            $dividata['nocandidate'] = DB::table('batch_candidates')->join('batches','batch_candidates.batch_id','=','batches.batch_id')
            ->where('batches.district_id',$disID)->count();
        }
        if($userRole == 'DD'){
            $did = $request->current_did;
            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

            
            $dividata['adminTypeName'] = $division_name;
            $dividata['ej2l_apps_received'] = ej2l_Applications::whereIn('app_district', $dists_under_div)->count();
            $dividata['ej2l_apps_complted'] = ej2l_Applications::where('app_status', '=', 'closed')
                                                ->whereIn('app_district', $dists_under_div)->count();

            $dividata['ps_apps_received'] = powerSubsidyApps::whereIn('app_district', $dists_under_div)->count();
            $dividata['ps_apps_complted'] = powerSubsidyApps::whereIn('app_district', $dists_under_div)->where('app_status', '=', 'closed')->count();

            $dis=new districts();
            $district_ids = $dis->getDistrictByDivision($division_name);
            foreach ($district_ids as $key => $value) {
               $disids[]= $value['district_code'];
            }

            $dividata['status']=$tcactive = DB::table('training_centres')->whereIn('district_id',$disids)->count(); 

            $dividata['nobatch'] = DB::table('batches')->whereIn('district_id',$disids)->count();

            $dividata['nocandidate'] = DB::table('batch_candidates')->join('batches','batch_candidates.batch_id','=','batches.batch_id')
            ->whereIn('district_id',$disids)->count();

        }
        if($userRole  == 'TC'){
            $tc=Auth::user()->centre_id;

            $dividata['status'] = DB::table('training_batches')->where('centre_id',$tc)->value('status');
       

            $dividata['nobatch'] = DB::table('training_batches')->where('centre_id',$tc)->count();

            $dividata['nocandidate'] = DB::table('batch_candidates')->where('centre_id',$tc)->count();
        }
        if($userRole  == 'SD'){

            $dividata['adminTypeName'] = "";
            $dividata['ej2l_apps_received'] = "";
            $dividata['ej2l_apps_complted'] = "";

            $dividata['ps_apps_received'] ="";
            $dividata['ps_apps_complted'] = "";
            $dividata['status'] = DB::table('training_centres')->count();
       

            $dividata['nobatch'] = DB::table('training_batches')->count();

            $dividata['nocandidate'] = DB::table('batch_candidates')->count();
        }
	    	return view('dcview.home')->with('appsdata',$dividata);
    	

    }
}