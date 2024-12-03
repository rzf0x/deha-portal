<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Spp\Pembayaran;
use App\Models\Spp\PembayaranTimeline;
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


    #[Validate('required')]
    public $santri_id = '';

    public $searchTambahResults = [];

    public $filterTambah = [
        'jenjang' => '',
        'kelas' => '',
    ];
    public $filterList = [
        'jenjang' => '',
        'kelas' => '',
    ];

    public $jenjangs = [], $kelases = [];

    protected $listeners = ['prepareModal' => 'resetForm'];

    public function mount()
    {
        $this->jenjangs = Jenjang::all();
        $this->kelases = Kelas::all();
    }

    public function cariSantri()
    {
        $this->resetPage();
    }
    // Computed Properties
    public function filterTambahSantris()
    {
        if (empty($this->filterTambah['kelas']) && empty($this->filterTambah['jenjang']) && empty($this->searchSantri)) {
            $this->addError('messageError', 'Kolom pencarian tidak boleh kosong');
            $this->searchTambahResults = [];
            return;
        }
        $this->reset('selectedSantri','santri_id');

        $this->searchTambahResults = Santri::with('kelas', 'kelas.jenjang')
            ->when(!empty($this->filterTambah['jenjang']), function ($query) {
                return $query->whereHas('kelas.jenjang', function ($subQuery) {
                    $subQuery->where('nama', $this->filterTambah['jenjang']);
                });
            })
            ->when(!empty($this->filterTambah['kelas']), function ($query) {
                return $query->whereHas('kelas', function ($subQuery) {
                    $subQuery->where('nama', $this->filterTambah['kelas']);
                });
            })
            ->when(!empty($this->searchSantri), function ($query) {
                return $query->where('nama', 'like', '%' . $this->searchSantri . '%');
            })
            ->orderBy('nama')
            ->take(45)->get();

        if ($this->searchTambahResults->isEmpty()) {
            $this->addError('messageError', 'Santri tidak ditemukan');
        } else {
            $this->addError('messageError', '');
        }
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
            $this->addError('messageError', 'Santri sudah ada di pembayaran');
            return;
        }

        try {
            $timelines = PembayaranTimeline::all();
            foreach ($timelines as $timeline) {
                Pembayaran::create([
                    'santri_id' => $this->santri_id,
                    'pembayaran_timeline_id' => $timeline->id,
                    'pembayaran_tipe_id' => 1,
                    'nominal' => 0,
                    'metode_pembayaran' => 'cash',
                    'status' => 'belum bayar'
                ]);
            };

            $this->resetForm(); // Reset form setelah sukses
            session()->flash('message', 'Pembayaran berhasil ditambahkan!');
            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            $this->addError('messageError', 'Terjadi kesalahan saat menyimpan pembayaran: ' . $e->getMessage());
        }
    }


    public function delete($santriId)
    {
        try {
            Pembayaran::where('santri_id', $santriId)->delete();
            session()->flash('message', 'Pembayaran berhasil dihapus!');
        } catch (\Exception $e) {
            $this->addError('messageError', 'Terjadi kesalahan saat menghapus pembayaran!');
        }
    }

    public function render()
    {
        return view('livewire.admin.spp.tambah-santri', [
            'santris' => Santri::with(['kelas', 'kamar'])
                ->has('pembayaran')
                ->when(!empty($this->filterList['jenjang']), function ($query) {
                    return $query->whereHas('kelas.jenjang', function ($subQuery) {
                        $subQuery->where('nama', $this->filterList['jenjang']);
                    });
                })
                ->when(!empty($this->filterList['kelas']), function ($query) {
                    return $query->whereHas('kelas', function ($subQuery) {
                        $subQuery->where('nama', $this->filterList['kelas']);
                    });
                })
                ->where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama')
                ->paginate(10),
        ]);
    }

    public function resetForm()
    {
        $this->reset(
            'searchSantri',
            'isCreating',
            'selectedSantri',
            'santri_id',
            'searchTambahResults',
            'filterList',
            'filterTambah',
        );
    }
}
