<?php
namespace App\Livewire\Admin\Spp;

use App\Models\Admin\Spp\PembayaranCicilan;
use App\Models\Santri;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran as SppPembayaran;
use Livewire\Component;
use Livewire\WithPagination;

class Pembayaran extends Component
{
    public $search = '';
    public $searchResults = [];
    public $santriSelected = null;
    public $errorMessage = '';
    public $totalAmount = 0;
    public $selectedMethods = [];
    public $pembayaran;
    public $isModalOpen = false;
    public $Clickpembayaran;
    public $selectedStatus;
    public $updatedPembayaran;
    public $detailPembayaran;
    public $cicilan;
    public $jumlahCicilan;
    public $keteranganCicilan;

    public function searchSantri()
    {
        if (empty($this->search)) {
            $this->errorMessage = 'Kolom pencarian tidak boleh kosong';
            $this->searchResults = [];
            return;
        }

        $this-> searchResults = Santri::where('nama', 'like', '%' . $this->search . '%')->get();

        if ($this->searchResults->isEmpty()) {
            $this->errorMessage = 'Santri tidak ditemukan';
        } else {
            $this->errorMessage = '';
        }
        $this->santriSelected = '';
    }

    public function selectSantri($santriId)
    {
        $this->santriSelected = Santri::with('kelas.jenjang', 'kamar')->find($santriId);
        $this->pembayaran = SppPembayaran::where('santri_id', $santriId)->get();
        $this->detailPembayaran();
        $this->searchResults = [];
        $this->search = '';
    }

    public function selectPembayaran($pembayaranId)
    {
        $this->Clickpembayaran = SppPembayaran::with('cicilans')->where('id', $pembayaranId)->first();
        $cicilan = PembayaranCicilan::where('pembayaran_id', $pembayaranId)->first();
        if ($cicilan) {
            $this->jumlahCicilan = $cicilan->nominal;
            $this->keteranganCicilan = $cicilan->keterangan;
        } else {
            $this->reset(['jumlahCicilan', 'keteranganCicilan']);
        }
        $this->isModalOpen = true;
        $this->selectedStatus = $this->Clickpembayaran->status;
    }

    public function updatePembayaran()
    {
        $this->Clickpembayaran->status = $this->selectedStatus;
        $this->Clickpembayaran->save();
        $this->pembayaran = SppPembayaran::where('santri_id', $this->santriSelected->id)->get();
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

    public function storeCicilan()
    {
        $this->validate([
            'jumlahCicilan' => 'required|numeric',
            'keteranganCicilan' => 'required|string',
            'Clickpembayaran.id' => 'required|exists:pembayaran,id',  // Memastikan ID pembayaran ada di database
        ]);

        try {
            PembayaranCicilan::updateOrCreate(['pembayaran_id' => $this->Clickpembayaran->id],[
                'pembayaran_id' => $this->Clickpembayaran->id,
                'keterangan' => $this->keteranganCicilan,
                'nominal' => $this->jumlahCicilan
            ]);

            // Reset form
            $this->reset(['jumlahCicilan', 'keteranganCicilan']);
            $this->isModalOpen = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan cicilan');
        }
    }

    public function detailPembayaran()
    {
        $this->detailPembayaran = DetailItemPembayaran::where('jenjang_id', $this->santriSelected->kelas->jenjang->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.spp.pembayaran');
    }
}