<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\KegiatanForm;
use App\Models\Kegiatan as ModelsKegiatan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Kegiatan extends Component
{
    use WithPagination;

    #[Title('Halaman Kegiatan')]
    public KegiatanForm $kegiatanForm;
    public $kegiatanId, $detailKegiatanSantri;

    #[Computed]
    public function listKegiatan()
    {
        return ModelsKegiatan::paginate(10);
    }

    public function create()
    {
        $this->kegiatanId = null;
        $this->kegiatanForm->reset();
    }

    public function createKegiatan()
    {
        try {
            $this->kegiatanForm->validate([
                'judul' => 'required',
                'isi_kegiatan' => 'required',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            ]);

            ModelsKegiatan::create($this->kegiatanForm->all());

            session()->flash('success', 'Kegiatan baru berhasil dibuat!');
            return redirect()->route('admin.master-aktifitas.kegiatan');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kegiatan = ModelsKegiatan::findOrFail($id);

        $this->kegiatanId = $kegiatan->id;
        
        $this->kegiatanForm->fill([
            'judul' => $kegiatan->judul,
            'isi_kegiatan' => $kegiatan->isi_kegiatan,
            'waktu_mulai' => \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('Y-m-d\TH:i'),
            'waktu_selesai' => \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('Y-m-d\TH:i'),
        ]);
    }

    public function updateKegiatan()
    {
        try {
            $this->kegiatanForm->validate([
                'judul' => 'required',
                'isi_kegiatan' => 'required',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            ]);

            ModelsKegiatan::findOrFail($this->kegiatanId)->update($this->kegiatanForm->all());

            session()->flash('success', 'Kegiatan berhasil diupdate!');
            return redirect()->route('admin.master-aktifitas.kegiatan');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteKegiatan($id)
    {
        $kegiatan = ModelsKegiatan::findOrFail($id);
        session()->flash('success', 'Kegiatan "' . $kegiatan->judul . '" berhasil dihapus!');
        $kegiatan->delete();
    }

    public function detailKegiatan($id)
    {
        $this->detailKegiatanSantri = ModelsKegiatan::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.admin.kegiatan');
    }
}
