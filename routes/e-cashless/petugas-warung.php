<?php

use App\Livewire\Admin\AdminWarung;
use Illuminate\Support\Facades\Route;

Route::prefix('petugas-warung')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminWarung\Dashboard::class)->name('petugas-warung.dashboard');
    Route::get('/produk', AdminWarung\Produk::class)->name('petugas-warung.produk');
    Route::get('/kategori', AdminWarung\Kategori::class)->name('petugas-warung.kategori');
    Route::get('/pesanan', AdminWarung\TransaksiPesanan::class)->name('petugas-warung.pesanan');
    Route::get('/pembayaran', AdminWarung\Pembayaran::class)->name('petugas-warung.pembayaran');
    Route::get('/detail-pembayaran', AdminWarung\DetailPembayaran::class)->name('petugas-warung.detail-pembayaran');
    Route::get('/revenue', AdminWarung\Revenue::class)->name('petugas-warung.revenue');
});
