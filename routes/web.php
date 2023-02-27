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
    Route::post('/news_choose',[App\Http\Controllers\BackendController::class,'news_choose']);
    Route::post('/item_point_choose',[App\Http\Controllers\BackendController::class,'item_point_choose']);


Route::prefix('backend')->group(function(){
    Route::get('banner',[App\Http\Controllers\BackendController::class,'banner']);
    Route::get('banner_destroy/{id}',[App\Http\Controllers\BackendController::class,'banner_destroy']);
    Route::get('banner_add',[App\Http\Controllers\BackendController::class,'banner_add']);
    Route::post('banner_store',[App\Http\Controllers\BackendController::class,'banner_store']);
    Route::get('banner_edit/{id}',[App\Http\Controllers\BackendController::class,'banner_edit']);
    Route::post('banner_update/{id}',[App\Http\Controllers\BackendController::class,'banner_update']);
    //banner

    //admin_user
    Route::post('user_gen',[App\Http\Controllers\BackendController::class,'user_gen']);

    Route::get('admin_user',[App\Http\Controllers\BackendController::class,'admin_user']);
    Route::get('admin_user_destroy/{id}',[App\Http\Controllers\BackendController::class,'admin_user_destroy']);
    Route::get('admin_user_add',[App\Http\Controllers\BackendController::class,'admin_user_add']);
    Route::post('admin_user_store',[App\Http\Controllers\BackendController::class,'admin_user_store']);
    Route::get('admin_user_edit/{id}',[App\Http\Controllers\BackendController::class,'admin_user_edit']);
    Route::post('admin_user_update/{id}',[App\Http\Controllers\BackendController::class,'admin_user_update']);
    //admin_user

    //user
    Route::get('user_item/{id}',[App\Http\Controllers\BackendController::class,'user_item']);

    Route::get('user_service/{id}',[App\Http\Controllers\BackendController::class,'user_service']);
    Route::get('car_destroy/{id}',[App\Http\Controllers\BackendController::class,'car_destroy']);
    Route::get('tool_destroy/{id}',[App\Http\Controllers\BackendController::class,'tool_destroy']);
    Route::get('tec_destroy/{id}',[App\Http\Controllers\BackendController::class,'tec_destroy']);

    Route::get('user',[App\Http\Controllers\BackendController::class,'user']);
    Route::get('user_destroy/{id}',[App\Http\Controllers\BackendController::class,'user_destroy']);
    Route::get('user_add',[App\Http\Controllers\BackendController::class,'user_add']);
    Route::post('user_store',[App\Http\Controllers\BackendController::class,'user_store']);
    Route::get('user_edit/{id}',[App\Http\Controllers\BackendController::class,'user_edit']);
    Route::post('user_update/{id}',[App\Http\Controllers\BackendController::class,'user_update']);
    //user

    //product
    Route::get('product',[App\Http\Controllers\BackendController::class,'product']);
    Route::get('product_destroy/{id}',[App\Http\Controllers\BackendController::class,'product_destroy']);
    Route::get('product_add/{id}',[App\Http\Controllers\BackendController::class,'product_add']);
    Route::post('product_store',[App\Http\Controllers\BackendController::class,'product_store']);
    Route::get('product_edit/{id}',[App\Http\Controllers\BackendController::class,'product_edit']);
    Route::post('product_update/{id}',[App\Http\Controllers\BackendController::class,'product_update']);
    //product

    //history_point
    Route::get('history_point',[App\Http\Controllers\BackendController::class,'history_point']);
    Route::get('history_point_destroy/{id}',[App\Http\Controllers\BackendController::class,'history_point_destroy']);
    Route::get('history_point_add/{id}',[App\Http\Controllers\BackendController::class,'history_point_add']);
    Route::post('history_point_store',[App\Http\Controllers\BackendController::class,'history_point_store']);
    Route::get('history_point_edit/{id}',[App\Http\Controllers\BackendController::class,'history_point_edit']);
    Route::post('history_point_update/{id}',[App\Http\Controllers\BackendController::class,'history_point_update']);
    //history_point

    //wait_user
    Route::get('wait_user',[App\Http\Controllers\BackendController::class,'wait_user']);
    Route::get('wait_user_destroy/{id}',[App\Http\Controllers\BackendController::class,'wait_user_destroy']);
    Route::get('wait_user_add',[App\Http\Controllers\BackendController::class,'wait_user_add']);
    Route::post('wait_user_store',[App\Http\Controllers\BackendController::class,'wait_user_store']);
    Route::get('wait_user_edit/{id}',[App\Http\Controllers\BackendController::class,'wait_user_edit']);
    Route::post('wait_user_update/{id}',[App\Http\Controllers\BackendController::class,'wait_user_update']);
    //wait_user

    //news

    Route::get('news',[App\Http\Controllers\BackendController::class,'news']);
    Route::get('news_destroy/{id}',[App\Http\Controllers\BackendController::class,'news_destroy']);
    Route::get('news_add',[App\Http\Controllers\BackendController::class,'news_add']);
    Route::post('news_store',[App\Http\Controllers\BackendController::class,'news_store']);
    Route::get('news_edit/{id}',[App\Http\Controllers\BackendController::class,'news_edit']);
    Route::post('news_update/{id}',[App\Http\Controllers\BackendController::class,'news_update']);
    //news

     //item_point

     Route::get('item_point',[App\Http\Controllers\BackendController::class,'item_point']);
     Route::get('item_point_destroy/{id}',[App\Http\Controllers\BackendController::class,'item_point_destroy']);
     Route::get('item_point_add',[App\Http\Controllers\BackendController::class,'item_point_add']);
     Route::post('item_point_store',[App\Http\Controllers\BackendController::class,'item_point_store']);
     Route::get('item_point_edit/{id}',[App\Http\Controllers\BackendController::class,'item_point_edit']);
     Route::post('item_point_update/{id}',[App\Http\Controllers\BackendController::class,'item_point_update']);
     //item_point

    // ===== Conditioner List ====
    Route::get('air_conditioner',[App\Http\Controllers\AirConditionerController::class,'index']);
    Route::get('air_conditioner/{id}',[App\Http\Controllers\AirConditionerController::class,'details']);
    Route::get('air_conditioner/destroy/{id}',[App\Http\Controllers\AirConditionerController::class,'destroy']);

    Route::get('air_conditioner/{id}/{item}',[App\Http\Controllers\AirConditionerController::class,'details_user']);

    // ===== Training =====
    Route::get('training',[App\Http\Controllers\TrainingController::class, 'index']);
    Route::get('training/add',[App\Http\Controllers\TrainingController::class,'add']);
    Route::post('training/create',[App\Http\Controllers\TrainingController::class,'insert']);
    Route::get('training/edit/{id}',[App\Http\Controllers\TrainingController::class,'edit']);
    Route::post('training/update/{id}',[App\Http\Controllers\TrainingController::class,'update']);
    Route::get('training/destroy',[App\Http\Controllers\TrainingController::class,'destroy']);
    Route::post('training/create-turn',[App\Http\Controllers\TrainingController::class,'add_turn']);
    Route::get('training/get_list/{id}/{turn}',[App\Http\Controllers\TrainingController::class, 'get_list']);
});

//Ajax
Route::get('fetch_amphure/{id}',[App\Http\Controllers\BackendController::class, 'get_amphure']);
Route::get('fetch_district/{id}',[App\Http\Controllers\BackendController::class, 'get_district']);
Route::get('fetch_postcode/{id}',[App\Http\Controllers\BackendController::class, 'get_postcode']);

// เรียงลำดับ news
Route::post('/numupdate',[App\Http\Controllers\BackendController::class,'numupdate'])->name('numupdate');
// เรียงลำดับ news


    Route::get('/logout',[App\Http\Controllers\BackendController::class,'logout'])->name('logout');
      Route::get('/register',[App\Http\Controllers\BackendController::class,'register'])->name('register');
      Route::get('/verify',[App\Http\Controllers\BackendController::class,'verify'])->name('verify');
  });



