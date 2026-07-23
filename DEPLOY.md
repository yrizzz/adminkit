# Deploy

## Option A — run it on the VPS (manual, simplest)

Every time you want to ship the latest `main`:

```bash
cd /var/www/adminpanel     # your app path
bash deploy.sh
```

`deploy.sh` pulls the latest code, installs deps, builds assets, runs
migrations, rebuilds caches, and restarts queue workers — with the app in
maintenance mode while it works.

### First-time server setup (once)

```bash
git clone https://github.com/rhpfullstack/adminpanel.git
cd adminpanel
cp .env.example .env          # edit DB, APP_URL, APP_ENV=production, APP_DEBUG=false
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
bash deploy.sh
```

Point your web server (nginx/apache) `root` at `.../adminpanel/public`.

Requirements on the VPS: PHP 8.4 + extensions, Composer, Node/npm (for
`npm run build`), and your database. If the VPS has **no Node**, comment out the
build block in `deploy.sh`, run `npm run build` locally, and upload the
`public/build` folder instead.

## Option B — push to deploy (automatic)

`.github/workflows/deploy.yml` runs `deploy.sh` on the VPS automatically on
every push to `main`. Add these repo secrets
(**Settings → Secrets and variables → Actions**):

| Secret | Example |
|---|---|
| `VPS_HOST` | `203.0.113.10` |
| `VPS_USER` | `deploy` |
| `VPS_SSH_KEY` | contents of a **private** SSH key (its public key goes in the VPS user's `~/.ssh/authorized_keys`) |
| `VPS_PORT` | `22` (optional) |
| `VPS_APP_PATH` | `/var/www/adminpanel` |

You can also trigger it manually from the **Actions** tab (workflow_dispatch).

> Don't want CI? Delete `.github/workflows/deploy.yml` and just use Option A.

## Notes

- **Never ship `public/hot`** — `deploy.sh` deletes it; it's what makes `@vite`
  point at the local dev server (blank page / CORS in production).
- `.env`, `vendor/`, `node_modules/`, and `public/build/` are gitignored — the
  script regenerates `vendor/` and `public/build/` on the server.
- To reload OPcache after deploy, uncomment the `systemctl reload php8.4-fpm`
  line in `deploy.sh` (needs sudo).
