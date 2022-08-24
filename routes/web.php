<?php

use App\Http\Controllers\Transaction;
use App\Http\Controllers\Users\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\Airtime;
use App\Http\Controllers\Users\Electricity;
use App\Http\Controllers\Users\Transaction as UsersTransaction;

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
    return view('Users.main.content');
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/user/topup', [App\Http\Controllers\Users\TopUp::class, 'index']);
Route::get('/user/topup/verify-payment/{reference}', [App\Http\Controllers\Users\TopUp::class, 'verify']);
Route::get('/user/data', [App\Http\Controllers\Users\Data::class, 'index']);
Route::get('vtu', [App\Http\Controllers\Users\Data::class, 'vtu']);
Route::post('/user/data/network', [Data::class, 'data']);
Route::post('/buy-data', [Data::class, 'buyData']);
Route::get('/user/airtime', [Airtime::class, 'index']);
Route::post('/buy-airtime', [Airtime::class, 'buyAirtime']);
Route::get('/user/all-transaction', [UsersTransaction::class, 'index']);
Route::get('/user/electricity', [Electricity::class, 'index']);

