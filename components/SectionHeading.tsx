import type { ComponentChildren } from "preact";

interface SectionHeadingProps {
  children: ComponentChildren;
}

export function SectionHeading({ children }: SectionHeadingProps) {
  return (
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
      <span class="text-primary font-mono">#</span> {children}
    </h2>
  );
}
