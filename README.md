# SIMON-SETWAN

Sistem Monitoring Kinerja Sekretariat DPRD.

## Stack
- Laravel 12
- PHP 8.3
- MySQL 8
- Bootstrap 5
- AdminLTE 4
- Chart.js

## Modul awal
- Dashboard monitoring
- Program
- Indikator kinerja
- Realisasi
- Database migrations dan seeder

## Instalasi
1. `composer install`
2. Salin `.env.example` menjadi `.env`
3. Atur koneksi MySQL.
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan storage:link`
7. `php artisan serve`
