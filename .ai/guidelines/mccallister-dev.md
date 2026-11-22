# mccallister.dev project guidelines

- This is a personal markdown-driven blog. Prefer editing files under `content/` over introducing a database CMS.
- Keep post URLs at the site root (`/{slug}`). Register static routes before the `{slug}` catch-all.
- Visual direction: freek.dev-inspired — IBM Plex Sans + Mono, coral accent `#F87171`, bold titles, pill tags; no DaisyUI or terminal motifs.
- Do not reintroduce a boot/splash screen or prompt-style chrome (`>_`, fake shell blocks).
- Deploy target is Laravel Cloud: build with Composer + `npm run build` + `php artisan optimize`.
