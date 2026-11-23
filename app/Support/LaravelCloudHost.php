<?php

namespace App\Support;

use Illuminate\Http\Request;

class LaravelCloudHost
{
    /**
     * Whether the given host is laravel.cloud or a subdomain of it.
     */
    public static function matches(?string $host): bool
    {
        if ($host === null || $host === '') {
            return false;
        }

        $host = strtolower($host);

        return $host === 'laravel.cloud' || str_ends_with($host, '.laravel.cloud');
    }

    /**
     * Whether the current (or given) request is served on a laravel.cloud host.
     */
    public static function matchesRequest(?Request $request = null): bool
    {
        $request ??= request();

        return self::matches($request->getHost());
    }
}
