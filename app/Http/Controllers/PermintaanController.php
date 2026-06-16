<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanBarang;
use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Facades\DB;

class PermintaanController extends Controller
{
    public function approve($id) 
    {
        $permintaan = PermintaanBarang::findOrFail($id);
        
        DB::transaction(function () use ($permintaan) {
            // 1. Kurangi stok barang
            $barang = Barang::findOrFail($permintaan->barang_id);
            $barang->stok_saat_ini -= $permintaan->jumlah_diminta; // Gunakan jumlah_diminta
            $barang->save();
            
            // 2. Ubah status permintaan
            $permintaan->update(['status' => 'disetujui']);
            
            // 3. Catat ke tabel TransaksiKeluar (HANYA SAAT APPROVE)
            TransaksiKeluar::create([
                'barang_id'    => $permintaan->barang_id,
                'jumlah'       => $permintaan->jumlah_diminta,
                'tujuan'       => 'Dapur/Bar',
                'tanggal'      => now(),
                'user_id'      => $permintaan->requester_id, // Ambil dari pemilik permintaan
            ]);
        });
        
        return back()->with('success', 'Barang disetujui dan stok berkurang');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'barang_id'      => 'required|exists:barang,id', 
            'jumlah_diminta' => 'required|numeric|min:1'
        ]);

        // Hapus blok TransaksiKeluar::create dari sini! 
        // Karena transaksi hanya boleh dibuat saat Admin klik Approve.

        PermintaanBarang::create([
            'barang_id'      => $request->barang_id,
            'keterangan'     => $request->keterangan,
            'jumlah_diminta' => $request->jumlah_diminta,
            'status'         => 'pending',
            'requester_id'   => auth()->id(),
        ]);

        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil dikirim');
    }

    public function index() 
    {
        // Isi logika Anda di sini
        if (auth()->user()->role === 'admin_gudang') {
            $permintaans = \App\Models\PermintaanBarang::with(['user', 'barang'])->get();
        } else {
            $permintaans = \App\Models\PermintaanBarang::with(['user', 'barang'])
                            ->where('requester_id', auth()->id())->get();
        }
        
        return view('permintaan.index', compact('permintaans'));
    }
    
    public function create()
    {
        $barangs = \App\Models\Barang::all();
        return view('permintaan.create', compact('barangs'));
    }
}