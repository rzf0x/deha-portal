<?php

namespace App\Livewire\Admin\ESantri\GuruDiniyyah;

use App\Models\Pengumuman;
use App\Models\ESantri\KategoriPelajaran;
use App\Models\ESantri\JadwalPelajaran;
use App\Models\ESantri\JadwalPiket;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
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
    public $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    public $kelasList;

    public $labels, $series;

    public function mount()
    {
        $this->totalKategoriPelajaran = KategoriPelajaran::where('role_guru', 'diniyyah')->count();
        $this->totalMataPelajaran = JadwalPelajaran::where('role_guru', 'diniyyah')->count();
        $this->totalPengumuman = Pengumuman::count();

        $this->labels = ['Mata Pelajaran', 'Kategori Pelajaran', 'Pengumuman'];
        $this->series = [$this->totalKategoriPelajaran, $this->totalMataPelajaran, $this->totalPengumuman];

        $this->jadwalPiket = JadwalPiket::where('role_guru', 'diniyyah')->with(['santri', 'kelas'])
            ->take(10)
            ->get();

        $this->jadwalPelajaran = JadwalPelajaran::where('role_guru', 'diniyyah')->with(['kelas', 'kategoriPelajaran'])
            ->take(10)
            ->get();

        $this->kelasList = Kelas::all();
    }

    public function render()
    {
        return view('livewire.admin.e-santri.guru-diniyyah.dashboard-guru-diniyyah');
    }
}
