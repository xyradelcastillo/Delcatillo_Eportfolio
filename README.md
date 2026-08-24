# Personal Portfolio — Laravel + Tailwind CSS

A single-page, fully responsive personal portfolio website built with **Laravel**, **Blade** and **Tailwind CSS** (via Vite). No database — every piece of content lives in plain PHP arrays and Blade views. Includes a flash-free dark/light mode toggle, smooth anchor scrolling, a filterable project grid and self-hosted fonts/icons (no external requests).

## Requirements

- PHP **>= 8.2** (with `mbstring`, `openssl`, `curl`, `dom`, `fileinfo` extensions)
- Composer
- Node.js 18+ & npm

> ⚠️ On this machine XAMPP ships PHP 8.0, which is too old. A suitable PHP lives at
> `C:\tools\php83\php.exe` — prefix commands with it or put that folder first on your PATH.

## Getting started

```bash
# 1. Install PHP dependencies
composer install

# 2. Create your environment file (a ready-made .env already ships)
cp .env.example .env   # skip if .env exists
php artisan key:generate

# 3. Install frontend dependencies
npm install

# 4a. Development (hot reload)
npm run dev
php artisan serve

# 4b. Production build
npm run build
php artisan serve
```

Then open <http://127.0.0.1:8000>.

## Where to edit your content

Everything you see on the page is defined in **one place**:

| File | What lives there |
| --- | --- |
| `app/Http/Controllers/PortfolioController.php` | Name, role, headline, bio, email, phone, location, GitHub/LinkedIn URLs, avatar, quick stats, education timeline entries, project cards and category filters |

The arrays are commented — search for `EDIT:` markers:

```php
// app/Http/Controllers/PortfolioController.php
'name'    => 'Alex Carter',          // ← your name
'github'  => 'https://github.com/username', // ← your profile
```

### Projects

Each entry needs `title`, `slug`, `description`, `image`, `github`, `demo`, `tags` and a `category` key that matches one of the keys in `projectFilters()` (`apps`, `apis`, `oss`). Drop your own screenshots into `public/images/projects/`.

### Sections & layout

| File | Purpose |
| --- | --- |
| `resources/views/layouts/app.blade.php` | Base HTML, theme-init script, nav & footer includes |
| `resources/views/partials/navigation.blade.php` | Sticky navbar, anchor links, hamburger menu, theme toggle |
| `resources/views/partials/hero.blade.php` | Hero / basic information |
| `resources/views/partials/about.blade.php` | Bio, portrait, stats row |
| `resources/views/partials/education.blade.php` | Vertical timeline |
| `resources/views/partials/projects.blade.php` | Filterable project grid |
| `resources/views/partials/contact.blade.php` | Contact panel |
| `resources/views/partials/footer.blade.php` | Footer with social icons |
| `resources/views/components/icon.blade.php` | Inline SVG icon set |
| `resources/js/app.js` | Theme toggle, mobile menu, active-link highlight, project filters, scroll reveal |
| `resources/css/app.css` | Tailwind layers + shared component classes |
| `tailwind.config.js` | Tailwind config — `darkMode: 'class'`, font families |

## Dark / light & accent colors

- **Dark/light mode**: resolved **before first paint** by an inline `<script>` in `<head>` —
  reads `localStorage.theme`, falls back to OS `prefers-color-scheme`. Toggling flips the
  `dark` class on `<html>` (`darkMode: 'class'`) and persists.
- **Accent color**: the palette button in the navbar opens a swatch picker (indigo, violet,
  emerald, rose, amber, sky). All UI colors are driven by CSS variables (`--accent-*`) that
  Tailwind's config maps onto its `indigo` scale, so every component recolors instantly.
  The choice persists in `localStorage.accent` and is restored before first paint.
  Add a new palette by adding a `[data-accent='name']` block in `resources/css/app.css`
  and registering it in the init script + nav swatch list.

## CV (view / print / download)

The About section exposes three actions:

| Button | Behavior |
| --- | --- |
| **View** (eye) | Opens `/cv` — a standalone, print-styled CV page |
| **Print** (printer) | Opens `/cv?print=1`, which auto-launches the print dialog |
| **Download PDF** | GET `/cv/download` — generates a real PDF from your content on the fly |

The PDF is produced by a tiny dependency-free generator (`app/Support/CvPdf.php`) using
core Helvetica fonts — no external PDF library needed. Both the page and the PDF render
from the same content arrays, so editing `PortfolioController.php` updates everything.

## Notes

- **No database**: sessions/cache use the `file` driver; no migrations or Eloquent models exist.
- All icons are inline SVGs; all images are local SVG placeholders in `public/images/`.
