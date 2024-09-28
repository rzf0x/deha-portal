<?php

namespace App\Livewire\Admin\ListSantri;

use App\Models\Santri;
use Livewire\Attributes\Title;
use Livewire\Component;

class DetailSantri extends Component
{
    // Array
    public $santri;

    #[Title('Halaman Detail Biodata Santri')]

    public function mount($id)
    {
        // Mengambil data santri berdasarkan nism dan langsung mengeksekusi query
        $this->santri = Santri::where('nism', $id)->first();
    }

    public function render()
    {
        return view('livewire.admin.list-santri.detail-santri');
    }
}
