<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan pengguna sudah login
        if (!$request->user()) {
            // Redirect ke halaman login jika pengguna belum login
            return redirect()->route('/')->with('message', 'Silakan login untuk mengakses halaman ini.');
        }

        // Periksa apakah pengguna memiliki peran yang sesuai
        if (!in_array($request->user()->role, $roles)) {
            // Jika peran tidak cocok, kembalikan respons tidak diizinkan
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Jika peran cocok, lanjutkan permintaan
        return $next($request);
    }
}
