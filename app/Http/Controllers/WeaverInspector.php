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
use View;

class WeaverInspector extends Controller
{
    public function showLeads(Request $req){
        $type = $req->input('type');
        $dist_id = $req->input('dist_id');
        $leads = '';
        if($type == 1){
            $leads = weaver::where('app_district', '=' ,$dist_id)
                ->where('status', '=' ,'approved')
                ->get();
        }
        if($type == 2){
            $leads = ej2l_Applications::where('app_district', '=' ,$dist_id)
                ->where('status', '=' ,'approved')
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
            'id' => 'required',
            'type' => 'required',
            'ins_status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            // return redirect('weavers/powersubsidy-apply')->with('formErrorStatus',$validator->messages());
            return response()->json(['status' => 'failed-mandatory fields missing.'], 401);
        }
        $type = $req->input('type');
        $id = $req->input('id');
        $ins_status = $req->input('ins_status');
        if($type == 1){
            $wi = weaver::find($id);
            $wi->ins_status = $req->input('ins_status');
            $wi->ins_aadhaar_no = $req->input('ins_aadhaar_no');
            if($wi->save()){
                return response()->json(['status' => 'success'], 200);
            }
        }
        if($type == 2){
            $ei = ej2l_Applications::find($id);
            $ei->ins_status = $req->input('ins_status');
            $ei->ins_aadhaar_no = $req->input('ins_aadhaar_no');
            if($ei->save()){
                return response()->json(['status' => 'success'], 200);
            }
        }
        return response()->json(['status' => 'failed'], 401);
    }
}
