<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

    $request->session()->regenerate();

    $user = Auth::user();

    $roleText = match($user->role){
        'admin' => 'Admin',
        'staff' => 'Staff Gudang',
        'chef'  => 'Chef',
        default => 'User'
    };

    return redirect()->route('dashboard')->with([
        'login_success' => true,
        'message' => 'Selamat datang '.$roleText.', '.$user->nama
    ]);
}

    return back()->withInput()->with([
        'login_error' => true,
        'title' => 'Login Gagal',
        'message' => 'Username atau Password salah.',
    ]);
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}
}
