<?php

namespace App\Livewire\Admin;

use App\Exports\SantriExport;
use App\Models\Santri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListSantri extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Title('Halaman List Santri')]

    // String
    public $nama, $nisn, $nism, $kewarganegaraan, $nik, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $jumlah_saudara_kandung, $anak_ke, $agama, $hobi, $aktivitas_pendidikan, $no_kip, $no_kk, $nama_kepala_keluarga;

    public $npsn = '70005521';

    // integer
    public $kelas_id, $kamar_id, $santri_id;

    // Bool
    public $isEdit = false;

    public function create()
    {
        $this->resetField();
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

    public function render()
    {
        return view('livewire.admin.list-santri');
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
}
