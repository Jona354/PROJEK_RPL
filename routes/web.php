<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// Redirect awal
Route::get('/', function () {
    return redirect('/login');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// ============================
// DASHBOARD (Semua role)
// ============================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});


// ============================
// OWNER
// ============================
Route::middleware(['auth', 'role:owner'])->group(function () {

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('owner.laporan');

});


// ============================
// ADMIN GUDANG
// ============================
Route::middleware(['auth', 'role:admin_gudang'])->group(function () {

    // Data Barang (Master Data)
    Route::resource('barang', BarangController::class);

    // Data Supplier
    Route::resource('supplier', SupplierController::class);

    // Kelola User
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store']);

    // Laporan
    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/admin/laporan/export', [LaporanController::class, 'export'])
        ->name('laporan.export');

});


// ============================
// STAFF GUDANG
// ============================
Route::middleware(['auth', 'role:staff_gudang'])->group(function () {

    // Barang Masuk
    Route::resource('barang-masuk', TransaksiMasukController::class);

    // Barang Keluar
    Route::resource('barang-keluar', TransaksiKeluarController::class);

    // Melihat daftar permintaan dari chef
    Route::get('/permintaan', [PermintaanController::class, 'index'])
        ->name('permintaan.index');

    // Approve permintaan
    Route::post('/permintaan/{id}/approve',
        [PermintaanController::class, 'approve'])
        ->name('permintaan.approve');

    // Reject permintaan
    Route::post('/permintaan/{id}/reject',
        [PermintaanController::class, 'reject'])
        ->name('permintaan.reject');

});


// ============================
// CHEF
// ============================
Route::middleware(['auth', 'role:chef'])->group(function () {

    // Halaman membuat permintaan
    Route::get('/permintaan/create',
        [PermintaanController::class, 'create'])
        ->name('permintaan.create');

    // Simpan permintaan
    Route::post('/permintaan',
        [PermintaanController::class, 'store'])
        ->name('permintaan.store');

});
