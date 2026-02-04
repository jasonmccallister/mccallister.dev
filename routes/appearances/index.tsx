import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { getPage } from "@/lib/content.ts";
import { page } from "fresh";

export const handler = define.handlers({
  async GET(_ctx) {
    const pageData = await getPage("appearances");
    return page({ page: pageData });
  },
});

export default define.page<typeof handler>(function AppearancesPage({ data }) {
  const pageData = data.page;

  if (!pageData) {
    return (
      <Layout title="Not Found">
        <div class="text-center py-16">
          <p>Page not found</p>
        </div>
      </Layout>
    );
  }

  return (
    <Layout
      title={pageData.frontmatter.title}
      description={pageData.frontmatter.description}
    >
      <div class="max-w-none">
        <header class="mb-8">
          <h1 class="text-3xl md:text-4xl font-bold mb-4 flex items-center gap-3">
            <span class="text-primary font-mono">&gt;</span>
            {pageData.frontmatter.title}
          </h1>
        </header>

        <div
          class="prose prose-lg max-w-none
            prose-headings:font-bold
            prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4
            prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3
            prose-p:leading-relaxed
            prose-a:text-primary prose-a:no-underline hover:prose-a:underline
            prose-code:bg-base-300 prose-code:px-1 prose-code:py-0.5 prose-code:rounded prose-code:font-mono prose-code:text-sm
            prose-li:marker:text-primary
            prose-strong:text-base-content"
          dangerouslySetInnerHTML={{ __html: pageData.html }}
        />
      </div>
    </Layout>
  );
});
