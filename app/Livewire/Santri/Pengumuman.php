<?php

namespace App\Livewire\Santri;

use App\Models\Pengumuman as ModelsPengumuman;
use Detection\MobileDetect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Pengumuman extends Component
{
    #[Title('Pengumuman')]
    public $detailPengumumanModal, $isMobile;

    public function mount()
    {
        $mobile = new MobileDetect();
        $this->isMobile = $mobile->isMobile();
    }

    #[Computed()]
    public function listPengumuman()
    {
        return ModelsPengumuman::all();
    }

    public function detailPengumuman($id)
    {
        $this->detailPengumumanModal = ModelsPengumuman::findOrFail($id);
    }
    
    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.santri.pengumuman')->layout('components.layouts.app-mobile');
        return view('livewire.santri.pengumuman');
    }
}
