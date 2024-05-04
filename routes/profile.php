<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::middleware('auth')->group(function(){
    Route::get('profile',[ProfileController::class,'index'])
    ->name('profile.settings');

    Route::get('profile/edit',[ProfileController::class,'edit'])
    ->name('profile.edit');

    Route::put('profile/update',[ProfileController::class,'update'])
    ->name('profile.update');
});