<?php

use App\Content\ContentRepository;

it('serves llms.txt with site pages and posts', function () {
    $response = $this->get('/llms.txt')
        ->assertOk()
        ->assertSee('# '.config('site.name'), false)
        ->assertSee('> '.config('site.tagline'), false)
        ->assertSee('[Home]('.url('/').')', false)
        ->assertSee('[About]('.url('/about').')', false);

    expect($response->headers->get('Content-Type'))->toContain('text/plain');

    $post = app(ContentRepository::class)->posts()->first();
    expect($post)->not->toBeNull();

    $response->assertSee('['.$post->title.']('.url('/'.$post->slug).')', false);
});
