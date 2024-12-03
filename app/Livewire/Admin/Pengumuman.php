<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\PengumumanForm;
use App\Models\Pengumuman as ModelsPengumuman;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Pengumuman extends Component
{
    use WithPagination;
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
            $this->pengumumanForm->validate([
                'judul' => 'required',
                'isi_pengumuman' => 'required',
                'tanggal' => 'required|date',
            ]);

            ModelsPengumuman::create($this->pengumumanForm->all());

            session()->flash('success', 'Pengumuman baru berhasil dibuat!');

            return to_route('admin.master-aktifitas.pengumuman');
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
            $this->pengumumanForm->validate([
                'judul' => 'required',
                'isi_pengumuman' => 'required',
                'tanggal' => 'required|date',
            ]);

            ModelsPengumuman::findOrFail($this->pengumumanId)->update($this->pengumumanForm->all());

            session()->flash('success', 'Pengumuman berhasil diupdate!');

            return to_route('admin.master-aktifitas.pengumuman');
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
        return view('livewire.admin.pengumuman');
    }
}
