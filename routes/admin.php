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
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\AdminCashPaymentController;

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

    Route::get('/cash-payments', [AdminCashPaymentController::class, 'index'])->name('cash-payments.index');
    Route::post('/cash-payments/{id}/approve', [AdminCashPaymentController::class, 'approve'])->name('cash-payments.approve');
    Route::post('/cash-payments/{id}/reject', [AdminCashPaymentController::class, 'reject'])->name('cash-payments.reject');

     Route::post('/support-tickets',[SupportReplyController::class, 'index'])->name('support.index');
    Route::post('/support-tickets/{ticket}/reply',[SupportReplyController::class, 'store'])->name('support.reply');




});
