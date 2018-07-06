<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\powerSubsidyApps;
use App\districts;
use View;

class WeaverDataImport extends Controller
{
    public function psEdit($id){
        $app = powerSubsidyApps::where('id',$id)
        ->where('is_complete', '=', 'no')
        ->first();
        if($app){
            $app->dists = districts::all();
            $app->app_dist_name = districts::where('id',$app->resi_district)->value('district_name');
            return View::make('weavers.ps_app_edit', compact('app'));
        }
        else{
            return Redirect('/weavers/schemes')->withErrors(['Invalid action']);
        }
    }
    
    public function ps_update(Request $request,$id){
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
            $did = $request->current_did;
            $psa = powerSubsidyApps::where('app_district', '=', $did)
                                    ->where('is_complete','=','no')
                                    ->first();
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
}
