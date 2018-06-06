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
Route::get('home', function()
{
    return View::make('pages.home');
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
Route::post('/login', 'loginController@login');
Route::get('/logout', 'loginController@logout');
Route::get('/login', function()
{
   return View::make('pages.login');
});

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
Route::post('/batch/{batchid}', 'TcController@editbatchlist');
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
Route::get('/candidatelist/ajax/{id}/{year}','TcController@getTrainingSubjectList');
Route::get('/candidatelist/batchajax/{id}','TcController@getSubjectBatchList');
Route::post('/batchcandidatedelete/{candidateid}/{batchid}', 'TcController@batchCandidateDelete');

Route::post('/importExcel/{id}', 'TcController@importExcel');

// Power subsidy
Route::get('weavers/powersubsidy-apply', 'WeaverController@psNewForm');
Route::post('weavers/powersubsidy-apply', 'WeaverController@psApplyForm');
// Electronic jaq
Route::get('weavers/ej-2loom-apply', 'WeaverController@ejTlNewForm');
Route::post('weavers/ej-2loom-apply', 'WeaverController@ejTlApply');


Route::get('/employmentexpense', 'TcController@employmentexpensefetch');
Route::get('/employmentexpense/ajax/{id}','TcController@employmentexpenseBatchList');
Route::get('/employmentexpense/batchajax/{id}','TcController@employmentexpenseBatchInfo');

Route::post('/employmentexpenseupdate','TcController@employmentexpenseUpdate');

Route::get('/approveemploymentexpense','TdController@approveemploymentExpense');

Route::post('/approveexpense/{batchid}/{centreid}','TdController@approveExpense');
Route::post('/rejectexpense/{batchid}/{centreid}','TdController@rejectExpense');


Route::post('/uploadcandidatephoto/{candidateid}/{batchid}','TcController@uploadPhoto');

Route::get('/candidatelistinfo','TcController@candidateInfo');

Route::get('/dashboard','TdController@fetchDashboardInfo');
Route::get('/dashboard/{tc}/{fiscalyear}','TdController@fetchSpecDashboardInfo');
Route::get('/tcdashboard','TcController@fetchTcDashboardInfo');

Route::get('/printcertification','TdController@printCertification');

// Power subsidy private
Route::get('weavers/powersubsidy-list', 'WeaverController@psList');
Route::get('weavers/powersubsidy-app/details/{id}', 'WeaverController@psDetails');
Route::get('weavers/powersubsidy-getfile/{type}/{id}', 'WeaverController@psGetfile');
Route::get('weavers/powersubsidy-adminaction/{action}/{id}', 'WeaverController@psAdminaction');
Route::get('weavers/powersubsidy-getzip/{id}', 'WeaverController@psGetzip');// Electronic jaq private
Route::get('weavers/ej-2loom-list', 'WeaverController@ejTlList');
Route::get('weavers/ej-2loom-app/details/{id}', 'WeaverController@ejTlDetails');
Route::get('weavers/ej-2loom-getfile/{type}/{id}', 'WeaverController@ejTlGetfile');
Route::get('weavers/ej-2loom-adminaction/{action}/{id}', 'WeaverController@ejTlAdminaction');
Route::get('weavers/ej-2loom-getzip/{id}', 'WeaverController@ejTlGetzip');
// weaver investment form
Route::post('weavers/invest-apply', 'WeaverController@investApply');
Route::get('weavers/invest-apply', function()
{
   return View::make('weavers.invest_apply');
});
Route::get('weavers/invest-list','WeaverController@investList');




