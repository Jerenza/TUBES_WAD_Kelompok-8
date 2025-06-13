<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthPasien
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('pasien_id')) {
            return redirect()->route('pasien.login.form')->with('error', 'Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
} 