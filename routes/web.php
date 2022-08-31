<?php

use App\Http\Controllers\User\RecipientController;
use App\Http\Controllers\User\SpouseController;
use App\Http\Controllers\User\ObligorController;
use App\Http\Controllers\User\Calculation\RecipientCalculationController;
use App\Http\Controllers\User\Calculation\SpouseCalculationController;
use App\Http\Controllers\User\Calculation\ObligorCalculationController;
use App\Http\Controllers\User\SpecialRecipientController;
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
->except(['destroy']);

Route::resource('special_recipients', SpecialRecipientController::class)
->only(['index']);

Route::resource('recipients.spouses', SpouseController::class)
->except(['index', 'show', 'destroy']);

Route::resource('recipients.obligors', ObligorController::class)
->except(['index', 'show', 'destroy']);

Route::resource('recipients.calculations', RecipientCalculationController::class)
->except(['index', 'show', 'destroy']);

Route::resource('recipients.spouses.calculations', SpouseCalculationController::class)
->except(['index', 'show', 'destroy']);

Route::resource('recipients.obligors.calculations', ObligorCalculationController::class)
->except(['index', 'show', 'destroy']);

require __DIR__.'/auth.php';
