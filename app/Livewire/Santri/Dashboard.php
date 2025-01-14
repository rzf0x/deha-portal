<?php

namespace App\Livewire\Santri;

use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Santri;
use App\Models\Spp\Pembayaran;
use App\Models\Spp\PembayaranTimeline;
use Carbon\Carbon;
use Detection\MobileDetect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard Santri')]
    public $detailKegiatanModal, $detailPengumumanModal;

    public $profile, $credentials, $timeline_spp, $pembayaran;
    public $setStatusSpp, $isMobile;

    public function mount()
    {
        $this->profile = Santri::with('kamar', 'kelas', 'semester', 'angkatan')->where('nama', auth()->user()->name)->first();
        $this->timeline_spp = PembayaranTimeline::all();
        $this->setStatusSpp = Carbon::now()->format('F');

        $mobile = new MobileDetect();
        $this->isMobile = $mobile->isMobile();

        $this->updatedSetStatusSpp($this->setStatusSpp);
    }

    public function updatedSetStatusSpp($value)
    {
        $this->pembayaran = Pembayaran::with('pembayaranTimeline', 'santri')
            ->whereHas('santri', function ($query) {
                return $query->where('nama', auth()->user()->name);
            })
            ->whereHas('pembayaranTimeline', function ($query) use ($value) {
                return $query->where('nama_bulan', $value);
            })->first();
    }

    #[Computed]
    public function listPengumuman()
    {
        return Pengumuman::latest()->take(4)->get();
    }

    #[Computed]
    public function listKegiatan()
    {
        return Kegiatan::latest()->take(4)->get();
    }

    public function detailKegiatan($id)
    {
        $this->detailKegiatanModal = Kegiatan::findOrFail($id);
    }

    public function detailPengumuman($id)
    {
        $this->detailPengumumanModal = Pengumuman::findOrFail($id);
    }

    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.santri.dashboard')->layout('components.layouts.app-mobile');
        return view('livewire.santri.dashboard');
    }
}
