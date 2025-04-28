<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('authentication', ['page' => 'authentication']);
})->middleware('guest')->name('authentication');

Route::get('/dashboard', [UserManagementController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Optional Account route (currently commented out)
 // Route::get('/account', function () {
 //     return view('account', ['page' => 'account']);
 // })->middleware(['auth', 'verified'])->name('account');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, etc.)
require __DIR__ . '/auth.php';
