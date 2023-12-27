<?php

use App\Http\Controllers\Admin\AdminBooksController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\BooksController;
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

    Route::get('/borrowing/{id}',[BooksController::class,'borrowingShow'])->name('borrowing.show');
    Route::get('/borrowing',[BooksController::class,'borrowing'])->name('borrowing.index');
    Route::get('/books/{id}/borrow',[BooksController::class,'index']);
    Route::post('/books/borrow',[BooksController::class,'borrow']);
    Route::post('request/extension',[BooksController::class,'extension']);

});

Route::group(['middleware'=>['auth','role:admin']], function (){
    Route::get('admin/loans/penalties',[AdminLoanController::class,'penalty']);
    Route::post('admin/loans/apply-penalty',[AdminLoanController::class,'applyPenalty']);
    Route::patch('/admin/loans/{id}/receive',[AdminLoanController::class,'receive']);
    Route::patch('/admin/loans/{id}/approve',[AdminLoanController::class,'approve']);
    Route::resource('/admin/loans', AdminLoanController::class);
    Route::resource('/admin/users', AdminUserController::class);
    Route::resource('/admin/books', AdminBooksController::class);
    Route::resource('/admin', AdminDashboardController::class);
});
