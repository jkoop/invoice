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
Route::get('/invoice/{invoice}', [C\InvoiceController::class, 'view'])->name('invoice.byId');

Route::get('/payment', [C\PaymentController::class, 'list'])->name('payment');
Route::get('/payment/{payment}', [C\PaymentController::class, 'view'])->name('payment.byId');

Route::get('/credit', [C\CreditController::class, 'list'])->name('credit');
Route::get('/credit/{credit}', [C\CreditController::class, 'view'])->name('credit.byId');

Route::get('/client', [C\ClientController::class, 'list'])->name('client');
Route::get('/client/{client}', [C\ClientController::class, 'view'])->name('client.byId');

Route::get('/setting', [C\SettingController::class, 'list'])->name('setting');
Route::get('/setting/contact-info', [C\SettingController::class, 'viewContactInfo'])->name('setting.contactInfo');
Route::post('/setting/contact-info', [C\SettingController::class, 'updateContactInfo'])->name('setting.contactInfo.update');
// Route::get('/setting/email', [C\SettingController::class, 'viewEmail'])->name('setting.email');
Route::get('/setting/locale', [C\SettingController::class, 'viewLocale'])->name('setting.locale');
Route::post('/setting/locale', [C\SettingController::class, 'updateLocale'])->name('setting.locale.update');
