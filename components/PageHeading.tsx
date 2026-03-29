import type { ComponentChildren } from "preact";

interface PageHeadingProps {
  children: ComponentChildren;
}

export function PageHeading({ children }: PageHeadingProps) {
  return (
    <header class="mb-8">
      <h1 class="text-3xl md:text-4xl font-bold mb-4 flex items-center gap-3">
        <span class="text-primary font-mono">&gt;</span>
        {children}
      </h1>
    </header>
  );
}
