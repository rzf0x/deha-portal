<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardSpp extends Component
{
    #[Title('Halaman Dashboard E-SPP Daarul Huffazh')]

    public $bulanSekarang;
    public $lunas;
    public $belum_bayar;
    public $cicilan;
    public $totalSantri;
    public $totalNominal;
    public $totalNominalDiterima;
    public $totalNominalTertunda;
    public $persentasePembayaran;
    public $tagihanAkanJatuhTempo;
    public $pembayaranHarian;

    public function mount()
    {

        $this->bulanSekarang = Carbon::now()->monthName;

        $santri = Santri::where('status_kesantrian', 'aktif')
            ->whereHas('Pembayaran', function ($query) {
                $query->whereHas('pembayaranTimeline', function ($subQuery) {
                    $subQuery->where('nama_bulan', $this->bulanSekarang);
                });
            })
            ->with(['Pembayaran' => function ($query) {
                $query->whereHas('pembayaranTimeline', function ($subQuery) {
                    $subQuery->where('nama_bulan', $this->bulanSekarang);
                });
            }])
            ->get();

        // dd($this->bulanSekarang , Santri::where('status_kesantrian', 'aktif')->with(['Pembayaran.pembayaranTimeline'])->get());     

        $this->lunas = $santri->filter(function ($item) {
            return $item->Pembayaran->contains('status', 'lunas');
        })->count();

        $this->belum_bayar = $santri->filter(function ($item) {
            return $item->Pembayaran->contains('status', 'belum bayar');
        })->count();

        $this->cicilan = $santri->filter(function ($item) {
            return $item->Pembayaran->contains('status', 'cicilan');
        })->count();

        $this->totalSantri = Santri::count();
        $totalNominalTerbayar = Pembayaran::sum('nominal');
        $totalNominalPembayaran = DetailItemPembayaran::sum('nominal') * $this->totalSantri;

        $this->totalNominalDiterima = $this->formatRupiah($totalNominalTerbayar);
        $this->totalNominalTertunda = $this->formatRupiah($totalNominalTerbayar - $totalNominalPembayaran);
        $this->totalNominal = $this->formatRupiah($totalNominalPembayaran);

        if ($this->totalNominalDiterima > 0) {
            $this->persentasePembayaran = round(($totalNominalTerbayar / $totalNominalPembayaran) * 100, 1);
        } else {
            $this->persentasePembayaran = 0;
        }
        $this->tagihanAkanJatuhTempo = $this->calculateDueDate();

        $this->pembayaranHarian = Pembayaran::selectRaw('DATE(updated_at) as tanggal, SUM(nominal) as total')
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    }
    private function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    protected function calculateDueDate()
    {
        $currentDate = Carbon::now(); // Tanggal sekarang
        $tanggal5BulanIni = Carbon::create($currentDate->year, $currentDate->month, 5); // Tanggal 5 bulan ini

        // Jika tanggal sekarang sudah lewat tanggal 5 bulan ini, hitung dengan tanggal 5 bulan depan
        if ($currentDate->greaterThan($tanggal5BulanIni)) {
            $tanggal5BulanDepan = $tanggal5BulanIni->addMonth(); // Tanggal 5 bulan depan
            return $currentDate->diffInDays($tanggal5BulanDepan); // Hanya kembalikan jumlah hari
        }

        // Jika belum lewat tanggal 5, hitung dengan tanggal 5 bulan ini
        return $currentDate->diffInDays($tanggal5BulanIni); // Hanya kembalikan jumlah hari
    }

    public function render()
    {
        return view('livewire.admin.spp.dashboard-spp');
    }
}
