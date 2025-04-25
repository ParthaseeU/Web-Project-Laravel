<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('authentication', ['page' => 'authentication']);
})->middleware('guest')->name('authentication');

Route::get('/dashboard', function () {
    return view('dashboard', ['page' => 'dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/account', function () {
//     return view('account', ['page' => 'accout']);
// })->middleware(['auth', 'verified'])->name('account');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
