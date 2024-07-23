<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\CrimeController;
use App\Http\Controllers\Admin\LostItemsController;
use App\Http\Controllers\Admin\MostWantedController;
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

    Route::get('x/reports/lost/items', [LostItemsController::class,'index'])
    ->name('admin.reports.lost.items');

    Route::get('x/reports/crime', [CrimeController::class,'index'])
    ->name('admin.reports.crime');

    Route::get('x/report/crimes/create',[CrimeController::class,'create'])
    ->name('admin.create.crimes');

    Route::post('x/report/crime/store',[CrimeController::class,'store'])
    ->name('admin.store.crimes');

    Route::get('x/reports/most/wanted', [MostWantedController::class,'index'])
    ->name('admin.reports.most.wanted');

    Route::post('x/crime/solve/{id}', [CrimeController::class, 'markAsSolved'])
    ->name('admin.crime.resolve');

    Route::post('x/lost/item/solve/{id}', [LostItemsController::class, 'markAsSolved'])
    ->name('admin.lost.item.resolve');

    Route::get('x/search/crimes',[CrimeController::class,'search'])
    ->name('admin.search.crime');

    Route::get('x/search/most/wanted',[CrimeController::class,'searchMostWanted'])
    ->name('admin.search.mostwanted');

    Route::get('x/search/lost/items',[LostItemsController::class,'search'])
    ->name('admin.search.lost.item');

    Route::get('x/comments/{id}',[CommentController::class,'show'])
    ->name('admin.comments.list');

    Route::get('x/comments/mostwanted/{id}',[CommentController::class,'showMostWanted'])
    ->name('admin.comments.mostwanted.list');

});