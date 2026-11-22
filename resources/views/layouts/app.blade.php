<!DOCTYPE html>
<html lang="en" data-theme="retro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'mccallister.dev')</title>
    <meta name="description" content="@yield('description', 'Writing about Go, PHP, containers, cloud infrastructure, and AI')">
    <meta property="og:title" content="@yield('title', 'mccallister.dev')">
    <meta property="og:description" content="@yield('description', 'Writing about Go, PHP, containers, cloud infrastructure, and AI')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', 'mccallister.dev')">
    <meta name="twitter:description" content="@yield('description', 'Writing about Go, PHP, containers, cloud infrastructure, and AI')">
    @stack('meta')

    <link rel="icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            const theme = localStorage.getItem('theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'retro');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>
<body
    class="min-h-screen bg-base-100 text-base-content"
    x-data
    @keydown.escape.window="document.getElementById('nav-drawer').checked = false"
>
    <a
        href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary focus:text-primary-content focus:rounded"
    >
        Skip to content
    </a>
    <div class="drawer">
        <input id="nav-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @include('partials.header')
            <main id="main-content" class="flex-1 container mx-auto px-4 py-8 max-w-4xl">
                @yield('content')
            </main>
            @include('partials.footer')
        </div>
        <div class="drawer-side z-50">
            <label for="nav-drawer" class="drawer-overlay" aria-label="Close navigation menu"></label>
            @include('partials.mobile-nav')
        </div>
    </div>
</body>
</html>

