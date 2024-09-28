<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Spp\DetailItemPembayaran;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class ListItemPembayaran extends Component
{
    #[Title('Halaman Item Pembayaran')]

    #[Computed]
    public function getData()
    {
        return DetailItemPembayaran::all();
    }

    public function render()
    {
        return view('livewire.admin.spp.list-item-pembayaran');
    }
}
