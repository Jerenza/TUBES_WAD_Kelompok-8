<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthStaff
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('staff_id')) {
            return redirect()->route('staff.login.form')->with('error', 'Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
}