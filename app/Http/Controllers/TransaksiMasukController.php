<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiMasukController extends Controller 
{
    // Fungsi untuk menampilkan riwayat
    public function index() 
    {
        $transaksi = TransaksiMasuk::with('barang')->latest()->get();
        return view('transaksi.masuk.index', compact('transaksi'));
    }

    // Fungsi untuk memproses data dari form tambah barang masuk
    public function store(Request $request) 
    {
        // 1. Validasi Input
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|numeric|min:1',
            'tanggal'   => 'required|date',
            'no_faktur' => 'required',
        ]);

        // 2. Gunakan Database Transaction agar data konsisten
        DB::transaction(function () use ($request) {
            // Simpan Transaksi
            TransaksiMasuk::create($request->all());

            // Update Stok
            $barang = Barang::findOrFail($request->barang_id);
            $barang->stok_saat_ini += $request->jumlah;
            $barang->save();
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Stok berhasil ditambah');
    }

    public function create()
{
    $barang = Barang::all();
    return view('transaksi.masuk.create', compact('barang'));
}
}