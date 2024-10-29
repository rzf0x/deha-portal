<?php

namespace App\Livewire\Admin;

use App\Models\admin\Semester;
use App\Models\Jenjang;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\WaliKamar;
use App\Models\WaliKelas;
use Livewire\Component;
use Livewire\attributes\Title;
use Detection\MobileDetect;

class Dashboard extends Component
{
    public $waliKamar, $totalSemester, $kelasSantriTotalPutra, $kelasSantriTotalPutri, $santri, $totalJenjang, $totalKelas, $totalKamar, $waliKelas, $totalSantri, $kelas;

    // Bool
    public $isMobile = false;

    #[Title('Dashboard Superadmin Page')]

    public function mount(MobileDetect $mobileDetect)
    {
        $this->santri = Santri::with(['kelas', 'kamar', 'angkatan'])->take(7)->get();
        $this->totalKelas = Kelas::count();
        $this->totalKamar = Kamar::count();
        $this->totalJenjang = Jenjang::count();
        $this->totalSantri = Santri::count();
        $this->totalSemester = Semester::count();
        $this->kelas = Kelas::pluck('nama')->all();
        $this->waliKelas = WaliKelas::count();
        $this->waliKamar = WaliKamar::count();

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
