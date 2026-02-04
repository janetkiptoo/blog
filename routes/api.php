<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;

Route::post('/mpesa/callback', [MpesaController::class, 'callback']);  
Route::post('/mpesa/b2c/result', [MpesaController::class, 'b2cResult']);
Route::post('/mpesa/b2c/timeout', [MpesaController::class, 'b2cTimeout']);
