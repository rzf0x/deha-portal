<?php

namespace App\Livewire\Admin\AdminLaundry;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title("Halaman Petugas Laundry")]
    public function render()
    {
        return view('livewire.admin.admin-laundry.dashboard');
    }
}
