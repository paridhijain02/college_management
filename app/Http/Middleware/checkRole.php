<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
