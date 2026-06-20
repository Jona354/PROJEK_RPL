<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('auth.index', compact('users'));
    }


    /**
     * Menampilkan halaman tambah user
     */
    public function create()
    {
        return view('auth.register');
    }


    /**
     * Menyimpan data user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|in:staff_gudang,chef',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('register')
            ->with('success', 'User berhasil ditambahkan!');
    }
}
