<?php

use App\Http\Controllers\Officer\CrimeController;
use App\Http\Controllers\Officer\LostItemsController;
use App\Http\Controllers\Officer\MostWantedController;
use Illuminate\Support\Facades\Route;

Route::prefix('officer')->middleware('officer')->group(function(){

    Route::get('reports/lost/items', [LostItemsController::class,'index'])
    ->name('officer.reports.lost.items');

    Route::get('reports/crime', [CrimeController::class,'index'])
    ->name('officer.reports.crime');

    Route::get('reports/most/wanted', [MostWantedController::class,'index'])
    ->name('officer.reports.most.wanted');

    Route::get('notifications', [MostWantedController::class,'index'])
    ->name('officer.notifications');

});