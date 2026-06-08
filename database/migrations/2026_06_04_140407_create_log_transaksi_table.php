<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_transaksi', function (Blueprint $table) {

            $table->id();

            $table->foreignId('barang_id')
                ->constrained('barang')
                ->cascadeOnDelete();

            $table->integer('jumlah_terjual');

            $table->timestamp('waktu_transaksi');

            $table->string('id_transaksi_pos');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_transaksi');
    }
};