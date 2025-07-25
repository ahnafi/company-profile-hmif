<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Route;

// company profile
Route::get('/', fn() => 'Halaman Utama');
Route::get('/berita', fn() => 'Halaman Berita / Artikel');
Route::get('/dosen', fn() => 'Halaman Dosen Informatika');
Route::get('/unduhan', fn() => 'Halaman Unduhan (Dokumen dan Formulir Penting)');
Route::get('/imagz', fn() => 'Halaman Imagz (Magazine)');
Route::get('/struktur-organisasi', fn() => 'Halaman Struktur Organisasi');
Route::get('/proker-divisi', fn() => 'Halaman Program Kerja Divisi');
Route::get('/visi-misi', fn() => 'Halaman Visi dan Misi');
Route::get('/database-if-bangga', fn() => 'Halaman Database IF Bangga');

// keuangan
Route::prefix('keuangan')->group(function () {
    Route::get('/kas', [CashController::class, "index"])->name('cash.index');
    Route::get('/kas/riwayat', [CashController::class, 'history'])->name('cash.history');
    Route::get('/deposit', [DepositController::class, 'index'])->name("deposit.index");
    Route::get('/deposit/riwayat', [DepositController::class, "history"])->name("deposit.history");
});

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';
