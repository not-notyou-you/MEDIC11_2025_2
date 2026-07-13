<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan admin (1) dan superadmin (2)
        if (Auth::check() && Auth::user()->is_admin >= 1) {
            return $next($request);
        }

        return abort(404);
    }
}