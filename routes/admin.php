<?php

use App\Http\Controllers\Admin\LoanProductController as AdminLoanProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRepaymentController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGuarantorController;
use App\Http\Controllers\AdminTermsController;
use App\Http\Controllers\Admin\PaymentMethodController;
Use App\Http\Controllers\Admin\LoanController;

use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/loans', [AdminController::class, 'loans'])->name('loans');
    Route::get('/loans', [AdminController::class, 'index'])->name('loans');
    Route::post('/loans/{id}/approve', [AdminController::class, 'approve'])->name('loan.approve');
    Route::post('/loans/{id}/reject', [AdminController::class, 'reject'])->name('loan.reject');

    Route::resource('users', UserController::class);

    Route::resource('loan-products', AdminLoanProductController::class);
    Route::resource('terms', AdminTermsController::class);

    Route::get('/repayments', [AdminRepaymentController::class, 'index'])->name('repayments.index');

    Route::get('/loans/{loan}/repayments', [AdminRepaymentController::class, 'show'])->name('repayments.show');
    Route::get('/loans/{loan}/guarantors', [AdminGuarantorController::class, 'index'])->name('loans.guarantors');
    Route::resource('payment-methods', PaymentMethodController::class);
    Route::post('/loans/{id}/disburse', [LoanController::class, 'disburse'])->name('loan.disburse');

   


});
