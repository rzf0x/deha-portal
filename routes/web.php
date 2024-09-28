<?php

use App\Livewire\Admin\ListSantri\DetailSantri;
use App\Livewire\Admin\Spp\DashboardSpp;
use App\Livewire\Admin\Spp\LaporanKeuangan;
use App\Livewire\Admin\Spp\ListItemPembayaran;
use App\Livewire\Admin\Spp\Pembayaran;
use App\Livewire\Admin\Spp\PembayaranCicilan;
use App\Livewire\Auth\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', App\Livewire\Guest\LandingPage::class)->name('landing-page');

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', App\Livewire\Auth\Register::class)->name('register');

    Route::get('/logout', Logout::class)->name('auth.logout');
});

Route::fallback(function(){
    return view('404');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');

    // Data Master Pondok
    Route::prefix('master-pondok')->group(function (){
        Route::get('/jenjang', App\Livewire\Admin\Jenjang::class)->name('admin.master-pondok.jenjang');
        Route::get('/kelas', App\Livewire\Admin\Kelas::class)->name('admin.master-pondok.kelas');
        Route::get('/wali-kelas', App\Livewire\Admin\WaliKelas::class)->name('admin.master-pondok.wali-kelas');
        Route::get('/kamar', App\Livewire\Admin\Kamar::class)->name('admin.master-pondok.kamar');
        Route::get('/wali-kamar', App\Livewire\Admin\WaliKamar::class)->name('admin.master-pondok.wali-kamar');
        Route::get('/angkatan', App\Livewire\Admin\Angkatan::class)->name('admin.master-pondok.angkatan');
        Route::get('/semester', App\Livewire\Admin\Semester::class)->name('admin.master-pondok.semester');
    });

    // Data Master Santri
    Route::prefix('master-santri')->group(function () {
        Route::get('/list-santri', App\Livewire\Admin\ListSantri::class)->name('admin.master-santri.santri');
        Route::get('/list-santri/detail-santri/{id}', DetailSantri::class)->name('admin.master-santri.detail-santri');

        Route::get('/list-wali-santri', App\Livewire\Admin\ListWaliSantri::class)->name('admin.master-santri.wali-santri');

        // Services
        Route::get('/list-santri/export/', [App\Livewire\Admin\ListSantri::class, 'export']);
    });

    // Data Master Admin
    Route::prefix('master-admin')->group(function(){
        Route::get('/list-admin', App\Livewire\Admin\ListAdmin::class)->name('admin.master-admin.list-admin');
        Route::get('/list-role', App\Livewire\Admin\ListRole::class)->name('admin.master-admin.list-role');

        // Service
    });
});


Route::prefix('spp')->middleware('auth')->group(function(){

    // Dashboard
    Route::get('/dashboard', DashboardSpp::class)->name('spp.dashboard');

    // Service
    Route::get('/pembayaran', Pembayaran::class)->name('spp.pembayaran');
    Route::get('/list-item-pembayaran', ListItemPembayaran::class)->name('spp.list-item-pembayaran');
    Route::get('/pembayaran-cicilan', PembayaranCicilan::class)->name('spp.pembayaran-cicilan');

    Route::get('/laporan-keuangan', LaporanKeuangan::class)->name('spp.laporan-keuangan');
});
