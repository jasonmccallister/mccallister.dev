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
    <article class="max-w-none">
        <header class="mb-8">
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($post->tags as $tag)
                    <span class="badge badge-primary badge-outline font-mono">{{ $tag }}</span>
                @endforeach
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $post->title }}
            </h1>
            <div class="flex items-center gap-4 text-sm text-base-content/60 font-mono">
                <time datetime="{{ $post->date }}">
                    {{ \App\Content\ContentRepository::formatDate($post->date) }}
                </time>
                <span>•</span>
                <span>{{ $post->readingTime }}</span>
            </div>
        </header>

        @if ($post->featuredImage)
            <figure class="mb-8 rounded-lg overflow-hidden border border-base-300">
                <img
                    src="{{ $post->featuredImage }}"
                    alt="Featured image for {{ $post->title }}"
                    class="w-full"
                    loading="eager"
                >
            </figure>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! $post->html !!}
        </div>

        <div class="mt-12 pt-8 border-t border-base-300">
            <a href="{{ route('home') }}" class="btn btn-outline btn-sm font-mono">
                <span class="text-primary">&lt;-</span> Back to all posts
            </a>
        </div>
    </article>
@endsection
