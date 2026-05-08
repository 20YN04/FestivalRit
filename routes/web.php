<?php

use App\Http\Controllers\FestivalController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('festivals.index'));

Route::resource('festivals', FestivalController::class);
Route::resource('rides', RideController::class);
