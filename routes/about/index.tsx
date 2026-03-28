import { define } from "@/utils.ts";
import { Layout } from "@/components/Layout.tsx";
import { PageHeading } from "@/components/PageHeading.tsx";
import { ProseContent } from "@/components/ProseContent.tsx";
import { SectionHeading } from "@/components/SectionHeading.tsx";
import { getPage } from "@/lib/content.ts";
import { page } from "fresh";

export const handler = define.handlers({
  async GET(_ctx) {
    const pageData = await getPage("about");
    return page({ page: pageData });
  },
});

export default define.page<typeof handler>(function AboutPage({ data }) {
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
      currentPath="/about"
    >
      <div class="max-w-none">
        <PageHeading>{pageData.frontmatter.title}</PageHeading>

        <ProseContent html={pageData.html} />

        {/* Terminal-style skills section */}
        <div class="mt-12">
          <SectionHeading>Skills</SectionHeading>
          <div class="mockup-code bg-base-300">
            <pre data-prefix="$" class="text-primary">
              <code>cat skills.json | jq '.languages'</code>
            </pre>
            <pre data-prefix=">" class="text-success">
              <code>["Go", "PHP", "TypeScript", "Python", "Bash"]</code>
            </pre>
            <pre data-prefix="$" class="text-primary">
              <code>cat skills.json | jq '.tools'</code>
            </pre>
            <pre data-prefix=">" class="text-warning">
              <code>["Docker", "Kubernetes", "Dagger", "Git", "CI/CD"]</code>
            </pre>
            <pre data-prefix="$" class="text-primary">
              <code>cat skills.json | jq '.cloud'</code>
            </pre>
            <pre data-prefix=">" class="text-info">
              <code>["AWS", "GCP", "Azure", "Terraform"]</code>
            </pre>
          </div>
        </div>
      </div>
    </Layout>
  );
});
