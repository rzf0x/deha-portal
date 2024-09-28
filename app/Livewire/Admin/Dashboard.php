<?php

namespace App\Livewire\Admin;

use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;
use Livewire\attributes\Title;
use Detection\MobileDetect;

class Dashboard extends Component
{
    // Integer
    public $totalJenjang, $totalKelas, $totalKamar, $totalAdmin, $totalSantri;

    // Bool
    public $isMobile = false;

    #[Title('Dashboard Superadmin Page')]

    public function mount(MobileDetect $mobileDetect)
    {
        $this->totalJenjang = 5;
        $this->totalKelas = 3;
        $this->totalKamar = 24;
        $this->totalAdmin = 2;
        $this->totalSantri = 10;

        $this->isMobile = $mobileDetect->isMobile();
    }

    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.admin.dashboard')->layout('components.layouts.app-mobile');
        return view('livewire.admin.dashboard');
    }
}
