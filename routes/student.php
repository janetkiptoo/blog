<?php

use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ImageController;


use Illuminate\Support\Facades\Route;

  Route::middleware(['auth', 'verified', 'student'])->name('student.')->prefix('student')->group(function () {

    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/store', [StudentController::class, 'store'])->name('store');

    Route::get('/loans', [StudentController::class, 'myLoans'])->name('loans.index');
    Route::get('/loans/{id}/repay', [LoanApplicationController::class, 'showRepayForm'])->name('loans.repay');
   
    Route::post('/loans/{id}/repay', [LoanApplicationController::class, 'process_repayment'])->name('loans.process_repayment');

    Route::get('/loans/products', [LoanProductController::class, 'index'])->name('loans.products');

    Route::get('/loan_products/{productId}/apply', [LoanApplicationController::class, 'index'])->name('loan.apply');
    Route::post('/loan_products/{productId}/apply', [LoanApplicationController::class, 'store'])->name('loan.store');

   
    

    
});

