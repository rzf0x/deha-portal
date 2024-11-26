<?php

namespace App\Livewire\Admin\Spp;

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

    public function searchSantri()
    {
        return Santri::with(['pembayaran', 'pembayaran.cicilans', 'kelas', 'kamar'])
            ->whereHas('pembayaran.cicilans') // Only include santri with payments
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orderBy('nama')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.spp.pembayaran-cicilan');
    }
}
