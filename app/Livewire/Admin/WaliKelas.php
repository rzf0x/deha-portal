<?php

namespace App\Livewire\Admin;

use App\Models\WaliKelas as ModelsWaliKelas;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class WaliKelas extends Component
{
    use WithPagination;
    use WithFileUploads;

    // bool
    public $isEdit = false;

    // Integer
    public $waliKelasId, $nama, $alamat, $foto, $no_whatsapp, $existingFoto;

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    #[Title('Halaman Wali Kelas ')]

    #[Computed]
    public function getData()
    {
        return ModelsWaliKelas::paginate($this->perPage);
    }

    public function create()
    {
        $this->waliKelasId = '';
        $this->nama = '';
        $this->alamat = '';
        $this->no_whatsapp = '';
    }

    public function edit($id)
    {
        $waliKamar = ModelsWaliKelas::find($id);
        $this->waliKelasId = $waliKamar->id;
        $this->nama = $waliKamar->nama;
        $this->alamat = $waliKamar->alamat;
        $this->existingFoto = $waliKamar->foto;
        $this->no_whatsapp = $waliKamar->no_whatsapp;
    }

    public function store()
    {
        // $this->validate();

        if ($this->foto) {
            if ($this->existingFoto) {
                Storage::disk('public')->delete($this->existingFoto);
            }
            $imagePath = $this->foto->store('admin/foto-wali-kelas/', 'public');
        } else {
            $imagePath = $this->existingFoto;
        }

        ModelsWaliKelas::updateOrCreate(
            ['id' => $this->waliKelasId],
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'foto' => $imagePath,
                'no_whatsapp' => $this->no_whatsapp,
            ]
        );

        // Reset form fields after saving
        $this->reset(['nama', 'alamat', 'foto', 'no_whatsapp']);

        session()->flash('message', 'Wali Kamar created successfully.');
    }

    public function delete($id)
    {
        $waliKelas = ModelsWaliKelas::findOrFail($id);

        // Delete the associated image from storage
        if ($waliKelas->foto) {
            Storage::disk('public')->delete($waliKelas->foto);
        }

        $waliKelas->delete();

        session()->flash('message', 'Wali kelas deleted successfully.');

        // Optionally, you can reset fields or perform other actions here
        $this->reset(['waliKelasId', 'nama', 'alamat','foto', 'no_whatsapp', 'existingFoto']);
    }

    public function render()
    {
        return view('livewire.admin.wali-kelas');
    }
}
