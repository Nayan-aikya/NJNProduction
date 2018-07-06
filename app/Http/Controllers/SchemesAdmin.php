<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ej2l_Applications;
use App\powerSubsidyApps;
use App\districts;
use App\taluks;
use App\DistAppCommits;
use App\DivAppCommits;
use App\FieldInspection;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use ZipArchive;
use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;

class SchemesAdmin extends Controller
{
    // Scheme admin
    public function index(Request $request){
        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $distdata['userRole'] = $userRole;
            $distdata['adminTypeName'] = $request->district_name;

            $distdata['ej2l_apps_received'] = ej2l_Applications::where('app_district', '=', $did)->count();                          
            $distdata['ej2l_apps_complted'] = ej2l_Applications::where('app_status', '=', 'closed')->where('app_district', '=', $did)->count();

            $distdata['ps_apps_received'] = powerSubsidyApps::where('app_district', '=', $did)->count();
            $distdata['ps_apps_complted'] = powerSubsidyApps::where('app_district', '=', $did)->where('app_status', '=', 'closed')->count();

            return view('weavers.schemeDashboard')->with('appsdata',$distdata);
        }
        if($userRole == 'DD'){
            $did = $request->current_did;
            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

            $dividata['userRole'] = $userRole;
            $dividata['adminTypeName'] = $division_name;
            $dividata['ej2l_apps_received'] = ej2l_Applications::whereIn('app_district', $dists_under_div)->count();
            $dividata['ej2l_apps_complted'] = ej2l_Applications::where('app_status', '=', 'closed')
                                                ->whereIn('app_district', $dists_under_div)->count();

            $dividata['ps_apps_received'] = powerSubsidyApps::whereIn('app_district', $dists_under_div)->count();
            $dividata['ps_apps_complted'] = powerSubsidyApps::whereIn('app_district', $dists_under_div)->where('app_status', '=', 'closed')->count();

            return view('weavers.schemeDashboard')->with('appsdata',$dividata);
        }
    }

    public function ejRemarkUpdate(Request $request){
        $rules = array(
            'remarks'=> 'required',
            'applicationid'=>'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withInput()->with('formErrorStatus',$validator->messages());
        }
        else{            
            $userRole = $request->userRole;
            if($userRole == 'TD'){
                $did = $request->current_did;
                $id = Input::get('applicationid');
                $app = ej2l_Applications::find($id);
                if($app->app_status == 'applied' && $app->app_district == $did){
                    $insps = DistAppCommits::where('appType', '=', 'ej_2l')
                        ->where('appID', '=', $id)
                        ->first();
                    
                    if($insps != NULL){
                        return redirect('/weavers/ej-2loom-list/')->with('error','Remarks already found.');
                    }

                    $w3 = DistAppCommits::firstOrNew(array('appID' => $id, 'appType'=> 'ej_2l'));
                    $w3->remarks = Input::get('remarks');
                    if($w3->save()){
                    return redirect('/weavers/ej-2loom-list/')->with('success','Updated successfully');
                    }
                    else{
                        return redirect('/weavers/ej-2loom-list/')->with('error','Failed, something went wrong.');
                    }
                }
                else{
                    return redirect('/weavers/ej-2loom-list/')->with('error','Invalid action.');
                }
            }

            if($userRole == 'DD'){
                $division_name = $request->division_name;
                $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

                $id = Input::get('applicationid');
                $app = ej2l_Applications::whereIn('app_district', $dists_under_div)->where('id', '=', $id)->first();
                if($app->app_status == 'applied'){
                    $insps = DivAppCommits::select('id')
                        ->where('appType', '=', 'ej_2l')
                        ->where('appID', '=', $id)
                        ->first();

                    if($insps != NULL){
                        return redirect('/weavers/ej-2loom-list/')->with('error','Remarks already found.');
                    }

                    $w3 = DivAppCommits::firstOrNew(array('appID' => $id, 'appType'=> 'ej_2l'));
                    $w3->remarks = Input::get('remarks');
                    $w3->acceptance = Input::get('acceptance');
                    if($w3->save()){
                        $app->app_status = 'closed';
                        $app->save();
                    return redirect('/weavers/ej-2loom-list/')->with('success','Updated successfully');
                    }
                    else{
                        return redirect('/weavers/ej-2loom-list/')->with('error','Failed, something went wrong.');
                    }
                }
                else{
                    return redirect('/weavers/ej-2loom-list/')->with('error','Invalid action.');
                }
            }
        }
    }

    public function ejTlGetzip(Request $request,$id){

        if($id == ''){
            abort(404);
        }
        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $app = ej2l_Applications::where('app_district', '=', $did)->where('id', '=', $id)->first();
            if(!$app){
                return redirect('/weavers/ej-2loom-list/')->with('error','Invalid user action.');
            }
        }
        if($userRole == 'DD'){
            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

            $app = ej2l_Applications::where('app_district', '=', $did)
                                        ->whereIn('app_district', $dists_under_div)->first();
            if(!$app){
                return redirect('/weavers/ej-2loom-list/')->with('error','Invalid user action.');
            }
        }
        $dir = base_path('storage/user_files/ej_2l/'.$id);

        if (!file_exists($dir)){
            return redirect('/weavers/ej-2loom-app/details/'.$id)->with('error','Uploads directory not found.');
        }
        
        $zip_file = 'EJ2L_ID_'.$id.'_files.zip';

        // Get real path for our folder
        $rootPath = realpath($dir);

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zip_file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        readfile($zip_file);
        unlink ($zip_file);
    }

    public function ejTlList(Request $request){
        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $applications = ej2l_Applications::where('app_district',$did)->paginate(10);
            return View::make('weavers.ej_list')->with('applications',$applications);
        }
        if($userRole == 'DD'){

            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

            $applications = ej2l_Applications::whereIn('app_district', $dists_under_div)->paginate(10);
            return View::make('weavers.ej_list')->with('applications',$applications);
        }
    }

    public function ejTlDetails(Request $request, $id){
        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $app = ej2l_Applications::where('app_district', '=', $did)->where('id', '=', $id)->first();
        }
        if($userRole == 'DD'){
            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();
            $app = ej2l_Applications::whereIn('app_district', $dists_under_div)->where('id', '=', $id)->first();
        }
        if($app){
            $app->userRole = $userRole;
            $app->user_dist_name = districts::where('id',$app->resi_district)->value('district_name');
            $app->app_dist_name = districts::where('id',$app->app_district)->value('district_name');

            $app->app_taluk_name = taluks::where('id',$app->app_taluk)->value('Taluk');
            $app->resi_taluk_name = taluks::where('id',$app->resi_taluk)->value('Taluk');
            $app->dist_remarks = DistAppCommits::where('appID', '=', $app->id)->where('appType', '=', 'ej_2l')->first();
            $app->div_remarks = DivAppCommits::where('appID', '=', $app->id)->where('appType', '=', 'ej_2l')->first();
            $app->insp_remarks = FieldInspection::where('appID', '=', $app->id)->where('appType', '=', 'ej_2l')->first();
            
            return View::make('weavers.ej_details')->with('app',$app);
        }
        else{
            return redirect('login')->with('error','Invalid user.');
        }
    }

    public function psList(Request $request){
        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $applications = powerSubsidyApps::where('app_district',$did)->paginate(10);
            return View::make('weavers.ps_list')->with('applications',$applications);
        }
        if($userRole == 'DD'){

            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

            $applications = powerSubsidyApps::whereIn('app_district', $dists_under_div)->paginate(10);
            return View::make('weavers.ps_list')->with('applications',$applications);
        }
    }

    public function psDetails(Request $request,$id){
        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $app = powerSubsidyApps::where('app_district', '=', $did)->where('id', '=', $id)->first();
        }
        if($userRole == 'DD'){
            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();
            $app = powerSubsidyApps::whereIn('app_district', $dists_under_div)->where('id', '=', $id)->first();
        }
        if($app){
            $app->userRole = $userRole;
            $app->user_dist_name = districts::where('id',$app->resi_district)->value('district_name');
            $app->app_dist_name = districts::where('id',$app->app_district)->value('district_name');

            $app->app_taluk_name = taluks::where('id',$app->app_taluk)->value('Taluk');
            $app->resi_taluk_name = taluks::where('id',$app->resi_taluk)->value('Taluk');
            $app->dist_remarks = DistAppCommits::where('appID', '=', $app->id)->where('appType', '=', 'power_subsidy')->first();
            $app->div_remarks = DivAppCommits::where('appID', '=', $app->id)->where('appType', '=', 'power_subsidy')->first();
            $app->insp_remarks = FieldInspection::where('appID', '=', $app->id)->where('appType', '=', 'power_subsidy')->first();

            return View::make('weavers.ps_details')->with('app',$app);
        }
        else{
            return redirect('login')->with('error','Invalid user.');
        }
    }

    public function psRemarkUpdate(Request $request){
        $rules = array(
            'remarks'=> 'required',
            'applicationid'=>'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withInput()->with('formErrorStatus',$validator->messages());
        }
        else{
            $userRole = $request->userRole;
            if($userRole == 'TD'){
                $did = $request->current_did;
                $id = Input::get('applicationid');
                $app = powerSubsidyApps::find($id);
                if($app->app_status == 'applied' && $app->app_district == $did){

                    $insps = DistAppCommits::select('id')
                        ->where('appType', '=', 'power_subsidy')
                        ->where('appID', '=', $id)
                        ->first();

                    if($insps != NULL){
                        return redirect('/weavers/powersubsidy-list/')->with('error','Remarks already found.');
                    }

                    $w3 = DistAppCommits::firstOrNew(array('appID' => $id, 'appType'=> 'power_subsidy'));
                    $w3->remarks = Input::get('remarks');
                    if($w3->save()){
                    return redirect('/weavers/powersubsidy-list/')->with('success','Updated successfully');
                    }
                    else{
                        return redirect('/weavers/powersubsidy-list/')->with('error','Failed, something went wrong.');
                    }
                }
                else{
                    return redirect('/weavers/powersubsidy-list/')->with('error','Invalid action.');
                }
            }
            if($userRole == 'DD'){
                $division_name = $request->division_name;
                $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

                $id = Input::get('applicationid');
                $app = powerSubsidyApps::whereIn('app_district', $dists_under_div)->where('id', '=', $id)->first();
                if($app->app_status == 'applied'){

                    $insps = DivAppCommits::select('id')
                        ->where('appType', '=', 'power_subsidy')
                        ->where('appID', '=', $id)
                        ->first();

                    if($insps != NULL){
                        return redirect('/weavers/powersubsidy-list/')->with('error','Remarks already found.');
                    }

                    $w3 = DivAppCommits::firstOrNew(array('appID' => $id, 'appType'=> 'power_subsidy'));
                    $w3->remarks = Input::get('remarks');
                    $w3->acceptance = Input::get('acceptance');
                    if($w3->save()){
                        $app->app_status = 'closed';
                        $app->save();
                    return redirect('/weavers/powersubsidy-list/')->with('success','Updated successfully');
                    }
                    else{
                        return redirect('/weavers/powersubsidy-list/')->with('error','Failed, something went wrong.');
                    }
                }
                else{
                    return redirect('/weavers/powersubsidy-list/')->with('error','Invalid action.');
                }
            }
        }
    }

    public function psGetzip(Request $request,$id){
        if($id == ''){
            abort(404);
        }

        $userRole = $request->userRole;
        if($userRole == 'TD'){
            $did = $request->current_did;
            $app = powerSubsidyApps::where('app_district', '=', $did)->where('id', '=', $id)->first();
            if(!$app){
                return redirect('/weavers/powersubsidy-list/')->with('error','Invalid user action.');
            }
        }
        if($userRole == 'DD'){
            $division_name = $request->division_name;
            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();

            $dists_under_div = districts::select('id')->where('division', '=', $division_name)->get();
            $app = powerSubsidyApps::whereIn('app_district', $dists_under_div)->where('id', '=', $id)->first();
            if(!$app){
                return redirect('/weavers/powersubsidy-list/')->with('error','Invalid user action.');
            }
        }
        
        $zip_file = 'PS_ID_'.$id.'_files.zip';
        $dir = storage_path('user_files/powersubsidy/'.$id);
        // Get real path for our folder
        $rootPath = realpath($dir);

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }
        
        // Zip archive will be created only after closing object
        $zip->close();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zip_file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        readfile($zip_file);
        unlink ($zip_file);
    }

}
