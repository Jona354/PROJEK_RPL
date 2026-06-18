<?php

namespace App\Http\Controllers;

use App\Models\PermintaanBarang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        
        $query = PermintaanBarang::with(['user', 'barang']); // Menambah with agar tidak error saat memanggil relasi

        if ($request->has('start_date') && $request->has('end_date') && $request->start_date != null) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $permintaans = $query->latest()->get();
        
        // Pastikan file view-nya ada di folder resources/views/admin/laporan/index.blade.php
        return view('admin.laporan.index', compact('permintaans'));
    }
}