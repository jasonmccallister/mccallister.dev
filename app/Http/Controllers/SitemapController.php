<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(ContentRepository $content): Response
    {
        $urls = collect([
            [
                'loc' => url('/'),
                'lastmod' => null,
            ],
        ]);

        foreach ($content->pages() as $page) {
            $urls->push([
                'loc' => url('/'.$page->slug),
                'lastmod' => null,
            ]);
        }

        foreach ($content->posts() as $post) {
            $urls->push([
                'loc' => url('/'.$post->slug),
                'lastmod' => $post->date !== '' ? $post->date : null,
            ]);
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
