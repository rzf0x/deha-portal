<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\Cicilan; // Ganti Pembayaran menjadi Cicilan
use App\Models\Spp\DetailItemPembayaran;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

class DetailLaporanCicilanSantri extends Component
{
    #[Title('Halaman Detail Cicilan Santri')]

    public $santriId;
    public $santri;
    
    public $filter = [
        'bulan' => '',
        'tahun' => ''
    ];

    public $cicilan, $tahunList, $bulanList, $total_cicilan, $total_nominal, $total_cicilan_belum_bayar;

    public function mount($id, $bulan = null)
    {
        $this->santriId = $id;
        // Memuat hanya field yang diperlukan
        $this->santri = Santri::select('id', 'nama', 'kelas_id', 'kamar_id',)
            ->with([
                'kelas',
                'kamar:id,nama'
            ])
            ->findOrFail($id);

            $this->filter['bulan'] = $bulan ?? Carbon::now()->monthName;
            // dd($this->filter['bulan']);
        $this->filter['tahun'] = date('Y');
        $this->generateData();
    }

    public function generateData()
    {
        $cicilan = $this->getCicilan();
        $totalPembayaran = DetailItemPembayaran::where('jenjang_id', $this->santri->kelas->jenjang->id)->sum('nominal');
        $pembayaran_bulan_total = $totalPembayaran * $cicilan->count();

        $total_cicilan_belum_bayar = ($this->filter['bulan'] ? $totalPembayaran : $pembayaran_bulan_total) - $cicilan->sum('nominal');

        $this->cicilan = $cicilan;
        $this->tahunList = $this->getTahunList();
        $this->bulanList = $this->getBulanList();
        $this->total_cicilan = $cicilan->count();
        $this->total_nominal = $cicilan->sum('nominal');
        $this->total_cicilan_belum_bayar = $total_cicilan_belum_bayar;
    }

    protected function getCicilan()
    {
        return Cicilan::with([
            'pembayaran.pembayaranTimeline:id,nama_bulan',
            'pembayaran.pembayaranTipe:id,nama',
            'pembayaran',
            'pembayaran.cicilans' // Ambil data pembayaran yang terkait
        ])
            ->whereHas('pembayaran', function ($query) {
                $query->where('status', 'cicilan');
            })
            ->whereHas('pembayaran.cicilans', function ($query) {
                $query->where('santri_id', $this->santriId);
            })
            ->when($this->filter['tahun'], function ($query) {
                $query->whereYear('created_at', $this->filter['tahun']);
            })
            ->when($this->filter['bulan'], function ($query) {
                $query->whereHas('pembayaran.pembayaranTimeline', function ($q) {
                    $q->where('nama_bulan', $this->filter['bulan']);
                });
            })
            ->orderBy('created_at')
            ->get();
    }

    protected function getTahunList()
    {
        return Cicilan::query()
            ->whereHas('pembayaran', function ($query) {
                $query->where('santri_id', $this->santriId);
                $query->where('status', 'cicilan');
            })
            ->selectRaw('DISTINCT YEAR(created_at) as tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');
    }
    protected function getBulanList()
    {
        return ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        // return Cicilan::with(['pembayaran.pembayaranTimeline'])
        //     ->whereHas('pembayaran', function ($query) {
        //         $query->where('santri_id', $this->santriId);
        //         $query->where('status', 'cicilan');
        //     })
        //     ->get()
        //     ->pluck('pembayaran.pembayaranTimeline.nama_bulan')
        //     ->filter()
        //     ->unique()
        //     ->values()
        //     ->toArray();
    }

    public function render()
    {
        return view('livewire.admin.spp.detail-laporan-cicilan-santri');
    }
}
