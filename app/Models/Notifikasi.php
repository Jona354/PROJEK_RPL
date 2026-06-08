<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'barang_id',
        'tipe',
        'pesan',
        'sudah_dibaca'
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}