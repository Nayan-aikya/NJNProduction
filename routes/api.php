<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('weaverinspector/login', 'Auth\LoginController@login');
Route::post('weaverinspector/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('weaverinspector/showall', 'WeaverInspector@showLeads');
    Route::get('weaverinspector/show', 'WeaverInspector@showOneLead');
    Route::put('weaverinspector/update', 'WeaverInspector@update');
});