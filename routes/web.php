<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', function () {
return view('dashboard');
})->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Routes for VolunteerController with role middleware
Route::middleware('role:supervisor')->group(function () {
Route::resource('volunteers', VolunteerController::class);
});

// Routes for BookController
Route::resource('books', BookController::class);

// Routes for MemberController
Route::resource('members', MemberController::class);

// Routes for BorrowRecordController
Route::resource('borrow-records', BorrowRecordController::class);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/mainpage', function () {
    return view('mainpage');
})->name('all.routes');

require __DIR__.'/auth.php';
