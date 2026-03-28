interface ProseContentProps {
  html: string;
  class?: string;
}

export function ProseContent({ html, class: className }: ProseContentProps) {
  return (
    <div
      class={`prose prose-lg max-w-none ${className ?? ""}`}
      // deno-lint-ignore react-no-danger
      dangerouslySetInnerHTML={{ __html: html }}
    />
  );
}
