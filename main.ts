import { App, staticFiles, trailingSlashes } from "fresh";
import { type State } from "./utils.ts";
import { NotFound } from "./components/NotFound.tsx";

export const app = new App<State>();

app.use(staticFiles());

// Trailing slash redirect middleware for Ghost URL compatibility
// Ghost URLs use trailing slashes, so redirect /path/ to /path
app.use(trailingSlashes("never"));

// Include file-system based routes here
app.fsRoutes();

app.notFound((ctx) => {
  return ctx.render(NotFound({ path: new URL(ctx.req.url).pathname }));
});
