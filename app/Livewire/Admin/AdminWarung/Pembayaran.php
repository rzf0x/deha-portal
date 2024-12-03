<?php

namespace App\Livewire\Admin\AdminWarung;

use Livewire\Attributes\Title;
use Livewire\Component;

class Pembayaran extends Component
{
    #[Title('Menu Pembayaran')]
    public function render()
    {
        return view('livewire.admin.admin-warung.pembayaran');
    }
}
