<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\weaver;
use App\ej2l_Applications;
use App\districts;
use View;
use Response;
use ZipArchive;
use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;

class WeaverController extends Controller
{
    /**
     * New weaver application
     */
    public function psNewForm(){
        $dists = districts::all();
        return  view('weavers.ps_application', ['dists'=>$dists]);
    }
    public function psApplyForm(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'resi_houseno' => 'required',
            'resi_wardno' => 'required',
            'resi_crossno' => 'required',
            'resi_village' => 'required',
            'resi_taluk' => 'required',
            'resi_district' => 'required',
            'app_district' => 'required',
            'resi_pin' => 'required',
            // 'resi_phone' => 'required',
            'resi_mobile' => 'required|digits:10',
            'unit_houseno' => 'required',
            'unit_wardno' => 'required',
            'unit_crossno' => 'required',
            'unit_village' => 'required',
            'unit_taluk' => 'required',
            'unit_district' => 'required',
            'unit_pin' => 'required',
            // 'unit_phone' => 'required',
            'unit_mobile' => 'required|digits:10',
            'unit_meter' => 'required',
            'subcast' => 'required',
            'cast_category' => 'required',
            'education' => 'required',
            'reg_number' => 'required',
            'reg_date' => 'required',
            'ownership_type' => 'required',
            'power_alloted' => 'required',
            'power_consumed' => 'required',
            'rr_number' => 'required',
            'mc_details_A' => 'required',
            'mc_details_B' => 'required',
            'mc_details_C' => 'required',
            'mc_details_D' => 'required',
            'app_date' => 'required',
            'app_place' => 'required',
            'photograph' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            // return redirect('weavers/powersubsidy-apply')->with('formErrorStatus',$validator->messages());
            return redirect('weavers/powersubsidy-apply')->with('formErrorStatus','Something went wrong, failed to submit! Please contact admin.');
        }
        else{
            $w1 = new weaver;
            $w1->name = Input::get('name');
            $w1->resi_houseno = Input::get('resi_houseno');
            $w1->app_district = Input::get('app_district');            
            $w1->resi_wardno = Input::get('resi_wardno');
            $w1->resi_crossno = Input::get('resi_crossno');
            $w1->resi_village = Input::get('resi_village');
            $w1->resi_taluk = Input::get('resi_taluk');
            $w1->resi_district = Input::get('resi_district');
            $w1->resi_pin = Input::get('resi_pin');
            $w1->resi_phone = Input::get('resi_phone');
            $w1->resi_mobile = Input::get('resi_mobile');
            $w1->unit_houseno = Input::get('unit_houseno');
            $w1->unit_wardno = Input::get('unit_wardno');
            $w1->unit_crossno = Input::get('unit_crossno');
            $w1->unit_village = Input::get('unit_village');
            $w1->unit_taluk = Input::get('unit_taluk');
            $w1->unit_district = Input::get('unit_district');
            $w1->unit_pin = Input::get('unit_pin');
            $w1->unit_phone = Input::get('unit_phone');
            $w1->unit_mobile = Input::get('unit_mobile');
            $w1->unit_meter = Input::get('unit_meter');
            $w1->subcast = Input::get('subcast');
            $w1->cast_category = Input::get('cast_category');
            $w1->education = Input::get('education');
            $w1->reg_number = Input::get('reg_number');
            $w1->reg_date = Input::get('reg_date');
            $w1->ownership_type = Input::get('ownership_type');
            $w1->power_alloted = Input::get('power_alloted');
            $w1->power_consumed = Input::get('power_consumed');
            $w1->rr_number = Input::get('rr_number');
            $w1->mc_details_A = Input::get('mc_details_A');
            $w1->mc_details_B = Input::get('mc_details_B');
            $w1->mc_details_C = Input::get('mc_details_C');
            $w1->mc_details_D = Input::get('mc_details_D');
            $w1->status = 'applied';
            $w1->app_date = date("d-m-Y");
            $w1->app_place = Input::get('app_place');
            if($w1->save()){
                $lastInsertedId = $w1->id;
                $file = $request->file('photograph');
                $destinationPath = base_path('user_files/powersubsidy/'.$lastInsertedId.'/photos');
                $photoname = $lastInsertedId."_".$file->getClientOriginalName();
                $file->move($destinationPath,$photoname);
                $certificatename ='';
                if(Input::hasFile('certificate')){
                    $file = $request->file('certificate');
                    $destinationPath = base_path('user_files/powersubsidy/'.$lastInsertedId.'/certificates');
                    $certificatename = $lastInsertedId."_".$file->getClientOriginalName();
                    $file->move($destinationPath,$certificatename);
                }
                $annexureaname = '';
                if(Input::hasFile('annexurea')){
                    $file = $request->file('annexurea');
                    $destinationPath = base_path('user_files/powersubsidy/'.$lastInsertedId.'/annexurs');
                    $annexureaname = $lastInsertedId."_annexurea_".$file->getClientOriginalName();
                    $file->move($destinationPath,$annexureaname);
                }
                $annexurebname = '';
                if(Input::hasFile('annexureb')){
                    $file = $request->file('annexureb');
                    $destinationPath = base_path('user_files/powersubsidy/'.$lastInsertedId.'/annexurs');
                    $annexurebname = $lastInsertedId."_annexureb_".$file->getClientOriginalName();
                    $file->move($destinationPath,$annexurebname);
                }
                $annexurecname = '';
                if(Input::hasFile('annexurec')){
                    $file = $request->file('annexurec');
                    $destinationPath = base_path('user_files/powersubsidy/'.$lastInsertedId.'/annexurs');
                    $annexurecname = $lastInsertedId."_annexurec_".$file->getClientOriginalName();
                    $file->move($destinationPath,$annexurecname);
                }
                $annexuredname = '';
                if(Input::hasFile('annexured')){
                    $file = $request->file('annexured');
                    $destinationPath = base_path('user_files/powersubsidy/'.$lastInsertedId.'/annexurs');
                    $annexuredname = $lastInsertedId."_annexured_".$file->getClientOriginalName();
                    $file->move($destinationPath,$annexuredname);
                }

                $w2 = weaver::find($lastInsertedId);
                $w2->photograph = $photoname;
                $w2->certificate = $certificatename;
                $w2->annexurea = $annexureaname;
                $w2->annexureb = $annexurebname;
                $w2->annexurec = $annexurecname;
                $w2->annexured = $annexuredname;
                $w2->save();
                return redirect('weavers/powersubsidy-apply')->with('formSuccessStatus','Form submitted successfully.');
            }
        }
    }
    public function ejTlNewForm(){
        $dists = districts::all();
        return  view('weavers.ej_application',['dists'=>$dists]);
    }
    public function ejTlApply(Request $request)
    {
        $rules = array(
            'app_district' => 'required',
            'name' => 'required',
            'resi_houseno' => 'required',
            'resi_wardno' => 'required',
            'resi_crossno' => 'required',
            'resi_village' => 'required',
            'resi_taluk' => 'required',
            'resi_district' => 'required',
            'resi_pin' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'aadhaar' => 'required',
            'email' => 'required',
            'resi_mobile' => 'required',
            'fwh_name' => 'required',
            'gender' => 'required',
            'e2l' => 'required_without_all:ejs,kms,sap,cis',
            'ejs' => 'required_without_all:e2l,kms,sap,cis',
            'kms' => 'required_without_all:ejs,e2l,sap,cis',
            'sap' => 'required_without_all:ejs,kms,e2l,cis',
            'cis' => 'required_without_all:ejs,kms,sap,e2l',
            'castecategory' => 'required',
            'rr_number' => 'required',
            'plan_uadd' => 'required',
            'space_sqft' => 'required',
            'income' => 'required',
            'msme_number' => 'required',
            'bankpref' => 'required',
            'bank_branch' => 'required',
            'actype' => 'required',
            'bank_acno' => 'required',
            'bank_ifsc' => 'required',
            'exp_loan' => 'required',
            'app_place' => 'required',
            "photo" => 'required',
            "caste_certificate" => 'required',
            "training_cert" => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('weavers/ej-2loom-apply')->with('errors',$validator->messages());
            // return redirect('weavers/ej-2loom-apply')->with('formErrorStatus','Something went wrong, failed to submit! Please contact admin.');
        }
        else{
            $e1 = new ej2l_Applications;
            $e1->app_district = Input::get('app_district');
            $e1->name = Input::get('name');
            $e1->resi_houseno = Input::get('resi_houseno');
            $e1->resi_wardno = Input::get('resi_wardno');
            $e1->resi_crossno = Input::get('resi_crossno');
            $e1->resi_village = Input::get('resi_village');
            $e1->resi_taluk = Input::get('resi_taluk');
            $e1->resi_district = Input::get('resi_district');
            $e1->resi_pin = Input::get('resi_pin');
            $e1->dob = Input::get('dob');
            $e1->age = Input::get('age');
            $e1->aadhaar = Input::get('aadhaar');
            $e1->email = Input::get('email');
            $e1->resi_mobile = Input::get('resi_mobile');
            $e1->resi_phone = Input::get('resi_phone');
            $e1->fwh_name = Input::get('fwh_name');
            $e1->gender = Input::get('gender');
            $e1->e2l = Input::get('e2l');
            $e1->ejs = Input::get('ejs');
            $e1->kms = Input::get('kms');
            $e1->sap = Input::get('sap');
            $e1->cis = Input::get('cis');
            $e1->castecategory = Input::get('castecategory');
            $e1->rr_number = Input::get('rr_number');
            $e1->plan_uadd = Input::get('plan_uadd');
            $e1->space_sqft = Input::get('space_sqft');
            $e1->income = Input::get('income');
            $e1->msme_number = Input::get('msme_number');
            $e1->bankpref = Input::get('bankpref');
            $e1->bank_branch = Input::get('bank_branch');
            $e1->actype = Input::get('actype');
            $e1->bank_acno = Input::get('bank_acno');
            $e1->bank_ifsc = Input::get('bank_ifsc');
            $e1->exp_loan = Input::get('exp_loan');
            $e1->app_place = Input::get('app_place');
            $e1->status = 'applied';
            if($e1->save()){
                $lastInsertedId = $e1->id;
                $file = $request->file('photo');
                $destinationPath = base_path('user_files/ej_2l/'.$lastInsertedId.'/photos');
                $photoname = $lastInsertedId."_".$file->getClientOriginalName();
                $file->move($destinationPath,$photoname);
                $certificatename ='';
                if(Input::hasFile('caste_certificate')){
                    $file = $request->file('caste_certificate');
                    $destinationPath = base_path('user_files/ej_2l/'.$lastInsertedId.'/caste_certificate');
                    $certificatename = $lastInsertedId."_".$file->getClientOriginalName();
                    $file->move($destinationPath,$certificatename);
                }
                $training_certname = '';
                if(Input::hasFile('training_cert')){
                    $file = $request->file('training_cert');
                    $destinationPath = base_path('user_files/ej_2l/'.$lastInsertedId.'/training_certificate');
                    $training_certname = $lastInsertedId."_".$file->getClientOriginalName();
                    $file->move($destinationPath,$training_certname);
                }

                $e2 = ej2l_Applications::find($lastInsertedId);
                $e2->photo = $photoname;
                $e2->cast_cert = $certificatename;
                $e2->training_cert = $training_certname;
                $e2->save();
                return redirect('weavers/ej-2loom-apply')->with('formSuccessStatus','Form submitted successfully.');
            }
        }
    }
}
