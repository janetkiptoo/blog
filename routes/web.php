<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.home');
});
Route::get('/home', [App\Http\Controllers\WebController::class, 'home'])->name('web.home');
Route::get('/about', [App\Http\Controllers\WebController::class, 'about'])->name('web.about');
Route::get('/services', [App\Http\Controllers\WebController::class, 'services'])->name('web.services');
Route::get('/contact', [App\Http\Controllers\WebController::class, 'contact'])->name('web.contact');

Route::middleware('auth')->group(function () {

    Route::middleware('verified')->name('admin.')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('create');
            Route::post('', [App\Http\Controllers\StudentController::class, 'store'])->name('store');
            Route::get('/apply', [App\Http\Controllers\ApplicationController::class, 'create'])->name('apply');
            Route::post('/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('apply.store');
            Route::get('/repay_loan', [App\Http\Controllers\StudentController::class, 'repay_loan'])->name('repay_loan');
        });
        Route::prefix('loans')->name('loans.')->group(function () {
            Route::get('/products', [App\Http\Controllers\LoanProductController::class, 'index'])->name('index');
            Route::get('/products', [App\Http\Controllers\LoanProductController::class, 'index'])->name('products');
        });
        Route::get('/loan_products/{productId}/apply', [App\Http\Controllers\LoanApplicationController::class, 'index'])->name('loan.apply');
        Route::post('/loan_products/{productId}/apply', [App\Http\Controllers\LoanApplicationController::class, 'store'])->name('loan.store');
    });
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
