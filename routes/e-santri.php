<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ESantri\GuruDiniyyah;
use App\Livewire\Admin\ESantri\GuruUmum;
use App\Livewire\Santri;

Route::prefix('e-santri')->middleware('auth')->group(function () {
    Route::prefix('guru-diniyyah')->group(function () {
        Route::get('/dashboard', GuruDiniyyah\DashboardGuruDiniyyah::class)->name('e-santri-guru-diniyyah.dashboard');
        Route::get('/jadwal-pelajaran', GuruDiniyyah\JadwalPelajaran::class)->name('e-santri-guru-diniyyah.jadwal-pelajaran');
        Route::get('/kategori-pelajaran', GuruDiniyyah\KategoriPelajaran::class)->name('e-santri-guru-diniyyah.kategori-pelajaran');
        Route::get('/jadwal-piket', GuruDiniyyah\JadwalPiket::class)->name('e-santri-guru-diniyyah.jadwal-piket');
        Route::get('/pengumuman', GuruDiniyyah\Pengumuman::class)->name('e-santri-guru-diniyyah.pengumuman');
    });
    Route::prefix('guru')->group(function () {
        Route::get('/dashboard', GuruUmum\DashboardGuruUmum::class)->name('e-santri-guru-umum.dashboard');
        Route::get('/jadwal-pelajaran', GuruUmum\JadwalPelajaran::class)->name('e-santri-guru-umum.jadwal-pelajaran');
        Route::get('/kategori-pelajaran', GuruUmum\KategoriPelajaran::class)->name('e-santri-guru-umum.kategori-pelajaran');
        Route::get('/jadwal-piket', GuruUmum\JadwalPiket::class)->name('e-santri-guru-umum.jadwal-piket');
        Route::get('/pengumuman', GuruUmum\Pengumuman::class)->name('e-santri-guru-umum.pengumuman');
    });
});

Route::prefix('santri')->middleware('auth')->group(function () {
    Route::get('/dashboard', Santri\Dashboard::class)->name('santri.dashboard');
    Route::get('/profile', Santri\Profile::class)->name('santri.profile');
    Route::get('/kegiatan', Santri\Kegiatan::class)->name('santri.kegiatan');
    Route::get('/pengumuman', Santri\Pengumuman::class)->name('santri.pengumuman');
});
