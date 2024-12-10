<?php
namespace App\Livewire\Admin\ESantri\GuruDiniyyah;

use App\Livewire\Forms\KategoriPelajaranForm;
use App\Models\KategoriPelajaran as ModelsKategoriPelajaran;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriPelajaran extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    #[Title('Halaman Kategori Pelajaran')]
    public KategoriPelajaranForm $kategoriPelajaranForm;
    
    public $kategoriPelajaranId;
    public $detailKategoriPelajaran;
    public $search = '';

    #[Computed()]
    public function listKategoriPelajaran()
    {
        return ModelsKategoriPelajaran::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->kategoriPelajaranId = null;
        $this->kategoriPelajaranForm->reset();
    }

    public function createKategoriPelajaran()
    {
        try {
            $this->kategoriPelajaranForm->validate();
            
            ModelsKategoriPelajaran::create($this->kategoriPelajaranForm->all());
            
            session()->flash('success', 'Kategori Pelajaran baru berhasil dibuat!');
            $this->dispatch('close-modal');
            $this->reset('search');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->kategoriPelajaranId = $id;
        $kategoriEdit = ModelsKategoriPelajaran::findOrFail($id);
        $this->kategoriPelajaranForm->fill($kategoriEdit);
    }

    public function updateKategoriPelajaran()
    {
        try {
            $this->kategoriPelajaranForm->validate();
            
            ModelsKategoriPelajaran::findOrFail($this->kategoriPelajaranId)
                ->update($this->kategoriPelajaranForm->all());
            
            session()->flash('success', 'Kategori Pelajaran berhasil diupdate!');
            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteKategoriPelajaran($id)
    {
        try {
            $kategori = ModelsKategoriPelajaran::findOrFail($id);
            
            // Cek apakah kategori sudah digunakan di jadwal pelajaran
            if ($kategori->jadwalPelajaran()->exists()) {
                session()->flash('error', 'Kategori tidak bisa dihapus karena sudah digunakan di jadwal pelajaran!');
                return;
            }
            
            $nama = $kategori->nama;
            $kategori->delete();
            
            session()->flash('success', "Berhasil hapus kategori pelajaran: $nama");
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function detailKategoriPelajaran($id)
    {
        $this->detailKategoriPelajaran = ModelsKategoriPelajaran::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.e-santri.guru-diniyyah.kategori-pelajaran', [
            'listKategoriPelajaran' => $this->listKategoriPelajaran(),
        ]);
    }
}