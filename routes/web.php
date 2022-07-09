<?php

use App\Http\Controllers\Users\RecipientController;
use App\Http\Controllers\Users\CalculationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.welcome');
});

/*
add: controllers
*/
Route::resource('recipients', RecipientController::class)
->middleware('auth:users')->except(['show']);
Route::resource('recipients', CalculationController::class)
->middleware('auth:users')->except(['show']);

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

require __DIR__.'/auth.php';
