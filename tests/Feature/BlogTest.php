<?php

use App\Content\ContentRepository;

it('renders the home page with posts', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Jason McCallister', false)
        ->assertSee('Featured', false)
        ->assertSee('Latest', false);
});

it('renders the about page', function () {
    $this->get('/about')
        ->assertOk()
        ->assertSee('About', false)
        ->assertSee('Skills', false);
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

it('returns a terminal-themed 404 for unknown routes', function () {
    $this->get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('404', false)
        ->assertSee('works on my machine', false);
});
