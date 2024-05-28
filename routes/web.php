<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Welcome Routes
*/
Route::middleware('guest')->group(function(){
    Route::get('/',[WelcomeController::class,'popular'])
    ->name('welcome.popular');

    Route::get('welcome found items',[WelcomeController::class,'foundItems'])
    ->name('welcome.found.items');

    Route::get('welcome lost items',[WelcomeController::class,'lostItems'])
    ->name('welcome.lost.items');

});


require __DIR__.'/auth.php';
require __DIR__.'/reporter.php';
require __DIR__.'/officer.php';
require __DIR__.'/admin.php';
require __DIR__.'/profile.php';
require __DIR__.'/notifications.php';
