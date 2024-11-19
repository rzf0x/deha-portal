<?php

namespace App\Livewire\Admin\AdminLaundry;
use App\Livewire\Forms\LaundryServiceForm;
use App\Models\Cashless\LaundryService as CashlessLaundryService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class LaundryService extends Component
{
    use WithPagination;
    #[Title('Laundry Services')]

    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    
    public $services, $serviceId;

    public $detailService;
    public LaundryServiceForm $serviceForm;

    public function mount()
    {
        $this->listLaundryService();
    }
    
    #[Computed]
    public function listLaundryService()
    {
        return CashlessLaundryService::paginate($this->perPage);
    }

    public function detailLaundryService($id)
    {
        $this->detailService = CashlessLaundryService::findOrFail($id);
    }

    public function editService($id)
    {
        $this->serviceId = $id;
        $service = CashlessLaundryService::findOrFail($id);
        return $this->serviceForm->fill($service);
    }
    
    public function updateLaundryService()
    {
        try {
            $this->serviceForm->validate();
            $service = CashlessLaundryService::findOrFail($this->serviceId);
            $service->update($this->serviceForm->all());
            session()->flash('success', 'Berhasil update ' . $service->name);
            return to_route('petugas-laundry.laundry-service');
        } catch (\Throwable $th) {
            return session()->flash('error', 'Failed, ' . $th->getMessage());
        }
    }

    public function createService()
    {
        return $this->serviceForm->reset();
    }

    public function createLaundryService()
    {
        try {
            $this->serviceForm->validate();
            CashlessLaundryService::create($this->serviceForm->all());
            session()->flash('success', 'Berhasil membuat ' . $this->serviceForm->name);
            return to_route('petugas-laundry.laundry-service');
        } catch (\Throwable $th) {
            return session()->flash('error', 'Failed, ' . $th->getMessage());
        }
    }

    public function deleteService($id)
    {
        $service = CashlessLaundryService::findOrFail($id);
        session()->flash('success', 'Berhasil hapus ' . $service->name);
        $service->delete();
    }

    public function render()
    {
        return view('livewire.admin.admin-laundry.laundry-service');
    }
}
