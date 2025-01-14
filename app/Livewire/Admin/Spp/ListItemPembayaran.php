<?php

namespace App\Livewire\Admin\Spp;

use App\Livewire\Forms\ItemPembayaranForm;
use App\Models\Jenjang;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\TipePembayaran;
use App\Models\TahunAjaran;
use Livewire\Component;
use Livewire\Attributes\{Title, Computed};
use Livewire\WithPagination;

class ListItemPembayaran extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Title('Item Pembayaran')]
    public ItemPembayaranForm $ItemPembayaranForm;

    public ?int $itemPembayaranId = null;

    public $filter = [
        'jenjang' => '',
        'tipePembayaran' => '',
        'tahunAjaran' => '',
    ];

    public $jenjangOptions, $tipePembayaranOptions, $tahunAjaranOptions;

    public function mount()
    {
        $this->filter['tahunAjaran'] = date('Y');
        $this->jenjangOptions = Jenjang::all();
        $this->tipePembayaranOptions = TipePembayaran::pluck('nama', 'id');
        $this->tahunAjaranOptions = TahunAjaran::all();
    }

    #[Computed]
    public function getFilteredData()
    {
        $this->resetPage();

        return DetailItemPembayaran::with(['pembayaranTipe', 'jenjang'])
            ->when($this->filter['jenjang'], fn($q) => $q->where('jenjang_id', $this->filter['jenjang']))
            ->when($this->filter['tipePembayaran'], fn($q) => $q->where('pembayaran_tipe_id', $this->filter['tipePembayaran']))
            ->when($this->filter['tahunAjaran'], fn($q) => $q->where('tahun_ajaran_id', $this->filter['tahunAjaran']))
            ->paginate(10);
    }

    public function edit(DetailItemPembayaran $detail)
    {
        $this->itemPembayaranId = $detail->id;
        $this->ItemPembayaranForm->fill($detail->toArray());
        $this->dispatch('modal:show');
    }

    public function create()
    {
        $this->dispatch('modal:show');
        $this->reset('itemPembayaranId');
        $this->ItemPembayaranForm->reset();
        $this->ItemPembayaranForm->pembayaran_tipe_id = TipePembayaran::where('nama', 'SPP')->value('id');
        $this->ItemPembayaranForm->tahun_ajaran_id = TahunAjaran::where('nama_tahun', date('Y'))->value('nama_tahun');
    }

    public function store()
    {
        $this->ItemPembayaranForm->validate();

        $detail = DetailItemPembayaran::updateOrCreate(
            ['id' => $this->itemPembayaranId],
            $this->ItemPembayaranForm->all()
        );

        $this->dispatch('modal:hide');
        session()->flash('message', "Berhasil menambahkan pembayaran {$this->ItemPembayaranForm->nama}!");
    }

    public function delete(DetailItemPembayaran $detail)
    {
        $detail->delete();
        session()->flash('message', "Pembayaran berhasil dihapus!");
    }

    public function render()
    {
        return view('livewire.admin.spp.list-item-pembayaran');
    }
}
