<?php

namespace App\Livewire\Admin;

use App\Exports\admin\WalikamarExport;
use App\Models\WaliKamar as ModelsWaliKamar;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WaliKamarImport;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Detection\MobileDetect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

class WaliKamar extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // String
    public $file;
    // String
    public $walikamar_id, $nama, $alamat, $role, $foto, $no_whatsapp, $existingFoto;
    //object
    public $waliKamar = [];

    // Bool
    public $isMobile = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'role' => 'required|in:ikhwan,akhwat',
        'foto' => 'nullable|image|max:1024', // 1MB Max
        'no_whatsapp' => 'required|string|max:15',
    ];

    #[Title('Halaman Wali Kamar')]

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new WaliKamarImport, $this->file);

        session()->flash('message', 'Data wali kamar berhasil diimpor.');
        $this->reset('file');
    }

    public function store()
    {
        $this->validate();

        if ($this->foto) {
            if ($this->existingFoto) {
                Storage::disk('public')->delete($this->existingFoto);
            }
            $imagePath = $this->foto->store('admin/foto-wali-kamar/', 'public');
        } else {
            $imagePath = $this->existingFoto;
        }

        ModelsWaliKamar::updateOrCreate(
            ['id' => $this->walikamar_id],
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'role' => $this->role,
                'foto' => $imagePath,
                'no_whatsapp' => $this->no_whatsapp,
            ]
        );

        // Reset form fields after saving
        $this->reset(['nama', 'alamat', 'role', 'foto', 'no_whatsapp', 'existingFoto']);

        session()->flash('message', 'Wali Kamar created successfully.');
    }

    public function mount(MobileDetect $mobileDetect)
    {
        $this->isMobile = $mobileDetect->isMobile();
        $this->waliKamar = ModelsWaliKamar::all();
    }

    public function create()
    {
        $this->walikamar_id = '';
        $this->nama = '';
        $this->alamat = '';
        $this->role = '';
        $this->existingFoto = '';
        $this->no_whatsapp = '';
    }

    public function edit($id)
    {
        $waliKamar = ModelsWaliKamar::find($id);
        $this->walikamar_id = $waliKamar->id;
        $this->nama = $waliKamar->nama;
        $this->alamat = $waliKamar->alamat;
        $this->role = $waliKamar->role;
        $this->existingFoto = $waliKamar->foto;
        $this->no_whatsapp = $waliKamar->no_whatsapp;
    }

    public function delete($id)
    {
        $waliKamar = ModelsWaliKamar::findOrFail($id);

        // Delete the associated image from storage
        if ($waliKamar->foto) {
            Storage::disk('public')->delete($waliKamar->foto);
        }

        $waliKamar->delete();

        session()->flash('message', 'Wali Kamar deleted successfully.');

        // Optionally, you can reset fields or perform other actions here
        $this->reset(['walikamar_id', 'nama', 'alamat', 'role', 'foto', 'no_whatsapp', 'existingFoto']);
    }

    public function export()
    {
        return Excel::download(new WalikamarExport, 'wali_kamars.xlsx');
    }

    #[Computed()]
    public function listWaliKamar()
    {
        return ModelsWaliKamar::paginate($this->perPage);
    }

    public function render()
    {
        if($this->isMobile) return view('livewire.mobile.admin.wali-kamar')->layout('components.layouts.app-mobile');
        return view('livewire.admin.wali-kamar');
    }
}
