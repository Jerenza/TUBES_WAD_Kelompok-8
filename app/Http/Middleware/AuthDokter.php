<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthDokter
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('dokter_id')) {
            return redirect()->route('dokter.login.form')->with('error', 'Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
} 