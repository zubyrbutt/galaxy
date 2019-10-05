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

Route::post('login','API\PassportController@login');


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\PassportController@profileinfo');
    Route::post('addycclead', 'YccleadController@addycclead');
});
//Fetch attendance
Route::post('getatt','UserController@getatt');

//Store leave from CCMS
//Route::post('leave','LeaveController@storeleaveapi');
