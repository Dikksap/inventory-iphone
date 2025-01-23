<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
// Rute untuk halaman utama
Route::get('/', function () {
    return view('login.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::middleware(['auth','check_role:admin'])->group(function () {

        Route::get('/profile', [UserController::class, 'index'])->name('profile');
        Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
    // Rute untuk menampilkan halaman utama (daftar barang)
        Route::get('/data-barang', [BarangController::class, 'index'])->name('data-barang');

        Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');


        // Rute untuk menampilkan form untuk menambah barang
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');

        // Rute untuk menyimpan barang baru
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');

        // Rute untuk menampilkan detail barang
        Route::get('/barang/{id}', [BarangController::class, 'show'])->name('barang.show');

        // Rute untuk laporan keuangan
        Route::get('/laporan-keuangan', [BarangController::class, 'laporanKeuangan'])->name('laporan.keuangan');

        Route::get('/dashboard', [BarangController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
