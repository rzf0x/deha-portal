<?php

namespace App\Livewire\Admin;

use App\Models\admin\Angkatan as AdminAngkatan;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Angkatan extends Component
{
    use WithPagination;

    public $angkatan_id, $nama;

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    #[Title('Halaman Angkatan')]

    public function create()
    {
        $this->angkatan_id = '';
        $this->nama = '';
    }

    public function edit($id)
    {
        $data = AdminAngkatan::find($id);
        $this->angkatan_id = $data->id;
        $this->nama = $data->nama;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
        ]);

        AdminAngkatan::updateOrCreate(['id' => $this->angkatan_id], [
            'nama' => $this->nama,
        ]);

        session()->flash('message', $this->angkatan_id ? 'Data jenjang berhasil di update' : 'Data jenjang berhasil di tambahkan');
        $this->create();
    }

    public function delete($id)
    {
        AdminAngkatan::find($id)->delete();
        session()->flash('message', 'Data jenjang berhasil di hapus');
    }

    public function render()
    {
        return view('livewire.admin.angkatan', [
            'listAngkatan' => AdminAngkatan::paginate($this->perPage),
        ]);
    }

    // Tampilkan semua santri berdasarkan angkatan
}
