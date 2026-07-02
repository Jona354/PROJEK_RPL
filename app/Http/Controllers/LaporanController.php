<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PermintaanBarang;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Deteksi role user untuk mengarahkan ke view yang tepat
        $user = auth()->user();
        $viewPath = ($user->role === 'owner') ? 'owner.laporan.index' : 'admin.laporan.index';

        // 1. Inisialisasi Query Builder + Eager Loading Relasi sesuai kebutuhan Blade
        $barangMasukQuery = TransaksiMasuk::with(['barang', 'supplier'])->latest();
        $barangKeluarQuery = TransaksiKeluar::with('barang')->latest();
        $permintaanQuery = PermintaanBarang::with(['requester', 'barang'])->latest();

        // 2. Filter Berdasarkan Tanggal (Membaca dari input form 'start_date' & 'end_date')
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $barangMasukQuery->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            $barangKeluarQuery->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            $permintaanQuery->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        // 3. Ambil data hasil filter
        $barangMasuk = $barangMasukQuery->get();
        $barangKeluar = $barangKeluarQuery->get();
        $permintaans = $permintaanQuery->get();

        // 4. Statistik untuk Dashboard Laporan (jika dibutuhkan di view)
        $totalMasuk = TransaksiMasuk::count();
        $totalKeluar = TransaksiKeluar::count();
        $totalPermintaan = PermintaanBarang::count();
        $totalBarang = Barang::count();

        return view($viewPath, compact(
            'barangMasuk',
            'barangKeluar',
            'permintaans',
            'totalMasuk',
            'totalKeluar',
            'totalPermintaan',
            'totalBarang'
        ));
    }

    public function export(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $queryPermintaan = PermintaanBarang::with('barang')->latest();
        $queryMasuk = TransaksiMasuk::with(['barang', 'supplier'])->latest();
        $queryKeluar = TransaksiKeluar::with('barang')->latest();

        // Terapkan filter yang sama pada dokumen ekspor
        if ($start && $end) {
            $queryPermintaan->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            $queryMasuk->whereBetween('tanggal', [$start, $end]);
            $queryKeluar->whereBetween('tanggal', [$start, $end]);
        }

        // Simpan ke variabel dengan penamaan yang konsisten dengan template PDF Anda
        $permintaanBarang = $queryPermintaan->get();
        $masuk = $queryMasuk->get();
        $keluar = $queryKeluar->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('permintaanBarang', 'masuk', 'keluar'));

        return $pdf->download('laporan-gudang.pdf');
    }
}
