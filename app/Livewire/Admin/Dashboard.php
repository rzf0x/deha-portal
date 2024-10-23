<?php

namespace App\Livewire\Admin;

use App\Models\admin\Semester;
use App\Models\Jenjang;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\WaliKamar;
use App\Models\WaliKelas;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;
use Livewire\attributes\Title;
use Detection\MobileDetect;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    // Integer
    public $waliKamar, $totalSemester, $kelasSantriTotalPutra, $kelasSantriTotalPutri, $santri, $totalJenjang, $totalKelas, $totalKamar, $waliKelas, $totalSantri, $kelas;

    // Bool
    public $isMobile = false;

    #[Title('Dashboard Superadmin Page')]

    public function mount(MobileDetect $mobileDetect)
    {
        $this->santri = Santri::with(['kelas', 'kamar', 'angkatan'])->take(7)->get();
        $this->totalKelas = count(Kelas::all());
        $this->totalKamar = count(Kamar::all());
        $this->totalJenjang = count(Jenjang::all());
        $this->totalSantri = count(Santri::all());
        $this->totalSemester = count(Semester::all());
        $this->kelas = Kelas::pluck('nama')->all();
        $this->waliKelas = count(WaliKelas::all());
        $this->waliKamar = count(WaliKamar::all());

        $this->kelasSantriTotalPutra = Kelas::withCount(['santri' => function ($query) {
            $query->where('jenis_kelamin', 'putera');
        }])->get()->pluck('santri_count')->all();

        $this->kelasSantriTotalPutri = Kelas::withCount(['santri' => function ($query) {
            $query->where('jenis_kelamin', 'puteri');
        }])->get()->pluck('santri_count')->all();

        $this->isMobile = $mobileDetect->isMobile();
    }

    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.admin.dashboard')->with(['santri' => $this->santri])->layout('components.layouts.app-mobile');
        return view('livewire.admin.dashboard')->with(['santri' => $this->santri]);
    }
}
