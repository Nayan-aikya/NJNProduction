<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;

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
use App\old_records;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Excel;
use DateTime;
use Hash;

class TcController extends Controller
{

    public function olddata()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();

        

        $users = new users();
        $oldrecords = new old_records();
        $seqcall = new sequences();
        $dist = new districts();
        //echo "<pre>";print_r($data);die;
        $i=0;
        foreach ($data as $key => $input) {
        $cin = $oldrecords->where('center_name',$input['tc_name'])->value('center_id');
        if(empty($cin)) {

            $district_code = $dist->pluckDistrictCode($input['district_id']);
            $division = districts::where('district_code',$district_code)->value('division');
        
            $seqinfo = $seqcall->fetchSequence();
            $centre_id=$seqinfo[0]->centre_id;
            if($centre_id<10)
                $centre_id="0".$centre_id;
            $centre_prefix=$seqinfo[0]->centre_prefix;
            $centre_code=$district_code.$centre_prefix.$centre_id;
            $username=$district_code.$centre_id;
            $password = Hash::make('123');
            $newcentre_id=$centre_id+1;

            $newid = array('centre_id'=>$newcentre_id);
            $seqcall->updateSequence($newid);

            $data = array('district' => $input['district_id'],'division' => $division,'username' => $username,'password' => $password,'centre_id' => $centre_code,'user_id' => 2);
                $users->create($data); 
        }
        else{
            $centre_code = $cin;
        }

            
            $tdata = array('district' => $input['district_id'],'center_name' => $input['tc_name'],'center_id' => $centre_code, 'batch_name' => $input['batch_name'],'batch_start_date' => $input['batch_start'],'batch_end_date' => $input['batch_end'],'candidate_name' => $input['candidate_name'],'wage_emp' => $input['wage_emp'],'industry' =>$input['industry'],'loan' => $input['loan'],'others' => $input['others'],'self_emp' => $input['self_emp'],'financial_yr' => $input['financial_yr']);
             $oldrecords->insert($tdata);
             $i++;
        }

        }

        return $i;

    }  
public function getolddata()
    {  
        return view('tcview.olddataimport');
    }
     
    public function batch()
    {        
        $tcobj = new training_centre_subjects();
        $trainingtype=$tcobj->fetchSubject();
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        $data['tc'] = $tc = Auth::user()->centre_id;
        $tcc_c = new training_centres();
        $tcname = $tcc_c->fetchTcName($tc);
        return view('tcview.batchcreate',compact('trainingtype','academicyear','tcname'));
    }
    public function batchstrength($type)
    {
        $tcobj=new training_centre_subjects();
        $info = $tcobj -> fetchspecSubject($type);
        return json_encode($info);
    }
    public function batchinsert(Request $obj)
    {
        $input = request()->validate([

                'batchname' => 'required',

                'startdate' => 'required|before:enddate',

                'enddate' => 'required',

                'noofstud' => 'required|numeric|min:1'

            ], [

                'batchname.required' => 'Batch Name is required',

                'startdate.required' => 'Start Date is required',

                'enddate.required' => 'End Date is required',

                'noofstud.required' => 'No. of students is required',

                'noofstud.min' => 'No. of students should be greater then 0'

            ]);

        $input = request()->all();
        $centreid=Auth::user()->centre_id;

        $districtcall=new districts();
        $district = Auth::user()->district;
        $district_code = $districtcall->pluckDistrictCode($district);

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
        $bat->academic_year=$input['fiscalyear'];
        $bat->batch_id=$batch_code;
        $bat->district_id=$district_code;
        $bat->batch_name=$input['batchname'];
        $bat->training_type=$input['trainingtype'];
        $bat->no_of_stud=$input['noofstud'];
        $bat->start_date=$input['startdate'];
        $bat->end_date=$input['enddate'];
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
         $input = request()->validate([

                'batchname' => 'required',

                'startdate' => 'required|before:enddate',

                'enddate' => 'required',

                'noofstud' => 'required|numeric|min:1'

            ], [

                'batchname.required' => 'Batch Name is required',

                'startdate.required' => 'Start Date is required',

                'enddate.required' => 'End Date is required',

                'noofstud.required' => 'No. of students is required',

                'noofstud.min' => 'No. of students should be greater then 0'

            ]);

        $input = request()->all();
        $new_batch_data = array('batch_name'=>$req->input('batchname'),'training_type'=>$req->input('trainingtype'),'start_date'=>$req->input('startdate'),'end_date'=>$req->input('enddate'),'no_of_stud'=>$req->input('noofstud'),'status' => 'Pending');
        $batchid = $req->input('batchid');

        $batch=new batches();
        $batch->updateBatch($new_batch_data,$batchid);
        Session::flash("success", "Batch Updated Successfully!!");
            return Redirect::back();
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
        $centreid = Auth::user()->centre_id;
        $district = Auth::user()->district;
        $division = Auth::user()->division;
        // echo $centreid;
        $tcname =  $tc->fetchTcSpecInfo($centreid);
        // $tcs =  $tc->fetchtcforList();
        // $tb = new training_batches();
        // $batches=$tb->fetchtrainingBatch($centreid);
        // return json_encode($batches);
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        return view('tcview.pftarget',compact('tcname','academicyear','district','division'));
    }
    public function getBatchList($id)
    {
        $centreid = Auth::user()->centre_id;
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
        $info = DB::table('training_batches as b')->join('training_centres as t','t.centre_id','=','b.centre_id')->join('batches as ba','ba.batch_id','=','b.batch_id')->join('districts as d','d.district_code','=','t.district_id')->join('physical_targets as p','p.centre_id','=','b.centre_id')->join('financial_targets as f','f.centre_id','=','b.centre_id')->where('f.batch_id','=',$id)->where('p.batch_id','=',$id)->where('b.batch_id','=',$id)->select('ba.no_of_stud','ba.start_date','ba.end_date','b.batch_type','t.centre_type','t.district_id','d.district_name','d.district_code','d.division','p.general_male_target as genpm','p.general_female_target as genpf','p.general_total_target as genpt','p.tsp_male_target as tsppm','p.tsp_female_target as tsppf','p.tsp_total_target as tsppt','p.scp_male_target as scppm','p.scp_female_target as scppf','p.scp_total_target as scppt','p.min_male_target as minpm','p.min_female_target as minpf','p.min_total_target as minpt','f.general_male_target as genfm','f.general_female_target as genff','f.general_total_target as genft' ,'f.tsp_male_target as tspfm','f.tsp_female_target as tspff','f.tsp_total_target as tspft','f.scp_male_target as scpfm','f.scp_female_target as scpff','f.scp_total_target as scpft','f.min_male_target as minfm','f.min_female_target as minff','f.min_total_target as minft','p.status as status')->get();
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
        $centreid = Auth::user()->centre_id;
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
        $centreid = Auth::user()->centre_id;
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
        $batchcandidate = Input::get('batchcandidate');

        $items = $req->validate([
          'totpt'=> 'required|numeric|min:1|max:{{$batchcandidate}}',
          'totft'=> 'required|numeric|min:1'

        ], [


            'totpt.required' => 'Total Physical target is required',
            'totpt.min' => 'Total Physical target should be greater than 1 less or equal to {{ $batchcandidate }}',


            'totft.required' => 'Total financial target is required',
            'totft.min' => 'Total financial target is required'

            ]);

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
        $updatedata1 = array("district_id"=>$districtid,"financial_year"=>$year,"centre_id"=>$tc,"batch_id"=>$batch,"general_male_target"=>$genpm,"general_female_target"=>$genpf,"general_total_target"=>$genpt,"tsp_male_target"=>$tsppm,"tsp_female_target"=>$tsppf,"tsp_total_target"=>$tsppt,"scp_male_target"=>$scppm,"scp_female_target"=>$scppf,"scp_total_target"=>$scppt,"min_male_target"=>$minpm,"min_female_target"=>$minpf,"min_total_target"=>$minpt,"status"=>"Created");
        $updatedata2 = array("district_id"=>$districtid,"financial_year"=>$year,"centre_id"=>$tc,"batch_id"=>$batch,"general_male_target"=>$genfm,"general_female_target"=>$genff,"general_total_target"=>$genft,"tsp_male_target"=>$tspfm,"tsp_female_target"=>$tspff,"tsp_total_target"=>$tspft,"scp_male_target"=>$scpfm,"scp_female_target"=>$scpff,"scp_total_target"=>$scpft,"min_male_target"=>$minfm,"min_female_target"=>$minff,"min_total_target"=>$minft,"status"=>"Created");


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
        $centreid = Auth::user()->centre_id;
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
        $centreid = Auth::user()->centre_id;
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
        $centreid = Auth::user()->centre_id;
        $tbcall = new training_batches();
        session()->put('batchtype',$id);
        $info=$tbcall->fetchTypeBatch($centreid,$id,$year);
        return json_encode($info);    
    }
    public function getSubjectBatchList($id){
        session()->put('batchid',$id);
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->select('training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        $centreid = Auth::user()->centre_id;
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
   
    public function batchCandidateDelete($candidateid,$batchid){
        $id = $candidateid;
        $centreid = Auth::user()->centre_id;
        // $type = session()->get('batchtype');
        // $batchid = session()->get('batchid');
        $bccall = new batch_candidates();
        $candidatecall = new candidates();
        $bccall->where('candidate_id',$candidateid)->delete();
        $candidatecall->where('candidate_id',$candidateid)->delete();
        Session::flash("success", "Removed successfully!!");
        return Redirect::back();
              
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
        $batch_id=$batchres[0]->batch_id;
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
                $seqcall = new sequences();
                $batchobj = new training_batches();
                    $batchinfo = $batchobj->fetchBatchSpecInfo($id);

                    $centreid = $batchinfo[0]->centre_id;
                    $type = $batchinfo[0]->batch_type;
                    $batchid = $batchinfo[0]->batch_id;
                    $academicyear = $batchinfo[0]->batch_academic_year;
                    
                    $bccall = new batch_candidates();
                    $candidatecall = new candidates();

                foreach ($data as $key => $value) {

                        $uniCandid = $candidatecall->getUniqueCandidate($value->aadhar_no);
                        if(empty($uniCandid)){
                          $seqinfo = $seqcall->fetchSequence();
                            $cand_id=$seqinfo[0]->cand_id;
                            if($cand_id<10)
                                $cand_id="000".$cand_id;
                            if($cand_id<100 && $cand_id>10)
                                $cand_id="00".$cand_id;
                            if($cand_id<1000 && $cand_id>100)
                                $cand_id="0".$cand_id;


                            $cand_prefix=$seqinfo[0]->cand_prefix;
                            $candid_code=$cand_prefix.$batch_id.$cand_id;
                            $newcand_id=$cand_id+1;

                            $newid = array('cand_id'=>$newcand_id);
                            $seqcall->updateSequence($newid);  
                        }
                        else{
                            $candid_code = $uniCandid;
                        }


                    $insert[] = ['candidate_id' => $candid_code, 'first_name' => $value->first_name,'last_name' => $value->last_name,'phone_no' => $value->phone_no,'email' => $value->email,'dob' => $value->dob,'aadhar_no' => $value->aadhar_no,'gender' => $value->gender,'marital_status' => $value->marital_status,'religion' => $value->religion,'category' => $value->category,'relationship' => $value->relationship,'relation_firstname' => $value->relation_firstname,'relation_lastname' => $value->relation_lastname,'permanent_location' => $value->permanent_location,'permanent_street' => $value->permanent_street,'permanent_city' => $value->permanent_city,'permanent_state' => $value->permanent_state,'permanent_district' => $value->permanent_district,'permanent_taluk' => $value->permanent_taluk,'permanent_village' => $value->permanent_village,'permanent_pincode' => $value->permanent_pincode,'education' => $value->education,'physically_challenged' => $value->physically_challenged,'skill' => $value->skill,'status' => 'Mapped'
                ];
                   $candidateinsert[] = ['candidate_id' => $candid_code,'centre_id' => $centreid ,'batch_type' => $type ,'batch_id' => $batchid , 'academic_year' => $academicyear]; 
                }

                if(!empty($insert)){
                    // echo ''.json_encode($insert);
                    $candidateobj = new candidates();
                    $candidateobj->createCandidate($insert);

                    $info = $bccall -> createbatchCandidate($candidateinsert);    
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
    public function getemploymentExpense()
    {
        $tcs = DB::table("training_centres")->pluck("centre_name","centre_id");
        $tc = new training_centres();
        $centreid = Auth::user()->centre_id;
        // echo $centreid;
        $tcname =  $tc->fetchTcSpecInfo($centreid);
        // $tcs =  $tc->fetchtcforList();
        $candidatecall = new candidates();
        $candidatelist = $candidatecall->fetchCandidateList();
        $tb = new training_batches();
        $batches=$tb->fetchtrainingBatch($centreid);
        return view('tcview.employment_expense',compact('tcs','tcname','batches','candidatelist'));
        

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
    public function postemploymentExpense()
    {
         Session::flash("success", "Uploaded successfully!!");
                    return Redirect::back();
    }


    public function employmentexpensefetch(Request $req)
    {
        $input = Input::all();
        $data['tc'] = Auth::user()->centre_id;
            $data['acyear'] = "";
            $data['batchid'] = "";
        if(!empty($input)){
           $data['batchid'] = $input['vbatch'];
            $data['acyear'] = $input['vfiscalyear'];
        }
        $batchcall = new training_batches();
        $data['batchlist'] = $batchcall->fetchcompletedtrainingBatch($data['tc'],$data['acyear']);

        $bccall = new batch_candidates();
        $data['candidate'] = $bccall->batchCandidate($data['batchid']);

        $data['candidate'] = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->where('batch_candidates.batch_id','=', $data['batchid'])->select('batch_candidates.candidate_id','batch_candidates.batch_type','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill')->get();

        $tc = new training_centres();
        $data['tcs'] =  $tc->fetchTcName($data['tc']);
        $ayobj = new academicyear();
        $data['academicyear'] = $ayobj->fetchAcademicyear();
        $expensecall = new batch_employment_expense();
        $data['employmentdata'] = $expensecall->checkExpense($data['acyear'],$data['tc'],$data['batchid']);

        return view('tcview.employment_expense')->with('data',$data);
    }
    public function employmentexpenseBatchList($id)
    {
        $centreid = Auth::user()->centre_id;
        $tb = new training_batches();
        $batches=$tb->fetchcompletedtrainingBatch($centreid,$id);
        return json_encode($batches);
    } 
    public function employmentexpenseBatchInfo($id){
        session()->put('batchid',$id);
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_batches.batch_id','=',$id)->where('training_batches.action','=',"Completed")->select('training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        $centreid = Auth::user()->centre_id;
        $type = session()->get('batchtype');

        $candidatecall = new candidates();
        $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->where('batch_candidates.batch_id','=',$id)->select('batch_candidates.candidate_id','batch_candidates.batch_type','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill')->get();
        $info[0]->candidate = $candidate;
        return json_encode($info);
    }   
    public function employmentexpenseUpdate(Request $req){
        $input = Input::all();
        //echo "<pre>";print_r($input);die;
        $candidatearr = $input['cand_id'];
        // echo $candidatearr;
        $indus_type = $input['indus_type'];
        for($i=0;$i<count($candidatearr);$i++)
        {
        

        $industry = $indus_type[$i];
        $candidateid = $candidatearr[$i];
        $k = 'employ'.$i;
        $status = $input[$k];

        $tc = $input['tcid'];
        $batch = $input['baid'];


        $batchcandidatecall = new batch_candidates();
        $batchcandidatecall->employmentstatusUpdate($tc,$batch,$candidateid,$industry,$status);
        }

        
        $expense = $input['batch_expense'];
        $fiscalyear = $input['acyear'];
        $status = "Created";
        $data = array('centre_id' => $input['tcid'],'batch_id' => $batch,'expense' => $expense,'status' => $status,'academic_year' =>  $fiscalyear,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s'));
        $expensecall = new batch_employment_expense();

        $expinfo = $expensecall -> checkExpense($fiscalyear,$tc,$batch);

        if(count($expinfo)>0){
        $expdata = array('expense' => $expense,'status' => "Created");
        $expensecall -> updateExpense($fiscalyear,$tc,$batch,$expdata);
        }
        else
        {
        $expensecall -> insertExpense($data);
        }
        Session::flash("success", "Successfully Updated!!");
        return redirect::back();

    }

    
    public function candidateInfo(Request $req)
    {
        $centreid = Auth::user()->centre_id;
        $batchid = "";
        $batches = new training_batches();
        if(Input::get('batchid'))
            $batchid = Input::get('batchid');

        $batchlist = $batches->fetchtrainingBatchs($centreid);
        if(!empty($batchid)){
            $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->join('training_batches','training_batches.batch_id','batch_candidates.batch_id')->where('batch_candidates.centre_id','=',$centreid)->where('batch_candidates.batch_id','=',$batchid)->select('batch_candidates.candidate_id','batch_candidates.batch_type','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill','training_batches.batch_id','training_batches.batch_name','training_batches.action','candidates.attendence','candidates.photo')->paginate(10);
        }
        else{
            $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->join('training_batches','training_batches.batch_id','batch_candidates.batch_id')->where('batch_candidates.centre_id','=',$centreid)->select('batch_candidates.candidate_id','batch_candidates.batch_type','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill','training_batches.batch_id','training_batches.batch_name','training_batches.action','candidates.attendence','candidates.photo')->paginate(10);
        }
        
        return view('tcview.candidate',compact('candidate','batchlist','batchid'));   
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
        $year = NULL;
        if(!empty(Input::get('fiscalyear'))){
            $year = Input::get('fiscalyear');

        }
        if($year == NULL){
            $now = new DateTime();
            $year1 = $now->format("Y");
            $year2 = (int)$year1+1;
            $year = $year1.'-'.$year2;
        }

        $data['tc'] = $tc = Auth::user()->centre_id;
        $tcc_c = new training_centres();
        $data['tcname'] = $tcc_c->fetchTcName($tc);
        $data['acyear'] = $year;
        $date = date('Y-m-d H:i:s');
        $data['academicyear']=$academicyear=academicyear::all();

        $data['info'] = DB::table('training_batches')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->where('training_batches.centre_id',$tc)->where('training_batches.batch_academic_year',$year)->select('training_batches.batch_id','training_batches.batch_name','training_batches.status','training_centres.centre_name','batches.start_date','batches.end_date','batches.no_of_stud','training_batches.action')->get();
      
        $data['status']=$tcactive = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->value('status');
       

        $data['nobatch'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->count();
        $data['nocandidate'] = DB::table('batch_candidates')->where('centre_id',$tc)->where('academic_year',$year)->count();

        $data['stipend'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('stipend');

        $data['inst_exp'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('inst_exp');

        $data['rawmaterial'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('raw_material');

        
        $data['total_exp'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('total_expense');

        $data['candidateplaced'] = DB::table('batch_candidates')->where('centre_id',$tc)->where('academic_year',$year)->where('employment_status','Yes')->count();

        $data['placementexpense'] = DB::table('batch_employment_expenses')->where('centre_id',$tc)->where('academic_year',$year)->sum('expense');

        $data['activebatch'] = DB::table('training_batches')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->where('training_batches.centre_id',$tc)->where('training_batches.batch_academic_year',$year)->where('training_batches.action',"Start")->get();

        $data['nactivebatch'] = DB::table('training_batches')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->where('training_batches.centre_id',$tc)->where('training_batches.batch_academic_year',$year)->where('batches.start_date','<',$date)->where('training_batches.action',NULL)->get();
            
        $data['idlebatch'] = DB::table('training_batches')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->where('training_batches.centre_id',$tc)->where('training_batches.batch_academic_year',$year)->where('batches.start_date','>',$date)->get();

        $data['completed'] = DB::table('training_batches')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->where('training_batches.centre_id',$tc)->where('training_batches.batch_academic_year',$year)->where('training_batches.action','=','Completed')->get();

        
        return view('reports.tcdashboard')->with('data',$data);
    }
    public function candidatePhoto(Request $req)
    {
        // $file = Input::file('file');
        $file = $req->file('file');
        $candidateid = $req->input('candidateid');
        $batchid = $req->input('batchid');
        // echo $candidateid."  ".$batchid."  ".$file;
        $filename = $candidateid. '-' .time(). '.' .$req->file('file')->getClientOriginalExtension();
        $file = $file->move(public_path().'/uploads/', $filename);
        $candidatecall = new candidates();
        $candidatecall -> uploadImage($candidateid,$batchid,$filename);
        Session::flash("success", "Successfully uploaded!!");
        return view('pages.message');
        // return Redirect::back();
    } 

    public function tcpfreportInfo(){
        $tc = Auth::user()->centre_id;
        $now = new DateTime();
        $year1 = $now->format("Y");
        $year2 = (int)$year1+1;
        $year = $year1.'-'.$year2;

        $academicyear=academicyear::all();
        $info = DB::table('training_batches as t')->join('training_centres as c','c.centre_id','=','t.centre_id')->where('t.batch_academic_year',$year)->where('t.centre_id',$tc)->select('c.centre_id','c.centre_name','c.district','t.batch_id','t.batch_name','t.batch_type')->get();

        $physicalinfo = DB::table('physical_targets as p')->where('financial_year',$year)->where('p.centre_id',$tc)->select('p.centre_id','p.batch_id', DB::raw('sum(general_male_target+tsp_male_target+scp_male_target+min_male_target) as phy_male'),DB::raw('sum(general_female_target+tsp_female_target+scp_female_target+min_female_target) as phy_female'),DB::raw('sum(general_total_target+tsp_total_target+scp_total_target+min_total_target) as phy_total'))->groupBy('p.centre_id','p.batch_id')->get();
        $financialinfo = DB::table('financial_targets as p')->where('financial_year',$year)->where('p.centre_id',$tc)->select('p.centre_id','p.batch_id', DB::raw('sum(general_male_target+tsp_male_target+scp_male_target+min_male_target) as fin_male'),DB::raw('sum(general_female_target+tsp_female_target+scp_female_target+min_female_target) as fin_female'),DB::raw('sum(general_total_target+tsp_total_target+scp_total_target+min_total_target) as fin_total'))->groupBy('p.centre_id','p.batch_id')->get();

        foreach ($physicalinfo as $p) {
            foreach ($financialinfo as $f) {
                if(($p->centre_id==$f->centre_id)&&($p->batch_id==$f->batch_id)){
                    $p->fin_male=$f->fin_male;
                    $p->fin_female=$f->fin_female;
                    $p->fin_total=$f->fin_total;
                }
            }
        }
        if($year == NULL){
            $now = new DateTime();
            $year1 = $now->format("Y");
            $year2 = (int)$year1+1;
            $year = $year1.'-'.$year2;
        }

        $data['tc'] = $tc = Auth::user()->centre_id;
        $data['acyear'] = $year;

        $data['academicyear']=$academicyear=academicyear::all();

        $data['info'] = DB::table('training_batches')->join('batches','batches.batch_id','=','training_batches.batch_id')->where('training_batches.centre_id',$tc)->where('training_batches.batch_academic_year',$year)->select('training_batches.batch_id','training_batches.batch_name','training_batches.status','batches.start_date','batches.end_date','batches.no_of_stud','training_batches.action')->get();
      
        $data['status']=$tcactive = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->value('status');
       

        $data['nobatch'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->count();
        $data['nocandidate'] = DB::table('batch_candidates')->where('centre_id',$tc)->where('academic_year',$year)->count();

        $data['stipend'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('stipend');

        $data['inst_exp'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('inst_exp');

        $data['rawmaterial'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('raw_material');

        
        $data['total_exp'] = DB::table('training_batches')->where('centre_id',$tc)->where('batch_academic_year',$year)->sum('total_expense');

        $data['candidateplaced'] = DB::table('batch_candidates')->where('centre_id',$tc)->where('academic_year',$year)->where('employment_status','Yes')->count();

        $data['placementexpense'] = DB::table('batch_employment_expenses')->where('centre_id',$tc)->where('academic_year',$year)->sum('expense');

        
        return view('reports.tcdashboard')->with('data',$data);
    }
   

   public function pftargetreportfetch(Request $req)
    {
        $tc = new training_centres();
        $centreid = Auth::user()->centre_id;
        $tcname =  $tc->fetchTcSpecInfo($centreid);
        $ayobj = new academicyear();
        $academicyear = $ayobj -> fetchAcademicyear();
        return view('reports.tcpfreport',compact('tcname','academicyear'));
    }

    public function certificateuploadView(){
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
        return view('tcview.certificateupload',compact('tbinfo','academicyear'));
    }

    public function certificateuploadTrainingSubjectList($id,$year){
        $centreid = Auth::user()->centre_id;
        $tbcall = new training_batches();
        session()->put('batchtype',$id);
        $info=$tbcall->fetchTypeBatch($centreid,$id,$year);
        return json_encode($info);    
    }
   
    public function certificateuploadSubjectBatchList($id){
        session()->put('batchid',$id);
        $centreid = Auth::user()->centre_id;
        $info = DB::table('training_batches')->join('training_centres','training_centres.centre_id','=','training_batches.centre_id')->join('batches','batches.batch_id','=','training_batches.batch_id')->join('districts','districts.district_code','=','training_centres.district_id')->where('training_centres.centre_id','=',$centreid)->where('training_batches.centre_id','=',$centreid)->where('training_batches.batch_id','=',$id)->where('batches.batch_id','=',$id)->select('training_batches.batch_type','training_centres.centre_type','batches.start_date','batches.end_date','districts.district_name','districts.division',
            'districts.district_code')->get();
        $centreid = Auth::user()->centre_id;
        $type = session()->get('batchtype');
        $candidate = DB::table('candidates')->join('batch_candidates','batch_candidates.candidate_id','=','candidates.candidate_id')->where('batch_candidates.centre_id','=',$centreid)->where('batch_candidates.batch_id','=',$id)->where('batch_candidates.employment_status','=','Yes')->select('batch_candidates.centre_id','batch_candidates.employment_status','batch_candidates.candidate_id','candidates.first_name','candidates.last_name','candidates.gender','candidates.category','candidates.education','candidates.skill')->get();
        $info[0]->candidate = $candidate;
        return json_encode($info);
    }
    public function candidateCertificate(Request $req)
    {
        $file = $req->file('file');
        $candidateid = $req->input('candidateid');
        $batchid = $req->input('batchid');
        // echo $candidateid."  ".$batchid."  ".$file;
        $filename = $candidateid. '-' .time(). '.' .$req->file('file')->getClientOriginalExtension();
        $file = $file->move(public_path().'/certificate/', $filename);
        $candidatecall = new batch_candidates();
        $candidatecall -> uploadImage($candidateid,$batchid,$filename);
        Session::flash("success", "Successfully uploaded!!");
        return view('pages.message');
    } 
    public function certificatedownloadView($candidateid,$batchid){
        $candidatecall = new batch_candidates();
        $info = $candidatecall->viewFile($candidateid,$batchid);
        $file_name = $info[0]->certificate;
        // echo $file_name;
        // $file_path = public_path('certificate/'.$file_name);
        $file_path = 'certificate/'.$file_name;
        // return json_encode([$file_path]);
        return json_encode([$file_path]);
        // return response()->download($file_path);
    }

    public function  updateAttendance()
    {
        $input = Input::All();
        $candidatecall = new candidates();
        $candidatecall -> uploadAttendence($input['canid'],$input['attendence']);
        Session::flash("success", "Successfully updated!!");
        return Redirect::back();
        
    }

    public function  downloadfile()
    {
      $fileName = basename('candidate_sample.csv');
        $filePath = 'uploads/'.$fileName;
        if(!empty($fileName) && file_exists($filePath)){
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            
            // Read the file
            readfile($filePath);
            exit;
        }else{
            return 'The file does not exist.';
        }
        
    }

    public function  oldreport()
    {
        //,compact('tbinfo','academicyear')
        return view('tcview.oldreport');
    }
    
    
}
