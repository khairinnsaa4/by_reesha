<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Midtrans Payment Gateway Webhook Callback
|--------------------------------------------------------------------------
| Endpoint ini menerima notifikasi webhook dari server Midtrans (HTTP POST)
| ketika pelanggan telah menyelesaikan pembayaran QRIS / e-Wallet.
*/
Route::post('/midtrans-callback', [\App\Http\Controllers\MidtransController::class, 'handleNotification']);

