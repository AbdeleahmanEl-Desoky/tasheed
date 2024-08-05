<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomePageController;
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


Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class,'login'])->name('login');
    Route::post('login', [AuthController::class,'authenticate'])->name('login');
});



Route::group(['middleware' => ['auth'],'perfix'=>'dashboard','as'=>'dashboard.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('welcome');

    Route::resource('home', HomePageController::class);

    Route::resource('users', UserController::class);


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
Route::fallback(function () {
    return redirect('/');
});
