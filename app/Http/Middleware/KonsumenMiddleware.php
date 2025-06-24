<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KonsumenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isKonsumen()) {
            return redirect()->route('home')->with('error', 'Akses ditolak. Halaman ini khusus untuk konsumen.');
        }

        return $next($request);
    }
}
