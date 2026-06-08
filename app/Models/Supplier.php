<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kontak',
        'alamat'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}