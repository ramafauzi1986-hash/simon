# SIMON-SETWAN

Sistem Monitoring Kinerja Sekretariat DPRD.

## Stack
- Laravel 12
- PHP 8.3
- MySQL 8
- Bootstrap 5
- AdminLTE 4
- Chart.js

## Modul
- Login dan role pengguna
- Dashboard monitoring kinerja
- Program, Kegiatan, Sub Kegiatan
- Indikator kinerja
- Target tahunan dan Triwulan I-IV
- Realisasi kinerja
- Evidence/dokumen pendukung
- Laporan dan ekspor

## Instalasi
`composer install` → `.env` → `php artisan key:generate` → `php artisan migrate --seed` → `php artisan storage:link` → `php artisan serve`

Akun development: `admin@simon-setwan.local` / `password`.
