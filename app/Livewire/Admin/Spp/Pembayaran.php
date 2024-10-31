<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Admin\Spp\PembayaranCicilan;
use App\Models\Santri;
use App\Models\Spp\Cicilan;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran as SppPembayaran;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Pembayaran extends Component
{
    #[Title('Halaman Pembayaran Spp')]
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
    public $selectedMetodePembayaran;
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

        $this->searchResults = Santri::where('nama', 'like', '%' . $this->search . '%')->get();

        if ($this->searchResults->isEmpty()) {
            $this->errorMessage = 'Santri tidak ditemukan';
        } else {
            $this->errorMessage = '';
        }
        $this->santriSelected = '';
    }

    public function selectSantri($santriId)
    {
        $this->santriSelected = Santri::with([
            'pembayaran' => function ($query) {
                $query->with('cicilans');
            },
            'kelas.jenjang',
            'kamar'
        ])->find($santriId);

        $this->pembayaran = SppPembayaran::with('pembayaranTimeline')->where('santri_id', $santriId)->get();
        $this->detailPembayaran();
        $this->searchResults = [];
        $this->search = '';
    }

    public function selectPembayaran($pembayaranId)
    {
        $this->Clickpembayaran = SppPembayaran::with('pembayaranTimeline', 'cicilans')->where('id', $pembayaranId)->first();
        $this->isModalOpen = true;
        $this->selectedStatus = $this->Clickpembayaran->status;
        $this->selectedMetodePembayaran = $this->Clickpembayaran->metode_pembayaran;
    }

    public function updatePembayaran()
    {
        $this->Clickpembayaran->status = $this->selectedStatus;
        
        if ($this->Clickpembayaran->status == 'lunas') {
            $this->Clickpembayaran->nominal = $this->detailPembayaran->sum('nominal');
        } else if ($this->Clickpembayaran->status == 'cicilan') {
            $this->Clickpembayaran->nominal = $this->santriSelected->pembayaran->where('pembayaran_timeline_id', $this->Clickpembayaran->pembayaran_timeline_id)->flatMap->cicilans->sum('nominal');
        } else if ($this->Clickpembayaran->status == 'belum bayar') {
            $this->Clickpembayaran->nominal = 0;
        }
        
        $this->Clickpembayaran->metode_pembayaran = $this->selectedMetodePembayaran;
        $this->Clickpembayaran->save();
        
        $this->pembayaran = SppPembayaran::with('pembayaranTimeline')->where('santri_id', $this->santriSelected->id)->get();
        $this->isModalOpen = false;
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
            $this->updatePembayaran();
            PembayaranCicilan::create([
                'pembayaran_id' => $this->Clickpembayaran->id,
                'keterangan' => $this->keteranganCicilan,
                'nominal' => $this->jumlahCicilan
            ]);


            $total_nominal_cicilan = Cicilan::query()->select(['nominal'])
                ->with(['pembayaran.cicilans' . 'pembayaran.pembayaranTimeline'])
                ->whereHas('pembayaran.cicilans', function ($query) {
                    $query
                        ->where('santri_id', $this->santriSelected->id)
                        ->where('pembayaran_timeline_id', $this->Clickpembayaran->pembayaran_timeline_id);
                })
                ->sum('nominal');

            $this->Clickpembayaran->nominal = $total_nominal_cicilan;
            $this->Clickpembayaran->save();

            // Reset form
            $this->reset(['jumlahCicilan', 'keteranganCicilan']);
            $this->isModalOpen = false;
        } catch (\Exception $e) {
            dd($e);
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
