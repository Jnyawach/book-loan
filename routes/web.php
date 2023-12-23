<?php

use App\Http\Controllers\Admin\AdminBooksController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




//Auth routes

Route::group([], function (){
    Route::post('auth/save',[AuthController::class,'saveUser']);
    Route::get('auth/register',[AuthController::class,'register'])->name('register');
    Route::get('auth/login',[AuthController::class,'login'])->name('login');
    Route::post('auth/authenticate',[AuthController::class,'authenticate']);
    Route::get('/', [MainController::class,'index']);

});

Route::group(['middleware'=>'auth'], function (){

    Route::post('auth/logout',[AuthController::class,'logout']);

});

Route::group(['middleware'=>['auth','role:admin']], function (){
    Route::resource('/admin/users', AdminUserController::class);
    Route::resource('/admin/books', AdminBooksController::class);
    Route::resource('/admin', AdminDashboardController::class);
});
