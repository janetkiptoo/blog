<?php

use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Route;

Route::post('/mpesa/stkpush', [MpesaController::class, 'STKPush'])
    ->name('mpesa.stkpush');
Route::post('/mpesa/callback', [MpesaController::class, 'callback'])

    ->name('mpesa.callback');   