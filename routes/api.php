<?php

use App\Http\Controllers\Api\ApiServiceSetup;
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
    // 'middleware' => 'api.token',
    'prefix' => 'common',
], function () {

    Route::post('/api_forget_pass','ApiController@api_forget_pass');

    Route::post('/api_otp_register', 'ApiController@api_otp_register');
    Route::get('/api_pdf_work/{id}', 'ApiController@api_pdf_work');

    Route::get('/api_user/{id}', 'ApiController@api_user');

    Route::get('/api_air_list/{id}', 'ApiController@api_air_list');
    Route::post('/api_air_list_check1', 'ApiController@api_air_list_check1');
    Route::post('/api_air_list_check2', 'ApiController@api_air_list_check2');
    Route::post('/api_air_list_check3', 'ApiController@api_air_list_check3');
    Route::post('/api_air_list_check4', 'ApiController@api_air_list_check4');
    Route::post('/api_air_list_check5', 'ApiController@api_air_list_check5');
    Route::post('/api_air_list_check6', 'ApiController@api_air_list_check6');


    Route::get('/api_market', 'ApiController@api_market');

    Route::get('/api_noti/{id}', 'ApiController@api_noti');
    Route::get('/api_noti_all', 'ApiController@api_noti_all');
    Route::post('/api_noti_add', 'ApiController@api_noti_add');
    


    Route::get('/api_air_model', 'ApiController@api_air_model');

    Route::get('/api_work', 'ApiController@api_work');
    Route::get('/api_work_detail/{id}', 'ApiController@api_work_detail');

    Route::get('/api_work_item/{id}', 'ApiController@api_work_item');
    
    Route::post('/api_work_item_add', 'ApiController@api_work_item_add');
    Route::post('/api_work_item_delete', 'ApiController@api_work_item_delete');
    Route::post('/api_work_item_submit', 'ApiController@api_work_item_submit');

    Route::post('/api_work_list', 'ApiController@api_work_list');

    Route::post('/api_work_submit', 'ApiController@api_work_submit');
    Route::post('/api_end_work', 'ApiController@api_end_work');



    Route::post('/api_change_password', 'ApiController@api_change_password');

    Route::post('/api_news', 'ApiController@api_news');

    Route::get('/api_item_point', 'ApiController@api_item_point');
    Route::post('/api_item_point_detail', 'ApiController@api_item_point_detail');
    Route::post('/api_buy_item', 'ApiController@api_buy_item');
    Route::post('/api_check_point', 'ApiController@api_check_point');


    Route::get('/api_province', 'ApiController@api_province');

    Route::post('/api_edit_user', 'ApiController@api_edit_user');

    Route::post('/api_register_user', 'ApiController@api_register_user');
    Route::post('/api_login_user', 'ApiController@api_login_user');

    Route::post('/api_verify_customer', 'ApiController@verify_customer');
    Route::post('/api_create_airconditioner', 'ApiController@add_air_conditioner');

    Route::get('/api_search_customer/{id}/{name}', 'ApiController@search_customer_name');
    Route::get('/api_search_customer/{id}', 'ApiController@search_customer_name');
    Route::get('/api_get_customer/{id}', 'ApiController@get_customer');
    Route::post('/api_update_airconditioner', 'ApiController@update_air_conditioner');

    Route::get('/api_get_training', 'ApiController@get_traing_list');
    Route::get('/api_get_trainingdetail/{id}/{user}', 'ApiController@training_detail');
    Route::post('/api_create_list_training/{id}', 'ApiController@book_training');
    Route::post('/api_edit_list_training/{id}', 'ApiController@edit_book_training');
    Route::get('/api_remove_list_training/{id}', 'ApiController@removeBooktraing');
    Route::post('/api_approve_training/{id}', 'ApiController@approve_training_list');

    Route::post('/api_update_customer', 'ApiController@update_customer');

    Route::get('/test_database', 'ApiController@test_database');


    Route::prefix('service')->group(function () {
        Route::prefix('car')->group(function () {
            Route::post('/', [ApiServiceSetup::class, 'getCarList']);
            Route::post('/add', [ApiServiceSetup::class, 'addCarService']);
            Route::put('/edit', [ApiServiceSetup::class, 'updateCarService']);
            Route::delete('/delete', [ApiServiceSetup::class, 'removeCarService']);
            Route::post('/show', [ApiServiceSetup::class, 'getCarDetail']);
            Route::post('/picture/add', [ApiServiceSetup::class, 'addCarPicture']);
            Route::delete('/picture/delete', [ApiServiceSetup::class, 'removeCarPicture']);
            Route::post('/picture/show', [ApiServiceSetup::class, 'getCarPictureDetail']);
        });

        Route::prefix('technician')->group(function () {
            Route::post('/', [ApiServiceSetup::class, 'getTechnicianService']);
            Route::post('/add', [ApiServiceSetup::class, 'addTechnicianService']);
            Route::put('/edit', [ApiServiceSetup::class, 'updateTechnicianService']);
            Route::delete('/delete', [ApiServiceSetup::class, 'removeTechnicianService']);
            Route::post('/picture/add', [ApiServiceSetup::class, 'addTechnicianPicture']);
            Route::delete('/picture/delete', [ApiServiceSetup::class, 'removeTechnicianPicture']);
            Route::post('/picture', [ApiServiceSetup::class, 'getTechnicianPicture']);
        });

        Route::prefix('tool')->group(function () {
            Route::post('/', [ApiServiceSetup::class, 'getToolService']);
            Route::post('/add', [ApiServiceSetup::class, 'addToolService']);
            Route::put('/edit', [ApiServiceSetup::class, 'updateToolService']);
            Route::delete('/delete', [ApiServiceSetup::class, 'removeToolService']);
            Route::post('/picture/add', [ApiServiceSetup::class, 'addToolPicture']);
            Route::delete('/picture/delete', [ApiServiceSetup::class, 'removeToolPicture']);
            Route::post('/picture', [ApiServiceSetup::class, 'getToolPicture']);
        });
    });
});
