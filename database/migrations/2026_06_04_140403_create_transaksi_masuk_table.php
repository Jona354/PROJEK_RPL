<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_masuk', function (Blueprint $table) {

            $table->id();

            $table->foreignId('barang_id')
                ->constrained('barang')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')  
                ->cascadeOnDelete();

            $table->foreignId('supplier_id')->constrained();

            $table->integer('jumlah');

            $table->decimal('harga_total', 15, 2);

            $table->date('tanggal');

            $table->string('no_faktur')->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuk');
    }
};