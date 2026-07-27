# ⚡ AdminKit — Laravel 13 Admin Panel Starter Kit

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 13">
  <img src="https://img.shields.io/badge/Livewire-4.x-4E5BA6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire 4">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-38BDF8?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS v4">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="License">
</p>

A modern, highly customizable, and themeable admin panel starter kit built on **Laravel 13**, **Livewire 4**, **Tailwind CSS v4**, and **Alpine.js**, featuring a sleek **shadcn/UI-inspired** design system.

---

## ✨ Features at a Glance

- 🔐 **Authentication System** — Fully functioning session login, registration, and forgot-password pages with seeded demo credentials.
- 🎨 **Live Theme Customizer Drawer**
  - **Color Schemes**: Light, Dark, and System automatic detection.
  - **7 Vibrant Accent Colors**: Blue, Indigo, Violet, Emerald, Rose, Amber, Cyan.
  - **5 Border Radius Presets**: Sharp (0px), Small (0.3rem), Medium (0.5rem), Large (0.75rem), Full (1.0rem).
  - **Instant Persistence**: Theme choices saved instantly in `localStorage` without page flash (FOUC).
- 🔄 **Dynamic Layout & Direction Support**
  - **Layout Modes**: Vertical Sidebar & Horizontal Topbar menu navigation.
  - **Text Direction**: Complete LTR and RTL support built using CSS logical properties.
  - **Sidebar Modes**: Expanded, Collapsed, Icon-Rail, and Mobile Off-canvas drawer.
- ⌨️ **Command Palette (⌘K / Ctrl+K)** — Instant quick search modal across all navigation links and app actions.
- 🧩 **Shadcn-Inspired UI Components** (`resources/views/components/ui/*`) — Clean, accessible Blade components including:
  - Button, Badge, Card, Input, Avatar, Dropdown, Modal, Alert, Stat Box, Toaster, and Lucide Icons.
- 📊 **Pre-built Starter Pages**
  - **Dashboard**: Live Chart.js analytics widgets, stat summary cards, activity feeds.
  - **Data Tables**: Interactive client-side sorting, searching, pagination, and multi-select filters.
  - **Forms**: Multi-step wizard form, input groups, toggles, custom selects.
  - **UI Showcase**: Live playground for all UI elements, alerts, buttons, and modals.
  - **Settings, Icons, Charts, Widgets**.

---

## 🚀 Quick Start Guide

### Prerequisites
- PHP >= 8.3
- Composer >= 2.0
- Node.js >= 18.x & NPM

### Step-by-Step Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yrizzz/adminkit.git
   cd adminkit
   ```

2. **Install Backend & Frontend Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Database Migrations & Seed Demo Data**
   ```bash
   # Pre-configured with SQLite out of the box
   php artisan migrate:fresh --seed
   ```

5. **Build Assets & Start Local Server**
   ```bash
   # Compile frontend assets
   npm run build

   # Serve application locally
   php artisan serve
   ```
   Access the admin panel at: `http://127.0.0.1:8000`

---

## 🔑 Demo Credentials

| Role | Email | Password |
|:---|:---|:---|
| **Administrator** | `admin@adminkit.test` | `password` |

---

## 🗂️ Project Architecture & Key Files

```text
adminkit/
├── app/
│   └── Support/
│       └── Menu.php                 # Navigation helper (active state, URL builder, search index)
├── config/
│   └── adminkit.php                 # App configuration & complete navigation structure
├── resources/
│   ├── css/
│   │   └── app.css                  # CSS design tokens (HSL), theme variables, accents, RTL rules
│   ├── js/
│   │   └── app.js                   # Alpine.js global UI state store ($store.ui)
│   └── views/
│       ├── components/
│       │   ├── layouts/             # app.blade.php (authed shell) & guest.blade.php (auth pages)
│       │   └── ui/                  # Reusable shadcn-like UI Blade components
│       ├── pages/                   # Main view templates (dashboard, tables, forms, settings)
│       └── partials/                # Sidebar, Navbar, Topbar, Customizer drawer, Command palette
└── routes/
    └── web.php                      # Application routes
```

---

## ⚙️ Configuration & Customization

### 1. Navigation Menu (`config/adminkit.php`)
Easily customize menu items, headers, submenus, badges, and icons:

```php
'menu' => [
    [
        'title' => 'Main',
        'is_header' => true,
    ],
    [
        'title' => 'Dashboard',
        'icon' => 'layout-dashboard',
        'route' => 'dashboard',
        'badge' => ['text' => 'New', 'variant' => 'primary'],
    ],
    // ...
]
```

### 2. Styling & Theme Tokens (`resources/css/app.css`)
Tailwind CSS v4 `@theme` variables and custom HSL color definitions allow seamless brand adjustments.

---



---

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

<p align="center">
  Crafted with ❤️ by <a href="https://github.com/yrizzz">Aris Edy Handoko (yrizzz)</a>
</p>
