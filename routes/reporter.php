<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reporter\LostItemsController;
use App\Http\Controllers\Reporter\CrimeController;
use App\Http\Controllers\Reporter\NotificationController;

Route::middleware('reporter')->group(function(){
    Route::get('lost items',[LostItemsController::class,'index'])
    ->name('reporter.report.lost.items');

    Route::get('view lost items',[LostItemsController::class,'show'])
    ->name('reporter.view.lost.items');

    Route::get('report crime',[CrimeController::class,'index'])
    ->name('reporter.report.crime');

    Route::get('view most wanted',[CrimeController::class,'show'])
    ->name('reporter.view.most.wanted');

    Route::get('notifications',[NotificationController::class,'index'])
    ->name('reporter.notifications');

    
});
