<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Barang; // Pastikan model ini ada
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
     // Pastikan semua variabel ini didefinisikan SEBELUM return view
    $jumlahSupplier = Supplier::count();
    $totalBarang = Barang::count();
    $stokHabis = Barang::where('stok', 0)->count();
    $stokMenipis = Barang::where('stok', '>', 0)->where('stok', '<=', 10)->count();
    $stokAman = Barang::where('stok', '>', 10)->count();
    $barangKadaluarsa = Barang::where('tanggal_kadaluarsa', '<', now())->count(); // Pastikan kolom ini ada

    return view('dashboard.index', compact(
        'jumlahSupplier', 
        'totalBarang', 
        'stokHabis', 
        'stokMenipis', 
        'stokAman',
        'barangKadaluarsa'
    ));
    }
}