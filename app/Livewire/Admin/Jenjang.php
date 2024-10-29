<?php

namespace App\Livewire\Admin;

use App\Models\Jenjang as ModelsJenjang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Detection\MobileDetect;
use Livewire\Attributes\Url;

class Jenjang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Title('Jenjang Page')]

    #[Rule('required|string')]
    public $namajenjang = '';

    public $jenjangId;
    public $namaJenjangEdit;

    public $jenjangs, $nama, $jenjang_id;
    public $isModalOpen = 0;

    public $isMobile = false;

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    public function mount(MobileDetect $mobileDetect)
    {
        $this->isMobile = $mobileDetect->isMobile();
    }

    #[Computed()]
    public function listJenjang()
    {
        return ModelsJenjang::paginate($this->perPage);
    }

    public function render()
    {
        if($this->isMobile) return view('livewire.mobile.admin.jenjang')->layout('components.layouts.app-mobile');
        return view('livewire.admin.jenjang');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->jenjang_id = '';
    }

    private function resetCreateForm(){
        $this->nama = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
        ]);

        ModelsJenjang::updateOrCreate(['id' => $this->jenjang_id], [
            'nama' => $this->nama,
        ]);

        session()->flash('message', $this->jenjang_id ? 'Data jenjang berhasil di update' : 'Data jenjang berhasil di tambahkan');

        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $jenjang = ModelsJenjang::findOrFail($id);
        $this->jenjang_id = $id;
        $this->nama = $jenjang->nama;

    }

    public function delete($id)
    {
        ModelsJenjang::find($id)->delete();
        session()->flash('message', 'Data jenjang berhasil di hapus');
    }
}
