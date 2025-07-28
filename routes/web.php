<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE PUBLIK UNTUK GUEST ---
Route::get('/', [HomeController::class, 'index'])->name('homepage');


// --- RUTE DASHBOARD (STANDAR BREEZE) ---
// Route ini HARUS ada dan bernama 'dashboard' untuk redirect setelah login.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// --- RUTE ADMIN LAINNYA ---
// Grup ini untuk semua halaman manajemen di dalam panel admin.
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('posts', PostController::class);
    Route::resource('foto', FotoController::class)->except(['show', 'edit', 'update']);
});


// --- RUTE PROFIL PENGGUNA (BAWAAN BREEZE) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Memuat rute otentikasi (login, register, dll.)
require __DIR__.'/auth.php';
