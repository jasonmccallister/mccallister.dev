@props(['post'])

<article class="py-8 border-b border-rule">
    <h3 class="text-[1.65rem] font-extrabold tracking-tight leading-snug mb-2">
        <a href="{{ route('content.show', $post->slug) }}" class="text-ink no-underline hover:text-accent">
            {{ $post->title }}
        </a>
    </h3>
    <p class="text-sm text-muted mb-3">
        <time datetime="{{ $post->date }}">
            {{ \App\Content\ContentRepository::formatDate($post->date) }}
        </time>
        <span aria-hidden="true"> – </span>
        <span>{{ $post->readingTime }}</span>
    </p>
    <p class="text-[1.05rem] text-muted leading-relaxed mb-4">
        {{ $post->description }}
    </p>
    @if (count($post->tags))
        <div class="flex flex-wrap gap-2">
            @foreach ($post->tags as $tag)
                <span class="tag">{{ $tag }}</span>
            @endforeach
        </div>
    @endif
</article>
