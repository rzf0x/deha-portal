<?php

namespace App\Livewire\Admin;

use App\Exports\SantriExport;
use App\Livewire\Forms\SantriForm;
use App\Livewire\Forms\WaliSantriForm;
use App\Models\admin\Semester;
use App\Models\admin\Angkatan;
use App\Models\Santri;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\OrangTuaSantri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListSantri extends Component
{
    use WithPagination;
    #[Title('Halaman List Santri')]
    protected $paginationTheme = 'bootstrap';

    public SantriForm $santriForm;
    public WaliSantriForm $waliSantriForm;

    public $npsn = '70005521';

    // data
    public $kelas, $kamar, $semester, $angkatan, $santri_id, $formCount = 1;

    // Bool
    public $isEdit = false;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        try {
            $this->santriForm->validate();
            $this->waliSantriForm->validate();
            // Santri::create($this->santriForm->all());
            // OrangTuaSantri::create($this->santriForm->all());
            dd($this->santriForm->all(), $this->waliSantriForm->all());
            return to_route('admin.master-santri.santri');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function delete($santriId)
    {
        Santri::findOrFail($santriId)->delete();
    }

    public function export()
    {
        return Excel::download(new SantriExport, 'santri.xlsx');
    }

    #[Computed]
    public function getData()
    {
        return Santri::with('kelas', 'kamar')->paginate(5);
    }

    private function resetField()
    {
        $this->nama = '';
        $this->nisn = '';
        $this->nism = '';
        $this->kewarganegaraan = '';
        $this->nik = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->jenis_kelamin = '';
        $this->jumlah_saudara_kandung = '';
        $this->anak_ke = '';
        $this->agama = '';
        $this->hobi = '';
        $this->aktivitas_pendidikan = '';
        $this->npsn = '';
        $this->no_kip = '';
        $this->no_kk = '';
        $this->nama_kepala_keluarga = '';
    }

    public function nextFormCount()
    {
        $this->formCount++;
        // dd($this->formCount);
    }

    public function prevFormCount()
    {
        $this->formCount--;
        // dd($this->formCount);
    }

    public function render()
    {
        $this->kelas = Kelas::with('jenjang')->get();
        $this->kamar = Kamar::with('waliKamar')->get();
        $this->semester = Semester::all();
        $this->angkatan = Angkatan::all();
        return view('livewire.admin.list-santri');
    }
}
