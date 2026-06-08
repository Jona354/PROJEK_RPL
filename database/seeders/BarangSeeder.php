<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::create([
            'kode_barang' => 'BRG-001',
            'nama' => 'Beras Premium',
            'kategori' => 'Bahan Pokok',
            'satuan' => 'Kg',
            'stok_saat_ini' => 100,
            'stok_minimum' => 20,
            'harga_satuan' => 15000,
            'tanggal_kadaluarsa' => '2027-12-31',
            'supplier_id' => 1
        ]);

        Barang::create([
            'kode_barang' => 'BRG-002',
            'nama' => 'Minyak Goreng',
            'kategori' => 'Bahan Pokok',
            'satuan' => 'Liter',
            'stok_saat_ini' => 50,
            'stok_minimum' => 10,
            'harga_satuan' => 18000,
            'tanggal_kadaluarsa' => '2027-12-31',
            'supplier_id' => 2
        ]);

        Barang::create([
            'kode_barang' => 'BRG-003',
            'nama' => 'Telur Ayam',
            'kategori' => 'Protein',
            'satuan' => 'Kg',
            'stok_saat_ini' => 30,
            'stok_minimum' => 5,
            'harga_satuan' => 28000,
            'tanggal_kadaluarsa' => '2026-08-01',
            'supplier_id' => 3
        ]);
    }
}