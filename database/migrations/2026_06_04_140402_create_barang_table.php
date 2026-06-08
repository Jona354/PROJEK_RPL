<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {

            $table->id();

            $table->string('kode_barang')->unique();

            $table->string('nama');

            $table->string('kategori');

            $table->string('satuan');

            $table->integer('stok_saat_ini')->default(0);

            $table->integer('stok_minimum')->default(0);

            $table->decimal('harga_satuan', 15, 2);

            $table->date('tanggal_kadaluarsa')->nullable();

            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};