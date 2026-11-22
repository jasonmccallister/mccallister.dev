@extends('layouts.app')

@section('title', $post->title.' | mccallister.dev')
@section('description', $post->description)
@section('og_type', 'article')

@push('meta')
    @if ($post->featuredImage)
        <meta property="og:image" content="{{ $post->featuredImage }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ $post->featuredImage }}">
    @endif
@endpush

@section('content')
    <article>
        <header class="mb-8">
            @if (count($post->tags))
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($post->tags as $tag)
                        <span class="tag">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight mb-3">
                {{ $post->title }}
            </h1>
            <p class="text-sm text-muted">
                <time datetime="{{ $post->date }}">
                    {{ \App\Content\ContentRepository::formatDate($post->date) }}
                </time>
                <span aria-hidden="true"> – </span>
                <span>{{ $post->readingTime }}</span>
            </p>
        </header>

        @if ($post->featuredImage)
            <figure class="mb-8 overflow-hidden rounded-md">
                <img
                    src="{{ $post->featuredImage }}"
                    alt="Featured image for {{ $post->title }}"
                    class="w-full"
                    loading="eager"
                >
            </figure>
        @endif

        <div class="prose">
            {!! $post->html !!}
        </div>

        <p class="mt-12 pt-8 border-t border-rule text-sm">
            <a href="{{ route('home') }}" class="site-nav-link">
                ← All posts
            </a>
        </p>
    </article>
@endsection
