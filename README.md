# Personal Portfolio — Xyra G. Delcastillo

A single-page, fully responsive personal portfolio website built with **Laravel**, **Blade** and **Tailwind CSS**. It presents the owner's basic information, short bio, portrait, educational background, certificates, and a filterable grid of academic/personal projects — along with printable/downloadable CV and resume pages, and a working contact form.

The site uses **no database**: every piece of content lives in plain PHP arrays and Blade views, so the whole portfolio is easy to maintain.

## Features & sections

| Section | What it shows |
| --- | --- |
| **Hero** | Name, role/tagline, headline, short bio, availability badge, avatar, resume call-to-action and social links |
| **About** | Portrait image, expanded bio, quick statistics |
| **Education & Certificates** | Vertical education timeline plus certificate/achievement cards |
| **Projects** | Card grid with screenshot, description, tags, and **Demo** / **GitHub** buttons; filterable by category (all / school / web / database) |
| **Contact** | Contact information cards (location, email, phone, GitHub, socials) plus a working contact form |
| **Footer** | Social icons and attribution |

### Extras

- **Dark / light theme toggle** — resolved before first paint from `localStorage` / OS preference; persisted with the `dark` class.
- **Accent color picker** — six palettes (indigo default, violet, emerald, rose, amber, sky) driven by CSS variables (`--accent-*`) mapped onto Tailwind's `indigo` scale via `[data-accent]` on `<html>`.
- **Mobile responsive nav** — hamburger menu, scroll shadow on the navbar, active-section highlighting and per-section browser tab titles.
- **Reveal-on-scroll animations**, filter buttons and smooth anchor scrolling — vanilla JavaScript, no front-end framework.
- **Self-hosted fonts & inline SVG icons** — Inter and Space Grotesk are bundled via Fontsource; no external requests.

### CV & Resume

| Route | Behavior |
| --- | --- |
| `/cv` | Standalone, print-styled CV page rendered from the same content arrays |
| `/cv?print=1` | Opens the CV and auto-launches the print dialog |
| `/cv/download` | Generates a real PDF on the fly (dependency-free generator in `app/Support/CvPdf.php`, core Helvetica fonts) |
| `/resume` | Viewers for the resume file (`public/files/My Resume.pdf`) inside an iframe, with Download and Print buttons |

### Contact form

The form in the Contact section posts `name`, `email`, `subject` and `message` to a standalone `send.php` script, which delivers the message via **PHPMailer** using your Gmail address and an SMTP app password. Success and error states are shown inline.

> ⚠️ **Security note:** `send.php` stores the Gmail app password in plain text. Keep this file out of version control — do **not** push it to a public GitHub repository.

## Technologies used

- **PHP ^8.3** and **Laravel ^13** (framework only — no database, no Eloquent)
- **Blade templates** with custom components and partials
- **Tailwind CSS ^3.4** (`darkMode: 'class'`), PostCSS + Autoprefixer
- **Vite ^8** with `laravel-vite-plugin` for asset bundling
- **Vanilla JavaScript** (`resources/js/app.js`) for all interactions
- **PHPMailer** (vendored copy in `mailer/src/`) for the contact mailer
- **Self-hosted Fontsource variable fonts** — Inter and Space Grotesk

## Project structure

| File / directory | Purpose |
| --- | --- |
| `app/Http/Controllers/PortfolioController.php` | **All portfolio content** — profile info, bio, stats, education, certificates, projects and category filters (search for `EDIT:` markers) |
| `app/Support/CvPdf.php` | Dependency-free PDF generator for the CV download |
| `routes/web.php` | The four routes: `/`, `/cv`, `/cv/download`, `/resume` |
| `resources/views/layouts/app.blade.php` | Base HTML, theme-init script, nav & footer includes |
| `resources/views/home.blade.php` | Single-page home layout, includes all partials |
| `resources/views/cv.blade.php` | Print-styled CV page |
| `resources/views/resume.blade.php` | Resume PDF viewer (Download / Print) |
| `resources/views/partials/*.blade.php` | Hero, about, education, projects, contact, navigation, footer |
| `resources/views/components/*.blade.php` | Reusable `icon` (SVG set) and `section-heading` components |
| `resources/js/app.js` | Theme toggle, accent picker, mobile menu, project filters, scroll reveal |
| `resources/css/app.css` | Tailwind layers, accent palettes (`[data-accent=...]`), component classes |
| `tailwind.config.js` | Tailwind config — `darkMode: 'class'`, accent CSS variables, font families |
| `vite.config.js` | Vite input configuration for Blade + JS |
| `send.php` + `mailer/src/` | Contact mailer built on the vendored PHPMailer copy |
| `public/images/` | Avatar (`xyra.jpg`), logo, and project screenshots (`images/projects/`) |
| `public/files/` | `My Resume.pdf` used by the resume route |

## Editing your content

All visible content is defined in **one file** — `app/Http/Controllers/PortfolioController.php`. The arrays are commented with `EDIT:` markers:

```php
// app/Http/Controllers/PortfolioController.php
'name'  => 'Xyra G. Delcastillo',                       // ← your name
'email' => 'xyradelcastillo@gmail.com',                 // ← contact email
'github'=> 'https://github.com/xyradelcastillo',        // ← profile URL
```

### Projects

Each project entry needs `title`, `description`, `image`, optional `demo` and `github` URLs, `tags`, and a `category` matching one of the keys in `projectFilters()` (`all`, `school`, `web`, `database`). Put your own screenshots in `public/images/projects/`.

## Requirements

- **PHP ^8.3** (with `mbstring`, `openssl`, `curl`, `dom`, `fileinfo` extensions)
- **Composer**
- **Node.js 20.19+ (or 22.12+)** and npm — required by Vite 8

> ⚠️ On this machine the XAMPP CLI ships PHP 8.0, which is too old for Laravel 13.
> A suitable PHP lives at `C:\tools\php83\php.exe` — prefix commands with it or put
> that folder first on your PATH.

## Running locally

```bash
# 1. Install PHP dependencies
composer install -o

# 2. Create an environment file and generate the app key
#    (no .env.example ships with this project — copy this minimal file:)
copy .env  # or create .env manually, then:
php artisan key:generate
```

Minimal `.env` (the project has no database — `APP_KEY` is the only required setting):

```env
APP_NAME="E Portfolio"
APP_ENV=local
APP_KEY=
APP_URL=http://127.0.0.1:8000
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stack
```

```bash
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

Under **XAMPP/Apache**, the app is served from the htdocs folder, e.g. <http://localhost/E_PORTFOLIO/public>.

## Notes

- **No database**: sessions and cache use the `file` driver; there are no migrations or Eloquent models used by the portfolio.
- All icons are inline SVGs and all fonts are self-hosted — the page makes no external requests at runtime.
- The contact mailer requires a Gmail **app password** set in `send.php`; PHPMailer is included as a vendored copy in `mailer/src/` (it is not installed via Composer).