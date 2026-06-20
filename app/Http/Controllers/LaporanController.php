<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PermintaanBarang;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // =====================
        // Barang Masuk
        // =====================
        $barangMasuk = TransaksiMasuk::with(['barang', 'supplier'])
            ->latest();

        // =====================
        // Barang Keluar
        // =====================
        $barangKeluar = TransaksiKeluar::with('barang')
            ->latest();

        // =====================
        // Permintaan Barang
        // =====================
        $permintaan = PermintaanBarang::with(['requester', 'barang'])
            ->latest();

        // =====================
        // Filter tanggal
        // =====================
        if (
            $request->filled('start_date') &&
            $request->filled('end_date')
        ) {

            $barangMasuk->whereBetween(
                'tanggal',
                [
                    $request->start_date,
                    $request->end_date
                ]
            );

            $barangKeluar->whereBetween(
                'tanggal',
                [
                    $request->start_date,
                    $request->end_date
                ]
            );

            $permintaan->whereBetween(
                'created_at',
                [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ]
            );
        }

        // =====================
        // Ambil data
        // =====================
        $barangMasuk = $barangMasuk->get();

        $barangKeluar = $barangKeluar->get();

        $permintaans = $permintaan->get();

        // =====================
        // Statistik Dashboard
        // =====================
        $totalMasuk = TransaksiMasuk::count();

        $totalKeluar = TransaksiKeluar::count();

        $totalPermintaan = PermintaanBarang::count();

        $totalBarang = Barang::count();

        return view(
            'admin.laporan.index',
            compact(
                'barangMasuk',
                'barangKeluar',
                'permintaans',
                'totalMasuk',
                'totalKeluar',
                'totalPermintaan',
                'totalBarang'
            )
        );
    }
}
