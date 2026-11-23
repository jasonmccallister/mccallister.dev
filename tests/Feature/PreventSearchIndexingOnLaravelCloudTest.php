<?php

use App\Support\LaravelCloudHost;

it('detects laravel.cloud hosts by request host', function (?string $host, bool $expected) {
    expect(LaravelCloudHost::matches($host))->toBe($expected);
})->with([
    'apex' => ['laravel.cloud', true],
    'subdomain' => ['mccallisterdev-production-ujyra4.laravel.cloud', true],
    'nested subdomain' => ['preview.mccallisterdev.laravel.cloud', true],
    'production domain' => ['mccallister.dev', false],
    'lookalike suffix' => ['notlaravel.cloud', false],
    'empty' => ['', false],
    'null' => [null, false],
]);

it('disallows crawling on robots.txt for laravel.cloud hosts', function () {
    $response = getOnLaravelCloud('/robots.txt')->assertOk();

    expect($response->getContent())
        ->toContain("User-agent: *\nDisallow: /")
        ->not->toContain('Sitemap:')
        ->not->toContain("\nAllow: /");
});

it('allows crawling on robots.txt for normal hosts', function () {
    $response = $this->get('/robots.txt')->assertOk();

    expect($response->getContent())
        ->toContain("User-agent: *\nAllow: /")
        ->toContain('Sitemap: '.url('/sitemap.xml'))
        ->not->toContain('Disallow:');
});

it('sends X-Robots-Tag on HTML responses for laravel.cloud hosts', function () {
    getOnLaravelCloud('/')
        ->assertOk()
        ->assertHeader('X-Robots-Tag', 'noindex, nofollow, noarchive')
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false);
});

it('does not send X-Robots-Tag on HTML responses for normal hosts', function () {
    $this->get('/')
        ->assertOk()
        ->assertHeaderMissing('X-Robots-Tag')
        ->assertDontSee('<meta name="robots" content="noindex, nofollow">', false);
});

it('does not send X-Robots-Tag on non-HTML responses for laravel.cloud hosts', function () {
    getOnLaravelCloud('/robots.txt')
        ->assertOk()
        ->assertHeaderMissing('X-Robots-Tag');
});
