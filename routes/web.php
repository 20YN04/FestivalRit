<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('festivals.index'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:6,1');

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:6,1');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Authenticated writes — registered FIRST so /festivals/create matches before /festivals/{festival}
Route::middleware('auth')->group(function () {
    Route::resource('festivals', FestivalController::class)->except(['index', 'show']);
    Route::resource('rides', RideController::class)->except(['index', 'show']);
});

// Public reads
Route::resource('festivals', FestivalController::class)->only(['index', 'show']);
Route::resource('rides', RideController::class)->only(['index', 'show']);
