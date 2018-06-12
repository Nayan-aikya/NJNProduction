<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use DB;
use Session;
use App\batches;
use App\users;
use App\user_roles;
use App\training_centres;
use App\districts;
use App\training_centre_subjects;
use App\states;
use App\types_of_centres;
use App\sequences;
use App\training_batches;
use App\roles;
use App\physical_target;
use App\financial_target;
use App\batch_employment_expenses;
use App\academicyear;
use Hash;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;
use DateTime;

class TdController extends Controller
{

     public function show($centreid)
    {   
        
        $districts=districts::all();
        $states=states::all();
        $types_of_centres=types_of_centres::all();
        $training_centre_subjects=training_centre_subjects::all();
        $academicyear=academicyear::all();
        $training_centres['training_centres']=training_centres::where('centre_id',$centreid)->get();

        return view('tdview.viewtcedit',$training_centres,compact('districts','states','types_of_centres','training_centre_subjects','academicyear'));

    }

     public function tcform(Request $ob)
    {
        $username=session()->get('username');
        $password=session()->get('password');

        // echo $username;

        $valiueofemil=$ob->email;
        
        $usercall= new users();
        $info = $usercall->fetchUserInfo($username);
        $district=$info[0]->district;

        $districtcall=new districts();
        $division = $districtcall->fetchDivisionInfo($district);
        $div=$division[0]->division;

        $districts = $districtcall->fetchDistrict();

        $subjectcall= new training_centre_subjects();
        $subjects = $subjectcall->fetchSubject();

        $statecall = new states();
        $states = $statecall->fetchState();

        $centretypecall=new types_of_centres();
        $tocs = $centretypecall->fetchCentreTypes();

        $academicyear=academicyear::all();

        return view('tdview.training_center_form',compact('districts','states','tocs','district','div','subjects','academicyear'));
    }
    
    public function insert(Request $req)
    {    
        $username=session()->get('username');
        $password=session()->get('password');

        $usercall= new users();
        $info = $usercall->fetchUserInfo($username);
        $district=$info[0]->district;

        $districtcall=new districts();
        $districtinfo = $districtcall->fetchDivisionInfo($district);
        $district_code= $districtinfo[0]->district_code;

        $seqcall = new sequences();
        $seqinfo = $seqcall->fetchSequence();
        $centre_id=$seqinfo[0]->centre_id;
        if($centre_id<10)
            $centre_id="0".$centre_id;
        $centre_prefix=$seqinfo[0]->centre_prefix;
        $centre_code=$district_code.$centre_prefix.$centre_id;
        $newcentre_id=$centre_id+1;

        $newid = array('centre_id'=>$newcentre_id);
        $seqcall->updateSequence($newid);

        $training_centre = new training_centres;
        $training_centre->name=$req->name;
        $training_centre->centre_id=$centre_code;
        $training_centre->centre_name=$req->centre_name;
        $training_centre->district_id=$district_code;
        $training_centre->upload_pic='data';
        $training_centre->street=$req->street;
        $training_centre->district=$req->district; 
        $training_centre->state=$req->state;  
        $training_centre->pin_code=$req->pin;
        $training_centre->email=$req->email;
        $training_centre->mobile_number=$req->mobile;
        $training_centre->landline=$req->landline;
        $training_centre->website_id=$req->websiteid;
        $training_centre->pan_card=$req->pancard; 
        $training_centre->pan_card_image='data';
        $training_centre->gst=$req->gst;
        $training_centre->gst_image='data';
        $training_centre->training_start=$req->trainingstart;
        $training_centre->training_end=$req->trainingend; 
        $training_centre->adhar_card=$req->adhar;
        $training_centre->adhar_card_image='data';
        $training_centre->centre_type=$req->centre;
        $training_centre->training=$req->training;
        $training_centre->academic_year=$req->fiscalyear;
        $training_centre->centre_status="created";
        $training_centre->save();
        if($training_centre->save()){
            // return view('pages.success');
            Session::flash("success", "Training Centre created successfully!!");
            return Redirect::back();
        }
        else{
            // echo "insertion faild";
            Session::flash("success", "Training Centre creation failed!!");
            return Redirect::back();
        }
    }


    public function fetchtclist(Request $obj)
    {
      $tccall=new training_centres();
      $tcinfo = $tccall->fetchTcList();  
      return view('tdview.viewtc')->with(array('tcinfo'=>$tcinfo));
    }
    public function deletetcview($centreid)
    { 
        $tccall=new training_centres();
        $tc = $tccall->deleteTc($centreid);
        // return view('pages.success');  
        Session::flash("success", "Deleted successfully!!");
        return Redirect::back();
    }
    public function fetchbatchlistview(Request $obj)
    {
        $batchcall = new batches();
        $batchinfo=$batchcall->fetchBatchList(); 
        return view('tcview.viewbatchlist')->with(array('batchinfo'=>$batchinfo));
    }
    public function fetchbatchlist(Request $obj)
    {
        $batchcall = new batches();
        $batchinfo = $batchcall->fetchPendingBatchList();
        return view('tdview.viewbatch')->with(array('batchinfo'=>$batchinfo));
    }
    public function fetchTrainingCentreList(Request $obj)
    {
        $tccall =new training_centres();
        $tcinfo =$tccall->fetchPendingTcList();
        return view('tdview.approvetcview')->with(array('tcinfo'=>$tcinfo));
    }

    public function approveBatch($id)
    {
        $batchcall = new batches();
        $new_batch_data = array('status'=>"Approved");
        $batch = $batchcall->approveBatch($id,$new_batch_data);

        $batchinfo = $batchcall->fetchBatchSpecInfo($id);

        $data1 = array("centre_id"=>$batchinfo[0]->centre_id,"batch_id"=>$batchinfo[0]->batch_id,"batch_name"=>$batchinfo[0]->batch_name,"status"=>$batchinfo[0]->status,"created_by"=>$batchinfo[0]->created_by,"batch_type"=>$batchinfo[0]->training_type,"batch_academic_year"=>$batchinfo[0]->academic_year);

        $trainingbatchcall = new training_batches();
        $tb=$trainingbatchcall->insertTrainingBatch($data1);
        // return view('pages.success');
        Session::flash("success", "Batch approved successfully!!");
        return Redirect::back();
    }
    public function approveBatchtarget()
    {
        $tc = new training_centres();
        $tcs =  $tc->fetchtcforList();
        return view('tcview.apppftarget',compact('tcs'));
    }
        
    public function Approvetc($id)
    {  
       $tccall =new training_centres();
       $new_tc_data =array('centre_status'=>"Approved");
       $tc=$tccall->approveTc($id,$new_tc_data);
       // return view('pages.success'); 
       Session::flash("success", "Training Centre approved successfully!!");
       return Redirect::back(); 
    }
         public function rejectTc($id)
    { 
        $tccall = new training_centres();
        $new_tc_data = array('centre_status'=>"Rejected");
        $tc = $tccall->rejectTc($id,$new_tc_data);
        // return view('pages.success');
        Session::flash("success", "Training Centre rejected successfully!!");
        return Redirect::back();  
    }

   
       public function rejectBatch($id)
    { 
        $batchcall = new batches();
        $new_batch_data = array('status'=>"Rejected");
        $batch = $batchcall->rejectBatch($id,$new_batch_data);
        // return view('pages.success');  
        Session::flash("success", "Batch rejected successfully!!");
        return Redirect::back();
    }
   
   

    public function updatetc(Request $req)
    {    
       
        $training_centre=training_centres::find($req->id);
        $training_centre->name=$req->name;
        $training_centre->centre_id=$req->centreid;
        $training_centre->centre_name=$req->centre_name;
        $training_centre->district_id='data';
        $training_centre->upload_pic='data';
        $training_centre->street=$req->street;
        $training_centre->district=$req->district; 
        $training_centre->state=$req->state;  
        $training_centre->pin_code=$req->pin;
        $training_centre->email=$req->email;
        $training_centre->mobile_number=$req->mobile;
        $training_centre->landline=$req->landline;
        $training_centre->website_id=$req->websiteid;
        $training_centre->pan_card=$req->pancard; 
        $training_centre->pan_card_image='data';
        $training_centre->gst=$req->gst;
        $training_centre->gst_image='data';
        $training_centre->training_start=$req->trainingstart;
        $training_centre->training_end=$req->trainingend; 
        $training_centre->adhar_card=$req->adhar;
        $training_centre->adhar_card_image='data';
        $training_centre->centre_type=$req->centre;
        $training_centre->training=$req->training;
        $training_centre->centre_status="active";
        $training_centre->save();
        if($training_centre->save()){
            return view('pages.success');
            // Session::flash("success", "Updated successfully!!");
            // return Redirect::back();
        }
        else{
            echo "Update failed";
            // Session::flash("success", "Unable to update!!");
            // return Redirect::back();
        }
    }

    public function credentialCreation()
    {  
       $districts=districts::all(); 
       $ayobj = new academicyear();
       $academicyear = $ayobj->fetchAcademicyear();
       return view('tdview.credential',compact('districts','academicyear'));  
        // return view('tdview.credential');
    }

    public function getDistrictwiseTCList($id)
    {
        $tccall=new training_centres();
        $tcinfo=$tccall->fetchDistrictwiseTc($id);
        return json_encode($tcinfo);
    }
    
    public function saveCredential(Request $req)
    {
        $usercall = new users();
        $info=$usercall->findId($req->username,$req->centreid);
        if(count($info)>0){
        $array = array("password"=>Hash::make($req->password)); 
        $updateinfo=$usercall->updateUser($req->username,$req->centreid,$array);
        }
        else{
        $userrole=new user_roles();
        $userinfo=$userrole->fetchUserId($req->type);
        $data = array("centre_id"=>$req->centreid,"user_id"=>$userinfo[0]->user_id,"district"=>$req->district,"username"=>$req->username,"password"=>Hash::make($req->password));        
        $user=$usercall->insertUser($data);
        }
        return view('pages.success',compact('user'));
    }

    public function showRoleview(){
        return view('tdview.rolecreation');
    }

    public function createRole(Request $req){
        $id = $req->input('roleid');
        $name = $req->input('rolename');
        $data = array("role_id"=>$id,"role_type"=>$name);
        $roleobj = new roles();
        $info = $roleobj->fetchRole($id);
        if(count($info)==0){
        $roleobj->insertRole($data);
        $info1 = $roleobj->fetchID($id,$name);
        $data1 = array("role_id"=>$id,"user_id"=>$info1[0]->id,"role_type"=>$name,"status"=>"active");
        $userroleobj = new user_roles();
        $userroleobj -> insertRole($data1);
        }        
        // return view('pages.success');
        Session::flash("success", "Created successfully!!");
        return Redirect::back();
    }
    public function showCentreType(){
        return view('tdview.centretype_creation');
    }
    public function createCentreType(Request $req){
        $name = $req->input('typename');
        $typecall=new types_of_centres();
        $data= array("types"=>$name);
        $typecall->insertCentreType($data);
        // return view('pages.success');
        Session::flash("success", "Created successfully!!");
        return Redirect::back();
    }
    public function showTrainingSubject(){
        $ayobj = new academicyear();
        $academicyear = $ayobj->fetchAcademicyear();
        return view('tdview.training_subject',compact('academicyear'));
    }
    public function createTrainingSubject(Request $req){
        $name = $req->input('subjectname');
        $fiscalyear = $req->input('fiscalyear');
        $candidate = $req->input('candidate');
        $typecall=new training_centre_subjects();
        $data= array("subjects"=>$name,"academic_year"=>$fiscalyear,"no_of_candidate"=>$candidate);
        $typecall->insertsubject($data);
        // return view('pages.success');
        Session::flash("success", "Created successfully!!");
        return Redirect::back();
    }

    public function saveBatchtarget(Request $req)
    {
        $data = array();
        $data['batchid'] = Input::get('batchid');
        $data['vfiscalyear'] = Input::get('vfiscalyear');
        $data['vtc'] = Input::get('vtc');
        $data['vbatch'] = Input::get('vbatch');
        $data['status'] = Input::get('status');
        $data['vdistrictcode'] = Input::get('vdistrictcode');

        $physical_targets= new physical_target();
        $data = $physical_targets->approvePhyTarget($data);
        return redirect()->back()->with('message', 'Success!!');
    }

    public function approvebatchexpense(Request $req)
    {
        $batchcall = new training_batches();
        $batchinfo=$batchcall->fetchCompletedBatchList(); 
        return view('tdview.appbatchexpense')->with(array('batchinfo'=>$batchinfo));
    }
 
 public function viewpftargetfetch(Request $req)
    {
        $tc = new training_centres();
        $tcs =  $tc->fetchtcforList();
        $ayobj = new academicyear();
        $academicyear = $ayobj->fetchAcademicyear();
        return view('tdview.approvepftarget',compact('tcs','academicyear'));
        // $tc = new training_centres();
        // $centreid = session()->get('centreid');
        // echo $centreid;
        // $tcname =  $tc->fetchTcSpecInfo($centreid);
        // $tcs =  $tc->fetchtcforList();
        // $tb = new training_batches();
        // $batches=$tb->fetchtrainingBatch($centreid);
        // return json_encode($batches);
        // return view('tcview.approvepftarget',compact('tcname','batches'));
    }
    public function viewgetBatchList($id,$year)
    {
        // $tb = new training_batches();
        // $batches = $tb->fetchtrainingBatch($id);
        // return json_encode($batches);
        // $tb = new financial_target();
        // $batches = $tb->fetchBatch($id);
        $batches = DB::table('training_batches')->join('financial_targets','training_batches.batch_id','=','financial_targets.batch_id')->where('training_batches.centre_id','=',$id)->where('financial_targets.status','=','Created')->
        where('training_batches.batch_academic_year','=',$year)->pluck('training_batches.batch_name','training_batches.batch_id');
        return json_encode($batches);
    } 
    public function viewgetBatchInfo($id)
    {
        // $info = DB::table('training_batches as b')->join('training_centres as t','t.centre_id','=','b.centre_id')->join('batches as ba','ba.batch_id','=','b.batch_id')->join('districts as d','d.district_code','=','t.district_id')->join('physical_targets as p','p.centre_id','=','b.centre_id')->join('financial_targets as f','f.centre_id','=','b.centre_id')->where('b.batch_id','=',$id)->select('ba.start_date','ba.end_date','b.batch_type','t.centre_type','d.district_name','d.district_code','d.division','p.general_male_target as genpm','p.general_female_target as genpf','p.general_total_target as genpt','p.tsp_male_target as tsppm','p.tsp_female_target as tsppf','p.tsp_total_target as tsppt','p.scp_male_target as scppm','p.scp_female_target as scppf','p.scp_total_target as scppt','p.min_male_target as minpm','p.min_female_target as minpf','p.min_total_target as minpt','f.general_male_target as genfm','f.general_female_target as genff','f.general_total_target as genft' ,'f.tsp_male_target as tspfm','f.tsp_female_target as tspff','f.tsp_total_target as tspft','f.scp_male_target as scpfm','f.scp_female_target as scpff','f.scp_total_target as scpft','f.min_male_target as minfm','f.min_female_target as minff','f.min_total_target as minft')->get();
        // return json_encode($info);  
        $pt=new physical_target();
        $ft=new financial_target();        
        // if(count($ptobj)==0){
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_academic_year','training_batches.centre_id','training_batches.batch_id','training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        // } 
        // echo $info[0]->district_code."  ".$info[0]->batch_academic_year."  ".$info[0]->centre_id."  ".$info[0]->batch_id."  ".$info[0]->batch_type;
        $ptobj = $pt->checkPhysicalTarget($info[0]->district_code,$info[0]->batch_academic_year,$info[0]->centre_id,$info[0]->batch_id,$info[0]->batch_type);
        $ftobj = $ft->checkFinancialTarget($info[0]->district_code,$info[0]->batch_academic_year,$info[0]->centre_id,$info[0]->batch_id,$info[0]->batch_type);
        // echo count($ptobj);
        if(count($ptobj)>0){
        $info = DB::table('training_batches as b')->join('training_centres as t','t.centre_id','=','b.centre_id')->join('batches as ba','ba.batch_id','=','b.batch_id')->join('districts as d','d.district_code','=','t.district_id')->join('physical_targets as p','p.centre_id','=','b.centre_id')->join('financial_targets as f','f.centre_id','=','b.centre_id')->where('f.batch_id','=',$id)->where('p.batch_id','=',$id)->where('b.batch_id','=',$id)->select('ba.start_date','ba.end_date','b.batch_type','t.centre_type','t.district_id','d.district_name','d.district_code','d.division','p.general_male_target as genpm','p.general_female_target as genpf','p.general_total_target as genpt','p.tsp_male_target as tsppm','p.tsp_female_target as tsppf','p.tsp_total_target as tsppt','p.scp_male_target as scppm','p.scp_female_target as scppf','p.scp_total_target as scppt','p.min_male_target as minpm','p.min_female_target as minpf','p.min_total_target as minpt','f.general_male_target as genfm','f.general_female_target as genff','f.general_total_target as genft' ,'f.tsp_male_target as tspfm','f.tsp_female_target as tspff','f.tsp_total_target as tspft','f.scp_male_target as scpfm','f.scp_female_target as scpff','f.scp_total_target as scpft','f.min_male_target as minfm','f.min_female_target as minff','f.min_total_target as minft')->get();
        }
        else{
            $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_academic_year','training_batches.centre_id','training_batches.batch_id','training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division','districts.district_code','training_centres.district_id')->get();
        }
        return json_encode($info);           
    }
    public function pftargetapproval(Request $req)
    {
        $physicalcall = new physical_target();
        $financialcall = new financial_target();
        $year = $req->input('vfiscalyear');
        $districtid = $req->input('vdistrictcode');
        $tc = $req->input('vtc');
        $batch = $req->input('vbatch');
        $type = $req->input('vtype');
        $status=$req->input('approvereject');
        // echo $status;
        $data = array('status' => $status , 'status_updated_date' => date('Y-m-d H:i:s'));
        $physicalcall->updateStatus($districtid,$year,$tc,$batch,$data);
        $financialcall->updateStatus($districtid,$year,$tc,$batch,$data);
        $message = $status."  Successfully!!";
        Session::flash("success", $message);
        return Redirect::back();
    } 
    public function approveemploymentExpense(){
        $info = DB::table('training_batches as t')->join('batch_employment_expenses as e','e.batch_id','=','t.batch_id')->join('training_centres as c','c.centre_id','=','t.centre_id')->where('t.employment_expense_status',null)->select('c.centre_id','c.centre_name','c.district','t.batch_id','t.batch_name','t.batch_type','t.action','e.expense')->get();
        return view('tdview.approveemploymentexpense')->with(array('info'=>$info));
    }
    public function approveExpense($batchid,$centreid)
    {  
       $tccall =new training_batches();
       $new_data =array('employment_expense_status'=>"Approved");
       $tc=$tccall->approveExpense($batchid,$centreid,$new_data);
       Session::flash("message", "Expense approved!!");
       return Redirect::back(); 
    }
    public function rejectExpense($batchid,$centreid)
    { 
        $tccall = new training_batches();
        $new_data = array('employment_expense_status'=>"Rejected");
        $tc = $tccall->rejectExpense($batchid,$centreid,$new_data);
        Session::flash("message", "Expense rejected!!");
        return Redirect::back();  
    }
    public function fetchDashboardInfo(Request $req)
    {         
        $now = new DateTime();
        $year1 = $now->format("Y");
        $year2 = (int)$year1+1;
        $year = $year1.'-'.$year2;

        $academicyear=academicyear::all();
        $tc=training_centres::where('academic_year',$year)->get();

        $tcapproved = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Approved')->count();
        $tcactive = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Approved')->count();
        $tcidle = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Created')->count();
        $tcdefunct = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Rejected')->count();

        $curryearbatch = DB::table('training_batches')->where('batch_academic_year',$year)->count();
        $curryearcandidate = DB::table('batch_candidates')->where('academic_year',$year)->count();
        $stipend = DB::table('training_batches')->where('batch_academic_year',$year)->sum('stipend');
        $rawmaterial = DB::table('training_batches')->where('batch_academic_year',$year)->sum('raw_material');
        $expense = DB::table('training_batches')->where('batch_academic_year',$year)->sum('inst_exp');
        $total = DB::table('training_batches')->where('batch_academic_year',$year)->sum('total_expense');
        $candidateplaced = DB::table('batch_candidates')->where('employment_status','Yes')->count();
        $placementexpense = DB::table('batch_employment_expenses')->where('academic_year',$year)->sum('expense');
        $trainingbacthes = DB::table('training_batches')->whereIn('action',  ['Start','Hold',''])->orWhereNull('action')->where('batch_academic_year',$year)->count();
        $trainingcandidates =  DB::select("SELECT count(candidate_id) as count FROM batch_candidates where batch_id not in(select batch_id from training_batches where action='Completed') and academic_year=?",[$year]);
        return view('reports.dashboard',compact('academicyear','tc'))->with('acyear',$year)->with('tcapproved',$tcapproved)->with('tcactive' , $tcactive)->with('tcidle' , $tcidle)->with('tcdefunct' , $tcdefunct)->with('curryearbatch' , $curryearbatch)->with('curryearcandidate' , $curryearcandidate)->with('stipend' , $stipend)->with('rawmaterial' , $rawmaterial)->with('expense' , $expense)->with('total' , $total)->with('candidateplaced' , $candidateplaced)->with('placementexpense' , $placementexpense)->with('trainingbacthes' , $trainingbacthes)->with('trainingcandidates',$trainingcandidates[0]->count);
    }
    public function fetchSpecDashboardInfo($tc,$fiscalyear)
    {
        $year = $fiscalyear;
        // $academicyear=academicyear::all();
        // $tc=training_centres::where('academic_year',$year)->get();

        if($tc=='all'){
        $tcapproved = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Approved')->count();
        $tcactive = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Approved')->count();
        $tcidle = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Created')->count();
        $tcdefunct = DB::table('training_centres')->where('academic_year',$year)->where('centre_status','Rejected')->count();

        $curryearbatch = DB::table('training_batches')->where('batch_academic_year',$year)->count();
        $curryearcandidate = DB::table('batch_candidates')->where('academic_year',$year)->count();
        $stipend = DB::table('training_batches')->where('batch_academic_year',$year)->sum('stipend');
        $rawmaterial = DB::table('training_batches')->where('batch_academic_year',$year)->sum('raw_material');
        $expense = DB::table('training_batches')->where('batch_academic_year',$year)->sum('inst_exp');
        $total = DB::table('training_batches')->where('batch_academic_year',$year)->sum('total_expense');
        $candidateplaced = DB::table('batch_candidates')->where('employment_status','Yes')->count();
        $placementexpense = DB::table('batch_employment_expenses')->where('academic_year',$year)->sum('expense');
        $trainingbacthes = DB::table('training_batches')->whereIn('action',  ['Start','Hold',''])->orWhereNull('action')->where('batch_academic_year',$year)->count();
        $trainingcandidates =  DB::select("SELECT count(candidate_id) as count FROM batch_candidates where batch_id not in(select batch_id from training_batches where action='Completed') and academic_year =?",[$year]);
        $info = array('tcapproved'=>$tcapproved , 'tcactive'=>$tcactive, 'tcidle'=>$tcidle ,
            'tcdefunct'=>$tcdefunct , 'curryearbatch'=>$curryearbatch , 'curryearcandidate'=>$curryearcandidate , 'stipend'=>$stipend , 'rawmaterial'=>$rawmaterial , 'expense'=>$expense ,
            'total'=>$total , 'candidateplaced'=>$candidateplaced , 'placementexpense'=>$placementexpense , 
            'trainingbacthes'=>$trainingbacthes , 'trainingcandidates'=>$trainingcandidates[0]->count
            );
        }
        else{       

        $tcapproved = DB::table('training_centres')->where('centre_id',$tc)->where('academic_year',$year)->where('centre_status','Approved')->count();
        $tcactive = DB::table('training_centres')->where('centre_id',$tc)->where('academic_year',$year)->where('centre_status','Approved')->count();
        $tcidle = DB::table('training_centres')->where('centre_id',$tc)->where('academic_year',$year)->where('centre_status','Created')->count();
        $tcdefunct = DB::table('training_centres')->where('centre_id',$tc)->where('academic_year',$year)->where('centre_status','Rejected')->count();

        $curryearbatch = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->count();
        $curryearcandidate = DB::table('batch_candidates')->where('centre_id',$tc)->where('academic_year',$year)->count();
        $stipend = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('stipend');
        $rawmaterial = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('raw_material');
        $expense = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('inst_exp');
        $total = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('total_expense');
        $candidateplaced = DB::table('batch_candidates')->where('centre_id',$tc)->where('employment_status','Yes')->count();
        $placementexpense = DB::table('batch_employment_expenses')->where('centre_id',$tc)->where('academic_year',$year)->sum('expense');
        $trainingbacthes = DB::table('training_batches')->whereIn('action',  ['Start','Hold',''])->orWhereNull('action')->where('centre_id',$tc)->where('batch_academic_year',$year)->count();
        $trainingcandidates =  DB::select("SELECT count(candidate_id) as count FROM batch_candidates where batch_id not in(select batch_id from training_batches where action='Completed') and centre_id=? and academic_year= ?",[$tc,$year]);

        $info = array('tcapproved'=>$tcapproved , 'tcactive'=>$tcactive, 'tcidle'=>$tcidle ,
            'tcdefunct'=>$tcdefunct , 'curryearbatch'=>$curryearbatch , 'curryearcandidate'=>$curryearcandidate , 'stipend'=>$stipend , 'rawmaterial'=>$rawmaterial , 'expense'=>$expense ,
            'total'=>$total , 'candidateplaced'=>$candidateplaced , 'placementexpense'=>$placementexpense , 
            'trainingbacthes'=>$trainingbacthes , 'trainingcandidates'=>$trainingcandidates[0]->count
            );
        }
        return json_encode([$info]);        
    }
}
