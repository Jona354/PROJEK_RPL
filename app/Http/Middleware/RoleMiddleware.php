<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Pecah jika role masih berupa "staff_gudang,chef"
        if (count($roles) == 1 && str_contains($roles[0], ',')) {
            $roles = explode(',', $roles[0]);
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
