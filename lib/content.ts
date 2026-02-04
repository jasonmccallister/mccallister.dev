import { extract } from "@std/front-matter/yaml";
import { render } from "@deno/gfm";

export interface PostFrontmatter {
  title: string;
  slug: string;
  date: string;
  readingTime: string;
  featured: boolean;
  featuredImage?: string;
  description: string;
  tags: string[];
}

export interface PageFrontmatter {
  title: string;
  slug: string;
  description: string;
}

export interface Post {
  frontmatter: PostFrontmatter;
  content: string;
  html: string;
}

export interface Page {
  frontmatter: PageFrontmatter;
  content: string;
  html: string;
}

export async function getPosts(): Promise<Post[]> {
  const posts: Post[] = [];
  const postsDir = "./content/posts";

  for await (const entry of Deno.readDir(postsDir)) {
    if (entry.isFile && entry.name.endsWith(".md")) {
      const content = await Deno.readTextFile(`${postsDir}/${entry.name}`);
      const { attrs, body } = extract<PostFrontmatter>(content);
      posts.push({
        frontmatter: attrs,
        content: body,
        html: render(body, {
          allowedTags: ["iframe"],
          allowedAttributes: {
            iframe: [
              "src",
              "width",
              "height",
              "frameborder",
              "allowfullscreen",
            ],
          },
        }),
      });
    }
  }

  // Sort by date descending
  posts.sort(
    (a, b) =>
      new Date(b.frontmatter.date).getTime() -
      new Date(a.frontmatter.date).getTime(),
  );

  return posts;
}

export async function getPost(slug: string): Promise<Post | null> {
  const posts = await getPosts();
  return posts.find((p) => p.frontmatter.slug === slug) || null;
}

export async function getFeaturedPosts(): Promise<Post[]> {
  const posts = await getPosts();
  return posts.filter((p) => p.frontmatter.featured);
}

export async function getPage(slug: string): Promise<Page | null> {
  try {
    const content = await Deno.readTextFile(`./content/pages/${slug}.md`);
    const { attrs, body } = extract<PageFrontmatter>(content);
    return {
      frontmatter: attrs,
      content: body,
      html: render(body, {
        allowedTags: ["iframe"],
        allowedAttributes: {
          iframe: ["src", "width", "height", "frameborder", "allowfullscreen"],
        },
      }),
    };
  } catch {
    return null;
  }
}

export function formatDate(dateString: string): string {
  const date = new Date(dateString);
  return date.toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
}
