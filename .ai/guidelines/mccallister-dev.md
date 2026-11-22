# mccallister.dev project guidelines

- This is a personal markdown-driven blog. Prefer editing files under `content/` over introducing a database CMS.
- Keep post URLs at the site root (`/{slug}`). Register static routes before the `{slug}` catch-all.
- Preserve the DaisyUI retro + dark theme, primary `#3432ee`, Source Sans body, mono accents.
- Do not reintroduce a boot/splash screen.
- Deploy target is Laravel Cloud: build with Composer + `npm run build` + `php artisan optimize`.
