<?php

namespace App\Livewire\Santri;

use App\Models\Kegiatan as ModelsKegiatan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Kegiatan extends Component
{
    #[Title('Kegiatan')]
    public $detailKegiatanModal;

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
        return view('livewire.santri.kegiatan');
    }
}
