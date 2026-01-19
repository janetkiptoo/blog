<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoanProductController as AdminLoanProductController;



Route::get('/', [WebController::class, 'home'])->name('web.home');
Route::get('/home', [WebController::class, 'home']);
Route::get('/about', [WebController::class, 'about'])->name('web.about');
Route::get('/services', [WebController::class, 'services'])->name('web.services');
Route::get('/contact', [WebController::class, 'contact'])->name('web.contact');


Route::middleware('auth')->group(function () {

  
    Route::middleware('verified')->name('student.')->prefix('student')->group(function () {

    
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

        
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        
         Route::get('/loans', [StudentController::class, 'myLoans']) ->name('loans.index');
        Route::get('/loans/{id}/repay', [LoanApplicationController::class, 'showRepayForm'])->name('loans.repay');
        Route::get('/loans/{id}/repay', [StudentController::class, 'repayLoan'])->name('loans.repay');
       Route::post('/loans/{id}/repay', [StudentController::class, 'process_repayment'])->name('loans.process_repayment')->middleware('auth');

        
        Route::get('/loans/products', [LoanProductController::class, 'index'])->name('loans.products');

        
        Route::get('/loan_products/{productId}/apply', [LoanApplicationController::class, 'index'])->name('loan.apply');
        Route::post('/loan_products/{productId}/apply', [LoanApplicationController::class, 'store'])->name('loan.store');
    });
    


    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

   
   
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        
        Route::get('/loans', [AdminController::class, 'loans'])->name('loans');
        Route::post('/loans/{id}/approve', [AdminController::class, 'approve'])->name('loan.approve');
        Route::post('/loans/{id}/reject', [AdminController::class, 'reject'])->name('loan.reject');

        Route::resource('users', UserController::class);

    
        Route::resource('loan-products', AdminLoanProductController::class);
    });
});

require __DIR__.'/auth.php';
