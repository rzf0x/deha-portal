<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Admin\Spp\PembayaranCicilan;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Spp\Cicilan;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran as SppPembayaran;
use Illuminate\Http\UploadedFile;
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
    public $message = '';

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

    public $filter = [
        'jenjang' => '',
        'kelas' => '',
    ];

    public $jenjangs, $kelas;
    public $bulanTimeline = [];

    public function mount()
    {
        $this->jenjangs = Jenjang::all();
        $this->kelas = Kelas::all();
    }

    public function searchSantri()
    {
        if (empty($this->filter['kelas']) && empty($this->filter['jenjang']) && empty($this->search)) {
            $this->errorMessage = 'Kolom pencarian tidak boleh kosong';
            $this->dispatch('hide-error');
            $this->searchResults = [];
            return;
        }

        $this->searchResults = Santri::with(['kelas', 'kelas.jenjang'])
            ->has('pembayaran')
            ->when(!empty($this->filter['jenjang']), function ($query) {
                return $query->whereHas('kelas.jenjang', function ($subQuery) {
                    $subQuery->where('nama', $this->filter['jenjang']);
                });
            })
            ->when(!empty($this->filter['kelas']), function ($query) {
                return $query->whereHas('kelas', function ($subQuery) {
                    $subQuery->where('nama', $this->filter['kelas']);
                });
            })
            ->when(!empty($this->search), function ($query) {
                return $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->take(40)->get();

        if ($this->searchResults->isEmpty()) {
            $this->errorMessage = 'Santri tidak ditemukan';
            $this->dispatch('hide-error');
        } else {
            $this->errorMessage = '';
        }
        $this->santriSelected = '';
    }

    public function selectSantri($santriId)
    {   
        $this->santriSelected = Santri::with([
            'kelas.jenjang',
            'kamar',
            'pembayaran.cicilans',
            'pembayaran.pembayaranTimeline'
        ])->find($santriId);

        $this->pembayaran = $this->santriSelected->pembayaran;

        $this->bulanTimeline = $this->pembayaran->pluck('pembayaranTimeline.nama_bulan', 'id')->toArray();

        $this->detailPembayaran();
        $this->reset(['keteranganCicilan', 'jumlahCicilan', 'buktiPembayaran', 'isModalOpen']);
    }

    public function selectPembayaran($pembayaranId)
    {
        $this->Clickpembayaran = SppPembayaran::with('pembayaranTimeline', 'cicilans')->where('id', $pembayaranId)->first();
        $this->isModalOpen = true;
        $this->selectedStatus = $this->Clickpembayaran->status;
        $this->selectedMetodePembayaran = $this->Clickpembayaran->metode_pembayaran;
        $this->reset(['keteranganCicilan', 'jumlahCicilan', 'buktiPembayaran']);
    }

    public function updatePembayaran()
    {
        try {
            $this->validate([
                'buktiPembayaran' => 'required|mimes:jpeg,png,jpg,svg|max:10000', 
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

            
            $this->message = 'berhasil mengupdate pembayaran';
            $this->dispatch('hide-message');
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal mengupdate pembayaran, tunggu beberapa saat atau coba lagi, error = '. $e->getMessage();
            $this->dispatch('hide-error');
        }
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
                'Clickpembayaran.id' => 'required|exists:pembayaran,id', 
                'buktiPembayaran' => 'required|mimes:jpeg,png,jpg,svg|max:10000', 
            ]);

            $this->updatePembayaran();

            Cicilan::create([
                'pembayaran_id' => $this->Clickpembayaran->id,
                'keterangan' => $this->keteranganCicilan,
                'nominal' => $this->jumlahCicilan,
                'bukti_pembayaran' => $this->buktiPembayaran
            ]);

            $total_nominal_cicilan = Cicilan::query()->select(['nominal'])
                ->with(['pembayaran.cicilans', 'pembayaran.pembayaranTimeline'])
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

            $this->message = 'berhasil menyimpan cicilan';
            $this->dispatch('hide-message');
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal menyimpan cicilan, tunggu beberapa saat atau coba lagi, error = '. $e->getMessage() ;
            $this->dispatch('hide-error');
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
