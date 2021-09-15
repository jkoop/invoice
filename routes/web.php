<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;

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

Route::get('/', [C\DashboardController::class, 'view'])->name('dashboard');

Route::get('/invoice', [C\InvoiceController::class, 'list'])->name('invoice');
Route::get('/invoice/{invoice}', [C\InvoiceController::class, 'view']);

Route::get('/payment', [C\PaymentController::class, 'list'])->name('payment');
Route::get('/payment/{payment}', [C\PaymentController::class, 'view']);

Route::get('/credit', [C\CreditController::class, 'list'])->name('credit');
Route::get('/credit/{credit}', [C\CreditController::class, 'view']);

Route::get('/client', [C\ClientController::class, 'list'])->name('client');
Route::get('/client/{client}', [C\ClientController::class, 'view']);

Route::get('/setting', [C\SettingController::class, 'list'])->name('setting');
Route::get('/setting/my-address', [C\SettingController::class, 'viewMyAddress'])->name('setting.myAddress');
Route::get('/setting/email', [C\SettingController::class, 'viewEmail'])->name('setting.email');
Route::get('/setting/locale', [C\SettingController::class, 'viewLocale'])->name('setting.locale');
Route::get('/setting/database', [C\SettingController::class, 'viewDatabase'])->name('setting.database');
