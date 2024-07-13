<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('notifications',[NotificationController::class,'index'])
    ->name('notifications');

    Route::post('notifications',[NotificationController::class,'store'])
    ->name('notifications.store');
});