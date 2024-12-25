<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Jenjang;
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
    public $tagihanAkanJatuhTempo;

    public $jenjangOptions;
    public $monthlyTotals = [];

    public $filter = [
        'jenjang' => 'SMPI Daarul Huffazh',
    ];

    public function mount()
    {
        $this->bulanSekarang = Carbon::now()->monthName;
        $this->jenjangOptions = Jenjang::all();

        $this->generateData();
    }

    public function generateData()
    {
        $santri = Santri::with('kelas.jenjang', 'Pembayaran')->where('status_kesantrian', 'aktif')
            ->with(['Pembayaran' => function ($query) {
                $query->whereHas('pembayaranTimeline', function ($subQuery) {
                    $subQuery->where('nama_bulan', $this->bulanSekarang);
                });
            }])
            ->whereHas('kelas.jenjang', function ($query) {
                $query->where('nama', $this->filter['jenjang']);
            })
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

        $this->totalSantri = $santri->count();

        $totalNominalTerbayar = $santri->flatMap->Pembayaran->sum('nominal');

        $totalNominalPembayaran = DetailItemPembayaran::whereHas('jenjang', function ($query) {
            $query->where('nama', $this->filter['jenjang']);
        })
            ->sum('nominal') * $this->totalSantri;

        $this->totalNominalDiterima = $this->formatRupiah($totalNominalTerbayar);
        $this->totalNominalTertunda = $this->formatRupiah($totalNominalTerbayar - $totalNominalPembayaran);
        $this->totalNominal = $this->formatRupiah($totalNominalPembayaran);

        $this->tagihanAkanJatuhTempo = $this->calculateDueDate();

        $this->dispatch('updateCharts', [
            'monthlyTotals' => $this->getMonthlyTotals(),
            'belum_bayar' => $this->belum_bayar,
            'lunas' => $this->lunas,
            'cicilan' => $this->cicilan,
        ]);
    }

    public function getMonthlyTotals()
    {

        $monthlyTotals = array_fill(0, 12, 0);
        $namaBulans = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $results = Pembayaran::selectRaw('pembayaran_timeline_id, SUM(nominal) as total, pembayaran_timeline.nama_bulan')
            ->join('pembayaran_timeline', 'pembayaran.pembayaran_timeline_id', '=', 'pembayaran_timeline.id')
            ->whereHas('santri.kelas.jenjang', function ($query) {
                $query->where('nama', $this->filter['jenjang']);
            })
            ->groupBy('pembayaran_timeline_id', 'pembayaran_timeline.nama_bulan')
            ->get();

        foreach ($results as $result) {
            $monthlyIndex = array_search($result->nama_bulan, $namaBulans);
            if ($monthlyIndex !== false) {
                $monthlyTotals[$monthlyIndex] += $result->total;
            }
        }

        return $monthlyTotals;
    }

    private function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    private function calculateDueDate()
    {
        $currentDate = Carbon::now();
        $BulanIni = Carbon::create($currentDate->year, $currentDate->month);
        return $currentDate->greaterThan($BulanIni) ? $currentDate->diffInDays($BulanIni->addMonth()) : $currentDate->diffInDays($BulanIni);
    }

    public function render()
    {
        return view('livewire.admin.spp.dashboard-spp');
    }
}
