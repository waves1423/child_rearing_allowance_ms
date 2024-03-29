<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RecipientController;
use App\Http\Controllers\Admin\SpouseController;
use App\Http\Controllers\Admin\ObligorController;
use App\Http\Controllers\Admin\Calculation\RecipientCalculationController;
use App\Http\Controllers\Admin\Calculation\SpouseCalculationController;
use App\Http\Controllers\Admin\Calculation\ObligorCalculationController;
use App\Http\Controllers\Admin\FunctionController;
use App\Http\Controllers\Admin\SpecialRecipientController;
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

Route::get('/functions', [FunctionController::class, 'index'])
->middleware('auth:admin')
->name('functions.index');

Route::get('/functions/downloadCsv', [FunctionController::class, 'downloadCsv'])
->middleware('auth:admin')
->name('functions.downloadCsv');

Route::resource('users', UserController::class)
->middleware('auth:admin')
->except(['show']);

Route::resource('recipients', RecipientController::class)
->middleware('auth:admin');

Route::resource('special_recipients', SpecialRecipientController::class)
->middleware('auth:admin')
->only(['index']);

Route::resource('recipients.spouses', SpouseController::class)
->middleware('auth:admin')
->except(['index', 'show']);

Route::resource('recipients.obligors', ObligorController::class)
->middleware('auth:admin')
->except(['index', 'show']);

Route::resource('recipients.calculations', RecipientCalculationController::class)
->middleware('auth:admin')
->except(['index', 'show']);

Route::resource('recipients.spouses.calculations', SpouseCalculationController::class)
->middleware('auth:admin')
->except(['index', 'show']);

Route::resource('recipients.obligors.calculations', ObligorCalculationController::class)
->middleware('auth:admin')
->except(['index', 'show']);

Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.update');

Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
