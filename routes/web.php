<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class,'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', [AuthController::class,'logout']);

Route::get('/dashboard', [DashboardController::class,'index']);

Route::get('/owner-area', function () {
    return "Halaman Owner";
})->middleware('role:owner');