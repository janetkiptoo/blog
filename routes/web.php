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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/students/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::post('/students', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
