<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran;
use App\Models\Spp\PembayaranTimeline;
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

    public function getMonthlyTotals()
    {
        // Inisialisasi array untuk menyimpan total pembayaran per bulan
        $monthlyTotals = array_fill(0, 12, 0); // Array dengan 12 elemen, diisi dengan 0

        // Ambil total pembayaran per bulan berdasarkan pembayaran_timeline
        $results = Pembayaran::with('pembayaranTimeline')
            ->selectRaw('pembayaran_timeline_id, SUM(nominal) as total')
            ->groupBy('pembayaran_timeline_id')
            ->get();

        // Mengisi array monthlyTotals dengan hasil query
        foreach ($results as $index => $result) {
            // Ambil bulan dari pembayaranTimeline berdasarkan id
            $bulan = PembayaranTimeline::find($result->pembayaran_timeline_id);
            if ($bulan) {
                $monthlyTotals[$index] = $result->total; // Menyimpan total untuk bulan yang sesuai
            }
        }
        return $monthlyTotals;
    }

    private function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    protected function calculateDueDate()
    {
        $currentDate = Carbon::now();
        $BulanIni = Carbon::create($currentDate->year, $currentDate->month);
        return $currentDate->greaterThan($BulanIni) ? $currentDate->diffInDays($BulanIni->addMonth()) : $currentDate->diffInDays($BulanIni);
    }

    public function render()
    {
        $monthlyTotals = $this->getMonthlyTotals();

        // Menyiapkan nama bulan dari Januari hingga Desember
        $bulanNames = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return view('livewire.admin.spp.dashboard-spp', [
            'monthlyTotals' => $monthlyTotals,
            'bulanNames' => $bulanNames,
        ]);
    }
}
