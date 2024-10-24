<?php

namespace App\Livewire\Admin\Spp;

use App\Livewire\Forms\ItemPembayaranForm;
use App\Models\Jenjang;
use App\Models\Spp\DetailItemPembayaran;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class ListItemPembayaran extends Component
{
    
    #[Title('Halaman Item Pembayaran')]
    
    public ItemPembayaranForm $ItemPembayaranForm;
    
    public $itemPembayaranId;

    #[Computed]
    public function getAllJenjang()
    {
        return Jenjang::all();
    }

    #[Computed]
    public function getData()
    {
        return DetailItemPembayaran::with(['jenjang'])->get();
    }

    public function edit($id)
    {
        $itemPembayaran = DetailItemPembayaran::findOrFail($id);
        $this->itemPembayaranId = $id;
        $this->ItemPembayaranForm->nama = $itemPembayaran->nama;
        $this->ItemPembayaranForm->nominal = $itemPembayaran->nominal;
        $this->ItemPembayaranForm->jenjang_id = $itemPembayaran->jenjang_id;
    }

    public function create()
    {
        $this->ItemPembayaranForm->reset();
        $this->itemPembayaranId = '';
    }

    public function store()
    {
        $this->ItemPembayaranForm->validate();

        DetailItemPembayaran::updateOrCreate(['id' => $this->itemPembayaranId], $this->ItemPembayaranForm->all());

        return session()->flash('message', "Success created " . $this->ItemPembayaranForm->nama . " !");
    }

    public function delete($id)
    {
        DetailItemPembayaran::findOrFail($id)->delete();
        return session()->flash('message', "Data has been deleted!");
    }
    

    public function render()
    {
        return view('livewire.admin.spp.list-item-pembayaran');
    }
}
