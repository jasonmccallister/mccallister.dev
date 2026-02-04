import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { PostCard } from "@/components/PostCard.tsx";
import { getFeaturedPosts, getPosts } from "@/lib/content.ts";

export default define.page(async function Home() {
  const posts = await getPosts();
  const featuredPosts = await getFeaturedPosts();
  const latestPosts = posts.filter((p) => !p.frontmatter.featured);

  return (
    <Layout
      title="mccallister.dev"
      description="Go, PHP, containers and technology"
    >
      <div class="space-y-12">
        {/* Hero Section */}
        <section class="text-center py-8">
          <h1 class="text-4xl font-bold mb-4">
            <span class="text-primary">&gt;</span> Jason McCallister
          </h1>
          <p class="text-xl opacity-80 font-mono">
            Go, PHP, containers and technology
          </p>
          <div class="divider max-w-xs mx-auto">
            <span class="text-primary font-mono text-sm">~/blog</span>
          </div>
        </section>

        {/* Featured Posts */}
        {featuredPosts.length > 0 && (
          <section>
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
              <span class="text-primary font-mono">#</span> Featured
            </h2>
            <div class="grid gap-6 md:grid-cols-2">
              {featuredPosts.map((post) => (
                <PostCard
                  key={post.frontmatter.slug}
                  post={post}
                  featured={true}
                />
              ))}
            </div>
          </section>
        )}

        {/* Latest Posts */}
        <section>
          <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <span class="text-primary font-mono">#</span> Latest
          </h2>
          <div class="space-y-4">
            {latestPosts.map((post) => (
              <PostCard key={post.frontmatter.slug} post={post} />
            ))}
          </div>
        </section>

        {/* Terminal-style CTA */}
        <section class="mockup-code bg-base-300">
          <pre data-prefix="$" class="text-primary">
            <code>whoami</code>
          </pre>
          <pre data-prefix=">" class="text-success">
            <code>Solutions Engineer | 20+ years experience</code>
          </pre>
          <pre data-prefix="$" class="text-primary">
            <code>cat interests.txt</code>
          </pre>
          <pre data-prefix=">" class="text-warning">
            <code>Go • PHP • Containers • Cloud • AI</code>
          </pre>
          <pre data-prefix="$" class="text-primary">
            <code>
              <a href="/about" class="link link-hover">
                ./learn-more.sh
              </a>
            </code>
          </pre>
        </section>
      </div>
    </Layout>
  );
});
