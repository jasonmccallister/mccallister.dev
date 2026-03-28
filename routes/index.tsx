import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { PostCard } from "@/components/PostCard.tsx";
import { SectionHeading } from "@/components/SectionHeading.tsx";
import { getFeaturedPosts, getPosts } from "@/lib/content.ts";

export default define.page(async function Home() {
  const posts = await getPosts();
  const featuredPosts = await getFeaturedPosts();
  const latestPosts = posts.filter((p) => !p.frontmatter.featured);

  return (
    <Layout
      title="mccallister.dev"
      description="Go, PHP, containers and technology"
      currentPath="/"
    >
      <div class="space-y-12">
        {/* Hero Section */}
        <section class="text-center py-8">
          <h1 class="text-4xl font-bold mb-4 animate-fade-up">
            <span class="text-primary">&gt;</span> Jason McCallister
          </h1>
          <p class="text-xl text-base-content/70 font-mono animate-fade-up animate-delay-1">
            Go, PHP, containers and technology
          </p>
          <div class="divider max-w-xs mx-auto animate-fade-up animate-delay-2">
            <span class="text-primary font-mono text-sm">~/blog</span>
          </div>
        </section>

        {/* Featured Posts */}
        {featuredPosts.length > 0 && (
          <section class="reveal">
            <SectionHeading>Featured</SectionHeading>
            <div class="grid gap-6 md:grid-cols-2">
              {featuredPosts.map((post) => (
                <PostCard
                  key={post.frontmatter.slug}
                  post={post}
                  featured
                />
              ))}
            </div>
          </section>
        )}

        {/* Latest Posts */}
        <section class="reveal">
          <SectionHeading>Latest</SectionHeading>
          <div class="space-y-4">
            {latestPosts.map((post) => (
              <PostCard key={post.frontmatter.slug} post={post} />
            ))}
          </div>
        </section>

        {/* Terminal-style CTA */}
        <section class="mockup-code bg-base-300 reveal">
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
