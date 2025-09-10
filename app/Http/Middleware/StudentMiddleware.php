<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('Student')->check()) {
            return redirect('/Student/login');
        }
        return $next($request);
    }
}
