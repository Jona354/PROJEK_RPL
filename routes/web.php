<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class,'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', [AuthController::class,'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('supplier', SupplierController::class);

    Route::resource('barang', BarangController::class);

});

Route::resource('barang', BarangController::class);



Route::get('/owner-area', function () {
    return "Halaman Owner";
})->middleware('role:owner');


