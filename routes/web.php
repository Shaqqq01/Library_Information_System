<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for VolunteerController with role middleware for supervisors
    Route::middleware(['role:supervisor'])->group(function () {
        Route::resource('volunteers', VolunteerController::class);
    });

    // Routes for books accessible to volunteers
    Route::middleware(['role:volunteer'])->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('members', MemberController::class);
        Route::resource('borrow-records', BorrowRecordController::class);
        Route::get('/borrow-records/createLoan', [BorrowRecordController::class, 'createLoan'])->name('borrow-records.createLoan');
        Route::post('/borrow-records/storeLoan', [BorrowRecordController::class, 'storeLoan'])->name('borrow-records.storeLoan');
    });
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
