<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar supplier
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Supplier::when($search, function ($query) use ($search) {
                $query->where('nama', 'LIKE', '%' . $search . '%')
                      ->orWhere('kontak', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->get();

        // Statistik
        $totalSupplier = Supplier::count();

        return view('supplier.index', compact(
            'suppliers',
            'totalSupplier'
        ));
    }


    /**
     * Menampilkan form tambah supplier
     */
    public function create()
    {
        return view('supplier.create');
    }


    /**
     * Menyimpan supplier baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kontak' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
        ]);

        Supplier::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }


    /**
     * Menampilkan form edit supplier
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('supplier'));
    }


    /**
     * Menyimpan perubahan supplier
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kontak' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }


    /**
     * Menghapus supplier
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Cek apakah supplier masih memiliki barang
        if ($supplier->barang()->count() > 0) {
            return redirect()
                ->route('supplier.index')
                ->with(
                    'error',
                    'Supplier tidak dapat dihapus karena masih memiliki data barang.'
                );
        }

        $supplier->delete();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
