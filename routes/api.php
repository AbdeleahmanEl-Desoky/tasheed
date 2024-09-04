<?php


use App\Http\Controllers\Api\ApiController;
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

Route::get('home', [ApiController::class,'index']);

Route::get('about', [ApiController::class,'about']);

Route::get('blogs', [ApiController::class,'blogs']);
Route::get('blog/{id}', [ApiController::class,'blog']);

Route::get('project-page', [ApiController::class,'projectPage']);

Route::get('projects', [ApiController::class,'projects']);

Route::get('project/{id}', [ApiController::class,'project']);

Route::get('project/unit/{id}', [ApiController::class,'projectUnit']);

Route::get('contact', [ApiController::class,'contact']);

Route::post('message', [ApiController::class,'message']);
