<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'kontak' => 'required',
        'alamat' => 'required',
    ]);

    Supplier::create([
        'nama' => $request->nama,
        'kontak' => $request->kontak,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('supplier.index')
        ->with('success', 'Supplier berhasil ditambahkan');
}

    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update($request->all());

        return redirect('/supplier')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        Supplier::destroy($id);

        return redirect('/supplier')
            ->with('success', 'Supplier berhasil dihapus');
    }
}