<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MahasiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'mahasiswa') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Kamu harus login sebagai mahasiswa.');
    }
}