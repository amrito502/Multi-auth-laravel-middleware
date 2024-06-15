<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;

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


Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/login',function(){
    return redirect('/');
});

Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout']);



// Route::get('/dashboard',[AdminController::class,'dashboard']);
// Route::get('/dashboard',[SubAdminController::class,'dashboard']);
// Route::get('/dashboard',[SuperAdminController::class,'dashboard']);
// Route::get('/dashboard',[UserController::class,'dashboard']);



// ********** Super Admin Routes *********
Route::group(['prefix' => 'super-admin','middleware'=>['web','isSuperAdmin']],function(){
    Route::get('/dashboard',[SuperAdminController::class,'dashboard'])->name('superAdminUsers');
});

// ********** Sub Admin Routes ***
Route::group(['prefix' => 'sub-admin','middleware'=>['web','isSubAdmin']],function(){
    Route::get('/dashboard',[SubAdminController::class,'dashboard'])->name('subAdminUsers');
});

// ********** Admin Routes ********
Route::group(['prefix' => 'admin','middleware'=>['web','isAdmin']],function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('subAdminUsers');
});

// ********** User Routes *********
Route::group(['middleware'=>['web','isUser']],function(){
    Route::get('/dashboard',[UserController::class,'dashboard']);
});