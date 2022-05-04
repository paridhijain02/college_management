<?php

namespace App\Http\Middleware;

use Closure;

class WebAdmin
{
    public function handle($request, Closure $next)
    {
        if(session()->has('username'))
            return $next($request);
        else
            return redirect('adminLoginPost');
    }
}
