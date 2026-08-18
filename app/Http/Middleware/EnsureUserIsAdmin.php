<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Pastikan user yang login adalah admin.
     * Jika bukan admin, tolak akses (403) atau lempar ke halaman login admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}
