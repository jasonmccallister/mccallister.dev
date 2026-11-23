<?php

namespace App\Content;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
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
        $internalHost = parse_url((string) config('app.url'), PHP_URL_HOST) ?: 'localhost';

        $environment = new Environment([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
            // GFM escapes iframe by default; allow embeds while keeping other raw tags blocked.
            'disallowed_raw_html' => [
                'disallowed_tags' => [
                    'title',
                    'textarea',
                    'style',
                    'xmp',
                    'noembed',
                    'noframes',
                    'script',
                    'plaintext',
                ],
            ],
            'heading_permalink' => [
                'html_class' => 'anchor',
                'id_prefix' => '',
                'fragment_prefix' => '',
                'insert' => 'before',
                'symbol' => '#',
                'title' => 'Permalink',
            ],
            'external_link' => [
                'internal_hosts' => '/(^|\.)'.preg_quote($internalHost, '/').'$/',
                'open_in_new_window' => true,
                'html_class' => 'external-link',
                'nofollow' => '',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],
        ]);

        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new HeadingPermalinkExtension);
        $environment->addExtension(new ExternalLinkExtension);

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

    /**
     * @return Collection<int, Page>
     */
    public function pages(): Collection
    {
        $pagesPath = base_path('content/pages');

        if (! is_dir($pagesPath)) {
            return collect();
        }

        $finder = (new Finder)
            ->files()
            ->in($pagesPath)
            ->name('*.md');

        $pages = collect();

        foreach ($finder as $file) {
            $slug = $file->getBasename('.md');
            $page = $this->page($slug);

            if ($page !== null) {
                $pages->push($page);
            }
        }

        return $pages->sortBy(fn (Page $page) => $page->slug)->values();
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
