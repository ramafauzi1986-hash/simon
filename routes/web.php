<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SubKegiatanController;
use App\Http\Controllers\IndikatorKinerjaController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubKegiatanDataAwalController;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.attempt');

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| Authenticated Area
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/',
        fn () => redirect('/dashboard')
    );

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Administrator & Operator
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,operator')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | PROGRAM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'programs',
            ProgramController::class
        );


        /*
        |--------------------------------------------------------------------------
        | KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/kegiatans',
            [KegiatanController::class, 'index']
        )->name('kegiatans.index');

        Route::post(
            '/kegiatans',
            [KegiatanController::class, 'store']
        )->name('kegiatans.store');

        Route::delete(
            '/kegiatans/{kegiatan}',
            [KegiatanController::class, 'destroy']
        )->name('kegiatans.destroy');


        /*
        |--------------------------------------------------------------------------
        | SUB KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/sub-kegiatans',
            [SubKegiatanController::class, 'index']
        )->name('sub-kegiatans.index');

        Route::post(
            '/sub-kegiatans',
            [SubKegiatanController::class, 'store']
        )->name('sub-kegiatans.store');

        Route::delete(
            '/sub-kegiatans/{subKegiatan}',
            [SubKegiatanController::class, 'destroy']
        )->name('sub-kegiatans.destroy');


        /*
        |--------------------------------------------------------------------------
        | DATA AWAL / PAGU SUB KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/sub-kegiatans/{subKegiatan}/data-awal/create',
            [SubKegiatanDataAwalController::class, 'create']
        )->name('sub-kegiatans.data-awal.create');

        Route::post(
            '/sub-kegiatans/{subKegiatan}/data-awal',
            [SubKegiatanDataAwalController::class, 'store']
        )->name('sub-kegiatans.data-awal.store');

        Route::get(
            '/data-awal/{dataAwal}/edit',
            [SubKegiatanDataAwalController::class, 'edit']
        )->name('sub-kegiatans.data-awal.edit');

        Route::put(
            '/data-awal/{dataAwal}',
            [SubKegiatanDataAwalController::class, 'update']
        )->name('sub-kegiatans.data-awal.update');

        Route::delete(
            '/data-awal/{dataAwal}',
            [SubKegiatanDataAwalController::class, 'destroy']
        )->name('sub-kegiatans.data-awal.destroy');


        /*
        |--------------------------------------------------------------------------
        | INDIKATOR
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/indikators',
            [IndikatorKinerjaController::class, 'index']
        )->name('indikators.index');

        Route::post(
            '/indikators',
            [IndikatorKinerjaController::class, 'store']
        )->name('indikators.store');

        Route::delete(
            '/indikators/{indikator}',
            [IndikatorKinerjaController::class, 'destroy']
        )->name('indikators.destroy');


        /*
        |--------------------------------------------------------------------------
        | REALISASI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/realisasi',
            [RealisasiController::class, 'index']
        )->name('realisasi.index');

        Route::post(
            '/realisasi',
            [RealisasiController::class, 'store']
        )->name('realisasi.store');

        Route::get(
            '/realisasi/{realisasi}/download',
            [RealisasiController::class, 'download']
        )->name('realisasi.download');

        Route::delete(
            '/realisasi/{realisasi}',
            [RealisasiController::class, 'destroy']
        )->name('realisasi.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/laporan',
        [LaporanController::class, 'index']
    )->name('laporan.index');

    Route::get(
        '/laporan/export/csv',
        [LaporanController::class, 'csv']
    )->name('laporan.csv');


    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        Route::get(
            '/users',
            [UserController::class, 'index']
        )->name('users.index');

        Route::post(
            '/users',
            [UserController::class, 'store']
        )->name('users.store');

        Route::put(
            '/users/{user}',
            [UserController::class, 'update']
        )->name('users.update');

        Route::delete(
            '/users/{user}',
            [UserController::class, 'destroy']
        )->name('users.destroy');
    });
});