<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiKeluarController extends Controller
{
    //

public function index()
{
    // Mengambil semua data transaksi keluar beserta data barang terkait
    $transaksi = \App\Models\TransaksiKeluar::with('barang')->latest()->get();
    
    // Pastikan path view ini sesuai dengan folder Anda
    return view('transaksi.keluar.index', compact('transaksi'));
}
    public function store(Request $request) 
{
    $request->validate([
        'barang_id' => 'required',
        'jumlah'    => 'required|numeric|min:1',
        'tujuan'    => 'required',
    ]);

    $data = $request->all();
    $data['tujuan'] = strtolower($request->tujuan);

    DB::transaction(function () use ($request) {
        $barang = Barang::findOrFail($request->barang_id);

        // Validasi agar stok tidak negatif
        if ($barang->stok_saat_ini < $request->jumlah) {
            throw new \Exception("Stok tidak cukup!");
        }

        TransaksiKeluar::create($request->all() + ['user_id' => auth()->id()]);

        // Kurangi stok
        $barang->stok_saat_ini -= $request->jumlah;
        $barang->save();
    });

    return redirect()->route('barang-keluar.index')->with('success', 'Barang berhasil dikeluarkan');
}

public function create()
{
    // Mengambil semua data barang untuk ditampilkan di form
    $barang = Barang::all();
    
    // Mengirim data barang ke view 'transaksi.keluar.create'
    return view('transaksi.keluar.create', compact('barang'));
}

public function destroy($id) 

    {
        // 1. Temukan data
        $transaksi = TransaksiKeluar::find($id);

        if (!$transaksi) {
            return redirect()->route('barang-keluar.index')->with('error', 'Data tidak ditemukan!');
        }

        // 2. Transaksi database untuk keamanan data stok
        DB::transaction(function () use ($transaksi) {
            // Kembalikan stok ke barang
            $barang = Barang::findOrFail($transaksi->barang_id);
            $barang->stok_saat_ini += $transaksi->jumlah;
            $barang->save();

            // Hapus data
            $transaksi->delete();
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Data berhasil dihapus');
    }
}


