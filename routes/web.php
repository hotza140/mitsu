<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


Route::post('/login_backend',[App\Http\Controllers\BackendController::class,'login_backend']);

Route::group(['middleware' => ['auth']],function(){

    Route::get('/',[App\Http\Controllers\BackendController::class,'welcome']);
Route::get('/backend',[App\Http\Controllers\BackendController::class,'welcome']);

Route::post('/open_close',[App\Http\Controllers\BackendController::class,'open_close']);

    //banner
Route::get('/backend/banner',[App\Http\Controllers\BackendController::class,'banner']);
Route::get('/backend/banner_destroy/{id}',[App\Http\Controllers\BackendController::class,'banner_destroy']);
Route::get('/backend/banner_add',[App\Http\Controllers\BackendController::class,'banner_add']);
Route::post('/backend/banner_store',[App\Http\Controllers\BackendController::class,'banner_store']);
Route::get('/backend/banner_edit/{id}',[App\Http\Controllers\BackendController::class,'banner_edit']);
Route::post('/backend/banner_update/{id}',[App\Http\Controllers\BackendController::class,'banner_update']);
//banner

//admin_user
Route::get('/backend/admin_user',[App\Http\Controllers\BackendController::class,'admin_user']);
Route::get('/backend/admin_user_destroy/{id}',[App\Http\Controllers\BackendController::class,'admin_user_destroy']);
Route::get('/backend/admin_user_add',[App\Http\Controllers\BackendController::class,'admin_user_add']);
Route::post('/backend/admin_user_store',[App\Http\Controllers\BackendController::class,'admin_user_store']);
Route::get('/backend/admin_user_edit/{id}',[App\Http\Controllers\BackendController::class,'admin_user_edit']);
Route::post('/backend/admin_user_update/{id}',[App\Http\Controllers\BackendController::class,'admin_user_update']);
//admin_user

//user
Route::get('/backend/user',[App\Http\Controllers\BackendController::class,'user']);
Route::get('/backend/user_destroy/{id}',[App\Http\Controllers\BackendController::class,'user_destroy']);
Route::get('/backend/user_add',[App\Http\Controllers\BackendController::class,'user_add']);
Route::post('/backend/user_store',[App\Http\Controllers\BackendController::class,'user_store']);
Route::get('/backend/user_edit/{id}',[App\Http\Controllers\BackendController::class,'user_edit']);
Route::post('/backend/user_update/{id}',[App\Http\Controllers\BackendController::class,'user_update']);
//user

//product
Route::get('/backend/product',[App\Http\Controllers\BackendController::class,'product']);
Route::get('/backend/product_destroy/{id}',[App\Http\Controllers\BackendController::class,'product_destroy']);
Route::get('/backend/product_add/{id}',[App\Http\Controllers\BackendController::class,'product_add']);
Route::post('/backend/product_store',[App\Http\Controllers\BackendController::class,'product_store']);
Route::get('/backend/product_edit/{id}',[App\Http\Controllers\BackendController::class,'product_edit']);
Route::post('/backend/product_update/{id}',[App\Http\Controllers\BackendController::class,'product_update']);
//product

//history_point
Route::get('/backend/history_point',[App\Http\Controllers\BackendController::class,'history_point']);
Route::get('/backend/history_point_destroy/{id}',[App\Http\Controllers\BackendController::class,'history_point_destroy']);
Route::get('/backend/history_point_add/{id}',[App\Http\Controllers\BackendController::class,'history_point_add']);
Route::post('/backend/history_point_store',[App\Http\Controllers\BackendController::class,'history_point_store']);
Route::get('/backend/history_point_edit/{id}',[App\Http\Controllers\BackendController::class,'history_point_edit']);
Route::post('/backend/history_point_update/{id}',[App\Http\Controllers\BackendController::class,'history_point_update']);
//history_point

//wait_user
Route::get('/backend/wait_user',[App\Http\Controllers\BackendController::class,'wait_user']);
Route::get('/backend/wait_user_destroy/{id}',[App\Http\Controllers\BackendController::class,'wait_user_destroy']);
Route::get('/backend/wait_user_add',[App\Http\Controllers\BackendController::class,'wait_user_add']);
Route::post('/backend/wait_user_store',[App\Http\Controllers\BackendController::class,'wait_user_store']);
Route::get('/backend/wait_user_edit/{id}',[App\Http\Controllers\BackendController::class,'wait_user_edit']);
Route::post('/backend/wait_user_update/{id}',[App\Http\Controllers\BackendController::class,'wait_user_update']);
//wait_user


// เรียงลำดับ news
Route::post('/numupdate',[App\Http\Controllers\BackendController::class,'numupdate'])->name('numupdate');
// เรียงลำดับ news

//news
Route::get('/backend/news',[App\Http\Controllers\BackendController::class,'news']);
Route::get('/backend/news_destroy/{id}',[App\Http\Controllers\BackendController::class,'news_destroy']);
Route::get('/backend/news_add',[App\Http\Controllers\BackendController::class,'news_add']);
Route::post('/backend/news_store',[App\Http\Controllers\BackendController::class,'news_store']);
Route::get('/backend/news_edit/{id}',[App\Http\Controllers\BackendController::class,'news_edit']);
Route::post('/backend/news_update/{id}',[App\Http\Controllers\BackendController::class,'news_update']);
//news



    Route::get('/logout',[App\Http\Controllers\BackendController::class,'logout'])->name('logout');
      Route::get('/register',[App\Http\Controllers\BackendController::class,'register'])->name('register');
      Route::get('/verify',[App\Http\Controllers\BackendController::class,'verify'])->name('verify');
  });



