<?php

namespace App\Livewire\Admin;

use App\Models\Jenjang;
use App\Models\Kelas as ModelsKelas;
use App\Models\WaliKelas;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Kelas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Title('Halaman List Kelas')]

    // Array
    public $waliKelas, $jenjang;

    // Integer
    public $waliKelasId, $jenjangId, $kelasId;

    // String
    public $namaKelas;

    #[Computed]
    public function getData()
    {
        return ModelsKelas::with('jenjang', 'walikelas')->paginate(5);
    }

    public function create()
    {
        $this->resetFields();
    }

    public function edit($id)
    {
        $kelas = ModelsKelas::find($id);
        $this->kelasId = $id;
        $this->namaKelas = $kelas->nama;
        $this->waliKelasId = $kelas->wali_kelas;
        $this->jenjangId = $kelas->jenjang_id;
    }

    public function store()
    {
        ModelsKelas::updateOrCreate(['id' => $this->kelasId], [
            'nama' => $this->namaKelas,
            'jenjang_id' => $this->jenjangId,
            'wali_kelas' => $this->waliKelasId,
        ]);

        session()->flash('message', $this->kelasId ? 'Data jenjang berhasil di update' : 'Data jenjang berhasil di tambahkan');

        $this->resetFields();
    }

    private function resetFields()
    {
        $this->waliKelasId = '';
        $this->jenjangId = '';
        $this->kelasId = '';
    }

    public function boot()
    {
        $this->waliKelas = WaliKelas::all();
        $this->jenjang = Jenjang::all();
    }

    public function render()
    {
        return view('livewire.admin.kelas');
    }
}
