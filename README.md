# mccallister.dev

Personal blog built with Laravel, Blade, Tailwind CSS v4, and DaisyUI.

## Local development

Requirements: PHP 8.3+, Composer, Node.js 20+.

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
composer run dev
```

Visit [http://localhost:8000](http://localhost:8000).

## Content

- Posts: `content/posts/*.md`
- Pages: `content/pages/*.md`

Front matter fields for posts: `title`, `slug`, `date`, `readingTime`, `featured`, `featuredImage`, `description`, `tags`.

## Commands

| Command | Purpose |
|---------|---------|
| `composer run dev` | Local app + Vite |
| `npm run build` | Production assets |
| `php artisan test` | Run Pest tests |
| `vendor/bin/pint` | Format PHP |

## Laravel Cloud

Connect this repository in [Laravel Cloud](https://cloud.laravel.com) with a PHP runtime matching `composer.json`.

Suggested build commands:

```sh
composer install --no-dev
npm ci --audit false
npm run build
php artisan optimize
```

Suggested deploy command (if using a database):

```sh
php artisan migrate --force
```

Set at least `APP_KEY` in the environment. Content lives in the repo under `content/`, so no database is required for posts.
