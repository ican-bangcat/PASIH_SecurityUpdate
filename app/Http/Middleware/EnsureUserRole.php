<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        $user?->loadMissing('roleRef');
        $userRole = $user?->role?->value;

        if (! $user) {
            return redirect()->route('login');
        }

        if (! in_array($userRole, $roles, true)) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak: Akun Anda saat ini ('.$user->name.') tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
