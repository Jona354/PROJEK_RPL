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

    /**

* Menampilkan halaman edit user
  */
  public function edit($id)
  {
  $user = User::findOrFail($id);

  return view('auth.edit', compact('user'));
  }

/**

* Update data user
  */
  public function update(Request $request, $id)
  {
  $user = User::findOrFail($id);

  $request->validate([
  'nama' => 'required|string|max:255',
  'username' => 'required|string|max:255|unique:users,username,' . $id,
  'role' => 'required|in:staff_gudang,chef',
  ]);

  $user->nama = $request->nama;
  $user->username = $request->username;
  $user->role = $request->role;

  // Password hanya diganti jika diisi
  if ($request->filled('password')) {


   $request->validate([
       'password' => 'min:6'
   ]);

   $user->password = Hash::make($request->password);


  }

  $user->save();

  return redirect()
  ->route('register')
  ->with('success', 'User berhasil diperbarui!');
  }

/**

* Hapus user
  */
  public function destroy($id)
  {
  $user = User::findOrFail($id);

  // Owner tidak boleh dihapus
  if ($user->role == 'owner') {


   return redirect()
       ->route('register')
       ->with('error', 'Akun owner tidak dapat dihapus.');


  }

  $user->delete();

  return redirect()
  ->route('register')
  ->with('success', 'User berhasil dihapus!');
  }

}
