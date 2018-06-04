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
class TcController extends Controller
{
    public function batch()
    {        
        $tcobj = new training_centre_subjects();
        $trainingtype=$tcobj->fetchSubject();
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        return view('tcview.batchcreate',compact('trainingtype','academicyear'));
    }
    public function batchstrength($type)
    {
        $tcobj=new training_centre_subjects();
        $info = $tcobj -> fetchspecSubject($type);
        return json_encode($info);
    }
    public function batchinsert(Request $obj)
    {
        $username=session()->get('username');
        $password=session()->get('password');
        
        $usercall= new users();
        $info = $usercall->fetchUserInfo($username);
        $district=$info[0]->district;
        $centreid=$info[0]->centre_id;

        $districtcall=new districts();
        $districtinfo = $districtcall->fetchDivisionInfo($district);
        $district_code= $districtinfo[0]->district_code;

        $seqcall = new sequences();
        $seqinfo = $seqcall->fetchSequence();      
        $batch_id=$seqinfo[0]->batch_id;
        if($batch_id<10)
            $batch_id="0".$batch_id;
        $batch_prefix=$seqinfo[0]->batch_prefix;
        $batch_code=$district_code.$batch_prefix.$batch_id;
        $newbatch_id=$batch_id+1;

        $newid = array('batch_id'=>$newbatch_id);
        $seqcall->updateSequence($newid);
        
        $bat =new batches;
        $bat->academic_year=$obj->fiscalyear;
        $bat->batch_id=$batch_code;
        $bat->district_id=$district_code;
        $bat->batch_name=$obj->batchname;
        $bat->training_type=$obj->trainingtype;
        $bat->no_of_stud=$obj->noofstud;
        $bat->start_date=$obj->startdate;
        $bat->end_date=$obj->enddate;
        $bat->status="Pending";
        $bat->centre_id=$centreid;
        $bat->save();
        if ($bat->save()) {
            // return view('pages.success');
            Session::flash("success", "Batch created successfully!!");
            return Redirect::back();
        }
        else
        {
            // echo"insertion failed";
            Session::flash("success", "Batch creation failed!!");
            return Redirect::back();
        }
    }
    public function editbatchlist($batchid)
    {  
        $batchcall=new batches();        
        $batchinfo = $batchcall->fetchBatchSpecInfo($batchid);
        $start = strtotime($batchinfo[0]->start_date);
        $startdate = date('Y-m-d',$start);
        $end = strtotime($batchinfo[0]->end_date);
        $enddate = date('Y-m-d',$end);
        return view('tcview.editbatchlist',compact('batchinfo'),['startdate'=>$startdate,'enddate'=>$enddate]);
    }
     public function batchupdate(Request $req)
    { 
        $new_batch_data = array('batch_name'=>$req->input('batchname'),'training_type'=>$req->input('trainingtype'),'start_date'=>$req->input('startdate'),'end_date'=>$req->input('enddate'),'no_of_stud'=>$req->input('noofstud'));
        $batchid = $req->input('batchid');

        $batch=new batches();
        $batch->updateBatch($new_batch_data,$batchid);
        return view('pages.success');  
        // Session::flash("success", "Batch updated successfully!!");
        // return Redirect::back();
    }
     public function editBatchAction($batchid,$action)
    { 
        $batch=new training_batches();
        $batch->editBatchAction($batchid,$action);
        return redirect()->back()->with('message', 'Success!!');
    }

    public function deletebatchlist($batchid)
    { 
        $batch=new batches();
        $batch->deleteBatch($batchid);
        // return view('pages.success'); 
        Session::flash("success", "Batch deleted successfully!!");
        return Redirect::back();
    }

    public function pftargetfetch(Request $req)
    {
        $tc = new training_centres();
        $centreid = session()->get('centreid');
        // echo $centreid;
        $tcname =  $tc->fetchTcSpecInfo($centreid);
        // $tcs =  $tc->fetchtcforList();
        // $tb = new training_batches();
        // $batches=$tb->fetchtrainingBatch($centreid);
        // return json_encode($batches);
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        return view('tcview.pftarget',compact('tcname','academicyear'));
    }
    public function getBatchList($id)
    {
        $centreid = session()->get('centreid');
        $tb = new training_batches();
        $batches=$tb->fetchtrainingspecBatch($centreid,$id);
        return json_encode($batches);
    } 
    public function getBatchInfo($id)
    {
        $pt=new physical_target();
        $ft=new financial_target();        
        // if(count($ptobj)==0){
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_academic_year','training_batches.centre_id','training_batches.batch_id','training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','batches.no_of_stud','districts.district_name','districts.division',
            'districts.district_code')->get();
        // } 
        // echo $info[0]->district_code."  ".$info[0]->batch_academic_year."  ".$info[0]->centre_id."  ".$info[0]->batch_id."  ".$info[0]->batch_type;
        $tcsobj = new training_centre_subjects();
        $subjectinfo = $tcsobj->fetchspecSubject($info[0]->batch_type);        

        $ptobj = $pt->checkPhysicalTarget($info[0]->district_code,$info[0]->batch_academic_year,$info[0]->centre_id,$info[0]->batch_id,$info[0]->batch_type);
        $ftobj = $ft->checkFinancialTarget($info[0]->district_code,$info[0]->batch_academic_year,$info[0]->centre_id,$info[0]->batch_id,$info[0]->batch_type);
        // echo count($ptobj);
        if(count($ptobj)>0){
        $info = DB::table('training_batches as b')->join('training_centres as t','t.centre_id','=','b.centre_id')->join('batches as ba','ba.batch_id','=','b.batch_id')->join('districts as d','d.district_code','=','t.district_id')->join('physical_targets as p','p.centre_id','=','b.centre_id')->join('financial_targets as f','f.centre_id','=','b.centre_id')->where('f.batch_id','=',$id)->where('p.batch_id','=',$id)->where('b.batch_id','=',$id)->select('ba.no_of_stud','ba.start_date','ba.end_date','b.batch_type','t.centre_type','t.district_id','d.district_name','d.district_code','d.division','p.general_male_target as genpm','p.general_female_target as genpf','p.general_total_target as genpt','p.tsp_male_target as tsppm','p.tsp_female_target as tsppf','p.tsp_total_target as tsppt','p.scp_male_target as scppm','p.scp_female_target as scppf','p.scp_total_target as scppt','p.min_male_target as minpm','p.min_female_target as minpf','p.min_total_target as minpt','f.general_male_target as genfm','f.general_female_target as genff','f.general_total_target as genft' ,'f.tsp_male_target as tspfm','f.tsp_female_target as tspff','f.tsp_total_target as tspft','f.scp_male_target as scpfm','f.scp_female_target as scpff','f.scp_total_target as scpft','f.min_male_target as minfm','f.min_female_target as minff','f.min_total_target as minft')->get();
        }
        else{
            $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_academic_year','training_batches.centre_id','training_batches.batch_id','training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','batches.no_of_stud','districts.district_name','districts.division','districts.district_code','training_centres.district_id')->get();
        }
        $info[0]->candidate_count = $subjectinfo[0]->no_of_candidate;
        return json_encode($info);          
    }  


     public function viewpftargetfetch(Request $req)
    {
        // $tc = new training_centres();
        // $tcs =  $tc->fetchtcforList();
        // return view('tcview.viewpftarget',compact('tcs'));
        $tc = new training_centres();
        $centreid = session()->get('centreid');
        // echo $centreid;
        $tcname =  $tc->fetchTcSpecInfo($centreid);
        // $tcs =  $tc->fetchtcforList();
            // $tb = new training_batches();
            // $batches=$tb->fetchtrainingBatch($centreid);
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        // return json_encode($batches);
        return view('tcview.viewpftarget',compact('tcname','academicyear'));
    }
    public function viewgetBatchList($id)
    {
        $centreid = session()->get('centreid');
        $tb = new training_batches();
        // $batches=$tb->fetchtrainingBatch($id);
        $batches=$tb->fetchtrainingspecBatch($centreid,$id);
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

     public function insertpf(Request $req)
    {
        $districtid = $req->input('districtcode');
        $year = $req->input('fiscalyear');
        $tc = $req->input('tc');
        $batch = $req->input('batch');
        $type = $req->input('type');
        $genpm = $req->input('genpm');
        $genpf = $req->input('genpf');
        $genpt = $req->input('genpt');
        $tsppm = $req->input('tsppm');
        $tsppf = $req->input('tsppf');
        $tsppt = $req->input('tsppt');
        $scppm = $req->input('scppm');
        $scppf = $req->input('scppf');
        $scppt = $req->input('scppt');
        $minpm = $req->input('minpm');
        $minpf = $req->input('minpf');
        $minpt = $req->input('minpt');

        $genfm = $req->input('genfm');
        $genff = $req->input('genff');
        $genft = $req->input('genft');
        $tspfm = $req->input('tspfm');
        $tspff = $req->input('tspff');
        $tspft = $req->input('tspft');
        $scpfm = $req->input('scpfm');
        $scpff = $req->input('scpff');
        $scpft = $req->input('scpft');
        $minfm = $req->input('minfm');
        $minff = $req->input('minff');
        $minft = $req->input('minft');
        
        $data1 = array("district_id"=>$districtid,"financial_year"=>$year,"centre_id"=>$tc,"batch_id"=>$batch,"general_male_target"=>$genpm,"general_female_target"=>$genpf,"general_total_target"=>$genpt,"tsp_male_target"=>$tsppm,"tsp_female_target"=>$tsppf,"tsp_total_target"=>$tsppt,"scp_male_target"=>$scppm,"scp_female_target"=>$scppf,"scp_total_target"=>$scppt,"min_male_target"=>$minpm,"min_female_target"=>$minpf,"min_total_target"=>$minpt,"status"=>"Created");
        $data2 = array("district_id"=>$districtid,"financial_year"=>$year,"centre_id"=>$tc,"batch_id"=>$batch,"general_male_target"=>$genfm,"general_female_target"=>$genff,"general_total_target"=>$genft,"tsp_male_target"=>$tspfm,"tsp_female_target"=>$tspff,"tsp_total_target"=>$tspft,"scp_male_target"=>$scpfm,"scp_female_target"=>$scpff,"scp_total_target"=>$scpft,"min_male_target"=>$minfm,"min_female_target"=>$minff,"min_total_target"=>$minft,"status"=>"Created");
        $updatedata1 = array("district_id"=>$districtid,"financial_year"=>$year,"centre_id"=>$tc,"batch_id"=>$batch,"general_male_target"=>$genpm,"general_female_target"=>$genpf,"general_total_target"=>$genpt,"tsp_male_target"=>$tsppm,"tsp_female_target"=>$tsppf,"tsp_total_target"=>$tsppt,"scp_male_target"=>$scppm,"scp_female_target"=>$scppf,"scp_total_target"=>$scppt,"min_male_target"=>$minpm,"min_female_target"=>$minpf,"min_total_target"=>$minpt);
        $updatedata2 = array("district_id"=>$districtid,"financial_year"=>$year,"centre_id"=>$tc,"batch_id"=>$batch,"general_male_target"=>$genfm,"general_female_target"=>$genff,"general_total_target"=>$genft,"tsp_male_target"=>$tspfm,"tsp_female_target"=>$tspff,"tsp_total_target"=>$tspft,"scp_male_target"=>$scpfm,"scp_female_target"=>$scpff,"scp_total_target"=>$scpft,"min_male_target"=>$minfm,"min_female_target"=>$minff,"min_total_target"=>$minft);


        $pt=new physical_target();
        $ft=new financial_target();

        // echo $districtid."  ".$year."  ".$tc."  ".$batch."  ".$type;

        $ptobj = $pt->checkPhysicalTarget($districtid,$year,$tc,$batch,$type);
        $ftobj = $ft->checkFinancialTarget($districtid,$year,$tc,$batch,$type);
        // echo count($ptobj);
        if(count($ptobj)>0){
        $pt -> updatePhysicalTarget($districtid,$year,$tc,$batch,$type,$updatedata1);   
        }
        else{
        $pt->insertPhysicalTarget($data1);
        }
        if(count($ftobj)>0){
        $ft -> updateFinancialTarget($districtid,$year,$tc,$batch,$type,$updatedata2);   
        }
        else{
        $ft->insertFinancialTarget($data2);
        }      
        // return view('pages.success');
        if(count($ptobj)>0){
        Session::flash("success", "Updated successfully!!");
        return Redirect::back();
        }
        else{
        Session::flash("success", "Added successfully!!");
        return Redirect::back();
        }
    }

    public function candidateMappingView(){
        $username = session()->get('username');
        $password = session()->get('password');
        // echo $username."   ".$password;
        $usercall = new users();
        $info=$usercall->fetchTrainingCentreId($username,$password);
        // echo "string".$info[0]->centre_id;
        session()->put('centreid',$info[0]->centre_id);
        $tbcall = new training_batches();
        $tbinfo = $tbcall->fetchtrainingType($info[0]->centre_id);
        return view('tcview.candidatemapping',compact('tbinfo'));
    }
    public function getTrainingSubject($id){
        $centreid = session()->get('centreid');
        $tbcall = new training_batches();
        session()->put('batchtype',$id);
        $info=$tbcall->fetchTypeBatch($centreid,$id);
        return json_encode($info);    
    }
    public function getSubjectBatch($id){
        session()->put('batchid',$id);
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        $type = session()->get('batchtype');
        $candidatecall = new candidates();
        $candidate = $candidatecall->fetchCandidate();
        $info[0]->candidate = $candidate;
        return json_encode($info);
        // return json_encode(['info' =>  $info,'candidate' => $candidate]);    
    }
    public function batchCandidateMapping(Request $req){
        $id = $req->candidateid;
        $centreid = session()->get('centreid');
        $type = session()->get('batchtype');
        $batchid = session()->get('batchid');
        $bccall = new batch_candidates();
        $candidatecall = new candidates();
        $candidateinfo = $bccall -> checkCandidate($id);
        if(count($candidateinfo)==0){
        $data1 = array('status' => 'Mapped' );       
        $data = array('candidate_id' => $id , 'centre_id' => $centreid ,'batch_type' => $type ,'batch_id' => $batchid );
        $info = $bccall -> createbatchCandidate($data);    
        $updateinfo = $candidatecall -> updateCandidateStatus($id,$data1);    
        return json_encode($info);
        }        
    }

    public function getTrainingSubjectList($id,$year){
        $centreid = session()->get('centreid');
        $tbcall = new training_batches();
        session()->put('batchtype',$id);
        $info=$tbcall->fetchTypeBatch($centreid,$id,$year);
        return json_encode($info);    
    }
    public function getSubjectBatchList($id){
        session()->put('batchid',$id);
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        $centreid = session()->get('centreid');
        $type = session()->get('batchtype');
        // $candidatecall = new candidates();
        // $candidate = $candidatecall->fetchCandidateMappedList($centreid,$id,$type);
        $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->where('batch_candidates.batch_id','=',$id)->select('batch_candidates.candidate_id','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill')->get();
        $info[0]->candidate = $candidate;
        return json_encode($info);
        // return json_encode(['info' =>  $info,'candidate' => $candidate]);    
    }

    public function candidateListView(){
        $username = session()->get('username');
        $password = session()->get('password');
        // echo $username."   ".$password;
        $usercall = new users();
        $info=$usercall->fetchTrainingCentreId($username,$password);
        // echo "string".$info[0]->centre_id;
        session()->put('centreid',$info[0]->centre_id);
        $tbcall = new training_batches();
        $tbinfo = $tbcall->fetchtrainingType($info[0]->centre_id);
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        return view('tcview.batchcandidate_list',compact('tbinfo','academicyear'));
    }
   
    public function batchCandidateDelete(Request $req,$candidateid,$batchid){
        $id = $candidateid;
        $centreid = session()->get('centreid');
        // $type = session()->get('batchtype');
        // $batchid = session()->get('batchid');
        $bccall = new batch_candidates();
        $candidatecall = new candidates();
        $candidateinfo = $bccall -> checkCandidate($id);
        if(count($candidateinfo)>0){
        $data1 = array('status' => 'Created' );       
        $data = array('candidate_id' => $id , 'centre_id' => $centreid ,'batch_id' => $batchid );
        $info = $bccall -> deletebatchCandidate($data);    
         $updateinfo = $candidatecall -> updateCandidateStatus($id,$data1);    
        // return json_encode($info);
         Session::flash("success", "Removed successfully!!");
         return Redirect::back();
        }        
    }

    public function candidateUpload(){
        return view('tcview.candidateupload');
    }

    public function importExcel($id)
    {
        // echo $id;
        $batchcall = new batches();
        $batchres = $batchcall -> fetchBatchSpecInfo($id);
        $noofcandidate=$batchres[0]->no_of_stud;
        $status=$batchres[0]->status;
        if($status=="Approved"){
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            // echo $data->count()."  ".$noofcandidate;
            // echo $data->count()>$noofcandidate;
            if($data->count()>$noofcandidate){
                // echo "success";
                Session::flash("fail", "You can't upload more than batch size!!");
                return Redirect::back();
            }
            else{
                // echo "fail";
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['serial_no' => $value->serial_no,'candidate_id' => $value->serial_no, 'first_name' => $value->first_name,'last_name' => $value->last_name,'phone_no' => $value->phone_no,'email' => $value->email,'dob' => $value->dob,'aadhar_no' => $value->aadhar_no,'gender' => $value->gender,'marital_status' => $value->marital_status,'religion' => $value->religion,'category' => $value->category,'relationship' => $value->relationship,'relation_firstname' => $value->relation_firstname,'relation_lastname' => $value->relation_lastname,'current_location' => $value->current_location,'current_street' => $value->current_street,'current_city' => $value->current_city,'current_state' => $value->current_state,'current_district' => $value->current_district,'current_taluk' => $value->current_taluk,'current_village' => $value->current_village,'current_pincode' => $value->current_pincode,'permanent_location' => $value->permanent_location,'permanent_street' => $value->permanent_street,'permanent_city' => $value->permanent_city,'permanent_state' => $value->permanent_state,'permanent_district' => $value->permanent_district,'permanent_taluk' => $value->permanent_taluk,'permanent_village' => $value->permanent_village,'permanent_pincode' => $value->permanent_pincode,'education' => $value->education,'subject' => $value->subject,'yearofpassing' => $value->yearofpassing,'physically_challenged' => $value->physically_challenged,'skill' => $value->skill,'apprentiseship' => $value->apprentiseship,'perviously_employed' => $value->perviously_employed,'willing_migrate' => $value->willing_migrate,'expected_salary_outside' => $value->expected_salary_outside,'expected_salary_within' => $value->expected_salary_within,'preferred_training_period' => $value->preferred_training_period,'status' => $value->status
                ];
                }
                if(!empty($insert)){
                    // echo ''.json_encode($insert);
                    $candidateobj = new candidates();
                    $candidateobj->createCandidate($insert);

                    $batchobj = new training_batches();
                    $batchinfo = $batchobj->fetchBatchSpecInfo($id);

                    $centreid = $batchinfo[0]->centre_id;
                    $type = $batchinfo[0]->batch_type;
                    $batchid = $batchinfo[0]->batch_id;
                    $academicyear = $batchinfo[0]->batch_academic_year;
                    
                    $bccall = new batch_candidates();
                    $candidatecall = new candidates();

                    foreach ($data as $key => $value) {
                      $candidateinsert[] = ['candidate_id' => $value->serial_no,'centre_id' => $centreid ,'batch_type' => $type ,'batch_id' => $batchid , 'academic_year' => $academicyear];                        
                    }

                    // $candidateinfo = $bccall -> checkCandidate($id);
                    // if(count($candidateinfo)==0){
                    // $data1 = array('status' => 'Mapped' );       
                    // $data = array('candidate_id' => $id , 'centre_id' => $centreid ,'batch_type' => $type ,'batch_id' => $batchid );
                    $info = $bccall -> createbatchCandidate($candidateinsert);    
                    // $updateinfo = $candidatecall -> updateCandidateStatus($id,$data1);    
                    // }
                    foreach ($data as $key => $value) {
                        $data1 = array('status' => 'Mapped' ); 
                        $updateinfo = $candidatecall -> updateCandidateStatus($value->serial_no,$data1);    
                    }
                    // return view('pages.success');
                    Session::flash("success", "Uploaded successfully!!");
                    return Redirect::back();
                }
            }
        }

        }

        }
        else{
            Session::flash("fail", "Can't upload candidates before batch approval!!");
            return Redirect::back();
        }
        // return view('pages.success');
    }

    public function batchexpenseview(Request $obj)
    {
        $batchcall = new training_batches();
        $batchinfo=$batchcall->fetchCompletedBatchList(); 
        return view('tcview.viewbatchlistexpense')->with(array('batchinfo'=>$batchinfo));
    }

    public function insertbatchexpense(Request $obj)
    {
        $data = array();
        $data['stipend'] = Input::get('stipend');
        $data['raw_material'] = Input::get('raw_material');
        $data['inst_exp'] = Input::get('inst_exp');
        $data['total_expense'] = Input::get('total');
        $data['id'] = Input::get('id');

        $batchcall = new training_batches();
        $batchinfo=$batchcall->updateBatchExpense($data);

        return redirect()->back()->with('message', 'Success!!');
    }
    public function employmentExpense()
    {
        $tcs = DB::table("training_centres")->pluck("centre_name","centre_id");
        return view('tcview.employment_expense',compact('tcs'));
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
        $message = $status."successfully!!";
        Session::flash("success", $message);
        return Redirect::back();
    }

    public function employmentexpensefetch(Request $req)
    {
        $tc = new training_centres();
        $centreid = session()->get('centreid');
        $tcname =  $tc->fetchTcSpecInfo($centreid);
        // $tb = new training_batches();
        // $batches=$tb->fetchtrainingBatch($centreid);
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        return view('tcview.employment_expense',compact('tcname','batches','academicyear'));
    }
    public function employmentexpenseBatchList($id)
    {
        $centreid = session()->get('centreid');
        $tb = new training_batches();
        $batches=$tb->fetchcompletedtrainingBatch($centreid,$id);
        return json_encode($batches);
    } 
    public function employmentexpenseBatchInfo($id){
        session()->put('batchid',$id);
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        $centreid = session()->get('centreid');
        $type = session()->get('batchtype');

        $candidatecall = new candidates();
        $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->where('batch_candidates.batch_id','=',$id)->select('batch_candidates.candidate_id','batch_candidates.batch_type','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill')->get();
        $info[0]->candidate = $candidate;
        return json_encode($info);
    }   
    public function employmentexpenseUpdate(Request $req){
        $candidatearr = $req->input('candidatearr');
        // echo $candidatearr;
        for($i=0;$i<count($candidatearr);$i++)
        {
        echo $candidatearr[$i]['candidateid']."  ".$candidatearr[$i]['status']."  ".$candidatearr[$i]['industry'];
        $industry = $candidatearr[$i]['industry'];
        $status = $candidatearr[$i]['status'];
        $candidateid = $candidatearr[$i]['candidateid'];
        $tc = $candidatearr[$i]['tc'];
        $batch = $candidatearr[$i]['batch'];
        $batchcandidatecall = new batch_candidates();
        $batchcandidatecall->employmentstatusUpdate($tc,$batch,$candidateid,$industry,$status);
        }

        $tc = $req->input('tc');
        $batch = $req->input('batch');
        $fiscalyear = $req->input('fiscalyear');
        $expense = $req->input('expense');
        $type = $req->input('type');
        $status = "Created";
        $data = array('centre_id' => $tc,'batch_id' => $batch,'expense' => $expense,'batch_type' => $type,'status' => $status,'academic_year' => $fiscalyear );
        $expensecall = new batch_employment_expense();
        $expinfo = $expensecall -> checkExpense($fiscalyear,$tc,$batch,$type);
        if(count($expinfo)>0){
        $expdata = array('expense' => $expense);
        $expensecall -> updateExpense($fiscalyear,$tc,$batch,$type,$expdata);
        }
        else
        {
        $expensecall -> insertExpense($expense);
        }
        Session::flash("success", "Successfully updated!!");
        return Redirect::back();
    }
    
    public function candidateInfo(Request $req)
    {
        $centreid = session()->get('centreid');
        $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->join('batches','batches.batch_id','batch_candidates.batch_id')->where('batch_candidates.centre_id','=',$centreid)->select('batch_candidates.candidate_id','batch_candidates.batch_type','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill','batches.batch_id','batches.batch_name')->get();
        return view('tcview.candidate',compact('candidate'));   
    }
    public function uploadPhoto(Request $req,$candidateid,$batchid)
    {
        $file = Input::file('photo');
        $filename = $candidateid. '-' .time();
        $file = $file->move(public_path().'/uploads/', $filename);
        $candidatecall = new candidates();
        $candidatecall -> uploadImage($candidateid,$batchid,$filename);
        Session::flash("success", "Successfully uploaded!!");
        return Redirect::back();
    } 
    public function fetchTcDashboardInfo(){
        $tc = session()->get('centreid');
        $now = new DateTime();
        $year1 = $now->format("Y");
        $year2 = (int)$year1+1;
        $year = $year1.'-'.$year2;

        $academicyear=academicyear::all();
        // $tc=training_centres::where('academic_year',$year)->get();

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

        return view('reports.tcdashboard',compact('academicyear'))->with('tc',$tc)->with('acyear',$year)->with('tcapproved',$tcapproved)->with('tcactive' , $tcactive)->with('tcidle' , $tcidle)->with('tcdefunct' , $tcdefunct)->with('curryearbatch' , $curryearbatch)->with('curryearcandidate' , $curryearcandidate)->with('stipend' , $stipend)->with('rawmaterial' , $rawmaterial)->with('expense' , $expense)->with('total' , $total)->with('candidateplaced' , $candidateplaced)->with('placementexpense' , $placementexpense)->with('trainingbacthes' , $trainingbacthes)->with('trainingcandidates',$trainingcandidates[0]->count);
    }
   
}
