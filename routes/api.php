<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/create/user', 'ApiController@save_community_data');

Route::get('/email/verify/user/{email}', 'ApiController@verify_community_user');

Route::get('/update/password/{email}/{password}', 'ApiController@change_community_password');

Route::post('/update/profile/{email}', 'ApiController@update_community_profile');

Route::get('/bazaar/search', 'ApiController@search');
