<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function transaksiMasuk()
    {
        return $this->hasMany(TransaksiMasuk::class);
    }

    public function transaksiKeluar()
    {
        return $this->hasMany(TransaksiKeluar::class);
    }

    public function permintaanDibuat()
    {
        return $this->hasMany(PermintaanBarang::class, 'requester_id');
    }

    public function permintaanDisetujui()
    {
        return $this->hasMany(PermintaanBarang::class, 'approver_id');
    }
}
