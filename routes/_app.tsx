import { define } from "@/utils.ts";

// Layout is handled by the individual pages via the Layout component
// This just passes through the Component
export default define.page(function App({ Component }) {
  return <Component />;
});
