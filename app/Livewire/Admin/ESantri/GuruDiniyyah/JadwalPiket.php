<?php

namespace App\Livewire\Admin\ESantri\GuruDiniyyah;

use App\Livewire\Forms\JadwalPiket as FormsJadwalPiket;
use App\Models\ESantri\JadwalPiket as ModelsJadwalPiket;
use App\Models\Santri;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class JadwalPiket extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Title('Halaman Jadwal Piket')]

    public FormsJadwalPiket $jadwalPiketForm;

    public $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    public $waktuList = ['pagi', 'siang', 'sore', 'malam'];

    public $santris, $kelasList;
    public $jadwalPiketId;

    public $isEditing = false;

    public $searchSantri;

    public $filter = [
        'kelas' => '',
        'hari' => '',
    ];

    public function mount()
    {
        $this->santris = Santri::all();
        $this->kelasList = Kelas::all();
    }

    public function resetFields()
    {
        $this->jadwalPiketForm->reset();
        $this->jadwalPiketId = null;
        $this->isEditing = null;
    }

    public function create()
    {
        $this->resetFields();
    }

    public function store()
    {
        try {
            $this->jadwalPiketForm->role_guru = 'diniyyah';
            $this->jadwalPiketForm->validate();

            ModelsJadwalPiket::create($this->jadwalPiketForm->all());

            session()->flash('success', 'Jadwal piket berhasil ditambahkan!');

            $this->dispatch("close-modal-createOrUpdate");
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->jadwalPiketId = $id;
        $jadwal = ModelsJadwalPiket::findOrFail($id);
        $this->jadwalPiketForm->fill($jadwal);
    }

    public function update()
    {
        try {
            $this->jadwalPiketForm->role_guru = 'diniyyah';
            $this->jadwalPiketForm->validate();

            ModelsJadwalPiket::findOrFail($this->jadwalPiketId)->update($this->jadwalPiketForm->all());

            session()->flash('success', 'Jadwal piket berhasil diperbarui!');

            $this->dispatch("close-modal-createOrUpdate");

            $this->resetFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $jadwal = ModelsJadwalPiket::findOrFail($id);
        $jadwal->delete();

        session()->flash('success', 'Jadwal piket berhasil dihapus!');
    }

    public function getJadwalList()
    {
        return ModelsJadwalPiket::with('santri', 'kelas')
            ->where('role_guru', 'diniyyah')
            ->when(!empty($this->filter['hari']), function ($query) {
                return $query->where('hari', $this->filter['hari']);
            })
            ->when(!empty($this->filter['kelas']), function ($query) {
                return $query->whereHas('kelas', function ($subQuery) {
                    return $subQuery->where('nama', $this->filter['kelas']);
                });
            })
            ->when(!empty($this->searchSantri), function ($query) {
                return $query->whereHas('santri', function ($subQuery) {
                    return $subQuery->where('nama', 'like', '%' . $this->searchSantri . '%');
                });
            })
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.e-santri.guru-diniyyah.jadwal-piket', [
            'jadwalPikets' => $this->getJadwalList(),
        ]);
    }
}
