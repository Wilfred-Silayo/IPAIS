<?php

use App\Http\Controllers\FoundItemsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reporter\LostItemsController;
use App\Http\Controllers\Reporter\CrimeController;
use App\Http\Controllers\Reporter\NotificationController;

Route::middleware('reporter')->group(function(){
    Route::get('lost/items',[LostItemsController::class,'index'])
    ->name('reporter.report.lost.items');

    Route::get('report/lost/items/create',[LostItemsController::class,'create'])
    ->name('reporter.create.lost.items');

    Route::post('report/lost/items/store',[LostItemsController::class,'store'])
    ->name('reporter.store.lost.items');

    Route::get('view/lost/items',[LostItemsController::class,'show'])
    ->name('reporter.view.lost.items');

    Route::get('search/lost/items',[LostItemsController::class,'search'])
    ->name('search.lost.item');

    Route::get('edit/lost/items/{id}',[LostItemsController::class,'edit'])
    ->name('edit.lost.item');

    Route::delete('delete/lost/items/{id}', [LostItemsController::class, 'destroy'])
    ->name('delete.lost.item');

    Route::get('report/crime',[CrimeController::class,'index'])
    ->name('reporter.report.crime');

    Route::get('report/crimes/create',[CrimeController::class,'create'])
    ->name('reporter.create.crimes');

    Route::post('report/crime/store',[CrimeController::class,'store'])
    ->name('reporter.store.crimes');

    Route::delete('delete/crimes/{id}', [CrimeController::class, 'destroy'])
    ->name('delete.crime');

    Route::get('view/most/wanted',[CrimeController::class,'mostWanted'])
    ->name('reporter.view.most.wanted');

    Route::get('search/most/wanted',[CrimeController::class,'searchMostWanted'])
    ->name('search.most.wanted');

    Route::get('search/crimes',[CrimeController::class,'search'])
    ->name('search.crime');
    
    Route::get('found/items',[FoundItemsController::class,'index'])
    ->name('reporter.view.found.items');

    Route::get('search/found/items',[FoundItemsController::class,'search'])
    ->name('search.found.items');
    
});
