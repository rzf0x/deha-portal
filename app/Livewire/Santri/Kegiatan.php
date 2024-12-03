<?php

namespace App\Livewire\Santri;

use App\Models\Kegiatan as ModelsKegiatan;
use Detection\MobileDetect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Kegiatan extends Component
{
    #[Title('Kegiatan')]
    public $detailKegiatanModal, $isMobile;

    public function mount()
    {
        $mobile = new MobileDetect();
        $this->isMobile = $mobile->isMobile();
    }
    #[Computed]
    public function listKegiatan()
    {
        return ModelsKegiatan::all();
    }

    public function detailKegiatan($id)
    {
        $this->detailKegiatanModal = ModelsKegiatan::findOrFail($id);
    }
    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.santri.kegiatan')->layout('components.layouts.app-mobile');
        return view('livewire.santri.kegiatan');
    }
}
