<?php

use App\Http\Controllers\Officer\CrimeController;
use App\Http\Controllers\Officer\LostItemsController;
use Illuminate\Support\Facades\Route;

Route::prefix('officer')->middleware('officer')->group(function(){

    Route::get('reports/lost/items', [LostItemsController::class,'index'])
    ->name('officer.reports.lost.items');

    Route::get('reports/crime', [CrimeController::class,'index'])
    ->name('officer.reports.crime');

    Route::get('reports/most/wanted', [CrimeController::class,'show'])
    ->name('officer.reports.most.wanted');

    Route::post('crime/solve/{id}', [CrimeController::class, 'markAsSolved'])
    ->name('crime.resolve');

    Route::get('search/crimes',[CrimeController::class,'search'])
    ->name('officer.search.crime');

    Route::get('search/most/wanted',[CrimeController::class,'searchMostWanted'])
    ->name('officer.search.mostwanted');

});