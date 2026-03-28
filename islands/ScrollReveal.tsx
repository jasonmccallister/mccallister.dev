import { useEffect } from "preact/hooks";

export default function ScrollReveal() {
  useEffect(() => {
    if (globalThis.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      // Show everything immediately
      document.querySelectorAll(".reveal").forEach((el) => {
        el.classList.add("is-visible");
      });
      return;
    }

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1, rootMargin: "0px 0px -40px 0px" },
    );

    document.querySelectorAll(".reveal").forEach((el) => {
      observer.observe(el);
    });

    return () => observer.disconnect();
  }, []);

  return null;
}
