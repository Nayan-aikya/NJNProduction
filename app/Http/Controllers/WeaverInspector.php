<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\weaver;
use App\ej2l_Applications;
use Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\user_roles;
use App\users;
use App\districts;
use Image;
use File;
use View;

class WeaverInspector extends Controller
{
    public function showLeads(Request $req){
        $type = $req->input('type');
        $dist_id = $req->input('dist_id');
        $leads = '';
        if($type == 1){
            $leads = weaver::where('app_district', '=' ,$dist_id)
                ->get();
        }
        if($type == 2){
            $leads = ej2l_Applications::where('app_district', '=' ,$dist_id)
                ->get();
        }
        return response()->json($leads,200);
    }
    
    public function showdistricts(){
        $dists = districts::all();
        return response()->json($dists,200);
    }

    public function showOneLead(Request $req){
        $type = $req->input('type');
        $id = $req->input('id');

        $leads = '';
        if($type == 1){
            $leads = weaver::find($id);
            return response()->json($leads,200);
        }
        if($type == 2){
            $leads = ej2l_Applications::find($id);
            return response()->json($leads,200);
        }
        return response()->json($leads,200);
    }

    public function update(Request $req){
        $rules = array(
            'id' => 'required|numeric',
            'type' => 'required|numeric',
            'ins_status' => 'required',
            'ins_aadhaar_img' => 'required',
            'ins_aadhaar_no' => 'required|digits:12',
            'building_image'=> 'required',
            'ins_lat' => 'required',
            'ins_long' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            // return response()->json(['status' => 'failed-mandatory fields missing.'], 401);
            return response()->json($validator->messages(), 401);
        }
        $type = $req->input('type');
        $id = $req->input('id');

        if($type == 1){
            $wi = weaver::find($id);
            if(!$wi){
                return response()->json(['status' => 'failed- No record found.'], 401);
            }
            $dir_to_up = '../user_files/powersubsidy/'.$id.'/';
            $wi->ins_status = $req->input('ins_status');
            $wi->ins_aadhaar_no = $req->input('ins_aadhaar_no');
            $wi->ins_lat = $req->input('lat');
            $wi->ins_long = $req->input('long');
            if($wi->save()){
                $imageStr = $req->input('ins_aadhaar_img');
                if (!is_dir($dir_to_up)) {
                    File::makeDirectory(base_path('user_files/powersubsidy/'.$id.'/'),0775,true);
                }
                file_put_contents($dir_to_up.'aadhaar.jpg', base64_decode($imageStr));
                return response()->json(['status' => 'success'], 200);
            }
        }

        if($type == 2){            
            $ei = ej2l_Applications::find($id);
            if(!$ei){
                return response()->json(['status' => 'failed- No record found.'], 401);
            }
            $dir_to_up = '../user_files/ej_2l/'.$id.'/';
            $ei->ins_status = $req->input('ins_status');
            $ei->ins_aadhaar_no = $req->input('ins_aadhaar_no');
            $ei->ins_lat = $req->input('ins_lat');
            $ei->ins_long = $req->input('ins_long');
            if($ei->save()){
                $imageStr = $req->input('ins_aadhaar_img');
                if (!is_dir($dir_to_up)) {
                    File::makeDirectory(base_path('user_files/ej_2l/'.$id.'/'),0775,true);
                }
                file_put_contents($dir_to_up.'aadhaar.jpg', base64_decode($imageStr));
                return response()->json(['status' => 'success'], 200);
            }
        }
        return response()->json(['status' => 'failed'], 401);
    }

}
