@extends('layouts.app')

@section('content')
    <header class="mb-14 pb-10 border-b border-rule">
        <div class="flex flex-col sm:flex-row sm:items-start gap-6 sm:gap-8">
            <div class="min-w-0 flex-1">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-ink leading-tight mb-4">
                    Jason McCallister
                </h1>
                <p class="text-[1.15rem] sm:text-xl text-muted leading-relaxed mb-5">
                    I'm a software engineer and architect. I've spent about 20 years on servers, APIs, cloud, and integrations, often in an architect role shipping to and even <a href="https://bref.sh/docs/case-studies/craft-cloud" class="underline underline-offset-2 decoration-rule hover:text-accent hover:decoration-accent">building cloud platforms</a>. Here I write about Go, PHP, containers, and the cloud work that shows up day to day.
                </p>
                <p>
                    <a href="{{ route('content.show', 'about') }}" class="site-nav-link text-base font-medium">
                        More about me
                    </a>
                </p>
            </div>
            <div class="flex flex-col items-center gap-4 shrink-0 self-center sm:self-start">
                <img
                    src="/images/jason.jpg"
                    alt="Jason McCallister"
                    width="160"
                    height="160"
                    class="w-28 h-28 sm:w-36 sm:h-36 rounded-full object-cover ring-2 ring-accent/25 ring-offset-4 ring-offset-paper"
                    loading="eager"
                    decoding="async"
                >
                @include('partials.social-icons')
            </div>
        </div>
    </header>

    @if ($featuredPosts->isNotEmpty())
        <section class="mb-4">
            @foreach ($featuredPosts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </section>
    @endif

    <section>
        @foreach ($latestPosts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </section>
@endsection
