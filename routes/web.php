<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // <-- WAJIB TAMBAHKAN INI DI ATAS

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AKSES PUBLIK (Siapa saja bisa lihat) ---
Route::redirect('/', '/login');
Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');
Route::get('/houses/{id}', [HouseController::class, 'show'])->name('houses.show');
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// --- AKSES USER LOGIN (Wajib Login) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Bawaan Breeze
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Fitur Sewa untuk Penyewa
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::post('/bookings/{id}/upload', [BookingController::class, 'uploadPayment'])->name('bookings.upload');
    Route::get('/booking-success', function () {
        return view('bookings.success');
    })->name('bookings.success');

    // --- AKSES ADMIN (Manajemen Katalog & Pesanan) ---
    Route::group(['middleware' => function ($request, $next) {
        if ($request->user() && $request->user()->email === 'admin@gmail.com') {
            return $next($request);
        }
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }], function () {

        // Manajemen Rumah (Katalog)
        Route::get('/admin/houses/create', [HouseController::class, 'create'])->name('admin.houses.create');
        Route::post('/admin/houses', [HouseController::class, 'store'])->name('admin.houses.store');

        // --- RUTE EDIT & UPDATE YANG BARU DITAMBAHKAN ---
        Route::get('/admin/houses/{id}/edit', [HouseController::class, 'edit'])->name('admin.houses.edit');
        Route::put('/admin/houses/{id}', [HouseController::class, 'update'])->name('admin.houses.update');
        Route::delete('/admin/houses/{id}', [HouseController::class, 'destroy'])->name('admin.houses.destroy');

        // Manajemen Pesanan (Booking)
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::patch('/admin/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::delete('/admin/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    // Fitur Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// =========================================================================
// ROUTE TEMPORER UNTUK MIGRASI DATABASE VERCEL (SUDAH DIPERBAIKI UNTUK PRODUKSI)
// =========================================================================
Route::get('/run-migration', function () {
    try {
        // Menggunakan perintah 'migrate' biasa dengan --force agar aman dan diizinkan oleh sistem produksi
        Artisan::call('migrate', ['--force' => true]);
        return "Pesan: Migrasi database berhasil dijalankan!";
    } catch (\Exception $e) {
        return "Error saat migrasi: " . $e->getMessage();
    }
});
