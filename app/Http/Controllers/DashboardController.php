<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\PermintaanBarang;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        // ====================
        // OWNER
        // ====================
        if ($role == 'owner') {

            $jumlahSupplier = Supplier::count();
            $totalBarang = Barang::count();
            $stokHabis = Barang::where('stok_saat_ini', 0)->count();

            $stokMenipis = Barang::where('stok_saat_ini', '>', 0)
                     ->where('stok_saat_ini', '<=', 10)
                     ->count();

$stokAman = Barang::where('stok_saat_ini', '>', 10)
                  ->count();

$barangKadaluarsa = Barang::where('tanggal_kadaluarsa', '<', now())
                          ->count();

return view('dashboard.owner', compact(
    'jumlahSupplier',
    'totalBarang',
    'stokHabis',
    'stokMenipis',
    'stokAman',
    'barangKadaluarsa'
));
        }

        // ====================
// ADMIN GUDANG
// ====================
elseif ($role == 'admin_gudang') {

    $jumlahSupplier = Supplier::count();

    $totalBarang = Barang::count();

    $stokHabis = Barang::where('stok_saat_ini', 0)
                       ->count();

    $stokMenipis = Barang::where('stok_saat_ini', '>', 0)
                         ->where('stok_saat_ini', '<=', 10)
                         ->count();

    $stokAman = Barang::where('stok_saat_ini', '>', 10)
                      ->count();

    $barangKadaluarsa = Barang::where(
        'tanggal_kadaluarsa',
        '<',
        now()
    )->count();

    return view('dashboard.admin', compact(
        'jumlahSupplier',
        'totalBarang',
        'stokHabis',
        'stokMenipis',
        'stokAman',
        'barangKadaluarsa',
    ));
}

        // ====================
// STAFF GUDANG
// ====================
elseif ($role == 'staff_gudang') {

    $barangMasuk = TransaksiMasuk::count();

    $barangKeluar = TransaksiKeluar::count();

    $permintaanPending = PermintaanBarang::where(
        'status',
        'pending'
    )->count();

    $totalTransaksi = $barangMasuk + $barangKeluar;

    return view('dashboard.staff', compact(
        'barangMasuk',
        'barangKeluar',
        'permintaanPending',
        'totalTransaksi'
    ));
}

        // ====================
        // CHEF
        // ====================
        elseif ($role == 'chef') {

    $permintaanSaya = PermintaanBarang::where(
        'requester_id',
        auth()->id()
    )->count();

    $permintaanPending = PermintaanBarang::where(
        'requester_id',
        auth()->id()
    )
    ->where('status', 'pending')
    ->count();

    $permintaanDisetujui = PermintaanBarang::where(
        'requester_id',
        auth()->id()
    )
    ->where('status', 'disetujui')
    ->count();

    $permintaanDitolak = PermintaanBarang::where(
        'requester_id',
        auth()->id()
    )
    ->where('status', 'ditolak')
    ->count();

    // Riwayat permintaan terbaru
    $permintaanTerbaru = PermintaanBarang::with('barang')
        ->where('requester_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.chef', compact(
        'permintaanSaya',
        'permintaanPending',
        'permintaanDisetujui',
        'permintaanDitolak',
        'permintaanTerbaru'
    ));
}

        // default
        return redirect('/login');
    }
}
