@extends('layouts.app')

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
