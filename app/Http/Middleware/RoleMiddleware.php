<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Kita buat $roles sebagai parameter opsional
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Jika tidak ada role yang diberikan, tolak saja
        if (empty($roles)) {
            abort(403, 'Akses ditolak: Tidak ada role yang ditentukan.');
        }

        // PENTING: Pastikan role user saat ini adalah bagian dari daftar $roles
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}