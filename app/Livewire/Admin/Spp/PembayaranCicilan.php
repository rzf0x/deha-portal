<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Santri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PembayaranCicilan extends Component
{
    use WithPagination;

    #[Title('Halaman List Cicilan')]
    protected $paginationTheme = 'bootstrap';

    // public $santris;
    public $search = '';
    public $jenjangs = [];
    public $kelases = [];

    public $filter = [
        'jenjang' => '',
        'kelas' => '',
    ];

    public function mount()
    {
        $this->jenjangs = Jenjang::all();
        $this->kelases = Kelas::all();
    }

    #[Computed()]
    public function searchSantri()
    {
        $this->resetPage();

        return Santri::with(['kelas', 'kamar'])
        ->has('pembayaran.cicilans') // Only include santri with payments
        ->when(!empty($this->filter['jenjang']), function ($query) {
            return $query->whereHas('kelas.jenjang', function ($subQuery) {
                $subQuery->where('nama', $this->filter['jenjang']);
            });
        })
        ->when(!empty($this->filter['kelas']), function ($query) {
            return $query->whereHas('kelas', function ($subQuery) {
                $subQuery->where('nama', $this->filter['kelas']);
            });
        })
        ->where('nama', 'like', '%' . $this->search . '%')
        ->orderBy('nama')
        ->paginate(10);
    }
    
    public function render()
    {
        return view('livewire.admin.spp.pembayaran-cicilan', ['santriResults' => $this->searchSantri()]);
    }
}
