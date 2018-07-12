<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\ej2l_Applications;
use App\powerSubsidyApps;
use App\districts;
use App\user_roles;
use App\taluks;
use App\DistAppCommits;
use App\investscheme;
use View;
use Image; 
use Response;
use ZipArchive;
use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Auth;

class WeaverController extends Controller
{
    /**
     * All about 2loom and electronic jaquard scheme
     */

    public function getTaluk(Request $req,$id){
        // fetch and send
        $ret = '<option value="">Select</option>';
        $taluks = taluks::where('District_Id',$id)->get();
        if(count($taluks) > 0){
            foreach ($taluks as $key => $value) {
                $ret = $ret . '<option value="'.$value->id.'">'.$value->Taluk.'</option>';
            }
        }
        echo $ret;
    }

    public function ejTlNewForm(){
        $dists = districts::all();
        return  view('weavers.ej_application',['dists'=>$dists]);
    }

    public function ejTlApply(Request $request){
        $rules = array(
            "app_district" => 'required',
            "app_taluk" => 'required',
            "fin_year" => 'required',
            "salutation" => 'required|in:Sri,Smt,Kumari',
            "name" => 'required',
            "resi_houseno" => 'required',
            "resi_wardno" => 'required',
            "resi_village" => 'required',
            "resi_taluk" => 'required',
            "resi_district" => 'required',
            "resi_pin" => 'required|digits:6',
            "resi_mobile" => 'required',
            "fwh_name" => 'required',
            "age" => 'required',
            "aadhaar" => 'required|digits:12',
            "gender" => 'required|in:male,female',
            "castecategory" => 'required|in:SC,ST,Minority,OBC,General',
            "facility_sel" => 'required|in:2lm,ejs,kms,sap,ops',
            "income" => 'required',
            "space_sqft" => 'required|numeric',
            "plan_uadd" => 'required',
            "rr_number" => 'required',
            "connect_load" => 'required|numeric',
            "building_own_type" => 'required|in:Own,Rent,Lease',
            // "prepBank_type" => 'required',
            // "prepBank_bankname" => 'required',
            // "prepBank_loanamt" => 'required',
            // "prepBank_date" => 'required',
            // "ubank_name" => 'required',
            // "ubank_uname" => 'required',
            // "ubank_branch" => 'required',
            // "ubank_actype" => 'required|in:SB,current',
            // "ubank_acno" => 'required',
            // "ubank_ifsc" => 'required',
            "appdate" => 'required',
            "app_place" => 'required',
            "photo" => 'required|file',
            // "prepBank_sancLetter" => 'required',
            "aadhaar_file" => 'required|file',
            "training_cert" => 'required|file',
            "general_licence_copy" => 'required|file',
            "ind_licence_copy" => 'required|file',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('weavers/ej-2loom-apply')->withInput()->with('errors',$validator->messages());
            // return redirect('weavers/ej-2loom-apply')->withInput()->with('formErrorStatus','Something went wrong, failed to submit! Please contact admin.');
        }
        else{
            
            $e1 = new ej2l_Applications;

            $castcat = Input::get('castecategory');
            if($castcat == 'SC'){
                $e1->appCatType = 'SCP';
            }
            if($castcat == 'ST'){
                $e1->appCatType = 'TSP';
            }
            $e1->facility_sel = Input::get('facility_sel');
            $facility_sel = Input::get('facility_sel');

            if($castcat == 'SC' || $castcat == 'ST'){
                if($facility_sel == '2lm' || $facility_sel == 'sap' || $facility_sel == 'ops')
                {
                    $e1->wka = Input::get('wka');
                }
            }

            if($castcat == 'Minority' || $castcat == 'OBC' || $castcat == 'General'){
                $e1->appCatType = 'General';
            }
            if(($castcat == 'SC' || $castcat == 'ST') && (!Input::hasFile('caste_certificate'))){
                return redirect('weavers/ej-2loom-apply')->withInput()->with('formErrorStatus','Mandatory files missing');
            }

            $e1->app_district = Input::get('app_district');
            $e1->app_taluk = Input::get('app_taluk');
            $e1->fin_year = Input::get('fin_year');
            $e1->salutation = Input::get('salutation');
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
            $e1->castecategory = Input::get('castecategory');
            $e1->building_own_type = Input::get('building_own_type');
            $e1->rr_number = Input::get('rr_number');
            $e1->plan_uadd = Input::get('plan_uadd');
            $e1->space_sqft = Input::get('space_sqft');
            $e1->income = Input::get('income');
            $e1->msme_number = Input::get('msme_number');
            $e1->num_of_looms = Input::get('num_of_looms');
            $e1->app_place = Input::get('app_place');
            $e1->appdate = Input::get('appdate');
            $e1->app_status = 'applied';
            $e1->is_complete = 'yes';
            $e1->prepBank_type = Input::get('prepBank_type');
            $e1->prepBank_bankname = Input::get('prepBank_bankname');
            $e1->prepBank_loanamt = Input::get('prepBank_loanamt');
            $e1->prepBank_date = Input::get('prepBank_date');
            $e1->ubank_name = Input::get('ubank_name');
            $e1->ubank_uname = Input::get('ubank_uname');
            $e1->ubank_branch = Input::get('ubank_branch');
            $e1->ubank_actype = Input::get('ubank_actype');
            $e1->ubank_acno = Input::get('ubank_acno');
            $e1->ubank_ifsc = Input::get('ubank_ifsc');
            if($e1->save()){
                $lastInsertedId = $e1->id;
                $file = $request->file('photo');
                $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                $photoname = $lastInsertedId."_photo_".$file->getClientOriginalName();
                $file->move($destinationPath,$photoname);
                $certificatename ='';
                if(Input::hasFile('caste_certificate')){
                    $file = $request->file('caste_certificate');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $certificatename = $lastInsertedId."_castcertificate_".$file->getClientOriginalName();
                    $file->move($destinationPath,$certificatename);
                }
                $training_certname = '';
                if(Input::hasFile('training_cert')){
                    $file = $request->file('training_cert');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $training_certname = $lastInsertedId."_trainingcert_".$file->getClientOriginalName();
                    $file->move($destinationPath,$training_certname);
                }

                $building_docs = '';
                if(Input::hasFile('building_docs')){
                    $file = $request->file('building_docs');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $building_docsname = $lastInsertedId."_buildingdog_".$file->getClientOriginalName();
                    $file->move($destinationPath,$building_docsname);
                }

                $ind_licence_copyname = '';
                if(Input::hasFile('ind_licence_copy')){
                    $file = $request->file('ind_licence_copy');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $ind_licence_copyname = $lastInsertedId."_ind_licence_".$file->getClientOriginalName();
                    $file->move($destinationPath,$ind_licence_copyname);
                }

                $aadhaar_filername = '';
                if(Input::hasFile('aadhaar_file')){
                    $file = $request->file('aadhaar_file');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $aadhaar_filename = $lastInsertedId."_aadhaar_".$file->getClientOriginalName();
                    $file->move($destinationPath,$aadhaar_filename);
                }
                $prepBank_sancLettername = '';
                if(Input::hasFile('prepBank_sancLetter')){
                    $file = $request->file('prepBank_sancLetter');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $prepBank_sancLettername = $lastInsertedId."_loansancletter_".$file->getClientOriginalName();
                    $file->move($destinationPath,$prepBank_sancLettername);
                }
                $general_licence_copy_name = '';
                if(Input::hasFile('general_licence_copy')){
                    $file = $request->file('general_licence_copy');
                    $destinationPath = base_path('storage/user_files/ej_2l/'.$lastInsertedId);
                    $general_licence_copy_name = $lastInsertedId."_general_licence_".$file->getClientOriginalName();
                    $file->move($destinationPath,$general_licence_copy_name);
                }
                

                $e2 = ej2l_Applications::find($lastInsertedId);
                $e2->photo = $photoname;
                $e2->cast_cert = $certificatename;
                $e2->training_cert = $training_certname;
                $e2->building_docs = $building_docsname;
                $e2->ind_licence_copy =$ind_licence_copyname;
                $e2->prepBank_sancLetter = $prepBank_sancLettername;
                $e2->aadhaar_file = $aadhaar_filename;
                $e2->general_licence_copy = $general_licence_copy_name;
                if($e2->save()){
                    $request->session()->put('lastInsertedId', $lastInsertedId);
                    return redirect('weavers/ej-2loom-ack');
                }
                else{
                    return redirect('weavers/ej-2loom-apply')->withInput()->with('formErrorStatus','Something went wrong, failed to submit!');
                }
            }
            else{
                return redirect('weavers/ej-2loom-apply')->withInput()->with('formErrorStatus','Something went wrong, failed to submit!');
            }
        }
    }

    public function ejShowAck(Request $request){
        if($request->session()->has('lastInsertedId')){
            $lastInsertedId = $request->session()->get('lastInsertedId');
            $app = ej2l_Applications::find($lastInsertedId);
            $app->user_dist_name = districts::where('id',$app->resi_district)->value('district_name');
            $app->app_dist_name = districts::where('id',$app->app_district)->value('district_name');
            $request->session()->forget('lastInsertedId');
            return View::make('weavers.ej_ack')->with('app',$app);
        }
        else{
            abort(404);
        } 
    }

    /**
     * All about Power subsidy
     */

    public function psNewForm(){
        $dists = districts::all();
        return  view('weavers.ps_application', ['dists'=>$dists]);
    }

    public function psApplyForm(Request $request){
        $rules = array(
            'fin_year'=> 'required',
            'app_district' => 'required',
            'app_taluk' => 'required',
            'scheme_name' => 'required',
            'unit_type' => 'required',
            'name' => 'required',
            'salutation' => 'required|in:Sri,Smt,Kumari',
            'photograph' => 'required',
            'aadhaar_file' => 'required',
            'aadhaar' => 'required|digits:12',
            'resi_houseno' => 'required',
            'resi_wardno' => 'required',
            'resi_village' => 'required',
            'resi_pin' => 'required|digits:6',
            'resi_taluk' => 'required',
            'resi_district' => 'required',
            'resi_mobile' => 'required|digits:10',
            'unit_name' => 'required',
            'unit_no' => 'required',
            'unit_wardno' => 'required',
            'unit_crossno' => 'required',
            'unit_village' => 'required',
            'unit_pin' => 'required|digits:6',
            'castecategory' => 'required|in:SC,ST,Minority,OBC,General',
            'education' => 'required|in:lt_10,PUC,UG,PG,textile_engineering,Others',
            'reg_number' => 'required',
            'regdate' => 'required',
            'ownership_type' => 'required|in:Proprietary,Partnership,PVT_LTD,co_op_society,Others',
            'u100per_women' => 'required|in:Yes,No',
            'power_alloted' => 'required|numeric',
            'power_alloted_date' => 'required',
            'recent_tax_receipt' => 'required',
            'rr_number' => 'required',
            'app_date' => 'required',
            'app_place' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('weavers/powersubsidy-apply')->withInput()->with('formErrorStatus',$validator->messages());
            // return redirect('weavers/powersubsidy-apply')->withInput()->with('formErrorStatus','Something went wrong, failed to submit! Please contact admin.');
        }
        else{
            $psa = new powerSubsidyApps;
            $psa->fin_year = Input::get('fin_year');
            $psa->app_district = Input::get('app_district');
            $psa->app_taluk = Input::get('app_taluk');
            $psa->scheme_name = Input::get('scheme_name');
            $psa->unit_type = Input::get('unit_type');
            $psa->salutation = Input::get('salutation');
            $psa->name = Input::get('name');
            $psa->aadhaar = Input::get('aadhaar');
            $psa->resi_houseno = Input::get('resi_houseno');
            $psa->resi_wardno = Input::get('resi_wardno');
            $psa->resi_crossno = Input::get('resi_crossno');
            $psa->resi_village = Input::get('resi_village');
            $psa->resi_pin = Input::get('resi_pin');
            $psa->resi_taluk = Input::get('resi_taluk');
            $psa->resi_district = Input::get('resi_district');
            $psa->resi_phone = Input::get('resi_phone');
            $psa->resi_mobile = Input::get('resi_mobile');
            $psa->unit_name = Input::get('unit_name');
            $psa->unit_no = Input::get('unit_no');
            $psa->unit_wardno = Input::get('unit_wardno');
            $psa->unit_crossno = Input::get('unit_crossno');
            $psa->unit_village = Input::get('unit_village');
            $psa->unit_pin = Input::get('unit_pin');
            $psa->unit_taluk = Input::get('app_taluk');
            $psa->unit_district = Input::get('app_district');
            $psa->unit_phone = Input::get('unit_phone');
            $psa->unit_mobile = Input::get('unit_mobile');
            $psa->castecategory = Input::get('castecategory');
            $psa->education = Input::get('education');
            $psa->reg_number = Input::get('reg_number');
            $psa->regdate = Input::get('regdate');
            $psa->ownership_type = Input::get('ownership_type');
            $psa->u100per_women = Input::get('u100per_women');            
            $psa->power_alloted = Input::get('power_alloted');
            $psa->power_alloted_date = Input::get('power_alloted_date');
            $psa->rr_number = Input::get('rr_number');
            $psa->mctype4 = json_encode(Input::get('mctype4'));            
            $psa->app_date = Input::get('app_date');
            $psa->app_place = Input::get('app_place');
            $psa->app_status = 'applied';
            $psa->is_complete = 'yes';

            $scheme_name = Input::get('scheme_name');
            $unit_type = Input::get('unit_type');

            // type validation
            $typecheck = false;
            if(($scheme_name == 'lt_10hp' || $scheme_name == 'gt_10hp_lt_20hp') && $unit_type == 'power_loom_unit'){
                $typecheck = true;
                $psa->mctype1 = json_encode(Input::get('mctype1'));
            }
            else if(($scheme_name == 'lt_10hp' || $scheme_name == 'gt_10hp_lt_20hp') && $unit_type == 'preloom_unit'){
                $typecheck = true;
                $mctype_total_num = 0;
                $tempmc2 = Input::get('mctype2');
                foreach ($tempmc2 as $key => $value) {
                    $mctype_total_num = $mctype_total_num + intval($value['power']);
                }
                $tempmc2['totalpower'] = $mctype_total_num;
                $psa->mctype2 = json_encode($tempmc2);
            }
            else if($scheme_name == 'gt_20hp_50per_off' && $unit_type == 'shuttleless_loom'){
                $typecheck = true;
                $psa->mctype3 = json_encode(Input::get('mctype3'));
            }
            
            // additional preloom
            if(Input::get('additional_preloom1', false) || Input::get('additional_preloom2', false)){
                $mctype_total_num = 0;
                $tempmc2 = Input::get('mctype2');
                foreach ($tempmc2 as $key => $value) {
                    $mctype_total_num = $mctype_total_num + intval($value['power']);
                }
                $tempmc2['totalpower'] = $mctype_total_num;
                $psa->mctype2 = json_encode($tempmc2);
            }
            // Education check
            $edu = Input::get('education');
            $edu_other = Input::get('education_other');
            $educheck = true;
            if($edu == 'Others' && $edu_other == ''){
                $educheck = false;
            }

            // Ownership check
            $ownership_type = Input::get('ownership_type');
            $ownership_other = Input::get('ownership_other');
            $ownershipcheck = true;
            if($ownership_type == 'Others' && $ownership_other == ''){
                $ownershipcheck = false;
            }

            if(!$typecheck && !$educheck && !$ownershipcheck){
                return redirect('weavers/powersubsidy-apply')->withInput()->with('formErrorStatus',"Invalid information_".$typecheck."_".$educheck ."_". $ownershipcheck);
            }
            $psa->education_other = Input::get('education_other'); 
            $psa->ownership_other = Input::get('ownership_other');

            if($psa->save()){
                $lastInsertedId = $psa->id;
                $file = $request->file('photograph');
                $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                $photoname = $lastInsertedId."_".$file->getClientOriginalName();
                $file->move($destinationPath,$photoname);
                $certificatename ='';
                if(Input::hasFile('caste_certificate')){
                    $file = $request->file('caste_certificate');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $certificatename = $lastInsertedId."_cast_cert_".$file->getClientOriginalName();
                    $file->move($destinationPath,$certificatename);
                }
                $pow_sanc_letter_name = '';
                if(Input::hasFile('pow_sanc_letter')){
                    $file = $request->file('pow_sanc_letter');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $pow_sanc_letter_name = $lastInsertedId."_pow_sanc_letter_".$file->getClientOriginalName();
                    $file->move($destinationPath,$pow_sanc_letter_name);
                }
                $trade_licence_name = '';
                if(Input::hasFile('trade_licence')){
                    $file = $request->file('trade_licence');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $trade_licence_name = $lastInsertedId."_trade_licence_".$file->getClientOriginalName();
                    $file->move($destinationPath,$trade_licence_name);
                }
                $ssi_msme_cert_name = '';
                if(Input::hasFile('ssi_msme_cert')){
                    $file = $request->file('ssi_msme_cert');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $ssi_msme_cert_name = $lastInsertedId."_ssi_msme_cert_".$file->getClientOriginalName();
                    $file->move($destinationPath,$ssi_msme_cert_name);
                }
                $recent_bill_name = '';
                if(Input::hasFile('recent_bill')){
                    $file = $request->file('recent_bill');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $recent_bill_name = $lastInsertedId."_recent_bill_".$file->getClientOriginalName();
                    $file->move($destinationPath,$recent_bill_name);
                }
                $recent_receipt_name = '';
                if(Input::hasFile('recent_receipt')){
                    $file = $request->file('recent_receipt');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $recent_receipt_name = $lastInsertedId."_recent_receipt_".$file->getClientOriginalName();
                    $file->move($destinationPath,$recent_receipt_name);
                }
                $building_docs_name = '';
                if(Input::hasFile('building_docs')){
                    $file = $request->file('building_docs');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $building_docs_name = $lastInsertedId."_building_docs_".$file->getClientOriginalName();
                    $file->move($destinationPath,$building_docs_name);
                }

                $aadhaar_file_name = '';
                if(Input::hasFile('aadhaar_file')){
                    $file = $request->file('aadhaar_file');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $aadhaar_file_name = $lastInsertedId."_aadhaar_".$file->getClientOriginalName();
                    $file->move($destinationPath,$aadhaar_file_name);
                }

                $recent_tax_receipt_name = '';
                if(Input::hasFile('recent_tax_receipt')){
                    $file = $request->file('recent_tax_receipt');
                    $destinationPath = base_path('storage/user_files/powersubsidy/'.$lastInsertedId);
                    $recent_tax_receipt_name = $lastInsertedId."_taxreceipt_".$file->getClientOriginalName();
                    $file->move($destinationPath,$recent_tax_receipt_name);
                }

                $psa2 = powerSubsidyApps::find($lastInsertedId);
                $psa2->photograph = $photoname;
                $psa2->cast_certificate = $certificatename;
                $psa2->pow_sanc_letter = $pow_sanc_letter_name;
                $psa2->trade_licence = $trade_licence_name;
                $psa2->ssi_msme_cert = $ssi_msme_cert_name;
                $psa2->recent_bill = $recent_bill_name;
                $psa2->recent_receipt = $recent_receipt_name;
                $psa2->building_docs = $building_docs_name;
                $psa2->aadhaar_file = $aadhaar_file_name;
                $psa2->recent_tax_receipt = $recent_tax_receipt_name;
                if($psa2->save()){
                    $request->session()->put('lastInsertedId', $lastInsertedId);
                    return redirect('weavers/powersubsidy-ack/');
                }
                else{
                    return redirect('weavers/powersubsidy-apply')->withInput()->with('formErrorStatus','Document process failed.');
                }
                
            }
        }
    }

    public function psShowAck(Request $request){
        if($request->session()->has('lastInsertedId')){
            $lastInsertedId = $request->session()->get('lastInsertedId');
            $app = powerSubsidyApps::find($lastInsertedId);
            $app->user_dist_name = districts::where('id',$app->resi_district)->value('district_name');
            $app->app_dist_name = districts::where('id',$app->app_district)->value('district_name');
            $request->session()->forget('lastInsertedId');
            return View::make('weavers.ps_ack')->with('app',$app);
        }
        else{
            abort(404);
        } 
    }

    /**
     * All about Investment plan
     */
    
    public function investApply(Request $req){

        $rules = array(
            'regno' => 'required',
            'unit_name' => 'required',
            'company_address' => 'required',
            'unit_address' => 'required',
            'unit_city' => 'required',
            'unit_pin' => 'required',
            'em_regno' => 'required',
            'em_regdate' => 'required',
            'vat_regno' => 'required',
            'vat_regdate' => 'required',
            'industry_nature' => 'required',
            'products_man' => 'required',
            'constitution_ind_type' => 'required',
            'ent_category' => 'required',
            'unit_park' => 'required',
            'ind_ex_type' => 'required',
            'procost_land' => 'required|numeric',
            'procost_build' => 'required|numeric',
            'procost_machin' => 'required|numeric',
            'other' => 'required|numeric',
            'total' => 'required|numeric',
            'loan_inst_name' => 'required',
            'loan_date' => 'required',
            'loan_amount' => 'required',
            'cont_name' => 'required',
            'cont_phone' => 'required|digits:10',
            'cont_email' => 'required|email',
            'bank_acname' => 'required',
            'bank_name' => 'required',
            'bank_acno' => 'required',
            'bank_ifsc' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('weavers/invest-apply')->withInput()->with('formErrorStatus','Something went wrong, failed to submit! Please contact admin.');
        }
        else{
            $is = new investscheme;
            $is->regno = Input::get('regno');
            $is->unit_name = Input::get('unit_name');
            $is->company_address = Input::get('company_address');
            $is->unit_address = Input::get('unit_address');
            $is->unit_city = Input::get('unit_city');
            $is->unit_pin = Input::get('unit_pin');
            $is->zone_new = json_encode(Input::get('zone_new'));
            $is->zone_old = json_encode(Input::get('zone_old'));
            $is->em_regno = Input::get('em_regno');
            $is->em_regdate = Input::get('em_regdate');
            $is->vat_regno = Input::get('vat_regno');
            $is->vat_regdate = Input::get('vat_regdate');
            $is->industry_nature = Input::get('industry_nature');
            $is->products_man = Input::get('products_man');
            $is->constitution_ind_type = Input::get('constitution_ind_type');
            $is->ent_category = Input::get('ent_category');
            $is->unit_park = Input::get('unit_park');
            $is->ind_ex_type = Input::get('ind_ex_type');
            $is->procost_land = Input::get('procost_land');
            $is->procost_build = Input::get('procost_build');
            $is->procost_machin = Input::get('procost_machin');
            $is->other = Input::get('other');
            $is->total = Input::get('total');
            $is->loan_inst_name = Input::get('loan_inst_name');
            $is->loan_date = Input::get('loan_date');
            $is->loan_amount = Input::get('loan_amount');
            $is->employment_newunit_a = Input::get('employment_newunit_a');
            $is->employment_newunit_b = Input::get('employment_newunit_b');
            $is->cont_name = Input::get('cont_name');
            $is->cont_phone = Input::get('cont_phone');
            $is->cont_email = Input::get('cont_email');
            $is->bank_acname = Input::get('bank_acname');
            $is->bank_name = Input::get('bank_name');
            $is->bank_acno = Input::get('bank_acno');
            $is->bank_ifsc = Input::get('bank_ifsc');
            $is->incentive_list = json_encode(Input::get('incentive_list'));
            $is->form_list = Input::get('form_list');
            if($is->save()){
                return redirect('weavers/invest-apply')->with('formSuccessStatus','Form submitted successfully');
            }
            else{
                return redirect('weavers/invest-apply')->with('formErrorStatus','Something went wrong, failed to submit! Please contact admin.');
            }
        }
    }
    public function investList(){
        if(!$this->checkTD()){
            return redirect('login');
        }
        $applications = investscheme::all();
        return View::make('weavers.invest_list')->with('applications',$applications);
    }
}
