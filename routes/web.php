<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FileUpload;

Route::get('blogs', [CompanyCRUDController::class, 'blog']);
Route::get('about', [CompanyCRUDController::class, 'about']);
Route::get('login', [CompanyCRUDController::class, 'login']);
Route::get('/', [CompanyCRUDController::class, 'index']);

Route::resource('companies', CompanyCRUDController::class);



Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::post('getData', [CustomAuthController::class, 'getData'])->name('getData');
Route::post('getUpdateData', [CustomAuthController::class, 'getUpdateData'])->name('getUpdateData');

// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('admin/createData', [CustomAuthController::class, 'showData']);
Route::post('admin/createData', [CustomAuthController::class, 'createData'])->name('admin.createData');
Route::get('admin/updateData', [CustomAuthController::class, 'showUpdateData']);
Route::post('admin/updateData', [CustomAuthController::class, 'updateData'])->name('admin.updateData');
Route::get('admin/setyear', [CustomAuthController::class, 'setYear'])->name('admin.setyear');

// upload

Route::get('/image-upload', [FileUpload::class, 'createForm']);

Route::post('/image-upload', [FileUpload::class, 'fileUpload'])->name('imageUpload');


// test


Route::get('test', [CustomAuthController::class, 'test']);