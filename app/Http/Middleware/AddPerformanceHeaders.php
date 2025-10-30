<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddPerformanceHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Add cache headers for static assets
        if ($request->is('assets/*') || $request->is('build/*')) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
        }

        // Add preload hints for critical resources
        $response->headers->set('Link', '<'.asset('assets/dr-korayem-original.png').'>; rel=preload; as=image', false);

        return $response;
    }
}
