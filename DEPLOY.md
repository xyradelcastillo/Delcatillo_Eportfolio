# Vercel deployment notes

## Required environment variables (set in Vercel dashboard)

- `APP_KEY` — generate with `php artisan key:generate --show`
- `APP_URL` — your deployment URL (https://...)
- `APP_ENV=production`
- `APP_DEBUG=false`

Optional (only if you add a database or storage):
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `AWS_*` for S3-compatible storage

## Notes

- This app uses no database; all content is plain PHP arrays.
- Vercel has no persistent shell; run migrations locally against the remote DB if you add one.
- Runtime logs: Vercel dashboard → project → Logs / Functions tab.
