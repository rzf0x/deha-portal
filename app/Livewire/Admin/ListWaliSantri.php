<?php

namespace App\Livewire\Admin;

use App\Models\OrangTuaSantri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class ListWaliSantri extends Component
{
    #[Title('Halaman List Wali Santri')]
    #[Computed]
    public function getData()
    {
        return OrangTuaSantri::with('santri')->paginate(5);
    }
    public function edit($santriId)
    {
        $this->dispatch('editWaliSantri', $santriId);
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
