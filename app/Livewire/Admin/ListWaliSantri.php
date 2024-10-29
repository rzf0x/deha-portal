<?php

namespace App\Livewire\Admin;

use App\Models\admin\Angkatan;
use App\Models\admin\Semester;
use App\Models\Jenjang;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\OrangTuaSantri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListWaliSantri extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Title('Halaman List Wali Santri')]

    #[Url(except: "")]
    public $perPage = 5;

    #[Url(except: '', as: 'q-wali')]
    public $search;

    public $kelasFilter, $jenjangFilter, $kamarFilter, $jenisKelaminFilter;
    public $kelas, $jenjang, $kamar, $semester, $angkatan;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    public function mount()
    {
        $this->kelas = Kelas::with('jenjang')->get();
        $this->kamar = Kamar::with('waliKamar')->get();
        $this->semester = Semester::all();
        $this->angkatan = Angkatan::all();
        $this->jenjang = Jenjang::all();
    }

    #[Computed]
    public function getData()
    {
        if ($this->search || $this->kelasFilter || $this->jenjangFilter || $this->kamarFilter || $this->jenisKelaminFilter) {
            return OrangTuaSantri::with('santri')
                ->where(function ($query) {
                    $query->whereRaw('nama_ayah LIKE ? OR nama_ibu LIKE ?', [
                        "%{$this->search}%",
                        "%{$this->search}%",
                    ])
                        ->orWhereHas('santri', function ($query) {
                            $query->whereRaw('nama LIKE ? OR CASE 
                        WHEN jenis_kelamin = "putera" THEN "laki-laki"
                        WHEN jenis_kelamin = "puteri" THEN "perempuan"
                        END LIKE ?', ["%{$this->search}%", "%{$this->search}%"])
                                ->orWhere('jenis_kelamin', 'LIKE', "%{$this->search}%");
                        })
                        ->orWhereHas('santri.kelas', function ($query) {
                            $query->where('nama', 'LIKE', "%{$this->search}%");
                        })
                        ->orWhereHas('santri.kelas.jenjang', function ($query) {
                            $query->where('nama', 'LIKE', "%{$this->search}%");
                        })
                        ->orWhereHas('santri.kamar', function ($query) {
                            $query->where('nama', 'LIKE', "%{$this->search}%");
                        });
                })
                ->when($this->kelasFilter, function ($query) {
                    $query->whereHas('santri.kelas', function ($query) {
                        $query->where('nama', 'LIKE', "%{$this->kelasFilter}%");
                    });
                })
                ->when($this->jenjangFilter, function ($query) {
                    $query->whereHas('santri.kelas.jenjang', function ($query) {
                        $query->where('nama', 'LIKE', "%{$this->jenjangFilter}%");
                    });
                })
                ->when($this->kamarFilter, function ($query) {
                    $query->whereHas('santri.kamar', function ($query) {
                        $query->where('nama', 'LIKE', "%{$this->kamarFilter}%");
                    });
                })
                ->when($this->jenisKelaminFilter, function ($query) {
                    $query->whereHas('santri', function ($query) {
                        $query->where('jenis_kelamin', $this->jenisKelaminFilter);
                    });
                })
                ->paginate($this->perPage);
        }

        return OrangTuaSantri::with('santri')->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.list-wali-santri');
    }
}
