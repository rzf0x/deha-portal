<?php

namespace App\Livewire\Admin\AdminLaundry;

use App\Livewire\Forms\LaundryOrderForm;
use App\Models\Cashless\LaundryOrder;
use App\Models\Cashless\LaundryService;
use App\Models\Santri;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ListLaundry extends Component
{
    use WithPagination;
    #[Title("List Laundry")]

    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    public LaundryOrderForm $laundryForm;
    public $laundryServices, $laundrySubtotal, $laundryEstimate;
    public $santris, $laundryId, $detailLaundryUser;

    public function mount()
    {
        $this->laundryServices = LaundryService::all();
        $this->santris = Santri::all();
    }

    #[Computed]
    public function listLaundry()
    {
        return LaundryOrder::where('status', '!=', 'diterima')->with('santri', 'laundryService')->paginate($this->perPage);
    }

    public function calculateSubtotal()
    {
        $laundryServicePrice = LaundryService::findOrFail($this->laundryForm->laundry_service_id);
        $this->laundrySubtotal = $laundryServicePrice->price * $this->laundryForm->quantity;
    }

    public function calculateEstimate()
    {
        $laundryServiceEstimate = LaundryService::findOrFail($this->laundryForm->laundry_service_id)->estimate;
        $this->laundryEstimate = explode(' ', $laundryServiceEstimate)[0];
    }

    public function create()
    {
        $this->laundryId = null;
        $this->laundryForm->reset();
    }

    public function createLaundry()
    {
        $this->calculateSubtotal();
        $this->calculateEstimate();

        try {
            $orderNumber = 'LDY-' . date('YmdHis');

            $endDate = Carbon::now()->addDays($this->laundryEstimate)->format('Y-m-d');

            LaundryOrder::create([
                'order_number' => $orderNumber,
                'santri_id' => $this->laundryForm->santri_id,
                'laundry_service_id' => $this->laundryForm->laundry_service_id,
                'quantity' => $this->laundryForm->quantity,
                'subtotal' => $this->laundrySubtotal,
                'status' => $this->laundryForm->status,
                'end_date' => $endDate,
            ]);

            $this->reset(['laundryForm', 'laundrySubtotal', 'laundryEstimate']);

            session()->flash('success', 'Pesanan laundry berhasil dibuat!');

            return to_route('petugas-laundry.list-laundry');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->laundryId = $id;
        $laundryEdit = LaundryOrder::findOrFail($id);
        $this->laundryForm->fill($laundryEdit);
    }

    public function updateLaundry()
    {
        $this->calculateSubtotal();
        $this->calculateEstimate();

        try {
            LaundryOrder::findOrFail($this->laundryId)->update([
                'santri_id' => $this->laundryForm->santri_id,
                'laundry_service_id' => $this->laundryForm->laundry_service_id,
                'quantity' => $this->laundryForm->quantity,
                'subtotal' => $this->laundrySubtotal,
                'status' => $this->laundryForm->status,
            ]);

            $this->reset(['laundryForm', 'laundrySubtotal', 'laundryEstimate']);

            session()->flash('success', 'Pesanan berhasil diupdate!');

            return to_route('petugas-laundry.list-laundry');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

    public function render()
    {
        return view('livewire.admin.admin-laundry.list-laundry');
    }
}
