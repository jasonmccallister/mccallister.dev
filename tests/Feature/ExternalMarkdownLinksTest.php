<?php

use App\Content\ContentRepository;

it('opens external markdown links in a new tab with an external-link class', function () {
    $html = app(ContentRepository::class)->page('about')?->html;

    expect($html)->not->toBeNull()
        ->and($html)->toContain('href="https://bref.sh"')
        ->and($html)->toContain('class="external-link"')
        ->and($html)->toContain('target="_blank"')
        ->and($html)->toContain('rel="noopener noreferrer"');
});

it('does not mark relative or same-host markdown links as external', function () {
    $path = base_path('content/pages/_external-link-fixture.md');
    $host = parse_url((string) config('app.url'), PHP_URL_HOST) ?: 'localhost';

    file_put_contents($path, <<<MD
---
title: External link fixture
slug: _external-link-fixture
description: Fixture for outbound link rendering.
---
Relative [about](/about), same host [home](http://{$host}/), and external [example](https://example.com/docs).
MD);

    try {
        $html = app(ContentRepository::class)->page('_external-link-fixture')?->html;

        expect($html)->not->toBeNull()
            ->and($html)->toContain('<a href="/about">about</a>')
            ->and($html)->toContain("<a href=\"http://{$host}/\">home</a>")
            ->and($html)->toContain('href="https://example.com/docs"')
            ->and($html)->toMatch('/<a rel="noopener noreferrer" target="_blank" class="external-link" href="https:\/\/example\.com\/docs">/');
    } finally {
        if (is_file($path)) {
            unlink($path);
        }
    }
});

it('marks blade-authored outbound links on the home page', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('href="https://bref.sh/docs/case-studies/craft-cloud"', false)
        ->assertSee('class="external-link', false)
        ->assertSee('target="_blank"', false)
        ->assertSee('rel="noopener noreferrer"', false);
});
