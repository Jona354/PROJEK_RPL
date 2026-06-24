<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Facades\DB;

class TransaksiKeluarController extends Controller
{
    // Menampilkan riwayat barang keluar
    public function index()
    {
        // PERBAIKAN: Mengubah nama variabel menjadi $barangKeluar agar sinkron dengan file Blade
        $barangKeluar = TransaksiKeluar::with('barang')
            ->latest()
            ->get();

        return view('transaksi.keluar.index', compact('barangKeluar'));
    }

    // Menghapus transaksi barang keluar
    public function destroy(int $id)
    {
        $transaksi = TransaksiKeluar::find($id);

        if (!$transaksi) {
            return redirect()
                ->route('barang-keluar.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        DB::transaction(function () use ($transaksi) {
            // Kembalikan stok barang ke master barang
            $barang = Barang::findOrFail($transaksi->barang_id);
            $barang->stok_saat_ini += $transaksi->jumlah;
            $barang->save();

            // Hapus riwayat transaksi keluar
            $transaksi->delete();
        });

        // PERBAIKAN: Menggunakan redirect()->route() setelah proses delete berhasil
        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Riwayat transaksi keluar berhasil dihapus dan stok dikembalikan!');
    }
}