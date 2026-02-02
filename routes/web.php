<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'home'])->name('web.home');
Route::get('/home', [WebController::class, 'home']);
Route::get('/about', [WebController::class, 'about'])->name('web.about');
Route::get('/services', [WebController::class, 'services'])->name('web.services');
Route::get('/contact', [WebController::class, 'contact'])->name('web.contact');
Route::post('/payments/mpesa', [MpesaController::class, 'stkPush'])->middleware('auth')->name('mpesa.stkpush');






Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});


require __DIR__.'/admin.php';
require __DIR__.'/student.php';
require __DIR__.'/auth.php';

