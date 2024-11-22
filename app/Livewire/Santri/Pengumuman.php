<?php

namespace App\Livewire\Santri;

use App\Models\Pengumuman as ModelsPengumuman;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Pengumuman extends Component
{
    #[Title('Pengumuman')]

    public $detailPengumumanModal;

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
        return view('livewire.santri.pengumuman');
    }
}
