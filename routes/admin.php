<?php

use App\Http\Controllers\Admin\LoanProductController as AdminLoanProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminRepaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'home'])->name('web.home');
Route::get('/home', [WebController::class, 'home']);
Route::get('/about', [WebController::class, 'about'])->name('web.about');
Route::get('/services', [WebController::class, 'services'])->name('web.services');
Route::get('/contact', [WebController::class, 'contact'])->name('web.contact');

   Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/loans', [AdminController::class, 'loans'])->name('loans');
    Route::post('/loans/{id}/approve', [AdminController::class, 'approve'])->name('loan.approve');
    Route::post('/loans/{id}/reject', [AdminController::class, 'reject'])->name('loan.reject');

    Route::resource('users', UserController::class);

    Route::resource('loan-products', AdminLoanProductController::class);

    Route::get('/repayments', [AdminRepaymentController::class, 'index']) ->name('repayments.index');

    Route::get('/loans/{loan}/repayments', [AdminRepaymentController::class, 'show'])->name('repayments.show');

});

