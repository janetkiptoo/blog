<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoanProductController;



// Public pages
Route::get('/', function () {
    return view('web.home');
});

Route::get('/home', [App\Http\Controllers\WebController::class, 'home'])->name('web.home');
Route::get('/about', [App\Http\Controllers\WebController::class, 'about'])->name('web.about');
Route::get('/services', [App\Http\Controllers\WebController::class, 'services'])->name('web.services');
Route::get('/contact', [App\Http\Controllers\WebController::class, 'contact'])->name('web.contact');

Route::get('students/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::post('/students', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Student routes
    Route::middleware('verified')->name('student.')->prefix('student')->group(function () {

        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/repay_loan', [App\Http\Controllers\StudentController::class, 'repay_loan'])->name('repay_loan');
        });

        Route::prefix('loans')->name('loans.')->group(function () {
            Route::get('/products', [App\Http\Controllers\LoanProductController::class, 'index'])->name('index');
            Route::get('/products', [App\Http\Controllers\LoanProductController::class, 'index'])->name('products');
        });

        Route::get('/loan_products/{productId}/apply', [App\Http\Controllers\LoanApplicationController::class, 'index'])->name('loan.apply');
        Route::post('/loan_products/{productId}/apply', [App\Http\Controllers\LoanApplicationController::class, 'store'])->name('loan.store');
    });

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

  Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

   Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/loans', [AdminController::class, 'loans'])->name('loans');
        Route::post('/loans/{id}/approve', [AdminController::class, 'approve'])->name('loan.approve');
        Route::post('/loans/{id}/reject', [AdminController::class, 'reject'])->name('loan.reject');

        // USERS — resource controller ONLY
        Route::resource('users', UserController::class);
     
        Route::resource('loan-products', LoanProductController::class); 
        Route::get('/loan-products', [AdminController::class, 'products'])->name('loan-products');
        Route::post('/loan-products', [AdminController::class, 'storeLoanProduct'])->name('loan-products.store');
    });

        // Route::get('/users', [AdminController::class, 'users'])->name('users');
    });

require __DIR__.'/auth.php';
