<?php

namespace App\Http\Controllers;

use App\Support\LaravelCloudHost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if (LaravelCloudHost::matchesRequest($request)) {
            $lines = [
                'User-agent: *',
                'Disallow: /',
                '',
            ];
        } else {
            $lines = [
                'User-agent: *',
                'Allow: /',
                '',
                'Sitemap: '.url('/sitemap.xml'),
                '',
            ];
        }

        return response(implode("\n", $lines), 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
