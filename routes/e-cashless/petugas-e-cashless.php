<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminECashless;

Route::prefix('petugas-e-cashless')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminECashless\Dashboard::class)->name('petugas-e-cashless.dashboard');
    Route::get('/pembayaran', AdminECashless\Pembayaran::class)->name('petugas-e-cashless.pembayaran');
    Route::get('/history-pembayaran', AdminECashless\HistoryPembayaran::class)->name('petugas-e-cashless.history-pembayaran');
});
