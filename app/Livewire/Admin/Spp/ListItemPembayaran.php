<?php

namespace App\Livewire\Admin\Spp;

use App\Livewire\Forms\ItemPembayaranForm;
use App\Models\Jenjang;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\TipePembayaran;
use Livewire\Component;
use Livewire\Attributes\{Title, Computed};

class ListItemPembayaran extends Component
{
    #[Title('Item Pembayaran')]
    public ItemPembayaranForm $ItemPembayaranForm;

    public ?int $itemPembayaranId = null;
    public string $jenjangFilter = '';
    public string $tipePembayaranFilter = '';

    #[Computed]
    public function getFilteredData()
    {
        return DetailItemPembayaran::query()
            ->when($this->jenjangFilter, fn($q) => $q->where('jenjang_id', $this->jenjangFilter))
            ->when($this->tipePembayaranFilter, fn($q) => $q->where('pembayaran_tipe_id', $this->tipePembayaranFilter))
            ->with(['pembayaranTipe', 'jenjang'])
            ->get();
    }

    public function mount()
    {
        $this->ItemPembayaranForm->pembayaran_tipe_id = TipePembayaran::where('nama', 'SPP')->value('id');
    }

    public function edit(DetailItemPembayaran $detail)
    {
        $this->itemPembayaranId = $detail->id;
        $this->ItemPembayaranForm->fill($detail->toArray());
    }

    public function create()
    {
        $this->reset('itemPembayaranId');
        $this->ItemPembayaranForm->reset();
        $this->ItemPembayaranForm->pembayaran_tipe_id = TipePembayaran::where('nama', 'SPP')->value('id');
    }

    public function store()
    {
        $this->ItemPembayaranForm->validate();

        $detail = DetailItemPembayaran::updateOrCreate(
            ['id' => $this->itemPembayaranId],
            $this->ItemPembayaranForm->all()
        );

        $this->dispatch('modal');
        session()->flash('message', "Berhasil menambahkan pembayaran {$this->ItemPembayaranForm->nama}!");
    }

    public function delete(DetailItemPembayaran $detail)
    {
        $detail->delete();
        session()->flash('message', "Pembayaran berhasil dihapus!");
    }

    public function render()
    {
        return view('livewire.admin.spp.list-item-pembayaran', [
            'jenjangOptions' => Jenjang::all(),
            'tipePembayaranOptions' => TipePembayaran::pluck('nama', 'id')
        ]);
    }
}