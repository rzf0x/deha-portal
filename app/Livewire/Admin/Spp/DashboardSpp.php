<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardSpp extends Component
{
    #[Title('Halaman Dashboard E-SPP Daarul Huffazh')]

    public $totalSantri;
    public $belum_lunas;
    public $lunas;
    public $bulanSekarang;
    public $cicilan;

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

    $this->belum_lunas = $santri->filter(function ($item) {
        return $item->Pembayaran->contains('status', 'belum lunas');
    })->count();

    $this->cicilan = $santri->filter(function ($item) {
        return $item->Pembayaran->contains('status', 'cicilan');
    })->count();

        $this->totalSantri = Santri::count();
    }

    public function render()
    {
        return view('livewire.admin.spp.dashboard-spp');
    }
}
