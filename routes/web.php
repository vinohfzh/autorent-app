<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/katalog', [FrontController::class, 'katalog'])->name('katalog');
Route::get('/detail/{id}', [FrontController::class, 'detail'])->name('detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout/{id}', [\App\Http\Controllers\TransaksiController::class, 'create'])->name('checkout');
    Route::post('/checkout', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('checkout.store');
    
    Route::get('/checkout-pembayaran/{id}', [\App\Http\Controllers\PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/checkout-pembayaran', [\App\Http\Controllers\PembayaranController::class, 'store'])->name('pembayaran.store');
    
    Route::get('/riwayat', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('riwayat');
});

// Admin Dashboard Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/pembayaran/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approvePayment'])->name('pembayaran.approve');
    Route::post('/pembayaran/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectPayment'])->name('pembayaran.reject');

    // Armada CRUD
    Route::resource('armada', \App\Http\Controllers\KendaraanController::class);
    
    // Booking / Transaksi Management
    Route::get('/booking', [\App\Http\Controllers\TransaksiController::class, 'adminIndex'])->name('booking.index');
    Route::post('/booking/{id}/status', [\App\Http\Controllers\TransaksiController::class, 'adminUpdateStatus'])->name('booking.status');

    // Pelanggan Management
    Route::get('/pelanggan', [\App\Http\Controllers\PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/create', [\App\Http\Controllers\PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan', [\App\Http\Controllers\PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/pelanggan/{pelanggan}/edit', [\App\Http\Controllers\PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::patch('/pelanggan/{pelanggan}', [\App\Http\Controllers\PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{pelanggan}', [\App\Http\Controllers\PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // Pembayaran Management
    Route::get('/pembayaran', [\App\Http\Controllers\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::delete('/pembayaran/{pembayaran}', [\App\Http\Controllers\PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
});

Route::get('/dashboard', function () {
    if (auth()->user() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
