#!/usr/bin/env bash
#
# Zero-fuss production deploy for AdminKit (Laravel + Vite + Livewire).
#
#   On the VPS, from the project root:   bash deploy.sh
#
# It pulls the latest code, installs deps, builds assets, migrates and
# re-caches — putting the app in maintenance mode while it works and always
# bringing it back up (even if a step fails).
#
# First-time setup on the VPS (do this ONCE before the first deploy):
#   git clone https://github.com/rhpfullstack/adminpanel.git
#   cd adminpanel
#   cp .env.example .env         # then edit DB creds, APP_URL, etc.
#   composer install
#   php artisan key:generate
#   php artisan storage:link
#   php artisan migrate
#
set -euo pipefail

# Always run from the directory this script lives in.
cd "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Use the newest PHP if a specific binary is desired; defaults to `php` on PATH.
PHP="${PHP_BIN:-php}"
BRANCH="${DEPLOY_BRANCH:-main}"

echo "▶ AdminKit deploy — branch '${BRANCH}'"

# --- Maintenance mode (always lift it again on exit) ------------------------
"$PHP" artisan down --retry=15 >/dev/null 2>&1 || true
trap '"$PHP" artisan up >/dev/null 2>&1 || true; echo "▶ App is back up."' EXIT

# --- 1. Latest code ---------------------------------------------------------
echo "▶ Fetching latest code..."
git fetch --all --prune
git reset --hard "origin/${BRANCH}"   # server has no local edits; keep it identical to origin

# --- 2. PHP dependencies ----------------------------------------------------
echo "▶ composer install (production)..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# --- 3. Front-end build -----------------------------------------------------
# Needs Node + npm on the VPS. If your host has no Node, comment this block out
# and instead build locally and upload the `public/build` folder.
echo "▶ Building front-end assets..."
npm ci --no-audit --no-fund
npm run build
# CRITICAL: the Vite dev-server hot file must never exist in production, or
# @vite serves 127.0.0.1:5173/5174 URLs (blank page / CORS errors).
rm -f public/hot

# --- 4. Database ------------------------------------------------------------
echo "▶ Running migrations..."
"$PHP" artisan migrate --force
"$PHP" artisan storage:link >/dev/null 2>&1 || true

# --- 5. Caches --------------------------------------------------------------
echo "▶ Rebuilding caches..."
"$PHP" artisan optimize:clear
"$PHP" artisan optimize          # caches config + routes + views + events

# --- 6. Background workers ---------------------------------------------------
# Tell any running queue workers to restart with the new code.
"$PHP" artisan queue:restart >/dev/null 2>&1 || true

# --- 7. (optional) reload PHP-FPM so OPcache picks up new code ---------------
# Uncomment and set your PHP-FPM service name (this box runs PHP 8.4):
# sudo systemctl reload php8.4-fpm

echo "✅ Deploy complete."
