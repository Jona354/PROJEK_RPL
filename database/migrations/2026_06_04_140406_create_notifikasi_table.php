<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {

            $table->id();

            $table->foreignId('barang_id')
                ->constrained('barang')
                ->cascadeOnDelete();

            $table->enum('tipe', [
                'stok_minimum',
                'kadaluarsa'
            ]);

            $table->text('pesan');

            $table->boolean('sudah_dibaca')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};