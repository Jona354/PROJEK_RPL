<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Data barang + pencarian + relasi supplier
        $barang = Barang::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('kode_barang', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->get();

        // Statistik stok
        $totalBarang = Barang::count();

        $stokHabis = Barang::where('stok_saat_ini', 0)->count();

        $stokMenipis = Barang::where('stok_saat_ini', '>', 0)
            ->whereColumn('stok_saat_ini', '<=', 'stok_minimum')
            ->count();

        $stokAman = Barang::whereColumn('stok_saat_ini', '>', 'stok_minimum')
            ->count();

        return view('barang.index', compact(
            'barang',
            'totalBarang',
            'stokHabis',
            'stokMenipis',
            'stokAman'
        ));
    }

    /**
     * Menampilkan form tambah barang
     */
    public function create()
{
    return view('barang.create');
}

    /**
     * Menyimpan barang baru
     */
   public function store(Request $request)
{
    $request->validate([
        'kode_barang'   => 'required|unique:barang,kode_barang',
        'nama'          => 'required|string',
        'kategori'      => 'required|string',
        'satuan'        => 'required|string',
        'stok_minimum'  => 'required|numeric|min:0',
        'harga_satuan'  => 'required|numeric|min:0',
    ]);

    Barang::create([
        'kode_barang'       => $request->kode_barang,
        'nama'              => $request->nama,
        'kategori'          => $request->kategori,
        'satuan'            => $request->satuan,
        'stok_saat_ini'     => 0,
        'stok_minimum'      => $request->stok_minimum,
        'harga_satuan'      => $request->harga_satuan,
        'tanggal_kadaluarsa'=> $request->tanggal_kadaluarsa,
    ]);

    return redirect()
        ->route('barang.index')
        ->with('success', 'Data barang berhasil ditambahkan');
}

public function show(string $id)
{
    $barang = Barang::findOrFail($id);

    return view('barang.show', compact('barang'));
}
    /**
     * Menampilkan form edit barang
     */
    public function edit(string $id)
{
    $barang = Barang::findOrFail($id);

    return view('barang.edit', compact('barang'));
}

    /**
     * Menyimpan perubahan barang
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'kode_barang'   => 'required|unique:barang,kode_barang,' . $id,
        'nama'          => 'required|string',
        'kategori'      => 'required|string',
        'satuan'        => 'required|string',
        'stok_minimum'  => 'required|numeric|min:0',
        'harga_satuan'  => 'required|numeric|min:0',
    ]);

    $barang = Barang::findOrFail($id);

    $barang->update([
        'kode_barang'       => $request->kode_barang,
        'nama'              => $request->nama,
        'kategori'          => $request->kategori,
        'satuan'            => $request->satuan,
        'stok_minimum'      => $request->stok_minimum,
        'harga_satuan'      => $request->harga_satuan,
        'tanggal_kadaluarsa'=> $request->tanggal_kadaluarsa,
    ]);

    return redirect()
        ->route('barang.index')
        ->with('success', 'Data barang berhasil diperbarui');
}

    /**
     * Menghapus data barang
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
