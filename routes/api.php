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

Route::middleware(['auth.ips'])->group(function(){

    Route::prefix('auth')->group(function () {

        Route::post('login',[App\Http\Controllers\Admin\Api\V1\Auth\LoginController::class, 'login']);

        Route::middleware(['auth:jwt/login'])->group(function(){
            Route::post('tfa',[App\Http\Controllers\Admin\Api\V1\Auth\LoginController::class, 'twoFactorAuth'])->name('api.admin.auth.tfa');
        });

        Route::middleware(['auth:jwt/base'])->group(function(){
            Route::post('refresh-tokens',[App\Http\Controllers\Admin\Api\V1\Auth\LoginController::class, 'refresh'])->name('api.admin.auth.refresh');
            Route::post('logout',[App\Http\Controllers\Admin\Api\V1\Auth\LoginController::class, 'logout']);
        });

    });

    Route::prefix('admin')->group(function () {
        Route::middleware(['auth:jwt/base'])->group(function(){

            //Media
            //News
            Route::get('news',[App\Http\Controllers\Admin\Api\V1\Media\NewsController::class, 'index']);
            Route::get('news/{id}/edit',[App\Http\Controllers\Admin\Api\V1\Media\NewsController::class, 'edit']);
            Route::post('news/{id}',[App\Http\Controllers\Admin\Api\V1\Media\NewsController::class, 'update']);
            Route::post('news',[App\Http\Controllers\Admin\Api\V1\Media\NewsController::class, 'store']);

            //NewsCategory
            Route::get('categories',[App\Http\Controllers\Admin\Api\V1\Media\NewsCategoryController::class, 'index']);


        });
    });


});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
