import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { ProseContent } from "@/components/ProseContent.tsx";
import { formatDate, getPost } from "@/lib/content.ts";
import { HttpError, page } from "fresh";

export const handler = define.handlers({
  async GET(ctx) {
    const slug = ctx.params.slug;
    const post = await getPost(slug);

    if (!post) {
      throw new HttpError(404);
    }

    return page({ post });
  },
});

export default define.page<typeof handler>(function PostPage({ data }) {
  const { post } = data;

  if (!post) {
    // throw 404 error to trigger notFound handler in main.ts
    throw new HttpError(404);
  }

  const { frontmatter, html } = post;

  return (
    <Layout
      title={frontmatter.title}
      description={frontmatter.description}
      ogImage={frontmatter.featuredImage}
      currentPath={`/${frontmatter.slug}`}
    >
      <article class="max-w-none">
        {/* Post Header */}
        <header class="mb-8">
          <div class="flex flex-wrap gap-2 mb-4">
            {frontmatter.tags.map((tag) => (
              <span
                class="badge badge-primary badge-outline font-mono"
                key={tag}
              >
                {tag}
              </span>
            ))}
          </div>
          <h1 class="text-3xl md:text-4xl font-bold mb-4">
            {frontmatter.title}
          </h1>
          <div class="flex items-center gap-4 text-sm text-base-content/60 font-mono">
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
              alt=""
              class="w-full"
              loading="eager"
            />
          </figure>
        )}

        {/* Post Content */}
        <ProseContent html={html} />

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
