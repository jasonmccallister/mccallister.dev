import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { getPost, formatDate } from "@/lib/content.ts";
import { page } from "fresh";

export const handler = define.handlers({
  async GET(ctx) {
    const slug = ctx.params.slug;
    const post = await getPost(slug);

    if (!post) {
      return page({ post: null, slug });
    }

    return page({ post, slug });
  },
});

export default define.page<typeof handler>(function PostPage({ data }) {
  const { post, slug } = data;

  if (!post) {
    return (
      <Layout title="Not Found">
        <div class="text-center py-16">
          <div class="mockup-code bg-base-300 max-w-md mx-auto">
            <pre data-prefix="$" class="text-error">
              <code>cat {slug}.md</code>
            </pre>
            <pre data-prefix=">" class="text-error">
              <code>Error: Post not found</code>
            </pre>
          </div>
          <a href="/" class="btn btn-primary mt-8">
            &lt;- Back to Home
          </a>
        </div>
      </Layout>
    );
  }

  const { frontmatter, html } = post;

  return (
    <Layout title={frontmatter.title} description={frontmatter.description}>
      <article class="max-w-none">
        {/* Post Header */}
        <header class="mb-8">
          <div class="flex flex-wrap gap-2 mb-4">
            {frontmatter.tags.map((tag) => (
              <span class="badge badge-primary badge-outline font-mono" key={tag}>
                {tag}
              </span>
            ))}
          </div>
          <h1 class="text-3xl md:text-4xl font-bold mb-4">{frontmatter.title}</h1>
          <div class="flex items-center gap-4 text-sm opacity-70 font-mono">
            <time datetime={frontmatter.date}>
              {formatDate(frontmatter.date)}
            </time>
            <span>•</span>
            <span>{frontmatter.readingTime}</span>
          </div>
        </header>

        {/* Featured Image */}
        {frontmatter.featuredImage && (
          <figure class="mb-8 rounded-lg overflow-hidden border border-base-300">
            <img
              src={frontmatter.featuredImage}
              alt={frontmatter.title}
              class="w-full"
              loading="lazy"
            />
          </figure>
        )}

        {/* Post Content */}
        <div
          class="prose prose-lg max-w-none
            prose-headings:font-bold
            prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4
            prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3
            prose-p:leading-relaxed
            prose-a:text-primary prose-a:no-underline hover:prose-a:underline
            prose-code:bg-base-300 prose-code:px-1 prose-code:py-0.5 prose-code:rounded prose-code:font-mono prose-code:text-sm
            prose-pre:bg-base-300 prose-pre:border prose-pre:border-base-300
            prose-blockquote:border-l-primary prose-blockquote:bg-base-200 prose-blockquote:py-1 prose-blockquote:px-4
            prose-li:marker:text-primary
            prose-strong:text-base-content"
          dangerouslySetInnerHTML={{ __html: html }}
        />

        {/* Back Link */}
        <div class="mt-12 pt-8 border-t border-base-300">
          <a href="/" class="btn btn-outline btn-sm font-mono">
            <span class="text-primary">&lt;-</span> Back to all posts
          </a>
        </div>
      </article>
    </Layout>
  );
});
