<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebpayController;

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

Route::get('/', [WebpayController::class, 'index'])->name('webpay.plus.index');
Route::post('webpay/plus/init', [WebpayController::class, 'init'])->name('webpay.plus.init');
Route::post('webpay/plus/response', [WebpayController::class, 'response'])->name('webpay.plus.response');
Route::post('webpay/plus/finish', [WebpayController::class, 'finish'])->name('webpay.plus.finish');