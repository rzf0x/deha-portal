<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Spp\Cicilan;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran as SppPembayaran;
use App\Models\Spp\PembayaranTimeline;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pembayaran extends Component
{
    use WithFileUploads;

    #[Title('Halaman Pembayaran Spp')]

    // search santri input
    public $search = '';
    public $searchResults = [];

    // santri selected
    public $santriSelected = null;

    // message
    public $errorMessage, $message;

    // list detail pembayaran
    public $listDetailPembayaran;

    // untuk mengkalkulasi yang harus di bayar
    public $totalPembayaran = 0;
    public $selectedMethods = [];
    public $isModalOpen = false;

    // pembayaran
    public $pembayaranList;
    public $pembayaranSelected;

    // input data
    public $selectedStatus, $selectedMetodePembayaran;
    public $buktiPembayaran;
    public $jumlahCicilan, $keteranganCicilan;

    // untuk filter santri
    public $jenjangOptions, $kelasOptions, $tahunAjaranOptions;

    public $filter = [
        'jenjang' => '',
        'kelas' => '',
        'tahunAjaran' => ''
    ];

    // untuk menampilkan nama bulan pembayaran
    public $bulanTimeline = [];

    public function mount()
    {
        $this->filter['tahunAjaran'] = date('Y');

        $this->tahunAjaranOptions = TahunAjaran::all();
        $this->jenjangOptions = Jenjang::all();
        $this->kelasOptions = Kelas::all();
    }

    public function kembaliButton()
    {
        $this->searchResults = [];
        $this->santriSelected = '';
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
            ->whereHas('pembayaran', function ($query) {
                $query->where('tahun_ajaran_id', $this->filter['tahunAjaran']);
            })
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
            'pembayaran' => function ($query) {
                $query->with([
                    'cicilans',
                    'pembayaranTimeline'
                ]);
            },
        ])
            ->find($santriId);

        $this->generateDataPembayaranSantri();
    }

    public function generateDataPembayaranSantri()
    {
        $this->pembayaranList = $this->santriSelected->pembayaran()
            ->where('tahun_ajaran_id', $this->filter['tahunAjaran'])
            ->get();

        $this->bulanTimeline = $this->pembayaranList->load('pembayaranTimeline')->pluck('pembayaranTimeline.nama_bulan', 'id')->toArray();

        $this->listDetailPembayaran = DetailItemPembayaran::where('jenjang_id', $this->santriSelected->kelas->jenjang->id)
            ->where('tahun_ajaran_id', $this->filter['tahunAjaran'])
            ->get();

        $this->reset(['keteranganCicilan', 'jumlahCicilan', 'buktiPembayaran', 'isModalOpen']);
    }

    public function selectPembayaran($pembayaranId)
    {
        $this->pembayaranSelected = SppPembayaran::with('pembayaranTimeline', 'cicilans')
            ->where('id', $pembayaranId)->first();
        $this->isModalOpen = true;
        $this->selectedStatus = $this->pembayaranSelected->status;
        $this->selectedMetodePembayaran = $this->pembayaranSelected->metode_pembayaran;
        $this->reset(['keteranganCicilan', 'jumlahCicilan', 'buktiPembayaran']);
    }

    public function updatePembayaran()
    {
        $this->pembayaranSelected->status = $this->selectedStatus;

        if ($this->pembayaranSelected->status != 'belum bayar') {
            $this->dispatch('hide-error');
            $this->validate([
                'buktiPembayaran' => 'required|mimes:jpeg,png,jpg,svg|max:10000',
                'pembayaranSelected.status' => 'required|string',
                'pembayaranSelected.metode_pembayaran' => 'required|string',
            ], [
                '*.required' => 'Data gagal dimasukkan: :attribute tidak boleh kosong.',
                '*.numeric' => 'Data gagal dimasukkan: :attribute harus berupa angka.',
                '*.string' => 'Data gagal dimasukkan: :attribute harus berupa teks.',
                'buktiPembayaran.required' => 'Bukti pembayaran kosong. silahkan masukan buktiPembayaran terlebih dahulu',
                'buktiPembayaran.mimes' => 'Bukti pembayaran harus berupa file gambar dengan format jpeg, png, jpg, atau svg.',
                'buktiPembayaran.max' => 'Ukuran bukti pembayaran tidak boleh lebih dari 9 MB.',
            ]);
        }

        try {
            if ($this->pembayaranSelected->status == 'lunas') {
                $this->pembayaranSelected->nominal = $this->listDetailPembayaran->sum('nominal');
            } else if ($this->pembayaranSelected->status == 'cicilan') {
                $this->pembayaranSelected->nominal = $this->santriSelected->pembayaran
                    ->where('pembayaran_timeline_id', $this->pembayaranSelected->pembayaran_timeline_id)
                    ->where('tahun_ajaran_id', $this->filter['tahunAjaran'])
                    ->flatMap->cicilans->sum('nominal');
            } else if ($this->pembayaranSelected->status == 'belum bayar') {
                $this->pembayaranSelected->nominal = 0;
            }

            if ($this->pembayaranSelected->status != 'belum bayar') {
                if ($this->pembayaranSelected->bukti_pembayaran) Storage::disk('public')->delete($this->pembayaranSelected->bukti_pembayaran);
                $this->buktiPembayaran = $this->buktiPembayaran->store('e-spp/bukti-transfer', 'public');
                $this->pembayaranSelected->metode_pembayaran = $this->selectedMetodePembayaran;
                $this->pembayaranSelected->bukti_pembayaran = $this->buktiPembayaran;
            }

            $this->pembayaranSelected->save();

            $this->isModalOpen = false;

            $this->message = 'berhasil mengupdate pembayaran';
            $this->dispatch('hide-message');
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal mengupdate pembayaran, terdapat kesalahan silahkan coba lagi';
            $this->dispatch('hide-error');
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function calculateTotalPembayaran()
    {
        $this->totalPembayaran = 0;

        foreach ($this->selectedMethods as $methodId) {
            $item = $this->listDetailPembayaran->firstWhere('id', $methodId);
            if ($item) {
                $this->totalPembayaran += $item->nominal;
            }
        }
    }

    public function storeCicilan()
    {
        $this->dispatch('hide-error');
        $this->validate([
            'jumlahCicilan' => 'required|numeric',
            'keteranganCicilan' => 'required|string',
            'pembayaranSelected.id' => 'required|exists:pembayaran,id',
            'buktiPembayaran' => 'required|mimes:jpeg,png,jpg,svg|max:10000',
        ], [
            '*.required' => 'Data gagal dimasukkan: :attribute tidak boleh kosong.',
            '*.numeric' => 'Data gagal dimasukkan: :attribute harus berupa angka.',
            '*.string' => 'Data gagal dimasukkan: :attribute harus berupa teks.',
            'pembayaranSelected.id.exists' => 'Data gagal dimasukkan: pembayaran tidak ditemukan.',
            'buktiPembayaran.mimes' => 'Bukti pembayaran harus berupa file gambar dengan format jpeg, png, jpg, atau svg.',
            'buktiPembayaran.max' => 'Ukuran bukti pembayaran tidak boleh lebih dari 9 MB.',
        ]);

        try {
            $this->updatePembayaran();

            Cicilan::create([
                'pembayaran_id' => $this->pembayaranSelected->id,
                'keterangan' => $this->keteranganCicilan,
                'nominal' => $this->jumlahCicilan,
                'bukti_pembayaran' => $this->buktiPembayaran
            ]);

            $total_nominal_cicilan = Cicilan::query()->select(['nominal'])
                ->whereHas('pembayaran.cicilans', function ($query) {
                    $query
                        ->where('tahun_ajaran_id', $this->filter['tahunAjaran'])
                        ->where('santri_id', $this->santriSelected->id)
                        ->where('pembayaran_timeline_id', $this->pembayaranSelected->pembayaran_timeline_id);
                })
                ->sum('nominal');

            $this->pembayaranSelected->nominal = $total_nominal_cicilan;
            $this->pembayaranSelected->save();

            // Reset form
            $this->reset(['jumlahCicilan', 'keteranganCicilan', 'buktiPembayaran']);
            $this->isModalOpen = false;

            $this->message = 'berhasil menyimpan cicilan';
            $this->dispatch('hide-message');
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal menyimpan cicilan, terdapat kesalahan silahkan coba lagi';
            $this->dispatch('hide-error');
        }
    }
    public function clearErrors()
    {
        $this->resetErrorBag(); // Reset semua error
    }

    public function createPembayaranTImeline()
    {
        $existingPembayaran = SppPembayaran::where('santri_id', $this->santriSelected->id)
            ->where('tahun_ajaran_id', $this->filter['tahunAjaran'])
            ->exists();

        if ($existingPembayaran) {
            $this->errorMessage = 'gagal, sudah ada timeline di pembayaran';
            $this->dispatch('hide-error');
            return;
        }

        try {
            $timelines = PembayaranTimeline::all();
            foreach ($timelines as $timeline) {
                SppPembayaran::create([
                    'santri_id' => $this->santriSelected->id,
                    'pembayaran_timeline_id' => $timeline->id,
                    'pembayaran_tipe_id' => 1,
                    'tahun_ajaran_id' => $this->filter['tahunAjaran'],
                    'nominal' => 0,
                    'metode_pembayaran' => 'cash',
                    'status' => 'belum bayar',
                ]);
            };

            $this->message = 'berhasil membuat timeline pada pembayaran';
            $this->dispatch('hide-message');

            $this->generateDataPembayaranSantri();
        } catch (\Exception $e) {
            $this->errorMessage = 'gagal, terdapat kesalahan' . $e->getMessage();
            $this->dispatch('hide-error');
        }
    }

    public function render()
    {
        return view('livewire.admin.spp.pembayaran');
    }
}
