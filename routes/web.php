<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function()
{
    return View::make('pages.login');
});

Route::get('about', function()
{
    return View::make('pages.about');
});
Route::get('projects', function()
{
    return View::make('pages.projects');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});
Route::get('tdhome', function()
{
    return View::make('pages.tdhome');
});
Route::get('tchome', function()
{
    return View::make('pages.tchome');
});
Route::get('/logout', 'loginController@logout');

Auth::routes();
Route::get('/pftarget/ajax/{id}','TcController@getBatchList');
Route::get('/pftarget/batchajax/{id}','TcController@getBatchInfo');
Route::get('/pftarget', 'TcController@pftargetfetch');
Route::post('/pftargetapproval', 'TcController@pftargetapproval');
Route::post('insertpftarget', 'TcController@insertpf');
Route::get('/batchexpense', 'TcController@batchexpenseview');
Route::get('/employementexpense', 'TcController@getemploymentExpense');
Route::post('/employementexpense', 'TcController@postemploymentExpense');
Route::get('/getcandidates/{id}', 'TcController@getBatchCandidates');


// Route::get('/employementexpense', 'TcController@employmentExpense');

Route::post('batchexpensetotal/{id}', 'TcController@insertbatchexpense');

Route::get('/viewpftarget', 'TcController@viewpftargetfetch');
Route::get('/viewpftarget/ajax/{id}','TcController@viewgetBatchList');
Route::get('/viewpftarget/batchajax/{id}','TcController@viewgetBatchInfo');

Route::get('/approvepftarget', 'TdController@viewpftargetfetch');
Route::get('/approvepftarget/ajax/{id}/{year}','TdController@viewgetBatchList');
Route::get('/approvepftarget/batchajax/{id}','TdController@viewgetBatchInfo');
Route::post('/pftargetapproval', 'TdController@pftargetapproval');

Route::get('/training_center_form','TdController@tcform');
Route::post('/training_center_form','TdController@insert');

Route::get('viewtc','TdController@fetchtclist');
Route::get('/batchcreate', 'TcController@batch');
Route::get('/batchcreate/{type}', 'TcController@batchstrength');
Route::post('/batchcreate', 'TcController@batchinsert');

Route::get('/approvebatch', 'TdController@fetchbatchlist');
Route::post('/approvebatch/{id}','TdController@approveBatch');
Route::post('/rejectbatch/{id}','TdController@rejectBatch');
Route::get('/approvetargets','TdController@approveBatchtarget');
Route::post('/approvetargets','TdController@saveBatchtarget');
Route::get('/approvebatchexpense','TdController@approvebatchexpense');

Route::get('/batchlist', 'TdController@fetchbatchlistview');
Route::get('/batch/{batchid}', 'TcController@editbatchlist');
Route::post('/batchAction/{batchid}/{action}', 'TcController@editBatchAction');

Route::post('/updatebatchinfo', 'TcController@batchupdate');
Route::post('/deletebatchlist/{batchid}', 'TcController@deletebatchlist');
Route::post('/deletetcview/{centreid}', 'TdController@deletetcview');

Route::post('/viewtcedit/{centreid}','TdController@show');
Route::post('/viewtcupdate','TdController@updatetc');

Route::get('/approvetcview', 'TdController@fetchTrainingCentreList');
Route::post('/approvetcview/{id}','TdController@fetchTrainingCentreList');
Route::post('/approvetc/{id}','TdController@Approvetc');
Route::post('/rejecttc/{id}','TdController@rejectTc');
Route::get('/credential','TdController@credentialCreation');
Route::get('/fetchdistrictwisetc/ajax/{id}','TdController@getDistrictwiseTCList');
Route::post('/fetchdistrictwisetc','TdController@saveCredential');

Route::get('/role', 'TdController@showRoleview');
Route::post('/createRole', 'TdController@createRole');
Route::get('/centretype', 'TdController@showCentreType');
Route::post('/createcentretype', 'TdController@createCentreType');
Route::get('/subject', 'TdController@showTrainingSubject');
Route::post('/createsubject', 'TdController@createTrainingSubject');

Route::get('/candidateupload', 'TcController@candidateUpload');
Route::get('/candidatemapping', 'TcController@candidateMappingView');
Route::get('/candidate/ajax/{id}','TcController@getTrainingSubject');
Route::get('/candidate/batchajax/{id}','TcController@getSubjectBatch');
Route::post('/batchcandidatemapping', 'TcController@batchCandidateMapping');

Route::get('/candidatelist', 'TcController@candidateListView');
// Route::get('/candidatelist', 'TcController@candidateInfo');
Route::get('/candidatelist/ajax/{id}/{year}','TcController@getTrainingSubjectList');
Route::get('/candidatelist/batchajax/{id}','TcController@getSubjectBatchList');
// Route::post('/batchcandidatedelete/{candidateid}/{batchid}', 'TcController@batchCandidateDelete');

Route::post('/importExcel/{id}', 'TcController@importExcel');


Route::get('/employmentexpense', 'TcController@employmentexpensefetch');
Route::get('/employmentexpense/ajax/{id}','TcController@employmentexpenseBatchList');
Route::get('/employmentexpense/batchajax/{id}','TcController@employmentexpenseBatchInfo');

Route::post('/employmentexpenseupdate','TcController@employmentexpenseUpdate');

Route::get('/approveemploymentexpense','TdController@approveemploymentExpense');

Route::post('/approveexpense/{batchid}/{centreid}','TdController@approveExpense');
Route::post('/rejectexpense/{batchid}/{centreid}','TdController@rejectExpense');


Route::post('/uploadcandidatephoto/{candidateid}/{batchid}','TcController@uploadPhoto');

Route::get('/candidatelistinfo','TcController@candidateInfo');

Route::get('/dcdashboard','TdController@fetchDCDashboardInfo');

Route::get('/dashboard','TdController@fetchDashboardInfo');
Route::get('/dashboard/{tc}/{fiscalyear}','TdController@fetchSpecDashboardInfo');
Route::get('/tcdashboard','TcController@fetchTcDashboardInfo');

Route::post('/candidatePhoto','TcController@candidatePhoto');
Route::post('/batchcandidatedelete/{cid}/{bcid}', 'TcController@batchCandidateDelete');

Route::get('/printcertification','TdController@printCertification');

Route::get('/pfreport','TdController@pfreportInfo');
Route::get('/pfreport/{tc}/{fiscalyear}','TdController@specpfReport');
Route::get('/tcpfreport','TcController@pftargetreportfetch');

Route::get('/pfreport', 'TdController@pfreportfetch');
Route::get('/pfreport/ajax/{id}/{year}','TdController@pfreportviewgetBatchList');
Route::get('/pfreport/batchajax/{id}','TdController@pfreportviewgetBatchInfo');
Route::get('/pftargetreport/{batch}/{tc}/{year}','TdController@pftargetReport');

Route::get('/certificateupload', 'TcController@certificateuploadView');
Route::get('/certificateupload/ajax/{id}/{year}','TcController@certificateuploadTrainingSubjectList');
Route::get('/certificateupload/batchajax/{id}','TcController@certificateuploadSubjectBatchList');
Route::post('/candidateCertificate','TcController@candidatecertificate');
Route::get('/certificatedownload/{candidateid}/{batchid}', 'TcController@certificatedownloadView');
Route::post('updateAttendance', 'TcController@updateAttendance');


// Get Taluks list
Route::get('weavers/get_talukas/{id}', 'WeaverController@getTaluk');
// Power subsidy public
Route::get('weavers/powersubsidy-apply', 'WeaverController@psNewForm');
Route::post('weavers/powersubsidy-apply', 'WeaverController@psApplyForm');
// Electronic jaqpublic
Route::get('weavers/ej-2loom-apply', 'WeaverController@ejTlNewForm');
Route::post('weavers/ej-2loom-apply', 'WeaverController@ejTlApply');

// Power subsidy private
Route::get('weavers/powersubsidy-list', 'WeaverController@psList');
Route::get('weavers/powersubsidy-app/details/{id}', 'WeaverController@psDetails');
Route::get('weavers/powersubsidy-getfile/{type}/{id}', 'WeaverController@psGetfile');
Route::get('weavers/powersubsidy-adminaction/{action}/{id}', 'WeaverController@psAdminaction');
Route::get('weavers/powersubsidy-getzip/{id}', 'WeaverController@psGetzip');
Route::get('weavers/powersubsidy-ack', 'WeaverController@psShowAck');

// Electronic jaq private
Route::get('weavers/ej-2loom-list', 'WeaverController@ejTlList');
Route::get('weavers/ej-2loom-app/details/{id}', 'WeaverController@ejTlDetails');
Route::get('weavers/ej-2loom-getfile/{type}/{id}', 'WeaverController@ejTlGetfile');
Route::get('weavers/ej-2loom-adminaction/{action}/{id}', 'WeaverController@ejTlAdminaction');
Route::get('weavers/ej-2loom-getzip/{id}', 'WeaverController@ejTlGetzip');
Route::get('weavers/ej-2loom-ack', 'WeaverController@ejShowAck');

// weaver investment form
Route::post('weavers/invest-apply', 'WeaverController@investApply');
Route::get('weavers/invest-apply', function()
{
    return View::make('weavers.invest_apply');
});
Route::get('weavers/invest-list','WeaverController@investList');

Route::get('home','DCController@home');
Route::post('/olddata','TcController@olddata');
Route::get('downloadfile','TcController@downloadfile');

