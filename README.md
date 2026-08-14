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
1. `composer install`
2. Salin `.env.example` menjadi `.env`
3. Atur koneksi MySQL.
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan storage:link`
7. `php artisan serve`

## Akun development
- Email: `admin@simon-setwan.local`
- Password: `password`
