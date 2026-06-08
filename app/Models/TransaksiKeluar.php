<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiKeluar extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keluar';

    protected $fillable = [
        'barang_id',
        'user_id',
        'jumlah',
        'tanggal',
        'tujuan',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}