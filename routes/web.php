<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    Route::get('auth/login',[AuthController::class,'login'])->name('login');
    Route::post('auth/authenticate',[AuthController::class,'authenticate']);

});

Route::group(['middleware'=>'auth'], function (){
    Route::get('/', [MainController::class,'index']);
    Route::post('auth/logout',[AuthController::class,'logout']);

});
