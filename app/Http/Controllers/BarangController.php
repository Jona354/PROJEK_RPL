<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::with('supplier')
                    ->latest()
                    ->get();

        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        return view('barang.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'stok_saat_ini' => 'required|numeric',
            'stok_minimum' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'stok_saat_ini' => $request->stok_saat_ini,
            'stok_minimum' => $request->stok_minimum,
            'harga_satuan' => $request->harga_satuan,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()
                ->route('barang.index')
                ->with('success', 'Data barang berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        $suppliers = Supplier::all();

        return view('barang.edit', compact(
            'barang',
            'suppliers'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id,
            'nama' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'stok_saat_ini' => 'required|numeric',
            'stok_minimum' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'stok_saat_ini' => $request->stok_saat_ini,
            'stok_minimum' => $request->stok_minimum,
            'harga_satuan' => $request->harga_satuan,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()
                ->route('barang.index')
                ->with('success', 'Data barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect()
                ->route('barang.index')
                ->with('success', 'Data barang berhasil dihapus');
    }
}