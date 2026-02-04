import type { Post } from "@/lib/content.ts";
import { formatDate } from "@/lib/content.ts";

interface PostCardProps {
  post: Post;
  featured?: boolean;
}

export function PostCard({ post, featured = false }: PostCardProps) {
  const { frontmatter } = post;

  if (featured && frontmatter.featuredImage) {
    return (
      <article class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow border border-base-300">
        <figure class="relative">
          <img
            src={frontmatter.featuredImage}
            alt={frontmatter.title}
            class="w-full h-48 object-cover"
            loading="lazy"
          />
          <div class="absolute top-2 right-2">
            <span class="badge badge-primary badge-sm font-mono">Featured</span>
          </div>
        </figure>
        <div class="card-body">
          <h2 class="card-title font-bold">
            <a
              href={`/${frontmatter.slug}`}
              class="hover:text-primary transition-colors"
            >
              {frontmatter.title}
            </a>
          </h2>
          <div class="flex items-center gap-2 text-sm opacity-70 font-mono">
            <time datetime={frontmatter.date}>
              {formatDate(frontmatter.date)}
            </time>
            <span>•</span>
            <span>{frontmatter.readingTime}</span>
          </div>
          <p class="text-base-content/80">{frontmatter.description}</p>
          <div class="card-actions justify-start mt-2">
            {frontmatter.tags.map((tag) => (
              <span class="badge badge-outline badge-sm font-mono" key={tag}>
                {tag}
              </span>
            ))}
          </div>
        </div>
      </article>
    );
  }

  return (
    <article class="card bg-base-200 hover:bg-base-300 transition-colors border border-base-300">
      <div class="card-body">
        <h3 class="card-title text-lg font-bold">
          <a
            href={`/${frontmatter.slug}`}
            class="hover:text-primary transition-colors"
          >
            {frontmatter.title}
          </a>
        </h3>
        <div class="flex items-center gap-2 text-sm opacity-70 font-mono">
          <time datetime={frontmatter.date}>
            {formatDate(frontmatter.date)}
          </time>
          <span>•</span>
          <span>{frontmatter.readingTime}</span>
        </div>
        <p class="text-base-content/80 text-sm">{frontmatter.description}</p>
        <div class="card-actions justify-start mt-2">
          {frontmatter.tags.map((tag) => (
            <span class="badge badge-outline badge-xs font-mono" key={tag}>
              {tag}
            </span>
          ))}
        </div>
      </div>
    </article>
  );
}
