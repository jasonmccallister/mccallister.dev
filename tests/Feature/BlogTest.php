<?php

use App\Content\ContentRepository;
use Symfony\Component\Finder\Finder;

it('renders the home page with posts', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Jason McCallister', false)
        ->assertSee('rel="canonical"', false)
        ->assertSee('og:url', false)
        ->assertSee('application/ld+json', false);
});

it('renders every markdown page', function () {
    $finder = (new Finder)->files()->in(base_path('content/pages'))->name('*.md');

    foreach ($finder as $file) {
        $slug = $file->getBasename('.md');
        $page = app(ContentRepository::class)->page($slug);

        expect($page)->not->toBeNull();

        $this->get('/'.$slug)
            ->assertOk()
            ->assertSee($page->title, false)
            ->assertSee('rel="canonical"', false)
            ->assertSee('application/ld+json', false);
    }
});

it('renders every markdown post', function () {
    foreach (app(ContentRepository::class)->posts() as $post) {
        $response = $this->get('/'.$post->slug)
            ->assertOk()
            ->assertSee($post->title, false)
            ->assertSee('rel="canonical"', false)
            ->assertSee('og:url', false)
            ->assertSee('application/ld+json', false);

        if ($post->featuredImage) {
            $response->assertSee(url($post->featuredImage), false);
        }
    }
});

it('returns a quiet 404 for unknown routes', function () {
    $this->get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('Page not found', false)
        ->assertSee('Back home', false);
});

it('serves a sitemap with home pages and posts', function () {
    $response = $this->get('/sitemap.xml')->assertOk();

    expect($response->headers->get('Content-Type'))->toContain('xml');

    $response->assertSee(url('/'), false)
        ->assertSee(url('/about'), false)
        ->assertSee(url('/appearances'), false);

    $post = app(ContentRepository::class)->posts()->first();
    expect($post)->not->toBeNull();
    $response->assertSee(url('/'.$post->slug), false);
});

it('serves robots.txt with sitemap reference', function () {
    $this->get('/robots.txt')
        ->assertOk()
        ->assertSee('Allow: /', false)
        ->assertSee('Sitemap: '.url('/sitemap.xml'), false);
});
