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

#[Title('Manajemen SPP Santri')]
class TambahSantri extends Component
{
    use WithPagination;
    
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
    
    #[Validate('required')]
    public $pembayaran_tipe_id = '';
    
    #[Validate('required')]
    public $pembayaran_timeline_id = '';
    
    #[Validate('required')]
    public $nominal = '';
    
    #[Validate('required')]
    public $metode_pembayaran = '';
    
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
        
        try {
            Pembayaran::create([
                'pembayaran_tipe_id' => 1, // Sesuaikan dengan ID pembayaran_tipe yang ada
                'santri_id' => $this->santri_id,
                'pembayaran_timeline_id' => $this->pembayaran_timeline_id,
                'nominal' => $this->nominal,
                'metode_pembayaran' => $this->metode_pembayaran,
                'status' => 'belum bayar'
            ]);
            
            // $this->reset();
            
            session()->flash('message', 'Pembayaran berhasil ditambahkan!');
            $this->dispatch('close-modal');
            
        } catch (\Exception $e) {
            dd($e,$this);
            // session()->flash('error', $e . 'Terjadi kesalahan saat menyimpan pembayaran!');
        }
    }
    
    public function delete($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->delete();
            session()->flash('message', 'Pembayaran berhasil dihapus!');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus pembayaran!');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.spp.tambah-santri', [
            'santris' => Santri::where('nama', 'like', '%' . $this->search . '%')
                ->with(['kelas', 'kamar', 'pembayaran'])
                ->orderBy('created_at', 'desc')
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