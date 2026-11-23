<footer class="site-chrome mt-auto">
    <div class="w-full max-w-3xl mx-auto px-5 py-12 sm:py-16 text-sm text-muted font-sans text-center">
        <div class="flex flex-col items-center gap-5">
            <p>&copy; {{ now()->year }} {{ config('site.author.name') }}</p>

            <p class="max-w-md leading-relaxed">
                I'm building an API runtime built for MCP
                (<a href="https://charterapp.dev" class="external-link font-bold text-accent underline underline-offset-2 decoration-accent/45 hover:decoration-accent" target="_blank" rel="noopener noreferrer">charterapp.dev</a>)
            </p>

            @include('partials.social-icons')
        </div>
    </div>
</footer>
