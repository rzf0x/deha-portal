<?php

namespace App\Livewire\Admin;

use App\Models\OrangTuaSantri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class ListWaliSantri extends Component
{
    #[Title('Halaman List Wali Santri')]

    #[Url(except: '', as: 'q-wali')]
    public $search;
    
    #[Computed]
    public function getData()
    {
        if ($this->search) {
            return OrangTuaSantri::with('santri')
                ->where(function ($query) {
                    $query->whereRaw('nama_ayah LIKE ? OR nama_ibu LIKE ?', [
                        "%{$this->search}%",
                        "%{$this->search}%",
                    ]);
                })
                ->orWhereHas('santri', function ($query) {
                    $query->whereRaw('nama LIKE ? OR CASE 
                        WHEN jenis_kelamin = "putera" THEN "laki-laki"
                        WHEN jenis_kelamin = "puteri" THEN "perempuan"
                        END LIKE ?', ["%{$this->search}%", "%{$this->search}%"]);
                })
                ->orWhereHas('santri.kelas', function ($query) {
                    $query->where('nama', 'LIKE', "%{$this->search}%");
                })
                ->orWhereHas('santri.kelas.jenjang', function ($query) {
                    $query->where('nama', 'LIKE', "%{$this->search}%");
                })
                ->orWhereHas('santri.kamar', function ($query) {
                    $query->where('nama', 'LIKE', "%{$this->search}%");
                })
                ->paginate(5);
        }

        return OrangTuaSantri::with('santri')->paginate(5);
    }
    public function delete($santriId)
    {
        return OrangTuaSantri::find($santriId)->delete();
    }
    public function render()
    {
        return view('livewire.admin.list-wali-santri');
    }
}
