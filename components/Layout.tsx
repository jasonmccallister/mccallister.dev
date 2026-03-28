import type { ComponentChildren } from "preact";
import BootSequence from "@/islands/BootSequence.tsx";
import ScrollReveal from "@/islands/ScrollReveal.tsx";
import ThemeToggle from "@/islands/ThemeToggle.tsx";

const NAV_LINKS = [
  { href: "/", label: "Home" },
  { href: "/about", label: "About" },
  { href: "/appearances", label: "Appearances" },
];

interface LayoutProps {
  children: ComponentChildren;
  title?: string;
  description?: string;
  ogImage?: string;
  currentPath?: string;
}

export function Layout({
  children,
  title = "mccallister.dev",
  description = "Go, PHP, containers and technology",
  ogImage,
  currentPath = "/",
}: LayoutProps) {
  const fullTitle = title === "mccallister.dev"
    ? title
    : `${title} | mccallister.dev`;

  return (
    <html lang="en" data-theme="retro">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{fullTitle}</title>
        <meta name="description" content={description} />
        <meta property="og:title" content={fullTitle} />
        <meta property="og:description" content={description} />
        <meta
          property="og:type"
          content={title === "mccallister.dev" ? "website" : "article"}
        />
        {ogImage && <meta property="og:image" content={ogImage} />}
        <meta
          name="twitter:card"
          content={ogImage ? "summary_large_image" : "summary"}
        />
        <meta name="twitter:title" content={fullTitle} />
        <meta name="twitter:description" content={description} />
        {ogImage && <meta name="twitter:image" content={ogImage} />}
        <link rel="icon" href="/favicon.ico" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
          rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin="anonymous"
        />
        <link
          href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap"
          rel="stylesheet"
        />
        <link rel="stylesheet" href="/styles.css" />
        <script
          // deno-lint-ignore react-no-danger
          dangerouslySetInnerHTML={{
            __html: `
              (function() {
                const theme = localStorage.getItem('theme') ||
                  (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'retro');
                document.documentElement.setAttribute('data-theme', theme);
              })();
            `,
          }}
        />
      </head>
      <body class="min-h-screen bg-base-100 text-base-content">
        <BootSequence />
        <ScrollReveal />
        <a
          href="#main-content"
          class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary focus:text-primary-content focus:rounded"
        >
          Skip to content
        </a>
        <div class="drawer">
          <input id="nav-drawer" type="checkbox" class="drawer-toggle" />
          <div class="drawer-content flex flex-col">
            <Header currentPath={currentPath} />
            <main
              id="main-content"
              class="flex-1 container mx-auto px-4 py-8 max-w-4xl"
            >
              {children}
            </main>
            <Footer />
          </div>
          <div
            class="drawer-side z-50"
            onKeyDown={(e: KeyboardEvent) => {
              if (e.key === "Escape") {
                const el = document.getElementById(
                  "nav-drawer",
                ) as HTMLInputElement;
                if (el) el.checked = false;
              }
            }}
          >
            <label
              for="nav-drawer"
              class="drawer-overlay"
              aria-label="Close navigation menu"
            >
            </label>
            <MobileNav currentPath={currentPath} />
          </div>
        </div>
      </body>
    </html>
  );
}

function Header({ currentPath }: { currentPath: string }) {
  return (
    <header class="navbar bg-base-200 border-b border-base-300 sticky top-0 z-40 font-mono">
      <div class="container mx-auto max-w-4xl flex items-center w-full">
        <div class="flex-none lg:hidden">
          <label
            for="nav-drawer"
            class="btn btn-square btn-ghost"
            aria-label="Open navigation menu"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              class="inline-block w-6 h-6 stroke-current"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              >
              </path>
            </svg>
          </label>
        </div>
        <div class="flex-1">
          <a href="/" class="btn btn-ghost text-xl font-bold tracking-tight">
            <span class="text-primary">&gt;_</span> mccallister.dev
          </a>
        </div>
        <nav class="flex-none hidden lg:flex" aria-label="Main navigation">
          <ul class="menu menu-horizontal px-1 gap-1">
            {NAV_LINKS.map(({ href, label }) => (
              <li key={href}>
                <a
                  href={href}
                  class="hover:text-primary"
                  {...(currentPath === href ? { "aria-current": "page" } : {})}
                >
                  {label}
                </a>
              </li>
            ))}
          </ul>
        </nav>
        <div class="flex-none">
          <ThemeToggle />
        </div>
      </div>
    </header>
  );
}

function MobileNav({ currentPath }: { currentPath: string }) {
  return (
    <nav aria-label="Mobile navigation">
      <ul class="menu p-4 w-80 min-h-full bg-base-200">
        <li class="menu-title">
          <span class="text-primary">&gt;_</span> Navigation
        </li>
        {NAV_LINKS.map(({ href, label }) => (
          <li key={href}>
            <a
              href={href}
              {...(currentPath === href ? { "aria-current": "page" } : {})}
            >
              {label}
            </a>
          </li>
        ))}
      </ul>
    </nav>
  );
}

function Footer() {
  return (
    <footer class="footer footer-center p-6 bg-base-200 text-base-content border-t border-base-300 font-mono">
      <aside>
        <p>
          <span class="text-primary">&gt;</span> mccallister.dev &copy;{" "}
          {new Date().getFullYear()}
        </p>
        <div class="flex gap-4 mt-2">
          <a
            href="https://github.com/jasonmccallister"
            target="_blank"
            rel="noopener noreferrer"
            class="link link-hover hover:text-primary"
          >
            GitHub<span class="sr-only">(opens in new tab)</span>
          </a>
          <a
            href="https://x.com/mccallisterdev"
            target="_blank"
            rel="noopener noreferrer"
            class="link link-hover hover:text-primary"
          >
            X<span class="sr-only">(opens in new tab)</span>
          </a>
          <a
            href="https://www.linkedin.com/in/jason-mccallister/"
            target="_blank"
            rel="noopener noreferrer"
            class="link link-hover hover:text-primary"
          >
            LinkedIn<span class="sr-only">(opens in new tab)</span>
          </a>
        </div>
      </aside>
    </footer>
  );
}
