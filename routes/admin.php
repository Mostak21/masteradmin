<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubdistrictController;
use App\Http\Controllers\UploadedfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 'middleware' => ['auth', 'admin']
        Route::group(['prefix' => 'admin'], function() {
        Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');


//category
            Route::resource('categories', CategoryController::class);
            Route::get('/categories/edit/{id}', [CategoryController::class,'edit'])->name('categories.edit');
            Route::get('/categories/destroy/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');
           //Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

//address

            Route::resource('countries', CountryController::class);
            Route::post('/countries/status', [CountryController::class,'updateStatus'])->name('countries.status');

            Route::resource('states',StateController::class);
            Route::post('/states/status', [StateController::class,'updateStatus'])->name('states.status');

            Route::resource('cities', CityController::class);
            Route::get('/cities/edit/{id}', [CityController::class,'edit'])->name('cities.edit');
            Route::get('/cities/destroy/{id}', [CityController::class,'destroy'])->name('cities.destroy');
            Route::post('/cities/status', [CityController::class,'updateStatus'])->name('cities.status');

            Route::resource('districts', DistrictController::class);
            Route::get('/districts/edit/{id}', [DistrictController::class,'edit'])->name('districts.edit');
            Route::get('/districts/destroy/{id}', [DistrictController::class,'destroy'])->name('districts.destroy');
            Route::post('/districts/status', [DistrictController::class,'updateStatus'])->name('districts.status');

            Route::resource('subdistricts', SubdistrictController::class);
            Route::get('/subdistricts/edit/{id}', [SubdistrictController::class,'edit'])->name('subdistricts.edit');
            Route::get('/subdistricts/destroy/{id}', [SubdistrictController::class,'destroy'])->name('subdistricts.destroy');
            Route::post('/subdistricts/status', [SubdistrictController::class,'updateStatus'])->name('subdistricts.status');
//file handler

            // uploaded files
            Route::any('/uploaded-files/file-info', [UploadedfileController::class,'file_info'])->name('uploaded-files.info');
            Route::resource('/uploaded-files', UploadedfileController::class);
            Route::get('/uploaded-files/destroy/{id}', [UploadedfileController::class,'destroy'])->name('uploaded-files.destroy');

            Route::get('/bulkdestroy', [UploadedfileController::class,'bulkdestroy'])->name('uploaded-files.bulkdestroy');
            Route::get('/bulk-delete', [UploadedfileController::class,'bulkdelete'])->name('uploaded-files.bulkdelete');

 //user router

            Route::resource('users', UserController::class);
            Route::get('users_ban/{customer}', [UserController::class,'ban'])->name('users.ban');
            Route::get('/users/login/{id}', [UserController::class,'login'])->name('users.login');
            Route::get('/users/destroy/{id}', [UserController::class,'destroy'])->name('users.destroy');
            Route::post('/bulk-user-delete', [UserController::class,'bulk_customer_delete'])->name('bulk-user-delete');

 //article router
            Route::resource('articles',ArticleController::class);

        });
