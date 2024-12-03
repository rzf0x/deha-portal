<?php

namespace App\Livewire\Admin\AdminECashless;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('E-Cashless Dashboard')]
    public function render()
    {
        return view('livewire.admin.admin-e-cashless.dashboard');
    }
}
