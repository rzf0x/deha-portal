<?php

namespace App\Livewire\Admin\AdminLaundry;

use App\Livewire\Forms\LaundryOrderForm;
use App\Models\Cashless\LaundryOrder;
use App\Models\Cashless\LaundryService;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

class ListLaundry extends Component
{
    #[Title("List Laundry")]
    public LaundryOrderForm $laundryForm;
    public $laundryServices, $laundrySubtotal, $laundryEstimate;

    public function mount()
    {
        $this->laundryServices = LaundryService::all();
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
        $this->laundryForm->reset();
    }

    public function save()
    {
        
        $this->calculateSubtotal();
        $this->calculateEstimate();
        try {
            $orderNumber = 'LDY-' . date('YmdHis');

            $endDate = Carbon::now()->addDays($this->laundryEstimate)->format('Y-m-d');

            LaundryOrder::create([
                'order_number' => $orderNumber,
                'nama_santri' => $this->laundryForm->nama_santri,
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

    public function edit()
    {
        $this->laundryForm->reset();
    }

    public function render()
    {
        return view('livewire.admin.admin-laundry.list-laundry');
    }
}
