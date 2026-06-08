<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama',
        'kategori',
        'satuan',
        'stok_saat_ini',
        'stok_minimum',
        'harga_satuan',
        'tanggal_kadaluarsa',
        'supplier_id'
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transaksiMasuk()
    {
        return $this->hasMany(TransaksiMasuk::class);
    }

    public function transaksiKeluar()
    {
        return $this->hasMany(TransaksiKeluar::class);
    }

    public function permintaanBarang()
    {
        return $this->hasMany(PermintaanBarang::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function logTransaksi()
    {
        return $this->hasMany(LogTransaksi::class);
    }
}