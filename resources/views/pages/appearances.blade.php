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
    </div>
@endsection
