# Prompt Log — Laravel Static Portfolio Build

A chronological record of every task given to **Big Pickle** (opencode CLI) while building
this portfolio, with the results produced at each step. Serves as documentation of the
development process and a reproducibility log.

---

## Task 1: Initial Project Scaffold & Design Brief

**Prompt used:** *(condensed from the original brief)*

> Build a static personal portfolio website using Laravel (latest stable version).
> Technical constraints: no database, no migrations or Eloquent models — all content hardcoded
> in Blade views or passed from route closures/controllers as plain PHP arrays; Blade templating
> everywhere; Tailwind CSS via Laravel Vite; framework-free frontend except small vanilla JS;
> single-page scrolling layout routed through one `/` route composed of `@include` partials;
> fully responsive; initialize git first and commit after each milestone.
> Design direction: mirror moritzdunkel.de structurally — bold hero, sticky nav with anchor
> links + hamburger, about section with portrait + stats row, filterable card grid for projects,
> eyebrow labels above section headings, polished footer, smooth scroll, neutral palette working
> in light and dark. Dark/light mode toggle top-right with sun/moon icons, class-based dark mode,
> localStorage preference with OS fallback and no flash-of-wrong-theme. Required sections: hero,
> education timeline, projects grid (4–6 placeholders) with GitHub links, contact, footer.
> Deliverables: `layouts/app.blade.php`, `partials/*`, `home.blade.php`, single route,
> Tailwind config with `darkMode: 'class'`, README with run instructions.

**Result/Output:** Generated complete Laravel project structure — base layout with theme-init
script, sticky glass navbar (anchor links, hamburger menu, sun/moon toggle), footer partial,
Tailwind v3 config (`darkMode: 'class'`) served over Vite, reusable `<x-icon>` /
`<x-section-heading>` components, `PortfolioController` providing bio/education/projects as
commented PHP arrays, and placeholder section partials (hero, about, education, projects,
contact) committed across 8 descriptive commits.

**Errors/fixes required during scaffold:**
- Composer initially resolved **Laravel 9** because the Windows composer shim was pinned to
  XAMPP's PHP 8.0. Fixed by invoking the phar explicitly with `C:\tools\php83\php.exe`,
  yielding Laravel 13 (latest stable).
- First `composer create-project` attempt failed on transient GitHub API 504s; retry succeeded.
- Scaffold shipped Tailwind v4 (CSS-first config); swapped to Tailwind v3 stack since the brief
  requires a `tailwind.config.js` with `darkMode: 'class'`.
- Default `database` session/cache drivers crashed rendering (no sqlite driver in PHP build);
  switched `.env` to `file`/`sync` drivers since no database exists.

## Task 2: Making the Site Run Locally

**Prompt used:** "HOW TO RUN" → followed up with *"Failed to Load Page ERR_CONNECTION_REFUSED
(-102) http://127.0.0.1:8000"* and *"can i use this localhost/E_PORTFOLIO/public/"*

**Result/Output:** Documented two run paths — `/c/tools/php83/php.exe artisan serve`
(XAMPP's PHP 8.0 can't run Laravel 13) and Apache hosting. Discovered XAMPP's Apache already
runs PHP 8.3 via `C:\xampp\php83`, so `http://localhost/E_PORTFOLIO/public/` works directly;
started Apache, verified HTTP 200 with correct sub-directory asset URLs.

**Errors/fixes required:** `ERR_CONNECTION_REFUSED` was simply no server running; launched
`artisan serve` detached via PowerShell so it survives terminal sessions.

## Task 3: Accent Color Changer + CV (View / Print / Download)

**Prompt used:** "add change theme color and a section for about in a button for viewing,
print and download an CV"

**Result/Output:** Remapped Tailwind's color scale onto CSS variables (`--accent-*`) so six
palettes (indigo/violet/emerald/rose/amber/sky) recolor the whole UI with zero markup edits;
navbar palette button opens a swatch popover persisted in localStorage, restored pre-paint.
Added `/cv` print-styled page (`?print=1` auto-opens print dialog), `/cv/download` streaming a
real PDF built by a dependency-free writer (`app/Support/CvPdf.php`: core fonts, WinAnsi
escaping, word-wrap, multi-page), and View/Print/Download buttons in the About section.

**Errors/fixes required:** Validated the generated PDF's xref table programmatically (first
check script had wrong offset math; corrected script confirmed all offsets valid).

## Task 4: Picker Polish

**Prompt used:** "the active checks of the must be in the circle not in the check left side"

**Result/Output:** Moved the selected-palette checkmark inside its colored circle swatch
(white, drop-shadowed, scale-in animation) instead of a trailing icon beside the label.
Commit `c6e6b48`.

## Task 5: GitHub Repository Setup & Pages Deployment

**Prompt used:** "set repo https://github.com/rucielmaeobias2105/rucielmaeobias2105.github.io.git"
→ answered follow-up questions with *"delete all current files in his repo … then push all of
this"* and *"just push"* (keep placeholder content).

**Result/Output:** Set `origin`, verified no secrets tracked (`.env` uncommitted), force-pushed
Laravel source to `main` replacing old content, then added a pre-rendered static export
(rendered HTML pages, generated CV PDF, compiled Vite assets, images, favicon, `.nojekyll`)
because GitHub Pages cannot execute PHP. Live verification: home, `/cv/`, and PDF all return
HTTP 200 at https://rucielmaeobias2105.github.io.

**Errors/fixes required:** Initial push rejected (remote contained an older hand-made portfolio
with coursework files) — resolved per user's explicit instruction to replace everything.

## Task 6: Documentation Housekeeping

**Prompt used:** "add a file in my root directory named PROMPT_LOG.md and remove the
.env.example since it is database-related and the project uses no database"

**Result/Output:** This file. Removed `.env.example` (pure database/session boilerplate) and
updated the README setup steps accordingly.

---

## Where to continue editing

All personal content lives in one file: `app/Http/Controllers/PortfolioController.php`
(search for `EDIT:` markers). After editing, the live GitHub Pages copy must be re-exported —
see README.
