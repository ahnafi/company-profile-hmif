<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('welcome');
// })->name('home');

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
    Route::get('/kas', fn() => 'Halaman Kas');
    Route::get('/deposit', fn() => 'Halaman Deposit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
