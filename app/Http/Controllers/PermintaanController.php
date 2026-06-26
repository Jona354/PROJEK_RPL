<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanBarang;
use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class PermintaanController extends Controller
{
    public function approve(int $id)
    {
        $permintaan = PermintaanBarang::findOrFail($id);

        if ($permintaan->status != 'pending') {
            return back()->with('error', 'Permintaan sudah diproses');
        }

        $barang = Barang::findOrFail($permintaan->barang_id);

        if ($barang->stok_saat_ini < $permintaan->jumlah_diminta) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        DB::transaction(function () use ($permintaan, $barang) {

            // Kurangi stok
            $barang->stok_saat_ini -= $permintaan->jumlah_diminta;
            $barang->save();

            // Update status permintaan
            $permintaan->update([
                'status' => 'disetujui'
            ]);

            // Catat transaksi keluar
            TransaksiKeluar::create([
                'barang_id' => $permintaan->barang_id,
                'jumlah'    => $permintaan->jumlah_diminta,
                'tujuan'    => 'dapur',
                'tanggal'   => now()->toDateString(),
                'user_id'    => Auth::id() ?? $permintaan->requester_id,

            ]);
        });

        $barang = Barang::findOrFail($permintaan->barang_id);

Notifikasi::create([
    'barang_id' => $barang->id,
    'tipe' => 'disetujui',
    'pesan' => 'Permintaan '.$barang->nama_barang.
               ' sebanyak '.$permintaan->jumlah_diminta.
               ' telah disetujui',
    'sudah_dibaca' => 0
]);

        return back()->with('success', 'Barang berhasil disetujui');
    }

    public function reject(int $id)
    {
        $permintaan = PermintaanBarang::findOrFail($id);

        if ($permintaan->status != 'pending') {
            return back()->with('error', 'Permintaan sudah diproses');
        }

        $permintaan->update([
    'status' => 'ditolak'
]);

$barang = Barang::findOrFail($permintaan->barang_id);

Notifikasi::create([
    'barang_id' => $barang->id,
    'tipe' => 'ditolak',
    'pesan' => 'Permintaan '.$barang->nama_barang.
               ' sebanyak '.$permintaan->jumlah_diminta.
               ' ditolak',
    'sudah_dibaca' => 0
]);

return back()->with('success', 'Permintaan berhasil ditolak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_diminta' => 'required|numeric|min:1'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah_diminta > $barang->stok_saat_ini) {
            return back()
                ->withInput()
                ->with('error', 'Jumlah permintaan melebihi stok tersedia');
        }

        PermintaanBarang::create([
            'barang_id'      => $request->barang_id,
            'requester_id' => Auth::user()->id,
            'jumlah_diminta' => $request->jumlah_diminta,
            'keterangan'     => $request->keterangan,
            'status'         => 'pending'
        ]);

        Notifikasi::create([
    'barang_id' => $barang->id,
    'tipe' => 'permintaan',
    'pesan' => 'Permintaan baru '.$barang->nama_barang.
               ' sebanyak '.$request->jumlah_diminta,
    'sudah_dibaca' => 0
]);

        return redirect()
            ->route('permintaan.index')
            ->with('success', 'Permintaan berhasil dikirim');
    }

    public function index()
{
    if (Auth::user()->role == 'staff_gudang') {

        $permintaans = PermintaanBarang::with(['requester', 'barang'])
            ->latest()
            ->get();

    } else {

        $permintaans = PermintaanBarang::with(['requester', 'barang'])
            ->where('requester_id', Auth::id())
            ->latest()
            ->get();
    }

    return view('permintaan.index', compact('permintaans'));
}

    public function create()
    {
        $barangs = Barang::all();

        return view('permintaan.create', compact('barangs'));
    }
}
