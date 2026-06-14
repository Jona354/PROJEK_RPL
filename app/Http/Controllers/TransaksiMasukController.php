<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiMasukController extends Controller 
{

    public function index() 
    {
        $transaksi = TransaksiMasuk::with('barang')->latest()->get();
        return view('transaksi.masuk.index', compact('transaksi'));
    }

    public function create()
    {
       $barang = \App\Models\Barang::all();
       $suppliers = \App\Models\Supplier::all();    
        return view('transaksi.masuk.create', compact('barang', 'suppliers'));
    }

    public function store(Request $request) 
{
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'jumlah'    => 'required|numeric|min:1',
        'tanggal'   => 'required|date',
        'supplier_id' => 'required',
        'no_faktur' => 'required',
    ]);

    DB::transaction(function () use ($request) {
        // 1. Cari dulu data barangnya
        $barang = Barang::findOrFail($request->barang_id);

        // 2. Siapkan data transaksi
        $data = $request->all();
        $data['user_id'] = auth()->id() ?? 1;
        
        // 3. Hitung harga_total jika kolomnya ada
        // Pastikan kolom 'harga' ada di tabel barang Anda
        $data['harga_total'] = $request->jumlah * $barang->harga; 

        // 4. Simpan Transaksi
        TransaksiMasuk::create($data);

        // 5. Update Stok
        $barang->stok_saat_ini += $request->jumlah;
        $barang->save();
    });

    return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil disimpan');
}
    public function destroy($id) 
    {
        DB::transaction(function () use ($id) {
            $transaksi = TransaksiMasuk::findOrFail($id);
            
            // 1. Kembalikan stok (dikurangi kembali saat transaksi dihapus)
            $barang = Barang::findOrFail($transaksi->barang_id);
            $barang->stok_saat_ini -= $transaksi->jumlah;
            $barang->save();
            
            // 2. Hapus Transaksi
            $transaksi->delete();
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil dihapus');
    }
}