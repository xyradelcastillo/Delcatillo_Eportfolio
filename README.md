# Personal Portfolio — Xyra G. Delcastillo

A single-page, fully responsive personal portfolio website built with **Laravel**, **Blade** and **Tailwind CSS**. It presents the owner's basic information, short bio, portrait, educational background, certificates, and a filterable grid of academic/personal projects — along with printable/downloadable CV and resume pages.

The site uses **no database**: every piece of content lives in plain PHP arrays and Blade views, so the whole portfolio is easy to maintain.

## Features & sections

| Section | What it shows |
| --- | --- |
| **Hero** | Name, role/tagline, headline, short bio, availability badge, avatar, resume call-to-action and social links |
| **About** | Portrait image, expanded bio, quick statistics |
| **Education & Certificates** | Vertical education timeline plus certificate/achievement cards |
| **Projects** | Card grid with screenshot, description, tags, and **Demo** / **GitHub** buttons; filterable by category (all / school / web / database) |
| **Contact** | Contact information cards (location, email, phone, GitHub, socials) |
| **Footer** | Social icons and attribution |

### Extras

- **Dark / light theme toggle** — resolved before first paint from `localStorage` / OS preference; persisted with the `dark` class.
- **Accent color picker** — six palettes (indigo default, violet, emerald, rose, amber, sky) driven by CSS variables (`--accent-*`) mapped onto Tailwind's `indigo` scale via `[data-accent]` on `<html>`.
- **Mobile responsive nav** — hamburger menu, scroll shadow on the navbar, active-section highlighting and per-section browser tab titles.
- **Reveal-on-scroll animations**, filter buttons and smooth anchor scrolling — vanilla JavaScript, no front-end framework.
- **Self-hosted fonts & inline SVG icons** — Inter and Space Grotesk are bundled via Fontsource; no external requests.

- **PHP ^8.3** and **Laravel ^13** (framework only — no database, no Eloquent)
- **Blade templates** with custom components and partials
- **Tailwind CSS ^3.4** (`darkMode: 'class'`), PostCSS + Autoprefixer
- **Vite ^8** with `laravel-vite-plugin` for asset bundling
- **Vanilla JavaScript** (`resources/js/app.js`) for all interactions
- **Self-hosted Fontsource variable fonts** — Inter and Space Grotesk

### Projects

Each project entry needs `title`, `description`, `image`, optional `demo` and `github` URLs, `tags`, and a `category` matching one of the keys in `projectFilters()` (`all`, `school`, `web`, `database`). Put your own screenshots in `public/images/projects/`.

## Requirements

- **PHP ^8.3** (with `mbstring`, `openssl`, `curl`, `dom`, `fileinfo` extensions)
- **Composer**
- **Node.js 20.19+ (or 22.12+)** and npm — required by Vite 8

