<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('Support')->check()) {
            return redirect('/Support/login');
        }
        return $next($request);
    }
}
