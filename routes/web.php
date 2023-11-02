<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [\App\Http\Controllers\MainController::class,'index']);
Route::post('/answers/save',[\App\Http\Controllers\AnswersController::class,'save']);

//Auth routes

Route::group([], function (){
    Route::get('auth/login',[AuthController::class,'login'])->name('login');
    Route::post('auth/authenticate',[AuthController::class,'authenticate']);

});

Route::group(['middleware'=>'auth'], function (){
    Route::get('test-mail',[DashboardController::class, 'testMail']);
    Route::post('auth/logout',[AuthController::class,'logout']);
    Route::get('dashboard/questions/show/{id}', [DashboardController::class, 'show']);
    Route::get('dashboard/questions', [DashboardController::class, 'question']);
    Route::get('dashboard/customers', [DashboardController::class, 'customer']);
    Route::get('dashboard', [DashboardController::class, 'dashboard']);

});
