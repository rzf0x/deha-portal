<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\Cicilan; // Ganti Pembayaran menjadi Cicilan
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

    public function mount($id)
    {
        $this->santriId = $id;
        // Memuat hanya field yang diperlukan
        $this->santri = Santri::select('id', 'nama', 'kelas_id', 'kamar_id')
            ->with([
                'kelas:id,nama',
                'kamar:id,nama'
            ])
            ->findOrFail($id);

        $this->filter['bulan'] = date('n');
        $this->filter['tahun'] = date('Y');
    }

    protected function getCicilan()
    {
        return Cicilan::with([
                'pembayaran.pembayaranTimeline:id,nama_bulan',
                'pembayaran.pembayaranTipe:id,nama',
                'pembayaran.cicilans' // Ambil data pembayaran yang terkait
            ])
            ->whereHas('pembayaran.cicilans', function ($query) {
                $query->where('santri_id', $this->santriId);
            })
            ->when($this->filter['tahun'], function ($query) {
                $query->whereYear('created_at', $this->filter['tahun']);
            })
            ->when($this->filter['bulan'], function ($query) {
                $query->whereMonth('created_at', $this->filter['bulan']);
            })
            ->orderBy('created_at')
            ->get();
    }

    protected function getTahunList()
    {
        return Cicilan::query()
            ->whereHas('pembayaran', function ($query) {
                $query->where('santri_id', $this->santriId);
            })
            ->selectRaw('DISTINCT YEAR(created_at) as tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');
    }
    protected function getBulanList()
    {
        return Cicilan::query()
            ->whereHas('pembayaran', function ($query) {
                $query->where('santri_id', $this->santriId);
            })
            ->selectRaw('DISTINCT MONTH(created_at) as bulan')
            ->orderByDesc('bulan')
            ->pluck('bulan');
    }

    public function render()
    {
        $cicilan = $this->getCicilan();

        return view('livewire.admin.spp.detail-laporan-cicilan-santri', [
            'cicilan' => $cicilan,
            'tahunList' => $this->getTahunList(),
            'bulanList' => $this->getBulanList(),
            'total_cicilan' => $cicilan->count(),
            'total_nominal' => $cicilan->sum('nominal'),
        ]);
    }
}
