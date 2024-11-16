<?php

namespace App\Livewire\Admin\AdminWarung;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Halaman Petugas Warung')]
    public function render()
    {
        return view('livewire.admin.admin-warung.dashboard');
    }
}
