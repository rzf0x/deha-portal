<?php

namespace App\Livewire\Admin\ESantri\GuruDiniyyah;

use App\Livewire\Forms\PengumumanForm;
use App\Models\Pengumuman as ModelsPengumuman;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Pengumuman extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Title('Halaman Pengumuman')]

    public PengumumanForm $pengumumanForm;
    public $pengumumanId, $detailPengumumanSantri;
    
    #[Computed]
    public function listPengumuman()
    {
        return ModelsPengumuman::paginate(10);
    }

    public function create()
    {
        $this->pengumumanId = null;
        $this->pengumumanForm->reset();
    }

    public function createPengumuman()
    {
        try {
            $this->pengumumanForm->validate();

            ModelsPengumuman::create($this->pengumumanForm->all());

            session()->flash('success', 'Pengumuman baru berhasil dibuat!');

            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->pengumumanId = $id;
        $pengumumanEdit = ModelsPengumuman::findOrFail($id);
        $this->pengumumanForm->fill($pengumumanEdit);
    }

    public function updatePengumuman()
    {
        try {
            $this->pengumumanForm->validate();

            ModelsPengumuman::findOrFail($this->pengumumanId)->update($this->pengumumanForm->all());

            session()->flash('success', 'Pengumuman berhasil diupdate!');

            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deletePengumuman($id)
    {
        $pengumuman = ModelsPengumuman::findOrFail($id);
        session()->flash('success', 'Berhasil hapus ' . $pengumuman->judul);
        $pengumuman->delete();
    }

    public function detailPengumuman($id)
    {
        $this->detailPengumumanSantri = ModelsPengumuman::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.e-santri.guru-diniyyah.pengumuman', [
            'listPengumuman' => $this->listPengumuman(),
        ]);
    }
}