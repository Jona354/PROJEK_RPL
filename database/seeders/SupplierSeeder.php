<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'nama' => 'PT Sumber Pangan',
            'kontak' => '081234567890',
            'alamat' => 'Jakarta'
        ]);

        Supplier::create([
            'nama' => 'CV Makmur Jaya',
            'kontak' => '081298765432',
            'alamat' => 'Bandung'
        ]);

        Supplier::create([
            'nama' => 'UD Berkah Sentosa',
            'kontak' => '081377788899',
            'alamat' => 'Semarang'
        ]);
    }
}