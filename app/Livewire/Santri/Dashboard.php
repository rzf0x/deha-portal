<?php

namespace App\Livewire\Santri;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Halaman Santri')]
    public function render()
    {
        return view('livewire.santri.dashboard');
    }
}
