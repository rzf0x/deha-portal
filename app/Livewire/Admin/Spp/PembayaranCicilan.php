<?php
namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\Pembayaran;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PembayaranCicilan extends Component
{
    use WithPagination;

    #[Title('Halaman List Cicilan')]

    protected $paginationTheme = 'bootstrap';

    // Search Property
    public $search = '';

    public function render()
    {
        return view('livewire.admin.spp.pembayaran-cicilan', [
            'santris' => Santri::with(['pembayaran.cicilans', 'kelas', 'kamar'])
                ->whereHas('pembayaran.cicilans') // Only include santri with payments
                ->where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama')
                ->paginate(10),
        ]);
    }
}
