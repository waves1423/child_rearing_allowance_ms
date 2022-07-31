<?php

use App\Http\Controllers\User\RecipientController;
use App\Http\Controllers\User\SpouseController;
use App\Http\Controllers\User\ObligorController;
use App\Http\Controllers\User\RecipientCalculationController;
use App\Http\Controllers\User\SpouseCalculationController;
use App\Http\Controllers\User\ObligorCalculationController;
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

Route::get('/', [RecipientController::class, 'index']);

Route::resource('recipients', RecipientController::class)
->middleware('auth:users');

Route::resource('recipients.spouses', SpouseController::class)
->middleware('auth:users')
->except(['index', 'show']);

Route::resource('recipients.obligors', ObligorController::class)
->middleware('auth:users')
->except(['index', 'show']);

Route::resource('recipients.calculations', RecipientCalculationController::class)
->middleware('auth:users')
->except(['index', 'show']);

Route::resource('recipients.spouses.calculations', SpouseCalculationController::class)
->middleware('auth:users')
->except(['index', 'show']);

Route::resource('recipients.obligors.calculations', ObligorCalculationController::class)
->middleware('auth:users')
->except(['index', 'show']);

require __DIR__.'/auth.php';
