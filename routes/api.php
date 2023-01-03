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


Route::group([
    'middleware' => 'api.token',
    'prefix' => 'common',
], function () {
 
    Route::get('/api_news','ApiController@api_news');
 
});



Route::post('/api_register_user','ApiController@api_register_user');
Route::post('/api_login_user','ApiController@api_login_user');

Route::post('/api_add_product_user','ApiController@api_add_product_user');
Route::post('/api_delete_product_user','ApiController@api_delete_product_user');

