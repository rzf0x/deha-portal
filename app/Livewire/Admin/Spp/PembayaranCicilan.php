<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\TahunAjaran;
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
    public $jenjangOptions = [], $kelasOptions = [], $tahunOptions = [];

    public $filter = [
        'jenjang' => '',
        'kelas' => '',
        'tahun' => '',
    ];

    public function mount()
    {
        $this->filter['tahun'] = date('Y');

        $this->jenjangOptions = Jenjang::all();
        $this->kelasOptions = Kelas::all();
        $this->tahunOptions = TahunAjaran::all();
    }

    #[Computed()]
    public function searchSantri()
    {
        $this->resetPage();

        return Santri::with(['kelas', 'kamar'])
        ->has('pembayaran.cicilans')
        ->whereHas('pembayaran', function($query){
            $query->where('status', 'cicilan');
        })
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
        ->when(!empty($this->filter['tahun']), function ($query) {
            return $query->whereHas('pembayaran', function ($subQuery) {
                $subQuery->where('tahun_ajaran_id', $this->filter['tahun'])->where('status', 'cicilan');

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
