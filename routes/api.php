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
    Route::get('/api_user/{id}', 'ApiController@api_user');


    Route::get('/api_market', 'ApiController@api_market');


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
