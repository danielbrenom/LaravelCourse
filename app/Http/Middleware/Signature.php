<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Signature
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $headerName
     * @return mixed
     */
    public function handle($request, Closure $next, $headerName = 'X-Name')
    {
        $response = $next($request);
        $response->headers->set($headerName, config('app.name'));
        return $response;
    }
}
