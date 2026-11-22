@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight mb-3">
            Page not found
        </h1>
        <p class="text-muted mb-8 leading-relaxed">
            That URL doesn't match anything here.
        </p>
        <a href="{{ route('home') }}" class="site-nav-link text-sm">
            ← Back home
        </a>
    </div>
@endsection
