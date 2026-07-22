# AdminKit — Laravel Admin Kit


> Menu structure & nesting are modelled on the *Velvet* admin template (as requested); components and design system are original/shadcn-inspired.

## ✨ What's included

- **Authentication** — Login, Register, Forgot-password (real session auth, demo user seeded)
- **App shell** — dark sidebar (grouped, multi-level nested menu, badges, search, collapse/icon-rail, mobile off-canvas), sticky navbar (breadcrumb, ⌘K command palette, notifications, language, theme toggle, profile), footer (version / Laravel / PHP / execution time)
- **Layouts** — **Vertical** & **Horizontal**, switchable at runtime
- **Direction** — full **RTL / LTR** support (logical properties)
- **Theming** — Light / Dark / System, 7 accent colors, 5 radius presets — all persisted to `localStorage`, applied before first paint (no FOUC). Live **Theme Customizer** drawer.
- **Component library** (`resources/views/components/ui/*`) — button, badge, card, input, avatar, dropdown, modal, alert, stat, toaster, icon (Lucide)
- **Pages** — Dashboard (Chart.js widgets), UI Elements showcase, Data Table (sort/search/select), Charts, Forms (wizard), Settings, Icons, Widgets

## 🚀 Run it

```bash
composer install
npm install

# Database (SQLite, pre-configured) + demo data
php artisan migrate:fresh --seed

# Build assets (or `npm run dev` for HMR)
npm run build

# Serve
php artisan serve      # http://127.0.0.1:8000
```

### Demo credentials
```
Email:    admin@adminkit.test
Password: password
```

## 🗂️ Key files

| Path | Purpose |
|------|---------|
| `config/adminkit.php` | App meta + the whole navigation tree |
| `app/Support/Menu.php` | Menu helpers (active state, href, flatten) |
| `resources/css/app.css` | Design tokens (HSL), themes, accents, radius, RTL, rail mode |
| `resources/js/app.js` | Alpine store (`$store.ui`): theme/direction/layout/sidebar |
| `resources/views/components/layouts/` | `app` (authed shell) + `guest` (auth) |
| `resources/views/partials/` | sidebar, navbar, footer, topbar-horizontal, customizer, command, menu-item |
| `resources/views/pages/` | dashboard, tables, charts, forms, settings, icons, widgets, ui-elements |

## 🧭 Navigation notes

Menu items without a real page point to `#` and show an info toast ("scaffold" pages). The wired-up real pages are: Dashboard, Sign In / Up / Reset, UI Elements, Icons, Widgets, Tables, Charts, Forms, Settings.



> Lucide icons are currently bundled whole for convenience; tree-shake to a curated set before production to shrink the JS bundle.
