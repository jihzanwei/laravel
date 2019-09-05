<?php

namespace App\Http\Middleware;

use Closure;

class Deletenews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        echo 1112;
        return $next($request);
    }
}
