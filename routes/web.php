<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentAchievementController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DownloadableController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\IMagzController;
use App\Http\Controllers\ArticleController;

// Company Profile
Route::controller(CompanyProfileController::class)->group(function () {
    Route::get('/', fn() => 'Halaman Utama');
    Route::get('/visi-misi', fn() => 'Halaman Visi dan Misi');
});

// Blog, News, and Articles
Route::controller(ArticleController::class)->group(function () {
    Route::get('/berita', fn() => 'Halaman Berita / Artikel');
});

// Lecturer
Route::controller(LecturerController::class)->group(function () {
    Route::get('/dosen','index')->name("lecturer");
});

// Downloadable
Route::controller(DownloadableController::class)->group(function () {
    Route::get('/unduhan', fn() => 'Halaman Unduhan (Dokumen dan Formulir Penting)');
});

// I-Magz
Route::controller(IMagzController::class)->group(function () {
    Route::get('/imagz', fn() => 'Halaman Imagz (Magazine)');
});

// Organisasi
Route::controller(OrganizationController::class)->group(function () {
    Route::get('/struktur-organisasi', fn() => 'Halaman Struktur Organisasi');
    Route::get('/proker-divisi', fn() => 'Halaman Program Kerja Divisi');
    Route::get('proker-divisi/{slug}', fn($slug) => "Halaman Program Kerja Divisi: $slug");
});

// IF Bangga
Route::controller(StudentAchievementController::class)->group(function () {
    Route::get('/database-if-bangga', fn() => 'Halaman Database IF Bangga');
});

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
