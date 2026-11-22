@extends('layouts.app')

@section('title', $page->title.' | mccallister.dev')
@section('description', $page->description)

@section('content')
    <article>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-8">
            {{ $page->title }}
        </h1>

        <div class="prose">
            {!! $page->html !!}
        </div>

        <section class="mt-12 pt-8 border-t border-rule">
            <h2 class="text-2xl font-extrabold tracking-tight mb-6">
                Skills
            </h2>
            <dl class="space-y-5 text-base">
                <div>
                    <dt class="text-sm font-semibold text-muted mb-1">Languages</dt>
                    <dd class="text-ink">Go, PHP, TypeScript, Python, Bash</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-muted mb-1">Tools</dt>
                    <dd class="text-ink">Docker, Kubernetes, Dagger, Git, CI/CD</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-muted mb-1">Cloud</dt>
                    <dd class="text-ink">AWS, GCP, Azure, Terraform</dd>
                </div>
            </dl>
        </section>
    </article>
@endsection
