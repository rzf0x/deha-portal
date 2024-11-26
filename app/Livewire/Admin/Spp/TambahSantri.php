<?php
namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\Pembayaran;
use App\Models\Spp\PembayaranTimeline;
use App\Models\Spp\TipePembayaran;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class TambahSantri extends Component
{
    use WithPagination;
    
    #[Title('Manajemen SPP Santri')]

    protected $paginationTheme = 'bootstrap';

    // Search Properties
    public $search = '';
    public $searchSantri = '';

    // Form Properties
    public $isCreating = true;
    public $selectedSantri = null;

    public $isDropdownVisible = false;

    #[Validate('required')]
    public $santri_id = '';

    public function cariListSantri()
    {
        return Santri::with(['pembayaran', 'kelas', 'kamar'])
        ->has('pembayaran')
        ->where('nama', 'like', '%' . $this->search . '%')
        ->orderBy('nama')
        ->paginate(10);
    }
    
    public function showDropdown()
    {
        $this->isDropdownVisible = true; // Menampilkan dropdown
    }

    public function hideDropdown()
    {
        $this->isDropdownVisible = false; // Menyembunyikan dropdown
    }

    // Computed Properties
    #[Computed()]
    public function getFilteredSantrisProperty()
    {
        return Santri::where('nama', 'like', '%' . $this->searchSantri . '%')
        ->with(['kelas', 'kamar'])
        ->orderBy('nama')
        ->take(10)
        ->get();
    }

    // Actions
    public function selectSantri($id, $nama)
    {
        $this->santri_id = $id;
        $this->searchSantri = $nama;
        $this->selectedSantri = Santri::with(['kelas', 'kamar'])->find($id);
    }

    public function createStore()
    {
        $this->validate();

        $existingPembayaran = Pembayaran::where('santri_id', $this->santri_id)->exists();

        if ($existingPembayaran) {
            session()->flash('error', 'Santri sudah ada di pembayaran');
            $this->dispatch('close-modal');
            return;
        }

        try {
            $timelines = PembayaranTimeline::all();
            foreach ($timelines as $timeline) {
                Pembayaran::create([
                    'santri_id' => $this->santri_id,
                    'pembayaran_timeline_id' => $timeline->id,
                    'pembayaran_tipe_id' => 1, // Menggunakan ID tipe yang dipilih
                    'nominal' => 0, // Pastikan nominal sudah diisi dengan benar
                    'metode_pembayaran' => 'cash', // Pastikan metode pembayaran sudah diisi dengan benar
                    'status' => 'belum bayar'
                ]);
            };

            $this->resetForm(); // Reset form setelah sukses
            session()->flash('message', 'Pembayaran berhasil ditambahkan!');
            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan pembayaran: ' . $e->getMessage());
        }
    }


    public function delete($santriId)
    {
        try {
            Pembayaran::where('santri_id', $santriId)->delete();
            session()->flash('message', 'Pembayaran berhasil dihapus!');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus pembayaran!');
        }
    }

    public function render()
    {
        return view('livewire.admin.spp.tambah-santri', [
            'santris' => Santri::with(['pembayaran', 'kelas', 'kamar'])
                ->has('pembayaran')
                ->where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama')
                ->paginate(10),
            'timelineList' => PembayaranTimeline::all(),
            'tipeList' => TipePembayaran::all(),
            'filteredSantris' => $this->filteredSantris
        ]);
    }
    public function resetForm()
    {
        $this->reset();
    }
}