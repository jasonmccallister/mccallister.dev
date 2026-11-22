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

<nav aria-label="Mobile navigation">
    <ul class="menu p-4 w-80 min-h-full bg-base-200">
        <li class="menu-title">
            <span class="text-primary">&gt;_</span> Navigation
        </li>
        @foreach ($navLinks as $link)
            <li>
                <a
                    href="{{ $link['href'] }}"
                    @if ($currentPath === $link['path']) aria-current="page" @endif
                >
                    {{ $link['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
