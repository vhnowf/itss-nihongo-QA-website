<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
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
Route::post('send-mail-error', [HomeController::class, 'sendMailError'])->name('sendMailError');
Route::get('error-400', [HomeController::class, 'error400'])->name('error-400');
Route::get('error-500', [HomeController::class, 'error500'])->name('error-500');
