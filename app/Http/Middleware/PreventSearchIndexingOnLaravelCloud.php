<?php

namespace App\Http\Middleware;

use App\Support\LaravelCloudHost;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventSearchIndexingOnLaravelCloud
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! LaravelCloudHost::matchesRequest($request)) {
            return $response;
        }

        $contentType = (string) $response->headers->get('Content-Type', '');

        if (str_contains($contentType, 'text/html')) {
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        }

        return $response;
    }
}
