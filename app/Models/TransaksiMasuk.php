<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiMasuk extends Model
{
    use HasFactory;

    protected $table = 'transaksi_masuk';

    protected $fillable = [
     'barang_id',
    'jumlah',
    'supplier_id',
    'tanggal',
    'no_faktur',
    'user_id',
    'harga_total',
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function supplier() {
    return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
}