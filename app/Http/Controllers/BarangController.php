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
    public function index(Request $request)
    {
        // 1. Ambil semua barang untuk tabel
        $barang = Barang::with('supplier')->latest()->get();

        // 2. Hitung statistik stok
        $totalBarang = Barang::count();
        
        // Stok Habis: stok_saat_ini = 0
        $stokHabis = Barang::where('stok_saat_ini', 0)->count();
        
        // Stok Menipis: stok_saat_ini > 0 dan <= stok_minimum
        $stokMenipis = Barang::where('stok_saat_ini', '>', 0)
                              ->whereColumn('stok_saat_ini', '<=', 'stok_minimum')
                              ->count();
        
        // Stok Aman: stok_saat_ini > stok_minimum
        $stokAman = Barang::whereColumn('stok_saat_ini', '>', 'stok_minimum')->count();
        $search = $request->input('search');
       $barang = \App\Models\Barang::when($search, function ($query) use ($search) {
        return $query->where('nama', 'LIKE', '%' . $search . '%')
                     ->orWhere('kode_barang', 'LIKE', '%' . $search . '%');
    })->get();

        // 3. Kirim semua data ke view
        return view('barang.index', compact(
            'barang', 
            'totalBarang', 
            'stokHabis', 
            'stokMenipis', 
            'stokAman'
        ));
    }


    public function destroy(string $id)
{
    $barang = Barang::findOrFail($id);
    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
}

    public function create()
    {
        $suppliers = Supplier::all();

        return view('barang.create', compact('suppliers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'   => 'required|unique:barang,kode_barang',
            'nama'          => 'required',
            'kategori'      => 'required',
            'satuan'        => 'required',
            'stok_saat_ini' => 'required|numeric',
            'stok_minimum'  => 'required|numeric',
            'harga_satuan'  => 'required|numeric',
            'supplier_id'   => 'required|exists:suppliers,id',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit barang
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $suppliers = Supplier::all(); // Mengambil supplier untuk dropdown edit
        return view('barang.edit', compact('barang', 'suppliers'));
    }

    /**
     * Menyimpan perubahan data barang
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'kode_barang'   => 'required|unique:barang,kode_barang,' . $id, // Mengabaikan ID barang saat ini agar tidak error unik
            'nama'          => 'required',
            'kategori'      => 'required',
            'satuan'        => 'required',
            'stok_saat_ini' => 'required|numeric',
            'stok_minimum'  => 'required|numeric',
            'harga_satuan'  => 'required|numeric',
            'supplier_id'   => 'required|exists:suppliers,id',
        ]);


        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
    }

    // ... method lainnya (create, store, edit, update, destroy) tetap sama ...
}