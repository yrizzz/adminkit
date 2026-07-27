# AdminKit

Admin panel starter kit berbasis Laravel 13 + Livewire 4 + Tailwind CSS v4 + Alpine.js.

## Fitur Utama

- **Authentication**: Form login, register, dan reset password.
- **Layout & Navigasi**: Pilihan tampilan Vertical Sidebar & Horizontal Topbar menu dengan dukungan RTL & LTR.
- **Theme & Kustomisasi**: Mode Light/Dark/System, kustomisasi warna aksen, dan border radius (tersimpan di `localStorage`).
- **Komponen UI**: Button, Badge, Card, Input, Modal, Alert, Stat Box, Toaster, dan komponen Blade modular lainnya (`resources/views/components/ui/*`).
- **Halaman Starter**: Dashboard analytics, Data Tables, Forms, Settings, dan UI Elements showcase.

## Cara Penggunaan

1. Menggunakan Composer (Rekomendasi):
   ```bash
   composer create-project yrizzz/adminkit nama-project
   ```

2. Atau clone manual dari repository:
   ```bash
   git clone https://github.com/yrizzz/adminkit.git
   cd adminkit
   ```

2. Install dependensi:
   ```bash
   composer install
   npm install
   ```

3. Konfigurasi environment & database:
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   ```

4. Build asset & jalankan aplikasi:
   ```bash
   npm run build
   php artisan serve
   ```

### Akun Demo
- **Email**: `admin@adminkit.test`
- **Password**: `password`

## Lisensi

Aplikasi ini menggunakan lisensi [MIT](LICENSE).
