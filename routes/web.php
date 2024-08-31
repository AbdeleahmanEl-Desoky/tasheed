<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AboutBenefitController;
use App\Http\Controllers\Admin\AboutGalleryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FeatureUnitController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SingleProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\ProjectPageController;
use App\Http\Controllers\Admin\SingleProjectUnitController;
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

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('welcome');

    Route::resource('home', HomePageController::class);
    Route::resource('users', UserController::class);
    Route::resource('blog', BlogController::class);

    Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
        Route::get('/', [AboutController::class,'index'])->name('index');
        Route::post('/', [AboutController::class,'store'])->name('store');
        Route::get('/vision', [AboutController::class,'visionIndex'])->name('vision.index');
        Route::post('/vision', [AboutController::class,'visionStore'])->name('vision.store');
        Route::resource('benefits', AboutBenefitController::class);
        Route::resource('galleries', AboutGalleryController::class);
    });

    Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
        Route::get('/', [ProjectPageController::class,'index'])->name('index');
        Route::post('/', [ProjectPageController::class,'store'])->name('store');
        Route::resource('features', FeatureController::class);
        Route::resource('feature_unit', FeatureUnitController::class);

        Route::group(['prefix' => 'single', 'as' => 'single.'], function () {
            Route::resource('/', SingleProjectController::class);

            Route::get('unit/{project_id}', [SingleProjectUnitController::class,'index'])->name('unit.index');
            Route::get('unit/create/{project_id}', [SingleProjectUnitController::class,'create'])->name('unit.create');

            Route::post('unit', [SingleProjectUnitController::class,'store'])->name('unit.store');
        });
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::fallback(function () {
        return redirect('/');
    });
});
