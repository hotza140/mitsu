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

Route::get('heavyoneclick_Appload', [App\Http\Controllers\BackendController::class, 'heavyoneclick_Appload']);
Route::get('download', [App\Http\Controllers\BackendController::class, 'download']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/forget_pass1/{id}',[App\Http\Controllers\BackendController::class,'forget_pass1']);
Route::post('/change_pass',[App\Http\Controllers\BackendController::class,'change_pass']);


Route::get('/check_test',[App\Http\Controllers\BackendController::class,'check_test']);

Route::post('/login_backend',[App\Http\Controllers\BackendController::class,'login_backend']);

Route::group(['middleware' => ['auth']],function(){

    Route::get('/',[App\Http\Controllers\BackendController::class,'welcome']);
    Route::get('/backend',[App\Http\Controllers\BackendController::class,'welcome']);

    // Route::get('/fff_4',[App\Http\Controllers\BackendController::class,'fff_4']);


    // Route::get('/aaa_2',[App\Http\Controllers\BackendController::class,'aaa_2']);

    // Route::get('/fix',[App\Http\Controllers\BackendController::class,'fix']);
    // Route::get('/fix2',[App\Http\Controllers\BackendController::class,'fix2']);
    // Route::get('/fix3',[App\Http\Controllers\BackendController::class,'fix3']);

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


     //admin_user
     Route::get('noti',[App\Http\Controllers\BackendController::class,'noti']);
     Route::get('noti_destroy/{id}',[App\Http\Controllers\BackendController::class,'noti_destroy']);
     Route::get('noti_add',[App\Http\Controllers\BackendController::class,'noti_add']);
     Route::post('noti_store',[App\Http\Controllers\BackendController::class,'noti_store']);
     Route::get('noti_edit/{id}',[App\Http\Controllers\BackendController::class,'noti_edit']);
     Route::post('noti_update/{id}',[App\Http\Controllers\BackendController::class,'noti_update']);
     //admin_user


     //tech_service
     Route::get('tech_service',[App\Http\Controllers\BackendController::class,'tech_service']);
     Route::get('tech_service_destroy/{id}',[App\Http\Controllers\BackendController::class,'tech_service_destroy']);
     Route::get('tech_service_add',[App\Http\Controllers\BackendController::class,'tech_service_add']);
     Route::post('tech_service_store',[App\Http\Controllers\BackendController::class,'tech_service_store']);
     Route::get('tech_service_edit/{id}',[App\Http\Controllers\BackendController::class,'tech_service_edit']);
     Route::post('tech_service_update/{id}',[App\Http\Controllers\BackendController::class,'tech_service_update']);
     //tech_service

    //user
    Route::post('user_excel',[App\Http\Controllers\BackendController::class,'user_excel']);

    Route::post('user_export',[App\Http\Controllers\BackendController::class,'user_export']);

    Route::get('user_item/{id}',[App\Http\Controllers\BackendController::class,'user_item']);

    Route::get('gal_service/{type}/{id}/{user}',[App\Http\Controllers\BackendController::class,'gal_service']);
    Route::get('service_gal_destroy/{type}/{id}',[App\Http\Controllers\BackendController::class,'service_gal_destroy']);

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


    //wo
    Route::get('pdf_work/{id}',[App\Http\Controllers\WOController::class,'pdf_work']);

    Route::get('wo',[App\Http\Controllers\WOController::class,'wo']);
    Route::get('wo_destroy/{id}',[App\Http\Controllers\WOController::class,'wo_destroy']);
    Route::get('wo_add',[App\Http\Controllers\WOController::class,'wo_add']);
    Route::post('wo_store',[App\Http\Controllers\WOController::class,'wo_store']);
    Route::get('wo_edit/{id}',[App\Http\Controllers\WOController::class,'wo_edit']);
    Route::post('wo_update/{id}',[App\Http\Controllers\WOController::class,'wo_update']);
    //wo
     //wo_item
     Route::get('wo_item/{id}',[App\Http\Controllers\WOController::class,'wo_item']);
     Route::get('wo_item_destroy/{id}',[App\Http\Controllers\WOController::class,'wo_item_destroy']);
     Route::get('wo_item_add/{id}',[App\Http\Controllers\WOController::class,'wo_item_add']);
     Route::post('wo_item_store',[App\Http\Controllers\WOController::class,'wo_item_store']);
     Route::get('wo_item_edit/{id}',[App\Http\Controllers\WOController::class,'wo_item_edit']);
     Route::post('wo_item_update/{id}',[App\Http\Controllers\WOController::class,'wo_item_update']);
     //wo_item

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

     //all_point
     Route::post('all_point_export',[App\Http\Controllers\BackendController::class,'all_point_export']);

    Route::get('all_point',[App\Http\Controllers\BackendController::class,'all_point']);
    Route::get('all_point_destroy/{id}',[App\Http\Controllers\BackendController::class,'all_point_destroy']);
    Route::get('all_point_add/{id}',[App\Http\Controllers\BackendController::class,'all_point_add']);
    Route::post('all_point_store',[App\Http\Controllers\BackendController::class,'all_point_store']);
    Route::get('all_point_edit/{id}',[App\Http\Controllers\BackendController::class,'all_point_edit']);
    Route::post('all_point_update/{id}',[App\Http\Controllers\BackendController::class,'all_point_update']);
    //all_point

    //wait_user
    Route::get('wait_user_not/{id}',[App\Http\Controllers\BackendController::class,'wait_user_not']);

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


     //market
     Route::get('market',[App\Http\Controllers\BackendController::class,'market']);
     Route::get('market_destroy/{id}',[App\Http\Controllers\BackendController::class,'market_destroy']);
     Route::get('market_add',[App\Http\Controllers\BackendController::class,'market_add']);
     Route::post('market_store',[App\Http\Controllers\BackendController::class,'market_store']);
     Route::get('market_edit/{id}',[App\Http\Controllers\BackendController::class,'market_edit']);
     Route::post('market_update/{id}',[App\Http\Controllers\BackendController::class,'market_update']);
     //market

     //item_point
     Route::get('wait_point',[App\Http\Controllers\BackendController::class,'wait_point']);
     Route::get('wait_destroy/{id}',[App\Http\Controllers\BackendController::class,'wait_destroy']);
     Route::get('wait_con/{id}',[App\Http\Controllers\BackendController::class,'wait_con']);
     Route::get('wait_not/{id}',[App\Http\Controllers\BackendController::class,'wait_not']);

     Route::get('item_point',[App\Http\Controllers\BackendController::class,'item_point']);
     Route::get('item_point_destroy/{id}',[App\Http\Controllers\BackendController::class,'item_point_destroy']);
     Route::get('item_point_add',[App\Http\Controllers\BackendController::class,'item_point_add']);
     Route::post('item_point_store',[App\Http\Controllers\BackendController::class,'item_point_store']);
     Route::get('item_point_edit/{id}',[App\Http\Controllers\BackendController::class,'item_point_edit']);
     Route::post('item_point_update/{id}',[App\Http\Controllers\BackendController::class,'item_point_update']);
     //item_point
     

     //air_model
     
     Route::post('air_model_excel',[App\Http\Controllers\AirModelController::class,'air_model_excel']);

     

    Route::get('air_model',[App\Http\Controllers\AirModelController::class,'air_model']);
    Route::get('air_model_destroy/{id}',[App\Http\Controllers\AirModelController::class,'air_model_destroy']);
    Route::get('air_model_add',[App\Http\Controllers\AirModelController::class,'air_model_add']);
    Route::post('air_model_store',[App\Http\Controllers\AirModelController::class,'air_model_store']);
    Route::get('air_model_edit/{id}',[App\Http\Controllers\AirModelController::class,'air_model_edit']);
    Route::post('air_model_update/{id}',[App\Http\Controllers\AirModelController::class,'air_model_update']);
    //air_model

       //air_model_list
       Route::post('air_model_list_excel',[App\Http\Controllers\Air_listController::class,'air_model_list_excel']);

       Route::get('air_model_list',[App\Http\Controllers\Air_listController::class,'air_model_list']);
       Route::get('air_model_list_destroy/{id}',[App\Http\Controllers\Air_listController::class,'air_model_list_destroy']);
       Route::get('air_model_list_add',[App\Http\Controllers\Air_listController::class,'air_model_list_add']);
       Route::post('air_model_list_store',[App\Http\Controllers\Air_listController::class,'air_model_list_store']);
       Route::get('air_model_list_edit/{id}',[App\Http\Controllers\Air_listController::class,'air_model_list_edit']);
       Route::post('air_model_list_update/{id}',[App\Http\Controllers\Air_listController::class,'air_model_list_update']);
       //air_model_list

    // ===== Conditioner List ====
    Route::post('data_export',[App\Http\Controllers\AirConditionerController::class,'data_export']);
    Route::get('air_conditioner',[App\Http\Controllers\AirConditionerController::class,'index']);
    Route::get('air_conditioner/{id}',[App\Http\Controllers\AirConditionerController::class,'details']);
    Route::post('air_conditioner_edit',[App\Http\Controllers\AirConditionerController::class,'air_conditioner_edit']);

    Route::get('air_conditioner/destroy/{id}',[App\Http\Controllers\AirConditionerController::class,'destroy']);

    Route::get('air_conditioner/{id}/{item}',[App\Http\Controllers\AirConditionerController::class,'details_user']);



    Route::post('train_export',[App\Http\Controllers\TrainingController::class, 'train_export']);
    // ===== Training =====
    Route::get('training/turn_destroy/{id}',[App\Http\Controllers\TrainingController::class, 'turn_destroy']);
    Route::get('training/turn_edit/{id}',[App\Http\Controllers\TrainingController::class, 'turn_edit']);
    Route::get('training',[App\Http\Controllers\TrainingController::class, 'index']);
    Route::get('training/add',[App\Http\Controllers\TrainingController::class,'add']);
    Route::post('training/create',[App\Http\Controllers\TrainingController::class,'insert']);
    Route::get('training/edit/{id}',[App\Http\Controllers\TrainingController::class,'edit']);
    Route::post('training/update/{id}',[App\Http\Controllers\TrainingController::class,'update']);
    Route::get('training/destroy/{id}',[App\Http\Controllers\TrainingController::class,'destroy']);
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



