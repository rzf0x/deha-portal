<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Jenjang;
use App\Models\Santri;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardSpp extends Component
{
    #[Title('Halaman Dashboard E-SPP Daarul Huffazh')]

    public $lunas, $belum_bayar, $cicilan, $totalSantri, $totalNominal, $totalNominalDiterima, $totalNominalTertunda, $tagihanAkanJatuhTempo;

    public $jenjangOptions,$tahunOptions,$bulanOptions;

    public $monthlyTotals = [];

    public $filter = [
        'jenjang' => '',
        'tahun' => '',
        'bulan' => '',
    ];

    public function mount()
    {
        $this->filter['jenjang'] = Jenjang::first()->value('nama');
        $this->filter['bulan'] = Carbon::now()->monthName;
        $this->filter['tahun'] = date('Y');

        $this->bulanOptions = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $this->jenjangOptions = Jenjang::all();
        $this->tahunOptions = TahunAjaran::all();

        $this->generateData();
    }

    public function generateData()
    {
        $santri = Santri::with('kelas.jenjang', 'Pembayaran')->where('status_kesantrian', 'aktif')
            ->with(['Pembayaran' => function ($query) {
                $query->whereHas('pembayaranTimeline', function ($subQuery) {
                    $subQuery->where('nama_bulan', $this->filter['bulan']);
                })
                    ->where('tahun_ajaran_id', $this->filter['tahun']);
            }])
            ->whereHas('pembayaran', function($query){
                $query->where('tahun_ajaran_id', $this->filter['tahun']);
            })
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
            ->where('tahun_ajaran_id', $this->filter['tahun'])
            ->sum('nominal') * $this->totalSantri;

        $this->totalNominalDiterima = $this->formatRupiah($totalNominalTerbayar);
        $this->totalNominalTertunda = $this->formatRupiah($totalNominalTerbayar - $totalNominalPembayaran);
        $this->totalNominal = $this->formatRupiah($totalNominalPembayaran);

        $this->tagihanAkanJatuhTempo = $this->hitungJatuhTempo();

        // generate data statistik chart
        $this->dispatch('updateCharts', [
            'monthlyTotals' => $this->getMonthlyTotals(),
            'belum_bayar' => $this->belum_bayar,
            'lunas' => $this->lunas,
            'cicilan' => $this->cicilan,
        ]);
    }

    public function getMonthlyTotals()
    {
        $results = Pembayaran::selectRaw('pembayaran_timeline.nama_bulan, SUM(nominal) as total')
            ->join('pembayaran_timeline', 'pembayaran.pembayaran_timeline_id', '=', 'pembayaran_timeline.id')
            ->whereHas('santri.kelas.jenjang', fn($q) => $q->where('nama', $this->filter['jenjang']))
            ->where('tahun_ajaran_id', $this->filter['tahun'])
            ->groupBy('pembayaran_timeline.nama_bulan')
            ->get()
            ->pluck('total', 'nama_bulan');

        return collect($this->bulanOptions)->map(fn($bulan) => $results[$bulan] ?? 0)->toArray();
    }

    private function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    private function hitungJatuhTempo()
    {
        $tanggalSekarang = now();
        $awalBulan = now()->startOfMonth();

        return $tanggalSekarang->greaterThan($awalBulan)
            ? $tanggalSekarang->diffInDays($awalBulan->addMonth())
            : $tanggalSekarang->diffInDays($awalBulan);
    }


    public function render()
    {
        return view('livewire.admin.spp.dashboard-spp');
    }
}
