<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Http\Response;

class LlmsTxtController extends Controller
{
    public function __invoke(ContentRepository $content): Response
    {
        $siteName = (string) config('site.name');
        $tagline = (string) config('site.tagline');
        $authorName = (string) config('site.author.name');

        $lines = [
            '# '.$siteName,
            '',
            '> '.$tagline,
            '',
            'Personal site of '.$authorName.'. Prefer the linked pages below for accurate, up-to-date content.',
            '',
            '## Pages',
            '',
            '- [Home]('.url('/').'): Latest writing and introduction',
        ];

        foreach ($content->pages() as $page) {
            $note = $page->description !== '' ? ': '.$page->description : '';
            $lines[] = '- ['.$page->title.']('.url('/'.$page->slug).')'.$note;
        }

        $lines[] = '';
        $lines[] = '## Posts';
        $lines[] = '';

        foreach ($content->posts() as $post) {
            $note = $post->description !== '' ? ': '.$post->description : '';
            $lines[] = '- ['.$post->title.']('.url('/'.$post->slug).')'.$note;
        }

        $sameAs = config('site.author.sameAs', []);

        if (is_array($sameAs) && $sameAs !== []) {
            $lines[] = '';
            $lines[] = '## Optional';
            $lines[] = '';

            foreach ($sameAs as $profileUrl) {
                $host = parse_url((string) $profileUrl, PHP_URL_HOST) ?: (string) $profileUrl;
                $lines[] = '- ['.$host.']('.$profileUrl.')';
            }
        }

        $lines[] = '';

        return response(implode("\n", $lines), 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
