<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('home', [HomeController::class,'index']);
Route::get('blog', [BlogController::class,'index']);

