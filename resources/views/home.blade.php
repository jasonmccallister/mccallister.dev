@extends('layouts.app')

@section('title', 'mccallister.dev')
@section('description', 'Writing about Go, PHP, containers, cloud infrastructure, and AI')

@section('content')
    <div class="space-y-12">
        <section class="text-center py-8">
            <h1 class="text-4xl font-bold mb-4 animate-fade-up">
                <span class="text-primary">&gt;</span> Jason McCallister
            </h1>
            <p class="text-xl text-base-content/70 font-mono animate-fade-up animate-delay-1">
                Go, PHP, containers, cloud infrastructure, and AI
            </p>
            <div class="divider max-w-xs mx-auto animate-fade-up animate-delay-2">
                <span class="text-primary font-mono text-sm">~/blog</span>
            </div>
        </section>

        @if ($featuredPosts->isNotEmpty())
            <section class="reveal">
                <h2 class="text-2xl font-bold mb-6 font-mono">
                    <span class="text-primary">#</span> Featured
                </h2>
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach ($featuredPosts as $post)
                        <x-post-card :post="$post" :featured="true" />
                    @endforeach
                </div>
            </section>
        @endif

        <section class="reveal">
            <h2 class="text-2xl font-bold mb-6 font-mono">
                <span class="text-primary">#</span> Latest
            </h2>
            <div class="space-y-4">
                @foreach ($latestPosts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </section>

        <section class="mockup-code bg-base-300 reveal">
            <pre data-prefix="$" class="text-primary"><code>whoami</code></pre>
            <pre data-prefix=">" class="text-success"><code>Solutions Engineer | 20+ years experience</code></pre>
            <pre data-prefix="$" class="text-primary"><code>cat interests.txt</code></pre>
            <pre data-prefix=">" class="text-warning"><code>Go • PHP • Containers • Cloud • AI</code></pre>
            <pre data-prefix="$" class="text-primary"><code><a href="{{ route('about') }}" class="link link-hover">./learn-more.sh</a></code></pre>
        </section>
    </div>
@endsection
