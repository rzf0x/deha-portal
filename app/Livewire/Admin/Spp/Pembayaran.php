<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Admin\Spp\PembayaranCicilan;
use App\Models\Santri;
use App\Models\Spp\Cicilan;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran as SppPembayaran;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pembayaran extends Component
{
    use WithFileUploads;

    #[Title('Halaman Pembayaran Spp')]

    public $search = '';
    public $searchResults = [];

    public $santriSelected = null;

    public $errorMessage = '';

    public $totalAmount = 0;
    public $selectedMethods = [];
    public $isModalOpen = false;

    public $pembayaran;
    public $Clickpembayaran;
    public $selectedStatus;
    public $selectedMetodePembayaran;
    public $updatedPembayaran;
    public $detailPembayaran;
    public $cicilan;
    public $jumlahCicilan;
    public $keteranganCicilan;
    public $buktiPembayaran;

    public function searchSantri()
    {
        if (empty($this->search)) {
            $this->errorMessage = 'Kolom pencarian tidak boleh kosong';
            $this->hideError();
            $this->searchResults = [];
            return;
        }

        $this->searchResults = Santri::where('nama', 'like', '%' . $this->search . '%')->get();

        if ($this->searchResults->isEmpty()) {
            $this->errorMessage = 'Santri tidak ditemukan';
            $this->hideError();
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
        $this->reset(['buktiPembayaran']);
    }

    public function updatePembayaran()
    {
        try {
            $this->validate([
                'buktiPembayaran' => 'required|mimes:pdf,jpeg,png,jpg,svg|max:10000',  // Memastikan ID pembayaran ada di database
            ]);

            $this->Clickpembayaran->status = $this->selectedStatus;

            if ($this->Clickpembayaran->status == 'lunas') {
                $this->Clickpembayaran->nominal = $this->detailPembayaran->sum('nominal');
            } else if ($this->Clickpembayaran->status == 'cicilan') {
                $this->Clickpembayaran->nominal = $this->santriSelected->pembayaran->where('pembayaran_timeline_id', $this->Clickpembayaran->pembayaran_timeline_id)->flatMap->cicilans->sum('nominal');
            } else if ($this->Clickpembayaran->status == 'belum bayar') {
                $this->Clickpembayaran->nominal = 0;
            }

            if ($this->Clickpembayaran->bukti_pembayaran) Storage::disk('public')->delete($this->Clickpembayaran->bukti_pembayaran);
            $this->buktiPembayaran = $this->buktiPembayaran->store('e-spp/bukti-transfer', 'public');

            $this->Clickpembayaran->metode_pembayaran = $this->selectedMetodePembayaran;
            $this->Clickpembayaran->bukti_pembayaran = $this->buktiPembayaran;
            $this->Clickpembayaran->save();

            $this->pembayaran = SppPembayaran::with('pembayaranTimeline')->where('santri_id', $this->santriSelected->id)->get();
            $this->isModalOpen = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal';
            $this->hideError();
        }
    }

    public function hideError()
    {
        $this->dispatch('hide-error', ['delay' => 2000]);
        
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
        
        try {
            $this->validate([
                'jumlahCicilan' => 'required|numeric',
                'keteranganCicilan' => 'required|string',
                'Clickpembayaran.id' => 'required|exists:pembayaran,id',  // Memastikan ID pembayaran ada di database
                'buktiPembayaran' => 'required|mimes:pdf,jpeg,png,jpg,svg|max:10000',  // Memastikan ID pembayaran ada di database
            ]);
            
            $this->updatePembayaran();

            Cicilan::create([
                'pembayaran_id' => $this->Clickpembayaran->id,
                'keterangan' => $this->keteranganCicilan,
                'nominal' => $this->jumlahCicilan,
                'bukti_pembayaran' => $this->buktiPembayaran
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
            $this->reset(['jumlahCicilan', 'keteranganCicilan', 'buktiPembayaran']);
            $this->isModalOpen = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal';
            $this->hideError();
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
