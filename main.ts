import { App, staticFiles } from "fresh";
import { type State } from "./utils.ts";

export const app = new App<State>();

app.use(staticFiles());

// Trailing slash redirect middleware for Ghost URL compatibility
// Ghost URLs use trailing slashes, so redirect /path/ to /path
app.use(async (ctx) => {
  const url = new URL(ctx.req.url);
  const path = url.pathname;

  // Skip root path and static files
  if (path === "/" || path.startsWith("/_fresh") || path.includes(".")) {
    return await ctx.next();
  }

  // Remove trailing slash and redirect
  if (path.endsWith("/")) {
    const newPath = path.slice(0, -1);
    url.pathname = newPath;
    return new Response(null, {
      status: 301,
      headers: { Location: url.toString() },
    });
  }

  return await ctx.next();
});

// Include file-system based routes here
app.fsRoutes();
