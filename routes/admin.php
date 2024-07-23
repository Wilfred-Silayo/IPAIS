<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Officer\CrimeController;
use App\Http\Controllers\Officer\LostItemsController;
use App\Http\Controllers\Officer\MostWantedController;
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

    Route::get('reports/lost/items', [LostItemsController::class,'index'])
    ->name('officer.reports.lost.items');

    Route::get('reports/crime', [CrimeController::class,'index'])
    ->name('officer.reports.crime');

    Route::get('report/crimes/create',[CrimeController::class,'create'])
    ->name('officer.create.crimes');

    Route::post('report/crime/store',[CrimeController::class,'store'])
    ->name('officer.store.crimes');

    Route::get('reports/most/wanted', [MostWantedController::class,'index'])
    ->name('officer.reports.most.wanted');

    Route::post('crime/solve/{id}', [CrimeController::class, 'markAsSolved'])
    ->name('crime.resolve');

    Route::post('lost/item/solve/{id}', [LostItemsController::class, 'markAsSolved'])
    ->name('lost.item.resolve');

    Route::get('search/crimes',[CrimeController::class,'search'])
    ->name('officer.search.crime');

    Route::get('search/most/wanted',[CrimeController::class,'searchMostWanted'])
    ->name('officer.search.mostwanted');

    Route::get('search/lost/items',[LostItemsController::class,'search'])
    ->name('officer.search.lost.item');

    Route::get('comments/{id}',[CommentController::class,'show'])
    ->name('comments.list');

    Route::get('comments/mostwanted/{id}',[CommentController::class,'showMostWanted'])
    ->name('comments.mostwanted.list');

});