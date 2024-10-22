<?php

namespace App\Livewire\Admin;

use App\Models\Jenjang;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\WaliKelas;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;
use Livewire\attributes\Title;
use Detection\MobileDetect;

class Dashboard extends Component
{
    // Integer
    public $totalJenjang, $totalKelas, $totalKamar, $waliKelas, $totalSantri;

    // Bool
    public $isMobile = false;

    #[Title('Dashboard Superadmin Page')]

    public function mount(MobileDetect $mobileDetect)
    {
        $this->totalKelas = count(Kelas::all());
        $this->totalKamar = count(Kamar::all());
        $this->waliKelas = count(WaliKelas::all());;
        $this->totalSantri = count(Santri::all());

        $this->isMobile = $mobileDetect->isMobile();
    }

    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.admin.dashboard')->layout('components.layouts.app-mobile');
        return view('livewire.admin.dashboard');
    }
}
