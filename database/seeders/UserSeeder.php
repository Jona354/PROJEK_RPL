<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Owner SIGURESTO',
            'username' => 'owner',
            'password' => Hash::make('password'),
            'role' => 'owner'
        ]);

        User::create([
            'nama' => 'Admin Gudang',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin_gudang'
        ]);

        User::create([
            'nama' => 'Staff Gudang',
            'username' => 'staff',
            'password' => Hash::make('password'),
            'role' => 'staff_gudang'
        ]);

        User::create([
            'nama' => 'Chef Restoran',
            'username' => 'chef',
            'password' => Hash::make('password'),
            'role' => 'chef'
        ]);
    }
}