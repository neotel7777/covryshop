<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GoodsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\IndexController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){
    Route::get("/",[IndexController::class,"index"])->name('adminHome');
    Route::resource("/categories",CategoryController::class);
    Route::resource("/goods",GoodsController::class);

});

Auth::routes();


Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
