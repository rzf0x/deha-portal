<?php

namespace App\Livewire\Admin;

use App\Models\WaliKelas as ModelsWaliKelas;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class WaliKelas extends Component
{
    use WithPagination;

    // bool
    public $isEdit = false;

    // Integer
    public $waliKelasId;

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    #[Title('Halaman Wali Kelas ')]

    #[Computed]
    public function getData()
    {
        return ModelsWaliKelas::paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.wali-kelas');
    }
}
