# AI Prompt Log

This file records every prompt given to the Big Pickle agent (Opencode) during the development
of this portfolio, in the order they were used, along with a brief description of what was
generated and any follow-up needed.

---

### Task: Initial Project Scaffold & Design Brief
* Prompt used:*

```
Build a static personal portfolio website using Laravel (latest stable version).

Technical Constraints
- No database. Do not create migrations or Eloquent models.
- All content is hardcoded in Blade views or passed from route closures/controllers as plain PHP arrays.
- Use Laravel Blade templating (.blade.php) for every view.
- Use Tailwind CSS (via Laravel Vite) for styling. Keep the frontend framework-free otherwise (no React/Vue needed — plain Blade + a small amount of vanilla JS for interactivity like the theme toggle and mobile nav).
- Single-page scrolling layout with anchor-link navigation (like a typical portfolio/agency site), routed through one web.php route (/) rendering one main Blade view composed of @include partials per section.
- Fully responsive (mobile, tablet, desktop).
- Initialize a git repository in the project root on the very first step, and commit after each major milestone (scaffold, layout, each section, dark/light toggle, final polish) with clear, descriptive commit messages, so the history documents the build process.

Design Direction
Use https://www.moritzdunkel.de/ as a structural and stylistic reference — NOT to copy its business content, but to mirror:
- The clean, confident, generous-whitespace layout with a bold full-width hero section (large headline, short subheadline, one primary CTA button).
- A sticky top navigation bar with anchor links to each section, and a mobile hamburger menu.
- An "About" section with a short bio next to a portrait/profile image, plus a row of 2–3 quick stats.
- A filterable/clean grid layout for the Projects section (card-based, image + title + short description + tags).
- Clear section headers with a small eyebrow label above each large heading.
- A polished footer with contact info and social/GitHub icon links.
- Smooth scroll behavior between sections and subtle hover/transition effects on cards and buttons.
- Modern, minimal typography, generous line-height, rounded corners, soft shadows — neutral palette that works in light and dark themes.

Dark / Light Mode
- Add a dark/light mode toggle button fixed in the top right corner of the navigation bar, visible on all screen sizes.
- Use a sun/moon icon that swaps depending on the active theme.
```

* Result/Output:*
Generated a Laravel 13 project scaffold via `composer create-project`, set up Tailwind CSS v3 through
Vite with class-based dark mode, and built the base layout (`layouts/app.blade.php`) with a sticky
navbar (theme toggle + mobile hamburger) and a full-width hero section. Committed per milestone:
`chore: scaffold Laravel 13 application`, `build: set up Tailwind CSS v3 via Vite`, and
`feat: add base layout, sticky nav with theme toggle and hero section`.
No follow-up needed.

---

### Task: Creating the About / Education / Projects / Contact Sections
* Prompt used:* *(follow-up to the design brief — continue building the single-page sections described
above, one milestone commit each.)*

* Result/Output:* Added the remaining sections as `@include` partials composed into one home view:
- **About** — portrait image, short bio and a row of quick stats
  (`feat: add about section with portrait, bio and quick stats`).
- **Education** — vertical timeline of educational history
  (`feat: add education timeline section`).
- **Projects** — filterable card grid with image, title, description, tags and GitHub/demo links
  (`feat: add filterable projects grid with GitHub repository links`).
- **Contact** — contact info cards and a form (`feat: add contact section`).
- **Footer** — contact info and social/GitHub icon links.
Added a README describing setup and content editing (`docs: add README with setup and content-editing guide`).

---

### Task: Adding the Theme Corrector (Accent-Color Theme Picker)
* Prompt used:* `2. add the theme corrector`

* Result/Output:* Implemented an accent-color picker in the navbar (palette swatches) on top of the
existing dark/light toggle. The accent is applied at runtime via CSS variables (`--accent-*`) mapped
onto Tailwind's `indigo` scale using a `data-accent` attribute on `<html>`, and persisted to
`localStorage`. Commits: `feat: add accent-color theme picker` and, after a small visual bug
(check mark placement), `fix: show accent picker checkmark inside the swatch circle`.

---

### Task: PDF Viewer, Print and Download (CV & Resume)
* Prompt used:* `3. pdf viewer, print and dl`

* Result/Output:* Added three CV experiences on top of the About section:
- **View** — a standalone, print-styled CV page (`/cv`).
- **Print** — `/cv?print=1` auto-launches the print dialog.
- **Download PDF** — `/cv/download` builds a real PDF on the fly via a dependency-free generator
  (`app/Support/CvPdf.php`).
- **Resume viewer** — `/resume` renders `public/files/My Resume.pdf` in an iframe with Download and
  Print buttons.
Commits include `feat: add CV with view, print and PDF download actions`,
`feat: resume viewer page with download/print buttons + fix nav icon spacing`, and follow-up fixes
for button size, `target=_blank` removal, and a working back button.

---

### Task: Debugging / Polish Follow-ups
* Prompt used:* *(regex/requests to fix specific issues reported during review — e.g., portrait image
sizing, social links, favicon, hero wording.)*

* Result/Output:* Iterative fixes from testing and review:
- `fix: autofit project images with object-contain inside card containers`
- `fix: hide GitHub and view-project icons on personal portfolio project card`
- `fix: add missing project image key and make project cards crash-proof for absent image`
- `fix: point resume link to My Resume.pdf in public/files`
- `fix: remove em dash before 'I'm always open' in about section`
- Added Font Awesome icons to nav links; linked Telegram, Discord and TikTok social icons to real
  profiles (`feat: add Telegram and Discord brand icons to the icon set`, `link TikTok social icon to @dee_matchaaa profile`).
- Removed the availability badge from the hero (empty value now hides it).
- Per-section browser tab titles and a PNG/X monogram tab icon
  (`feat: Page | Site title pattern, PNG tab icon and per-section titles`,
  `feat: change tab favicon from C to X monogram`, `feat: update X favicon with indigo circle background`).

---

### Task: Static Deployment for GitHub Pages
* Prompt used:* *(request to export/serve the built site as a pre-rendered static site.)*

* Result/Output:* Produced a pre-rendered static export (commit
`deploy: pre-rendered static site for GitHub Pages`) and cleaned up scaffolding leftovers
(`docs: remove unused .env.example`, `docs: add/remove PROMPT_LOG.md`). The final repository push
to `xyradelcastillo/Delcatillo_Eportfolio` consolidated history after a placeholder "Initial commit".

---

<!--
INSTRUCTIONS FOR FILLING THIS OUT:
1. Add one "### Task:" block per distinct interaction with Big Pickle — every single prompt
   used to generate, debug, or style code counts, not just the big ones.
2. Keep them in chronological (start-to-finish) order, matching your actual build process.
3. "Result/Output" should be a short, honest summary — including when something didn't work
   and you had to re-prompt or fix it manually.
4. Once complete, copy this content into the Word document (AI_Prompt_Documentation.docx)
   as required by the assignment, in the same order.
-->