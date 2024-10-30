<?php

namespace App\Livewire\Admin\Spp;

use App\Livewire\Forms\ItemPembayaranForm;
use App\Models\Jenjang;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\TipePembayaran;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class ListItemPembayaran extends Component
{
    #[Title('Halaman Item Pembayaran')]
    public ItemPembayaranForm $ItemPembayaranForm;

    public $itemPembayaranId;
    public $jenjangFilter = '';
    public $tipePembayaranFilter = '';
    public $tipePembayaranOptions = [];

    #[Computed]
    public function getAllJenjang()
    {
        return Jenjang::all();
    }

    #[Computed]
    public function getTipePembayaranOptions()
    {
        return TipePembayaran::pluck('nama', 'id')->toArray();
    }

    #[Computed]
    public function getFilteredData()
    {
        $query = DetailItemPembayaran::query()->with(['pembayaranTipe', 'jenjang']);

        if ($this->jenjangFilter) {
            $query->where('jenjang_id', $this->jenjangFilter);
        }

        if ($this->tipePembayaranFilter) {
            $query->where('pembayaran_tipe_id', $this->tipePembayaranFilter);
        }

        return $query->get();
    }

    public function edit($id)
    {
        $detail = DetailItemPembayaran::findOrFail($id);
        $this->itemPembayaranId = $id;
        $this->ItemPembayaranForm->nama = $detail->nama;
        $this->ItemPembayaranForm->nominal = $detail->nominal;
        $this->ItemPembayaranForm->jenjang_id = $detail->jenjang_id;
        $this->ItemPembayaranForm->pembayaran_tipe_id = $detail->pembayaran_tipe_id;
    }

    public function create()
    {
        $this->ItemPembayaranForm->reset();
        $this->itemPembayaranId = '';
    }

    public function store()
    {
        $this->ItemPembayaranForm->validate();

        DetailItemPembayaran::updateOrCreate(
            ['id' => $this->itemPembayaranId],
            $this->ItemPembayaranForm->all()
        );

        session()->flash('message', "Success created payment with ID {$this->itemPembayaranId}!");

        return to_route('spp.list-item-pembayaran');
        // Emit an event to close the modal
        $this->dispatch('closeModal');
    }


    public function delete($id)
    {
        DetailItemPembayaran::findOrFail($id)->delete();
        session()->flash('message', "Payment detail has been deleted!");
    }

    public function render()
    {
        $this->tipePembayaranOptions = $this->getTipePembayaranOptions();
        return view('livewire.admin.spp.list-item-pembayaran');
    }
}
