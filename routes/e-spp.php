<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Spp;

Route::prefix('spp')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', Spp\DashboardSpp::class)->name('spp.dashboard');

    // Service
    Route::get('/pembayaran', Spp\Pembayaran::class)->name('spp.pembayaran');
    Route::get('/list-item-pembayaran', Spp\ListItemPembayaran::class)->name('spp.list-item-pembayaran');
    Route::get('/pembayaran-cicilan', Spp\PembayaranCicilan::class)->name('spp.pembayaran-cicilan');
    Route::get('/tambah-santri', Spp\TambahSantri::class)->name('spp.tambah-santri');
    Route::get('/detail-laporan-spp-santri/{id}', Spp\DetailLaporanSppSantri::class)->name('spp.detail-laporan-spp-santri');
    Route::get('/detail-laporan-cicilan-santri/{id}/{bulan?}', Spp\DetailLaporanCicilanSantri::class)->name('spp.detail-laporan-cicilan-santri');

    Route::get('/laporan-keuangan', Spp\LaporanKeuangan::class)->name('spp.laporan-keuangan');

    Route::get('/kwitansi/spp/{id}', [Spp\KwitansiInvoice::class, 'cetakKwitansiPembayaran'])->name('cetak-kwitansi-spp');
    Route::get('/kwitansi/cicilan/{id}', [Spp\KwitansiInvoice::class, 'cetakKwitansiCicilan'])->name('cetak-kwitansi-cicilan-spp');
});
