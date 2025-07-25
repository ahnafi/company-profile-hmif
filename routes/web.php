<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LecturerController;
use Illuminate\Support\Facades\Route;

// company profile
Route::get('/', fn() => 'Halaman Utama');
Route::get('/berita', fn() => 'Halaman Berita / Artikel');
Route::get('/dosen', [LecturerController::class, 'index'])->name("lecturer");
Route::get('/unduhan', fn() => 'Halaman Unduhan (Dokumen dan Formulir Penting)');
Route::get('/imagz', fn() => 'Halaman Imagz (Magazine)');
Route::get('/struktur-organisasi', fn() => 'Halaman Struktur Organisasi');
Route::get('/proker-divisi', fn() => 'Halaman Program Kerja Divisi');
Route::get('/visi-misi', fn() => 'Halaman Visi dan Misi');
Route::get('/database-if-bangga', fn() => 'Halaman Database IF Bangga');

// keuangan
Route::prefix('keuangan')->group(function () {
    Route::get('/', [CashController::class, "index"])->name('cash.index');
    Route::get('/riwayat', [CashController::class, 'history'])->name('cash.history');
    Route::get('/deposit', [DepositController::class, 'index'])->name("deposit.index");
    Route::get('/deposit/riwayat', [DepositController::class, "history"])->name("deposit.history");
});

// Form Builder Routes
Route::prefix('forms')->group(function () {
    Route::get('/{slug}', [FormController::class, 'show'])->name('forms.show');
    Route::post('/{slug}/submit', [FormController::class, 'submit'])->name('forms.submit');
});

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';
