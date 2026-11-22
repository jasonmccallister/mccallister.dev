<?php

use App\Content\ContentRepository;

it('renders the home page with posts', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Jason McCallister', false);
});

it('renders the about page', function () {
    $this->get('/about')
        ->assertOk()
        ->assertSee('About', false)
        ->assertSee('Skills', false)
        ->assertSee('Languages', false);
});

it('renders the appearances page', function () {
    $this->get('/appearances')
        ->assertOk()
        ->assertSee('Appearances', false);
});

it('renders a post by slug', function () {
    $post = app(ContentRepository::class)->posts()->first();

    expect($post)->not->toBeNull();

    $this->get('/'.$post->slug)
        ->assertOk()
        ->assertSee($post->title, false);
});

it('returns a quiet 404 for unknown routes', function () {
    $this->get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('Page not found', false)
        ->assertSee('Back home', false);
});
