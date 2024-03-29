<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CalculatorController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('calculator', CalculatorController::class)->only(['index', 'store']);
