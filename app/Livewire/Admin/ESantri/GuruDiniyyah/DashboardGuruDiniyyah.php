<?php

namespace App\Livewire\Admin\ESantri\GuruDiniyyah;

use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardGuruDiniyyah extends Component
{
    #[Title('Dashboard Santri')]

    public function render()
    {
        return view('livewire.admin.e-santri.guru-diniyyah.dashboard-guru-diniyyah');
    }
}
