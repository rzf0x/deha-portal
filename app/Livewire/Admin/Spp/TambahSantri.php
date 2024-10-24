<?php

namespace App\Livewire\Admin\Spp;

use Livewire\Attributes\Title;
use Livewire\Component;

class TambahSantri extends Component
{
    #[Title('Tambah Santri')]
    public function render()
    {
        return view('livewire.admin.spp.tambah-santri');
    }
}
