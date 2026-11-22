@php
    $navLinks = [
        ['href' => route('home'), 'path' => '/', 'label' => 'Home'],
        ['href' => route('content.show', 'about'), 'path' => '/about', 'label' => 'About'],
        ['href' => route('content.show', 'appearances'), 'path' => '/appearances', 'label' => 'Appearances'],
    ];
    $currentPath = '/'.ltrim(request()->path(), '/');
    if ($currentPath === '/') {
        $currentPath = '/';
    }
@endphp

<header class="site-chrome">
    <div class="w-full max-w-3xl mx-auto px-5 h-14 flex items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="text-base font-extrabold tracking-tight text-ink no-underline">
            mccallister<span class="site-mark-dot">.</span>dev
        </a>

        <nav class="hidden sm:flex items-center gap-6" aria-label="Main navigation">
            @foreach ($navLinks as $link)
                <a
                    href="{{ $link['href'] }}"
                    class="site-nav-link text-sm font-semibold"
                    @if ($currentPath === $link['path']) aria-current="page" @endif
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            @include('partials.theme-toggle')
        </nav>

        <div class="flex items-center gap-3 sm:hidden">
            @include('partials.theme-toggle')
            <button
                type="button"
                class="text-sm font-semibold text-muted hover:text-ink"
                @click="navOpen = !navOpen"
                :aria-expanded="navOpen.toString()"
                aria-controls="mobile-nav"
                aria-label="Toggle navigation"
            >
                <span x-text="navOpen ? 'Close' : 'Menu'"></span>
            </button>
        </div>
    </div>

    <nav
        id="mobile-nav"
        class="sm:hidden px-5 py-4 space-y-3"
        aria-label="Mobile navigation"
        x-show="navOpen"
        x-cloak
    >
        @foreach ($navLinks as $link)
            <a
                href="{{ $link['href'] }}"
                class="site-nav-link block text-base font-semibold"
                @if ($currentPath === $link['path']) aria-current="page" @endif
                @click="navOpen = false"
            >
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>
</header>
