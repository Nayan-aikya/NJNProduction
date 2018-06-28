<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\powerSubsidyApps;
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
use Illuminate\Support\Facades\Log;

class WeaverInspector extends Controller
{
    public function showLeads(Request $req){
        if(Auth::guard('api')->user()->user_id != 5){
            return response()->json(['status' => 'Unauthorised access.'], 401);
        }
        // dd(Auth::guard('api')->user()->district);
        $ins_dist = Auth::guard('api')->user()->district;
        $dist_id = districts::where('district_name', '=', $ins_dist)->value('id');

        $type = $req->input('type');
        $leads = '';
        if($type == 1){
            $leads = powerSubsidyApps::where('app_district', '=' ,$dist_id)
            ->where('ins_status', '=' ,'pending')
            ->get();
        }
        if($type == 2){
            $leads = ej2l_Applications::where('app_district', '=' ,$dist_id)
            ->where('ins_status', '=' ,'pending')
            ->get();
        }
        return response()->json($leads,200);
    }
    

    public function showOneLead(Request $req){
        if(Auth::guard('api')->user()->user_id != 5){
            return response()->json(['status' => 'Unauthorised access.'], 401);
        }
        $ins_dist = Auth::guard('api')->user()->district;
        $dist_id = districts::where('district_name', '=', $ins_dist)->value('id');

        $type = $req->input('type');
        $id = $req->input('id');

        $leads = '';
        if($type == 1){
            $leads = powerSubsidyApps::where('app_district', '=' ,$dist_id)->where('id', '=', $id)->get();
            return response()->json($leads,200);
        }
        if($type == 2){
            $leads = ej2l_Applications::where('app_district', '=' ,$dist_id)->where('id', '=', $id)->get();
            return response()->json($leads,200);
        }
        return response()->json(['status' => 'No data found.'], 401);
    }

    public function update(Request $req){

        if(Auth::guard('api')->user()->user_id != 5){
            return response()->json(['status' => 'Unauthorised access.'], 401);
        }
        $rules = array(
            'id' => 'required|numeric',
            'type' => 'required|numeric',
            'ins_build_picture'=> 'required',
            'ins_loom_pictures'=> 'required',
            'ins_lat' => 'required',
            'ins_long' => 'required',
            'ins_remarks' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            // return response()->json(['status' => 'failed-mandatory fields missing.'], 401);
            return response()->json($validator->messages(), 401);
        }
        $ins_dist = Auth::guard('api')->user()->district;
        $dist_id = districts::where('district_name', '=', $ins_dist)->value('id');

        $type = $req->input('type');
        $id = $req->input('id');
        if($type == 1){
            $wi = powerSubsidyApps::where('app_district', '=' ,$dist_id)->where('id', '=', $id)->first();
            if(!$wi){
                return response()->json(['status' => 'Invalid record access.'], 401);
            }
            $dir_to_up = '../storage/user_files/powersubsidy/'.$id.'/';

            $wi->ins_lat = $req->input('ins_lat');
            $wi->ins_long = $req->input('ins_long');
            $wi->ins_remarks = $req->input('ins_remarks');
            $wi->ins_date = date('Y-m-d H:i:s');
            // $wi->ins_status = 'finished';

            if($wi->save()){
                $imageStr = $req->input('ins_build_picture');
                if (!is_dir($dir_to_up)) {
                    File::makeDirectory(base_path('storage/user_files/powersubsidy/'.$id.'/'),0775,true);
                }
                file_put_contents($dir_to_up.'building_picture.jpg', base64_decode($imageStr));
                $wi1 = powerSubsidyApps::find($id);
                $wi1->ins_build_picture ="building_picture.jpg";

                $loompics = $req->input('ins_loom_pictures');
                $loompicsarray = array();
                $key = 1;
                foreach ($loompics as $value) {
                    $picname = 'loompic_'.$key.'.jpg';
                    $loompicsarray[] = $picname;
                    file_put_contents($dir_to_up.$picname, base64_decode($value));
                    $key++;
                }
                $wi1->ins_loom_pictures = json_encode($loompicsarray);

                $wi1->save();
                return response()->json(['status' => 'success'], 200);
            }
        }

        if($type == 2){            
            $ei = ej2l_Applications::where('app_district', '=' ,$dist_id)->where('id', '=', $id)->first();
            if(!$ei){
                return response()->json(['status' => 'Invalid record access.'], 401);
            }
            $dir_to_up = '../storage/user_files/ej_2l/'.$id.'/';
            
            $ei->ins_lat = $req->input('ins_lat');
            $ei->ins_long = $req->input('ins_long');
            $ei->ins_remarks = $req->input('ins_remarks');
            $ei->ins_date = date('Y-m-d H:i:s');
            // $ei->ins_status = 'finished';

            if($ei->save()){
                $imageStr = $req->input('ins_build_picture');
                if (!is_dir($dir_to_up)) {
                    File::makeDirectory(base_path('storage/user_files/ej_2l/'.$id.'/'),0775,true);
                }
                file_put_contents($dir_to_up.'building_picture.jpg', base64_decode($imageStr));

                $loompics = $req->input('ins_loom_pictures');
                $loompicsarray = array();
                $key = 1;
                foreach ($loompics as $value) {
                    $picname = 'loompic_'.$key.'.jpg';
                    $loompicsarray[] = $picname;
                    file_put_contents($dir_to_up.$picname, base64_decode($value));
                    $key++;
                }
                $ei1 = ej2l_Applications::find($id);
                $ei1->ins_loom_pictures = json_encode($loompicsarray);

                $ei1->ins_build_picture ="building_picture.jpg";
                
                $ei1->save();
                return response()->json(['status' => 'success'], 200);
            }
        }
        return response()->json(['status' => 'failed'], 401);
    }

}
