<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiMasukController; 
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PermintaanController;
use Illuminate\Support\Facades\Route;

// Redirect awal
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('supplier', SupplierController::class);

    Route::resource('barang', BarangController::class);


    Route::resource('barang-masuk', TransaksiMasukController::class);
    Route::resource('barang-keluar', TransaksiKeluarController::class);
    Route::delete('/barang-keluar/{id}', [App\Http\Controllers\TransaksiKeluarController::class, 'destroy'])
    ->name('barang-keluar.destroy');

    // Tambahkan ini di dalam group middleware('auth')
    Route::get('/permintaan', [App\Http\Controllers\PermintaanController::class, 'index'])
    ->name('permintaan.index');


    });

Route::middleware(['auth', 'role:admin,admin_gudang'])->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/admin/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/admin/laporan/export', [App\Http\Controllers\LaporanController::class, 'export'])->name('laporan.export');
});

Route::middleware(['auth', 'role:chef'])->post('/permintaan', [PermintaanController::class, 'store']);
Route::middleware(['auth', 'role:admin'])->patch('/permintaan/{id}/approve', [PermintaanController::class, 'approve']);

Route::get('/permintaan/create', [PermintaanController::class, 'create'])->name('permintaan.create');
Route::post('/permintaan', [PermintaanController::class, 'store'])->name('permintaan.store');
Route::post('/permintaan/{id}/approve', [PermintaanController::class, 'approve'])->name('permintaan.approve');

Route::get('/owner-area', function () {
    return "Halaman Owner";
    })->middleware('role:owner');

Route::post('/permintaan/{id}/approve', [PermintaanController::class, 'approve'])
    ->name('permintaan.approve');

Route::post('/permintaan/{id}/reject', [PermintaanController::class, 'reject'])
    ->name('permintaan.reject');
