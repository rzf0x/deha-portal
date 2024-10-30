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

        $this->filter['tahun'] = date('Y');
    }

    protected function getCicilan()
    {
        return Cicilan::query()
            ->select([
                'id',
                'nominal',
                'keterangan',
                'pembayaran_id',
                'created_at'
            ])
            ->with([
                'pembayaran.cicilans' // Ambil data pembayaran yang terkait
            ])
            ->whereHas('pembayaran.cicilans', function($query) {
                $query->where('santri_id', $this->santriId);
            })
            ->when($this->filter['tahun'], function ($query) {
                $query->whereYear('created_at', $this->filter['tahun']);
            })
            ->orderBy('created_at')
            ->get();
    }

    protected function getTahunList()
    {
        return Cicilan::query()
            ->whereHas('pembayaran', function($query) {
                $query->where('santri_id', $this->santriId);
            })
            ->selectRaw('DISTINCT YEAR(created_at) as tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');
    }

    public function render()
    {
        $cicilan = $this->getCicilan();

        return view('livewire.admin.spp.detail-laporan-cicilan-santri', [
            'cicilan' => $cicilan,
            'tahunList' => $this->getTahunList(),
            'total_cicilan' => $cicilan->count(),
            'total_nominal' => $cicilan->sum('nominal'),
        ]);
    }
}
