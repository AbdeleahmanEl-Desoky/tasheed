<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AboutBenefitController;
use App\Http\Controllers\Admin\AboutGalleryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogPageController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CareerPageController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FeatureUnitController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SingleProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\MeetTeamController;
use App\Http\Controllers\Admin\MeetTeamPageController;
use App\Http\Controllers\Admin\MessageController;
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

    Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
        Route::get('/', [AboutController::class,'index'])->name('index');
        Route::post('/', [AboutController::class,'store'])->name('store');

        Route::get('/vision', [AboutController::class,'visionIndex'])->name('vision.index');
        Route::post('/vision', [AboutController::class,'visionStore'])->name('vision.store');

        Route::get('/mission', [AboutController::class,'missionIndex'])->name('mission.index');
        Route::post('/mission', [AboutController::class,'missionStore'])->name('mission.store');

        Route::resource('benefits', AboutBenefitController::class);
        Route::resource('galleries', AboutGalleryController::class);
    });

    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::resource('/', BlogController::class);
        Route::get('edit/{id}', [BlogController::class,'edit'])->name('edit');
        Route::put('update/{id}', [BlogController::class,'update'])->name('update');
        Route::get('caver', [BlogPageController::class,'index'])->name('caver');
        Route::post('caver/store', [BlogPageController::class,'store'])->name('store_caver');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
        Route::get('/', [ContactController::class,'index'])->name('index');
        Route::post('/', [ContactController::class,'store'])->name('store');
    });


    Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
        Route::get('/', [ProjectPageController::class,'index'])->name('index');
        Route::post('/', [ProjectPageController::class,'store'])->name('store');
        Route::resource('features', FeatureController::class);
        Route::resource('feature_unit', FeatureUnitController::class);

        Route::group(['prefix' => 'single', 'as' => 'single.'], function () {
            Route::get('/', [SingleProjectController::class,'index'])->name('index');
            Route::get('/create', [SingleProjectController::class,'create'])->name('create');
            Route::post('/', [SingleProjectController::class,'store'])->name('store');
            Route::get('edit/{id}', [SingleProjectController::class,'edit'])->name('edit');
            Route::put('update/{id}', [SingleProjectController::class,'update'])->name('update');
            Route::delete('{id}', [SingleProjectController::class,'destroy'])->name('destroy');

            Route::get('unit/{project_id}', [SingleProjectUnitController::class,'index'])->name('unit.index');
            Route::get('unit/create/{project_id}', [SingleProjectUnitController::class,'create'])->name('unit.create');
            Route::get('unit/edit/{id}', [SingleProjectUnitController::class,'edit'])->name('unit.edit');

            Route::put('unit/update/{id}', [SingleProjectUnitController::class,'update'])->name('unit.update');

            Route::post('unit', [SingleProjectUnitController::class,'store'])->name('unit.store');
        });
    });



    Route::group(['prefix' => 'meet_team', 'as' => 'meet_team.'], function () {
        Route::get('/', [MeetTeamPageController::class,'index'])->name('index');
        Route::post('/', [MeetTeamPageController::class,'store'])->name('store');
        Route::resource('team', MeetTeamController::class);

    });

    Route::get('message', [MessageController::class,'message'])->name('message');

    Route::get('apply_job', [MessageController::class,'applyJob'])->name('apply_job');

    Route::get('emils', [MessageController::class,'emils'])->name('emils');


    Route::get('career/cover', [CareerPageController::class,'index'])->name('career.cover');
    Route::post('career/cover/store', [CareerPageController::class,'store'])->name('career.cover.store');

    Route::resource('career', CareerController::class);




    Route::resource('job', JobController::class);

    Route::resource('users', UserController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::fallback(function () {
        return redirect('/');
    });
});
