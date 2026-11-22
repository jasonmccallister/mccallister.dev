@extends('layouts.app')

@section('title', $page->title.' | mccallister.dev')
@section('description', $page->description)

@section('content')
    <div class="max-w-none">
        <h1 class="text-3xl md:text-4xl font-bold mb-8 font-mono">
            <span class="text-primary">&gt;</span> {{ $page->title }}
        </h1>

        <div class="prose prose-lg max-w-none">
            {!! $page->html !!}
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6 font-mono">
                <span class="text-primary">#</span> Skills
            </h2>
            <div class="mockup-code bg-base-300">
                <pre data-prefix="$" class="text-primary"><code>cat skills.json | jq '.languages'</code></pre>
                <pre data-prefix=">" class="text-success"><code>["Go", "PHP", "TypeScript", "Python", "Bash"]</code></pre>
                <pre data-prefix="$" class="text-primary"><code>cat skills.json | jq '.tools'</code></pre>
                <pre data-prefix=">" class="text-warning"><code>["Docker", "Kubernetes", "Dagger", "Git", "CI/CD"]</code></pre>
                <pre data-prefix="$" class="text-primary"><code>cat skills.json | jq '.cloud'</code></pre>
                <pre data-prefix=">" class="text-info"><code>["AWS", "GCP", "Azure", "Terraform"]</code></pre>
            </div>
        </div>
    </div>
@endsection
