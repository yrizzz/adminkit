# ⚡ AdminKit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yrizzz/adminkit.svg?style=flat-square&color=4F46E5)](https://packagist.org/packages/yrizzz/adminkit)
[![Total Downloads](https://img.shields.io/packagist/dt/yrizzz/adminkit.svg?style=flat-square&color=0EA5E9)](https://packagist.org/packages/yrizzz/adminkit)
[![License](https://img.shields.io/github/license/yrizzz/adminkit?style=flat-square&color=10B981)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat-square)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-4.x-4E5BA6?style=flat-square)](https://livewire.laravel.com)
[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-Saweria-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://saweria.co/yrizzz)

**The Lightweight, Themeable Admin Panel Starter Kit for Laravel 13 & Livewire 4.**

AdminKit provides a fast, elegant, and fully themeable admin foundation built natively with **Laravel 13**, **Livewire 4**, **Tailwind CSS v4**, and **Alpine.js**. No React or Vue build step required.

---

## 🔥 Why AdminKit?

- ⚡ **Lightweight & Blazing Fast**: Powered natively by Blade, Livewire 4, and Alpine.js. Zero heavy JavaScript framework overhead.
- 🎨 **Modern Design System**: Beautiful, minimal, and accessible UI components right out of the box.
- 🌓 **Instant Theme Engine**: Light, Dark, and System modes with 7 accent color themes and 5 border radius presets — saved in `localStorage` with **zero FOUC** (flash of unstyled content).
- 🔄 **Dual Layout & RTL Native**: Switch between **Vertical Sidebar** and **Horizontal Topbar** layouts with built-in LTR & RTL support.
- ⌨️ **Command Palette (⌘K)**: Built-in keyboard-driven global search palette for quick navigation.
- 🚀 **Zero-Config Setup**: Spin up a full-featured admin dashboard in less than 30 seconds.

---

## ✨ Features

- 🔐 **Authentication System**: Pre-wired Login, Register, and Password Reset screens with seeded demo user.
- 🧩 **UI Component Library**: Modular Blade components (`resources/views/components/ui/*`) including Button, Badge, Card, Input, Modal, Alert, Stat Box, Toaster, and Lucide Icons.
- 📊 **Pre-built Dashboards & Charts**: Interactive Chart.js analytics widgets, stat summary cards, and activity feeds.
- 📋 **Data Tables & Forms**: Client-side sorting, searching, selection filters, multi-step form wizard, and custom inputs.
- ⚙️ **Theme Customizer Drawer**: Real-time interactive drawer to preview layout, direction, accent color, and radius adjustments.

---

## 🚀 Quick Start

### Option 1: Create Project via Composer (Recommended)

```bash
composer create-project yrizzz/adminkit my-app
cd my-app
php artisan serve
```

### Option 2: Clone Repository

```bash
git clone https://github.com/yrizzz/adminkit.git my-app
cd my-app

# Install dependencies
composer install
npm install

# Setup environment & database
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Build assets & start server
npm run build
php artisan serve
```

---

## 🔑 Demo Credentials

| Field | Value |
| :--- | :--- |
| **URL** | `http://127.0.0.1:8000` |
| **Email** | `admin@adminkit.test` |
| **Password** | `password` |

---

## ☕️ Support & Sponsor

If you find **AdminKit** helpful and want to support its development, you can sponsor via:

- **Saweria**: [https://saweria.co/yrizzz](https://saweria.co/yrizzz)
- **BNB Chain (BEP-20)**:
  ```text
  0xc708ba9b4764deaaf3b24147ff0c5c8ed7ea4c80
  ```

<a href="https://saweria.co/yrizzz" target="_blank">
    <img src="https://img.shields.io/badge/Support%20via-Saweria-FFDD00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black" alt="Buy Me A Coffee via Saweria">
</a>

Your support is greatly appreciated! ❤️

---

## ⭐️ Show Your Support

If you find **AdminKit** helpful for your projects, please consider giving this repository a **⭐️ Star** on GitHub! It helps the project grow and reach more Laravel developers.

---

## 📝 License

AdminKit is open-sourced software licensed under the [MIT license](LICENSE).
