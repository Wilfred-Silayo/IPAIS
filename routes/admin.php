<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function(){

    Route::get('manage/users/reporters', [UserController::class,'index'])
    ->name('manage.users');

    Route::get('manage/users/officers', [UserController::class,'show'])
    ->name('manage.users.officers');

    Route::get('register/officer', [UserController::class,'create'])
    ->name('create.officer');

    Route::post('register/officer', [UserController::class, 'store'])
    ->name('register.officer.store');

    Route::get('search/users',[UserController::class,'search'])
    ->name('search.user');

    Route::delete('destroy/users/{email}',[UserController::class,'destroy'])
    ->name('destroy.user');

});