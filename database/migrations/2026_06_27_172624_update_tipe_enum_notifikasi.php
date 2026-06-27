<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE notifikasi
            MODIFY COLUMN tipe ENUM(
                'stok_minimum',
                'kadaluarsa',
                'permintaan',
                'disetujui',
                'ditolak',
                'barang_masuk',
                'barang_keluar'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE notifikasi
            MODIFY COLUMN tipe ENUM(
                'stok_minimum',
                'kadaluarsa'
            ) NOT NULL
        ");
    }
};
