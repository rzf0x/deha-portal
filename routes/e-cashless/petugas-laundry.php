<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminLaundry;

Route::prefix('petugas-laundry')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminLaundry\Dashboard::class)->name('petugas-laundry.dashboard');
    Route::get('/list-laundry', AdminLaundry\ListLaundry::class)->name('petugas-laundry.list-laundry');
    Route::get('/laundry-service', AdminLaundry\LaundryService::class)->name('petugas-laundry.laundry-service');
    Route::get('/riwayat-pesanan', AdminLaundry\RiwayatTransaksi::class)->name('petugas-laundry.pesanan');
});
