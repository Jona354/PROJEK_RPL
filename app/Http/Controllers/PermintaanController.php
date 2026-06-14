<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanBarang;

class PermintaanController extends Controller
{
    //
    public function approve($id) {
    $permintaan = PermintaanBarang::findOrFail($id);
    
    DB::transaction(function () use ($permintaan) {
        // 1. Kurangi stok barang
        $barang = Barang::findOrFail($permintaan->barang_id);
        $barang->stok_saat_ini -= $permintaan->jumlah;
        $barang->save();
        
        // 2. Ubah status permintaan
        $permintaan->update(['status' => 'approved']);
        
        // 3. (Opsional) Catat ke tabel TransaksiKeluar
        TransaksiKeluar::create([
            'barang_id' => $permintaan->barang_id,
            'jumlah' => $permintaan->jumlah,
            'tujuan' => 'Dapur/Bar',
            'tanggal' => now()
        ]);
    });
    return back()->with('success', 'Barang disetujui dan stok berkurang');
}

    public function index()
{
    // Mengambil semua permintaan beserta relasi user dan barang agar tidak error saat di-loop
    $permintaan = PermintaanBarang::with(['user', 'barang'])->orderBy('status', 'asc')->get();
    return view('permintaan.index', compact('permintaan'));
}

    public function store(Request $request) 
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|numeric|min:1'
        ]);

        PermintaanBarang::create([
            'barang_id' => $request->barang_id,
            'requester_id' => auth()->id(),
            'jumlah_diminta' => $request->jumlah,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Permintaan berhasil dikirim ke gudang');
    }

}
