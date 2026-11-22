<?php

namespace App\Content;

readonly class Post
{
    /**
     * @param  list<string>  $tags
     */
    public function __construct(
        public string $title,
        public string $slug,
        public string $date,
        public string $readingTime,
        public bool $featured,
        public ?string $featuredImage,
        public string $description,
        public array $tags,
        public string $html,
    ) {}
}
