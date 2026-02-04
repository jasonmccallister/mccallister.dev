import type { ComponentChildren } from "preact";
import ThemeToggle from "@/islands/ThemeToggle.tsx";

interface LayoutProps {
  children: ComponentChildren;
  title?: string;
  description?: string;
}

export function Layout({
  children,
  title = "mccallister.dev",
  description = "Go, PHP, containers and technology",
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
        <link rel="icon" href="/favicon.ico" />
        <link rel="stylesheet" href="/styles.css" />
        <script
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
      <body class="min-h-screen bg-base-100 text-base-content font-mono">
        <div class="drawer">
          <input id="nav-drawer" type="checkbox" class="drawer-toggle" />
          <div class="drawer-content flex flex-col">
            <Header />
            <main class="flex-1 container mx-auto px-4 py-8 max-w-4xl">
              {children}
            </main>
            <Footer />
          </div>
          <div class="drawer-side z-50">
            <label for="nav-drawer" class="drawer-overlay"></label>
            <MobileNav />
          </div>
        </div>
      </body>
    </html>
  );
}

function Header() {
  return (
    <header class="navbar bg-base-200 border-b border-base-300 sticky top-0 z-40">
      <div class="container mx-auto max-w-4xl flex items-center w-full">
        <div class="flex-none lg:hidden">
          <label for="nav-drawer" class="btn btn-square btn-ghost">
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
        <nav class="flex-none hidden lg:flex">
          <ul class="menu menu-horizontal px-1 gap-1">
            <li>
              <a href="/" class="hover:text-primary">Home</a>
            </li>
            <li>
              <a href="/about" class="hover:text-primary">About</a>
            </li>
            <li>
              <a href="/appearances" class="hover:text-primary">Appearances</a>
            </li>
          </ul>
        </nav>
        <div class="flex-none">
          <ThemeToggle />
        </div>
      </div>
    </header>
  );
}

function MobileNav() {
  return (
    <ul class="menu p-4 w-80 min-h-full bg-base-200">
      <li class="menu-title">
        <span class="text-primary">&gt;_</span> Navigation
      </li>
      <li>
        <a href="/">Home</a>
      </li>
      <li>
        <a href="/about">About</a>
      </li>
      <li>
        <a href="/appearances">Appearances</a>
      </li>
    </ul>
  );
}

function Footer() {
  return (
    <footer class="footer footer-center p-6 bg-base-200 text-base-content border-t border-base-300">
      <aside>
        <p class="font-mono">
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
            GitHub
          </a>
          <a
            href="https://x.com/mccallisterdev"
            target="_blank"
            rel="noopener noreferrer"
            class="link link-hover hover:text-primary"
          >
            X
          </a>
          <a
            href="https://www.linkedin.com/in/jason-mccallister/"
            target="_blank"
            rel="noopener noreferrer"
            class="link link-hover hover:text-primary"
          >
            LinkedIn
          </a>
        </div>
      </aside>
    </footer>
  );
}
