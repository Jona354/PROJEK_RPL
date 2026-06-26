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

// ============================
// Redirect awal
// ============================
Route::get('/', function () {
    return redirect('/login');
});

// ============================
// Authentication
// ============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ============================
// Dashboard (semua role)
// ============================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});


// ============================
// OWNER
// ============================
Route::middleware(['auth', 'role:owner'])->group(function () {
Route::get('/owner/laporan/index', [LaporanController::class, 'index'])->name('owner.laporan.index');
Route::get('/owner/laporan/export', [LaporanController::class, 'export'])->name('owner.laporan.export');
});


// ============================
// ADMIN GUDANG
// ============================
Route::middleware(['auth', 'role:admin_gudang'])->group(function () {

    // Master Barang
    Route::resource('barang', BarangController::class);

    // Supplier
    Route::resource('supplier', SupplierController::class);

    // User
    Route::get('/register', [RegisterController::class, 'index'])
        ->name('register');

    Route::get('/register/create', [RegisterController::class, 'create'])
        ->name('register.create');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/register/{id}/edit', [RegisterController::class, 'edit'])
    ->name('register.edit');

Route::put('/register/{id}', [RegisterController::class, 'update'])
    ->name('register.update');

Route::delete('/register/{id}', [RegisterController::class, 'destroy'])
    ->name('register.destroy');

    // Laporan
    Route::get('/admin/laporan/index', [LaporanController::class, 'index'])
        ->name('admin.laporan.index');

    Route::get('/admin/laporan/export', [LaporanController::class, 'export'])
        ->name('admin.laporan.export');
});


// ============================
// STAFF GUDANG
// ============================
Route::middleware(['auth', 'role:staff_gudang'])->group(function () {

    // Barang Masuk
    Route::resource('barang-masuk', TransaksiMasukController::class);

    // Barang Keluar
    Route::resource('barang-keluar', TransaksiKeluarController::class)
        ->only(['index', 'destroy']);

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
// STAFF GUDANG + CHEF
// ============================
Route::middleware(['auth', 'role:staff_gudang,chef'])->group(function () {

    // Daftar permintaan
    Route::get('/permintaan',
        [PermintaanController::class, 'index'])
        ->name('permintaan.index');

});


// ============================
// CHEF
// ============================
Route::middleware(['auth', 'role:chef'])->group(function () {

    // Form permintaan
    Route::get('/permintaan/create',
        [PermintaanController::class, 'create'])
        ->name('permintaan.create');

    // Simpan permintaan
    Route::post('/permintaan',
        [PermintaanController::class, 'store'])
        ->name('permintaan.store');

});
