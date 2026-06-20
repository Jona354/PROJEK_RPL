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
        'barang_id'   => 'required|exists:barang,id',
        'jumlah'      => 'required|numeric|min:1',
        'tanggal'     => 'required|date',
        'supplier_id' => 'required',
        'no_faktur'   => 'required',
    ]);

    DB::transaction(function () use ($request) {

        // Cari data barang
        $barang = Barang::findOrFail($request->barang_id);

        // Siapkan data transaksi
        $data = $request->all();

        $data['user_id'] = auth()->id();

        // Hitung total harga
        $data['harga_total'] = $request->jumlah * $barang->harga_satuan;

        // Simpan transaksi
        TransaksiMasuk::create($data);

        // Tambah stok barang
        $barang->stok_saat_ini += $request->jumlah;
        $barang->save();
    });

    return redirect()
        ->route('barang-masuk.index')
        ->with('success', 'Data berhasil disimpan');
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
