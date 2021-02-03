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


/// Admin
Route::middleware(['auth.ips'])->group(function(){
    Route::prefix('admin')->group(function () {
        Route::any('/',[App\Http\Controllers\Admin\BaseController::class, 'index'])
            ->name('admin');
        Route::any('{all}',[App\Http\Controllers\Admin\BaseController::class, 'index'])
            ->where('all', '.*');
    });
});



/// Site
Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index'])->name('home');
Route::get('/books', [App\Http\Controllers\Site\BookController::class, 'index'])->name('books');



//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
