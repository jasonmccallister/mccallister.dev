<?php

namespace App\Content;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\MarkdownConverter;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Finder\Finder;

class ContentRepository
{
    private MarkdownConverter $converter;

    public function __construct()
    {
        $environment = new Environment([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
            'heading_permalink' => [
                'html_class' => 'anchor',
                'id_prefix' => '',
                'fragment_prefix' => '',
                'insert' => 'before',
                'symbol' => '#',
                'title' => 'Permalink',
            ],
        ]);

        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new HeadingPermalinkExtension);

        $this->converter = new MarkdownConverter($environment);
    }

    /**
     * @return Collection<int, Post>
     */
    public function posts(): Collection
    {
        $postsPath = base_path('content/posts');

        if (! is_dir($postsPath)) {
            return collect();
        }

        $finder = (new Finder)
            ->files()
            ->in($postsPath)
            ->name('*.md');

        $posts = collect();

        foreach ($finder as $file) {
            $document = YamlFrontMatter::parse($file->getContents());
            $matter = $document->matter();

            $posts->push(new Post(
                title: (string) ($matter['title'] ?? ''),
                slug: (string) ($matter['slug'] ?? ''),
                date: (string) ($matter['date'] ?? ''),
                readingTime: (string) ($matter['readingTime'] ?? ''),
                featured: (bool) ($matter['featured'] ?? false),
                featuredImage: isset($matter['featuredImage']) ? (string) $matter['featuredImage'] : null,
                description: (string) ($matter['description'] ?? ''),
                tags: array_values(array_map('strval', $matter['tags'] ?? [])),
                html: $this->converter->convert($document->body())->getContent(),
            ));
        }

        return $posts
            ->sortByDesc(fn (Post $post) => $post->date)
            ->values();
    }

    public function post(string $slug): ?Post
    {
        return $this->posts()->first(fn (Post $post) => $post->slug === $slug);
    }

    /**
     * @return Collection<int, Post>
     */
    public function featuredPosts(): Collection
    {
        return $this->posts()->filter(fn (Post $post) => $post->featured)->values();
    }

    public function page(string $slug): ?Page
    {
        $path = base_path("content/pages/{$slug}.md");

        if (! is_file($path)) {
            return null;
        }

        $document = YamlFrontMatter::parse(file_get_contents($path) ?: '');
        $matter = $document->matter();

        return new Page(
            title: (string) ($matter['title'] ?? ''),
            slug: (string) ($matter['slug'] ?? $slug),
            description: (string) ($matter['description'] ?? ''),
            html: $this->converter->convert($document->body())->getContent(),
        );
    }

    public static function formatDate(string $date): string
    {
        return Carbon::parse($date)
            ->locale('en_US')
            ->isoFormat('MMMM D, YYYY');
    }
}
