<?php

namespace App\Support;

use App\Content\Page;
use App\Content\Post;

class Seo
{
    /**
     * @param  array<string, mixed>|null  $jsonLd
     * @return array{title: string, description: string, type: string, image: string, canonical: string, jsonLd: list<array<string, mixed>>}
     */
    public static function forHome(?string $canonical = null): array
    {
        $canonical ??= url('/');
        $image = self::absoluteImage(config('site.default_og_image'));

        return [
            'title' => config('site.name'),
            'description' => config('site.tagline'),
            'type' => 'website',
            'image' => $image,
            'canonical' => $canonical,
            'jsonLd' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => config('site.name'),
                    'url' => $canonical,
                    'description' => config('site.tagline'),
                    'publisher' => self::personNode(),
                ],
                self::personNode(withContext: true),
            ],
        ];
    }

    /**
     * @return array{title: string, description: string, type: string, image: string, canonical: string, jsonLd: list<array<string, mixed>>}
     */
    public static function forPage(Page $page): array
    {
        $canonical = url('/'.$page->slug);
        $image = self::absoluteImage(config('site.default_og_image'));

        return [
            'title' => $page->title.' | '.config('site.name'),
            'description' => $page->description,
            'type' => 'website',
            'image' => $image,
            'canonical' => $canonical,
            'jsonLd' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebPage',
                    'name' => $page->title,
                    'description' => $page->description,
                    'url' => $canonical,
                    'isPartOf' => [
                        '@type' => 'WebSite',
                        'name' => config('site.name'),
                        'url' => url('/'),
                    ],
                    'author' => self::personNode(),
                ],
            ],
        ];
    }

    /**
     * @return array{title: string, description: string, type: string, image: string, canonical: string, jsonLd: list<array<string, mixed>>}
     */
    public static function forPost(Post $post): array
    {
        $canonical = url('/'.$post->slug);
        $imagePath = $post->featuredImage ?: config('site.default_og_image');
        $image = self::absoluteImage($imagePath);

        $blogPosting = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->description,
            'datePublished' => $post->date,
            'author' => self::personNode(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonical,
            ],
            'url' => $canonical,
        ];

        if ($image !== '') {
            $blogPosting['image'] = [$image];
        }

        return [
            'title' => $post->title.' | '.config('site.name'),
            'description' => $post->description,
            'type' => 'article',
            'image' => $image,
            'canonical' => $canonical,
            'jsonLd' => [$blogPosting],
        ];
    }

    public static function absoluteImage(?string $path): string
    {
        if ($path === null || $path === '') {
            return url((string) config('site.default_og_image'));
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url($path);
    }

    /**
     * @return array<string, mixed>
     */
    public static function personNode(bool $withContext = false): array
    {
        $person = [
            '@type' => 'Person',
            'name' => config('site.author.name'),
            'url' => url('/'),
            'image' => self::absoluteImage(config('site.author.image')),
            'sameAs' => array_values(config('site.author.sameAs', [])),
        ];

        if ($withContext) {
            $person = ['@context' => 'https://schema.org', ...$person];
        }

        return $person;
    }
}
