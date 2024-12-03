<?php

use App\Livewire\Admin;
use App\Livewire\Auth;
use App\Livewire\Santri;
use App\Livewire\Admin\Spp;
use App\Livewire\Admin\AdminWarung;
use App\Livewire\Admin\AdminECashless;
use App\Livewire\Admin\AdminLaundry;
use App\Livewire\Admin\ESantri\GuruDiniyyah;
use App\Livewire\Admin\ESantri\GuruUmum;
use App\Livewire\Admin\ListSantri\DetailSantri;
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
    Route::get('/login', Auth\Login::class)->name('login');
    Route::get('/register', Auth\Register::class)->name('register');
    Route::get('/logout', Auth\Logout::class)->name('auth.logout');
});

Route::fallback(function () {
    return view('404');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', Admin\Dashboard::class)->name('admin.dashboard');

    // Data Master Pondok
    Route::prefix('master-pondok')->group(function () {
        Route::get('/jenjang', Admin\Jenjang::class)->name('admin.master-pondok.jenjang');
        Route::get('/kelas', Admin\Kelas::class)->name('admin.master-pondok.kelas');
        Route::get('/wali-kelas', Admin\WaliKelas::class)->name('admin.master-pondok.wali-kelas');
        Route::get('/kamar', Admin\Kamar::class)->name('admin.master-pondok.kamar');
        Route::get('/wali-kamar', Admin\WaliKamar::class)->name('admin.master-pondok.wali-kamar');
        Route::get('/angkatan', Admin\Angkatan::class)->name('admin.master-pondok.angkatan');
        Route::get('/semester', Admin\Semester::class)->name('admin.master-pondok.semester');
    });

    // Data Master Santri
    Route::prefix('master-santri')->group(function () {
        Route::get('/list-santri', Admin\ListSantri::class)->name('admin.master-santri.santri');
        Route::get('/list-santri/detail-santri/{id}', DetailSantri::class)->name('admin.master-santri.detail-santri');

        Route::get('/list-wali-santri', Admin\ListWaliSantri::class)->name('admin.master-santri.wali-santri');

        // Services
        Route::get('/list-santri/export/', [Admin\ListSantri::class, 'export']);
    });

    // Data Master Admin
    Route::prefix('master-admin')->group(function () {
        Route::get('/list-admin', Admin\ListAdmin::class)->name('admin.master-admin.list-admin');
        Route::get('/list-role', Admin\ListRole::class)->name('admin.master-admin.list-role');

        // Service
    });

    Route::prefix('master-aktifitas')->group(function () {
        Route::get('/pengumuman', Admin\Pengumuman::class)->name('admin.master-aktifitas.pengumuman');
        Route::get('/kegiatan', Admin\Kegiatan::class)->name('admin.master-aktifitas.kegiatan');
    });
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Cache berhasil dibersihkan!';
});

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

Route::prefix('e-santri')->middleware('auth')->group(function () {
    Route::prefix('guru-diniyyah')->group(function () {
        Route::get('/dashboard', GuruDiniyyah\DashboardGuruDiniyyah::class)->name('e-santri-guru-diniyyah.dashboard');
        Route::get('/jadwal-pelajaran', GuruDiniyyah\JadwalPelajaran::class)->name('e-santri-guru-diniyyah.jadwal-pelajaran');
        Route::get('/jadwal-piket', GuruDiniyyah\JadwalPiket::class)->name('e-santri-guru-diniyyah.jadwal-piket');
        Route::get('/pengumuman', GuruDiniyyah\Pengumuman::class)->name('e-santri-guru-diniyyah.pengumuman');
    });
    Route::prefix('guru')->group(function () {
        Route::get('/dashboard', GuruUmum\DashboardGuruUmum::class)->name('e-santri-guru-umum.dashboard');
        Route::get('/jadwal-pelajaran', GuruUmum\JadwalPelajaran::class)->name('e-santri-guru-umum.jadwal-pelajaran');
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
Route::prefix('petugas-warung')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminWarung\Dashboard::class)->name('petugas-warung.dashboard');
    Route::get('/produk', AdminWarung\Produk::class)->name('petugas-warung.produk');
    Route::get('/kategori', AdminWarung\Kategori::class)->name('petugas-warung.kategori');
    Route::get('/pesanan', AdminWarung\TransaksiPesanan::class)->name('petugas-warung.pesanan');
    Route::get('/pembayaran', AdminWarung\Pembayaran::class)->name('petugas-warung.pembayaran');
    Route::get('/detail-pembayaran', AdminWarung\DetailPembayaran::class)->name('petugas-warung.detail-pembayaran');
    Route::get('/revenue', AdminWarung\Revenue::class)->name('petugas-warung.revenue');
});
Route::prefix('petugas-laundry')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminLaundry\Dashboard::class)->name('petugas-laundry.dashboard');
    Route::get('/list-laundry', AdminLaundry\ListLaundry::class)->name('petugas-laundry.list-laundry');
    Route::get('/laundry-service', AdminLaundry\LaundryService::class)->name('petugas-laundry.laundry-service');
    Route::get('/riwayat-pesanan', AdminLaundry\RiwayatTransaksi::class)->name('petugas-laundry.pesanan');
});
Route::prefix('petugas-e-cashless')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminECashless\Dashboard::class)->name('petugas-e-cashless.dashboard');
    Route::get('/pembayaran', AdminECashless\Pembayaran::class)->name('petugas-e-cashless.pembayaran');
    Route::get('/history-pembayaran', AdminECashless\HistoryPembayaran::class)->name('petugas-e-cashless.history-pembayaran');
});
