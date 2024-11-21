<?php

use App\Livewire\Admin\AdminLaundry\Dashboard as AdminLaundryDashboard;
use App\Livewire\Admin\AdminWarung\Dashboard as AdminWarungDashboard;
use App\Livewire\Admin\AdminECashless\Dashboard as AdminECashlessDashboard;
use App\Livewire\Admin\AdminECashless\HistoryPembayaran;
use App\Livewire\Admin\AdminECashless\Pembayaran as AdminECashlessPembayaran;
use App\Livewire\Admin\AdminLaundry\LaundryService;
use App\Livewire\Admin\AdminLaundry\ListLaundry;
use App\Livewire\Admin\AdminLaundry\RiwayatTransaksi as TransaksiLaundry;
use App\Livewire\Admin\AdminWarung\DetailPembayaran;
use App\Livewire\Admin\AdminWarung\Kategori;
use App\Livewire\Admin\AdminWarung\Produk;
use App\Livewire\Admin\AdminWarung\Revenue;
use App\Livewire\Admin\AdminWarung\TransaksiPesanan;
use App\Livewire\Admin\AdminWarung\Pembayaran as PembayaranPesanan;
use App\Livewire\Admin\ListSantri\DetailSantri;
use App\Livewire\Admin\Spp\DashboardSpp;
use App\Livewire\Admin\Spp\DetailLaporanCicilanSantri;
use App\Livewire\Admin\Spp\DetailLaporanSppSantri;
use App\Livewire\Admin\Spp\KwitansiInvoice;
use App\Livewire\Admin\Spp\LaporanKeuangan;
use App\Livewire\Admin\Spp\ListItemPembayaran;
use App\Livewire\Admin\Spp\Pembayaran;
use App\Livewire\Admin\Spp\PembayaranCicilan;
use App\Livewire\Admin\Spp\TambahSantri;
use App\Livewire\Auth\Logout;
use App\Livewire\Santri\Dashboard;
use App\Livewire\Santri\Kegiatan;
use App\Livewire\Santri\Pengumuman;
use App\Livewire\Santri\Profile;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Cache berhasil dibersihkan!';
});

Route::prefix('spp')->middleware('auth')->group(function(){

    // Dashboard
    Route::get('/dashboard', DashboardSpp::class)->name('spp.dashboard');

    // Service
    Route::get('/pembayaran', Pembayaran::class)->name('spp.pembayaran');
    Route::get('/list-item-pembayaran', ListItemPembayaran::class)->name('spp.list-item-pembayaran');
    Route::get('/pembayaran-cicilan', PembayaranCicilan::class)->name('spp.pembayaran-cicilan');
    Route::get('/tambah-santri', TambahSantri::class)->name('spp.tambah-santri');
    Route::get('/detail-laporan-spp-santri/{id}', DetailLaporanSppSantri::class)->name('spp.detail-laporan-spp-santri');
    Route::get('/detail-laporan-cicilan-santri/{id}/{bulan?}', DetailLaporanCicilanSantri::class)->name('spp.detail-laporan-cicilan-santri');

    Route::get('/laporan-keuangan', LaporanKeuangan::class)->name('spp.laporan-keuangan');

    Route::get('/kwitansi/{id}', [KwitansiInvoice::class, 'cetakKwitansi'])->name('cetak-kwitansi-spp');
});

Route::prefix('santri')->middleware('auth')->group(function() {
    Route::get('/dashboard', Dashboard::class)->name('santri.dashboard');
    Route::get('/profile', Profile::class)->name('santri.profile');
    Route::get('/kegiatan', Kegiatan::class)->name('santri.kegiatan');
    Route::get('/pengumuman', Pengumuman::class)->name('santri.pengumuman');
});
Route::prefix('petugas-warung')->middleware('auth')->group(function() {
    Route::get('/dashboard', AdminWarungDashboard::class)->name('petugas-warung.dashboard');
    Route::get('/produk', Produk::class)->name('petugas-warung.produk');
    Route::get('/kategori', Kategori::class)->name('petugas-warung.kategori');
    Route::get('/pesanan', TransaksiPesanan::class)->name('petugas-warung.pesanan');
    Route::get('/pembayaran', PembayaranPesanan::class)->name('petugas-warung.pembayaran');
    Route::get('/detail-pembayaran', DetailPembayaran::class)->name('petugas-warung.detail-pembayaran');
    Route::get('/revenue', Revenue::class)->name('petugas-warung.revenue');

});
Route::prefix('petugas-laundry')->middleware('auth')->group(function() {
    Route::get('/dashboard', AdminLaundryDashboard::class)->name('petugas-laundry.dashboard');
    Route::get('/list-laundry', ListLaundry::class)->name('petugas-laundry.list-laundry');
    Route::get('/laundry-service', LaundryService::class)->name('petugas-laundry.laundry-service');
    Route::get('/riwayat-pesanan', TransaksiLaundry::class)->name('petugas-laundry.pesanan');
});
Route::prefix('petugas-e-cashless')->middleware('auth')->group(function() {
    Route::get('/dashboard', AdminECashlessDashboard::class)->name('petugas-e-cashless.dashboard');
    Route::get('/pembayaran', AdminECashlessPembayaran::class)->name('petugas-e-cashless.pembayaran');
    Route::get('/history-pembayaran', HistoryPembayaran::class)->name('petugas-e-cashless.history-pembayaran');
});