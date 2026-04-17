<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KatalogController;

// 1. Route Utama - Redirect ke Katalog agar langsung muncul Grid Produk (Poin 5 & 10)
Route::get('/', function () {
    return redirect()->route('katalog.index');
});

// 2. Route Katalog & Produk (Poin 5 & 6)
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/create', function () {
    return view('katalog.create');
})->name('produk.create');
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

// 3. Route Profil (Card)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/profil/{nim}', [ProfilController::class, 'show'])->name('profil.show');

// 4. Route Statis dengan View Blade (Poin 7)
Route::get('/about', function () {
    return view('katalog.about');
})->name('statis.about');

// Route tambahan jika diperlukan
Route::get('/kontak', function () {
    return "<h1>Halaman Kontak</h1>";
})->name('statis.kontak');
