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

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect('/dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin,operator')->group(function () {
        Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
        Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');
        Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

        Route::post('/programs/{program}/kegiatans', [KegiatanController::class, 'store'])->name('programs.kegiatans.store');
        Route::get('/programs/{program}/kegiatans/{kegiatan}', [KegiatanController::class, 'show'])->name('programs.kegiatans.show');
        Route::delete('/programs/{program}/kegiatans/{kegiatan}', [KegiatanController::class, 'destroy'])->name('programs.kegiatans.destroy');

        Route::post('/kegiatans/{kegiatan}/sub-kegiatans', [SubKegiatanController::class, 'store'])->name('kegiatans.sub-kegiatans.store');
        Route::delete('/kegiatans/{kegiatan}/sub-kegiatans/{subKegiatan}', [SubKegiatanController::class, 'destroy'])->name('kegiatans.sub-kegiatans.destroy');

        Route::get('/indikators', [IndikatorKinerjaController::class, 'index'])->name('indikators.index');
        Route::post('/indikators', [IndikatorKinerjaController::class, 'store'])->name('indikators.store');
        Route::delete('/indikators/{indikator}', [IndikatorKinerjaController::class, 'destroy'])->name('indikators.destroy');
        Route::get('/realisasi', [RealisasiController::class, 'index'])->name('realisasi.index');
        Route::post('/realisasi', [RealisasiController::class, 'store'])->name('realisasi.store');
        Route::get('/realisasi/{realisasi}/download', [RealisasiController::class, 'download'])->name('realisasi.download');
        Route::delete('/realisasi/{realisasi}', [RealisasiController::class, 'destroy'])->name('realisasi.destroy');
    });

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export/csv', [LaporanController::class, 'csv'])->name('laporan.csv');

    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
