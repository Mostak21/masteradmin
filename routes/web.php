<?php

use App\Http\Controllers\UploadedfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

        Route::get('/', function () {
            return view('welcome');
        });




//        Route::get('/login', function () {
//            return view('login');
//        });
        Route::get('/login',[AuthController::class,'login'])->name('login');
        Route::post('/loginattempt',[AuthController::class,'loginattempt'])->name('login.attempt');
        Route::get('/registration',[AuthController::class,'index'])->name('registration');
        Route::post('/registrationaction',[AuthController::class,'store'])->name('reg.action');

//        Route::group(['prefix' => 'admin'], function() {
//
//            Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
//
//        });



        Route::post('/rit-uploader', [UploadedfileController::class,'show_uploader']);
        Route::post('/rit-uploader/upload', [UploadedfileController::class,'upload']);
        Route::get('/rit-uploader/get_uploaded_files',[UploadedfileController::class,'get_uploaded_files']);
        Route::post('/rit-uploader/get_file_by_ids',[UploadedfileController::class,'get_preview_files']);
        Route::get('/rit-uploader/download/{id}', [UploadedfileController::class,'attachment_download'])->name('download_attachment');
