<?php

namespace App\Livewire\Admin\Spp;


use App\Models\Santri;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran as SppPembayaran;
use Livewire\Attributes\Title;
use Livewire\Component;

class PembayaranCicilan extends Component
{
    #[Title('Halaman List Pembayaran cicilan')]
    public $search = '';
    public $searchResults = [];
    public $santriSelected;
    public $errorMessage = '';
    public $totalAmount = 0;
    public $selectedMethods = [];
    public $pembayaran;
    public $isModalOpen = false;
    public $Clickpembayaran;
    public $selectedStatus;
    public $updatedPembayaran;
    public $detailPembayaran;
    public $showCicilanModal = false;
    public $keteranganCicilan;
    public $jumlahCicilan;
    public $cicilan;

    public function searchSantri()
    {
        if (empty($this->search)) {
            $this->errorMessage = 'Kolom pencarian tidak boleh kosong';
            $this->searchResults = [];
            return;
        }

        $this->searchResults = Santri::where('nama', 'like', '%' . $this->search . '%')->get();

        if ($this->searchResults->isEmpty()) {
            $this->errorMessage = 'Santri tidak ditemukan';
        } else {
            $this->errorMessage = '';
        }
    }

    public function selectSantri($santriId)
    {
        $this->santriSelected = Santri::with('kelas.jenjang', 'kamar')->find($santriId);
        // Ubah cara mengambil data pembayaran
        $this->pembayaran = SppPembayaran::where('santri_id', $santriId)->get();

        $this->detailPembayaran();
        $this->searchResults = [];
        $this->search = '';
    }

    public function selectPembayaran($pembayaranId)
    {
        $this->Clickpembayaran = SppPembayaran::where('id', $pembayaranId)->first();
        $this->isModalOpen = true;
        $this->selectedStatus = $this->Clickpembayaran->status;
    }

    public function updatePembayaran()
    {
        $this->Clickpembayaran->status = $this->selectedStatus;
        $this->Clickpembayaran->save();
        $this->dispatch('pembayaranUpdated');
        $this->updatedSelectedStatus($this->selectedStatus);
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function calculateTotalAmount()
    {
        $this->totalAmount = 0;

        foreach ($this->selectedMethods as $methodId) {
            $item = $this->detailPembayaran->firstWhere('id', $methodId);
            if ($item) {
                $this->totalAmount += $item->nominal;
            }
        }
    }

    public function updatedSelectedStatus($value)
    {
        if ($value === 'cicilan') {
            $this->showCicilanModal = true;
        } else {
            $this->showCicilanModal = false;
        }
    }

    public function storeCicilan()
    {
        PembayaranCicilan::create([
            'pembayaran_id' => $this->Clickpembayaran->id,
            'keterangan' => $this->keteranganCicilan,
            'nominal' => $this->jumlahCicilan
        ]);

        $this->showCicilanModal = false;
    }

    public function detailPembayaran()
    {
        $this->detailPembayaran = DetailItemPembayaran::where('jenjang_id', $this->santriSelected->kelas->jenjang->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.spp.pembayaran-cicilan');
    }
}
