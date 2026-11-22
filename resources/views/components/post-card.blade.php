@props(['post', 'featured' => false])

@if ($featured && $post->featuredImage)
    <article class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow border border-base-300">
        <figure class="relative">
            <img
                src="{{ $post->featuredImage }}"
                alt="Featured image for {{ $post->title }}"
                class="w-full h-48 object-cover"
                loading="lazy"
            >
            <div class="absolute top-2 right-2">
                <span class="badge badge-primary badge-sm font-mono">Featured</span>
            </div>
        </figure>
        <div class="card-body">
            <h2 class="card-title font-bold">
                <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-primary transition-colors">
                    {{ $post->title }}
                </a>
            </h2>
            <div class="flex items-center gap-2 text-sm text-base-content/60 font-mono">
                <time datetime="{{ $post->date }}">
                    {{ \App\Content\ContentRepository::formatDate($post->date) }}
                </time>
                <span>•</span>
                <span>{{ $post->readingTime }}</span>
            </div>
            <p class="text-base-content/70">{{ $post->description }}</p>
            <div class="card-actions justify-start mt-2">
                @foreach ($post->tags as $tag)
                    <span class="badge badge-outline badge-sm font-mono">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    </article>
@else
    <article class="card bg-base-200 hover:bg-base-300 transition-colors border border-base-300">
        <div class="card-body">
            <h3 class="card-title text-lg font-bold">
                <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-primary transition-colors">
                    {{ $post->title }}
                </a>
            </h3>
            <div class="flex items-center gap-2 text-sm text-base-content/60 font-mono">
                <time datetime="{{ $post->date }}">
                    {{ \App\Content\ContentRepository::formatDate($post->date) }}
                </time>
                <span>•</span>
                <span>{{ $post->readingTime }}</span>
            </div>
            <p class="text-base-content/70 text-sm">{{ $post->description }}</p>
            <div class="card-actions justify-start mt-2">
                @foreach ($post->tags as $tag)
                    <span class="badge badge-outline badge-xs font-mono">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    </article>
@endif
