<?php

namespace App\Content;

readonly class Page
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $description,
        public string $html,
    ) {}
}
