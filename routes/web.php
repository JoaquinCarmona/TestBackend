<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/upload-image-blade',  [ImageUploadController::class,'index']);
Route::post('/upload-image-blade',  [ImageUploadController::class,'store'])->name('upload-image-form');
Route::get('/erase-sesion',  [ImageUploadController::class,'fushSessionData'])->name('erase-session');
