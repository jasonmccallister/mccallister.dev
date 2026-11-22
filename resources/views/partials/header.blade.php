@php
    $navLinks = [
        ['href' => route('home'), 'path' => '/', 'label' => 'Home'],
        ['href' => route('about'), 'path' => '/about', 'label' => 'About'],
        ['href' => route('appearances'), 'path' => '/appearances', 'label' => 'Appearances'],
    ];
    $currentPath = '/'.ltrim(request()->path(), '/');
    if ($currentPath === '/') {
        $currentPath = '/';
    }
@endphp

<header class="navbar bg-base-200 border-b border-base-300 sticky top-0 z-40 font-mono">
    <div class="container mx-auto max-w-4xl flex items-center w-full">
        <div class="flex-none lg:hidden">
            <label for="nav-drawer" class="btn btn-square btn-ghost" aria-label="Open navigation menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
        </div>
        <div class="flex-1">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold tracking-tight">
                <span class="text-primary">&gt;_</span> mccallister.dev
            </a>
        </div>
        <nav class="flex-none hidden lg:flex" aria-label="Main navigation">
            <ul class="menu menu-horizontal px-1 gap-1">
                @foreach ($navLinks as $link)
                    <li>
                        <a
                            href="{{ $link['href'] }}"
                            class="hover:text-primary"
                            @if ($currentPath === $link['path']) aria-current="page" @endif
                        >
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <div class="flex-none">
            @include('partials.theme-toggle')
        </div>
    </div>
</header>
