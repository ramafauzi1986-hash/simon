<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KegiatanController;
Route::get('/', fn () => redirect('/dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
Route::get('/kegiatans', [KegiatanController::class, 'index'])->name('kegiatans.index');
Route::post('/kegiatans', [KegiatanController::class, 'store'])->name('kegiatans.store');
Route::delete('/kegiatans/{kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatans.destroy');