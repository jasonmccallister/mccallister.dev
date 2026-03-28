import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { PageHeading } from "@/components/PageHeading.tsx";
import { ProseContent } from "@/components/ProseContent.tsx";
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
      currentPath="/appearances"
    >
      <div class="max-w-none">
        <PageHeading>{pageData.frontmatter.title}</PageHeading>

        <ProseContent html={pageData.html} />
      </div>
    </Layout>
  );
});
