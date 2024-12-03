<?php

namespace App\Livewire\Admin\AdminLaundry;

use App\Models\Cashless\LaundryOrder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatTransaksi extends Component
{
    use WithPagination;
    #[Title('Riwayat Pesanan')]

    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    public $detailLaundryUser;

    #[Computed]
    public function listLaundry()
    {
        return LaundryOrder::where('status', 'diterima')->with('santri', 'laundryService')->paginate($this->perPage);
    }

    public function getBadgeClass($status)
    {
        switch ($status) {
            case 'menunggu':
                return 'bg-warning';
            case 'dicuci':
                return 'bg-info';
            case 'gagal':
                return 'bg-danger';
            case 'disetrika':
                return 'bg-primary';
            case 'siap diambil':
                return 'bg-success';
            case 'diterima':
                return 'bg-secondary';
            default:
                return 'bg-light';
        }
    }

    public function detailLaundry($id)
    {
        $this->detailLaundryUser = LaundryOrder::findOrFail($id);
    }

    public function deleteLaundry($id)
    {
        $laundry = LaundryOrder::findOrFail($id);
        session()->flash('success', 'Berhasil hapus ' . $laundry->order_number);
        $laundry->delete();
    }

    public function render()
    {
        return view('livewire.admin.admin-laundry.riwayat-transaksi');
    }
}
