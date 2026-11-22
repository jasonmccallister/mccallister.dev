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
    </article>
@endsection
