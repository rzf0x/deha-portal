<?php

namespace App\Livewire\Admin\Spp;

use Livewire\Attributes\Title;
use Livewire\Component;

class PembayaranCicilan extends Component
{
    #[Title('Halaman List Pembayaran cicilan')]
    public function render()
    {
        return view('livewire.admin.spp.pembayaran-cicilan');
    }
}
