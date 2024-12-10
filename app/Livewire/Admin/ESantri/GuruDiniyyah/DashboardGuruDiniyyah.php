<?php

namespace App\Livewire\Admin\ESantri\GuruDiniyyah;

use App\Models\KategoriPelajaran;
use App\Models\Pengumuman;
use App\Models\JadwalPelajaran;
use App\Models\JadwalPiket;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardGuruDiniyyah extends Component
{
    #[Title('Dashboard Guru Diniyyah')]

    public $totalGuruDiniyyah = 0;
    public $totalMataPelajaran = 0;
    public $totalKategoriPelajaran = 0;
    public $totalPengumuman = 0;
    public $jadwalPiket = [];
    public $jadwalPelajaran = [];

    public $labels, $series;

    public function mount()
    {
        // Hitung total statistik

        $this->totalKategoriPelajaran = KategoriPelajaran::count();
        $this->totalMataPelajaran = JadwalPelajaran::count();
        $this->totalPengumuman = Pengumuman::count();
        
        $this->labels = ['Mata Pelajaran', 'Kategori Pelajaran', 'Pengumuman'];
        $this->series = [$this->totalKategoriPelajaran, $this->totalMataPelajaran, $this->totalPengumuman];

        // Ambil jadwal piket
        $this->jadwalPiket = JadwalPiket::with(['santri', 'kelas'])
            ->take(10)
            ->get();

        // Ambil jadwal pelajaran
        $this->jadwalPelajaran = JadwalPelajaran::with(['kelas', 'kategoriPelajaran'])
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.e-santri.guru-diniyyah.dashboard-guru-diniyyah');
    }
}