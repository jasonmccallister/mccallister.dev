<footer class="site-chrome border-t mt-auto">
    <div class="w-full max-w-3xl mx-auto px-5 py-8 text-sm text-muted font-sans">
        <p class="mb-3">&copy; {{ now()->year }} {{ config('site.author.name') }}</p>
        <div class="flex flex-wrap gap-4">
            @foreach (config('site.author.sameAs') as $href)
                @php
                    $label = match (true) {
                        str_contains($href, 'github.com') => 'GitHub',
                        str_contains($href, 'x.com') || str_contains($href, 'twitter.com') => 'X',
                        str_contains($href, 'linkedin.com') => 'LinkedIn',
                        default => 'Profile',
                    };
                @endphp
                <a
                    href="{{ $href }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="site-nav-link"
                >
                    {{ $label }}<span class="sr-only"> (opens in new tab)</span>
                </a>
            @endforeach
        </div>
    </div>
</footer>
