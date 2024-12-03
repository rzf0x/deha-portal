<?php

namespace App\Livewire\Admin;

use App\Exports\Admin\KamarExport;
use App\Imports\Admin\KamarImport;
use App\Models\Kamar as ModelsKamar;
use App\Models\WaliKamar;
use Detection\MobileDetect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Kamar extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // string
    public $kamar_id, $nama, $kamar_tipe, $wali_kamar;

    // File
    public $file;

    // Bool
    public $isMobile = false;

    // Title
    #[Title('Halaman Kamar')]

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    public function create()
    {
        $this->kamar_id = '';
        $this->nama = '';
        $this->kamar_tipe = '';
        $this->wali_kamar = '';
    }

    public function store()
    {
        // $this->validated()

        ModelsKamar::updateOrCreate(
            ['id' => $this->kamar_id],
            [
                'nama' => $this->nama,
                'kamar_tipe' => $this->kamar_tipe,
                'wali_kamar' => $this->wali_kamar
            ]
        );

        $this->reset(['kamar_id', 'nama', 'kamar_tipe', 'wali_kamar']);
    }

    public function edit($id)
    {
        $kamar = ModelsKamar::find($id);
        $this->kamar_id = $kamar->id;
        $this->nama = $kamar->nama;
        $this->kamar_tipe = $kamar->kamar_tipe;
        $this->wali_kamar = $kamar->wali_kamar;

        // dd($this);
    }

    public function delete($id)
    {
        $kamar = ModelsKamar::findOrFail($id);
        $kamar->delete();

        session()->flash('message', 'Data kamar berhasil di hapus.');

        $this->reset(['kamar_id', 'nama', 'kamar_tipe', 'wali_kamar']);
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new KamarImport, $this->file);

        session()->flash('message', 'Data wali kamar berhasil diimpor.');
        $this->reset('file');
    }

    public function export()
    {
        return Excel::download(new KamarExport, 'list kamar Daarul Huffazh.xlsx');
    }

    public function mount(MobileDetect $mobileDetect)
    {
        $this->isMobile = $mobileDetect->isMobile();
    }

    #[Computed]
    public function listKamar()
    {
        return ModelsKamar::paginate($this->perPage);
    }

    #[Computed]
    public function listWaliKamar()
    {
        return WaliKamar::all();
    }

    public function render()
    {
        if($this->isMobile) return view('livewire.mobile.admin.kamar')->layout('components.layouts.app-mobile');
        return view('livewire.admin.kamar');
    }
}
