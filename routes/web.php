<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeterHistoryController;

Route::get('/', function () {
    return redirect()->route('meter-histories.index');
});

// Import routes (must be before resource routes to avoid conflicts)
Route::get('/meter-histories/import', [MeterHistoryController::class, 'importForm'])->name('meter-histories.import');
Route::post('/meter-histories/import', [MeterHistoryController::class, 'import'])->name('meter-histories.import.store');

// Meter History Routes
Route::resource('meter-histories', MeterHistoryController::class);
