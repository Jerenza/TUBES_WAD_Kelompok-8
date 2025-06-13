<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }

        return $next($request);
    }
} 