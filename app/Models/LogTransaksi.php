<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogTransaksi extends Model
{
    use HasFactory;

    protected $table = 'log_transaksi';

    protected $fillable = [
        'barang_id',
        'jumlah_terjual',
        'waktu_transaksi',
        'id_transaksi_pos'
    ];

    protected $casts = [
        'waktu_transaksi' => 'datetime'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}