# AdminKit

A modern admin panel starter kit built on Laravel 13, Livewire 4, Tailwind CSS v4, and Alpine.js.

## Key Features

- **Authentication**: Pre-built Login, Register, and Password Reset screens.
- **Layouts & Navigation**: Vertical Sidebar and Horizontal Topbar navigation modes with full RTL & LTR support.
- **Theming**: Light, Dark, and System modes with customizable accent colors and border radius presets (persisted in `localStorage`).
- **UI Component Library**: Clean Blade components for Buttons, Badges, Cards, Inputs, Modals, Alerts, Stat cards, Toaster, and more (`resources/views/components/ui/*`).
- **Starter Pages**: Dashboard analytics, Data Tables, Forms, Settings, and UI Elements showcase.

## Getting Started

### 1. Create Project via Composer (Recommended)

```bash
composer create-project yrizzz/adminkit my-app
```

### 2. Manual Installation (Alternative)

```bash
git clone https://github.com/yrizzz/adminkit.git
cd adminkit

# Install dependencies
composer install
npm install

# Setup environment & database
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Build assets & serve
npm run build
php artisan serve
```

### Demo Credentials

- **Email**: `admin@adminkit.test`
- **Password**: `password`

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
