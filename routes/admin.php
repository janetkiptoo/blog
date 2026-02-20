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
use App\Http\Controllers\AdminPersonalProfileController;
use App\Http\Controllers\AdminAcademicProfileController;
use App\Http\Controllers\Admin\AdminCashPaymentController;
use App\Http\Controllers\Admin\SupportReplyController;
use App\Http\Controllers\Admin\SupportTicketController;

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

    Route::resource('payment-methods', PaymentMethodController::class);
    Route::post('/loans/{id}/disburse', [LoanController::class, 'disburse'])->name('loan.disburse');

    Route::get('/cash-payments', [AdminCashPaymentController::class, 'index'])->name('cash-payments.index');
    Route::post('/cash-payments/{id}/approve', [AdminCashPaymentController::class, 'approve'])->name('cash-payments.approve');
    Route::post('/cash-payments/{id}/reject', [AdminCashPaymentController::class, 'reject'])->name('cash-payments.reject');

         
    Route::get('/support-tickets', [SupportTicketController::class, 'index'])->name('support-tickets.index');
    Route::get('/support-tickets/{ticket}', [SupportTicketController::class, 'show'])->name('support-tickets.show');
    Route::post('/support-tickets/{ticket}/reply', [SupportReplyController::class, 'store'])->name('support-tickets.reply');

    
    Route::get('/users/{user}/guarantors',[AdminGuarantorController::class, 'index'])->name('guarantors.index');
    Route::get('/guarantors/{guarantor}',[AdminGuarantorController::class, 'show'])->name('guarantors.show');

    Route::post('/guarantors/{guarantor}/approve', [AdminGuarantorController::class, 'approve'])->name('guarantors.approve');
    Route::post('/guarantors/{guarantor}/reject', [AdminGuarantorController::class, 'reject'])->name('guarantors.reject');

   Route::get('/personal-profiles/{personalProfile}', [AdminPersonalProfileController::class, 'show'])->name('personal-profiles.show');
   Route::post('/personal-profiles/{personalProfile}/approve', [AdminPersonalProfileController::class, 'approve'])->name('personal-profiles.approve');
    Route::post('/personal-profiles/{personalProfile}/reject', [AdminPersonalProfileController::class, 'reject'])->name('personal-profiles.reject');

    Route::get('/academic-profiles/{academicProfile}',[AdminAcademicProfileController::class, 'show'] )->name('academic-profiles.show');
    Route::post('/academic-profiles/{academicProfile}/approve',[AdminAcademicProfileController::class, 'approve'])->name('academic-profiles.approve');
    Route::post('/academic-profiles/{academicProfile}/reject',[AdminAcademicProfileController::class, 'reject'] )->name('academic-profiles.reject');



});
