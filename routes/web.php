<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
Route::get('/', fn () => redirect('/dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');